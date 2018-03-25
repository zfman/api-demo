<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/14
 * Time: 14:22
 */
require('model/Model.php');

class UserModel extends Model
{
    /**
     * 登录
     * @param $name
     * @param $tel
     * @param $passwd
     * @return Result
     */
    public function login($tel, $passwd)
    {
        if ($this->isLogin) {
            $this->result->setCode(CODE_ALREADY_ONLINE);
            return;
        }

        $new_passwd = sha1($passwd . PASSWORD_SALT);
        $sql = "select uid,uname from user where utel='$tel' and upasswd='$new_passwd' and uenable=1";
        $r = $this->conn->query($sql);

        if ($r->num_rows <= 0) {
            $this->result->setCode(CODE_NOEXIST_OR_PASSWD_ERROR);
            return;
        }

        $arr = array();
        $row = $r->fetch_assoc();
        $arr['username'] = $row['uname'];

        $this->result->setCode(CODE_SUCCESS);
        $this->result->setData($arr);

        $id = $row['uid'];
        $_SESSION['uid'] = $id;
    }

    /**
     * 注册
     * @param $name
     * @param $tel
     * @param $passwd
     * @return Result
     */
    public function register($name, $tel, $passwd)
    {
        $new_passwd = sha1($passwd . PASSWORD_SALT);

        //查询是否存在该手机号
        $querySql = "select * from user where utel='$tel'";
        $queryResult = $this->conn->query($querySql);
        if ($queryResult->num_rows > 0) {
            $this->result->setCode(CODE_OVERRIDE_TEL);
            return;
        }

        //确保ID唯一
        $id = md5(uniqid(md5(microtime(true)), true));
        //插入数据
        $sql = "insert into user(uid,uname,upasswd,utel) "
            . "values('$id','$name','$new_passwd','$tel')";

        $r = $this->conn->query($sql);
        if ($r) {
            $this->result->setCode(CODE_SUCCESS);
        } else {
            $this->result->setCode(CODE_ERROR);
        }
    }


    /**
     * 根据关键字查询用户
     * @param $value
     */
    public function query($value)
    {
        if (!$this->isLogin) {
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        $sql = "select uid,uname,utel,uimage from user "
            . "where utel like '%$value%' or uname like '%$value%' and uenable=1";
        $r = $this->conn->query($sql);
        if (!$r) {
            $this->result->setCode(CODE_ERROR);
            return;
        }

        $this->result->setCode(CODE_SUCCESS);
        $data = array();
        while ($row = $r->fetch_assoc()) {
            $data[] = array(
                "uid" => $row['uid'],
                "uname" => $row['uname'],
                "utel" => $row['utel'],
                "uimage" => $row['uimage']
            );
        }
        $this->result->setData($data);
    }

    /**
     * 查询个人资料
     */
    public function info()
    {
        if (!$this->isLogin) {
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        $sql = "select uid,uname,utel,uimage from user "
            . "where uid='$this->uid' and uenable=1";
        $r = $this->conn->query($sql);
        if (!$r) {
            $this->result->setCode(CODE_ERROR);
            return;
        }

        $this->result->setCode(CODE_SUCCESS);
        $data = array();
        while ($row = $r->fetch_assoc()) {
            $data[] = array(
                "uid" => $row['uid'],
                "uname" => $row['uname'],
                "utel" => $row['utel'],
                "uimage" => $row['uimage']
            );
        }
        $this->result->setData($data);
    }

    /**
     * 注销
     */
    public function logout()
    {
        if (!$this->isLogin) {
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        $_SESSION['uid'] = '';
        $this->result->setCode(CODE_SUCCESS);
    }

    /**
     * 修改昵称
     */
    public function username($username)
    {
        if (!$this->isLogin) {
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        //判断是否与原昵称相同
        $sql = "select uname from user where uid='$this->uid' and uenable=1";
        $r = $this->conn->query($sql);
        if ($r) {
            $row=$r->fetch_assoc();
            $name=$row['uname'];
            if($name==$username){
                $this->result->setCode(CODE_VALUE_SAME);
                return;
            }
        }

        $sql = "update user set uname='$username' where uid='$this->uid' and uenable=1";
        $r = $this->conn->query($sql);
        if (!$r) {
            $this->result->setCode(CODE_ERROR);
            return;
        }
        $this->result->setCode(CODE_SUCCESS);
    }

    /**
     * 修改密码
     */
    public function passwd($passwd)
    {
        if (!$this->isLogin) {
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        $new_passwd = sha1($passwd . PASSWORD_SALT);

        //判断是否与原密码相同
        $sql = "select upasswd from user where uid='$this->uid' and uenable=1";
        $r = $this->conn->query($sql);
        if ($r) {
            $row=$r->fetch_assoc();
            $upasswd=$row['upasswd'];
            if($upasswd==$new_passwd){
                $this->result->setCode(CODE_VALUE_SAME);
                return;
            }
        }

        $sql = "update user set upasswd='$new_passwd' where uid='$this->uid' and uenable=1";
        $r = $this->conn->query($sql);
        if (!$r) {
            $this->result->setCode(CODE_ERROR);
            return;
        }

        //注销登录
        $this->logout();
        $this->result->setCode(CODE_SUCCESS);
    }

}