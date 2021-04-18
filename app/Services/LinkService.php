<?php
namespace App\Services;

use App\Exceptions\ServiceException;
use App\Libs\MessageCode;
use App\Libs\RedisKey;
use App\Models\FeedbackModel;
use App\Models\LinkModel;
use App\Models\TimeLineModel;
use App\Models\ToolsModel;
use System\Redis;

class LinkService{

    public static function createFeedback($insertData){
        $submitKey = RedisKey::getSubmitKey($insertData['client_ip']);
        $redis = new Redis();
        if ($redis->get($submitKey)) {
            throw new ServiceException(MessageCode::SUBMIT_ERROR);
        }

        $todaySubmitCount = FeedbackModel::getInstance()->getTodaySubmitCount($insertData['client_ip']);
        if ($todaySubmitCount > 10) {
            throw new ServiceException(MessageCode::SUBMIT_DAY_LIMIT);
        }

        $redis->setex($submitKey, 10, 1);
        return FeedbackModel::getInstance()->create($insertData);
    }

    public static function getTypeList(){
        return LinkModel::getInstance()->getTypeList();
    }

    public static function getLinkList(){
        return LinkModel::getInstance()->getActiveList();
    }

    public static function getTimeLine(){
        return TimeLineModel::getInstance()->getActiveList();
    }

}