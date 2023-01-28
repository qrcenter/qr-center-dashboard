<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\TagTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Video;
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

            return Datatables::of(Video::latest()->with('Tag'))
                ->addIndexColumn()
                ->addColumn('action', 'dashboard.video.action')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.video.index');
    }



    public function create()
    {
        $tags = Tag::where('type', TagTypeEnum::فديو->value)->get();
        return view('dashboard.video.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $video = new Video;
        $video->title = $request->get('title');
        $video->video_id = $request->get('video_id');
        $video->tag_id = $request->get('tag');
        $video->save();
        return redirect()->route('video.create')->with(['success' => 'تمت الاضافة الفديو بنجاح']);
    }

    public function edit($id)
    {
        $video = Video::find($id);
        $tags = Tag::where('type', TagTypeEnum::فديو->value)->get();
        return view('dashboard.video.edit', compact('video', 'tags'));
    }


    public function update(Request $request, $id)
    {
        $video = Video::find($id);


        $video->title = $request->get('title');
        $video->video_id = $request->get('video_id');
        $video->tag_id = $request->get('tag');
        $video->save();
        return redirect('dashboard/video')->with('success', 'تم التعديل بنجاح');
    }


    public function destroy($id)
    {
        $video = Video::find($id);
        return Response::json($video->delete());
    }
}
