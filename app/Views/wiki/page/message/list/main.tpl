{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">信息列表<a type="button" style="float:right;margin-right:20px;" class="btn btn-success excel">导出Excel</a></h1>

			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form class="form-inline" role="form">
				<div class="form-group">
						<label class="control-label">发布者</label>
						<select  name="role" class="form-control">
							<option value="" class="disabled" style="height:0px;display:none;"></option>
							<option value="3">普通用户</option>
							<option value="1">志愿者</option>
							<option value="2">机构</option>
						</select>
					</div>
					&nbsp;&nbsp;
					<div class="form-group">
						<label class="control-label">信息状态</label>
						<select class="form-control" name="status">
							<option value="" class="disabled" style="height:0px;display:none;"></option>
							<option value="11">已处理</option>
							<option value="1">未处理</option>
						</select>
					</div>
					&nbsp;&nbsp;
					<div class="form-group">
						<label class="control-label">场所</label>
						<select class="form-control" name="site">
							<option value="" class="disabled" style="height:0px;display:none;"></option>
						{foreach from=$site key=i item=item}
							<option value="{$item.id}">{$item.name}</option>
							{/foreach}
						</select>
					</div>
					&nbsp;&nbsp;
					{include file="radishadmin/widgets/filter/filter-time/filter-time.tpl"}
					{include file="radishadmin/widgets/filter/filter-city/filter-city.tpl"}
					<a type="button" class="btn btn-sm btn-warning filter_btn">筛选</a>
				</form>
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
								<th>发布者(账号)</th>
								<th>发布时间</th>
								<th>区域</th>
								<th>状态</th>
								<th>类型</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}'>
								<td>{$item.id}</td>
								<td class="cnt">{$item.content|truncate:35:"...":true}</td>
								<td>{$item.user_phone}</td>
								<td>{$item.create_time}</td>
								<td>{if $item.provincename}{$item.provincename}{/if}{if $item.cityname}{$item.cityname}{/if}{if $item.countyname}{$item.countyname} {/if}</td>
								<td>{if $item.status==0}未找到{elseif $item.status==11}已找到{/if}</td>
								<td>{$item.g_name}</td>
								<td>
									<div class="btn-group">
										<a href='/radishadmin/message/detail?id={$item.id}' type="button" class="btn btn-xs btn-info">
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
										<a href='/radishadmin/message/commentslist?id={$item.id}' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-info fa-fw"></i>
											<span>评论</span>
										</a>
										<a href='/radishadmin/message/privilege?id={$item.id}&type=1' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-share fa-fw"></i>
											<span>查看未修改图片</span>
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
						<p>确定要将该条信息从系统中删除么?</p>
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
							<label for="content" class="control-label">编辑信息内容：(注: 100-500字数内)</label>
							<textarea id='content' type="text" name='content' class="form-control" maxlength="500" minlength="100" rows="5"></textarea>
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
		
		<script type="text/ecmascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/message/list/index_cc03ffc.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}