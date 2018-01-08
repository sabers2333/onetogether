<div class="main_header">
        <div class="header_container">
            <a href="http://zcplan.cn/Coperation-workplace.html" class="fl zc_logo"><img src="{$static_path}images/zc_logo.png" alt=""></a>
                <div class="logo-tit"><a href="/" style="color: #888">职趣视频</a></div>
            <div class="header_right fr">
                <!--未登录状态-->
                <!--<a href="" class="sign_link">企业入口</a>-->
                <!--<span class="sign_bar">|</span>-->
                <!--<a href="" class="sign_link" target="_blank">团委入口</a>-->
                
                <if condition="empty($user_session)">
                    <a href="{:U('Login/singlelogin')}" class="signin">登录</a>
                    <a href="{:U('Login/singlereg')}" class="signup">注册</a>
                <else/>
                    <p class="user-info__name growth-info growth-info--nav">
                        <span>
                            <a rel="nofollow" href="{:U('Index/index')}" class="username" style="color: #000"> {$user_session.nickname}</a>
                        </span>
                        <!-- <a class="user-info__logout" href="{:U('Login/logout')}" style="color: #F76120">退出</a> -->
                        <a class="user-info__logout" href="javacript:;" style="color: #F76120">退出</a>
                    </p>
                </if>
                <!--未登录状态-->
                <!--<a href="" class="sign_link">企业入口</a>-->
                <!--<span class="sign_bar">|</span>-->
                <!--<a href="" class="sign_link" target="_blank">团委入口</a>-->
                <!--<a href="login.php" class="signin">登录</a>-->
                <!--<a href="register.php" class="signup">注册</a>-->
                <!--登录之后状态-->
                <!--
                <a href="message.php" class="zc_icons doorbell"><span>99</span></a>
                <a href="user_center.php" class="sign_link">个人中心</a>
                <span class="sign_bar">|</span>
                <a href="" class="sign_link">上官婉儿<span class="trigger_icon"></span></a> -->
            </div>
        </div>
    </div>