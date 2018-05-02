{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">评论列表</h1>

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
								<th>评论内容</th>
								<th>评论时间</th>
								<th>评论用户</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}' data-user="{$item.user_id}">
								<td>{$item.id}</td>
								<td class="cnt">{$item.content}</td>
								<td>{$item.create_time}</td>
								<td>{$item.user_name}</td>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
		{include file="radishadmin/widgets/page/page.tpl"} {else} 暂无数据 {/if}
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/message/commentslist/index_d41d8cd.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}