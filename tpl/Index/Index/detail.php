<include file="Public:header"/>
 
    <div id="content">
        <div id="content-core">
            <div id="main">
                <div id="main-core">
                    <div id="postpath" class="row_width960">
                        <a title="Go to homepage" href="/index.html">品牌首页</a><span>/</span><a href="/news.html">新闻动态</a>
                    </div>
                    <div id="intro" class="option1">
                        <div id="intro-core">
                            <h1 class="page-title"><span>{$info.name}</span></h1>
                        </div>
                    </div>
                    <div class="wpb_row vc_row-fluid row_width961 have_left_side" style="margin-bottom: 25px;">
                        <div class="vc_span91 wpb_column column_container">
                            <div class="wpb_wrapper">
                                <header class="entry-header entry-meta"><span class="author"><i class="icon-pencil"></i>By <a href="/index.html" rel="author">一起茶</a></span><span class="date"><i class="icon-calendar-empty"></i><a ><time >{$info.last_time|date='Y-m-d H:i:s',###}</time></a></span><span class="category"><i class="icon-folder-open"></i><a href="/news.html">新闻动态</a></span>阅读 {$info.click} 次</header><!-- .entry-header -->
                               
                                <div class="entry-content" style="line-height: 24px;">{$info.content}</div>

                                <!-- .entry-content -->
                               <!--  <nav role="navigation" id="nav-below">
                               <div class="nav-previous">
                                   <a href="#?id=147" rel="prev"><span class="meta-icon"><i class="icon-angle-left icon-large"></i></span><span class="meta-nav">没有了 </span></a>
                               </div>
                               <div class="nav-next">
                                   <a href="javascript:;" rel="next"><span class="meta-nav">万圣狂欢 魔夜魅影 </span><span class="meta-icon"><i class="icon-angle-right icon-large"></i></span></a>
                               </div>
                               </nav> -->
                                <!-- #nav-below -->
                            </div>
                        </div>
                        <div class="vc_span3 wpb_column column_container">
                            <div class="wpb_wrapper sidebar_list">
                                <h3>最近新闻</h3>
                                <ul id="cat_related">
                                    <volist name = 'getnew' id = 'vo'>
                                        <li>
                                            <a href="detail.html?id={$vo.id}">
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
                            <div class="wpb_wrapper sidebar_list">
                                <h3>热门推荐</h3>
                                <ul id="cat_related">
                                    <volist name = 'gethot' id = 'vo'>
                                        <li>
                                            <a href="detail.html?id={$vo.id}">
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

<include file="Public:footer"/>