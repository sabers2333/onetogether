<include file="Public:header"/>
<body>
<div class="page-group">
    <div class="page page-current">
        <header id="header" class="mui-bar mui-bar-nav bg_white">
            <h1 class="mui-title">{$catname}</h1>
            <a href="javascript:history.back();" class="mui-icon mui-icon-arrowleft mui-pull-left"></a>
        </header>
        <div class="mui-content">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    
                    <volist name="ad" id="vo">
                    <div class="swiper-slide"><a href=""  onclick="_czc.push(['_trackEvent', '趣味职场', '手机网页', '视频列表banner']);"><img src="{$vo.pic}" alt=""></a></div>
                    </volist>                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- <div class="buttons-tab boss_tab">
                <a href="#latest" class="tab-link active news"><span>最新发布</span></a>
                <a href="#maximum" class="tab-link order"><span>最多播放</span></a>
            </div> -->
            <div class="mui-segmented-control mui-segmented-control-inverted boss_tab">
                <a href="javascript:;" class="mui-active news"><span>最新发布</span></a>
                <a href="javascript:;" class="order"><span>最多播放</span></a>
            </div>
            <div class="interest-content-block">
                <div class="tabs">
                    <div id="latest" class="tab active ajax_more">
                        
                       
                    </div>

                    <div class="load_button"></div>
                
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
    var cat_id="{$Think.get.cat_id}";
    ajaxdata(1,cat_id,'id');
    
    $(".load_button").on('click','#more',function(){
            var rel = $(this).attr("rel"); 
            //$(".company-list").html('<div class="loading_box"><img src="__PUBLIC__/images/loading.gif" alt=""><span>玩命加载中......</span></div>');
            ajaxdata(rel,cat_id,'id'); 
        
    });
    $(".order").on('click',function(){
        $('.ajax_more').attr('id','maximum');
        $(".ajax_more").html("");
        ajaxdata(1,cat_id,'click');
        $(this).addClass('mui-active').siblings('.news').removeClass('mui-active');;
    });
    $(".news").on('click',function(){
        $('.ajax_more').attr('id','latest');
        $(".ajax_more").html("");
        ajaxdata(1,cat_id,'id');
        $(this).addClass('mui-active').siblings('.order').removeClass('mui-active');;
    })
})
function ajaxdata(page,cat_id,order){
      // 这里可以写些验证代码
      $.get("{:U('ajax_more')}",{page:page,cat_id:cat_id,order:order},function(data){
            if(data.li==''){
                
            }else{
              total = data.total; //总记录数 
              pageSize =data.pageSize; //每页显示条数 
              curPage = Number(page); //当前页 
              totalPage = data.totalpage; //总页数 
                $(".ajax_more").append(data.li);
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
    if(curPage>=totalPage){  
        pageStr += '<button type="button"  class="button_load" >已经加载完了</button>'; 
    }else{ 
        pageStr += '<button type="button" id="more" class="button_load" rel="'+(curPage+1)+'">加载更多</button>'; 
    } 
    $(".load_button").html(pageStr); 
}
</script>
<include file="Public:footer"/>