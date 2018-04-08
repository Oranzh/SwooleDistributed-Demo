{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">编辑区域运营人员</h1>

			</div>
		</div>
		<div class="row">
			<div class="col-lg-5 col-md-12">
				<form role="form" id='form-edit' method="post">
					<div class="form-group form-tel">
						<label for="tel" class="control-label">账号</label>
						<input id='tel' type="text" name='tel' class="form-control" maxlength="11" autocomplete="off" value="{$tel}">
					</div>
					<div class="form-group form-pw">
						<label for="pw" class="control-label">密码</label>
						<input id='pw' type="text" name='pw' class="form-control" autocomplete="off" maxlength="18">
						<p class="help-block">如果留空，则不修改密码。</p>
					</div>
					<div class="form-group form-name">
						<label for="name" class="control-label">名称</label>
						<input id='name' type="text" name='name' class="form-control" maxlength="20" value="{$name}">
					</div>
					<div class="form-group form-contactname">
						<label for="contactname" class="control-label">联系人</label>
						<input id='contactname' type="text" name='contactname' class="form-control" maxlength="10" autocomplete="off" value="{$contactname}">
					</div>
					<div class="form-group form-contact">
						<label for="contact" class="control-label">联系方式</label>
						<input id='contact' type="text" name='contact' maxlength="11" class="form-control" value="{$contact}">
					</div>
					<div class="form-group form-expire_time">
						<label for="expire_time" class="control-label">选择到期时间</label>
						<input id='expire_time' type="text" class="form-control" readonly style="background:#fff;cursor:inherit">
						<input type="hidden" name='expire_time' class="form-control" value="{$expire_time}">
					</div>
					<input type="hidden" name="id" value="{$id}">
					<p class="text-right">
						<button type='button' class="btn btn-primary">
							<i class="fa fa-edit fa-fw"></i> 编辑
						</button>
					</p>
				</form>
			</div>
		</div>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>

		<!--bootstrap-datetimepicker-->
		<link rel="stylesheet" href="//img.oranzh.cc/wiki/static/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min_214bb4f.css">
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min_b8d2a8d.js"></script>
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/libs/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN_2eaeae4.js"></script>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/operate/edit/index_7ae783c.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}