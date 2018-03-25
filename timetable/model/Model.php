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

    var $db = 'timetable';

    var $conn;

    var $result;

    var $isLogin=false;

    var $uid;

    public function __construct($result)
    {
        $this->result = $result;
        $this->conn = $this->connnect();
    }

    private function connnect()
    {
        $conn = new mysqli($this->server, $this->username, $this->password, $this->db);

        $conn->query("SET NAMES utf8");

        return $conn;
    }

}