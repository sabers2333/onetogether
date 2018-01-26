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
             <h3>一起吃货战场</h3>
             <p>
             “一起吃货战场”是一个集美食和轻娱乐休闲的新锐餐饮品牌，它以领先的商业思维突破了单产品差价的传统餐饮盈利模式，让多重盈利模式得以实现。
    
</p>
<p >
    在“美食”方面，它引进轻米饭系列，五彩沙拉系列，创意披萨系列，时尚饮品系列，精致西餐系列，特色烤串系列等丰富多样的特色食物，为消费者提供了丰富多样的就餐选择，深受年轻消费者的青睐。
</p>
<p>
   在“娱乐”方面，它专门研发了基于“微信”这个强大社交软件的“一起餐饮娱乐系统”，将店铺变成了一个时尚，开放，有趣的社交场所，让在这里消费的客户无一不津津乐道，流连忘返。
</p>
<p>
    在“空间”方面，它以时尚，简约的流行风格，将整个店铺变成一个既能独立又能互动的开放式空间，深受年轻消费者的喜欢。
</p>
<p>
   “一起吃货战场”隶属于漫游时光（深圳）品牌管理有限公司，公司旗下有“一起吃货战场”，“一起茶”两个品牌，都是以全新的商业思维和品牌理念在运作，在深圳一经推出便受到资本以及众多投资者的青睐，势必引爆2018的投资市场，公司在2018年2月开放合作，将在全国挑选出来优质合作者，大力扶持区域市场开发，如果你看好我们的商业模式，如果你准备付诸于努力，我们愿与你携手同行。
</p>   
<p>未来，已来</p>
         <a href="pinpai.html">了解更多&gt;&gt;</a>
            <p></p>
         </div>
     </div>
</div>
<div class="food">
     <div class="title" style="background: url({$static_path}/images/title_food.png) no-repeat bottom center;">
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
    <div class="title" style="background: url({$static_path}/images/title_shouyou.png) no-repeat bottom center;">
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