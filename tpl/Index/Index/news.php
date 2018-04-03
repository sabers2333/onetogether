<include file="Public:header"/>
 <div id="content">
            <div id="content-core">
                <div id="main">
                    <div id="main-core">
                        <div id="postpath" class="row_width960">
                            <a title="Go to homepage" href="/index.html">品牌首页</a><span> / </span>
                            <a href="/news.html">新闻动态</a>
                        </div>
                        <div id="intro" class="option1">
                            <div id="intro-core">
                                <h1 class="page-title">
                                <span>新闻动态</span>
                                </h1>
                            </div>
                        </div>
                        <div class="wpb_row vc_row-fluid row_width960 have_left_side">
                            <div class="vc_span9 wpb_column column_container">
                                    <volist name = "list" id = 'vo'> 
                                    <article id="post-5051" class="post-5051 post type-post status-publish format-standard has-post-thumbnail hentry category-news news-list-style">
                                        <div class="title-block">
                                            <h2 class="blog-title">
                                            <a href="detail.html?id={$vo.id}" style="text-indent:25px" target="_blank">{$vo.name}</a>
                                            </h2>
                                            <div class="entry-meta">
                                                <span class="author"><i class="icon-pencil"></i>By <a href="/index.html">一起茶</a></span>
                                                <span class="date">
                                                <i class="icon-calendar-empty"></i>
                                                <a href="detail.html?id={$vo.id}" target="_blank"><time >{$vo.last_time|date='Y-m-d',###}</time></a>
                                                </span>
                                                <span class="category">
                                                <i class="icon-folder-open"></i>
                                                <a href="/news.aspx">新闻动态</a>
                                                </span>
                                                阅读 {$vo.click} 次
                                            </div>
                                        </div>
                                        <header class="entry-header">
                                            <img width="300" height="187" class="attachment-medium wp-post-image" src="{$config.site_url}/upload/slider/{$vo.pic}"  />
                                        </header>
                                        <div class="entry-content  last">
                                            <p clas="content"  style="text-indent:25px">
                                            <a target="_blank" href="detail.html?id={$vo.id}" target="_blank">{$vo.filename}</a>
                                            </p>
                                            <p class="more">
                                            <a target="_blank" href="detail.html?id={$vo.id}" class="more-link themebutton" target="_blank" onclick="clicknews({$vo.id})">Read More</a>
                                            </p>
                                        </div>
                                        <div class="clearboth">
                                        </div>
                                    </article>
                                    </volist>
                                   <div style="margin:0 auto;text-align: center;">{$page}</div>
                            </div>
                            <div class="vc_span3 wpb_column column_container">
                                <div class=" sidebar_list">
                                    <h3>
                                    最近新闻
                                    </h3>
                                    <ul id="cat_related">
                                        <volist name = 'getnew' id = 'vo'>
                                        <li>
                                            <a href="detail.html?id={$vo.id}" target="_blank">
                                            <span class="title_jiuwo">{$vo.name}</span>
                                            <span class="meta">
                                            发布日期：{$vo.last_time|date='Y-m-d',###}
                                            <i class="icon-calendar-empty"></i>
                                            <time></time>
                                            </span>
                                            </a>
                                        </li>
                                        </volist>
                                    </ul>
                                </div>
                                <div class=" sidebar_list">
                                    <h3>
                                    热门推荐
                                    </h3>
                                    <ul id="cat_related">
                                        <volist name = 'gethot' id = 'vo'>
                                        <li>
                                            <a href="detail.html?id={$vo.id}" target="_blank">
                                            <span class="title_jiuwo">{$vo.name}</span>
                                            <span class="meta">
                                            发布日期：{$vo.last_time|date='Y-m-d',###}
                                            <i class="icon-calendar-empty"></i>
                                            <time></time>
                                            </span>
                                            </a>
                                        </li>
                                        </volist>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #main-core -->
                </div>
                <!-- #main -->
            </div>
        </div>
        <!-- #content -->
    </div>
    <!-- #main-core -->
    <div class="fix_margin_b25px">
    </div>
    <script type="text/javascript">
        function clicknews(id){
            $.post("addclick.html",{id:id},function(data){
             });
        }
    </script>
<include file="Public:footer"/>