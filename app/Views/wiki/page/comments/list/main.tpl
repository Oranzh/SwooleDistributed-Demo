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
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}' data-user="{$item.user_id}">
								<td>{$item.id}</td>
								<td class="cnt">{$item.content|truncate:21:"...":true}</td>
								<td>{$item.create_time}</td>
								<td>{$item.user_name}</td>
								<td>
									<div class="btn-group">
										<a href='/radishadmin/comments/detail?id={$item.q_id}' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-share fa-fw"></i>
											<span>查看</span>
										</a>
										<a type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#message-delete-confirm">
											<i class="fa fa-trash-o fa-fw"></i>
											<span>删除</span>
										</a>
										<a data-toggle="modal" data-target="#message-edit-confirm" type="button" class="btn btn-xs btn-primary">
											<i class="fa fa-edit fa-fw"></i>
											<span>编辑</span>
										</a>
										{if $item.user_status==1}
										<a type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#user-delete-confirm1">
											<span>加入黑名单</span>
										</a>
										{else}
										<a type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#user-delete-confirm2">
											<span>解除黑名单</span>
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

		<div id='message-delete-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">删除确认</h4>
					</div>
					<form class="modal-body">
						<p>确定要将该条评论从系统中删除么?</p>
						<input type="hidden" name="id" class="admin-id">
						<p class="text-right">
							<button type="button" class="btn btn-primary">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>
		
		<div id='message-edit-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					</div>
					<form class="modal-body">
						<div class="form-group form-content">
							<label for="content" class="control-label">编辑评论内容：</label>
							<textarea id='content' type="text" name='content' class="form-control" maxlength="500" rows="5"></textarea>
						</div>
						<input type="hidden" name="id" class="passport-id">

						<p class="text-right">
							<button type="button" class="btn btn-primary">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>
		
		<div id='user-delete-confirm1' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">加入黑名单确认</h4>
					</div>
					<form class="modal-body">
						<p>确定要将该用户加入黑名单吗?</p>
						<input type="hidden" name="id" class="user-id1">
						<input type="hidden" name="status" value="2">
						<p class="text-right">
							<button type="button" class="btn btn-primary">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>

		<div id='user-delete-confirm2' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">解除黑名单确认</h4>
					</div>
					<form class="modal-body">
						<p>确定要将该用户从黑名单中解除吗?</p>
						<input type="hidden" name="id" class="user-id2">
						<input type="hidden" name="status" value="1">
						<p class="text-right">
							<button type="button" class="btn btn-primary">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>
		
		<script type="text/ecmascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/comments/list/index_303f256.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}