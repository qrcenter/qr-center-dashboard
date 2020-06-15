<?php

namespace App\Http\Controllers\Dashboard\Article;

use App\Http\Controllers\Controller;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:مستخدم,مدير,محرر');
    }

    public function index(Request $request)
    {
     /*   $articles=Article::paginate(5);
        return view('dashboard.article.index',compact('articles'));*/
        if ($request->ajax()) {
            $data = Article::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $showUrl = url('dashboard/article/'.$row->id);
                    $editUrl = url('dashboard/article/'.$row->id.'/edit');

                    $action =
                        '<a class="btn btn-info btn-sm text-white shadow"  href="'.$showUrl.'" ><i class="fa fa-binoculars" aria-hidden="true"></i>  عرض</a>
<a class="btn btn-success btn-sm shadow" href="'.$editUrl.'" ><i class="fa fa-edit" aria-hidden="true"></i></i> تعديل  </a>
<meta name="csrf-token" content="{{ csrf_token() }}">
<a  class="btn btn-danger btn-sm text-white shadow delete-user" id="delete-user" data-id='.$row->id.'><i class="fa fa-trash-alt" aria-hidden="true"></i>  حذف</a>';

                    return $action;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.article.index');
    }



    public function create()
    {
        return view('dashboard.article.create');
    }

    public function store(Request $request)
    {
        $article= new Article;

        if($request->hasfile('img'))
        {
            $storagePath =Storage::put("public/assets", $request->file('img'));
            $article->image_url =$storagePath;
            $article->image_name = basename($storagePath);
        }
        $article->title=$request->get('title');
        $article->text=$request->get('text');
        $article->date=$request->get('date');

        $article->save();
        return redirect()->route('article.index')->with(['success'=>'تمت الاضافة بنجاح']);
    }
    public function show($id)
    {
       $article = Article::find($id);
        return view('dashboard.article.detail',compact('article'));
    }


    public function edit($id)
    {
        $article = Article::find($id);
        return view('dashboard.article.edit',compact('article','id'));
    }


    public function update(Request $request, $id)
    {
        $article= Article::find($id);

        if($request->hasfile('img'))
        {
            Storage::delete($article->image_url);
            $storagePath =Storage::put("public/assets", $request->file('img'));
            $article->image_url =$storagePath;
            $article->image_name = basename($storagePath);
        }

        $article->title=$request->get('title');
        $article->text=$request->get('text');
        $article->date=$request->get('date');

        $article->save();
        return redirect('dashboard/article')->with('success', 'تم التعديل بنجاح');
    }


    public function destroy($id)
    {
        $article = Article::find($id);

        if($article->image_url!=null)
        {
          Storage::delete($article->image_url);
        }
        return Response::json($article->delete());
    }
}
