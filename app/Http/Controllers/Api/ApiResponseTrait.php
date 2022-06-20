<?php
namespace App\Http\Controllers\Api;

trait ApiResponseTrait{
public function apiResponse($data=null,$current_page=null,$last_page=null,$total=null,$message=null,$code=200){
    if(!$current_page||!$last_page){
        $array=[
            'data'=>$data,
            'status'=>$code==200?true:false,
            'message'=>$message
           ];
    }else{
        $array=[
            'data'=>$data,
            'current_page'=>$current_page,
            'last_page'=>$last_page,
			'total'=>$total,
            'status'=>$code==200?true:false,
            'message'=>$message
           ];
    }

    return response($array,$code);

}
}
