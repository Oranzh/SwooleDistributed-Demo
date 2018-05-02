<div class="form-group" id="unit-1">
	<label class="control-label">选择单位类型 <span style="color:#e4393c;font-size:12px;">没有选择区县，则此选项不可选</span></label>
	<select class="form-control unit1" name="">
		<option value="" class="disabled" style="height:0px;display:none;"></option>
	</select>
</div>
<!--<div id="unit2">-->
	<!--<div class="form-group">-->
		<!--<label class="control-label">选择二级单位类型</label>-->
		<!--<select class="form-control unit2">-->
			<!--<option></option>-->
		<!--</select>-->
	<!--</div>-->
<!--</div>-->
<input type="hidden" name="unit" id="unit" value="{if $user.unit}{$user.unit}{/if}">
<input type="hidden" name="unit_two" id="unit_two" value="{if $user.unit_two}{$user.unit_two}{else}0{/if}">