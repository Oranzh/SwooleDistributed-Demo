<h1>这里是fis联调</h1>
这里是名字
{{$name}}
<br/>
这里是性别{{$sex}}
<div id="wrapper">
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">添加用户</h1>

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
						<label for="name" class="control-label">昵称</label>
						<input id='name' type="text" name='name' class="form-control">
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
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/widgets/city/city_05947d4.js"></script>
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/user/detail/index_907c599.js"></script>

