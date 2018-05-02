{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">举报信息列表<!--<a type="button" style="float:right;margin-right:20px;" class="btn btn-success excel">导出Excel</a>--></h1>

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
								<th>举报信息内容</th>
								<th>举报者(账号)</th>
								<th>举报时间</th>
								<th>信息发布人</th>
								<th>信息编号</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}'>
								<td>{$item.id}</td>
								<td class="cnt">{$item.note|truncate:20:"...":true}</td>
								<td>{$item.user_phone}</td>
								<td>{$item.create_time}</td>
								<td>{$item.fa_name}</td>
								<td>{$item.q_id}</td>
								<td>
									<div class="btn-group">
										<a href='/radishadmin/message/reportinfo?id={$item.id}' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-share fa-fw"></i>
											<span>查看举报信息内容</span>
										</a>
										<a href='/radishadmin/message/list?id={$item.q_id}' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-share fa-fw"></i>
											<span>查看</span>
										</a>
										<a type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#message-delete-confirm">
											<i class="fa fa-trash-o fa-fw"></i>
											<span>删除</span>
										</a>
									</div>
								</td>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
		{include file="radishadmin/widgets/page/page.tpl"} {else} 暂无数据 {/if}

		<div id='message-delete-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">删除确认</h4>
					</div>
					<form class="modal-body">
						<p>确定要将该条举报信息从系统中删除么?</p>
						<input type="hidden" name="id" class="admin-id">
						<p class="text-right">
							<button type="button" class="btn btn-primary">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>
		
		

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/message/reportlist/index_87d736c.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}