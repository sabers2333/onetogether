<?php
/*
 * 导航管理
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/12/02 9:43
 * 
 */

class SliderAction extends BaseAction{
	public function index(){
		$database_slider_category  = D('Slider_category');
		$category_list = $database_slider_category->field(true)->order('`cat_id` ASC')->select();
		$this->assign('category_list',$category_list);
		$this->display();
	}
	
	public function cat_add(){
		$this->assign('bg_color','#F3F3F3');
		$this->display();
	}
	public function cat_modify(){
		if(IS_POST){
			$_POST['intro']=fulltext_filter($_POST['intro']);
			$database_slider_category  = D('Slider_category');
			if($database_slider_category->data($_POST)->add()){
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function cat_edit(){
		$this->assign('bg_color','#F3F3F3');
		$now_category = $this->frame_check_get_category($_GET['cat_id']);
		$this->assign('now_category',$now_category);
		$this->display();
	}
	public function cat_amend(){
		if(IS_POST){
			$_POST['intro']=fulltext_filter($_POST['intro']);
			$database_slider_category  = D('Slider_category');
			if($database_slider_category->data($_POST)->save()){
				$this->success('编辑成功！');
			}else{
				$this->error('编辑失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function cat_del(){
		if(IS_POST){
			$database_slider_category  = D('Slider_category');
			$condition_slider_category['cat_id'] = $_POST['cat_id'];
			if($database_slider_category->where($condition_slider_category)->delete()){
				//删除所有广告
				$database_slider = D('Slider');
				$condition_slider['cat_id'] = $now_category['cat_id'];
				$slider_list = $database_slider->field(true)->where($condition_slider)->order('`id` DESC')->select();
				foreach($slider_list as $key=>$value){
					unlink('./upload/slider/'.$value['pic']); 
				}
				$database_slider->where($condition_slider)->delete();
				S('slider_list_'.$_POST['cat_id'],NULL);
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}

	public function slider_list(){
		$now_category = $this->check_get_category($_GET['cat_id']);
		$this->assign('now_category',$now_category);
		$database_slider = D('Slider');
		$condition_slider['cat_id'] = $now_category['cat_id'];
		$slider_list = $database_slider->field(true)->where($condition_slider)->order('`id` desc')->select();
		$this->assign('slider_list',$slider_list);
		$this->display();
	}
	public function slider_add(){
		$this->assign('bg_color','#F3F3F3');
		$now_category = $this->frame_check_get_category($_GET['cat_id']);
		$this->assign('now_category',$now_category);
		$this->display();
	}
	public function slider_modify(){
		 $_POST['duration']=$duration;

	     
		if($_FILES['pic']['error'] != 4){
			$image = D('Image')->handle($this->system_session['id'], 'slider');
			if (!$image['error']) {
				$_POST = array_merge($_POST, str_replace('/upload/slider/', '', $image['url']));
				     
			} else {
				$this->frame_submit_tips(0, $image['msg']);
			}
		}
		$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
		$_POST['content']=fulltext_filter($_POST['content']);
		$database_slider = D('Slider');
		if($id = $database_slider->data($_POST)->add()){
			D('Image')->update_table_id('/upload/slider/' . $_POST['pic'], $id, 'slider');
			S('slider_list_'.$_POST['cat_id'],NULL);
			$this->frame_submit_tips(1,'添加成功！');
		}else{
			$this->frame_submit_tips(0,'添加失败！请重试~');
		}
	}
	public function slider_edit(){
		$this->assign('bg_color','#F3F3F3');
		$database_slider = D('Slider');
		$condition_slider['id'] = $_GET['id'];
		$now_slider = $database_slider->field(true)->where($condition_slider)->find();
		if(empty($now_slider)){
			$this->frame_error_tips('该导航不存在！');
		}
		$this->assign('now_slider',$now_slider);
		$this->display();
	}
	public function slider_amend(){
		$database_slider = D('Slider');
		$condition_slider['id'] = $_POST['id'];
		$now_slider = $database_slider->field(true)->where($condition_slider)->find();
		if($_FILES['pic']['error'] != 4){
			$image = D('Image')->handle($this->system_session['id'], 'slider');
			if (!$image['error']) {
				$_POST = array_merge($_POST, str_replace('/upload/slider/', '', $image['url']));
				//$_POST = array_merge($_POST, $image['url']);
			} else {
				$this->frame_submit_tips(0, $image['msg']);
			}
		}

		$_POST['duration']=$duration;

		$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
		$_POST['content']=fulltext_filter($_POST['content']);
		     
		if($database_slider->data($_POST)->save()){
			D('Image')->update_table_id('/upload/slider/' . $_POST['pic'], $_POST['id'], 'slider');
			S('slider_list_'.$_POST['cat_id'],NULL);
			if($_POST['pic']){
				if(strpos($now_slider['pic'],'2014/') === false){
					unlink('./upload/slider/'.$now_slider['pic']); 
				}
			}
			$this->frame_submit_tips(1,'编辑成功！');
		}else{
			$this->frame_submit_tips(0,'编辑失败！请重试~');
		}
	}
	public function slider_del(){
		$database_slider = D('Slider');
		$condition_slider['id'] = $_POST['id'];
		$now_slider = $database_slider->field(true)->where($condition_slider)->find();
		if($database_slider->where($condition_slider)->delete()){
			S('slider_list_'.$now_slider['cat_id'],NULL);
			if($now_slider['pic']){
				if(strpos($now_slider['pic'],'2014/') === false){
					unlink('./upload/slider/'.$now_slider['pic']); 
				}
			}
			$this->success('删除成功');
		}else{
			$this->error('删除失败！请重试~');
		}
	}
	protected function get_category($cat_id){
		$database_slider_category  = D('Slider_category');
		$condition_slider_category['cat_id'] = $cat_id;
		$now_category = $database_slider_category->field(true)->where($condition_slider_category)->find();
		return $now_category;
	}
	protected function frame_check_get_category($cat_id){
		$now_category = $this->get_category($cat_id);
		if(empty($now_category)){
			$this->frame_error_tips('分类不存在！');
		}else{
			return $now_category;
		}
	}
	protected function check_get_category($cat_id){
		$now_category = $this->get_category($cat_id);
		if(empty($now_category)){
			$this->error_tips('分类不存在！');
		}else{
			return $now_category;
		}
	}
	
    //设置防盗链
	/*public function editvideo($videoname,$key){     /
		 $url=C('QINIU_DEMAIN').$videoname;
		 $time=dechex(time()); 
         $S = C('QINIU_KEY').urldecode('/'.$videoname) .$time;
         $SIGN = strtolower(md5($S));   
        if($videoname){
            if($key){
                $m3u8=C('QINIU_DEMAIN').$key;
                $m3u8=$m3u8.'?sign='.$SIGN.'&t='.$time;
            }
           
           $newurl=$url.'?sign='.$SIGN.'&t='.$time;
            
        }     
             
        $data['m3u8']=$m3u8;
        $data['newurl']=$newurl; 
             
        return $data;
    }*/
}