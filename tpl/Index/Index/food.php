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

                    
<div class="ny_banner" style="background:url({$static_path}images/20160130112133492.jpg) no-repeat center top;"><a href="" target="_blank"></a></div>
    
<a name="food" id="food"></a>
<div class="ny_main">
    <div class="ny_title">
            <div class="w16">
                 <h3>美味提供</h3><p>Delicious offer</p>
                 <div class="tels">
                     <i class="icon iconfont">&#xe616;</i>
                     <h2>客户服务热线</h2>
                     <h4>400-875-3808</h4>
                 </div>
            </div>
    </div>
    
<div class="ny_food">
        <div class="w16">
           <div class="ny_food_c">
               <ul id="auto-loop">
                    <volist name = 'list' id = 'vo'>
                    <li style="margin-right:" data-src="{$config.site_url}/upload/adver/{$vo.pic}"><a href="#"><img src="{$config.site_url}/upload/adver/{$vo.pic}" /><p>{$vo.name}</p></a></li> 
                    </volist> 
                </ul>  
              <!--分页开始-->
                  {$page}
              <!--分页结束 --> 
           </div>
        </div>
    </div> 
</div>
<include file="Public:footer"/>