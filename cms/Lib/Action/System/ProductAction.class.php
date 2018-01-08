<?php
/*
 * 团购管理
 *
 */
require 'static/phpsdk/autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
class ProductAction extends BaseAction{
    public function index(){

  // 用于签名的公钥和私钥
  $accessKey = 'hAFZLyFpyE1K8JsxaE1pQIlniaZqu3-WNfN7BZ43';
  $secretKey = 'fdRRRJ2wOenJhw6eYvp4oiPIMCtvBNx98fZBbiDi';
  // 初始化签权对象
  $auth = new Auth($accessKey, $secretKey);
 // 空间名  https://developer.qiniu.io/kodo/manual/concepts
  $bucket = 'quweizhichang-test';
  // 生成上传Token
  $token = $auth->uploadToken($bucket);

 // 构建 UploadManager 对象
  $uploadMgr = new UploadManager();
       



        $this->display();
    }
     public function add() {
        $id=$_GET['id'];
        if($id){
            $product=M('product')->where('id='.$id)->find();
            $this->assign('ac',$product);
        }
        $this->display();
    }
    public function add_modify(){
        if(IS_POST){
            $_POST['addtime']=date('Y-m-d H:i:s',time());
            $_POST['desc'] = fulltext_filter($_POST['desc']);
            $_POST['r_title'] = nl2br($_POST['r_title']);
            $_POST['r_info'] = nl2br($_POST['r_info']);
            $product = M('product');
            $id=$_POST['id'];
            unset($_POST['id']);
            if($id){
                $result=$product->where('id='.$id)->data($_POST)->save();
                if($result){
                    $this->success('修改成功');
                }else{
                    $this->error('修改失败！请重试~');
                }
            }else{
                if($product->data($_POST)->add()){
                    $this->success('添加成功！');
                }else{
                    $this->error('添加失败！请重试~');
                }
            }
        }else{
            $this->error('非法提交,请重新提交~');
        }
    }
    public function ajax_upload_pic(){
        if($_FILES['imgFile']['error'] != 4){
            $image = D('Image')->handle($this->system_session['id'], 'product', 0, array('size' => 3), false);
            if (!$image['error']) {
                exit(json_encode(array('error' => 0,'url' => $image['url']['imgFile'], 'title' => $image['title']['imgFile'])));
            }
            exit(json_encode($image));
        }else{
            exit(json_encode(array('error' => 1,'message' =>'没有选择图片')));
        }
    }
     public function product_del(){
        if(IS_POST){
            $product = M('product');
            $id['id'] = intval($_POST['id']);
            $now_product = $product->where($id)->find();
            if($product->where($id)->delete()){
                $this->success('删除成功！');
            }else{
                $this->error('删除失败！请重试~');
            }
        }else{
            $this->error('非法提交,请重新提交~');
        }
    }
}