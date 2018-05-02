{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">添加志愿者</h1>

			</div>
		</div>
		<div class="row">
			<div class="col-lg-5 col-md-12">
				<form role="form" id='form-create' method="post">
					<div class="form-group form-tel">
						<label for="tel" class="control-label">账号</label>
						<input id='tel' type="text" name='tel' class="form-control" maxlength="11" autocomplete="off">
					</div>
					<div class="form-group form-pw">
						<label for="pw" class="control-label">密码</label>
						<input id='pw' type="text" name='pw' class="form-control" autocomplete="off">
					</div>
					<div class="form-group form-name">
						<label for="name" class="control-label">真实姓名</label>
						<input id='name' type="text" name='name' class="form-control">
					</div>

					{include file="radishadmin/widgets/city/city.tpl"}
					
<!--
					<div class="form-group form-linkname">
						<label for="linkname" class="control-label">所在单位</label>
						<input id='linkname' type="text" name='linkname' class="form-control">
					</div>
-->
					<div class="form-group form-address">
						<label for="address" class="control-label">单位名称</label>
						<input id='address' type="text" name='address' class="form-control">
					</div>
					<div class="form-group form-card_num">
						<label for="card_num" class="control-label">身份证号码</label>
						<input id='card_num' type="text" name='card_num' class="form-control" maxlength="18">
					</div>
					
					<div class="form-group">
							<div id='lunbo' class="panel panel-default">
								<div class="panel-heading">添加身份证照片</div>
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
									<p class="help-block">必须上传<code>2</code>张图片，请确认每张图片小于<code>2MB</code>,图片超过2MB上传文件将会导致系统卡顿。您也可以将需要上传的图片拖动到此处。</p>
								</div>
							</div>
						</div>
					

					<p class="text-right">
						<button type='button' class="btn btn-primary">
							<i class="fa fa-plus fa-fw"></i> 添加
						</button>
					</p>
				</form>
			</div>
		</div>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>
		
		<!--FileUpload-->
		<link rel="stylesheet" type="text/css" href="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_9e8ebab.css" />
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_bbeb1ca.js"></script>
		
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/widgets/city/city_05947d4.js"></script>
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/volunteer/create/index_bd1ec29.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}