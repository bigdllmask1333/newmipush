<?php
namespace Home\Controller;
use Think\Controller;

/*
 * http://localhost/newmipush/home/index/push
 * http://localhost/newmipush/home/index/iospush
 * http://localhost/newmipush/home/index/androidpush
 *
 *  重点需要注意的是测试环境还是正式环境！安卓版本必须是正式环境，测试环境不支持！IOS使用的是测试环境
 * 小米推送操作类演示*/


class IndexController extends Controller {

    /*这个是网路上找的，不是很实用，作为参考！*/
    public function push(){
        Vendor('sdk.push');
        $push = new \sdk\push();
        $user = array("2882303761517800549");
        $time1=time();
        $push->pushs(1,$user,"标题","推送内容！");
        $time2=time();
        $t=$time2-$time1;
        echo  "<h1>".$time1."</h1>";
        echo  "<h1>".$time2."</h1>";
        echo  "<h1>".$t."</h1>";
    }

    /*IOS推送*/
    public function iospush(){
        Vendor('sdk.iospush');
        $push = new \sdk\iospush();
        $push->index();
    }

    /*Android推送*/
    public function androidpush(){
        Vendor('sdk.androidpush');
        $push = new \sdk\androidpush();
        $push->index();
    }
}