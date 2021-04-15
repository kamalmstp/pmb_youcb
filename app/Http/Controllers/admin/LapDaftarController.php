<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Gelombang;
use App\ThAkademik;
use App\Daftar;
use App\Formulir;


use Auth;
Use Alert;
use App\Kelas;
use App\Prodi;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;


class LapDaftarController extends Controller
{
    private $title = 'Laporan Daftar';
    private $url = 'admin/lapdaftar';
    private $folder = 'admin.lapdaftar';

    public function index(Request $request)
    {
        $title = $this->title;
        $url = $this->url;
        $folder = $this->folder;
        $list_thakademik = ThAkademik::orderBy('kode','DESC')->get();


        if ($request->ajax()) {

            $th_akademik_id = $request->th_akademik_id;
            $pmb_gelombang_id = $request->pmb_gelombang_id;

            $data = Daftar::
            where('level',2)
            ->where('th_akademik_id',$th_akademik_id)
            ->when($pmb_gelombang_id, function ($query) use ($pmb_gelombang_id) {
                return $query->where('pmb_gelombang_id',$pmb_gelombang_id);
            })
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
                    ->make(true);
        }

        return view($folder.'.index',compact('title','url','folder','list_thakademik'));
    }

    public function show($id)
    {
        $data = Gelombang::where('mst_th_akademik_id',$id)->get();
        echo '<option value="">-Semua-</option>';
        foreach($data as $row)
        {
            echo '<option value="'.$row->id.'">'.$row->gelombang.'</option>';
        }

    }    
}
