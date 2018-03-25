<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/22
 * Time: 9:44
 */

require('model/Model.php');

class FriendModel extends Model
{
    /**
     * 将用户添加为自己的好友
     * @param $ftarget
     * @return Result
     */
    public function add($ftarget)
    {
        if (!$this->isLogin) {
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        if($ftarget==$this->uid){
            $this->result->setCode(CODE_OWNER);
            return;
        }

        //判断好友是否真实
        $sql = "select * from user where uid='$ftarget'";
        $r = $this->conn->query($sql);
        if ($r->num_rows <= 0) {
            $this->result->setCode(CODE_NOFOND_FRIEND);
            return;
        }

        $ftime = time();

        //判断是否已添加
        $sql = "select * from friends where fowner='$this->uid' and ftarget='$ftarget' and fenable=1";
        $r = $this->conn->query($sql);
        if ($r->num_rows > 0) {
            $this->result->setCode(CODE_ALREADY);
            return;
        }

        //执行操作
        $sql = "insert into friends(fowner,ftarget,ftime) "
            . "values('$this->uid','$ftarget','$ftime')";
        $r = $this->conn->query($sql);
        if ($r) {
            $this->result->setCode(CODE_SUCCESS);
        } else {
            $this->result->setCode(CODE_ERROR);
        }
    }

    /**
     * 列出自己的好友
     * @return Result
     */
    public function query()
    {
        if (!$this->isLogin) {
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        $sql = "select uid,fid,uname,utel,uimage from user,friends "
            . "where user.uid=friends.ftarget and fowner='$this->uid' and fenable=1";
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
                "fid" => $row['fid'],
                "uname" => $row['uname'],
                "utel" => $row['utel'],
                "uimage" => $row['uimage']
            );
        }
        $this->result->setData($data);
    }


    /**
     * 删除好友
     * @param $fid
     * @return Result
     */
    public function delete($fid)
    {
        if (!$this->isLogin) {
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        //判断好友是否真实
        $sql = "select * from friends where fowner='$this->uid' and fid='$fid' and fenable=1";
        $r = $this->conn->query($sql);
        if ($r->num_rows <= 0) {
            $this->result->setCode(CODE_UNPOWER);
            return;
        }

        $sql = "update friends set fenable=0 where fowner='$this->uid' and fid='$fid'";
        $r = $this->conn->query($sql);
        if ($r) {
            $this->result->setCode(CODE_SUCCESS);
            return $this->result;
        } else {
            $this->result->setCode(CODE_ERROR);
        }
    }
}