{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">机构列表</h1>
			</div>
		</div>
		{if $list}
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id='admin-list' class="table table-striped table-hover">
						<thead>
							<tr>
								<th>编号</th>
								<th>机构账号</th>
								<th>机构名称</th>
								<th>单位类型</th>
								<th>所在区域</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}'>
								<td>{$item.id}</td>
								<td>{$item.phone}</td>
								<td>{$item.org_name}</td>
								<td>{$item.unit_name}</td>
								<td>{if $item.provincename}{$item.provincename} {/if}{if $item.cityname}{$item.cityname} {/if}{if $item.countyname}{$item.countyname} {/if}</td>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
		{include file="radishadmin/widgets/page/page.tpl"} {else} 暂无数据 {/if}

		{include file="radishadmin/widgets/footer/footer.tpl"}