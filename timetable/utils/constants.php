<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/15
 * Time: 9:23
 */

define ('IMAGE_HEADER','http://119.29.190.39/scenery/images/');


define ('SESSION_TIME',60*5);

define ('PASSWORD_SALT','.*&a3.$#pd/?/!');

define("CODE_SUCCESS",200);

define("CODE_ERROR",300);

define("CODE_NEED",301);

define("CODE_KEY",302);

define("CODE_LOGIN",303);

define("CODE_EXPIRE",304);

define("CODE_UNKNOW",305);

define("CODE_CONNECT_FAIL",306);

define("CODE_OVERRIDE_TEL",307);

define("CODE_NOEXIST_OR_PASSWD_ERROR",308);

define("CODE_NOFOND_FRIEND",309);

define("CODE_ALREADY",310);

define("CODE_FILE_TYPE_ERROR",320);

define("CODE_FILE_ERROR",321);

define("CODE_ID_UNKNOW",322);

define("CODE_UNPOWER",323);

define("CODE_ALREADY_ONLINE",324);

define("CODE_OWNER",325);

define("CODE_VALUE_SAME",326);


//MSG

define("MSG_SUCCESS","成功");

define("MSG_ERROR","后台处理发生错误");

define("MSG_NEED","参数不全,请补充完整");

define("MSG_KEY","密匙错误,请联系1193600556@qq.com");

define("MSG_LOGIN","你还没登录");

define("MSG_EXPIRE","cookie过期，请重新登录");

define("MSG_UNKNOW","未知异常");

define("MSG_CONNECT_FAIL","数据库连接失败");

define("MSG_OVERRIDE_TEL","本手机号已注册");

define("MSG_NOEXIST_OR_PASSWD_ERROR","账号或密码错误");

define("MSG_NOFOND_FRIEND","好友不存在");

define("MSG_ALREADY","对方已是你的好友");

define("MSG_FILE_TYPE_ERROR","文件类型错误！只允许上传PNG|JPG|JPEG|GIF");

define("MSG_FILE_ERROR","文件损坏，请重试!");

define("MSG_ID_UNKNOW","查询的id无效");

define("MSG_UNPOWER","没有操作的权限或对象不存在");

define("MSG_ALREADY_ONLINE","本会话已占用，不能登录其他用户，请先注销！");

define("MSG_OWNER","不能添加自己为好友");

define("MSG_VALUE_SAME","不能与原值相同");

$resultMap=array(
    CODE_SUCCESS=>MSG_SUCCESS,
    CODE_ERROR=>MSG_ERROR,
    CODE_EXPIRE=>MSG_EXPIRE,
    CODE_KEY=>MSG_KEY,
    CODE_LOGIN=>MSG_LOGIN,
    CODE_NEED=>MSG_NEED,
    CODE_UNKNOW=>MSG_UNKNOW,
    CODE_CONNECT_FAIL=>MSG_CONNECT_FAIL,
    CODE_OVERRIDE_TEL=>MSG_OVERRIDE_TEL,
    CODE_NOEXIST_OR_PASSWD_ERROR=>MSG_NOEXIST_OR_PASSWD_ERROR,
    CODE_NOFOND_FRIEND=>MSG_NOFOND_FRIEND,
    CODE_ALREADY=>MSG_ALREADY,
    CODE_FILE_TYPE_ERROR=>MSG_FILE_TYPE_ERROR,
    CODE_FILE_ERROR=>MSG_FILE_ERROR,
    CODE_ID_UNKNOW=>MSG_ID_UNKNOW,
    CODE_UNPOWER=>MSG_UNPOWER,
    CODE_ALREADY_ONLINE=>MSG_ALREADY_ONLINE,
    CODE_OWNER=>MSG_OWNER,
    CODE_VALUE_SAME=>MSG_VALUE_SAME
);
