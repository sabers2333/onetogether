<include file="Public:header"/>
<style>
    ul.food_memu li p{font-weight: bold;font-size: 20px;}
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
     <div class="title">
         <h3>品牌文化</h3>
         <p>香港国际餐饮品牌&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;潮流休闲生活馆</p>
     </div>
     <div class="w16 cur_c clearfix">
         <div class="video">
<!--<embed src="http://hans002.w195.host-diy.net/div/flv.swf?vcastr_file=http://hans002.w195.host-diy.net/div/NextDoorDeli.flv" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="375" height="280" /> -->
<!-- <embed src="flv.swf?vcastr_file=video/Next Door Deli.flv" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="375" height="280"> -->
<object ><embed width=375 height=280 wmode="Transparent" allowfullscreen="true" allowscriptaccess="always" quality="high" src="http://player.youku.com/player.php/sid/XMzMwNjEyMzAxMg==/v.swf&topBar=1&autoplay=false&plid=1411&pub_catecode=0&from=page" type="application/x-shockwave-flash"/></embed></object>

<!-- <embed src="flv.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="375" height="280"> -->
         </div>
         <div class="cur_t">
             <h3>{$config.site_name}【官网】</h3>
             <p>
             「一起吃貨戰場」是一個集美食和輕娛樂休閒的新銳餐飲品牌，它以領先的商業思維突破了單產品差價的傳統餐飲盈利模式，讓多重盈利模式得以實現。
    
</p>
<p style="margin-top:0px;margin-bottom:0px;padding:0px;font-family:&quot;font-size:14px;white-space:normal;background-color:#F6F6F6;">
    在「美食」方面，它引進輕米飯系列，五彩沙拉系列，創意披薩系列，時尚飲品系列，精緻西餐系列，特色烤串系列等豐富多樣的特色食物，為消費者提供了豐富多樣的就餐選擇，深受年輕消費者的青睞。
</p>
<p style="margin-top:0px;margin-bottom:0px;padding:0px;font-family:&quot;font-size:14px;white-space:normal;background-color:#F6F6F6;">
   在「娛樂」方面，它專門研發了基於「微信」這個強大社交軟件的「一起餐飲娛樂系統」，將店鋪變成了一個時尚，開放，有趣的社交場所，讓在這裡消費的客戶無一不津津樂道，流連忘返。
</p>
<p>
    在「空間」方面，它以時尚，簡約的流行風格，將整個店鋪變成一個既能獨立又能互動的開放式空間，深受年輕消費者的喜歡。
</p>
<p>
   「一起吃貨戰場」隸屬於漫遊時光（深圳）品牌管理有限公司，公司旗下有「一起吃貨戰場」，「一起茶」兩個品牌，都是以全新的商業思維和品牌理念在運作，在深圳一經推出便受到資本以及眾多投資者的青睞，勢必引爆2018的投資市場，公司在2018年2月開放合作，將在全國挑選出來優質合作者，大力扶持區域市場開發，如果你看好我們的商業模式，如果你準備付諸於努力，我們願與你攜手同行。
</p>   
<p>未來，已來</p>
         <a href="pinpai.html">了解更多>></a>
            </p>
         </div>
     </div>
</div>
<div class="food">
     <div class="title">
         <h3>美食</h3>
         <p>品味世界美食&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;给您味蕾绽放的快感</p>
     </div>
     <div class="w16">
         <ul class="food_memu">
                  
            <li><a href="food.html?cat_id=24"><!-- <div><i class="icon iconfont"></i></div> --><p>西餐</p></a></li>
                  
            <li><a href="food.html?cat_id=25"><!-- <div><i class="icon iconfont"></i></div> --><p>中餐</p></a></li>
                  
            <li><a href="food.html?cat_id=26"><!-- <div><i class="icon iconfont"></i></div> --><p>饮品</p></a></li>
                  
            <li><a href="food.html?cat_id=27"><!-- <div><i class="icon iconfont"></i></div> --><p>烧烤</p></a></li>
                  
            <li><a href="food.html?cat_id=28"><!-- <div><i class="icon iconfont"></i></div> --><p>特色</p></a></li>
                        <div class="clear"></div>
         </ul>
     </div>
     
     <div class="food_c">
          <ul>
            <volist name = 'food' id = 'vo'>
             <li><a href="food.html"><img  src="{$vo.pic}"><div class="food_m"><h3>{$vo.name}</h3><span>查看详情</span></div></a></li>
            </volist>
               <div class="clear"></div>
          </ul>
     </div>
</div>
<div class="lunbo">
    <div class="title">
         <h3>手游 + 娱乐</h3>
         <p>娱乐休闲&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;中国最有趣的吃货战场</p>
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
     <div class="title">
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