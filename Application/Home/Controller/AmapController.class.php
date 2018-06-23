<?php
namespace Home\Controller;
use Think\Controller;


class AmapController extends Controller {
    const key  ='77978e28102a6a5304e26275ef5c5468';            //应用key
    const tableid  ='5b2dbdc12376c12776eccd41';                //表ID
    const secrtekey  ='c49d81aa2cdfc78e5e421961b7b0e50f';     //私钥
//$dd=self::key;
    public function __construct($key='', $tableid='') {
        header("Content-type:text/html;charset=utf-8");
    }

    /*创建表*/
    public function create_table(){
        $key=self::key;
        $secrtekey=self::secrtekey;
        $name="meiren";
        Vendor('amap.Gaodeyuntu');
        $push = new \amap\Gaodeyuntu();
        $str="key=".$key."&name=".$name.$secrtekey;   /*签名参数*/
        $cc=$push->create_table($name,md5($str));
        var_dump($cc);
        /*
         * '{"info":"OK","infocode":"10000","status":1,"tableid":"5b2dbdc12376c12776eccd41"}'
        */
    }

    /*创建数据*/
    public function creater_data(){
        $key=self::key;
        $tableid=self::tableid;
        $secrtekey=self::secrtekey;
        Vendor('amap.Gaodeyuntu');
        $push = new \amap\Gaodeyuntu();

        $data1=array();
        $data1['_name']='大神带带我';
        $data1['_address']='合肥市第一人民医院西区';
        $data1['test1']='测试2';
        $data1['test2']='测试3';
        $data=json_encode($data1);

        $str="data=".$data."&key=".$key."&loctype=2&tableid=".$tableid.$secrtekey;
        $postArr = array (
            'data' =>  $data,
            'key'  =>  $key,
            'loctype' =>  "2",
            'tableid' =>  $tableid,
            'sig'  =>  md5($str)
        );

        $cc=$push->deal_single_data($postArr);
        var_dump($cc);
        var_dump($str);
    }

    /*更新数据
    */
    public function update_data(){
        $key=self::key;
        $tableid=self::tableid;
        $secrtekey=self::secrtekey;
        Vendor('amap.Gaodeyuntu');
        $push = new \amap\Gaodeyuntu();

        $data1=array();
        $data1['_id']='1';
        $data1['_name']='大神带带我2';
        $data1['_address']='合肥市第一人民医院西区2';
        $data1['test1']='测试21';
        $data1['test2']='测试31';
        $data=json_encode($data1);

        $str="data=".$data."&key=".$key."&loctype=2&tableid=".$tableid.$secrtekey;
        $postArr = array (
            'data' =>  $data,
            'key'  =>  $key,
            'loctype' =>  "2",
            'tableid' =>  $tableid,
            'sig'  =>  md5($str)
        );

        $cc=$push->deal_single_data($postArr,true);
        var_dump($cc);
        var_dump($str);
    }

    /*删除数据*/


    public function del_data(){
        $key=self::key;
        $tableid=self::tableid;
        $secrtekey=self::secrtekey;
        Vendor('amap.Gaodeyuntu');
        $push = new \amap\Gaodeyuntu();
        $ids="2";
//        $ids="2,3";
        $str="ids=".$ids."&key=".$key."&tableid=".$tableid.$secrtekey;

        $postArr = array (
            'key'  =>  $key,
            'ids' =>  $ids,
            'tableid' =>$tableid,
            'sig'  =>  md5($str)
        );

        $cc=$push->delete_data($postArr);
        var_dump($cc);
    }

    /*按照ID检索数据*/
    public function serId(){
        $key=self::key;
        $tableid=self::tableid;
        $secrtekey=self::secrtekey;
        Vendor('amap.Gaodeyuntu');
        $push = new \amap\Gaodeyuntu();
        $ids="1";
        $str="key=".$key."&_id=".$ids."&tableid=".$tableid.$secrtekey;
        $str="key=".$key."&tableid=".$tableid."&_id=".$ids.$secrtekey;
        $str="_id=".$ids."&key=".$key."&tableid=".$tableid.$secrtekey;

        $postArr = array (
            'tableid' =>  $tableid,
            '_id' =>  $ids,
            'key'  =>  $key,
            'sig' =>md5($str),
        );

        $cc=$push->search_id($postArr);
        var_dump($cc);


    }



}