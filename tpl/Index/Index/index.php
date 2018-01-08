<include file="Public:header"/>
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
         <p>来自新加坡的邻里西餐 贴近大众的国际品牌</p>
     </div>
     <div class="w16 cur_c clearfix">
         <div class="video">
<!--<embed src="http://hans002.w195.host-diy.net/div/flv.swf?vcastr_file=http://hans002.w195.host-diy.net/div/NextDoorDeli.flv" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="375" height="280" /> -->
<!-- <embed src="flv.swf?vcastr_file=video/Next Door Deli.flv" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="375" height="280"> -->
<embed src="flv.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="375" height="280">
         </div>
         <div class="cur_t">
             <h3>一起手游吧西餐厅【官网】</h3><p>
    <span style="white-space:normal;">"一起手游吧"【官网】</span>是一家以牛排、披萨、意面等西式简餐为主的邻里西餐厅，消费群体主要为学生、上班族、儿童等大众消费群体。人均消费三十元左右<span style="white-space:normal;">！</span>是家庭聚餐、朋友聚会、情侣约会的极佳场所。已开设多家连锁直管店及数百家特许连锁加盟店。 如果您想加盟投资创业餐饮项目,一起手游吧将是您的不二之选。
</p>
<p style="margin-top:0px;margin-bottom:0px;padding:0px;font-family:&quot;font-size:14px;white-space:normal;background-color:#F6F6F6;">
    白墙黑屋的独栋洋房，外观风格仿照都铎式建筑，全部采用黑白两色，老洋房结合热带花园的魅力，白天充满清新绿意，夜间摇曳浪漫烛光，已成为美食的标志之一。
</p>
<p style="margin-top:0px;margin-bottom:0px;padding:0px;font-family:&quot;font-size:14px;white-space:normal;background-color:#F6F6F6;">
    <span style="margin:0px;padding:0px;font-size:13.3333px;"><span style="white-space:normal;">"一起手游吧"</span><span style="white-space:normal;">隶属于安徽风清扬品牌管理股份有限公司。</span>公司</span>将这种充满魅力的简约风格餐厅带到中国，餐厅延续英伦都绎华宅的设计风格，采用经典的黑白色调，映衬出东西方的对称之美。营造别致清新、静谧典雅的就餐氛围。多元化的美食、舒适柔和的环境、乡村与都市的完美融合，给味蕾以享受的同时让顾客体验到不一样的西餐厅风情。
</p>
<p>
    &nbsp;
</p>
<p>
    &nbsp;
</p>            <a href="pinpai.html">了解更多>></a>
            </p>
         </div>
     </div>
</div>
<div class="food">
     <div class="title">
         <h3>一起休闲馆</h3>
         <p>融合东西方风味的美食 享用生活的片刻情趣</p>
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
         <h3>美食 + 手游</h3>
         <p>一站帮扶无需开店经验 化繁为简多菜系揽金</p>
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
<include file="Public:footer"/>