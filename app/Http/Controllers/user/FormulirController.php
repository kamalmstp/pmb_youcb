<?php

namespace App\Http\Controllers\user;

use DB;
use Auth;


use Validator;
Use Alert;
use App\Formulir;
use App\Gelombang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class FormulirController extends Controller
{
    

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
            'foto.image' => 'Pas Photo harus berektensi JPG, JPEG, PNG.',
            'foto.required' => 'Pas Photo Tidak Boleh Kosong',
            'foto.max' => 'Pas Photo ukuran tidak boleh dari 2MB',
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
            'foto' => 'required|image|max:2048',
        ],$msg);
        

        if ($validator->passes()) {

            $nomor = $this->generateNomor();
            $gelombang = Gelombang::where('aktif','Y')->first();

            $destinationPath = 'foto_users';
            $ext_file = $request->foto->getClientOriginalExtension();
            $file_name = Auth::user()->id.'.'.$ext_file;
            $request->foto->move($destinationPath, $file_name);

            Formulir::Create(
            [
                'nomor' => $nomor,
                'tanggal' => date('Y-m-d'),
                'th_akademik_id' => $gelombang->thakademik->id,
                'pmb_gelombang_id' => $gelombang->id,
                'kode_agent' => $request->kode_agent,
                'prodi_id' => $request->prodi_id,
                'kelas_id' => $request->kelas_id,
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
                'foto' => $file_name,
            ]);

            Alert::success('Formulir Peserta', 'Data berhasil disimpan.');

            return redirect('home');
        }else{
            Alert::error('Formulir Peserta', $validator->errors()->all());
            return redirect('home')
                        ->withErrors($validator)
                        ->withInput();
        }
    }

    private function generateNomor()
    {
        $th = date('Y');
        $row = Formulir::
        select(DB::raw('right(nomor,4) as nomor_akhir'))
        ->whereYear('tanggal',$th)
        ->orderBy('nomor','DESC')
        ->limit(1)
        ->first();
        if(isset($row))
        {
            $akhir = (int) $row->nomor_akhir+1;
            $return = $th.sprintf("%04s",$akhir);
        }else{
            $return = $th.'0001';
        }
        return $return;
    }
}
