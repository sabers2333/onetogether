<include file="Public:header"/>
<body>
<div class="page-group">
    <div class="page page-current">
        <header id="header" class="mui-bar mui-bar-nav bg_white">
            <h1 class="mui-title">职趣视频</h1>
            <a href="javascript:history.back();" class="mui-icon mui-icon-arrowleft mui-pull-left"></a>
        </header>
        <div class="mui-content">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <volist name="index_lunbo_adver" id="vo">
                    
                    <div class="swiper-slide"><a href="{$vo.url}" onclick="_czc.push(['_trackEvent', '趣味职场', '手机网页', 'banner']);"><img src="{$vo.pic}" alt=""> </a></div>
                   
                    </volist>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <foreach name="category" item="vo">
            <div class="interesting_block">
                <div class="interesting_heading">
                    <h3 class="pull-left">{$vo.cat_name}</h3>
                    <a href="{:U('more',array('cat_id'=>$vo['cat_id']))}" class="pull-right" external>更多></a>
                </div>
                <ul class="interest_list">
                    <foreach name="vo.list" item="voo">
                    <li>
                        <a href="{:U('detail',array('id'=>$voo['id']))}" class="interesting_item" onclick="_czc.push(['_trackEvent', '趣味职场', '手机网页', '首页视频']);" external>
                            <div class="interest_pic"><img src="{$config.site_url}/upload/slider/{$voo.pic}" alt="" ><span class="duration">{$voo.duration}</span></div>
                            <h3 class="interest_title">【{$vo.cat_name}】{$voo.name}</h3>
                            <p class="interest_date">发布时间 {$voo.last_time}</p>
                        </a>
                    </li>
                    </foreach>
                </ul>
            </div>
            </foreach>
            
            <div class="interest_text"><span>疯狂吐槽世界每个角落的荒诞事</span></div>
        </div>
    </div>
</div>
<script type='text/javascript' src='{$static_path}js/zepto.min.js'></script>
<script type="text/javascript" src="{$static_path}js/swiper.min.js"></script>
<script type="text/javascript" src="{$static_path}js/mui.min.js"></script>
<script type="text/javascript" src="{$static_path}js/wechat-main.js"></script>
<include file="Public:footer"/>
