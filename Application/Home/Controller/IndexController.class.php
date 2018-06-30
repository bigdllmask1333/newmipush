<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {


//http://mipush.testvip.club/home/index/push
    public function push(){
        Vendor('sdk.push');
        $push = new \sdk\push();

        $user = array("2882303761517800549");

        $time1=time();

//        for ($x=0; $x<=10; $x++) {
            $push->pushs(1,$user,"标题","推送内容！");
//        }

        $time2=time();
        $t=$time2-$time1;
        echo  "<h1>".$time1."</h1>";
        echo  "<h1>".$time2."</h1>";
        echo  "<h1>".$t."</h1>";
    }

    public function iospush(){
        Vendor('sdk.iospush');
        $push = new \sdk\iospush();
        $push->index();
    }


    public function androidpush(){
        Vendor('sdk.androidpush');
        $push = new \sdk\androidpush();
        $push->index();
    }

    public function dd(){
        echo 123;
    }


}