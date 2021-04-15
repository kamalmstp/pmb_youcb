<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Prodi;

use Auth;
Use Alert;
use Validator;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class ProdiController extends Controller
{
    private $title = 'Program Studi';
    private $url = 'admin/prodi';
    private $folder = 'admin.prodi';

    public function index(Request $request)
    {

        $title = $this->title;
        $url = $this->url;
        $folder = $this->folder;

        if ($request->ajax()) {
            $data = Prodi::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('lblaktif',function($row){
                        if($row->aktif=='Y')
                        {
                            $hasil = '<i class="fa fa-check-circle text-success"></i>';
                        }else{
                            $hasil = '';
                        }
                        return $hasil;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group">';
                        $btn = $btn.'<a href="'.url($this->url.'/'.$row->id.'/edit').'" data-toggle="tooltip"  data-original-title="Edit" title="Edit" class="edit btn btn-primary btn-xs editBtn"> <i class="far fa-edit"></i> </a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" title="Hapus" class="btn btn-danger btn-xs deleteBtn"> <i class="far fa-trash-alt"></i> </a>';
                        $btn = $btn.'</div>';
                        return $btn;
                    })
                    ->rawColumns(['action','lblaktif'])
                    ->make(true);
        }

        return view($folder.'.index',compact('title','url','folder'));
    }
}
