<?php
require_once 'vendor/aliyuncs/oss-sdk-php/autoload.php';
use OSS\OssClient;
use OSS\Core\OssException;
class AliyuncsModel extends Model{
    private $accessKeyId = OSS_ACCESSKEYID;
    private $accessKeySecret = OSS_ACCESSKEYSECRET;
    private $endpoint = OSS_ENDPOINT;
    private $bucket = OSS_BUCKEN;
    public function __construct(){
        try {
             $this->ossClient = new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpoint);
        } catch (OssException $e) {
            printf(__FUNCTION__ . "creating OssClient instance: FAILED\n");
            printf($e->getMessage() . "\n");
            die();
        }
    }
    // D('Aliyuncs')->getOosurl($object);
    public function getOosurl($object){
        if($this->accessKeyId=="OSS_ACCESSKEYID"){return false;}
        $object=trim($object,'/'); 
        $doesObjectExist=$this->doesObjectExist($object);     
        if($doesObjectExist){
            $url=$this->getSignedUrlForGettingObject($object);
        }else{  
            $uploadFile=$this->uploadFile($object,$object );
            // $uploadFile=$this->multiuploadFile($object,$object );
            $url=$this->getSignedUrlForGettingObject($object);
            if(!$this->doesObjectExist($object)){
                return false;
            } 
        }          
        return $url;
    }
    /**
     * 上传指定的本地文件内容
     *
     * @param OssClient $ossClient OssClient实例
     * @param string $bucket 存储空间名称
     * @return null
     */
    function uploadFile($object, $filePath)
    {     
        try {
            $this->ossClient->uploadFile($this->bucket, $object, $filePath, $options);
        } catch (OssException $e) {
        // printf(__FUNCTION__ . ": FAILED\n");
        // printf($e->getMessage() . "\n");
        return false;
    }
        return true;
    }
    /**
     * 获取object的内容
     *
     * @param OssClient $ossClient OssClient实例
     * @param string $bucket 存储空间名称
     * @return null
     */
    function getObject($object)
    {
        $options = array();
        try {
            $content = $this->ossClient->getObject($this->bucket, $object, $options);
        } catch (OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }
        print(__FUNCTION__ . ": OK" . "\n");
        if (file_get_contents(__FILE__) === $content) {
            print(__FUNCTION__ . ": FileContent checked OK" . "\n");
        } else {
            print(__FUNCTION__ . ": FileContent checked FAILED" . "\n");
        }
    }
    /**
     * 判断object是否存在
     *
     * @param OssClient $ossClient OssClient实例
     * @param string $bucket 存储空间名称
     * @return null
     */
    function doesObjectExist($object)
    {
        $exist = $this->ossClient->doesObjectExist($this->bucket, $object);
        if($exist){
            return ture;
        }else{
            return false;
        }
    }
    /**
     * 获取object meta, 也就是getObjectMeta接口
     *
     * @param OssClient $ossClient OssClient实例
     * @param string $bucket 存储空间名称
     * @return null
     */
    function getObjectMeta($object)
    {
        try {
            $objectMeta = $this->ossClient->getObjectMeta($this->bucket, $object);
        } catch (OssException $e) {
            return false;
        }
       return $objectMeta;
    }
    /**
     * 生成GetObject的签名url,主要用于私有权限下的读访问控制
     *
     * @param $ossClient OssClient OssClient实例
     * @param $bucket string 存储空间名称
     * @return null
     */
    function getSignedUrlForGettingObject($object)
    {
        $timeout = 3600;
        try {
            $signedUrl = $this->ossClient->signUrl($this->bucket, $object, $timeout);
        } catch (OssException $e) {
            // printf(__FUNCTION__ . ": FAILED\n");
            // printf($e->getMessage() . "\n");
            return false;
        }  
        return $signedUrl;
    }
    /**
     * 生成PutObject的签名url,主要用于私有权限下的写访问控制
     *
     * @param OssClient $ossClient OssClient实例
     * @param string $bucket 存储空间名称
     * @return null
     * @throws OssException
     */
    function getSignedUrlForPuttingObject($object)
    {
        $timeout = 3600;
        $options = NULL;
        try {
            $signedUrl = $this->ossClient->signUrl($this->bucket, $object, $timeout, "PUT");
        } catch (OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }          
        return $signedUrl;
    }
    /**
     * 生成PutObject的签名url,主要用于私有权限下的写访问控制， 用户可以利用生成的signedUrl
     * 从文件上传文件
     *
     * @param OssClient $ossClient OssClient实例
     * @param string $bucket 存储空间名称
     * @throws OssException
     */
    function getSignedUrlForPuttingObjectFromFile($object, $filePath)
    {
        $timeout = 3600;
        $options = array();
        try {
            $signedUrl = $this->ossClient->signUrl($this->bucket, $object, $timeout, "PUT", $options);
        } catch (OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }     
        return  $signedUrl;
    }
    /**
     * 通过multipart上传文件
     *
     * @param OssClient $ossClient OssClient实例
     * @param string $bucket 存储空间名称
     * @return null
     */
    function multiuploadFile($object,$file)
    {
        $options = array();

        try {
            $this->ossClient->multiuploadFile($this->bucket, $object, $file, $options);
        } catch (OssException $e) {
            // printf(__FUNCTION__ . ": FAILED\n");
            // printf($e->getMessage() . "\n");
            return;
        }
        return true;
    }
}