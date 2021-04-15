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
use App\Lulus;
use App\Prodi;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class LapLulusController extends Controller
{
    private $title = 'Laporan Kelulusan';
    private $url = 'admin/laplulus';
    private $folder = 'admin.laplulus';

    public function index(Request $request)
    {
        $title = $this->title;
        $url = $this->url;
        $folder = $this->folder;
        $list_thakademik = ThAkademik::orderBy('kode','DESC')->get();
        $list_prodi = Prodi::orderBy('kode')->get();
        $list_kelas = Kelas::where('table','Kelas')->get();

        if ($request->ajax()) {

            $th_akademik_id = $request->th_akademik_id;
            $pmb_gelombang_id = $request->pmb_gelombang_id;
            $prodi_id = $request->prodi_id;
            $kelas_id = $request->kelas_id;

            $data = Lulus::
            where('th_akademik_id',$th_akademik_id)
            ->when($pmb_gelombang_id, function ($query) use ($pmb_gelombang_id) {
                return $query->where('pmb_gelombang_id',$pmb_gelombang_id);
            })
            ->when($prodi_id, function ($query) use ($prodi_id) {
                return $query->where('prodi_id',$prodi_id);
            })
            ->when($kelas_id, function ($query) use ($kelas_id) {
                return $query->where('kelas_id',$kelas_id);
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
                    ->addColumn('nomor',function($row){
                        return @$row->formulir->nomor;
                    })
                    ->addColumn('nama',function($row){
                        return @$row->formulir->nama;
                    })
                    ->addColumn('prodi',function($row){
                        return @$row->prodi->nama;
                    })
                    ->addColumn('kelas',function($row){
                        return @$row->kelas->nama;
                    })
                    ->make(true);
        }

        return view($folder.'.index',compact('title','url','folder','list_thakademik','list_prodi','list_kelas'));
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
