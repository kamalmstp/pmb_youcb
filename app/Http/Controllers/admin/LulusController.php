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
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class LulusController extends Controller
{
    private $title = 'Kelulusan';
    private $url = 'admin/lulus';
    private $folder = 'admin.lulus';

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

            $data = Formulir::
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
                    ->addColumn('prodi',function($row){
                        return @$row->prodi->nama;
                    })
                    ->addColumn('kelas',function($row){
                        return @$row->kelas->nama;
                    })
                    ->addColumn('tgl',function($row){
                        return with(new Carbon($row->created_at))->format('d-m-Y');
                    })
                    ->addColumn('action', function($row){
                        $btn = '<select class="form-control pilihLulus" name="pilihLulus" id="pilihLulus_'.$row->id.'" data-id="'.$row->id.'" >';
                        $lulus = Lulus::where('pmb_formulir_id',$row->id)->first();
                        $selected = $lulus ? 'selected' : '';
                        $btn= $btn.'<option value="Gagal">Gagal</option>';
                        $btn= $btn.'<option value="Lulus" '.$selected.'>Lulus</option>';
                        $btn = $btn.'</select>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
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

    public function store(Request $request)
    {
        // dd($request->all());
        $formulir = Formulir::where('id',$request->id)->first();
        if($formulir)
        {
            
            $data = Lulus::where('pmb_formulir_id',$request->id)->first();

            if($request->status=='Lulus')
            {
                if(!$data)
                {
                    $data = new Lulus;
                    
                }
                $data->th_akademik_id = $formulir->th_akademik_id;
                $data->pmb_gelombang_id = $formulir->pmb_gelombang_id;
                $data->pmb_formulir_id = $request->id;
                $data->prodi_id = $formulir->prodi_id;
                $data->kelas_id = $formulir->kelas_id;
                $data->user_id = Auth::user()->id;
                $data->save();
            }else{
                $data->delete();
            }
            return response()->json(['success'=>$this->title.' Data Berhasil diSimpan.']);
        }else{
            return response()->json(['error'=>$this->title.' Data Gagal diSimpan.!!']);
        }
            
    }
}
