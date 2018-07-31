<?php

class BaseAction extends CommonAction
{
    public $token = '';
    public $mer_id = 0;
    public $wecha_id = '';
    public $is_wexin_browser = false;
    public $merchant_info;
    public $tpl_path;
    public $is_app_browser = false;

    public function __construct()
    {
        parent::__construct();
     
       

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            $this->is_wexin_browser = true;
        }

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'pigcmso2owebapp') !== false) {
            $this->assign('no_footer', true);
            $is_app_browser = true;
            $this->assign('is_app_browser', $is_app_browser);
            $ticket = I('ticket', false);
            $device_id = I('Device-Id', false);

            if ($ticket) {
                $info = ticket::get($ticket, $device_id, true);

                if ($info) {
                    $uid = $info['uid'];
                    $user = D('User')->field(true)->where(array('uid' => $uid))->find();
                    session('user', $user);
                    setcookie('login_name', $user['phone'], $_SERVER['REQUEST_TIME'] + 10000000, '/');
                }
            }
        }


        $this->merchant_info['wxname'] = $merchant['name'];
        $this->assign('wxuser', $this->merchant_info);
        $this->static_path = 'http://img.onetogether.cn' .  '/static/default/';
             
        $this->assign('static_path', $this->static_path);
             
        $this->tpl_path = $this->config['site_url'] . '/tpl/Wap/';
        $this->assign('tpl_path', $this->tpl_path);
        $this->common_url['group_category_all'] = U('Wap/Group/index');
        $this->assign($this->common_url);
        if (($this->config['site_close'] == 2) || ($this->config['site_close'] == 3)) {
            $this->assign('title', '网站关闭');
            $this->assign('jumpUrl', '-1');
            $this->error_tips($this->config['site_close_reason'] ? $this->config['site_close_reason'] : '网站临时关闭');
        }

        if ($this->is_wexin_browser || $_SESSION['openid']) {
            $share = new WechatShare($this->config, $_SESSION['openid']);
            $this->shareScript = $share->getSgin();
            $this->assign('shareScript', $this->shareScript);
            $this->hideScript = $share->gethideOptionMenu();
            $this->assign('hideScript', $this->hideScript);
        }
    }

    public function error_tips($msg, $url = 'javascript:history.back(-1);')
    {
        $this->assign('msg', $msg);
        $this->assign('url', $url);
        $this->display('Home/error');
        exit();
    }

    public function success_tips($msg, $url = 'javascript:history.back(-1);')
    {
        $this->assign('msg', $msg);
        $this->assign('url', $url);
        $this->display('Home/success');
        exit();
    }

    public function authorize_openid()
    {
        if (empty($_GET['code']) || empty($_SESSION['weixin']['state'])) {
            $_SESSION['weixin']['state'] = md5(uniqid());
            $customeUrl = preg_replace('#&code=(\\w+)#', '', $this->config['site_url'] . $_SERVER['REQUEST_URI']);
            $oauthUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->config['wechat_appid'] . '&redirect_uri=' . urlencode($customeUrl) . '&response_type=code&scope=snsapi_base&state=' . $_SESSION['weixin']['state'] . '#wechat_redirect';
            redirect($oauthUrl);
            exit();
        }
        else {
            if (isset($_GET['code']) && isset($_GET['state']) && ($_GET['state'] == $_SESSION['weixin']['state'])) {
                unset($_SESSION['weixin']);
                import('ORG.Net.Http');
                $http = new Http();
                $return = $http->curlGet('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->config['wechat_appid'] . '&secret=' . $this->config['wechat_appsecret'] . '&code=' . $_GET['code'] . '&grant_type=authorization_code');
                $jsonrt = json_decode($return, true);

                if ($jsonrt['errcode']) {
                    $error_msg_class = new GetErrorMsg();
                    $this->error_tips('授权发生错误：' . $error_msg_class->wx_error_msg($jsonrt['errcode']), U('Home/index'));
                }

                if ($jsonrt['openid']) {
                    $_SESSION['openid'] = $jsonrt['openid'];
                    $result = D('User')->autologin('openid', $jsonrt['openid']);

                    if (empty($result['error_code'])) {
                        $now_user = $result['user'];
                        session('user', $now_user);
                        $this->user_session = session('user');

                        if (259200 < ($_SERVER['REQUEST_TIME'] - $now_user['last_weixin_time'])) {
                            $customeUrl = preg_replace('#&code=(\\w+)#', '', $this->config['site_url'] . $_SERVER['REQUEST_URI']);
                            redirect(U('Login/weixin', array('referer' => urlencode($customeUrl))));
                        }
                    }
                }
                else {
                    redirect(U('Home/index'));
                }
            }
            else {
                redirect(U('Home/index'));
            }
        }
    }

    public function open_authorize_openid($param)
    {
        if (empty($_GET['code']) || empty($_SESSION['open_weixin']['state'])) {
            $_SESSION['open_weixin']['state'] = md5(uniqid());
            $customeUrl = preg_replace('#&code=(\\w+)#', '', $this->config['site_url'] . $_SERVER['REQUEST_URI']);
            $oauthUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $param['appid'] . '&redirect_uri=' . urlencode($customeUrl) . '&response_type=code&scope=snsapi_base&state=' . $_SESSION['open_weixin']['state'] . '&component_appid=' . $this->config['wx_appid'] . '#wechat_redirect';
            redirect($oauthUrl);
            exit();
        }
        else {
            if (isset($_GET['code']) && isset($_GET['state']) && ($_GET['state'] == $_SESSION['open_weixin']['state'])) {
                unset($_SESSION['open_weixin']);
                $get_component_access_token = D('Weixin_bind')->get_component_access_token();
                import('ORG.Net.Http');
                $http = new Http();
                $return = $http->curlGet('https://api.weixin.qq.com/sns/oauth2/component/access_token?appid=' . $param['appid'] . '&code=' . $_GET['code'] . '&grant_type=authorization_code&component_appid=' . $this->config['wx_appid'] . '&component_access_token=' . $get_component_access_token);
                $jsonrt = json_decode($return, true);

                if ($jsonrt['openid']) {
                    $_SESSION['open_authorize_openid'] = $jsonrt['openid'];
                }
                else {
                    $_SESSION['open_authorize_openid'] = 'error';
                }
            }
            else {
                $_SESSION['open_authorize_openid'] = 'error';
            }
        }
    }

    public function behavior($param = array(), $extra_param = false)
    {
        $openid = $_SESSION['openid'];
        if (empty($param) || empty($openid)) {
            return false;
        }

        if (empty($param['model'])) {
            $param['model'] = MODULE_NAME . '_' . ACTION_NAME;
        }

        $database_behavior = M('Behavior');
        $data_behavior = $param;
        $data_behavior['openid'] = $openid;
        $data_behavior['date'] = $data_behavior['last_date'] = $_SERVER['REQUEST_TIME'];
        $database_behavior->data($data_behavior)->add();
    }

    public function _modules()
    {
        return array('Home_index' => '首页', 'Search_group' => $this->config['group_alias_name'] . '搜索', 'Search_meal' => $this->config['meal_alias_name'] . '搜索', 'Group_index' => $this->config['group_alias_name'] . '列表', 'Group_detail' => $this->config['group_alias_name'] . '内页', 'Group_feedback' => $this->config['group_alias_name'] . '评论列表', 'Group_branch' => $this->config['group_alias_name'] . '页店铺列表', 'Group_buy' => '提交' . $this->config['group_alias_name'] . '订单', 'Group_shop' => '店铺' . $this->config['group_alias_name'] . '页面', 'Group_addressinfo' => '店家地图', 'Group_get_route' => '店家路线', 'Pay_group' => $this->config['group_alias_name'] . '确认订单', 'Pay_meal' => $this->config['meal_alias_name'] . '确认订单', 'Meal_index' => '店铺介绍', 'Meal_menu' => '店铺菜单', 'Meal_thissort' => '菜品分类', 'Meal_cart' => '确认我的菜单', 'Meal_saveorder' => '提交我的菜单', 'Meal_detail' => '订单详情', 'Meal_my' => '我的' . $this->config['meal_alias_name'] . '记录', 'Meal_order' => $this->config['meal_alias_name'] . '订单列表', 'Meal_selectmeal' => $this->config['meal_alias_name'] . '点菜', 'Index_index' => '微网站');
    }

    public function get_encrypt_key($array, $app_key)
    {
        $new_arr = array();
        ksort($array);

        foreach ($array as $key => $value) {
            $new_arr[] = $key . '=' . $value;
        }

        $new_arr[] = 'app_key=' . $app_key;
        $string = implode('&', $new_arr);
        return md5($string);
    }

    protected function get_im_encrypt_key($array, $app_key)
    {
        $new_arr = array();
        ksort($array);

        foreach ($array as $key => $value) {
            $new_arr[] = $key . '=' . $value;
        }

        $new_arr[] = 'app_key=' . $app_key;
        $string = implode('&', $new_arr);
        return md5($string);
    }

    public function _wapthisCard()
    {
        $thisCard = M('Member_card_set')->where(array('token' => $this->token, 'id' => intval($_GET['cardid'])))->find();
        return $thisCard;
    }

    protected function _waptodaySigned()
    {
        $signined = 0;
        $now = time();
        $where = array('token' => $this->token, 'wecha_id' => $this->user_session['uid'], 'score_type' => 1);
        $sign = M('Member_card_sign')->where($where)->order('sign_time desc')->find();
        $today = date('Y-m-d', $now);
        $itoday = date('Y-m-d', intval($sign['sign_time']));
        if ($sign && ($itoday == $today)) {
            $signined = 1;
        }

        return $signined;
    }

    protected function wapIsLogin()
    {
        if (empty($this->user_session)) {
            $this->error_tips('请先进行登录！', U('Login/index'));
        }
    }

    protected function autoLogin()
    {
    }
}

?>
