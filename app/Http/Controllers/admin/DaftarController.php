<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Gelombang; 
use App\ThAkademik;
use App\Daftar;

use Auth;
Use Alert;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DaftarController extends Controller
{
    private $title = 'Daftar';
    private $url = 'admin/daftar';
    private $folder = 'admin.daftar';

    public function index(Request $request)
    {
        

        $title = $this->title;
        $url = $this->url;
        $folder = $this->folder;

        if ($request->ajax()) {
            $data = Daftar::latest()->where('level','2')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('thakademik',function($row){
                        return @$row->gelombang->thakademik->kode;
                    })
                    ->addColumn('gelombang',function($row){
                        return @$row->gelombang->gelombang;
                    })
                    ->addColumn('tgl',function($row){
                        return with(new Carbon($row->created_at))->format('d-m-Y');
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group">';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Reset" title="Reset" class="btn btn-danger btn-xs resetBtn"> <i class="fas fa-key"></i> </a>';
                        $btn = $btn.'<a href="'.url($this->url.'/'.$row->id.'/edit').'" data-toggle="tooltip"  data-original-title="Edit" title="Edit" class="edit btn btn-primary btn-xs editBtn"> <i class="far fa-edit"></i> </a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" title="Hapus" class="btn btn-danger btn-xs deleteBtn"> <i class="far fa-trash-alt"></i> </a>';
                        $btn = $btn.'</div>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
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

        return view($folder.'.form',compact('title','url','folder','data'));
    }

    public function edit($id)
    {
        $title = 'Edit Data '.$this->title;
        $url = $this->url;
        $folder = $this->folder;
        $data = Daftar::find($id);

        return view($folder.'.form',compact('title','url','folder','data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if(is_null($request->id))
        {
            $msg = [
                'name.required' => 'Nama Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'telp.required' => 'Telepon Tidak Boleh Kosong',
                'asal_sekolah.required' => 'Asal Sekolah Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|min:2',
                'telp' => 'required',
                'asal_sekolah' => 'required',
            ],$msg);
        }else{
            $msg = [
                'name.required' => 'Nama Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'telp.required' => 'Telepon Tidak Boleh Kosong',
                'asal_sekolah.required' => 'Asal Sekolah Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|min:2',
                'telp' => 'required',
                'asal_sekolah' => 'required',
            ],$msg);
        }


        if ($validator->passes()) {

            $dt_gelombang = Gelombang::where('aktif','Y')->first();
            if($dt_gelombang)
            {
                $pmb_gelombang_id = $dt_gelombang->id;
                $th_akademik_id = $dt_gelombang->mst_th_akademik_id;
                $biaya = $dt_gelombang->biaya;
    
                Daftar::updateOrCreate(['id' => $request->id],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'nisn' => $request->nisn,
                    'telp' => $request->telp,
                    'asal_sekolah' => $request->asal_sekolah,
                    'th_akademik_id' => $th_akademik_id,
                    'pmb_gelombang_id' => $pmb_gelombang_id,
                    'biaya' => $biaya,
                    'level' => '2',
                    'password' => Hash::make($request->telp),
                    'user_id' => Auth::user()->id,
                ]);
    
                Alert::success($this->title, 'Data berhasil disimpan.');
    
                return redirect($this->url);
            }else{
                Alert::error($this->title, 'Maaf, Tidak ada Gelombang Aktif');
    
                return redirect($this->url);
            }
            
        }
    }


    public function update(Request $request)
    {
        // dd($request->all());
        $data = Daftar::find($request->id);
        $data->password = Hash::make($data->telp);
        $data->save();
        return response()->json(['success'=>$this->title.' Password Berhasil DiReset.']);
    }

    public function destroy($id)
    {
        Daftar::find($id)->delete();
        return response()->json(['success'=>$this->title.' Berhasil Dihapus.']);
    }
}
