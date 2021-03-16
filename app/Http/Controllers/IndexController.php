<?php

namespace App\Http\Controllers;

use App\Libs\Util;
use App\Models\InviteCodeModel;
use App\Models\ToolsModel;
use App\Models\UserModel;
use App\Services\QrcodeService;
use App\Services\ToolService;
use System\Redirect;
use System\Request;
use System\Response;

class IndexController extends Controller {

    public function index(){
        Redirect::to('/base64');
    }

    public function base64(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url);
        return Response::html("encode/default", $data);
    }

    public function urlEncode(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url);
        return Response::html("encode/default", $data);
    }

    public function randPwd(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url);
        return Response::html("create/randPwd", $data);
    }

    public function md5(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url);
        return Response::html("create/md5", $data);
    }

    public function qrcode(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url);
        return Response::html("create/qrcode", $data);
    }

    public function qrcodeImg(Request $request){
        $data = [
            'text' => $request->input('text')
        ];
        $result = QrcodeService::Create($data);
        Response::image($result);
    }

    public function timeFormate(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url);

        return Response::html("create/timeFormate", $data);
    }

}