<?php
class LinkPCAction extends BaseAction
{
	public $modules;
	
	public function _initialize() 
	{
		parent::_initialize();
		
		
	}
	public function insert()
	{
		$modules = $this->modules();
		$this->assign('modules', $modules);
		$this->display();
	}
	public function modules()
	{
		
		$t = array();
		$list=M('qiniu_video')->order('id desc')->limit(100)->select();
		foreach ($list as $k => $v) {
			$data['module']='Home';
			$data['linkcode']=$v['name'];
			$data['name']=$v['beizhu']?$v['beizhu']:msubstr($v['name'],0,80);
			$data['canselected']=1;
			$data['linkurl']='';
			$data['keyword']='';
			$data['askeyword']=1;
			$t[]=$data;
		}
		

		return $t;
	}
	
	
	public function Activity()
	{
		$this->assign('moduleName', $this->modules['Activity']);
		$where = array('status' => 1, 'is_finish' => 0);
		$db = D('Extension_activity_list');
		$count      = $db->where($where)->count();
		$Page       = new Page($count, 5);
		$show       = $Page->show();
		
		$list = $db->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$items = array();
		foreach ($list as $item){
			array_push($items, array('id' => $item['pigcms_id'], 'sub' => 0, 'name' => $item['title'], 'linkcode'=> $this->config['site_url'] . '/activity/' . $item['pigcms_id'] . '.html','sublink' => '','keyword' => $item['name']));
		}
		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}
	
	public function Group()
	{
		$this->assign('moduleName', $this->modules['Group']);
		$cat_fid = isset($_GET['cat_fid']) ? intval($_GET['cat_fid']) : 0;
		$where = array('cat_fid' => $cat_fid);
		$db = D('Group_category');
		$count      = $db->where($where)->count();
		$Page       = new Page($count, 5);
		$show       = $Page->show();
		
		$list = $db->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$items = array();
		foreach ($list as $item){
			if ($db->where(array('cat_fid' => $item['cat_id']))->find()) {
				array_push($items, array('id' => $item['cat_id'], 'sub' => 1, 'name' => $item['cat_name'], 'linkcode'=> $this->config['site_url'] . '/category/' . $item['cat_url'] . '/all','sublink' => U('LinkPC/Group', array('cat_fid' => $item['cat_id']), true, false, true),'keyword' => $item['cat_name']));
			} else {
				array_push($items, array('id' => $item['cat_id'], 'sub' => 0, 'name' => $item['cat_name'], 'linkcode'=> $this->config['site_url'] . '/category/' . $item['cat_url'] . '/all','sublink' => '','keyword' => $item['cat_name']));
			}
		}
		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}
	
	public function KuaiDian()
	{
		$this->assign('moduleName', $this->modules['KuaiDian']);
		$cat_fid = isset($_GET['cat_fid']) ? intval($_GET['cat_fid']) : 0;
		$where = array('cat_fid' => $cat_fid, 'status' => 1);
		$db = D('Meal_store_category');
		$count      = $db->where($where)->count();
		$Page       = new Page($count, 5);
		$show       = $Page->show();
		
		$list = $db->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$items = array();
		foreach ($list as $item){
			if ($db->where(array('cat_fid' => $item['cat_id']))->find()) {
				array_push($items, array('id' => $item['cat_id'], 'sub' => 1, 'name' => $item['cat_name'], 'linkcode'=> $this->config['site_url'] . '/kd/' . $item['cat_url'] . '/all','sublink' => U('LinkPC/KuaiDian', array('cat_fid' => $item['cat_id']), true, false, true),'keyword' => $item['cat_name']));
			} else {
				array_push($items, array('id' => $item['cat_id'], 'sub' => 0, 'name' => $item['cat_name'], 'linkcode'=> $this->config['site_url'] . '/kd/' . $item['cat_url'] . '/all','sublink' => '','keyword' => $item['cat_name']));
			}
		}
		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}
	
	public function Meal()
	{
		$this->assign('moduleName', $this->modules['Meal']);
		$cat_fid = isset($_GET['cat_fid']) ? intval($_GET['cat_fid']) : 0;
		$where = array('cat_fid' => $cat_fid, 'status' => 1);
		$db = D('Meal_store_category');
		$count      = $db->where($where)->count();
		$Page       = new Page($count, 5);
		$show       = $Page->show();
		
		$list = $db->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$items = array();
		foreach ($list as $item){
			if ($db->where(array('cat_fid' => $item['cat_id']))->find()) {
				array_push($items, array('id' => $item['cat_id'], 'sub' => 1, 'name' => $item['cat_name'], 'linkcode'=> $this->config['site_url'] . '/kd/' . $item['cat_url'] . '/all','sublink' => U('LinkPC/KuaiDian', array('cat_fid' => $item['cat_id']), true, false, true),'keyword' => $item['cat_name']));
			} else {
				array_push($items, array('id' => $item['cat_id'], 'sub' => 0, 'name' => $item['cat_name'], 'linkcode'=> $this->config['site_url'] . '/kd/' . $item['cat_url'] . '/all','sublink' => '','keyword' => $item['cat_name']));
			}
		}
		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}
	
	public function Classify()
	{
		$this->assign('moduleName', $this->modules['Classify']);
		$where = array('subdir' => 1, 'cat_status' => 1);
		$db = D('Classify_category');
		$count      = $db->where($where)->count();
		$Page       = new Page($count, 5);
		$show       = $Page->show();
		
		$list = $db->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$items = array();
		foreach ($list as $item){
			array_push($items, array('id' => $item['cid'], 'sub' => 0, 'name' => $item['cat_name'], 'linkcode'=> $this->config['site_url'] . '/classify/subdirectory-' . $item['cid'] . 'html','sublink' => '','keyword' => $item['cat_name']));
		}
		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}
	
	public function Appoint()
	{
		$this->assign('moduleName', $this->modules['Appoint']);
		$cat_fid = isset($_GET['cat_fid']) ? intval($_GET['cat_fid']) : 0;
		$where = array('cat_fid' => $cat_fid, 'cat_status' => 1);
		$db = D('Appoint_category');
		$count      = $db->where($where)->count();
		$Page       = new Page($count, 5);
		$show       = $Page->show();
		
		$list = $db->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$items = array();
		foreach ($list as $item){
			if ($db->where(array('cat_fid' => $item['cat_id']))->find()) {
				array_push($items, array('id' => $item['cat_id'], 'sub' => 1, 'name' => $item['cat_name'], 'linkcode'=> $this->config['site_url'] . '/appoint/category/' . $item['cat_url'] . '/all','sublink' => U('LinkPC/Appoint', array('cat_fid' => $item['cat_id']), true, false, true),'keyword' => $item['cat_name']));
			} else {
				array_push($items, array('id' => $item['cat_id'], 'sub' => 0, 'name' => $item['cat_name'], 'linkcode'=> $this->config['site_url'] . '/appoint/category/' . $item['cat_url'] . '/all','sublink' => '','keyword' => $item['cat_name']));
			}
		}
		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}
	
}
?>