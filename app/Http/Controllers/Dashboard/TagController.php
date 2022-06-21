<?php


namespace App\Http\Controllers\Dashboard;

use App\Enums\TagTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:مستخدم,مدير,محرر');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Tag::all())
                ->addIndexColumn()
                ->addColumn('type', function (Tag $tag) {
                    return $tag->type->name;
                })
                ->addColumn('action', 'dashboard.tag.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.tag.index');
    }



    public function create()
    {

        $types = TagTypeEnum::cases();
        return view('dashboard.tag.create', compact('types'));
    }

    public function store(Request $request)
    {
        $tag = new Tag;
        $tag->name = $request->get('name');
        $tag->type = $request->get('type');
        $tag->save();
        return redirect()->route('tag.index')->with(['success' => 'تمت الاضافة بنجاح']);
    }
    // public function show($id)
    // {
    //     $tag = Tag::find($id);
    //     return view('dashboard.tag.detail', compact('tag'));
    // }


    public function edit($id)
    {
        $tag = Tag::find($id);
        $types = TagTypeEnum::cases();
        return view('dashboard.tag.edit', compact('tag', 'types', 'id'));
    }


    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        $tag->name = $request->get('name');
        $tag->type = $request->get('type');
        $tag->save();
        return redirect()->route('tag.index')->with('success', 'تم التعديل بنجاح');
    }


    public function destroy($id)
    {
        $tag = Tag::find($id);
        $articles = Article::where('tag_id', $tag->id)->get();
        if ($articles->isEmpty()) {
            $tag->delete();
            return Response::json(array(
                'status' => 'success',
                'message'   =>  "تم الحذف بنجاح"
            ), 200);
        }
        return Response::json(array(
            'status' => 'error',
            'message'   =>  "الاشارة مرتبطة لا يمكن حذفها"
        ), 403);
    }
}
