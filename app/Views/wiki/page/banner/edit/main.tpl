{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<link rel="stylesheet" href="//img.oranzh.cc/wiki/static/libs/laydate/need/laydate_e5234bd.css">
	<link rel="stylesheet" href="//img.oranzh.cc/wiki/static/libs/laydate/skins/default/laydate_1cea54f.css">
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">编辑Banner图</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<form role="form" id='form-create' method="post" autocomplete="off">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group form-name">
								<label for="name" class="control-label">轮播图名称</label>
								<input id='name' type="text" name='name' class="form-control" maxlength="128" value="{$list.name}">
							</div>
							<div class="form-group form-link">
								<label for="link" class="control-label">链接地址</label>
								<input id='link' type="text" name='link' class="form-control" maxlength="256" value="{$list.link}">
							</div>

							{include file="radishadmin/widgets/city/city.tpl"}
							<p class="help-block">此Banner所选区域为 {if $list.provincename}{$list.provincename}{/if} {if $list.cityname}{$list.cityname}{/if} {if $list.areaname}{$list.areaname}{/if}。</p>
							<p class="help-block">如果不选，则不修改所在区域。</p>
							<div class="form-group form-cate_1">
								<label for="start_time" class="control-label">设置开始时间</label>
								<input class="form-control " name="start" type="text" id="start" value="{$list.start_time}">
							</div>
							<div class="form-group form-cate_1">
								<label for="end_time" class="control-label">设置结束时间</label>
								<input class="form-control" name="end" type="text" id="end" value="{$list.end_time}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6" style="padding-top:20px">
							<div id='lunbo' class="panel panel-default">
								<div class="panel-heading">编辑Banner图</div>
								<div class="panel-body">
									<div class="table-responsive">
										<p class="add-file">
											<span class="btn btn-success fileinput-button">
                          <i class="fa fa-plus fa-fw"></i>
                          <span>添加并上传</span>
											<input type="file" multiple accept="image/*">
											</span>
										</p>
										<table class="table table-striped table-hover table-file-upload">
											<tr>
												<th>预览</th>
												<th>状态</th>
												<th></th>
											</tr>
										</table>
									</div>
									<p class="help-block">最多上传<code>1</code>张图片，请确认每张图片小于<code>2MB</code>,图片超过2MB上传文件将会导致系统卡顿。您也可以将需要上传的图片拖动到此处。</p>
								</div>
							</div>

						</div>
					</div>
					<input type="hidden" name="id" value="{if $list.id}{$list.id}{/if}">
					<p class="text-right">
						<button type='button' class="btn btn-primary">
							<i class="fa fa-edit fa-fw"></i>编辑
						</button>
					</p>
				</form>
			</div>
		</div>

		<script type="text/html" id="avatar">
			{if $list.images}{$list.images.s},{$list.images.m},{$list.images.b}{/if}
		</script>
		<script src="//img.oranzh.cc/wiki/static/libs/laydate/laydate_9305eb7.js"></script>
		<!--FormValid-->
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>

		<!--FileUpload-->
		<link rel="stylesheet" type="text/css" href="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_9e8ebab.css" />
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_bbeb1ca.js"></script>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/widgets/city/city_05947d4.js"></script>
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/banner/edit/index_23c4dbc.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}