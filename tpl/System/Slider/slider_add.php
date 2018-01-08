<include file="Public:header"/>
	<form id="myform" method="post" action="{:U('Slider/slider_modify')}" enctype="multipart/form-data">
		<input type="hidden" name="cat_id" value="{$now_category.cat_id}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">标题</th>
				<td><input type="text" class="input fl" name="name" size="20" placeholder="请输入名称" validate="maxlength:120,required:true"/></td>
			</tr>
			<tr>
				<th width="80">封面图片</th>
				<td><input type="file" class="input fl" name="pic" style="width:180px;" placeholder="请上传图片" tips="可不上传"/></td>
			</tr>
			<tr>
				<th width="80">文字描述</th>
				<td>
					<textarea name="filename"  placeholder="请输入文字描述"  style="width:600px;" validate="maxlength:150,required:true"></textarea>
				</td>
			</tr>

			<tr>
				<th width="80">内容</th>
				<td>
					<textarea name="content" id="content"></textarea>
				</td>
			</tr>
			<tr>
				<th width="80">排序</th>
				<td><input type="text" class="input fl" name="sort" style="width:80px;" value="0" validate="maxlength:10,required:true,number:true"/></td>
			</tr>
			<tr>
				<th width="80">推荐</th>
				<td>
					<span class="cb-enable"><label class="cb-enable selected"><span>启用</span><input type="radio" name="status" value="1" checked="checked" /></label></span>
					<span class="cb-disable"><label class="cb-disable"><span>关闭</span><input type="radio" name="status" value="0" /></label></span>
				</td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
	<script src="{$static_public}kindeditor/kindeditor.js"></script>
	<script type="text/javascript">
		KindEditor.ready(function(K){
			kind_editor = K.create("#content",{
				width:'402px',
				height:'300px',
				resizeType : 1,
				allowPreviewEmoticons:false,
				allowImageUpload : true,
				filterMode: true,
				items : [
					'source', 'fullscreen', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
					'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
					'insertunorderedlist', '|', 'emoticons', 'image', 'link'
				],
				emoticonsPath : './static/emoticons/',
				uploadJson : "{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news"
			});
		});
	</script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script>
function addLink(domid,iskeyword, type){
	art.dialog.data('domid', domid);
	
		art.dialog.open('?g=Admin&c=LinkPC&a=insert&iskeyword='+iskeyword,{lock:true,title:'请选择视频',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
	
}
</script>
<include file="Public:footer"/>