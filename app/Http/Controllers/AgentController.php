<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinsi;
use Validator;
use App\Agent;

class AgentController extends Controller
{
    public function agent()
    {
        $title = 'Agent yoUCB';

        return view('agent', compact('title'));
    }

    public function agent_individu()
    {
        $prov = Provinsi::pluck('name', 'id');
        $title = 'Daftar Individu Sebagai Agent yoUCB';
        return view('agent.individu', compact('title', 'prov'));
    }

    public function agent_lembaga()
    {
        $prov = Provinsi::pluck('name', 'id');
        $title = 'Daftar Lembaga Sebagai Agent yoUCB';
        return view('agent.lembaga', compact('title', 'prov'));
    }

    public function success()
    {
        $title = 'Sukses Daftar Individu Sebagai Agent yoUCB';
        return view('agent.success', compact('title'));
    }

    public function individu_store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'nik' => 'required|numeric|unique:pmb_agent|min:16',
            'email' => 'required|email|unique:pmb_agent',
            'telepon' => 'required|numeric',
            'pekerjaan' => 'required',
            'instansi' => 'required',
            'alamat' => 'required',
            'validasi' => 'required',
            'ktp' => 'required|image|max:2048',
        ];
        $messages = [
            'nama.required' => 'Nama tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.numeric' => 'NIK hanya boleh diisi angka',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.min' => 'NIK minimal 16 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'telepon.required' => 'Telepon tidak boleh kosong',
            'telepon.numeric' => 'Telepon hanya boleh diisi angka',
            'pekerjaan.required' => 'Pekerjaan tidak boleh kosong',
            'instansi.required' => 'Instansi tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'validasi.required' => 'Anda harus menyetujui syarat & ketentuan',
            'ktp.image' => 'File harus berektensi JPG, JPEG, PNG.',
            'ktp.required' => 'File Tidak Boleh Kosong',
            'ktp.max' => 'File ukuran tidak boleh dari 2Mb',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $jml = (Agent::where('kode_ucb', '02')->count()) + 1;
        if ($jml > 9) {
            $depan = '0';
        } elseif ($jml > 99) {
            $depan = '';
        } else {
            $depan = '00';
        }

        $destinationPath = 'ktp';
        $ext_file = $request->ktp->getClientOriginalExtension();
        $file_name = uniqid() . '.' . $ext_file;
        $request->ktp->move($destinationPath, $file_name);

        Agent::create([
            'name' => $request->nama,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'pekerjaan' => $request->pekerjaan,
            'instansi' => $request->instansi,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'alamat' => $request->alamat,
            'kode_ucb' => '02',
            'nomor_daftar' => $jml,
            'kode_agent' => $depan . $jml . '-02',
            'valid' => 'W',
            'file' => $file_name,
        ]);

        return redirect('success');
    }

    public function lembaga_store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'nik' => 'required|numeric|unique:pmb_agent|min:16',
            'email' => 'required|email|unique:pmb_agent',
            'telepon' => 'required|numeric',
            'jabatan' => 'required',
            'alamat' => 'required',
            'nama_lembaga' => 'required',
            'telepon_kantor' => 'required',
            'alamat_kantor' => 'required',
            'validasi' => 'required',
            'ktp' => 'required|image|max:2048',
        ];
        $messages = [
            'nama.required' => 'Nama tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.numeric' => 'NIK hanya boleh diisi angka',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.min' => 'NIK minimal 16 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'telepon.required' => 'Telepon tidak boleh kosong',
            'telepon.numeric' => 'Telepon hanya boleh diisi angka',
            'jabatan.required' => 'Pekerjaan tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'nama_lembaga.required' => 'Nama Lembaga tidak boleh kosong',
            'telepon_kantor.required' => 'Telepon Kantor tidak boleh kosong',
            'alamat_kantor.required' => 'Alamat Kantor tidak boleh kosong',
            'validasi.required' => 'Anda harus menyetujui syarat & ketentuan',
            'ktp.image' => 'File harus berektensi JPG, JPEG, PNG.',
            'ktp.required' => 'File Tidak Boleh Kosong',
            'ktp.max' => 'File ukuran tidak boleh dari 2Mb',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $jml = (Agent::where('kode_ucb', '03')->count()) + 1;
        if ($jml > 9) {
            $depan = '0';
        } elseif ($jml > 99) {
            $depan = '';
        } else {
            $depan = '00';
        }

        $destinationPath = 'ktp';
        $ext_file = $request->ktp->getClientOriginalExtension();
        $file_name = uniqid() . '.' . $ext_file;
        $request->ktp->move($destinationPath, $file_name);

        Agent::create([
            'name' => $request->nama_lembaga,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'jabatan' => $request->jabatan,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'alamat' => $request->alamat,
            'nama_pj' => $request->nama,
            'telepon_kantor' => $request->telepon_kantor,
            'alamat_kantor' => $request->alamat_kantor,
            'kode_ucb' => '03',
            'nomor_daftar' => $jml,
            'kode_agent' => $depan . $jml . '-03',
            'valid' => 'W',
            'file' => $file_name,
        ]);

        return redirect('success');
    }

    public function get_agent(Request $request)
    {
        $cek = Agent::where('kode_agent', $request->get('kode_agent'))->where('valid', 'Y')->count();
        if ($cek == 0) {
            $agent = 'Kode Agent Tidak Tersedia, Harap Periksa';
        } else {
            $agent = Agent::where('kode_agent', $request->get('kode_agent'))->where('valid', 'Y')->pluck('name');
        }

        return response()->json($agent);
    }
}
