<?php

require 'static/phpsdk/autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Qiniu\Storage\BucketManager;
class QiniuModel extends Model
{
	public function __construct(){
        $accessKey = C('QINIU_ACCESSKEY');
        $secretKey = C('QINIU_SECRETKEY');
        // 构建鉴权对象
        $this->auth = new Auth($accessKey, $secretKey); 
    }
	
	//私有空间下载凭证
    public function editvideo($videoname){     
        $DownloadUrl =C('QINIU_DEMAIN').$videoname;   
           // 需要填写你的 Access Key 和 Secret Key
        //baseUrl构造成私有空间的域名/key的形式
        $authUrl = $this->auth->privateDownloadUrl($DownloadUrl);
        $key=M('qiniu_video')->where("name='$videoname'")->getfield('key');
        if($key){
            $m3u8=C('QINIU_DEMAIN').$key."?pm3u8/0/43200";
            $m3u8=$this->auth->privateDownloadUrl($m3u8);
        }

        $data['m3u8']=$m3u8;
        $data['newurl']=$authUrl; 
                  
        return $data;
    }
    //后台私有空间下载凭证
	public function editvideoadmin($videoname,$key){     
		$DownloadUrl =C('QINIU_DEMAIN').$videoname;     
	    //baseUrl构造成私有空间的域名/key的形式
	    $authUrl = $this->auth->privateDownloadUrl($DownloadUrl);
        if($key){
            $m3u8=C('QINIU_DEMAIN').$key;
            $m3u8=$this->auth->privateDownloadUrl($m3u8);
        }
        $data['m3u8']=$m3u8;
        $data['newurl']=$authUrl; 
             
        return $data;
    }
    //获取视频事件
    public function getduration($videoname){
    	$DownloadUrl =C('QINIU_DEMAIN').$videoname.'?avinfo';  
        $authUrl = $this->auth->privateDownloadUrl($DownloadUrl);  
             
        $info=httpRequest($authUrl);
        $info=json_decode($info[1],true);
        $duration=$info['format']['duration'];
        $duration=changeTimeType($duration);
        return $duration;

    }
    //上传视频
    public function videoadd(){     
         
		$url='http://'.$_SERVER['HTTP_HOST'].'/index.php?c=Index&a=qiniunotify';  
             
		// 空间名  https://developer.qiniu.io/kodo/manual/concepts
	  $bucket = C('QINIU_BACKET');
	
	   $wmImg = \QiNiu\base64_urlSafeEncode(' http://onk4v18gc.bkt.clouddn.com/zc_logo.png');
		$pfopOps = "avthumb/m3u8";
        $pipeline ='';
        $policy = array(
            'persistentOps' => $pfopOps,
            'persistentNotifyUrl' => $url,
            'persistentPipeline' => $pipeline,
        );
	  // 生成上传Token
	  $token = $this->auth->uploadToken($bucket,null,3600,$policy);
	  $data['token']=$token;
	  $data['key']=date("YmdHis",time());
	  $data['demain']=C('QINIU_DEMAIN');
	  $data['time']=md5(time());
	  return $data;


	}
	
}
?>