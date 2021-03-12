<?php

namespace App\Http\Controllers;

use App\Libs\Util;
use App\Models\InviteCodeModel;
use App\Models\ToolsModel;
use App\Models\UserModel;
use App\Services\ToolService;
use System\Redirect;
use System\Request;
use System\Response;

class IndexController extends Controller {

    public function index(){
        Redirect::to('/base64');
    }

    public function base64(){
        $name = 'Base64';
        $desc = 'Base64';
        $top = ToolsModel::getInstance()->getTopList();
        $data = [
            'name' => $name,
            'desc' => $desc,
            'list' => $top,
            'in_list' => ToolService::checkInList($name, $top)
        ];
        return Response::html("base64", $data);
    }

    public function randPwd(){
        $name = 'RandChar';
        $desc = '随机密码';
        $top = ToolsModel::getInstance()->getTopList();
        $data = [
            'name' => $name,
            'desc' => $desc,
            'list' => $top,
            'in_list' => ToolService::checkInList($name, $top)
        ];
        return Response::html("randPwd", $data);
    }

}