<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/14
 * Time: 12:22
 */
require('utils/TextUtils.php');
require('model/FriendModel.php');

class FriendController
{
    /**
     * 添加朋友
     */
    public function add()
    {
        $result = new Result();

        if (!TextUtils::checkParam('target')) {
            $result->setCode(CODE_NEED);
            $result->returnStatus();
            return;
        }

        $ftarget = TextUtils::get('target');

        $model = new FriendModel($result);
        $model->add($ftarget);

        $result->returnStatus();
    }

    /**
     * 查询朋友
     */
    public function query()
    {
        $result = new Result();
        $model = new FriendModel($result);
        $model->query();

        $result->returnResult();
    }

    /**
     * 删除朋友
     */
    public function delete()
    {
        $result = new Result();

        if (!TextUtils::checkParam('fid')) {
            $result->setCode(CODE_NEED);
            $result->returnStatus();
            return;
        }

        $fid = TextUtils::get('fid');

        $model = new FriendModel($result);
        $model->delete($fid);

        $result->returnStatus();
    }
}