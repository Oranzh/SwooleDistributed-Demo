{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">图片详情</h1>
			</div>
		</div>

		<div class="row">
			<div id='trade-wrapper' class="col-lg-7 col-md-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						图片详情
					</div>
					<div class="panel-body">
						<div class="row clearfix">
							<div class="col-lg-12">
								<p>图片详情：
									<span class="text-muted">
                  	{foreach from=$info key=i item=item}
										<a href="{$item.images.b}" target="_blank">
											<img src="{$item.images.s}" width="50px"></a>
                  	{/foreach}
                  
                  </span></p>
							</div>
						</div>
					</div>
				</div>

				{include file="radishadmin/widgets/footer/footer.tpl"}