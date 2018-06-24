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
        $data1['_name']='我是来学习的???';
        $data1['_address']='安庆师范学院';
        $data1['test1']='wudi1';
        $data1['test2']='18712377079';
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
        var_dump(json_decode($cc,true));
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
        $data1['_name']='大神带带我3';
        $data1['_address']='合肥市第一人民医院西区';
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
        var_dump(json_decode($cc,true));
    }

    /*
     * 按照关键词检索数据
     *  目的：APP端发送周边的APP的别名给服务端
     * 服务端通过别名作为关键词去云图查找对应的整条并对
     */
    public function searchAllBykey(){
        $key=self::key;
        $tableid=self::tableid;
        $secrtekey=self::secrtekey;
        $filter="_name:大神带带我3";
//        $filter="_name:大神带带我3+_address:合肥市第一人民医院西区";
        $limit=1;
        $page=1;
        $sortrule=0;

        Vendor('amap.Gaodeyuntu');
        $push = new \amap\Gaodeyuntu();

//        $str="filter=".$filter."key=".$key."limit=".$limit."page=".$page."&sortrule=".$sortrule."&tableid=".$tableid.$secrtekey;
//        $str="filter=".$filter."key=".$key."&tableid=".$tableid.$secrtekey;
        $str="key=".$key."&sortrule=".$sortrule."&tableid=".$tableid.$secrtekey;

        $data =array(
            'key' => $key,
            'tableid' => $tableid,
            'sortrule' => $sortrule,
            'sig' =>md5($str)
        );

//        $data =array(
//            'filter' => $filter,
//            'key' => $key,
//            'tableid' => $tableid,
//            'sig' =>md5($str)
//        );

       /* $data =array(
            'filter' => $filter,
            'key' => $key,
            'limit' => $limit,
            'page' => $page,
            'sortrule' => $sortrule,
            'tableid' => $tableid,
            'sig' =>md5($str)
        );*/
        $cc=$push->search_by_condition($data);
        var_dump(json_decode($cc,true));
    }

    /*上面是查询所有的数据，下面是按照条件查询*/

    public function searchBykey(){
        $key=self::key;
        $tableid=self::tableid;
        $secrtekey=self::secrtekey;
        $filter="test2:18712377079";
//        $filter="test2:18712377078+_address:合肥市第一人民医院西区";
        $limit=1;
        $page=1;
        $sortrule=0;

        Vendor('amap.Gaodeyuntu');
        $push = new \amap\Gaodeyuntu();

        $str="filter=".$filter."&key=".$key."&limit=".$limit."&page=".$page."&sortrule=".$sortrule."&tableid=".$tableid.$secrtekey;
         $data =array(
             'filter' => $filter,
             'key' => $key,
             'limit' => $limit,
             'page' => $page,
             'sortrule' => $sortrule,
             'tableid' => $tableid,
             'sig' =>md5($str)
         );
        $cc=$push->search_by_condition($data);
        var_dump(json_decode($cc,true));
    }



}