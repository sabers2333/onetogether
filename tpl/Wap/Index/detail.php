<include file="Public:header"/>
<style>
    .comment_block{
        margin-bottom: 0.75rem;
    }
    .comment_block1 {
        color: #000;
    }
    .comment_content{
        padding-bottom: 2.75rem;
        overflow: hidden;
    }
</style>
<body>
<div>
    <div class="page page-current">
        <header id="header" class="mui-bar mui-bar-nav bg_white">
            <h1 class="mui-title">{$catname}</h1>
            <a href="javascript:history.back();" class="mui-icon mui-icon-arrowleft mui-pull-left"></a>
        </header>
        <div class="mui-content" data-type='native'>
            <div class="player">
                <!-- <video src="{$vo.url}" controls preload="auto" x5-video-player-type="h5" x5-video-player-fullscreen="true"></video> -->
                <video id="my-video" class="video-area" controls preload="auto" x5-video-player-type="h5" x5-video-player-fullscreen="true" poster="" data-setup="{}">
                    <source src="{$vo.m3u8}"  type="application/x-mpegURL">
                   <source src="{$vo.newurl}"  type="video/mp4">
                </video>
            </div>
            <div class="video_info">
                <h4>本期互动内容</h4>
                <p>{$vo.content|msubstr=0,253}</p>
                <div class="long_content hidden">
                    <p>{$vo.content|msubstr=253}</p>
                </div>
                <button type="button" class="expanded"><span class="icon icon-down"></span>展开</button>
            </div>
            <div class="comment_content">
                <div class="comment_block comment">
                    <div class="comment_title">全部评论（{$all_comment_count}）</div>
                </div>
                <!-- <div class="comment_block1">
                    <div class="loadmore"><button type="button" id="loading" class="button_load" onclick="ajaxdata()">加载更多</button></div>
                </div> -->
                 <div class="comment_block1">
                    <div class="load_button ">
                        <button type="button" id="loading" class="button_load" onclick="ajaxdata()">加载更多</button>
                    </div>
                </div>
            </div>
            

            <div class="comment_fixed_bar">
                <div class="comment_wrapper">
                <form  id="form1">
                    <div class="comment_bar">
                        <input type="hidden" name="videoid" value="{$Think.get.id}">
                        <input type="text" class="comment_input" placeholder="我也来说两句..."  name="content">
                        <button type="button" class="comment_send js_comment">发送</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
<script type='text/javascript' src='{$static_path}js/zepto.min.js'></script>
<script type="text/javascript" src="{$static_path}js/swiper.min.js"></script>
<script type="text/javascript" src="{$static_path}js/mui.min.js"></script>
<script type="text/javascript" src="{$static_path}js/wechat-main.js"></script>
<script type="text/javascript">
$(function(){


    var videoid={$Think.get.id};
    ajaxdata(1,videoid);
    $(".load_button").on('click','#more',function(){
            var rel = $(this).attr("rel"); 
            //$(".company-list").html('<div class="loading_box"><img src="__PUBLIC__/images/loading.gif" alt=""><span>玩命加载中......</span></div>');
            ajaxdata(rel,videoid); 
    });
})

var curPage = 1; //当前页码 
var total,pageSize,totalPage; //总记录数，每页显示数，总页数 
function getPageBar(){
        var pageStr='';
    //页码大于最大页数 
    if(curPage>totalPage) curPage=totalPage; 
    //页码小于1 
    if(curPage<1) curPage=1; 
    //如果是最后页 
    if(curPage>=totalPage){ 
        // pageStr += '<a href="javascript:;" class="button" >已经加载完了</a>'; 
        pageStr += '<button type="button" id="loading" class="button_load">已经加载完了</button>'; 
    }else{ 
        // pageStr += '<a href="javascript:;" class="button" id="more" rel="'+(curPage+1)+'">加载更多</a>'; 
        pageStr += '<button type="button" id="more" class="button_load" rel="'+(curPage+1)+'">加载更多</button>'; 
    } 
    $(".load_button").html(pageStr); 
}
function ajaxdata(page,videoid){
      // 这里可以写些验证代码
      $.get("{:U('ajax_comment')}",{page:page,videoid:videoid},function(data){
            if(data.li==''){
            }else{
              total = data.total; //总记录数 
              pageSize =data.pageSize; //每页显示条数 
              curPage = Number(page); //当前页 
              totalPage = data.totalpage; //总页数 
                $(".comment").append(data.li);
                 getPageBar();
            }
             },'json');
}
    $(function(){
        var stop=true;
        page=1;
         var pageStr='';
            //设置数字分页个数
            var roolpage=3;
            var coolpage=roolpage/2;
            var coolpage_ceil=Math.ceil(coolpage);
        //页码大于最大页数 
        if(curPage>totalPage) curPage=totalPage; 
        //页码小于1 
        if(curPage<1) curPage=1; 
        //如果是最后页 
        $(".content").on('scroll',function(){
            totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());

            if($(document).height() <= totalheight){
                if(page>=totalPage){$('#loadMore').hide(); return false;}
                page++;
                if(stop==true){
                    stop=false;
                     $.get('{:U('ajax_comment')}',{page:page,videoid:videoid},function(data){
                        if(data.li==''){
                            $('.company-page').hide();
                            $('.none-tip').show();
                            $(".company-list").html('');
                        }else{
                          total = data.total; //总记录数 
                          pageSize =data.pageSize; //每页显示条数 
                          curPage = Number(page); //当前页 
                          totalPage = data.totalpage; //总页数 
                          //totalPage=20;
                            $(".company-list").append(data.li);
                             getPageBar();
                             stop=true;
                        }
                         },'json');
                }
            }
        });
    })
</script>
<script type="text/javascript">
    $(function(){
        
        //点击量
        $('.moive-box').on('click',function(){
            var id={$Think.get.id};
            $.post("{:U('addclick')}",{id:id});
        })
        /* 提示 */
        $('.js_comment').on('click', function () {
            $.post("{:U('comment')}",$("#form1").serialize(),function(data){
                if(data['status']==0){
                    /*layer.alert(data.info,{
                        icon: 5,
                        title: '系统提示'
                    });*/
                    alert(data.info);
                    if(data.url){
                         setTimeout(function(){window.location.href=data.url;}, 1000);
                    }
                }else{
                    /*layer.alert('评论成功',{
                        icon: 6,
                        title: '系统提示'
                    });*/
                    alert('评论成功');
                    setTimeout(function(){window.location.reload();}, 1000);
                }
            })
        });
        /* 点赞 */
        $(function () {
            $.fn.favourLike = function () {
                return this.each(function () {
                    var _this = $(this);
                    var digital = _this.find('em'), num = digital.text();
                    _this.on('click', function () {
                        num++;
                        digital.text(num);
                    });
                });
            };
        });
        $('.favour-like').favourLike();
        $('.like').favourLike();
        $('.unlike').favourLike();
    });
</script>
<script type="text/javascript">

 var num;
 var flag = 0;
  
 function opinion(gindex){
    userid={$userid};
    if(!userid) {
        alert("请先登录");
        window.location.href="{$loginurl}"
    return false;}
     flag = 1;
      var span = $(this).find("em");
 num = parseInt($("#"+gindex).text());
 if(checkcookie(gindex) == true){
 num = num + 1;
 $(this).find('em').text(num);
 senddata(gindex);
 }else{
 alert("你已经点过赞咯！") 
 }
 }
  
 function senddata(aindex){
    $.get("{:U('ajax_zan')}",{num:num,flag:flag,aindex:aindex},function(data){
        if(data.status==0){
            alert(data.info);
            return false;
        }else{
             $("#"+aindex).text(data.info);
        }
    })
 }
  
//判断是否已经存在了cookie
 function checkcookie(gindex){
 var thiscookie = 'quweizhichang' + gindex;
 var mapcookie = getCookie(thiscookie)
 if (mapcookie!=null && mapcookie!=""){
 return false;
 }else {
 setCookie(thiscookie,thiscookie,365);
 return true;
 } 
 }
  
//获取cookie
 function getCookie(c_name){
//获取cookie，参数是名称。
 if (document.cookie.length > 0){
//当cookie不为空的时候就开始查找名称 
 c_start = document.cookie.indexOf(c_name + "=");
 if (c_start != -1){
//如果开始的位置不为-1就是找到了、找到了之后就要确定结束的位置
 c_start = c_start + c_name.length + 1 ;
//cookie的值存在名称和等号的后面，所以内容的开始位置应该是加上长度和1
 c_end = document.cookie.indexOf(";" , c_start);
 if (c_end == -1) {
  c_end = document.cookie.length;
 }
 return unescape(document.cookie.substring(c_start , c_end));//返回内容，解码。
 } 
 }
 return "";
 }
  
//设置cookie
 function setCookie(c_name,value,expiredays){
//存入名称，值，有效期。有效期到期事件是今天+有效天数。然后存储cookie，
 var exdate=new Date();
 exdate.setDate( exdate.getDate() + expiredays )
 document.cookie = c_name + "=" + escape(value) + ((expiredays==null) ? "" : "; expires=" + exdate.toGMTString())
 }
</script>
<include file="Public:footer"/>