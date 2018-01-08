<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>微信公众平台源码,微信机器人源码,微信自动回复源码 PigCms多用户微信营销系统</title>
	<meta http-equiv="MSThemeCompatible" content="Yes" />
	<link rel="stylesheet" type="text/css" href="./static/css/style_2_common.css" />
	<link rel="stylesheet" type="text/css" href="./static/css/style.css" />
	<link rel="stylesheet" type="text/css" href="./static/css/cymain.css" />
	
	<script type="text/javascript" src="./static/js/common.js"></script>
	<script type="text/javascript" src="./static/js/jquery.min.js"></script>
	<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
	<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
	<style>
	body{line-height:180%;}
	ul.modules li{padding:4px 10px;margin:4px;background:#efefef;width:97%;}
	ul.modules li div.mleft{float:left;width:90%}
	ul.modules li div.mright{float:right;width:8%;text-align:right;}
	</style>
</head>
<body style="background:#fff;padding:20px 20px;">
	<ul class="modules">
		<volist name="modules" id="m">
		<?php if (!intval($_GET['iskeyword']) || (intval($_GET['iskeyword']) && $m['askeyword'])){ ?>
		<li>
			<div class="mleft">{$m.name}</div>
			<div class="mright">
				
				<if condition="$m['canselected']"><a href="javascript:;" onclick="returnHomepage('<?php if (!intval($_GET['iskeyword'])){ echo $m['linkcode']; }else{ echo $m['keyword']; }?>')" style="margin-left:14px;">选中</a></if>
			</div>
			<div style="clear:both"></div>
		</li>
		<?php }?>
		</volist>
		<div style="clear:both"></div>
	</ul>
	<script>
	var domid = art.dialog.data('domid');
	// 返回数据到主页面
	function returnHomepage(url)
	{
		var origin = artDialog.open.origin;
		var dom = origin.document.getElementById(domid);
		dom.value = url;
		setTimeout("art.dialog.close()", 100 )
	}
	</script>
</body>
</html>