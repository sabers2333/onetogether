<?php
/*
 * 首页
 *
 */

class IndexAction extends BaseAction
{
    public function index(){
        //轮播
        $index_lunbo_adver = D('Adver')->get_adver_by_key('indexlunbo'); 
        //首页下面轮播图
        $shouyou = D('Adver')->get_adver_by_key('shouyou', 12);     
        $this->shouyou = $shouyou;
        //美食
        $food = D('Adver')->get_adver_by_key('food');
        $this->food = $food;
        //新闻
        $news = M('slider')->where('cat_id=5')->limit(5)->field('id,name,pic,last_time')->order("id desc")->select();
        $this->news = $news;
        //产品
        $products = M('slider')->where('cat_id=7')->limit(5)->field('id,name,pic,last_time')->order("id desc")->select();
        $this->products = $products;
        $this->assign('index_lunbo_adver',$index_lunbo_adver);
        $this->display();
    }

    //品牌
    public function pinpai()
    {
        $this->display();
    }

    //美食
    public function food()
    {
        $cat_id = I('cat_id', '36');
        $model = M('Adver');
        $where['cat_id'] = $cat_id;
        $field = 'id,name,pic';
        $count = $model->where($where)->count(); 
        $page = 9;
        import('@.ORG.system_page');
        $p = new Page($count, $page);
        $list = $model->where($where)->limit($p->firstRow . ',' . $p->listRows)->field($field)->select();
        $this->list = $list;
        $this->page = $p->show();
        $this->display();
    }
    //一起茶
    public function yiqicha()
    {
        $cat_id = I('cat_id', '29');
        $model = M('Adver');
        $where['cat_id'] = $cat_id;
        $field = 'id,name,pic';
        $count = $model->where($where)->count(); 
        $page = 9;
        import('@.ORG.system_page');
        $p = new Page($count, $page);
        $list = $model->where($where)->limit($p->firstRow . ',' . $p->listRows)->field($field)->select();
        $this->list = $list;
        $this->page = $p->show();
        $this->display();
    }

    //新闻
    public function news()
    {
        $cat_id = I('cat_id',5);
        $model = M('slider');
        $where['cat_id'] = $cat_id;
        $field = 'id,name,pic,filename,last_time,click';
        $count = $model->where($where)->count(); 
        $page = 6;
        import('@.ORG.system_page');
        $p = new Page($count, $page);
        $list = $model->where($where)->limit($p->firstRow . ',' . $p->listRows)->field($field)->order("id desc")->select();
        $this->list = $list;
        $this->page = $p->show();
        //z最近新闻
        $this->getnew = $this->getnews('id');
        //热门推荐
        $this->gethot = $this->getnews('click');
        $this->display();
    }

    //新闻详情
    public function detail()
    {
        $id = I('id');
        $info = M('slider')->where("id = $id")->find();     
        
             
        $this->info = $info;
        //z最近新闻
        $this->getnew = $this->getnews('id');
        //热门推荐
        $this->gethot = $this->getnews('click');
        $this->display();
    }

    //品牌推广
    public function tuiguang()
    {
        $this->display();
    }

    //联系我们
    public function lianxi()
    {
        $this->display();
    }

    //招商
    public function zhaoshang()
    {
        $this->display();
    }

     //招商
    public function yqc()
    {
        $this->display();
    }

     //招商
    public function message()
    {
        $this->display();
    }
    public function iframe()
    {
        $this->display();
    }
    //招商
    public function yqc1()
    {
        $this->display();
    }
    //招商
    public function lunbo()
    {
        $this->display();
    }
    //招商
    public function m_lunbo()
    {
        $this->display();
    }

    //招商
    public function zhaoshang1()
    {
        $this->display();
    }
    //招商
    public function wap()
    {
        $this->display();
    }
      //招商
    public function wap1()
    {
        $this->display();
    }

    //推荐新闻
    public function getnews($condition)
    {
        $model = M('slider');
        $where['cat_id'] = 5;
        $field = 'id,name,last_time';
        $order = $condition.' desc';
        $list = $model->where($where)->field($field)->order($order)->limit(5)->select();
        return $list;
    }

    //增加新闻点击量
    public function addclick()
    {
        $id = I('id');
        M('slider')->where('id='.$id)->setInc('click');     
       
    }
    public function verify(){
        import('ORG.Util.Image');
        Image::buildImageVerify(4,1,'jpeg',53,26,'admin_verify');
    }

    public function comment(){   
         
        if(!$_POST['name']){$this->error('请输入您的姓名');}
        if(!$_POST['mobile']){$this->error('请输入您的手机号码');}
        if(!$_POST['demand']){$this->error('请输入您的需求');}
        if(!$_POST['verify']){$this->error('请输入验证码');}
        if(md5($_POST['verify']) != $_SESSION['admin_verify']){$this->error('验证码错误');}
        if(!preg_match('/^[0-9]{11}$/',$_POST['mobile'])){$this->error('请输入有效的手机号');}
        $info=M('comment')->where("mobile='$_POST[mobile]' and addtime>".date('Y-m-d'))->count();
        if($info>5)$this->error('您已经评论过了'); 
             
        $data['username']=$_POST['name'];
        $data['mobile']=$_POST['mobile'];
        $data['content']=$_POST['demand'];
        $data['addtime']=date("Y-m-d H:i:s",time());
        $result=M('comment')->add($data);    
             
        if($result){
            $this->success('评论成功');
        }
    }
    public function ajax_comment(){
        $model=M('comment');
        $where = 'status=1';
        $count=$model->where($where)->count();
        $page=3;
        import('@.ORG.system_page');
        $p=new Page($count,$page);
        $list=$model->where($where)->limit($p->firstRow.','.$p->listRows)->order('id desc')->select(); 
              
        
        foreach ($list as $k => $v) {
            $li.= '<li class="list-group-item">
            <h4>【留言】'.$v['username'].' <small><time>'.$v['addtime'].'</time></small></h4>
            <p>'.$v['content'].'                   
              <br><span>【回复】:'.$v['recomment'].'</span>
            </p>
            </li>';
            
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

}