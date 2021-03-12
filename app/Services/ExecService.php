<?php
namespace App\Services;

use App\Exceptions\ServiceException;
use App\Libs\MessageCode;
use App\Models\ToolsModel;
use System\Application;

class ExecService{

    public static $type = [
        'encode' , 'decode', 'create'
    ];

    public static function Run($tool, $type, $data){
        $toolArray = ToolService::getToolArray();
        if (!in_array($tool, $toolArray)) {
            throw new ServiceException(MessageCode::INVALID_TOOL);
        }
        if (!in_array($type, self::$type)){
            throw new ServiceException(MessageCode::INVALID_TYPE);
        }

        $function = Application::SERVICE_NAMESPACE .'\\'. $tool ."Service::" . ucfirst($type);
        return call_user_func($function, $data);
    }



}