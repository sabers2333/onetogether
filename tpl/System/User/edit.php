<include file="Public:header"/>
	<form id="myform" method="post" action="{:U('User/amend')}" frame="true" refresh="true">
		<input type="hidden" name="id" value="{$info.id}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">用户名字</th>
				<td><div class="show">{$info.username}</div></td>
			</tr>
			<tr>
				<th width="80">用户手机</th>
				<td><div class="show">{$info.mobile}</div></td>
			</tr>
			<tr>
				<th width="80">用户留言</th>
				<td><textarea name="content" id="" cols="30" rows="10">{$info.content}</textarea></td>
			</tr>
			<tr>
				<th width="80">回复留言</th>
				<td><textarea name="recomment" id="" cols="30" rows="10">{$info.recomment}</textarea></td>
			</tr>
			
			<tr>
				<th width="80">是否显示</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <if condition="$info['status'] eq 1">selected</if>"><span>显示</span><input type="radio" name="status" value="1" <if condition="$info['status'] eq 1">checked="checked"</if> /></label></span>
					<span class="cb-disable"><label class="cb-disable <if condition="$info['status'] neq 1">selected</if>"><span>隐藏</span><input type="radio" name="status" value="0" <if condition="$info['status'] neq 1">checked="checked"</if>/></label></span>
				</td>
			</tr>
			
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>