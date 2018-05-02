{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">编辑用户</h1>

			</div>
		</div>
		<div class="row">
			<div class="col-lg-5 col-md-12">
				<form role="form" id='form-create' method="post">
					<div class="form-group form-tel">
						<label for="tel" class="control-label">账号</label>
						<input id='tel' type="text" name='tel' class="form-control" maxlength="11" autocomplete="off" value="{$user.phone}">
					</div>
					<div class="form-group form-pw">
            <label for="pw" class="control-label">密码</label>
            <input id='pw' type="text" name='pw' class="form-control">
            <input type="hidden" id="pw1" value="{$user.password}">
            <p class="help-block">如果留空，则不修改密码。</p>
          </div>
					<div class="form-group form-name">
						<label for="name" class="control-label">昵称</label>
						<input id='name' type="text" name='name' class="form-control" value="{$user.name}">
					</div>

					{include file="radishadmin/widgets/city/city.tpl"}
					
					<p class="help-block">此用户所在区域为  {if $user.provincename}{$user.provincename}{/if} {if $user.cityname}{$user.cityname}{/if} {if $user.areaname}{$user.areaname}{/if}。</p>
					<p class="help-block">如果不选，则不修改所在区域。</p>
					
					<input type="hidden" name="id" value="{if $user && $user.id}{$user.id}{/if}">

					<p class="text-right">
						<button type='button' class="btn btn-primary">
							<i class="fa fa-edit fa-fw"></i> 编辑
						</button>
					</p>
				</form>
			</div>
		</div>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/widgets/city/city_05947d4.js"></script>
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/user/edit/index_e8e290e.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}