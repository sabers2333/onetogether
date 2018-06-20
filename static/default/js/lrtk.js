//顶部伸展广告
var url= new RegExp("^http://www.jiuwotianpin.com/(index.html){0,1}$");

if(url.test(window.location.href)){

    if ($("#js_ads_banner_top_slide").length) {
        var $slidebannertop = $("#js_ads_banner_top_slide"), $bannertop = $("#js_ads_banner_top");
        setTimeout(function () {
            $bannertop.slideUp(1000);
            $slidebannertop.slideDown(1000);
        }, 2500);
        setTimeout(function () {
            $slidebannertop.slideUp(1000, function () {
                $bannertop.slideDown(1000);
            });
        }, 8500);
    }
}
/*
if(location.href.indexOf("http://www.jiuwotianpin.com/")>-1) {
}*/


