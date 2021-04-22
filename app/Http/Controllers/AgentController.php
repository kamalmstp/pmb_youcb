<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Alur;
use App\Agent;

use Auth;
use Alert;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class AgentController extends Controller
{
    private $title = 'Agent yoUCB';
    private $url1 = 'agent_lembaga';
    private $url2 = 'agent_individu';
    private $view = 'agent';

    public function lembaga()
    {

        $title = 'Daftar Lembaga Sebagai ' . $this->title;
        $url = $this->url;
        $folder = $this->folder;

        return view('agent.lembaga');
    }

    public function create()
    {
        $title = 'Tambah Data ' . $this->title;
        $url = $this->url;
        $folder = $this->folder;
        $data = null;

        return view($folder . '.form', compact('title', 'url', 'folder', 'data'));
    }

    public function edit($id)
    {
        $title = 'Edit Data ' . $this->title;
        $url = $this->url;
        $folder = $this->folder;
        $data = Alur::find($id);

        return view($folder . '.form', compact('title', 'url', 'folder', 'data'));
    }

    public function lembaga_store(Request $request)
    {
        // dd($request->all());
        if (is_null($request->id)) {
            $msg = [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'nik.required' => 'NIK Tidak Boleh Kosong',
                'nik.numeric' => 'NIK Harus Angka',
                'nik.unique' => 'NIK Sudah Terdaftar, NIK Tidak Bisa di Daftarkan 2 Kali',
                'tempat_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong',
                'tanggal_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong',
                'telepon.required' => 'Telepon Tidak Boleh Kosong',
                'telepon.min' => 'Telepon Tidak Boleh Kurang dari 5 Angka',
                'telepon.numeric' => 'Telepon Hanya Boleh Diisi Angka',
                'telepon.max' => 'Telepon Hanya Boleh Maksimal 15 Angka',
                'email.required' => 'Email Tidak Boleh Kosong',
                'email.unique' => 'Email Sudah Pernah Terdaftar',
                'alamat.required' => 'Alamat Tidak Boleh Kosong',
                'pekerjaan.required' => 'Pekerjaan Tidak Boleh Kosong',
                'validasi.required' => 'Anda Belum Menyetujui Syarat dan Ketentuan Kebijakan Privasi',
            ];
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'nik' => 'required|numeric|unique:pmb_agent,nik',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'telepon' => 'required|min:5|max:15|numeric',
                'email' => 'required|email|unique:pmb_agent,email',
                'alamat' => 'required',
                'pekerjaan' => 'required',
                'validasi' => 'required',
            ], $msg);
        } else {
            $msg = [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'nik.required' => 'NIK Tidak Boleh Kosong',
                'nik.numeric' => 'NIK Harus Angka',
                'nik.unique' => 'NIK Sudah Terdaftar, NIK Tidak Bisa di Daftarkan 2 Kali',
                'tempat_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong',
                'tanggal_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong',
                'telepon.required' => 'Telepon Tidak Boleh Kosong',
                'telepon.min' => 'Telepon Tidak Boleh Kurang dari 5 Angka',
                'telepon.numeric' => 'Telepon Hanya Boleh Diisi Angka',
                'telepon.max' => 'Telepon Hanya Boleh Maksimal 15 Angka',
                'email.required' => 'Email Tidak Boleh Kosong',
                'email.unique' => 'Email Sudah Pernah Terdaftar',
                'alamat.required' => 'Alamat Tidak Boleh Kosong',
                'pekerjaan.required' => 'Pekerjaan Tidak Boleh Kosong',
                'validasi.required' => 'Anda Belum Menyetujui Syarat dan Ketentuan Kebijakan Privasi',
            ];
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'nik' => 'required|numeric|unique:pmb_agent,nik',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'telepon' => 'required|min:5|max:15|numeric',
                'email' => 'required|email|unique:pmb_agent,email',
                'alamat' => 'required',
                'pekerjaan' => 'required',
                'validasi' => 'required',
            ], $msg);
        }


        if ($validator->passes()) {

            $jml = (Agent::where('kode_ucb', '03')->count()) + 1;
            if ($jml > 9) {
                $depan = '0';
            } elseif ($jml > 99) {
                $depan = '';
            } else {
                $depan = '00';
            }

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
                'jabatan' => $request->jabatan,
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'alamat' => $request->alamat,
                'nama_lembaga' => $request->nama_lembaga,
                'telepon_kantor' => $request->telepon_kantor,
                'alamat_kantor' => $request->alamat_kantor,
                'kode_ucb' => '03',
                'nomor_daftar' => $jml,
                'kode_agent' => $depan . $jml . '-03',
                'valid' => 'W',
            ]);

            Alert::success($this->title, 'Data berhasil disimpan.');

            return redirect($this->url1);
        }
        // dd($validator->errors()->all());
        Alert::error('title', 'Error');
        return redirect($this->url1);
    }

    public function individu_store(Request $request)
    {
        // dd($request->all());
        if (is_null($request->id)) {
            $msg = [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'nik.required' => 'NIK Tidak Boleh Kosong',
                'nik.numeric' => 'NIK Harus Angka',
                'nik.unique' => 'NIK Sudah Terdaftar, NIK Tidak Bisa di Daftarkan 2 Kali',
                'tempat_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong',
                'tanggal_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong',
                'telepon.required' => 'Telepon Tidak Boleh Kosong',
                'telepon.min' => 'Telepon Tidak Boleh Kurang dari 5 Angka',
                'telepon.numeric' => 'Telepon Hanya Boleh Diisi Angka',
                'telepon.max' => 'Telepon Hanya Boleh Maksimal 15 Angka',
                'email.required' => 'Email Tidak Boleh Kosong',
                'email.unique' => 'Email Sudah Pernah Terdaftar',
                'alamat.required' => 'Alamat Tidak Boleh Kosong',
                'pekerjaan.required' => 'Pekerjaan Tidak Boleh Kosong',
                'validasi.required' => 'Anda Belum Menyetujui Syarat dan Ketentuan Kebijakan Privasi',
            ];
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'nik' => 'required|numeric|unique:pmb_agent,nik',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'telepon' => 'required|min:5|max:15|numeric',
                'email' => 'required|email|unique:pmb_agent,email',
                'alamat' => 'required',
                'pekerjaan' => 'required',
                'validasi' => 'required',
            ], $msg);
        } else {
            $msg = [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'nik.required' => 'NIK Tidak Boleh Kosong',
                'nik.numeric' => 'NIK Harus Angka',
                'nik.unique' => 'NIK Sudah Terdaftar, NIK Tidak Bisa di Daftarkan 2 Kali',
                'tempat_lahir.required' => 'Tempat Lahir Tidak Boleh Kosong',
                'tanggal_lahir.required' => 'Tanggal Lahir Tidak Boleh Kosong',
                'telepon.required' => 'Telepon Tidak Boleh Kosong',
                'telepon.min' => 'Telepon Tidak Boleh Kurang dari 5 Angka',
                'telepon.numeric' => 'Telepon Hanya Boleh Diisi Angka',
                'telepon.max' => 'Telepon Hanya Boleh Maksimal 15 Angka',
                'email.required' => 'Email Tidak Boleh Kosong',
                'email.unique' => 'Email Sudah Pernah Terdaftar',
                'alamat.required' => 'Alamat Tidak Boleh Kosong',
                'pekerjaan.required' => 'Pekerjaan Tidak Boleh Kosong',
                'validasi.required' => 'Anda Belum Menyetujui Syarat dan Ketentuan Kebijakan Privasi',
            ];
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'nik' => 'required|numeric|unique:pmb_agent,nik',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'telepon' => 'required|min:5|max:15|numeric',
                'email' => 'required|email|unique:pmb_agent,email',
                'alamat' => 'required',
                'pekerjaan' => 'required',
                'validasi' => 'required',
            ], $msg);
        }
        // dd($validator->errors()->all());

        if ($validator->passes()) {

            $jml = (Agent::where('kode_ucb', '02')->count()) + 1;
            if ($jml > 9) {
                $depan = '0';
            } elseif ($jml > 99) {
                $depan = '';
            } else {
                $depan = '00';
            }

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
            ]);

            Alert::success($this->title, 'Data berhasil disimpan.');

            return redirect($this->url2);
        }

        Alert::error('title', $validator->errors()->all());
        return redirect($this->url2);
    }


    public function destroy($id)
    {
        Alur::find($id)->delete();
        return response()->json(['success' => $this->title . ' Berhasil Dihapus.']);
    }

    public function get_agent(Request $request)
    {
        $agent = Agent::where('kode_agent', $request->get('kode_agent'))->pluck('name');

        return response()->json($agent);
    }
}
