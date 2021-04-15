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
use App\DokumenPersyaratan;
use App\JenisKelamin;
use App\Kelas;
use App\Kota;
use App\Prodi;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class FormulirController extends Controller
{
    private $title = 'Formulir';
    private $url = 'admin/formulir';
    private $folder = 'admin.formulir';

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
                    ->addColumn('file_foto',function($row){
                        if($row->foto)
                        {
                            $img ='<div class="image">';
                            $img = $img.'<a href="/foto_users/'.$row->foto.'" target="_blank">';
                            $img = $img.'<img src="/foto_users/'.$row->foto.'" class="img-circle elevation-2" alt="User Image" width="30">';
                            $img = $img.'</a>';
                            $img = $img.'</div>';
                        }else{
                            $img = null;
                        }
                            
                        
                        return $img;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group">';
                        $syarat = DokumenPersyaratan::where('pmb_formulir_id',$row->id)->count();
                        if($syarat>0)
                        {
                            $invalid = DokumenPersyaratan::where('pmb_formulir_id',$row->id)
                            ->where('valid','N')->count();
                            if($invalid>0)
                            {
                                $btn = $btn.'<a href="javascript:void(0)"  class="btn btn-warning btn-xs" title="Validasi Persyaratan"> '.$syarat.' </a>';
                            }else{
                                $btn = $btn.'<a href="javascript:void(0)"  class="btn btn-info btn-xs" title="Validasi Persyaratan"> '.$syarat.' </a>';
                            }
                            
                            
                        }
                        $btn = $btn.'<a href="'.url($this->url.'/'.$row->id).'" data-toggle="tooltip"   data-original-title="Show" title="Show" class="btn btn-success btn-xs" title="Lihat Data"> <i class="far fa-eye"></i> </a>';
                        $btn = $btn.'<a href="'.url($this->url.'/'.$row->id.'/edit').'" data-toggle="tooltip"   data-original-title="Edit" title="Edit" class="edit btn btn-primary btn-xs editBtn" title="Edit Data"> <i class="far fa-edit"></i> </a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" title="Hapus" class="btn btn-danger btn-xs deleteBtn" title="Hapus Data"> <i class="far fa-trash-alt"></i> </a>';
                        $btn = $btn.'</div>';
                        return $btn;
                    })
                    ->rawColumns(['action','file_foto'])
                    ->make(true);
        }

        return view($folder.'.index',compact('title','url','folder','list_thakademik','list_prodi','list_kelas'));
    }

    

    public function edit($id)
    {
        
        $url = $this->url;
        $folder = $this->folder;
        $formulir = Formulir::find($id);
        // $syarat = DokumenPersyaratan::where('pmb_formulir_id',$formulir->id)->get();

        $gelombang = Gelombang::where('aktif','Y')->first();

        $list_kota = Kota::orderBy('province_id')->get();
        $list_prodi = Prodi::orderBy('kode')->get();
        $list_kelas = Kelas::where('table','Kelas')->get();
        $list_jk = JenisKelamin::where('table','JenisKelamin')->get();

        $title = 'Edit '.$this->title.' Calon Mahasiswa Nomor '.$formulir->nomor.' Nama  '.$formulir->nama;

        return view($folder.'.edit',compact('title','url','folder','formulir','list_kota','list_prodi','list_kelas','list_jk','gelombang'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        
        $msg = [
            'prodi_id.required' => 'Program Studi Tidak Boleh Kosong',
            'kelas_id.required' => 'Kelas Tidak Boleh Kosong',
            'nik.required' => 'NIK Tidak Boleh Kosong',
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nik.required' => 'NIK Tidak Boleh Kosong',
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'jk_id.required' => 'Jenis Kelamin Tidak Boleh Kosong',
            'tempat_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong',
            'tanggal_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong',
            'agama.required' => 'Agama Tidak Boleh Kosong',
            'gol_darah.required' => 'Golongan Darah Tidak Boleh Kosong',
            'tinggi_badan.required' => 'Tinggi Badan Tidak Boleh Kosong',
            'berat_badan.required' => 'Berat Badan Tidak Boleh Kosong',
            'desa.required' => 'Desa / Kelurahan Tidak Boleh Kosong',
            'kecamatan.required' => 'Kecamatan Tidak Boleh Kosong',
            'kota_id.required' => 'Kabupaten / Kota Tidak Boleh Kosong',
            'provinsi.required' => 'Provinsi Tidak Boleh Kosong',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
            'hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'email.required' => 'Email Tidak Boleh Kosong',
            'nilai_terakhir.required' => 'Nilai Terakhir Tidak Boleh Kosong',
            'sd.required' => 'SD / MI Tidak Boleh Kosong',
            'smp.required' => 'SMP / MTs Tidak Boleh Kosong',
            'sma.required' => 'SMA / SMK / MA Tidak Boleh Kosong',
            'nik_ayah.required' => 'NIK Ayah Tidak Boleh Kosong',
            'nama_ayah.required' => 'Nama Ayah Tidak Boleh Kosong',
            'pekerjaan_ayah.required' => 'Pekerjaan Ayah Tidak Boleh Kosong',
            'pendidikan_ayah.required' => 'Pendidikan Ayah Tidak Boleh Kosong',
            'penghasilan_ayah.required' => 'Penghasilan Ayah Tidak Boleh Kosong',
            'no_ayah.required' => 'No. Ayah Tidak Boleh Kosong',
            'alamat_ayah.required' => 'Alamat Ayah Tidak Boleh Kosong',
            'nik_ibu.required' => 'NIK Ibu Tidak Boleh Kosong',
            'nama_ibu.required' => 'Nama Ibu Tidak Boleh Kosong',
            'pekerjaan_ibu.required' => 'Pekerjaan Ibu Tidak Boleh Kosong',
            'pendidikan_ibu.required' => 'Pendidikan Ibu Tidak Boleh Kosong',
            'penghasilan_ibu.required' => 'Penghasilan Ibu Tidak Boleh Kosong',
            'no_ibu.required' => 'No. Ibu Tidak Boleh Kosong',
            'alamat_ibu.required' => 'Alamat Ibu Tidak Boleh Kosong',
        ];
        $validator = Validator::make($request->all(),[
            'prodi_id' => 'required',
            'kelas_id' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'jk_id' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'gol_darah' => 'required',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kota_id' => 'required',
            'provinsi' => 'required',
            'alamat' => 'required',
            'hp' => 'required',
            'email' => 'required',
            'nilai_terakhir' => 'required',
            'sd' => 'required',
            'smp' => 'required',
            'sma' => 'required',
            'nik_ayah' => 'required',
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'penghasilan_ayah' => 'required',
            'no_ayah' => 'required',
            'alamat_ayah' => 'required',
            'nik_ibu' => 'required',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'penghasilan_ibu' => 'required',
            'no_ibu' => 'required',
            'alamat_ibu' => 'required',
        ],$msg);
        

        if ($validator->passes()) {

            Formulir::updateOrCreate(['id' => $request->id],
            [
                'prodi_id' => $request->prodi_id,
                'kelas_id' => $request->kelas_id,
                'kode_agent' => $request->kode_agent,
                'nik' => $request->nik,
                'nisn' => $request->nisn,
                'nama' => $request->nama,
                'jk_id' => $request->jk_id,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'agama' => $request->agama,
                'gol_darah' => $request->gol_darah,
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => $request->berat_badan,
                'desa' => $request->desa,
                'kecamatan' => $request->kecamatan,
                'kota_id' => $request->kota_id,
                'provinsi' => $request->provinsi,
                'alamat' => $request->alamat,
                'hp' => $request->hp,
                'email' => $request->email,
                'nilai_terakhir' => $request->nilai_terakhir,
                'sd' => $request->sd,
                'smp' => $request->smp,
                'sma' => $request->sma,
                'nik_ayah' => $request->nik_ayah,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'penghasilan_ayah' => $request->penghasilan_ayah,
                'no_ayah' => $request->no_ayah,
                'alamat_ayah' => $request->alamat_ayah,
                'nik_ibu' => $request->nik_ibu,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'penghasilan_ibu' => $request->penghasilan_ibu,
                'no_ibu' => $request->no_ibu,
                'alamat_ibu' => $request->alamat_ibu,
                'nik_wali' => $request->nik_wali,
                'nama_wali' => $request->nama_wali,
                'pekerjaan_wali' => $request->pekerjaan_wali,
                'pendidikan_wali' => $request->pendidikan_wali,
                'penghasilan_wali' => $request->penghasilan_wali,
                'no_wali' => $request->no_wali,
                'alamat_wali' => $request->alamat_wali,
                'user_id' => Auth::user()->id,
            ]);

            Alert::success('Formulir Peserta', 'Data berhasil disimpan.');

            return redirect($this->url);
        }
    }

    public function show($id)
    {
        $url = $this->url;
        $folder = $this->folder;
        $formulir = Formulir::find($id);

        $title = $this->title.' Calon Mahasiswa Nomor '.$formulir->nomor.' Nama  '.$formulir->nama;

        return view($folder.'.form',compact('title','url','folder','formulir'));

    }

    public function listGelombang($id)
    {
        $data = Gelombang::where('mst_th_akademik_id',$id)->get();
        echo '<option value="">-Semua-</option>';
        foreach($data as $row)
        {
            echo '<option value="'.$row->id.'">'.$row->gelombang.'</option>';
        }

    }


    public function destroy($id)
    {
        Formulir::find($id)->delete();
        return response()->json(['success'=>$this->title.' Berhasil Dihapus.']);
    }

    public function simpanSyaratValid(Request $request)
    {
        // dd($request->all());
        $valid = DokumenPersyaratan::where('pmb_formulir_id',$request->id_formulir)
        ->where('id',$request->id_dok)->first();
        $valid->valid = $request->valid;
        $valid->save();
        return response()->json(['success'=>$this->title.' Berhasil DiSimpan.']);
    }
}
