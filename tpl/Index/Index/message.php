<script type='text/javascript' src='{$static_path}js/jquery.js?ver=1.11.1'></script>
<link rel="stylesheet" type="text/css" href="{$static_path}css/style1.css"/>
<link rel="stylesheet" type="text/css" href="{$static_path}css/bootstrap.min.css"/>

<style>
    .title1 {
    width: 100%;
    height: auto;
    text-align: center;
    color: #000;
    /* margin-bottom: 40px; */
}
.pd {
    padding:20px;
}
.title1 h3 {
    font-size: 22px;
    color: #000;
    line-height: 50px;
    letter-spacing:8px;
    font-weight: bold;
}
.title1 h4 {
    font-size: 16px;
    color: #000;
    line-height: 40px;
    font-weight: bold;
}
.ny_food_c ul li{
    height: 550px;
}
.ny_food_c ul li img{
    height: 550px;
}
.ny_banner1 {
    width: 100%;
    height: auto;
    margin:0 auto;
}
.ny_banner1 img{
    margin:0 auto;
}
.t1{
    width: 100%;height: auto;
}
.ny_banner1 img{width: 100%}
.line{border-top: 1px solid red;width :900px;text-align: center;margin:20px auto}
.panel-info>.panel-heading {
    color: #fff;
    background-color: #666;
    border-color: #666;
}
.panel-info {
    border-color: #666;
}
.btn-primary {
    color: #fff;
    background-color: #666;
    border-color: #666;
}
.page div >a, .page div >span {
    display: inline;
    position: relative;
    float: left;
    padding: 3px 6px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #666;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}
.panel-info{text-align: left;}
.logo{padding: 0}
.dt{position: absolute;right: 150px;}
.dt1{position: absolute;right: 150px;top:800px;}
.dt2{position: absolute;left: 50px;}
.dt3{position: absolute;right: 50px;}
/*S banner图切换*/
.banner_all {width: 100%;margin:0 auto;overflow: hidden;position: relative;z-index: 2;min-width:980px;}
.banner {width: 980px;height: 720px;margin: 0 auto;position: relative;zoom:1;}
.banner_center {width:1920px;height: 726px;overflow: hidden;z-index: 0;position: relative;left: -470px;_display:inline;}
.banner_center ul {width:38400px;height: 677px;position:absolute;top:0;left:0;}
.banner_center ul li {width:1920px;height: 753px;float: left;overflow: hidden;display: block;}
.banner_center ul a {width:1920px;height:659px;display:block;}
.banner_btn{top: 680px}
</style>

<div class="ny_main">
    <div class="ny_about">
       <div class="w16" style="height: 900px;">
    <div class="panel panel-info">
    <div class="panel-heading">
      在线留言
    </div>
    <div class="panel-body">
      <form class="myform" action="http://www.onetogether.cn/index.php?c=Index&a=ajax_comment" method="post" id="form1">
        <div class="row form-group">
          <div class="col-xs-6">
            <input style="height:34px" class="form-control" type="text" name="name" id="name" value="" placeholder="请输入您的姓名" required="required"/>
          </div>
          <div class="col-xs-6">
            <input style="height:34px" class="form-control" type="text" name="mobile" id="mobile" value="" placeholder="请输入您的手机号码" required="required"/>
          </div>
        </div>
        <div class="row form-group ">
          <div class="col-xs-12">
            <textarea style="height:118px" class="form-control " name="demand" id="demand" placeholder="请输入您的留言" required="required" rows="3"></textarea>
          </div>
        </div>
        <div class="row form-group ">
          <div class="col-xs-12">
            <input class="form-control yanzhenginput" style="height:34px;width: 180px;padding-left:80px;" type="text" name="verify" value="" placeholder="请输入验证码" required="required"/><img class="yanzheng" src="{:U('verify')}" id="verifyImg" onclick="fleshVerify('{:U('verify')}')" title="刷新验证码" alt="刷新验证码" style="width: 70px;" />
          </div>
        </div>
        <div class="row form-group ">
          <div class="col-xs-12">
            <button type="button" class="btn btn-primary form-control">提交留言</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="panel panel-info" style="display: none;">
    <div class="panel-heading">
      最新留言
    </div>
    <div class="panel-body">
      <ul class="list-group" id="list">
        <div class="comment_list">
        
        </div>
        <li class="page" style="margin-left: 120px;">
        <!-- <div>
          <span class="current">1</span><a class="num" href="javascript:ajaxdata(2);">2</a>
          <a class="num" href="/Touzi-index-p-3.html">3</a>
          <a class="num" href="/Touzi-index-p-4.html">4</a><a class="num" href="/Touzi-index-p-5.html">5</a><a class="num" href="/Touzi-index-p-6.html">6</a><a class="num" href="/Touzi-index-p-7.html">7</a><a class="num" href="/Touzi-index-p-8.html">8</a><a class="num" href="/Touzi-index-p-9.html">9</a><a class="num" href="/Touzi-index-p-10.html">10</a><a class="num" href="/Touzi-index-p-11.html">11</a><a class="next" href="/Touzi-index-p-2.html">下一页</a><a class="end" href="/Touzi-index-p-165.html">165</a>
        </div> -->
        <div class="loadmore">
        </div>
        </li>
      </ul>
    </div>
  </div>




       </div>
    </div>
</div>
<script type="text/javascript">





    function fleshVerify(url){
        var time = new Date().getTime();
        $('#verifyImg').attr('src',url+"&time="+time);
    }
    $(function(){
        /* 提示 */
        $('.btn-primary').on('click', function () {
            $.post("http://www.onetogether.cn/index.php?c=Index&a=comment",$("#form1").serialize(),function(data){
                if(data['status']==0){
                    alert(data.info);
                }else{
                    alert(data.info);
                    window.location.reload();
                }
            })
        });
        ajaxdata(1);
    });
    function ajaxdata(page){
      // 这里可以写些验证代码
      $.get("http://www.onetogether.cn/index.php?c=Index&a=ajax_comment",{page:page},function(data){
            if(data.li==''){
            }else{
              total = data.total; //总记录数 
              pageSize =data.pageSize; //每页显示条数 
              curPage = Number(page); //当前页 
              totalPage = data.totalpage; //总页数 
                $(".comment_list").html(data.li);
                 getPageBar();
            }
             },'json');
    }
    function getPageBar(){
        var pageStr='';
    //页码大于最大页数 
    if(curPage>totalPage) curPage=totalPage; 
    //页码小于1 
    if(curPage<1) curPage=1; 
    //如果是最后页 
    if(curPage!=1){
        pageStr += '<a class="num" href="javascript:ajaxdata('+(curPage-1)+')">上一页</a>'; 
    }
    
    
    for(var i=curPage;i<=curPage+5;i++){
        if(i>totalPage){
            continue;
        }
        pageStr += '<a class="num" href="javascript:ajaxdata('+i+')">'+i+'</a>'; 
    } 
    if(curPage<totalPage){
        pageStr += '<a class="num" href="javascript:ajaxdata('+(curPage+1)+')">下一页</a>'; 
        pageStr += '<a class="num" href="javascript:ajaxdata('+totalPage+')">'+totalPage+'</a>'; 
    }
    
     
    $(".loadmore").html(pageStr); 
}
</script>
<div style="display: none;"><script src="https://s13.cnzz.com/z_stat.php?id=1273883163&web_id=1273883163" language="JavaScript"></script></div>