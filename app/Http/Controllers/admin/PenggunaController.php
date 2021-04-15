<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
Use Alert;
use App\User;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    private $title = 'Pengguna';
    private $url = 'admin/pengguna';
    private $folder = 'admin.pengguna';

    public function index(Request $request)
    {
        

        $title = $this->title;
        $url = $this->url;
        $folder = $this->folder;

        if ($request->ajax()) {
            $data = User::latest()
            ->where('level',1)
            ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group">';
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
        $data = User::find($id);

        return view($folder.'.form',compact('title','url','folder','data'));
    }

    

    public function store(Request $request)
    {
        // dd($request->all());
        if(is_null($request->id))
        {
            $msg = [
                'name.required' => 'Name Tidak Boleh Kosong',
                'password.required' => 'Password Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'email' => ['required', 'max:255', 'unique:users'],
            ],$msg);
        }else{
            $msg = [
                'name.required' => 'Name Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => ['required', 'max:255'],
            ],$msg);
        }


        if ($validator->passes()) {
            
            $data = User::where('id',$request->id)->first();
            if(!$data)
            {
                $data = new User;
            }

            if($request->password)
            {
                $data->password = Hash::make($request->password);
            }
            $data->name = $request->name;
            $data->email = $request->email;
            $data->level = 1;
            $data->save();

            
            Alert::success($this->title, 'Data berhasil disimpan.');
            return redirect($this->url);
            
        }else{
            Alert::error($this->title, 'Error Data');
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }
    }


    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['success'=>$this->title.' Berhasil Dihapus.']);
    }
}
