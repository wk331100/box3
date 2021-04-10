<?php

namespace App\Http\Controllers;

use App\Libs\Util;
use App\Models\InviteCodeModel;
use App\Models\ToolsModel;
use App\Models\UserModel;
use App\Services\QRcodeService;
use App\Services\ToolService;
use System\Redirect;
use System\Request;
use System\Response;

class IndexController extends Controller {

    public function index(){
        Redirect::to('/base64');
    }

    public function tools(Request $request){
        $data = [
            'list' => ToolService::getToolList(),
            'type' => ToolService::getTypeList(),
            'meta_key' => ToolService::getToolMetaKey(),
            'meta_desc' => ToolService::META_DESC,
        ];
        $data = ToolService::bindExtData($data, $request);
        return Response::html("tools", $data);
    }


    public function base64(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url, $request);
        return Response::html("encode/default", $data);
    }

    public function urlEncode(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url, $request);
        return Response::html("encode/default", $data);
    }

    public function randPwd(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url, $request);
        return Response::html("create/randPwd", $data);
    }

    public function md5(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url, $request);
        return Response::html("create/md5", $data);
    }

    public function qrcode(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url, $request);
        return Response::html("create/qrcode", $data);
    }

    public function qrcodeImg(Request $request){
        $data = [
            'text' => $request->input('text')
        ];
        $result = QRcodeService::Create($data);
        Response::image($result);
    }

    public function timeFormate(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url, $request);

        return Response::html("create/timeFormate", $data);
    }

    public function shuffle(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url, $request);
        return Response::html("create/shuffle", $data);
    }

    public function jsonEncode(Request $request){
        $url = $request->input('_url');
        $data = ToolService::buildEncode($url, $request);
        return Response::html("encode/json", $data);
    }

}