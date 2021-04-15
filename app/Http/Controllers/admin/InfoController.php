<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Info;

use Auth;
Use Alert;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class InfoController extends Controller
{
    private $title = 'Info Pendaftaran';
    private $url = 'admin/info';
    private $folder = 'admin.info';

    public function index(Request $request)
    {

        $title = $this->title;
        $url = $this->url;
        $folder = $this->folder;

        if ($request->ajax()) {
            $data = Info::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('lblaktif',function($row){
                        if($row->publish=='Y')
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

        return view($folder.'.form',compact('title','url','folder','data'));
    }

    public function edit($id)
    {
        $title = 'Edit Data '.$this->title;
        $url = $this->url;
        $folder = $this->folder;
        $data = Info::find($id);

        return view($folder.'.form',compact('title','url','folder','data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if(is_null($request->id))
        {
            $msg = [
                'judul.required' => 'Judul Tidak Boleh Kosong',
                'judul.min' => 'Judul Tidak Boleh Kosong 3 Karakter',
                'isi.required' => 'Isi Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(),[
                'judul' => 'required|min:5',
                'isi' => 'required',
            ],$msg);
        }else{
            $msg = [
                'judul.required' => 'Judul Tidak Boleh Kosong',
                'judul.min' => 'Judul Tidak Boleh Kosong 3 Karakter',
                'isi.required' => 'Isi Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(),[
                'judul' => 'required|min:5',
                'isi' => 'required',
            ],$msg);
        }


        if ($validator->passes()) {


            Info::updateOrCreate(['id' => $request->id],
            [
                'judul' => $request->judul,
                'isi' => $request->isi,
                'publish' => $request->publish ? 'Y' : 'T',
                'user_id' => Auth::user()->id,
            ]);

            Alert::success($this->title, 'Data berhasil disimpan.');

            return redirect($this->url);
        }
        // dd($validator->errors()->all());
        Alert::error('tite','Error');
    }


    public function destroy($id)
    {
        Info::find($id)->delete();
        return response()->json(['success'=>$this->title.' Berhasil Dihapus.']);
    }
}
