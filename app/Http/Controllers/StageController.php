<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use App\Services\LoginService;
use System\Redirect;
use System\Request;
use System\Response;

class StageController extends Controller {

    public function stage(Request $request){
        $userInfo = LoginService::checkLogin();
        $level = $userInfo->level;
        $levelInfo = LevelModel::getInstance()->getInfo($level);
        $maxLevel = LevelModel::getInstance()->getMaxLevel();
        if ($level > $maxLevel) {
            Redirect::to("/prize");
        }

        $data = [
            "user" => UserModel::getInstance()->getSafeInfo($userInfo->uid),
            "success" => $request->input('success'),
            "err" => $request->input('err'),
            'level' => $level,
            'title' => $levelInfo->title,
            'prize' => $levelInfo->prize,
            'story' => $levelInfo->story,
            'content' => $levelInfo->content,
        ];

        $tmp = "stage/" . $levelInfo->tmp;
        return Response::html($tmp, $data);
    }

    public function validate(Request $request){
        $userInfo = LoginService::checkLogin();
        $level = $userInfo->level;
        $levelInfo = LevelModel::getInstance()->getInfo($level);
        $answer = $request->input('answer');
        if ($levelInfo->code == $answer) {
            $updateData = [
                'level' => $level + 1,
                'prize' => $userInfo->prize + $levelInfo->prize
            ];
            UserModel::getInstance()->update($updateData, $userInfo->uid);
            $msg = ['err' => 'Mission Success, Prize +'. $levelInfo->prize];
        } else {
            $msg = ['err' => 'Mission Failed'];
        }
        Redirect::to("/stage", $msg);
    }

    public function prize(){
        $userInfo = LoginService::checkLogin();
        $data = [
            'user' => UserModel::getInstance()->getSafeInfo($userInfo->uid)
        ];
        return Response::html("prize", $data);
    }


}