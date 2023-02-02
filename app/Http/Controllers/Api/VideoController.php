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
        $videos = $this->getVideos($request);
        $currentPage = $videos->currentPage();
        $lastPage = $videos->lastPage();
        $total = $videos->total();
        
        return $this->apiResponse(VideoResource::collection($videos), $currentPage, $lastPage, $total);
    }

    public function show($id)
    {
        $video = Video::find($id);
        
        if ($video) {
            return $this->apiResponse(new VideoResource($video));
        }
        
        return $this->apiResponse(null);
    }
    
    private function getVideos(Request $request)
    {
        if ($request->search) {
            return Video::search($request->search)->paginate(12);
        }
        if ($request->tag) {
            return Video::where('tag_id', $request->tag)->orderBy('id', 'DESC')->paginate(12);
        }
        if ($request->exceptTag) {
            return Video::where('tag_id', '!=', $request->exceptTag)->orderBy('id', 'DESC')->paginate(12);
        }
        
        return Video::latest()->paginate(12); 
    }
}

