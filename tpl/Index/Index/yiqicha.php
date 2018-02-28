<include file="Public:header"/>
<link rel="stylesheet" type="text/css" href="{$static_path}css/lightGallery.css" />
<script type="text/javascript" src="{$static_path}js/lightGallery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var i=0;
    $("#auto-loop").lightGallery({
        loop:true,
        auto:true,
        pause:4000
    });
    
    $("#next").click(function(){
        i++;
        if(i>2){i=0;}
        $(".ny_pro_2 ul li").eq(i).show().siblings("li").hide();
        
        });
    $("#pret").click(function(){
        i--;
        if(i<0){i=2;}
        $(".ny_pro_2 ul li").eq(i).show().siblings("li").hide();
        
        });
});
</script>
<style>
    .FrontColumns_navigation01-d1_c1 ul.nav-first li a{
        line-height: 50px;
        font-size: 18px;
        color: #000;

    }
    .ny_title{height: 50px;}
</style>
                    
<div class="ny_banner" style="background:url({$static_path}images/20160130112133492.jpg) no-repeat center top;"><a href="" target="_blank"></a></div>
    
<a name="food" id="food"></a>
<div class="ny_main">
    <div class="ny_title">
             <div id="box_left_sub1_sub1_sub2" data-unuse="1" style="height: 50px;background-color: #B3B3B3;font-weight: bold;"> 
            
<div class="FrontColumns_navigation01-d1_c1" data-unuse="1" style="height: 46px;border: 0;width: 1200px;">
    <ul class="nav-first">
     
         <li><a href="food.html?cat_id=24" title="西餐">西餐</a></li>  
         <li style="margin-left: 148px"><a href="food.html?cat_id=25" title="中餐">中餐</a></li>  
         <li style="margin-left: 148px"><a href="food.html?cat_id=26" title="饮品">饮品</a></li>  
        
         <li style="margin-left: 148px"><a href="food.html?cat_id=27" title="烧烤">烧烤</a></li>  
         <li style="margin-left: 148px"><a href="food.html?cat_id=28" title="特色">特色</a></li>  
                  
    </ul></div> 
          </div>
    </div>
    
<div class="ny_food" style="padding-top: 0">
        <div class="w16">
            <!-- <div class="ny_food_t">
            <ul class="food_memu">
                  
                <li><a href="food.html?cat_id=24" title="西餐"><div><i class="icon iconfont"></i></div><p>西餐</p></a></li>
                      
                <li><a href="food.html?cat_id=25" title="中餐"><div><i class="icon iconfont"></i></div<p>中餐</p></a></li>
                      
                <li><a href="food.html?cat_id=26" title="饮品"><div><i class="icon iconfont"></i></div<p>饮品</p></a></li>
                      
                <li><a href="food.html?cat_id=27" title="烧烤"><div><i class="icon iconfont"></i></div><p>烧烤</p></a></li>
                      
                <li><a href="food.html?cat_id=28" title="特色"><div><i class="icon iconfont"></i></div><p>特色</p></a></li>
                            <div class="clear"></div>
             </ul>
                       </div> -->
          
           <div class="ny_food_c">
               <ul id="auto-loop">
                    <volist name = 'list' id = 'vo'>
                    <li style="margin-right:" data-src="{$config.site_url}/upload/adver/{$vo.pic}"><a href="#"><img src="{$config.site_url}/upload/adver/{$vo.pic}" /><p>{$vo.name}</p></a></li> 
                    </volist> 
                </ul>  
              <!--分页开始-->
                  <div style="margin:0 auto;text-align: center;">{$page}</div>
              <!--分页结束 --> 
           </div>
        </div>
    </div> 
</div>
<include file="Public:footer"/>