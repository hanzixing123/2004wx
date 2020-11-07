<?php

namespace App\Http\Controllers\WX;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    //


    public function  index(){
        $echostr = request()->get("echostr", "");
        if ($this->checkSignature() && !empty($echostr)) {

            //第一次接入
            echo $echostr;
        }else{

           // $access_token=$this->get_access_token();  //跳方法  调 access_token  获取access_token
            $str=file_get_contents("php://input");
            $obj = simplexml_load_string($str,"SimpleXMLElement",LIBXML_NOCDATA);
            // $obj=json_decode($obj, true);
            // file_put_contents("aaa.txt",$obj);
            // echo "ok";
                switch ($obj->MsgType) {
                    case 'event':
                        if($obj->Event=="subscribe"){
                            //用户扫码的 openID
                            $openid=$obj->FromUserName;//获取发送方的 openid 
                            $access_token=$this->get_access_token();//获取token,
                            $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
                            //掉接口
                            $user=json_decode($this->http_get($url),true);//跳方法 用get  方式调第三方类库
                   // $this->writeLog($fens);
                            if(isset($user["errcode"])){
                                $this->writeLog("获取用户信息失败");
                            }else{
                                //说明查找成功 //可以加入数据库 

                                $content="您好!感谢您的关注";
                            }
                        }
//                        if($obj->Event=="unsubscribe"){
//                                $content="取消关注成功,期待您下次关注";
//
//                        }


                        break;
                        
                

                }
       

            echo $this->xiaoxi($obj,$content);

        }



    }




    private function checkSignature()
    {
        $signature = request()->get("signature");
        $timestamp = request()->get("timestamp");
        $nonce = request()->get("nonce");

        $token ="lishang";
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
    private  function writeLog($data){// 错误写入文件好找
        if(is_object($data) ||is_array($data)){
            $data=json_encode($data);
        }
        file_put_contents("aaa.txt",$data);die;


    }



        function xiaoxi($obj,$content){ //返回消息
        //我们可以恢复一个文本|图片|视图|音乐|图文列如文本
            //接收方账号
        $toUserName=$obj->FromUserName;
           //开发者微信号
        $fromUserName=$obj->ToUserName;
           //时间戳
        $time=time();
           //返回类型
        $msgType="text";

        $xml = "<xml>
                      <ToUserName><![CDATA[%s]]></ToUserName>
                      <FromUserName><![CDATA[%s]]></FromUserName>
                      <CreateTime>%s</CreateTime>
                      <MsgType><![CDATA[%s]]></MsgType>
                      <Content><![CDATA[%s]]></Content>
                    </xml>";
            //替换掉上面的参数用 sprintf
        echo sprintf($xml,$toUserName,$fromUserName,$time,$msgType,$content);
    }




}
