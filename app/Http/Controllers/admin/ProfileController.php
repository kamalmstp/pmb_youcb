<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

use Auth;
Use Alert;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $title = 'Profile';
    private $url = 'admin/profile';
    private $folder = 'admin.profile';

    public function index(Request $request)
    {

        $title = 'Edit '. $this->title;
        $url = $this->url;
        $folder = $this->folder;
        $id = Auth::user()->id;

        $data = User::where('id',$id)->first();

        return view($folder.'.index',compact('title','url','folder','data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        
            // $msg = [
            //     'name.required' => 'Name Tidak Boleh Kosong',
            // ];
            // $validator = Validator::make($request->all(),[
            //     'name' => 'required',
            // ],$msg);
        
            // if($request->old_password)
            // {
            //     $msg = [
            //         'name.required' => 'Name Tidak Boleh Kosong',
            //         'old_password.required' => 'Old Password Tidak Boleh Kosong',
            //         'password.required' => 'Password Tidak Boleh Kosong',
            //     ];
            //     $validator = Validator::make($request->all(),[
            //         'name' => 'required',
            //         'old_password' => 'required',
            //         'password' => ['required', 'string', 'min:8', 'confirmed'],
            //     ],$msg);
            // }
        $msg = [
            'password.required' => 'Password Tidak Boleh Kosong',
        ];
        $validator = Validator::make($request->all(),[
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],$msg);

        if ($validator->passes()) {

            $id = Auth::user()->id;

            $data = User::where('id',$id)
            // ->where('password',Hash::make($request->old_password))
            ->first();
            // dd($data->password.' = '.Hash::make($request->old_password));
            if($data)
            {
                $data->password = Hash::make($request->password);
                $data->save();
                Alert::success($this->title, 'Data berhasil disimpan.');
            }else{
                Alert::error($this->title, 'Old Password salah.');
            }

            

            return redirect($this->url);
        }
        // dd($validator->errors()->all());
        Alert::error($this->title,'Error Password.');
        return redirect($this->url);
    }
}
