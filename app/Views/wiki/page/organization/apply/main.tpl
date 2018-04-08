{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">机构申请列表</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form class="form-inline" role="form">
					{include file="radishadmin/widgets/filter/filter-unit/filter-unit.tpl"}
					{include file="radishadmin/widgets/filter/filter-city/filter-city.tpl"}
					<a type="button" class="btn btn-sm btn-warning filter_btn">筛选</a>
				</form>
			</div>
		</div>
		<hr>
		{if $list}
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id='admin-list' class="table table-striped table-hover">
						<thead>
							<tr>
								<th>编号</th>
								<th>账号</th>
								<th>机构名称</th>
								<th>单位类型</th>
								<th>机构所在区域</th>
								<th>联系人</th>
								<th>联系人电话</th>
								<th>申请时间</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}'>
								<td>{$item.id}</td>
								<td>{$item.tel}</td>
								<td>{$item.name}</td>
								<td>{$item.unit_name}</td>
								<td>{if $item.provincename}{$item.provincename} {/if}{if $item.cityname}{$item.cityname} {/if}{if $item.countyname}{$item.countyname} {/if}</td>
								<td>{$item.linkname}</td>
								<td>{$item.linkphone}</td>
								<td>{$item.create_time}</td>
								<td>
									<div class="btn-group">
										<a href='/radishadmin/organization/particulars?id={$item.id}' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-share fa-fw"></i>
											<span>查看</span>
										</a>
										{if $item.status==0}
										<a type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#user-delete-confirm">
											<i class="fa fa-check fa-fw"></i>
											<span>通过认证</span>
										</a>
										<a type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#user-delete-confirm1">
											<i class="fa fa-close fa-fw"></i>
											<span>拒绝申请</span>
										</a>
										{elseif $item.status==1}
										<a href="javascript:;" type="button" class="btn btn-primary btn-xs" disabled="disabled">已通过申请认证</a>
										{elseif $item.status==2}
										<a href="javascript:;" type="button" class="btn btn-warning btn-xs" disabled="disabled">已拒绝申请认证</a>
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
						<h4 class="modal-title">通过确认</h4>
					</div>
					<form class="modal-body">
						<p>确定要通过该申请吗?</p>
						<input type="hidden" name="id" class="admin-id">
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
						<span>拒绝确认</span>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					</div>
					<form class="modal-body">
						<div class="form-group form-content">
							<label for="content" class="control-label">请输入拒绝原因：</label>
							<input id='content' type="text" name='content' class="form-control">
						</div>
						<input type="hidden" name="id" class="passport-name">
						<p class="text-right">
							<button type="button" class="btn btn-primary">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>
		
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/organization/apply/index_f9c3dce.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}