<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/15
 * Time: 20:31
 */

require('utils/TextUtils.php');
require('utils/constants.php');
require('model/SceneryModel.php');

class SceneryController
{
    /**
     * 发布Scenery
     */
    public function publish(){
        $result = new Result();

        if (!TextUtils::checkParams(['article','longitude','latitude','location'])) {
            $result->setCode(CODE_NEED);
            $result->returnStatus();
            return;
        }

        $article=TextUtils::get('article');
        $longitude=TextUtils::get('longitude');
        $latitude=TextUtils::get('latitude');
        $location=TextUtils::get('location');

        $model = new SceneryModel($result);
        $model->publish($article,$longitude,$latitude,$location);
        $result->returnStatus();
    }

    public function query(){
        $result = new Result();
        $model = new SceneryModel($result);
        $model->query();
        $result->returnResult();
    }

    public function upload(){
        $result = new Result();
        $model = new SceneryModel($result);
        $model->upload();
        $result->returnResult();
    }

    public function delete(){
        $result = new Result();

        if (!TextUtils::checkParam('sid')) {
            $result->setCode(CODE_NEED);
            $result->returnStatus();
            return;
        }

        $sid=TextUtils::get('sid');
        $model = new SceneryModel($result);
        $model->delete($sid);
        $result->returnStatus();
    }

    public function all(){
        $result = new Result();
        $model = new SceneryModel($result);
        $model->all();
        $result->returnResult();
    }
}