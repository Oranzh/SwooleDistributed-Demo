{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">发布的信息列表</h1>
			</div>
		</div>
		{if $list}
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id='admin-list' class="table table-striped table-hover">
						<colgroup>
							<col>
								<col width="30%">
						</colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>信息内容</th>
								<th>发布时间</th>
								<th>状态</th>
								<th>类型</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}'>
								<td>{$item.id}</td>
								<td>{$item.content}</td>
								<td>{$item.create_time}</td>
								<td>{if $item.status==0}未找到{elseif $item.status==11}已找到{/if}</td>
								<td>类型</td>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
		{include file="radishadmin/widgets/page/page.tpl"} {else} 暂无数据 {/if} {include file="radishadmin/widgets/footer/footer.tpl"}