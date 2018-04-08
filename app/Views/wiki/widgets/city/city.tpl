<div class="form-group" id="select-1">
	<label for="tags_1" class="control-label">请选择省</label>
	<select class="form-control select1" name="" autocomplete="off">
		<option value="" class="disabled" style="height:0px;display:none;"></option>
	</select>
</div>
<div class="select2">

</div>
<div class="select3">

</div>
<input type="hidden" name="parent_code" id="parent_code">
<input type="hidden" name="type" id="ptype">

<input type="hidden" name="province" id="province" value="{if $user && $user.province}{$user.province}{elseif $list && $list.province}{$list.province}{/if}">
<input type="hidden" name="city" id="city" value="{if $user && $user.city}{$user.city}{elseif $list && $list.city}{$list.city}{/if}">
<input type="hidden" name="area" id="area" value="{if $user && $user.area}{$user.area}{elseif $list && $list.area}{$list.area}{/if}">

<script type="text/html" id="select-2">
	<div class="form-group form-tags_2">
		<label for="tags_2" class="control-label">请选择市</label>
		<select class="form-control select2" id="sel">
			<option></option>
		</select>
	</div>
</script>

<script type="text/html" id="select-3">
	<div class="form-group form-tags_3">
		<label for="tags_3" class="control-label">请选择区/县</label>
		<select class="form-control select3 disabled" id="sel">
			<option></option>
		</select>
	</div>
</script>