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
                'telepon.required' => 'Telepon Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'nama_pj.required' => 'Nama Penanggungjawab Tidak Boleh Kosong',
                'nomor_pj.required' => 'Nomor Penanggungjawab Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'telepon' => 'required',
                'email' => 'required',
                'nama_pj' => 'required',
                'nomor_pj' => 'required',
            ], $msg);
        } else {
            $msg = [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'telepon.required' => 'Telepon Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'nama_pj.required' => 'Nama Penanggungjawab Tidak Boleh Kosong',
                'nomor_pj.required' => 'Nomor Penanggungjawab Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'telepon' => 'required',
                'email' => 'required',
                'nama_pj' => 'required',
                'nomor_pj' => 'required',
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
                'telepon' => $request->telepon,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'nama_pj' => $request->nama_pj,
                'nomor_pj' => $request->nomor_pj,
                'kode_ucb' => '03',
                'nomor_daftar' => $jml,
                'kode_agent' => $depan . $jml . '-03',
            ]);

            Alert::success($this->title, 'Data berhasil disimpan.');

            return redirect($this->url1);
        }
        // dd($validator->errors()->all());
        Alert::error('tite', 'Error');
        return redirect($this->url);
    }

    public function individu_store(Request $request)
    {
        // dd($request->all());
        if (is_null($request->id)) {
            $msg = [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'nik.required' => 'NIK Tidak Boleh Kosong',
                'telepon.required' => 'Telepon Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'alamat.required' => 'Alamat Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'nik' => 'required',
                'telepon' => 'required',
                'email' => 'required',
                'alamat' => 'required',
            ], $msg);
        } else {
            $msg = [
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'nik.required' => 'NIK Tidak Boleh Kosong',
                'telepon.required' => 'Telepon Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'alamat.required' => 'Alamat Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'nik' => 'required',
                'telepon' => 'required',
                'email' => 'required',
                'alamat' => 'required',
            ], $msg);
        }


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
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'alamat' => $request->alamat,
                'kode_ucb' => '02',
                'nomor_daftar' => $jml,
                'kode_agent' => $depan . $jml . '-02',
            ]);

            Alert::success($this->title, 'Data berhasil disimpan.');

            return redirect($this->url2);
        }
        // dd($validator->errors()->all());
        Alert::error('tite', 'Error');
        return redirect($this->url);
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
