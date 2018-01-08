<?php
class ZyuserSDK extends ThinkOauth{
	/**
	 * 获取requestCode的api接口
	 * @var string
	 */
	protected $GetRequestCodeURL = ACCOUNT_URL.'index.php/Oauth/getRedirectUri';

	/**
	 * 获取access_token的api接口
	 * @var string
	 */
	protected $GetAccessTokenURL = ACCOUNT_URL.'ndex.php/Oauth/getAccessToken';

	/**
	 * API根路径
	 * @var string
	 */
	protected $ApiBase = ACCOUNT_URL.'index.php';
	
		/**
	 * 组装接口调用参数 并调用接口
	 * @param  string $api    尊一用户统一API
	 * @param  string $param  调用API的额外参数
	 * @param  string $method HTTP请求方法 默认为GET
	 * @return json
	 */
	public function call($api, $param = '', $method = 'GET', $multi = false){		
		/* 调用公共参数 */
			$params = array(
					'access_token' =>$this->Token['access_token'],
					'nUserID' =>$this->Token['user_id'],
					'client_id' =>$this->AppKey,
			);
		$data = $this->http($this->url($api), $this->param($params, $param), $method,$this->heards);
		return json_decode($data, true);
	}
	
	/**
	 * 解析access_token方法请求后的返回值
	 * @param string $result 获取access_token的方法的返回值
	 */
	protected function parseToken($result, $extend){
		$data = json_decode($result, true);
		if($data['access_token'] && $data['expires_in'] && $data['refresh_token']){
			$this->Token    = $data;
			$data['openid'] = $this->openid();
			return $data;
		} else
			throw new \Exception("获取尊一用户ACCESS_TOKEN出错：{$data['error']}");
	}
	
	/**
	 * 获取当前授权应用的openid
	 * @return string
	 */
	public function openid(){
		if(isset($this->Token['openid']))
			return $this->Token['openid'];
		$data = $this->call('/Oauth/getLoggedInUser');
		if(!empty($data['nUserID']))
			return $data['nUserID'];
		else
			return flase;
			//throw new \Exception('没有获取到尊一用户ID！');
	}
	
	/**
	 * 检验登陆令牌的合法性
	 * @param string $strCode   //登陆令牌
	 * @param string $zyUserKey  //检验时,解密用的密匙
	 */
	public function checkCodeValidity($strCode,$zyUserKey){
		return true;//暂无
	}
	

	/**
	 * 设置校验值
	 * @param int $client_id
	 * @param string $client_secret
	 * @param string $mobile
	 */
	public  function setStrAppHash($mobile){
		return md5($this->AppKey.$this->AppSecret.$mobile);//暂定
	}
	
	/**
	 * 获取尊一用户的盐值
	 * @param integer $id
	 * @param integer $type
	 * @parm array $heads
	 */
	public function getUserSalt($id,$type){
		/* 调用公共参数 */
		$params = array(
				'nType' =>$type,
				'strUserName' =>$id
		);
		$data = $this->http($this->url('/Oauth','/getSalt'), $params, 'GET',$this->heards,false);
		return json_decode($data, true);
	}
	public  function  getUserCode($callback)
	{
		
		/* 调用公共参数 */
		$params = array(
			'client_id' =>$this->AppKey,
			'callback_url' =>$callback,
			'response_type' =>'code',
			'scope' =>'',
		);
		 $this->redirect($this->url('/sign'), $params);
	}
	
	public  function getAccessTokenByCode($code){
		//1.根据code换取accesstoken
		$params = array(
			'client_id' =>$this->AppKey,
			'response_type' =>'code',
			'client_secret' =>$this->AppSecret,
			'code' =>$code,
			'grant_type' =>'',
		);
		$data = $this->http($this->url('/Oauth','/getAccessToken'), $params, 'GET',$this->heards,false);
		return json_decode($data, true);
	}
	
	public  function  getUserInfoByAccessToken($AccessToken)
	{
		$params = array(
			'client_id' =>$this->AppKey,
			'client_secret' =>$this->AppSecret,
			'access_token' =>$AccessToken,
			'code' =>$AccessToken,
		);
		$data = $this->http($this->url('/Index','/users'), $params, 'GET',$this->heards,false);
		return json_decode($data, true);
	}
	
	public function userLogin($nUserID,$strPassWord,$nTime){
		$param = array(
				'client_id' =>$this->AppKey,
				'nUserID' =>$nUserID,
				'strPassWord' =>$strPassWord,
				'nTime' =>$nTime
		);
		$data = $this->call('/Oauth/getRedirectUri',$param,'POST',false);
		return $data;
	}
	/**
	 * 获取尊一用户的信息
	 * @param string $access_token
	 */
	public function getUserInfo($param=''){
		$data = $this->call('/Index/users',$param,'GET',false);
		return $data;
	}
	
	/**
	 * 用户注册 
	 */
	public function userRegister($strMobile,$strPassWord,$nType=0,$strEmail='',$strAccount ='',$arrData = array()){
		$param = array(
				'client_id' =>$this->AppKey,
				'strMobile'=>$strMobile,
				'strPassWord'=>$strPassWord,
				'nType'=>$nType,
				'strEmail' =>$strEmail,
				'strAccount' =>$strAccount,
		);

		if (!empty($arrData) && is_array($arrData)) {
			$param = array_merge($param,$arrData);
		}
		$data = $this->call('/Index/users',$param,'POST',false);
		return $data;
	}

	/**
	 * 企业注册 
	 */
	public function  companyRegister($strAccount,$strPassWord,$strMobile='',$strEmail='',$arrData = array()){
		$param = array(
				'client_id' =>$this->AppKey,
				'strMobile'=>$strMobile,
				'strPassWord'=>$strPassWord,
				'strEmail' =>$strEmail,
				'strAccount' =>$strAccount,
				'nType' =>1,
		);

		if (!empty($arrData) && is_array($arrData)) {
			$param = array_merge($param,$arrData);
		}
		$data = $this->call('/Index/users',$param,'POST',false);
		return $data;
	}
	//检查企业账户合法性
	public function companyRegisterCheck($strEmail,$strMobile='',$strPassWord){
		$param=array(
			'client_id'=>$this->AppKey,
			'strEmail'=>$strEmail,
			'strMobile'=>$strMobile,
		    'strPassWord'=>$strPassWord,
		);
			$data=$this->call('/Index/userscheck',$param,'POST',false);
			return $data;
	}
	/**
	 * 找回用户密码
	 */
	public function getUserPassword($strMobile,$strPassWord,$strAppHash,$type=0){
		$param = array(
				'strMobile'=>$strMobile,
				'strPassWord'=>$strPassWord,
				'strAppHash'=>$strAppHash,
				'client_id' =>$this->AppKey,
				'type'=>$type,
			//	'client_secret' =>$this->AppSecret
				);
		$data = $this->call('/Index/userpw',$param,'GET',false);
		return $data;
	}
	/**
	 *同步用户信息 
	 */
	public function synchronizationUser($param){
		$data = $this->call('/Index/editusers',$param,'POST',false);
		return $data;
	}
	
	/**
	 *更新用户头像 (暂无)
	 */
	public function  synchronizationUserPhoto(){
		
	}
	
	/**
	 * 修改用户密码
	 */
	public function eitUserPassword($strOldPassWord,$strPassWord){
		$param = array(
				'strOldPassWord' =>$strOldPassWord,
				'strNewPassWord' =>$strPassWord
		);
		$data = $this->call('/Index/userpw',$param,'POST',false);
		return $data;
	}

	//用户认证

	public function authentication($nUserID,$nStatus){ 
		$param = array(
				'nUserID' =>$nUserID,
				'nStatus' =>$nStatus
		);
		$data = $this->call('/Index/authentication',$param,'POST',false);
		return $data;
	}

	public function getOnceCode($token_code,$type){ 
				$param = array(
				'token_code' =>$token_code,
				'type' =>$type
		);
		$data = $this->call('/Oauth/getOnceCode',$param,'GET',false);
		return $data;
      
	}

	public function useOnceCode($onceCode,$type){ 
		$param = array(
				'oncecode' =>$onceCode,
				'type' =>$type
		);
		$data = $this->call('/Oauth/useOnceCode',$param,'POST',false);
		return $data;
	}
	public function open_login($info){
		$param = array(
			"account_info"=>$info
		);
		$Result = $this->call("/Oauth/open_login",$param,"POST",false);
		return $Result;
	}
	public  function redirect($url,$params)
	{
		//1.生成跳转链接
		$redirectUrl = $url . '?' . http_build_query($params);
		header("Location:$redirectUrl");
	}
}