<?php

namespace App\Http\Controllers\Dashboard\Video;

use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:مستخدم,مدير,محرر');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Video::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $showUrl = url('dashboard/video/'.$row->id);
                    $editUrl = url('dashboard/video/'.$row->id.'/edit');

                    $action =
                        '
<a class="btn btn-success btn-sm shadow" href="'.$editUrl.'" ><i class="fa fa-edit" aria-hidden="true"></i></i> تعديل  </a>
<meta name="csrf-token" content="{{ csrf_token() }}">
<a  class="btn btn-danger btn-sm text-white shadow delete-video" id="delete-video" data-id='.$row->id.'><i class="fa fa-trash-alt" aria-hidden="true"></i>  حذف</a>';

                    return $action;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.video.index');
    }



    public function create()
    {
        return view('dashboard.video.create');
    }

    public function store(Request $request)
    {
        $video= new Video;


        $video->title=$request->get('title');
        $video->video_id=$request->get('video_id');

        $video->save();
        return redirect()->route('video.index')->with(['success'=>'تمت الاضافة بنجاح']);
    }

    public function edit($id)
    {
        $video = Video::find($id);
        return view('dashboard.video.edit',compact('video','id'));
    }


    public function update(Request $request, $id)
    {
        $video= Video::find($id);


        $video->title=$request->get('title');
        $video->video_id=$request->get('video_id');

        $video->save();
        return redirect('dashboard/video')->with('success', 'تم التعديل بنجاح');
    }


    public function destroy($id)
    {
        $video= Video::find($id);
        return Response::json($video->delete());
    }
}
