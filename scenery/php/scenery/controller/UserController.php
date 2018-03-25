<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/14
 * Time: 12:22
 */
require('utils/TextUtils.php');
require('model/UserModel.php');

class UserController
{
    public function index()
    {
        echo 'hello word';
    }

    public function login()
    {
        $result = new Result();

        if (!TextUtils::checkParams(['tel', 'passwd'])) {
            $result->setCode(CODE_NEED);
            $result->returnResult();
            return;
        }

        $tel=TextUtils::get('tel');
        $passwd=TextUtils::get('passwd');

        $model = new UserModel($result);
        $model->login($tel, $passwd);

        $result->returnResult();
    }

    /**
     * 注册账户,这里负责检查参数，处理结果
     */
    public function register()
    {
        $result = new Result();

        if (!TextUtils::checkParams(['name', 'tel', 'passwd'])) {
            $result->setCode(CODE_NEED);
            $result->returnStatus();
            return;
        }

        $name = TextUtils::get('name');
        $tel = TextUtils::get('tel');
        $passwd = TextUtils::get('passwd');

        $model = new UserModel($result);
        $model->register($name, $tel, $passwd);

        $result->returnStatus();
    }

    /**
     * 查询用户
     */
    public function query()
    {
        $result = new Result();

        if (!TextUtils::checkParam('value')) {
            $result->setCode(CODE_NEED);
            $result->returnResult();
            return;
        }

        $value = TextUtils::get('value');

        $model = new UserModel($result);
        $model->query($value);

        $result->returnResult();
    }

    /**
     * 查询个人资料
     */
    public function info()
    {
        $result = new Result();
        $model = new UserModel($result);
        $model->info();

        $result->returnResult();
    }

    /**
     * 注销
     */
    public function logout()
    {
        $result = new Result();
        $model = new UserModel($result);
        $model->logout();

        $result->returnStatus();
    }

    /**
     * 修改昵称
     */
    public function username()
    {
        $result = new Result();

        if (!TextUtils::checkParam('username')) {
            $result->setCode(CODE_NEED);
            $result->printResult();
            return;
        }

        $username = TextUtils::get('username');

        $model = new UserModel($result);
        $model->username($username);

        $result->returnStatus();
    }

    /**
     * 修改昵称
     */
    public function passwd()
    {
        $result = new Result();

        if (!TextUtils::checkParam('passwd')) {
            $result->setCode(CODE_NEED);
            $result->returnStatus();
            return;
        }

        $passwd = TextUtils::get('passwd');

        $model = new UserModel($result);
        $model->passwd($passwd);

        $result->returnStatus();
    }
}