<?php
class UserModel extends Model
{
	/*得到所有用户*/
	public function get_user($uid,$field='uid')
	{
		$condition_user[$field] = $uid;
		$now_user = $this->field(true)->where($condition_user)->find();
		if(!empty($now_user)){
			$now_user['now_money'] = floatval($now_user['now_money']);
		}
		return $now_user;
	}
	/*帐号密码检入*/
	public function checkin($phone,$pwd){
		if (empty($phone)){
			return array('error_code' => true, 'msg' => '手机号不能为空');
		}
		if (empty($pwd)){
			return array('error_code' => true, 'msg' => '密码不能为空');
		}
		/****单点登录接口***/
		$UserEvent = A('User','Event');
		$UserEvent->_initialize();
		$salt=$UserEvent->getUserSalt($phone);
		define('HTTP_TIME', time());
		$password=md5(md5($salt['Data']['strSalt'].$pwd).HTTP_TIME);
		$result = $UserEvent->login($salt['Data']['nUserID'],$password,HTTP_TIME);
		if($result['nFlag']!=1)return array('error_code' => true, 'msg' => '展翅网登录失败');
		$userid=$salt['Data']['nUserID'];
		import('ORG.ThinkSDK.ThinkOauth');
        $tokenService = D ('Token' , 'Logic');
        $token = $tokenService->getToken ($userid);
        $zyuser = ThinkOauth::getInstance ('zyuser' , $token);
        $user=$zyuser->getUserInfo();
        $userinfo=$user['Data'];
		$now_user = $this->where(array('uid' => $userid))->find();
		if(!$now_user){
			$data_user['uid']=$userid;
			$data_user['phone'] = $phone;
			$data_user['pwd'] = md5($pwd);
			$data_user['nickname'] = substr($phone,0,3).'****'.substr($phone,7);
			$data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
			$data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);
			if(!$this->data($data_user)->add()){
				return array('error_code' => true, 'msg' => '注册失败！请重试。');
			}else{
				return array('error_code' => false, 'msg' => 'OK' ,'user'=>$data_user);
			}
		}else{
			if($now_user['pwd'] != md5($pwd)){
				return array('error_code' => true, 'msg' => '密码不正确!');
			}
			if(empty($now_user['status'])){
				return array('error_code' => true, 'msg' => '该帐号被禁止登录!');
			}
			return array('error_code' => false, 'msg' => 'OK' ,'user'=>$now_user);
		}
	}
	public function singlelogin($u){
		$now_user = $this->where(array('uid' => $u['nUserID']))->find();
		$data_user['phone'] = $u['strMobile'];
		$data_user['pwd'] = md5('quweizhichang');
		$data_user['nickname'] = $u['strRealName']?$u['strRealName']:substr($u['strMobile'],0,3).'****'.substr($u['strMobile'],7);
		$data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
		$data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);
		$data_user['avatar']=$u['strPhoto']?$u['strPhoto']:'';
		if(!$now_user){
			$data_user['uid']=$u['nUserID'];
			
			$result=$this->data($data_user)->add();
			if(!$result){
				return array('error_code' => true, 'msg' => '注册失败！请重试。');
			}else{
				return array('error_code' => false, 'msg' => 'OK' ,'user'=>$data_user);
			}
		}else{
			if($now_user['nickname']!=$u['strRealName']){
				$result=$this->where('uid='.$u['nUserID'])->save($data_user);
			}
			if(empty($now_user['status'])){
				return array('error_code' => true, 'msg' => '该帐号被禁止登录!');
			}
			return array('error_code' => false, 'msg' => 'OK' ,'user'=>$now_user);
		}
	}
	public function checksiglelogin($token){
		$userid=M('api_token')->where("access_token='$token'")->getfield('userid');
		$now_user = $this->where(array('uid' => $userid))->find();
		if($now_user){
			$data_user['uid']=$userid;
			$data_user['phone'] = $now_user['phone'];
			$data_user['pwd'] = $now_user['pwd'];;
			$data_user['nickname'] = $now_user['nickname'];;
			$data_user['add_time'] = $now_user['add_time'];;
			$data_user['add_ip'] = $now_user['add_ip'];
			if(!$_SESSION['user']){
				session('user', $data_user);
				return true;
			}
			return false;

		}
	}
	/*手机号、union_id、open_id 直接登录入口*/
	public function autologin($field,$value){
		$condition_user[$field] = $value;
		$now_user = $this->field(true)->where($condition_user)->find();
		if($now_user){
			if(empty($now_user['status'])){
				return array('error_code' => true, 'msg' => '该帐号被禁止登录!');
			}
			$condition_save_user['uid'] = $now_user['uid'];
			$data_save_user['last_time'] = $_SERVER['REQUEST_TIME'];
			$data_save_user['last_ip'] = get_client_ip(1);
			$this->where($condition_save_user)->data($data_save_user)->save();
			return array('error_code' => false, 'msg' => 'OK' ,'user'=>$now_user);
		}else{
			return array('error_code'=>1001,'msg'=>'没有此用户！');
		}
	}
	/*
	 *	提供用户信息注册用户，密码需要自行md5处理 
	 *
	 *	**** 请自行处理逻辑，此处直接插入用户表 ****
	 */
	public function autoreg($data_user){
		$data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
		$data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);
		if($data_user['openid']){
			$data_user['last_weixin_time'] = $_SERVER['REQUEST_TIME'];
		}
		if($this->data($data_user)->add()){
			return array('error_code' =>false,'msg' =>'OK');
		}else{
			return array('error_code' => true, 'msg' => '注册失败！请重试。');
		}
	}
	/*帐号密码注册*/
	public function checkreg($phone,$pwd,$vfycode){
		if (empty($phone)) {
			return array('error_code' => true, 'msg' => '手机号不能为空');
		}
		if (empty($pwd)) {
			return array('error_code' => true, 'msg' => '密码不能为空');
		}
		if(!preg_match('/^[0-9]{11}$/',$phone)){
			return array('error_code' => true, 'msg' => '请输入有效的手机号');
		}
		$user_modifypwdDb = M('User_modifypwd');
        $modifypwd = $user_modifypwdDb->where("telphone='$phone'")->order('id desc')->getfield('vfcode');
        if($modifypwd!=$vfycode)exit(json_encode(array('error_code' => true, 'msg' => '短信验证码错误')));
		$condition_user['phone'] = $phone;
		$user=$this->field('`uid`')->where($condition_user)->find();
		$UserEvent = A('User','Event');
        $UserEvent->_initialize();
        $salt=$UserEvent->getUserSalt($phone);
		if($user || $salt['nFlag']==1){
			return array('error_code' => true, 'msg' => '手机号已存在');
		}
		$result = $UserEvent->register($phone,$pwd,$vfycode);
		if($result['nFlag']!=1)return array('error_code'=>true,'msg'=>'展翅网注册失败');
		$nUserID=$result['Data']['nUserID'];
		$data_user['uid']=$nUserID;
		$data_user['phone'] = $phone;
		$data_user['pwd'] = md5($pwd);
		$data_user['nickname'] = substr($phone,0,3).'****'.substr($phone,7);
		$data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
		$data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);
		if($this->data($data_user)->add()){
			$return = $this->checkin($phone,$pwd);
			if(empty($result['error_code'])){
    			return $return;
    		}else{
				return array('error_code' =>false,'msg' =>'注册成功，正在跳转登录链接...');
			}
		}else{
			return array('error_code' => true, 'msg' => '注册失败！请重试。');
		}
	}
	/*修改用户信息*/
	public function save_user($uid,$field,$value){
		$condition_user['uid'] = $uid;
		$data_user[$field] = $value;
		if($this->where($condition_user)->data($data_user)->save()){
			return array('error'=>0,$field=>$value);
		}else{
			return array('error'=>1,'msg'=>'修改失败！请重试。');
		}
	}
	/*增加用户的钱*/
	public function add_money($uid,$money,$desc){
		$condition_user['uid'] = $uid;
		if($this->where($condition_user)->setInc('now_money',$money)){
			D('User_money_list')->add_row($uid,1,$money,$desc);
			return array('error_code' =>false,'msg' =>'OK');
		}else{
			return array('error_code' => true, 'msg' => '用户余额充值失败！请联系管理员协助解决。');
		}
	}
	/*使用用户的钱*/
	public function user_money($uid,$money,$desc){
		$condition_user['uid'] = $uid;
		if($this->where($condition_user)->setDec('now_money',$money)){
			D('User_money_list')->add_row($uid,2,$money,$desc);
			return array('error_code' =>false,'msg' =>'OK');
		}else{
			return array('error_code' => true, 'msg' => '用户余额扣除失败！请联系管理员协助解决。');
		}
	}
	/*增加用户的积分*/
	public function add_score($uid,$score,$desc){
		$condition_user['uid'] = $uid;
		if($this->where($condition_user)->setInc('score_count',$score)){
			D('User_score_list')->add_row($uid,1,$score,$desc);
			return array('error_code' =>false,'msg' =>'OK');
		}else{
			return array('error_code' => true, 'msg' => '添加积分失败！请联系管理员协助解决。');
		}
	}
	/*使用用户的积分*/
	public function user_score($uid,$score,$desc){
		$condition_user['uid'] = $uid;
		if($this->where($condition_user)->setDec('score_count',$score)){
			D('User_score_list')->add_row($uid,2,$score,$desc);
			return array('error_code' =>false,'msg' =>'OK');
		}else{
			return array('error_code' => true, 'msg' => '减少积分失败！请联系管理员协助解决。');
		}
	}
}
?>