<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Newsletter;
class NewsletterController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( ! Newsletter::isSubscribed($request->email) )
        {
            Newsletter::subscribePending($request->email);

            return $this->apiResponse(null,null,null,null,"شكرا لاشتراكك الرجاء يرجى الذهاب الى البريد الكتلروني الوارد لاكمال الاشتراك");
        }
        return $this->apiResponse(null,null,null,null,"عذرا لقد تم اشتراكك بالفعل مسبقا يرجى الذهاب الى البريد الالكتروني الوارد");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
