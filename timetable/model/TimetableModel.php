<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/15
 * Time: 20:31
 */
require('model/Model.php');

class TimetableModel extends Model
{

    public function putValue($value)
    {
        $id = md5(uniqid(md5(microtime(true)), true));
        $sql = "insert into store(id,value) values('$id','$value')";

        $r = $this->conn->query($sql);
        if (!$r) {
            $this->result->setCode(CODE_ERROR);
            return $this->result;
        }

        $arr = array();
        $arr['id']=$id;
        $arr['value']=$value;
        $this->result->setCode(CODE_SUCCESS);
        $this->result->setData($arr);
        return $this->result;
    }

    public function getValue($id)
    {
        $sql = "select id,value from store where id='$id'";

        $r = $this->conn->query($sql);
        if (!$r) {
            $this->result->setCode(CODE_ERROR);
            return $this->result;
        }

        $arr = array();
        $row = $r->fetch_assoc();
        $id=$row['value']==null?null:$id;
        $arr['id']=$id;
        $arr['value']=$row['value'];

        $this->result->setCode(CODE_SUCCESS);
        $this->result->setData($arr);
        return $this->result;
    }


    /**
     * 查看最近学期的某班级的课程
     * 需要精确的专业班级
     * @return mixed
     */
    public function getByMajor($major)
    {
        $term=$this->getTermId();
        $termId=$term[0];
        $termName=$term[1];
        $sql = "select timetable.id,timetable.name,room,teacher,weeks,start,step,day,major.name as major from timetable,major,conn where major.id=conn.major_id and major.name='$major' and conn.term_id='$termId' and conn.timetable_id=timetable.id";

        $r = $this->conn->query($sql);
        if (!$r) {
            $this->result->setCode(CODE_ERROR);
            return $this->result;
        }


        $arr = array();
        $have_time=array();
        $no_time=array();

        while ($row = $r->fetch_assoc()) {
            if($row['start']==0||$row['step']==0||$row['day']==0){
                $no_time[] = array(
                    "id"=>$row['id'],
                    "term"=>$termName,
                    "name" => $row['name'],
                    "room"=>$row['room'],
                    "major"=>$row['major'],
                    "teacher" => $row['teacher'],
                    "weeks" => $row['weeks'],
                    "start" => $row['start'],
                    "step" => $row['step'],
                    "day" => $row['day']
                );
            }else{
                $have_time[] = array(
                    "id"=>$row['id'],
                    "term"=>$termName,
                    "name" => $row['name'],
                    "room"=>$row['room'],
                    "major"=>$row['major'],
                    "teacher" => $row['teacher'],
                    "weeks" => $row['weeks'],
                    "start" => $row['start'],
                    "step" => $row['step'],
                    "day" => $row['day']
                );
            }

        }
        $arr['havetime']=$have_time;
        $arr['notime']=$no_time;
        $this->result->setCode(CODE_SUCCESS);
        $this->result->setData($arr);
        return $this->result;
    }

    private function getTermId(){
        $sql = "select id,term from term order by id desc limit 1";
        $r = $this->conn->query($sql);
        $id=null;
        $term=null;
        if($r){
            $row = $r->fetch_assoc();
            $id=$row['id'];
            $term=$row['term'];
        }
        return [$id,$term];
    }

    public function findMajor($class)
    {
        $sql = "select id,name from major where major.name like '%$class%'";

        $r = $this->conn->query($sql);
        if (!$r) {
        $this->result->setCode(CODE_ERROR);
        return $this->result;
    }


        $arr = array();
        while ($row = $r->fetch_assoc()) {
            $arr[] = array(
                "id"=>$row['id'],
                "name" => $row['name']
            );
        }
        $this->result->setCode(CODE_SUCCESS);
        $this->result->setData($arr);
        return $this->result;
    }

    //根据课程名搜索
        public function getByName($name)
    {
        $term=$this->getTermId();
        $termId=$term[0];
        $termName=$term[1];
        $sql = "select id,name,room,teacher,weeks,start,step,day from timetable where name like '%$name%' and term_id='$termId'";

        $r = $this->conn->query($sql);
        if (!$r) {
            $this->result->setCode(CODE_ERROR);
            return $this->result;
        }


        $arr = array();
        while ($row = $r->fetch_assoc()) {
            $arr[] = array(
                "id"=>$row['id'],
                "term"=>$termName,
                "name" => $row['name'],
                "room"=>$row['room'],
                "major"=>$row['major'],
                "teacher" => $row['teacher'],
                "weeks" => $row['weeks'],
                "start" => $row['start'],
                "step" => $row['step'],
                "day" => $row['day']
            );
        }
        $this->result->setCode(CODE_SUCCESS);
        $this->result->setData($arr);
        return $this->result;
    }
}