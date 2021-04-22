<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Agent;

use Auth;
use Alert;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AgentIndividuController extends Controller
{
    private $title = 'Agent Individu';
    private $url = 'admin/agent_individu';
    private $folder = 'admin.agent';

    public function index(Request $request)
    {
        $title = $this->title;
        $url = $this->url;
        $folder = $this->folder;

        if ($request->ajax()) {
            $data = Agent::where('kode_ucb', '02')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('kode_agent', function ($row) {
                    return @$row->kode_agent;
                })
                ->addColumn('name', function ($row) {
                    return @$row->name;
                })
                ->addColumn('lblaktif', function ($row) {
                    if ($row->valid == 'Y') {
                        $hasil = '<i class="fa fa-check-circle text-success"></i>';
                    } else {
                        $hasil = '';
                    }
                    return $hasil;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group">';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" title="View" class="btn btn-success btn-xs viewBtn"> <i class="fas fa-eye"></i> </a>';
                    $btn = $btn . '<a href="' . url($this->url . '/' . $row->id . '/edit') . '" data-toggle="tooltip"  data-original-title="Edit" title="Edit" class="edit btn btn-primary btn-xs editBtn"> <i class="far fa-edit"></i> </a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" title="Hapus" class="btn btn-danger btn-xs deleteBtn"> <i class="far fa-trash-alt"></i> </a>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action', 'lblaktif'])
                ->make(true);
        }

        return view($folder . '.individu', compact('title', 'url', 'folder'));
    }

    public function create()
    {
        $title = 'Tambah Data ' . $this->title;
        $url = $this->url;
        $folder = $this->folder;
        $data = null;

        return view($folder . '.individu_form', compact('title', 'url', 'folder', 'data'));
    }

    public function edit($id)
    {
        $title = 'Edit Data ' . $this->title;
        $url = $this->url;
        $folder = $this->folder;
        $data = Agent::find($id);

        return view($folder . '.individu_form', compact('title', 'url', 'folder', 'data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if (is_null($request->id)) {
            $msg = [
                'name.required' => 'Nama Tidak Boleh Kosong',
                'nik.required' => 'NIK Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'telepon.required' => 'Telepon Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'nik' => 'required|min:2',
                'email' => 'required',
                'telepon' => 'required',
            ], $msg);
        } else {
            $msg = [
                'name.required' => 'Nama Tidak Boleh Kosong',
                'nik.required' => 'NIK Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'telepon.required' => 'Telepon Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'nik' => 'required|min:2',
                'email' => 'required',
                'telepon' => 'required',
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

            Agent::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'nik' => $request->nik,
                    'email' => $request->email,
                    'telepon' => $request->telepon,
                    'alamat' => $request->alamat,
                    'kode_ucb' => '02',
                    'nomor_daftar' => $jml,
                    'kode_agent' => $depan . $jml . '-02',
                    'valid' => 'W',
                ]
            );

            Alert::success($this->title, 'Data berhasil disimpan.');

            return redirect($this->url);
        }
    }


    public function update(Request $request)
    {
        // dd($request->all());
        $data = Agent::find($request->id);
        $data->password = Hash::make($data->telp);
        $data->save();
        return response()->json(['success' => $this->title . ' Password Berhasil DiReset.']);
    }

    public function destroy($id)
    {
        Agent::find($id)->delete();
        return response()->json(['success' => $this->title . ' Berhasil Dihapus.']);
    }
}
