<include file="Public:header"/>
<style>
    ul.food_memu li p{font-weight: bold;font-size: 20px;}
    .pp{text-indent:30px;}
</style>
<div class="banner_all">
    <div class="banner">
      <div class="banner_center">
        <ul >
                <volist name="index_lunbo_adver" id="vo">
                <li style="background:url({$vo.pic})  "><a href="{$vo.url}" target="_blank"></a></li>
                </volist>
        </ul>
      </div>
      <div class="banner_btn">
        <ul>
          <li ><a href="javascript:void(0)"></a></li>
          <li class=""><a href="javascript:void(0)"></a></li>
          <li class=""><a href="javascript:void(0)"></a></li>
        </ul>
      </div>
    </div>
</div>
<!--E banner图切换-->
<div class="cur">
     <div class="title" style="background: url({$static_path}/images/t_3.png) no-repeat bottom center;">
         <h3>品牌文化</h3>
         <p>重新定义茶饮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;打开生活方式品牌时代</p>
     </div>
     <div class="w16 cur_c clearfix">
         <div class="video">
<!--<embed src="http://hans002.w195.host-diy.net/div/flv.swf?vcastr_file=http://hans002.w195.host-diy.net/div/NextDoorDeli.flv" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="375" height="280" /> -->
<!-- <embed src="flv.swf?vcastr_file=video/Next Door Deli.flv" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="375" height="280"> -->
<!-- <object ><embed width=375 height=280 wmode="Transparent" allowfullscreen="true" allowscriptaccess="always" quality="high" src="http://player.youku.com/player.php/sid/XMzMwNjEyMzAxMg==/v.swf&topBar=1&autoplay=false&plid=1411&pub_catecode=0&from=page" type="application/x-shockwave-flash"/></embed></object> -->
<embed src="http://player.video.qiyi.com/ff46294247b8b7896eb13401c9b6b345/0/0/w_19rvhkf0h5.swf-albumId=8659255109-tvId=8659255109-isPurchase=0-cnId=27" allowFullScreen="true" quality="high" width="375" height="280" align="middle" allowScriptAccess="always" autoplay="true" type="application/x-shockwave-flash"></embed>

<!-- <embed src="flv.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="375" height="280"> -->
         </div>
         <div class="cur_t">
             <h3>一起茶</h3>
             <p class="pp">
               深圳漫游时光品牌管理有限公司是一家致力于提供全新生活方式的新餐饮品牌服务企业，来自香港的品牌团队一直将为消费者提供全新生活方式为使命，旗下品牌所有餐品都是市场最时尚潮流品类，我们不仅仅只是将目光局限于餐品本身，而是将时尚的美学思维和全新的生活方式呈现给消费者，给消费者一种全新的生活理念。      
</p>
<p class="pp" >
企业定位：一家致力于提供全新生活方式的新餐饮品牌公司
</p>
<p class="pp">
     企业愿景：让生意成就生活的意义。
</p>
<p class="pp">
   企业口号:用心每一天，让生活充满仪式感
</p>

         <a href="pinpai.html">了解更多&gt;&gt;</a>
            <p></p>
         </div>
     </div>
</div>
<div class="food">
     <div class="title" style="background: url({$static_path}/images/t_2.png) no-repeat bottom center;">
         <h3>明星产品</h3>
         <p>时尚健康&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;高颜值&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;自带话题&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;狂吸粉</p>
     </div>
     <div class="w16">
         <ul class="food_memu">
            <li><a href="yiqicha.html?cat_id=30" title="奶霜"><p>奶霜</p></a></li>  
             <li ><a href="yiqicha.html?cat_id=31" title="水果茶"><p>水果茶</p></a></li>  
             <li ><a href="yiqicha.html?cat_id=34" title="软欧包"><p>软欧包</p></a></li> 
             <li ><a href="yiqicha.html?cat_id=33" title="沙拉"><p>沙拉</p></a></li>
             <li ><a href="yiqicha.html?cat_id=35" title="西点"><p>西点</p></a></li> 
             <li ><a href="yiqicha.html?cat_id=32" title="colourful"><p>colourful</p></a></li> 
             <li ><a href="yiqicha.html?cat_id=37" title="答案茶"><p>答案茶</p></a></li> 
                        <div class="clear"></div>
         </ul>
     </div>
     
     <div class="food_c">
          <ul>
            <volist name = 'food' id = 'vo'>
             <li><a href="yiqicha.html"><img  src="{$vo.pic}"><div class="food_m"><h3>{$vo.name}</h3><span>查看详情</span></div></a></li>
            </volist>
               <div class="clear"></div>
          </ul>
     </div>
</div>
<div class="lunbo">
    <div class="title" style="background: url({$static_path}/images/t_1.png) no-repeat bottom center;">
         <h3>空间展示</h3>
         <p>设计理念&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;以生活方式为原点</p>
     </div>
    <div class="w16">
            <div id="divRuner">
                <ul>
                  <volist name = 'shouyou' id = 'vo'>
                    <li>
                        <a href="#">
                            <span>
                                <img width="300" height="200" class="attachment-medium wp-post-image" src="{$vo.pic}"  />
                            </span>
                        </a>
                    </li>
                    </volist>
                </ul>
                <div class="clearfix">
                </div>
                <a id="prev" class="prev" href="#"></a>
                <a id="next" class="next" href="#"></a>
            </div>
    </div>
</div>
<div class="news">
     <div class="title" style="background: url({$static_path}/images/title_news.png) no-repeat bottom center;">
         <h3>新闻资讯</h3>
        <!-- <p>海外轻奢型美味 向家庭厨房和社区服务延伸</p>-->
     </div>
     <div class="w16 clearfix">
         <div class="news_2" style="margin-left:0;">
            <h3>新闻动态 <a href="news.html?cat_id=5">+更多</a></h3>
                    
                        <a href="detail.html?id={$news.0.id}" target="_blank"><img src="{$config.site_url}/upload/slider/{$news.0.pic}" width="275" height="200" style="margin-right:10px"></a>
                        <a href="detail.html?id={$news.1.id}" target="_blank"><img src="{$config.site_url}/upload/slider/{$news.1.pic}" width="275" height="200" style=""></a>
                       <div class="clear"></div>                
            <ul>
            <volist name = 'news' id = 'vo'>
             <li><a href="detail.html?id={$vo.id}" target="_blank">{$vo.name}<span style="text-align:right;">[{$vo.last_time|date='Y-m-d',###}]</span></a></li>
             </volist>
                
            </ul>
         </div>
         <div class="news_2">
            <h3>最新产品 <a href="news.html?cat_id=7">+更多</a></h3>
                        <a href="detail.html?id={$products.0.id}" target="_blank"><img src="{$config.site_url}/upload/slider/{$products.0.pic}" width="275" height="200" style="margin-right:10px"></a>
                        <a href="detail.html?id={$products.1.id}" target="_blank"><img src="{$config.site_url}/upload/slider/{$products.1.pic}" width="275" height="200" style=""></a>
                                
            <div class="clear"></div>               
           <ul>
             <volist name = 'products' id = 'vo'>
             <li><a href="detail.html?id={$vo.id}" target="_blank">{$vo.name}<span style="text-align:right;">[{$vo.last_time|date='Y-m-d',###}]</span></a></li>
             </volist>
                
            </ul>
         </div>
     </div>
</div>
<div class="wpb_row vc_row-fluid">
    <div class="vc_span12 wpb_column column_container">
        <div class="wpb_wrapper">
            
    <div class="wpb_single_image wpb_content_element vc_align_center">
        <div class="wpb_wrapper">
            
            <img class=" vc_box_border_grey " src="{$static_path}images/e8a8a6d0046dcc25.gif" width="1023" height="96" alt="index_jiameng_tel">
        </div> 
    </div> 
        </div> 
    </div> 
</div>
<include file="Public:footer"/>
<script type="text/javascript">
    $(function(){
         //鼠标的移入移出  
        $(".food_memu p").mouseover(function (){  
            $(this).css('color', 'red');
        }).mouseout(function (){  
            $(this).css('color', '#000'); 
        });  
         //鼠
    })
</script>