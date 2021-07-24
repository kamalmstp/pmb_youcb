<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Gelombang;
use App\ThAkademik;
use App\Daftar;
use App\Formulir;
use App\Lulus;

use Auth;
Use Alert;
use App\Kelas;
use App\Prodi;
use App\Validasi;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ValidasiController extends Controller
{
    private $title = 'Validasi Bukti Pembayaran';
    private $url = 'admin/validasi';
    private $folder = 'admin.validasi';

    public function index(Request $request)
    {
        $title = $this->title;
        $url = $this->url;
        $folder = $this->folder;
        
        
        if ($request->ajax()) {

            $th_akademik_id = Gelombang::where('aktif','Y')->first();
            // $th_akademik_id = Gelombang::where('id',$id)->first();
            

            $data = Daftar::
            where('th_akademik_id',$th_akademik_id->mst_th_akademik_id)
            ->latest()
            ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('thakademik',function($row){
                        return @$row->thakademik->kode;
                    })
                    ->addColumn('gelombang',function($row){
                        return @$row->gelombang->gelombang;
                    })
                    ->addColumn('bukti',function($row){
                        $valid = Validasi::where('user_id',$row->id)->first();                        
                        if($valid)
                        {
                            $img ='<div class="image">';
                            $img = $img.'<a href="/file_bukti/'.$valid->file_bukti.'" target="_blank">';
                            $img = $img.'<img src="/file_bukti/'.$valid->file_bukti.'" class="img-circle elevation-2" alt="User Image" width="30">';
                            $img = $img.'</a>';
                            $img = $img.'</div>';
                        }else{
                            $img ='';
                        }
                        return $img;
                    })
                    ->addColumn('action', function($row){
                        $valid = Validasi::where('user_id',$row->id)->first();                        
                        if($valid)
                        {
                            $btn = '<select class="form-control pilihValidasi" name="pilihValidasi" id="pilihValidasi_'.$row->id.'" data-id="'.$row->id.'" >';
                            $list = array('Baru','Valid','Tolak');
                            foreach($list as $l)
                            {
                                $valid = Validasi::where('user_id',$row->id)->where('status',$l)->first();                        
                                $selected = $valid ? 'selected' : '';
                                $btn = $btn.'<option value='.$l.' '.$selected.'>'.$l.'</option>';
                            }
                            $btn = $btn.'</select>';
                            return $btn;

                        }
                        
                    })
                    ->rawColumns(['action','bukti'])
                    ->make(true);
        }

        return view($folder.'.index',compact('title','url','folder'));
    }

    
    public function store(Request $request)
    {
        // dd($request->all());
        $daftar = Daftar::where('id',$request->id)->first();
        if($daftar)
        {
            Validasi::updateOrCreate(['user_id' => $daftar->id],
            [
            'status' => $request->status,
            'admin_id' => Auth::user()->id,
            ]);
            return response()->json(['success'=>$this->title.' Data Berhasil diSimpan.']);
        }else{
            return response()->json(['error'=>$this->title.' Data Gagal diSimpan.!!']);
        }
            
    }
}
