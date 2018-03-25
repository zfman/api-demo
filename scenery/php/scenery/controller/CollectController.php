<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/15
 * Time: 20:31
 */

require('utils/TextUtils.php');
require('utils/constants.php');
require('model/CollectModel.php');

class CollectController
{
    public function collect(){
        $result = new Result();

        if (!TextUtils::checkParam('sid')) {
            $result->setCode(CODE_NEED);
            $result->returnStatus();
            return;
        }

        $sid=TextUtils::get('sid');
        $model = new CollectModel($result);
        $model->collect($sid);
        $result->returnStatus();
    }

    public function query(){
        $result = new Result();
        $model = new CollectModel($result);
        $model->query();
        $result->returnResult();
    }

    public function cancel(){
        $result = new Result();

        if (!TextUtils::checkParam('cid')) {
            $result->setCode(CODE_NEED);
            $result->returnStatus();
            return;
        }

        $cid=TextUtils::get('cid');
        $model = new CollectModel($result);
        $model->cancel($cid);
        $result->returnStatus();
    }
}