<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/14
 * Time: 14:31
 */
require('model/Result.php');

class Model
{
    var $server = 'localhost';

    var $username = 'root';

    var $password = '5271314';

    var $db = 'scenery';

    var $conn;

    var $result;

    var $isLogin=false;

    var $uid;

    public function __construct($result)
    {
        $this->result = $result;
        $this->conn = $this->connnect();

        if($this->checkLogin()){
            $this->isLogin=true;
            $this->uid=$_SESSION['uid'];
        }else {
            $this->isLogin=false;
        }
    }

    private function checkLogin(){
        if (empty($_SESSION['uid'])) {
            return false;
        }else return true;
    }

    private function connnect()
    {
        $conn = new mysqli($this->server, $this->username, $this->password, $this->db);

        $conn->query("SET NAMES utf8");

        return $conn;
    }

}