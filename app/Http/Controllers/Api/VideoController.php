<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request)
    {
        $videos = null;
        if ($request->tag && !$request->search) {
            $videos = Video::where('tag_id', $request->tag)->orderBy('id', 'DESC')->paginate(12);
      }

      elseif ($request->search) {
        $videos = Video::search($request->search)->paginate(12);
    }
       else {
            $videos = Video::latest()->paginate(12);
        }

        $current_page = $videos->currentPage();
        $last_page = $videos->lastPage();
        $total = $videos->total();
        return $this->apiResponse(VideoResource::collection($videos), $current_page, $last_page, $total);
        return $this->apiResponse( VideoResource::collection($videos), $current_page, $last_page, $total);
    }
    public function search($search)
    {
        $videos = Video::search($search)->paginate(12);
        $current_page = $videos->currentPage();
        $last_page = $videos->lastPage();
        $total = $videos->total();
        return $this->apiResponse(VideoResource::collection($videos), $current_page, $last_page, $total);
    }
}
