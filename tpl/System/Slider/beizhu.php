<include file="Public:header"/>
	<form id="myform" method="post" action="{:U('addbeizhu')}" frame="true" refresh="true">
		<input type="hidden" name="id" value="{$_GET['id']}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">备注</th>
				<td><input type="text" class="input fl" name="beizhu" id="beizhu" size="50" placeholder="请添加备注" validate="maxlength:50,required:true" value="{$beizhu}"/></td>
			</tr>
			
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>