<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function push(){
        Vendor('sdk.push');
        $push = new \sdk\push();

        $user = array("2882303761517800549");

        $time1=time();

        for ($x=0; $x<=10; $x++) {
            $push->pushs(1,$user,"标题","推送内容！");
        }
        $time2=time();
        /*推送包名
        package    com.yikuaiqian.shiye
        用户别名   APPID    2882303761517800549
        appKey   5341780066549
        secret   appSecret   jX0Qc5u9SqPwgsFJrrPoSA==*/

//至此,融合完成,调用即可进行推送,注意配置文件的写入
//        $str="qktzEm2LCPTuaWDF743INnsC7XmFDM+j5Q30CK9wj3o=";
//        $cc=base64_decode($str);
//        var_dump($cc);
        $t=$time2-$time1;
        echo  "<h1>".$time1."</h1>";
        echo  "<h1>".$time2."</h1>";
        echo  "<h1>".$t."</h1>";
    }

    public function dd(){
        echo 123;
    }

    /*云图插入
    * 第一步：创建表
    */
    public function jianbiao(){
        header("Content-type:text/html;charset=utf-8");
        $str="key=77978e28102a6a5304e26275ef5c5468&name=wulaoshic49d81aa2cdfc78e5e421961b7b0e50f";
        $postArr = array (
            'key'  =>  "77978e28102a6a5304e26275ef5c5468",
            'name' =>  "wulaoshi",
            'sig'  =>  md5($str)
        );
        $url="http://yuntuapi.amap.com/datamanage/table/create";
        $datas=$this->curlPostyuntu($url,$postArr);
        var_dump($postArr);
        var_dump($datas);
    }
/**********************************************************************
'{"info":"OK","infocode":"10000","status":1,"tableid":"5b2c683aafdf522fe23a9312"}'
http://localhost/mipush/home/index/jianbiao
**********************************************************************/


    /*创建数据（单条）
    * 获取数字签名  涉及到一个私钥问题，需要拼接到最后面
    */
    public function createdata(){
        header("Content-type:text/html;charset=utf-8");
        $data1=array();
        $data1['_name']='大神带带我';
        $data1['_address']='合肥市第一人民医院西区';
        $data1['test1']='测试2';
        $data1['test2']='测试3';
        $data=json_encode($data1);

        $str="data=".$data."&key=77978e28102a6a5304e26275ef5c5468&loctype=2&tableid=5b2c683aafdf522fe23a9312c49d81aa2cdfc78e5e421961b7b0e50f";

        $postArr = array (
            'data' =>  $data,
            'key'  =>  "77978e28102a6a5304e26275ef5c5468",
            'loctype' =>  "2",
            'tableid' =>  "5b2c683aafdf522fe23a9312",
            'sig'  =>  md5($str)
        );
        $url="http://yuntuapi.amap.com/datamanage/data/create";
        $datas=$this->curlPostyuntu($url,$postArr);
        var_dump($postArr);
        var_dump($datas);
        var_dump($str);
    }

    /*目前创建了一条数据
    '{"info":"OK","infocode":"10000","status":1,"_id":"1"}'
    '{"info":"OK","infocode":"10000","status":1,"_id":"2"}'
    '{"info":"OK","infocode":"10000","status":1,"_id":"3"}'
     '{"info":"OK","infocode":"10000","status":1,"_id":"4"}'
     '{"info":"OK","infocode":"10000","status":1,"_id":"5"}'
    删除了 2,3两条数据
    */



    /*多条数据插入
    * 取数字签名  涉及到一个私钥问题，需要拼接到最后面（严格按照规则来，绝对没错）
    * 向指定tableid的数据表中通过上传文件的方式创建多条数据
    * 这个接口暂时用不到
    */

    /*
     * 批量创建进度查询接口
     *
     */


    /*更新数据（单条）
    * 取数字签名  涉及到一个私钥问题，需要拼接到最后面（严格按照规则来，绝对没错）
    * 需要注意不能弄错了表名
    */
    public function updatas(){
        header("Content-type:text/html;charset=utf-8");
        $data1=array();
        $data1['_id']='1';
        $data1['_name']='大神带带我';
        $data1['_address']='合肥市第一人民医院西区1';
        $data1['test1']='测试1';
        $data1['test2']='测试2';
        $data=json_encode($data1);

        $str="data=".$data."&key=77978e28102a6a5304e26275ef5c5468&loctype=2&tableid=5b2c683aafdf522fe23a9312c49d81aa2cdfc78e5e421961b7b0e50f";

        $postArr = array (
            'data' =>  $data,
            'key'  =>  "77978e28102a6a5304e26275ef5c5468",
            'loctype' =>  "2",
            'tableid' =>  "5b2c683aafdf522fe23a9312",
            'sig'  =>  md5($str)
        );
        $url="http://yuntuapi.amap.com/datamanage/data/update";
        $datas=$this->curlPostyuntu($url,$postArr);
        var_dump($postArr);
        var_dump($datas);
        var_dump($str);
    }

    /*执行了一次
     '{"info":"OK","infocode":"10000","status":1}'
    */


    /*删除数据（单条/批量）↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
    * 删除指定tableid的数据表中的数据，一次请求限制删除1-50条数据。
    */
    public function deldata(){
        header("Content-type:text/html;charset=utf-8");
        $str="ids=2,3&key=77978e28102a6a5304e26275ef5c5468&tableid=5b2c683aafdf522fe23a9312c49d81aa2cdfc78e5e421961b7b0e50f";
        $postArr = array (
            'key'  =>  "77978e28102a6a5304e26275ef5c5468",
            'ids' =>  "2,3",
            'tableid' =>  "5b2c683aafdf522fe23a9312",
            'sig'  =>  md5($str)
        );
        $url="http://yuntuapi.amap.com/datamanage/data/delete";
        $datas=$this->curlPostyuntu($url,$postArr);
        var_dump($postArr);
        var_dump($datas);
        var_dump($str);
    }
    /*
     * '{"info":"OK","infocode":"10000","status":1,"success":2,"fail":0}'
    */






    /*↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙↙*/
    /*下面是对数据检索的操作*/
    /*id检索*/

    public function SearchId(){
//        $str="_id=1&key=77978e28102a6a5304e26275ef5c5468&tableid=5b2c683aafdf522fe23a9312c49d81aa2cdfc78e5e421961b7b0e50f";
        $str="key=77978e28102a6a5304e26275ef5c5468&tableid=5b2c683aafdf522fe23a9312&_id=1c49d81aa2cdfc78e5e421961b7b0e50f";
//        $str="key=77978e28102a6a5304e26275ef5c5468&_id=1&tableid=5b2c683aafdf522fe23a9312c49d81aa2cdfc78e5e421961b7b0e50f";
        $siyue="c49d81aa2cdfc78e5e421961b7b0e50f";

        $postArr = array (
            'tableid' =>  "5b2c683aafdf522fe23a9312",
            '_id' =>  "1",
            'key'  =>  "77978e28102a6a5304e26275ef5c5468",
            'sig' =>md5($str),
        );

        $cc=http_build_query($postArr);
        $urls="http://yuntuapi.amap.com/datasearch/id?".$cc;
        $datas=$this->curlPostyuntu($urls);

        var_dump($postArr);
        var_dump($datas);
        var_dump($urls);
        var_dump($str);

    }

    /*
     * {"info":"INVALID_USER_SIGNATURE","infocode":"10007","status":"0","sec_code_debug":"d41d8cd98f00b204e9800998ecf8427e","key":"77978e28102a6a5304e26275ef5c5468","sec_code":"d41d8cd98f00b204e9800998ecf8427e"}
        一直报签名的错误！这是一个问题，需要解决，表面上是服务器错误，实际就是签名错误
    */






    public function curlGetyuntu($url){
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        return $data;
    }


    /**
     * 通过CURL发送HTTP请求
     * @param string $url  //请求URL
     * @param array $postFields //请求参数
     * @return mixed
     *
     */
    //post方式发送请求
    public function curlPostyuntu($url,$fields,$timeout=10){
        $headers = array(
            'Content-Type: application/x-www-form-urlencoded;charset=utf-8');
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
//        print_r('HTTP Params <br> '.urldecode(http_build_query($fields)));
//        echo'<br>';
        // Execute post
        $result = curl_exec($ch);
        // Close connection
        curl_close($ch);
        return $result;
    }


    /*public function jianbiao(){
        header("Content-type:text/html;charset=utf-8");
        $str="key=77978e28102a6a5304e26275ef5c5468&name=wulaoshic49d81aa2cdfc78e5e421961b7b0e50f";
        $postArr = array (
            'key'  =>  "77978e28102a6a5304e26275ef5c5468",
            'name' =>  "wulaoshi",
            'sig'  =>  md5($str)
        );
        $url="http://yuntuapi.amap.com/datamanage/table/create";
        $datas=$this->curlPostyuntu($url,$postArr);
        var_dump($postArr);
        var_dump($datas);
    }*/


    public function wuinsert(){
        header("Content-type:text/html;charset=utf-8");
        Vendor('amap.Gaodeyuntu');
        $push = new \amap\Gaodeyuntu();
        $str="key=77978e28102a6a5304e26275ef5c5468&name=laosctc49d81aa2cdfc78e5e421961b7b0e50f";
        $sin=md5($str);
        $name="laosct";
        $cc=$push->create_table($name,$sin);
        var_dump($cc);
    }
}