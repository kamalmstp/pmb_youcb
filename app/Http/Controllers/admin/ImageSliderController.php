<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Slider;

use Auth;
Use Alert;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class ImageSliderController extends Controller
{
    private $title = 'Image Slider';
    private $url = 'admin/imageslider';
    private $folder = 'admin.slider';

    public function index(Request $request)
    {

        $title = $this->title;
        $url = $this->url;
        $folder = $this->folder;

        if ($request->ajax()) {
            $data = Slider::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
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

        return view($folder.'.form',compact('title','url','folder','data'));
    }

    public function edit($id)
    {
        $title = 'Edit Data '.$this->title;
        $url = $this->url;
        $folder = $this->folder;
        $data = Slider::find($id);

        return view($folder.'.form',compact('title','url','folder','data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if(is_null($request->id))
        {
            $msg = [
                'judul.required' => 'Judul Tidak Boleh Kosong',
                'gambar.image' => 'Gambar harus berektensi JPG, JPEG, PNG.',
                'gambar.required' => 'Gambar Tidak Boleh Kosong',
                'gambar.max' => 'Gambar ukuran tidak boleh dari 2Mb',
            ];
            $validator = Validator::make($request->all(),[
                'judul' => 'required',
                'gambar' => 'required|image|max:2048',
            ],$msg);
        }else{
            $msg = [
                'judul.required' => 'Judul Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(),[
                'judul' => 'required',
            ],$msg);
        }


        if ($validator->passes()) {

            if($request->gambar)
            {
                $destinationPath = 'slider';
                $rand = rand(1,10000);

                $ext_file = $request->gambar->getClientOriginalExtension();
                $file_name = $rand.'.'.$ext_file;

                $request->gambar->move($destinationPath, $file_name);
            }else{
                $file_name = null;
            }


            Slider::updateOrCreate(['id' => $request->id],
            [
                'judul' => $request->judul,
                'gambar' => $file_name ? $file_name : null,
                'aktif' => $request->aktif ? 'Y' : 'T',
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
        Slider::find($id)->delete();
        return response()->json(['success'=>$this->title.' Berhasil Dihapus.']);
    }
}
