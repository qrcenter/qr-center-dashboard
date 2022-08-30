<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\TagTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:مستخدم,مدير,محرر');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            return Datatables::of(Post::query()->with('tag')->get())->make(true)
                ->addIndexColumn()
                ->addColumn('action', 'dashboard.post.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.post.index');
    }



    public function create()
    {
         $tags = Tag::where('type', TagTypeEnum::منشور->value)->get();
        return view('dashboard.post.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $post = new Post;

        if ($request->hasfile('img')) {
            $storagePath = Storage::put("public/assets", $request->file('img'));
            $post->image_url = $storagePath;
            $post->image_name = basename($storagePath);
        }
        $post->title = $request->get('title');
        // $post->text = $request->get('text');
        $post->date = $request->get('date');
        $post->tag_id = $request->get('tag');


        $post->save();
        return redirect()->route('post.index')->with(['success' => 'تمت الاضافة بنجاح']);
    }
    public function show($id)
    {
        $post = post::find($id);
        $tags = Tag::all();
        return view('dashboard.post.detail', compact('post', 'tags'));
    }


    public function edit($id)
    {
        $post = Post::find($id);
        $tags = Tag::where('type', TagTypeEnum::منشور->value)->get();
        return view('dashboard.post.edit', compact('post', 'id', 'tags'));
    }


    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if ($request->hasfile('img')) {
            Storage::delete($post->image_url);
            $storagePath = Storage::put("public/assets", $request->file('img'));
            $post->image_url = $storagePath;
            $post->image_name = basename($storagePath);
        }

        $post->title = $request->get('title');
        // $post->text = $request->get('text');
        $post->date = $request->get('date');
        $post->tag_id = $request->get('tag');

        $post->save();
        return redirect()->route('post.index')->with('success', 'تم التعديل بنجاح');
    }


    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post->image_url != null) {
            Storage::delete($post->image_url);
        }
        return Response::json($post->delete());
    }
}
