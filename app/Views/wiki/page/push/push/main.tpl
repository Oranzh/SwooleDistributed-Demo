{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">消息推送</h1>
			</div>
		</div>
         
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<form role="form" id='form-push' method="post" autocomplete="off">
					<input type="hidden" value="{$session.role}" id="role">
					
					<div class="form-group form-body">
						<label for="body" class="control-label">推送内容</label>
						<textarea id='body' type="text" name='body' class="form-control" maxlength="200" rows="5"></textarea>
					</div>
                  <div class="form-group form-tel">
						<label for="tel" class="control-label">电话</label>
						<input id='tel' type="text" name='tel' class="form-control" maxlength="11" autocomplete="off">
					</div>
					<div class="form-group form-status">
						<label for="status" class="control-label">推送群体</label>
						<select class="form-control select" id="user_type">
							<option value="9" type="text">全部</option>
							<option value="2" type="text">机构</option>
							<option value="1" type="text">志愿者</option>
							<option value="0" type="text">普通用户</option>
						</select>
					</div>

					<div class="form-group row" id="new_area">
						<div class="col-lg-12 col-md-12 m-b10">
							<label class="control-label">
								<span>推送区域</span>&nbsp;&nbsp;&nbsp;
								<a type="button" class="btn btn-xs btn-info" id="push">添加推送区域</a>
							</label>
						</div>
						<div class="col-lg-12 col-md-12 m-b10 row" id="area_select" data-status='y'>
							<div class="col-lg-3 col-md-3">
								<select class="form-control select1" autocomplete="off">
									<option value="" class="disabled" style="height:0px;display:none;"></option>
								</select>
							</div>
							<div class="col-lg-3 col-md-3">
								<select class="form-control select2" autocomplete="off" disabled="disabled">
									<option value="" class="disabled" style="height:0px;display:none;"></option>
								</select>
							</div>
							<div class="col-lg-3 col-md-3">
								<select class="form-control select3" autocomplete="off" disabled="disabled">
									<option value="1" class="disabled" style="height:0px;display:none;"></option>
								</select>
							</div>
						</div>
					</div>

					<p class="text-right">
						<button type='button' class="btn btn-primary">
							<i class="fa fa-plus fa-fw"></i>推送
						</button>
					</p>
				</form>
			</div>
		</div>

		<!--FormValid-->
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/push/push/index_efee459.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}