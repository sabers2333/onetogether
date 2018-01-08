<?php
require_once 'vendor/aliyuncs/oss-sdk-php/autoload.php';
include_once 'vendor/aliyun-openapi-php-sdk/aliyun-php-sdk-core/Config.php';
use OSS\OssClient;
use Mts\Request\V20140618 as Mts;
class AliyunModel extends Model{
    private $mts_region = MTS_REGION;
    private $oss_region = OSS_REGION;
    private $mts_endpoint = MTS_ENDPOINT;
    private $accessKeyId = OSS_ACCESSKEYID;
    private $accessKeySecret = OSS_ACCESSKEYSECRET;
    private $endpoint = OSS_ENDPOINT;
    private $bucket = OSS_BUCKEN;
    private $transcode_template_id = TRANSCODE_TMPLATED_ID;
    private $pipeline_id = PIPELINE_ID;
    private $watermark_template_id = WATERMARK_TEMPLATED_ID;
    public function __construct(){
      $profile = DefaultProfile::getProfile('mts-cn-shenzhen',
                                   $this->accessKeyId,
                                   $this->accessKeySecret);
          $this->client = new DefaultAcsClient($profile);     
    }
    function search_media_workflow($client, $regionId)
      {
          $request = new Mts\SearchMediaWorkflowRequest();
          $request->setAcceptFormat('JSON');
          $request->setRegionId($regionId); //重要
          $response = $this->client->getAcsResponse($request); 
          return $response;
      }
      function upload_file($filename, $obj)
      {
          $ossClient = new OssClient($this->accessKeyId,
                                     $this->accessKeySecret,
                                     $this->endpoint,
                                     false);
          $ossClient->uploadFile($this->bucket, $obj, $filename);     
          return array(
              'Location' => $this->oss_region,
              'Bucket' => $this->bucket,
              'Object' => urlencode($obj)
          );
      }
      function snapshot_job_flow($input_file)
      {
          $snapshot_job = $this->submit_snapshot_job($input_file);      
          return urldecode($snapshot_job->{'SnapshotConfig'}->{'OutputFile'}->{'Object'});
      }
      function submit_snapshot_job($input_file)
      {
          $obj = urldecode($input_file['Object']); 
          $ext = strrchr($obj,'/');    
          $data=explode($ext, $obj);
          $datas=$data[0].'/snapshots'.$ext.'.jpg'; 
          $snapshot_output = array(
              'Location' => $this->oss_region,
              'Bucket' => OSS_BUCKEN,
              'Object' => urlencode($datas)
          );
          $snapshot_config = array(
              'OutputFile' => $snapshot_output,
              'Time' => 5000
          );        
          $request = new Mts\SubmitSnapshotJobRequest();
          $request->setAcceptFormat('JSON');
          $request->setInput(json_encode($input_file));
          $request->setSnapshotConfig(json_encode($snapshot_config));
          $response = $this->client->getAcsResponse($request);  
          $SnapshotJob=$response->{'SnapshotJob'};
          return $SnapshotJob;
      }
      function transcode_job_flow($input_file)
      {
        /*$input_file=array(
              'Location' => $this->oss_region,
              'Bucket' => $this->bucket,
              'Object' => urlencode($obj)
          );*/
        $watermark = '32x32.png';
        $watermark_file=array(
              'Location' => $this->oss_region,
              'Bucket' => $this->bucket,
              'Object' => urlencode($watermark)
          );     
          // $this->system_template_job_flow($input_file, $watermark_file); 
          $transcode_job_id=$this->user_custom_template_job_flow($input_file, $watermark_file);
          return $transcode_job_id;
      }
      function system_template_job_flow($input_file, $watermark_file)
      {
          $analysis_id = $this->submit_analysis_job($input_file);
          $analysis_job = $this->wait_analysis_job_complete($analysis_id);     
          $template_ids = $this->get_support_template_ids($analysis_job); 
          # 可能会有多个系统模板，这里采用推荐的第一个系统模板进行转码
          $transcode_job_id = $this->submit_transcode_job($input_file, $watermark_file, $template_ids[0]);     
          $transcode_job = $this->wait_transcode_job_complete($transcode_job_id);         
          
          print 'Transcode success, the target file url is http://' .
              $transcode_job->{'Output'}->{'OutputFile'}->{'Bucket'} . '.' .
              $transcode_job->{'Output'}->{'OutputFile'}->{'Location'} . '.aliyuncs.com/' .
              urldecode($transcode_job->{'Output'}->{'OutputFile'}->{'Object'}) . "\n";
      }
      function submit_analysis_job($input_file)
      {
          $request = new Mts\SubmitAnalysisJobRequest();
          $request->setAcceptFormat('JSON');
          $request->setInput(json_encode($input_file));
          $request->setPriority(5);
          $request->setUserData('SubmitAnalysisJob userData');
          $request->setPipelineId($this->pipeline_id);  
          $response = $this->client->getAcsResponse($request);  
          return $response->{'AnalysisJob'}->{'Id'};
      }
      function wait_analysis_job_complete($analysis_id)
      {
          while (true)
          {
              $request = new Mts\QueryAnalysisJobListRequest();
              $request->setAcceptFormat('JSON');
              $request->setAnalysisJobIds($analysis_id);
              $response = $this->client->getAcsResponse($request);     
              $state = $response->{'AnalysisJobList'}->{'AnalysisJob'}[0]->{'State'};
              if ($state != 'Success')
              {
                  if ($state == 'Submitted' or $state == 'Analyzing')
                  {
                      sleep(5);
                  } elseif ($state == 'Fail') {
                      print 'AnalysisJob is failed!';
                      return null;
                  }
              } else {
                  return $response->{'AnalysisJobList'}->{'AnalysisJob'}[0];
              }echo $state;
          }
          return null;
      }
      function get_support_template_ids($analysis_job)
      {
          $result = array();
          foreach ($analysis_job->{'TemplateList'}->{'Template'} as $template)
          {
              $result[] = $template->{'Id'};
          }
          return $result;
      }
      function submit_transcode_job($input_file, $watermark_file, $template_id)
      {    
          $watermark_config = array();
          $watermark_config[] = array(
              'InputFile' => json_encode($watermark_file),
              'WaterMarkTemplateId' => $this->watermark_template_id
          );
          $obj = urldecode($input_file['Object']); 
          $ext = strrchr($obj,'/');    
          $data=explode($ext, $obj);
          $datas=$data[0].'/transcode'.$ext;
          // $output_bucket=dirname($obj).'/';
          $output_bucket=$this->bucket;
          $outputs = array();
          $outputs[] = array(
              'OutputObject'=> urlencode($datas),
              'TemplateId' => $template_id,
              'WaterMarks' => $watermark_config
          );  
          $request = new Mts\SubmitJobsRequest();
          $request->setAcceptFormat('JSON');
          $request->setInput(json_encode($input_file));
          $request->setOutputBucket($output_bucket);
          $request->setOutputLocation($this->oss_region);
          $request->setOUtputs(json_encode($outputs));
          $request->setPipelineId($this->pipeline_id);

          $response = $this->client->getAcsResponse($request);   

        
                 
          return $response->{'JobResultList'}->{'JobResult'}[0]->{'Job'}->{'JobId'};
      }
      function wait_transcode_job_complete($transcode_job_id)
      {
          while (true)
          {
              $request = new Mts\QueryJobListRequest();
              $request->setAcceptFormat('JSON');
              $request->setJobIds($transcode_job_id);
              $response = $this->client->getAcsResponse($request);
              $state = $response->{'JobList'}->{'Job'}[0]->{'State'};     
              if ($state != 'TranscodeSuccess')
              {
                  if ($state == 'Submitted' or $state == 'Transcoding')
                  {
                      sleep(5);
                  } elseif ($state == 'TranscodeFail') {
                      print 'Transcode is failed!';
                      return null;
                  }
              } else {
                  return $response->{'JobList'}->{'Job'}[0];
              }
          }
          return null;
      }
      function user_custom_template_job_flow($input_file, $watermark_file)
      {  
          $transcode_job_id = $this->submit_transcode_job($input_file, $watermark_file, $this->transcode_template_id);         
          return $transcode_job_id;
      }
      public function get_transcode_job($transcode_job_id){
        $transcode_job = $this->wait_transcode_job_complete($transcode_job_id);  
        $transcode_url=urldecode($transcode_job->{'Output'}->{'OutputFile'}->{'Object'});
        return $transcode_url;
      }
}