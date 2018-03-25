<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/15
 * Time: 20:31
 */
require('model/Model.php');

class CollectModel extends Model
{
    /**
     * 收藏Scenery
     */
    public function collect($sid)
    {
        if (!$this->isLogin) {
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        //判断Scenery是否真实
        $sql = "select * from scenery where sid='$sid' and senable=1";
        $r = $this->conn->query($sql);
        if ($r->num_rows <= 0) {
            $this->result->setCode(CODE_ID_UNKNOW);
            return;
        }

        $time=time();
        $sql = "insert into collect(cowner,ctarget,ctime) values('$this->uid','$sid','$time')";
        $r = $this->conn->query($sql);
        if ($r) {
            $this->result->setCode(CODE_SUCCESS);
            return $this->result;
        } else {
            $this->result->setCode(CODE_ERROR);
        }
    }

    public function query()
    {
        if (!$this->isLogin) {
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        $sql = "select cid,sid,sarticle,sowner,stime,slongitude,slatitude,slocation from scenery,collect where cowner='$this->uid' and ctarget=sid and cenable=1 and senable=1";
        $r = $this->conn->query($sql);
        if (!$r) {
            $this->result->setCode(CODE_ERROR);
            return;
        }

        $this->result->setCode(CODE_SUCCESS);
        $data = array();
        while ($row = $r->fetch_assoc()) {
            $data[] = array(
                "cid"=>$row['cid'],
                "sid" => $row['sid'],
                "sarticle" => $row['sarticle'],
                "sowner" => $row['sowner'],
                "stime" => $row['stime'],
                "slongitude"=>$row['slongitude'],
                "slatitude"=>$row['slatitude'],
                "slocation"=>$row['slocation']
            );
        }
        $this->result->setData($data);
    }

    /**
     * 取消收藏
     * @param $cid
     */
    public function cancel($cid)
    {
        if (!$this->isLogin) {
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        //检查cid是否存在
        //~~~~
        $sql = "select * from collect where cid='$cid' and cenable=1";
        $r = $this->conn->query($sql);
        if ($r&&$r->num_rows<=0) {
            $this->result->setCode(CODE_ID_UNKNOW);
            return;
        }

        $sql = "update collect set cenable=0 where cid='$cid' and cenable=1";
        $r = $this->conn->query($sql);
        if (!$r) {
            $this->result->setCode(CODE_ERROR);
            return;
        }

        $this->result->setCode(CODE_SUCCESS);
    }
}