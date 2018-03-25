<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/15
 * Time: 20:31
 */
require('model/Model.php');

class SceneryModel extends Model
{
    /**
     * 发布Scenery
     * @param $article
     * @return mixed
     */
    public function publish($article,$longitude,$latitude,$location)
    {
        if(!$this->isLogin){
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        $stime = time();

        //发布
        $sql = "insert into scenery(sarticle,sowner,stime,slongitude,slatitude,slocation) "
            . "values('$article','$this->uid','$stime','$longitude','$latitude','$location')";
        $r = $this->conn->query($sql);
        if ($r) {
            $this->result->setCode(CODE_SUCCESS);
        } else {
            $this->result->setCode(CODE_ERROR);
        }
        return $this->result;
    }

    /**
     * 获取发布的Scenery
     * @return Result
     */
    public function query()
    {
        if(!$this->isLogin){
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        $sql = "select sid,sarticle,sowner,stime,slongitude,slatitude,slocation from scenery where sowner='$this->uid' and senable=1";
        $r = $this->conn->query($sql);
        if (!$r) {
            $this->result->setCode(CODE_ERROR);
            return;
        }

        $this->result->setCode(CODE_SUCCESS);
        $data = array();
        while ($row = $r->fetch_assoc()) {
            $data[] = array(
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

    public function upload()
    {
        if(!$this->isLogin){
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        if (!$this->checkImage()) {
            $this->result->setCode(CODE_FILE_TYPE_ERROR);
            return;
        }

        if ($_FILES["file"]["error"] > 0) {
            $this->result->setCode(CODE_FILE_ERROR);
            return;
        }

        $fileName = md5(uniqid(md5(microtime(true)), true)) . ".png";

        // 判断images目录是否存在该文件
        // images目录权限为 777
        if (!file_exists("images/" . $fileName)) {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $fileName);
        }

        $image_size = getimagesize("images/" . $fileName);
        $url="http://119.29.190.39/scenery/images/" . $fileName;;
        $width=$image_size[0];
        $height=$image_size[1];

        $arr = array();
        $arr['url'] =$url;
        $arr['width'] =$width;
        $arr['height'] =$height;
        $arr['info'] = "![img]($url $width $height)";

        $this->result->setCode(CODE_SUCCESS);
        $this->result->setData($arr);
    }

    /**
     * 检查图片是否符合格式
     */
    private function checkImage()
    {
        // 允许上传的图片后缀
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["file"]["name"]);

        // 获取文件后缀名
        $extension = end($temp);

        if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/pjpeg")
                || ($_FILES["file"]["type"] == "image/x-png")
                || ($_FILES["file"]["type"] == "image/png"))
//            && ($_FILES["file"]["size"] < 204800)   // 小于 200 kb
            && in_array($extension, $allowedExts)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除Scenery
     */
    public function delete($sid)
    {
        if (!$this->isLogin) {
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        //判断Scenery是否真实
        $sql = "select * from scenery where sid='$sid' and sowner='$this->uid' and senable=1";
        $r = $this->conn->query($sql);
        if ($r->num_rows <= 0) {
            $this->result->setCode(CODE_UNPOWER);
            return;
        }

        $sql = "update scenery set senable=0 where sid='$sid' and senable=1";
        $r = $this->conn->query($sql);
        if ($r) {
            $this->result->setCode(CODE_SUCCESS);
            return $this->result;
        } else {
            $this->result->setCode(CODE_ERROR);
        }
    }

    /**
     * 获取所有的Scenery
     * @return Result
     */
    public function all()
    {
        if(!$this->isLogin){
            $this->result->setCode(CODE_LOGIN);
            return;
        }

        //发布
        $sql = "select sid,sarticle,sowner,stime,slongitude,slatitude,slocation from scenery where senable=1";
        $r = $this->conn->query($sql);
        if (!$r) {
            $this->result->setCode(CODE_ERROR);
            return;
        }

        $this->result->setCode(CODE_SUCCESS);
        $data = array();
        while ($row = $r->fetch_assoc()) {
            $data[] = array(
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
}