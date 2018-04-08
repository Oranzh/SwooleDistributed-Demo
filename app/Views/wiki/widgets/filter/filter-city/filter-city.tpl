<div class="form-group nav_group" id="select-1">
	<label for="tags_1" class="control-label">请选择省</label>
	<select class="form-control select1" name="" autocomplete="off" style="min-width:100px">
		<option value="" class="disabled" style="height:0px;display:none;"></option>
	</select>
</div>
<div class="form-group nav_group select2">

</div>
<div class="form-group nav_group select3">

</div>

<input type="hidden" name="province" id="province" value="{if $user && $user.province}{$user.province}{/if}">
<input type="hidden" name="city" id="city" value="{if $user && $user.city}{$user.city}{/if}">
<input type="hidden" name="area" id="area" value="{if $user && $user.area}{$user.area}{/if}">

<script type="text/html" id="select-2">
	<div class="form-tags_2">
		<label for="tags_2" class="control-label">请选择市</label>
		<select class="form-control select2" id="sel" style="min-width:100px">
			<option></option>
		</select>
	</div>
</script>

<script type="text/html" id="select-3">
	<div class="form-tags_3">
		<label for="tags_3" class="control-label">请选择区/县</label>
		<select class="form-control select3 disabled" id="sel" style="min-width:100px">
			<option></option>
		</select>
	</div>
</script>
<script type="text/javascript" src="//img.oranzh.cc/wiki/static/widgets/filter/filter-city/filter-city_0f1127a.js"></script>