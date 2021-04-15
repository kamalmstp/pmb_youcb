<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Gelombang; 
use App\ThAkademik;

use Auth;
Use Alert;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class GelombangController extends Controller
{
    private $title = 'Gelombang';
    private $url = 'admin/gelombang';
    private $folder = 'admin.gelombang';

    public function index(Request $request)
    {
        $title = $this->title;
        $url = $this->url;
        $folder = $this->folder;

        if ($request->ajax()) {
            $data = Gelombang::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('thakademik',function($row){
                        return @$row->thakademik->kode;
                    })
                    ->addColumn('tglmulai',function($row){
                        return with(new Carbon($row->tgl_mulai))->format('d-m-Y');
                    })
                    ->addColumn('tglselesai',function($row){
                        return with(new Carbon($row->tgl_selesai))->format('d-m-Y');
                    })
                    ->addColumn('lblaktif',function($row){
                        if($row->aktif=='Y')
                        {
                            $hasil = '<i class="fa fa-check-circle text-success"></i>';
                        }else{
                            $hasil = '';
                        }
                        return $hasil;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group">';
                        $btn = $btn.'<a href="'.url($this->url.'/'.$row->id.'/edit').'" data-toggle="tooltip"  data-original-title="Edit" title="Edit" class="edit btn btn-primary btn-xs editBtn"> <i class="far fa-edit"></i> </a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" title="Hapus" class="btn btn-danger btn-xs deleteBtn"> <i class="far fa-trash-alt"></i> </a>';
                        $btn = $btn.'</div>';
                        return $btn;
                    })
                    ->rawColumns(['action','lblaktif'])
                    ->make(true);
        }

        return view($folder.'.index',compact('title','url','folder'));
    }

    public function create()
    {
        $title = 'Tambah Data '.$this->title;
        $url = $this->url;
        $folder = $this->folder;
        $data = null;
        $list_thakademik = ThAkademik::orderBy('kode','desc')->get();

        return view($folder.'.form',compact('title','url','folder','data','list_thakademik'));
    }

    public function edit($id)
    {
        $title = 'Edit Data '.$this->title;
        $url = $this->url;
        $folder = $this->folder;
        $data = Gelombang::find($id);
        $list_thakademik = ThAkademik::orderBy('kode','desc')->get();

        return view($folder.'.form',compact('title','url','folder','data','list_thakademik'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if(is_null($request->id))
        {
            $msg = [
                'mst_th_akademik_id.required' => 'Th Akademik Tidak Boleh Kosong',
                'gelombang.required' => 'gelombang Tidak Boleh Kosong',
                'gelombang.min' => 'gelombang Minimal 2 Karakter',
            ];
            $validator = Validator::make($request->all(),[
                'mst_th_akademik_id' => 'required',
                'gelombang' => 'required|min:2',
            ],$msg);
        }else{
            $msg = [
                'mst_th_akademik_id.required' => 'Th Akademik Tidak Boleh Kosong',
                'gelombang.required' => 'gelombang Tidak Boleh Kosong',
                'gelombang.min' => 'gelombang Minimal 2 Karakter',
            ];
            $validator = Validator::make($request->all(),[
                'mst_th_akademik_id' => 'required',
                'gelombang' => 'required|min:2',
            ],$msg);
        }


        if ($validator->passes()) {

            if($request->aktif)
            {
                Gelombang::where('aktif', 'Y')->update(['aktif' => 'T']);
            }

            Gelombang::updateOrCreate(['id' => $request->id],
            [
            'mst_th_akademik_id' => $request->mst_th_akademik_id,
            'gelombang' => $request->gelombang,
            'biaya' => $request->biaya,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'ketua_panitia' => $request->ketua_panitia,
            'aktif' => $request->aktif ? 'Y' : 'T',
            'user_id' => Auth::user()->id,
            ]);

            Alert::success($this->title, 'Data berhasil disimpan.');

            return redirect($this->url);
        }
    }


    public function destroy($id)
    {
        Gelombang::find($id)->delete();
        return response()->json(['success'=>$this->title.' Berhasil Dihapus.']);
    }
}
