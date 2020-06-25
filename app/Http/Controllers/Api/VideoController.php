<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(){
        $articles=Video::orderBy('id', 'DESC')->paginate(11);
        return VideoResource::collection($articles);
    }
}
