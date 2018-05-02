{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">操作日志</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form class="form-inline" role="form">
					{include file="radishadmin/widgets/filter/filter-time/filter-time.tpl"}

					{if $session.role==0 || $session.role==1}
					<div class="form-group">
						<label class="control-label">用户类型</label>
						<select class="form-control" name="type" id="select_type">
							<option value="" class="disabled" style="height:0px;display:none;"></option>
							<option value="1">管理员</option>
							<option value="3">运营者</option>
						</select>
					</div>
					&nbsp;&nbsp;
					<div class="form-group">
						<label class="control-label">用户名</label>
						<select class="form-control" name="name" id="select_name">
							<option value="" class="disabled" style="height:0px;display:none;"></option>
							{foreach from=$admin key=i item=item}
							<option value="{$item.id}">{$item.name}</option>
							{/foreach}
						</select>
					</div>
					{/if}
					&nbsp;&nbsp;
					<a type="button" class="btn btn-sm btn-warning filter_btn">筛选</a>
				</form>
			</div>
		</div>
		<hr> {if $list}
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id='admin-list' class="table table-striped table-hover">
						<thead>
							<tr>
								<th>编号</th>
								<th>日志内容</th>
								<th>记录时间</th>
								{if $session.role == 0}
								<th>操作</th>
								{/if}
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}'>
								<td>{$item.id}</td>
								<td>{$item.content}</td>
								<td>{$item.create_time}</td>
								<td>
									<div class="btn-group">
										{if $session.role == 0}
										<a type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#user-delete-confirm">
											<i class="fa fa-trash-o fa-fw"></i>
											<span>删除</span>
										</a>
										{/if}
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

		<div id='user-delete-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">删除确认</h4>
					</div>
					<form class="modal-body">
						<p>确定要将该条日志从系统中删除么?</p>
						<input type="hidden" name="id" class="admin-id">
						<p class="text-right">
							<button type="button" class="btn btn-primary">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>


		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/log/list/index_b7d3362.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}