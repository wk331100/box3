<?php

namespace App\Http\Controllers;

use App\Exceptions\ServiceException;
use App\Libs\Constants;
use App\Libs\Util;
use App\Models\InviteCodeModel;
use App\Models\ToolsModel;
use App\Models\UserModel;
use App\Services\LinkService;
use App\Services\QRcodeService;
use App\Services\ToolService;
use System\Flash;
use System\Redirect;
use System\Request;
use System\Response;

class LinkController extends Controller {

    public function index(Request $request){
        $data = [
            'list' => LinkService::getLinkList(),
            'type' => LinkService::getTypeList(),
            'desc' => '友情链接',
            'meta_key' => ToolService::getToolMetaKey(),
            'meta_desc' => ToolService::META_DESC,
        ];
        $data = ToolService::bindExtData($data, $request);
        return Response::html("/ext/link", $data);
    }

    public function history(Request $request){
        $data = [
            'list' => LinkService::getTimeLine(),
            'desc' => '网站动态',
            'meta_key' => ToolService::getToolMetaKey(),
            'meta_desc' => ToolService::META_DESC,
        ];
        $data = ToolService::bindExtData($data, $request);
        return Response::html("/ext/history", $data);
    }


    public function feedback(Request $request){
        if ($request->method() == 'POST') {
            try {
                $insertData = [
                    'type' => $request->input('type'),
                    'text' => $request->input('text'),
                    'email' => $request->input('email'),
                    'tel' => $request->input('tel'),
                    'url' => $request->input('url'),
                    'client_ip' => $request->input('ip')
                ];
                LinkService::createFeedback($insertData);
                Flash::set(Constants::SUCCESS, Constants::FEEDBACK_SUCCESS);
                Redirect::to('/feedback');
            } catch (ServiceException $e) {
                Flash::set(Constants::ERR, $e->getMessage());
                Redirect::to('/feedback');
            }
        }
        $data = [
            'list' => ToolService::getToolList(),
            'type' => ToolService::getTypeList(),
            'desc' => '工具箱列表',
            'meta_key' => ToolService::getToolMetaKey(),
            'meta_desc' => ToolService::META_DESC,
        ];
        $data = ToolService::bindExtData($data, $request);
        return Response::html("ext/feedback", $data);
    }


}