<?php
/**
 * Created by PhpStorm.
 * User: yingfu
 * Date: 2017/9/26
 * Time: 15:19
 */
//include_once 'aliyuncs/aliyun-php-sdk-core/Config.php';
//Vendor('aliyuncs/aliyun-php-sdk-core/Config.');
require_once 'vendor/aliyuncs/aliyun-php-sdk-core/Config.php';
use Green\Request\V20170112 as Green;
class TextScan {
    static  function text($content){
        date_default_timezone_set("PRC");
//        $ak = parse_ini_file("aliyun.ak.ini");
        $ak=array('accessKeyId'=>OSS_ACCESSKEYID,'accessKeySecret'=>OSS_ACCESSKEYSECRET);
//请替换成你自己的accessKeyId、accessKeySecret
        $iClientProfile = DefaultProfile::getProfile("cn-shanghai", $ak["accessKeyId"], $ak["accessKeySecret"]); // TODO
        DefaultProfile::addEndpoint("cn-shanghai", "cn-shanghai", "Green", "green.cn-shanghai.aliyuncs.com");
        $client = new DefaultAcsClient($iClientProfile);
        $request = new Green\TextScanRequest();
        $request->setMethod("POST");
        $request->setAcceptFormat("JSON");
        $task1 = array('dataId' =>  uniqid(),
            'content' => $content
        );     
       
             
        /**
         * 文本垃圾检测： antispam
         * 关键词检测： keyword
         **/

        $request->setContent(json_encode(array("tasks" => array($task1),
            "scenes" => array("antispam"))));
        try {
            $response = $client->getAcsResponse($request);
//            echo "<pre>";
//            print_r($response);
//            echo "</pre>";
            $result=array();
            if(200 == $response->code){
                $taskResults = $response->data;
                foreach ($taskResults as $taskResult) {
                    if(200 == $taskResult->code){
                        $sceneResults = $taskResult->results;
                        foreach ($sceneResults as $sceneResult) {
                            $scene = $sceneResult->scene;
                            $suggestion = $sceneResult->suggestion;
                            //根据scene和suggetion做相关的处理
                            //do something
//                            print_r($scene);
//                            print_r($suggestion);
                            $result=$taskResult;
                        }
                    }else{
                        print_r("task process fail:" + $response->code);
                    }
                }
            }else{
                print_r("detect not success. code:" + $response->code);
            }
            $result=$result->results[0];
            if($result){
                $result->labelname=self::getlabel($result->label);
            }
            $result=json_decode(json_encode($result),true);
            if($result['label']=='normal'){
                return self::ary_success($result);
            }else{
                return self::ary_error($result);
            }
            return $result;
        } catch (Exception $e) {
            print_r($e);
        }

    }
    private function getlabel($label){
        switch ($label){
            case  'normal':
                return '正常文本';
                break;
            case  'spam':
                return '含垃圾信息';
                break;
            case  'ad':
                return '广告';
                break;
            case  'politics':
                return '渉政';
                break;
            case  'terrorism':
                return '暴恐';
                break;
            case  'abuse':
                return '辱骂';
                break;
            case  'porn':
                return '色情';
                break;
            case  'flood':
                return '灌水';
                break;
            case  'contraband':
                return '违禁';
                break;
            case  'customized':
                return '包含敏感词';
                break;
            default:
                return '';
                break;
        }
    }
    static function ary_success($data = null, $name = 'Data')
    {
        if ($data === null) {
            return array('nFlag' => 1);
        }
        return array('nFlag' => 1, $name => $data);
    }
    static function ary_error($error, $nFlag = 0)
    {
        return array('nFlag' => $nFlag, 'strError' => $error);
    }

}