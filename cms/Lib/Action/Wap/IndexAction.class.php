<?php
/*
 * 首页
 *
 */
class IndexAction extends BaseAction {
    public function index(){
         if (is_mobile_request()) {
            if (strpos($_SERVER["HTTP_USER_AGENT"], 'MicroMessenger')) {
            // if(!$this->user_session['uid']){
            // redirect(U("Login/singlelogin"));
            // }
            }
        }
        
        //轮播
        $index_lunbo_adver = D('Adver')->get_adver_by_key('wx_index');
        $this->assign('index_lunbo_adver',$index_lunbo_adver);
        $category=M('slider_category')->select();
        foreach ($category as $k => $v) {
            $list=M('slider')->where('cat_id='.$v['cat_id'])->order('id desc')->limit(6)->select();
            foreach ($list as $key => $value) {
                $list[$key]['last_time']=date('Y-m-d',$value['last_time']);
            }
            $category[$k]['list']=$list;
        }
        $this->category=$category;
        $this->display();
    }
    public function more(){
        //轮播
        $ad = D('Adver')->get_adver_by_key('moreadv');
        $this->assign('ad',$ad);
        $cat_id=I('cat_id');
       $this->catname=M('slider_category')->where('cat_id='.$cat_id)->getfield('cat_name');     
        
             
        $this->display();
    }
    public function detail(){
        $recommend=M('slider')->order('sort desc')->limit(6)->select();
        foreach ($recommend as $k => $v) {
            $recommend[$k]['last_time']=date('Y-m-d H:i:s',$v['last_time']);
            $recommend[$k]['pic']=$this->config['site_url'].'/upload/slider/'.$v['pic'];
        }
        $this->recommend=$recommend;
       $id=I('id');
        $vo=M('slider')->where('id='.$id)->find(); 
             
        $video=D('Qiniu')->editvideo($vo['url']);   
        $vo['m3u8']=$video['m3u8'];      
        $vo['newurl']=$video['newurl'];  
        $category=M('slider_category')->where('cat_id='.$vo['cat_id'])->find();    
        $vo['cat_name']=$category['cat_name'];    
        $referer=urlencode($_SERVER['HTTP_REFERER']);
        $loginurl=u('Login/singlelogin', array('referer' => $referer));
        $this->loginurl=$loginurl;
                      
             
                 
        $this->title=$vo['name'];
        $this->desc=$category['intro'];
        $this->imgUrl=$this->config['site_url']."/upload/slider/".$vo['pic'];     
 
             
             
        $this->vo=$vo;
        $user=$this->user_session;
        $this->avatar=$user['avatar'];
        $this->all_comment_count=M('slider_comment')->where('videoid='.$id)->count();
        $sql="select count(1) as count from (select userid from w_slider_comment where videoid=".$id." group by userid ) count";
        $count=M('')->query($sql);
        $this->count=$count[0]['count'];
        $this->userid=$user['uid']?$user['uid']:0;
        $this->display();
    }
    public function ajax_more(){
        $model=M('slider');
        $order=I('order');
        $cat_id=I('cat_id');
        $where['cat_id']=$cat_id;
        $count = $model->where($where)->count();
        $page=2;
        import('@.ORG.system_page');
        $p = new Page($count, $page);
        $list = $model->where($where)->limit($p->firstRow . ',' . $p->listRows)->order("$order desc")->select();
        foreach($list as $k=>$v){
            $url=U('detail',array('id'=>$v['id']));
            $img=$this->config['site_url'].'/upload/slider/'.$v['pic'];
            $last_time=date('Y.m.d H:i:s',$v['last_time']);
             $onclick="_czc.push(['_trackEvent', '趣味职场', '手机网页', '视频列表点击事件']);";
          
            $li.=       '<a href="'.$url.'" class="player_box" onclick="'.$onclick.'" external>
                            <div class="interesting_thumb">
                                <img src="'.$img.'" alt="" >
                                <div class="play_mask"></div>
                                <i></i>
                                <span>'.$v['duration'].'</span>
                            </div>
                            <div class="player_info">
                                <h4>'.$v['name'].'</h4>
                                <span class="pull-left">发布时间：'.$last_time.'</span>
                                <span class="pull-right">播放数：'.$v['click'].'</span>
                            </div>
                        </a>';
         }
        $this->page=$p->show();
          $data_list['total']=$count;
          $data_list['pagesize']=$page;
          $data_list['page']=$page;
          $maxpage=ceil($count/$page);
          $data_list['totalpage']=$maxpage;
        $data_list['li']=$li;
        echo json_encode($data_list);die();
    }
    public function ajax_comment(){
        $model=M('slider_comment');
        $where['videoid']=I('videoid');
        $user=$this->user_session;
        $count=$model->where($where)->count();
        $page=3;
        import('@.ORG.system_page');
        $p=new Page($count,$page);
        $list=$model->alias('s')->field("s.*,u.avatar,u.nickname")->join('w_user u on s.userid=u.uid')->where($where)->limit($p->firstRow.','.$p->listRows)->order('id desc')->select();
        foreach ($list as $k => $v) {
            $zan="'zan_".$user['uid']."_".$v['videoid']."_".$v['id']."'";
            $cai="'cai_".$user['uid']."_".$v['videoid']."_".$v['id']."'";
            
            $li.='<div class="comment_item">
                    <img src="'.$v['avatar'].'" class="avatar" alt="">
                    <div class="comment_info">
                        <div class="comment_headline">
                            <h4>'.$v['nickname'].'</h4>
                            <span class="pull-right">'.$v['addtime'].'</span>
                        </div>
                        <p>'.$v['content'].'</p>
                        <a href="javascript:;" class="like"  onclick="opinion('.$zan.')"><i></i><span id='.$zan.'>'.$v['zan'].'</span></a>
                        <a href="javascript:;" class="unlike"  onclick="opinion('.$cai.')"><i></i><span id='.$cai.'>'.$v['cai'].'</span></a>
                    </div>
                </div>';
        }
        $this->page=$p->show();
          $data_list['total']=$count;
          $data_list['pagesize']=$page;
          $data_list['page']=$page;
          $maxpage=ceil($count/$page);
          $data_list['totalpage']=$maxpage;
        $data_list['li']=$li;
        echo json_encode($data_list);die();
    }
    public function addclick(){
        $id=I('id');
        M('slider')->where('id='.$id)->setInc('click');
    }
    public function comment(){
        $user=$this->user_session;
        // $referer=urlencode('http://' . $_SERVER['HTTP_HOST'] . (!(true == empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']));
        $referer=urlencode($_SERVER['HTTP_REFERER']);
        if(!$user)$this->error('请先登录',u('Login/singlelogin', array('referer' => $referer)));
        $content=I('content');
        $videoid=I('videoid');
        if(!$videoid)$this->error('页面不正确');
        if(!$content)$this->error('评论内容不能为空');
        $info=M('slider_comment')->where("userid='$user[uid]' and videoid=$videoid")->find();
        if($info)$this->error('您已经评论过了');
        $data['userid']=$user['uid'];
        $data['videoid']=$videoid;
        $data['content']=$content;
        $data['addtime']=date("Y-m-d H:i:s",time());
        $result=M('slider_comment')->add($data);
        if($result){
            $this->success('评论成功');
        }
    }
    /**
     * 七牛处理音频转码后的异步回调
     */
     public  function qiniunotify()
    {
        $notifyBody = file_get_contents('php://input');
        // $notifyBody='{"id":"z2.58dcd9bce3d0041bf804cbe3","pipeline":"0.default","code":0,"desc":"The fop was completed successfully","reqid":"PSoAAAFXf7cnobAU","inputBucket":"quweizhichang-test","inputKey":"32390b274da6e59c26a10bd83a07ec36.mp4","items":[{"cmd":"avthumb/m3u8","code":0,"desc":"The fop was completed successfully","hash":"FvbFL_U9YA3sEBLjyUL_uuVd3lbH","key":"7bNOdFMmkSAixm2ID2IhIsrF5yM=/FvVdWAYx9QB1Tehskn-kHW1e8TJt","returnOld":0}]}';
        $notifyBody=json_decode($notifyBody,true);
        $video=$notifyBody['inputKey'];
        $key=$notifyBody['items'][0]['key'];
        $videoid=$notifyBody['id'];
        $data['key']=$key;
        M('qiniu_video')->where("name='$video'")->save($data);
        // Log::write('$notifyBody：--->'.$notifyBody);
    }
    //占赞
     public function ajax_zan(){
        $user=$this->user_session;
        $referer=urlencode($_SERVER['HTTP_REFERER']);
        if(!$user)$this->error('请先登录',u('Login/singlelogin', array('referer' => $referer)));
        $aindex=I('aindex');
        $aindex=explode("_", $aindex);
        $opinion=$aindex[0];
        $userid=$aindex[1];
        $videoid=$aindex[2];
        $commentid=$aindex[3];
        $num = $_GET['num'];
        $aindex = $_GET['aindex'];
        if($_GET['flag'] == 0){
            $zan=M('slider_comment')->where('id='.$commentid)->getfield($opinion);
         $this->success($zan);
        }else if($_GET['flag'] == 1){
         $result=M('slider_comment')->where('id='.$commentid)->setInc($opinion);
         $this->success($num);
        }
    }
}