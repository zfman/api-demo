<?php
/**
 * Created by PhpStorm.
 * User: zf
 * Date: 2018/2/14
 * Time: 21:25
 */
require('utils/constants.php');

class Result
{
    private $code = CODE_UNKNOW;

    private $msg = MSG_UNKNOW;

    private $data = [];

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }


    /**
     * @deprecated
     *
     */
    public function printResult()
    {
        global $resultMap;
        $this->setMsg($resultMap[$this->getCode()]);

        echo json_encode(array(
            "code" => $this->getCode(),
            "msg" => $this->getMsg(),
            "data" => $this->getData()
        ),JSON_UNESCAPED_UNICODE);
    }

    public function returnResult()
    {
        global $resultMap;
        $this->setMsg($resultMap[$this->getCode()]);

        if($this->getCode()==CODE_SUCCESS){
            echo json_encode(array(
                "code" => $this->getCode(),
                "msg" => $this->getMsg(),
                "data" => $this->getData()
            ),JSON_UNESCAPED_UNICODE);
        }else{
            $this->returnStatus();
        }
    }

    public function returnStatus()
    {
        global $resultMap;
        $this->setMsg($resultMap[$this->getCode()]);

        echo json_encode(array(
            "code" => $this->getCode(),
            "msg" => $this->getMsg()
        ),JSON_UNESCAPED_UNICODE);
    }
}