
{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">添加区域</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6 col-md-6">
				<form role="form" id='form-create' method="post">
					<div class="form-group form-tags_1">
						<label for="tags_1" class="control-label">请选择省</label>
						<select class="form-control select1" name="" autocomplete="off">
							<option value="" class="disabled" style="height:0px;display:none;"></option>
							{foreach from=$list key=i item=item}
							<option value="{$item.adcode}">{$item.name}</option>
							{/foreach}
						</select>
					</div>
					<div class="select2">

					</div>
					<div class="select3">

					</div>
					<input type="hidden" name="parent_code" id="parent_code">
				<input type="hidden" name="id" id="pid">
				<input type="hidden" name="type" id="ptype">
					<p class="text-right">
						<button type='button' class="btn btn-primary">
							<i class="fa fa-plus fa-fw"></i> 添加
						</button>
					</p>
				</form>
			</div>
		</div>
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
					<option value="1"></option>
				</select>
			</div>
		</script>
		
		<!--FileUpload-->
		<link rel="stylesheet" type="text/css" href="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_9e8ebab.css" />
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_bbeb1ca.js"></script>
		
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>
		
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/system/citycreate/index_936d8ff.js"></script>
		{include file="radishadmin/widgets/footer/footer.tpl"}