{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">区域运营列表</h1>
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
								<th>账号</th>
								<th>名称</th>
								<th>联系人</th>
								<th>联系方式</th>
								<th>到期时间</th>
								<!--                            <th>管理区域</th>-->
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}' data-time="{$item.expire_time}">
								<td>{$item.id}</td>
								<td>{$item.tel}</td>
								<td>{$item.name}</td>
								<td>{$item.contactname}</td>
								<td>{$item.contact}</td>
								<td>{$item.expire_time}</td>
								<!--                            <td>未选择</td>-->
								<td>
									<div class="btn-group">
										<a href='/radishadmin/operate/detail?id={$item.id}' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-share fa-fw"></i>
											<span>查看</span>
										</a>
										<a href='/radishadmin/operate/category?id={$item.id}' type="button" class="btn btn-xs btn-warning">
											<i class="fa fa-plus fa-fw"></i>
											<span>添加管理区域</span>
										</a>
										<a type="button" class="btn btn-xs admin-delete btn-danger" data-toggle="modal" data-target="#admin-delete-confirm">
											<i class="fa fa-trash-o fa-fw"></i>
											<span>删除</span>
										</a>
										<a href="/radishadmin/operate/edit?id={$item.id}" type="button" class="btn btn-xs btn-primary">
											<i class="fa fa-edit fa-fw"></i>
											<span>编辑</span>
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

		<div id='admin-delete-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">删除确认</h4>
					</div>
					<form class="modal-body">
						<p>确定要将该区域运营人员删除么?</p>
						<input type="hidden" name="id" class="admin-id">
						<p class="text-right">
							<button type="button" class="btn btn-primary">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>
		<div id='pay-metho-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					</div>
					<form class="modal-body">
						<div class="form-group form-expire_time">
							<label for="expire_time" class="control-label">修改到期时间：</label>
							<input id='expire_time' type="text" class="form-control passport-name">
							<input type="hidden" name="expire_time" class="form-control passport-name">
						</div>
						<input type="hidden" name="id" class="passport-id">

						<p class="text-right">
							<button type="button" class="btn btn-primary btn-time">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>

		<!--bootstrap-datetimepicker-->
		<link rel="stylesheet" href="//img.oranzh.cc/wiki/static/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min_214bb4f.css">
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min_b8d2a8d.js"></script>
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/libs/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN_2eaeae4.js"></script>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/operate/list/index_f02b4df.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}