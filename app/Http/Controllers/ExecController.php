<?php

namespace App\Http\Controllers;

use App\Exceptions\ServiceException;
use App\Libs\Util;
use App\Models\InviteCodeModel;
use App\Models\ToolsModel;
use App\Models\UserModel;
use App\Services\ExecService;
use App\Services\ToolService;
use System\Redirect;
use System\Request;
use System\Response;

class ExecController extends Controller {

    public function index(Request $request){
        try {
            $tool = $request->input('tool');
            $type = $request->input('type');
            $data = [
                "text" => $request->input('text'),
                "char" => $request->input('char'),
                "len" => $request->input('len')
            ];
            $result = ExecService::Run($tool, $type, $data);
            return Response::success($result);
        } catch (ServiceException $e){
            return Response::error($e);
        }
    }

    public function img(Request $request){
        try {
            $tool = $request->input('tool');
            $type = $request->input('type');
            $data = [
                "text" => $request->input('text'),
                "char" => $request->input('char'),
                "len" => $request->input('len')
            ];
            $result = ExecService::Run($tool, $type, $data);
            Response::image($result);
        } catch (ServiceException $e){
            return Response::error($e);
        }
    }




}