{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">反馈列表</h1>
			</div>
		</div>
		{if $list}
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id='admin-list' class="table table-striped table-hover">
						<colgroup>
							<col width="15%">
							<col width="15%">
							<col width="80%">
						</colgroup>
						<thead>
							<tr>
								<th>手机号</th>
								<th>反馈时间</th>
								<th>反馈内容</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr>
								<td>{$item.tel}</td>
								<td>{$item.create_time}</td>
								<!--<td class="cnt">{$item.content|truncate:21:"...":true}</td>-->
								<td>{$item.content}</td>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
		{include file="radishadmin/widgets/page/page.tpl"} {else} 暂无数据 {/if}

		{include file="radishadmin/widgets/footer/footer.tpl"}