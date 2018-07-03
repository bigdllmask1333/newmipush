<?php
namespace Home\Controller;
use Think\Controller;

/*
 * http://localhost/newmipush/home/Amap/create_table
 * http://localhost/newmipush/home/Amap/creater_data
 * http://localhost/newmipush/home/Amap/update_data
 * http://localhost/newmipush/home/Amap/del_data
 * http://localhost/newmipush/home/Amap/serId
 * http://localhost/newmipush/home/Amap/searchAllBykey
 * http://localhost/newmipush/home/Amap/searcharound
 * 注意事项：  区分一下签名跟 不需要签名的地方，别的不需要操心！  在TP5里面也只是稍作修改就能用!毕竟是面向对象编程
 *
 * 高德云图操作类演示*/

class AmapController extends Controller {
//    const key  ='36f7b1bd5577ea0e4e42910f3db97b26';            //应用key
    const key  ='c52f2e43cc7d5875a1b13c607d7640d5';            //应用key
    const tableid  ='5b3b03a5305a2a66889d7c31';                //表ID
    const secrtekey  ='c49d81aa2cdfc78e5e421961b7b0e50f';     //私钥
//$dd=self::key;
    public function __construct($key='', $tableid='') {
        header("Content-type:text/html;charset=utf-8");
    }

    /*role_type 角色  deviceid 设备号 userid 用户id*/

    /*http://localhost/newmipush/home/Amap/creater_data*/

    /*创建表*/
    public function create_table(){
        $key=self::key;
        $secrtekey=self::secrtekey;
        $name="meiren1";
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
//        $secrtekey=self::secrtekey;
        Vendor('amap.Gaodeyuntu');
        $push = new \amap\Gaodeyuntu();

        $data1=array();
        $data1['_name']='我是来学习的???';
        $data1['_address']='安庆师范学院';
        $data1['test1']='wudi1';
        $data1['test2']='18712377079';
        $data=json_encode($data1);

//        $str="data=".$data."&key=".$key."&loctype=2&tableid=".$tableid.$secrtekey;
        $postArr = array (
            'data' =>  $data,
            'key'  =>  $key,
            'loctype' =>  "2",
            'tableid' =>  $tableid,
//            'sig'  =>  md5($str)
        );

        $cc=$push->deal_single_data($postArr);
        var_dump(json_decode($cc,true));
//        var_dump($str);
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


    /*查询当前设备周边指定半径的设备*/
    public function searcharound(){
//        $center="116.997858,30.609127";   //这块需要加入接口，供调用！
//        $center="117.233407,31.813505";   //这块需要加入接口，供调用！
        $center="117.233452,31.813459";   //这块需要加入接口，供调用！
        $key=self::key;
//        $tableid=self::tableid;
        $limit=100;
        $filter=10000;
        Vendor('amap.Gaodeyuntu');
        $push = new \amap\Gaodeyuntu();
        $data = array(
            'key' => $key,
//            'tableid' => $tableid,
            'center' => $center,
            'searchtype' => 0,    /*0：直线距离（默认），1：驾车行驶距离*/
            'radius' => $filter,   /*取值范围(1,10000]，单位：米，超出取值范围按照10公里返回*/
            'limit' => $limit,    /*取值范围 (1,100]*/
        );
        $cc=$push->search_around($data);
        var_dump(json_decode($cc,true));
    }



}