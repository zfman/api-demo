<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/15
 * Time: 20:31
 */

require('utils/TextUtils.php');
require('model/TimetableModel.php');

class TimetableController
{

    public function putValue(){
        $result = new Result();

        if (!TextUtils::checkParam('value')) {
            $result->setCode(CODE_NEED);
            $result->returnResult();
            return;
        }

        $value=TextUtils::get('value');

        $model = new TimetableModel($result);
        $model->putValue($value);
        $result->returnResult();
    }

    public function getValue(){
        $result = new Result();

        if (!TextUtils::checkParam('id')) {
            $result->setCode(CODE_NEED);
            $result->returnResult();
            return;
        }

        $id=TextUtils::get('id');

        $model = new TimetableModel($result);
        $model->getValue($id);
        $result->returnResult();
    }


    public function getByMajor(){
        $result = new Result();

        if (!TextUtils::checkParam('major')) {
            $result->setCode(CODE_NEED);
            $result->returnResult();
            return;
        }

        $major=TextUtils::get('major');

        $model = new TimetableModel($result);
        $model->getByMajor($major);
        $result->returnResult();
    }

    public function findMajor(){
        $result = new Result();

        if (!TextUtils::checkParam('major')) {
            $result->setCode(CODE_NEED);
            $result->returnResult();
            return;
        }

        $major=TextUtils::get('major');

        $model = new TimetableModel($result);
        $model->findMajor($major);
        $result->returnResult();
    }

    public function getByName(){
        $result = new Result();

        if (!TextUtils::checkParam('name')) {
            $result->setCode(CODE_NEED);
            $result->returnResult();
            return;
        }

        $name=TextUtils::get('name');

        $model = new TimetableModel($result);
        $model->getByName($name);
        $result->returnResult();
    }
}