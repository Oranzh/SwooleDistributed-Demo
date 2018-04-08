{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">区域运营人员详情</h1>
			</div>
		</div>

		<div class="row">
			<div id='trade-wrapper' class="col-lg-7 col-md-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						运营人员详情
					</div>
					<div class="panel-body">
						<div class="row clearfix">
							<div class="col-lg-12">
								<p>编号
									<span class="text-muted">{$admin.id}</span></p>
							</div>
							<div class="col-lg-12">
								<p>账号：<span class="text-muted">{$admin.tel}</span></p>
							</div>
							<div class="col-lg-12">
								<p>名称：<span class="text-muted">{$admin.name}</span></p>
							</div>

							<div class="col-lg-12">
								<p>联系人：<span class="text-muted">{$admin.contactname}</span></p>
							</div>
							<div class="col-lg-12">
								<p>联系方式:
									<span class="text-muted">{$admin.contact}</span>
								</p>
							</div>
							<div class="col-lg-12">
								<p>注册时间:
									<span class="text-muted">{$admin.create_time}</span>
								</p>
							</div>
							<div class="col-lg-12">
								<p>到期时间:
									<span class="text-muted">{$admin.expire_time}</span>
								</p>
							</div>
							<div class="col-lg-12">
								<p>管理区域：
									<span class="text-muted">
										{foreach from=$name key=i item=item}
										{$item.provincename} / {$item.cityname } {$item.countyname}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										{/foreach}
									</span>
								</p>
							</div>
						</div>
					</div>
				</div>

				{include file="radishadmin/widgets/footer/footer.tpl"}