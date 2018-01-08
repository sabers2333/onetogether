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
        $shouyou = D('Adver')->get_adver_by_key('shouyou');     
        $this->shouyou = $shouyou;
        //美食
        $food = D('Adver')->get_adver_by_key('food');
        $this->food = $food;
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
        $model = M('Adver');
        $where['cat_id'] = 22;
        $field = 'id,name,pic';
        $count = $model->where($where)->count(); 
        $page = 20;
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
        $model = M('slider');
        $where['cat_id'] = 5;
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
}