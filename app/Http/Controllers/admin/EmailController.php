<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use Auth;
use Alert;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class EmailController extends Controller
{
    private $title = 'Kirim Email';
    private $url = 'admin/email';
    private $folder = 'admin.email';

    public function index(Request $request)
    {

        $title = $this->title;
        $url = $this->url;
        $folder = $this->folder;

        if ($request->ajax()) {
            $data = Email::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('lblaktif', function ($row) {
                    if ($row->publish == 'Y') {
                        $hasil = '<i class="fa fa-check-circle text-success"></i>';
                    } else {
                        $hasil = '';
                    }
                    return $hasil;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group">';
                    $btn = $btn . '<a href="' . url($this->url . '/' . $row->id . '/edit') . '" data-toggle="tooltip"  data-original-title="Edit" title="Edit" class="edit btn btn-primary btn-xs editBtn"> <i class="far fa-edit"></i> </a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" title="Hapus" class="btn btn-danger btn-xs deleteBtn"> <i class="far fa-trash-alt"></i> </a>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action', 'lblaktif'])
                ->make(true);
        }

        // return view($folder . '.index', compact('title', 'url', 'folder'));
        return view('email.kirim');
    }

    public function test(Request $request)
    {
        if (is_null($request->id)) {
            $msg = [
                'kepada.required' => 'Kepada Tidak Boleh Kosong',
                'subject.required' => 'Subject Tidak Boleh Kosong',
                'pesan.required' => 'Pesan Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(), [
                'kepada' => 'required',
                'subject' => 'required',
                'pesan' => 'required',
            ], $msg);
        } else {
            $msg = [
                'kepada.required' => 'Kepada Tidak Boleh Kosong',
                'subject.required' => 'Subject Tidak Boleh Kosong',
                'pesan.required' => 'Pesan Tidak Boleh Kosong'
            ];
            $validator = Validator::make($request->all(), [
                'kepada' => 'required',
                'subject' => 'required',
                'pesan' => 'required',
            ], $msg);
        }


        if ($validator->passes()) {

            $pesan = $request->pesan;

            return view( 'email.kirim', compact('pesan'));
        }
    }

    public function create()
    {
        $title = 'Tambah Data ' . $this->title;
        $url = $this->url;
        $folder = $this->folder;
        $data = null;

        return view($folder . '.form', compact('title', 'url', 'folder', 'data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if (is_null($request->id)) {
            $msg = [
                'kepada.required' => 'Kepada Tidak Boleh Kosong',
                'subject.required' => 'Subject Tidak Boleh Kosong',
                'pesan.required' => 'Pesan Tidak Boleh Kosong',
            ];
            $validator = Validator::make($request->all(), [
                'kepada' => 'required',
                'subject' => 'required',
                'pesan' => 'required',
            ], $msg);
        } else {
            $msg = [
                'kepada.required' => 'Kepada Tidak Boleh Kosong',
                'subject.required' => 'Subject Tidak Boleh Kosong',
                'pesan.required' => 'Pesan Tidak Boleh Kosong'
            ];
            $validator = Validator::make($request->all(), [
                'kepada' => 'required',
                'subject' => 'required',
                'pesan' => 'required',
            ], $msg);
        }


        if ($validator->passes()) {

            try {
                Mail::send('email.kirim', ['pesan' => $request->pesan], function ($message) use ($request) {
                    $message->subject($request->subject);
                    $message->from('noreply.youcb@gmail.com', 'PMB yoUCB');
                    $message->to($request->kepada);
                });
                Alert::success($this->title, 'Data berhasil disimpan.');
                return redirect('home');
            } catch (Exception $e) {
                return response(['status' => false, 'errors' => $e->getMessage()]);
            }

            return redirect($this->url);
        }
        // dd($validator->errors()->all());
        Alert::error('tite', 'Error');
    }


    public function destroy($id)
    {
        Email::find($id)->delete();
        return response()->json(['success' => $this->title . ' Berhasil Dihapus.']);
    }
}
