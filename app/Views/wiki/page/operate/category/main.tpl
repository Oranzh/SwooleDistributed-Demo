
	<!--1111-->
	{include file="radishadmin/widgets/header/header.tpl"}
	<div id="wrapper">
		{include file="radishadmin/widgets/nav/nav.tpl"}
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">为 {$admin.name} 添加管理区域</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6">
					<form role="form" id='form-create' method="post">
						<div class="form-group form-tags_1">
							<label for="tags_1" class="control-label">请选择省</label>
							<select class="form-control select1" name="" autocomplete="off">
								<option value="" class="disabled" style="height:0px;display:none;"></option>
								{foreach from=$list key=i item=item}
								<option value="{$item.adcode}">{$item.name}</option>
								{/foreach}
							</select>
						</div>
						<div class="select2">
						</div>
						<div class="select3">
						</div>
						<input type="hidden" name="user_id" value="{$admin.id}">
						<input type="hidden" name="province" id="province">
						<input type="hidden" name="city" id="city" value="1">
						<input type="hidden" name="area" id="area" value="0">
						<p class="text-right">
							<button type='button' class="btn btn-primary btn-create">
								<i class="fa fa-plus fa-fw"></i> 添加
							</button>
						</p>
					</form>
				</div>
			</div>
			{if $name}
			<div class="row m-t20">
				<div class="col-lg-6 col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading">
							{$user.name}&nbsp;已经添加的区域：
							<a type="button" class="btn btn-xs admin-delete btn-danger" data-toggle="modal" data-target="#passport-delete-confirm">
								<i class="fa fa-trash-o fa-fw"></i>
								<span>清空已添加的区域</span>
							</a>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
								<table id='passport-list' class="table">
									<thead>
									<tr>
										<th></th>
										<th>省</th>
										<th>市</th>
										<th>县/区</th>
									</tr>
									</thead>
									<tbody>
									{foreach from=$name key=i item=item}
									<tr>
										<td>{$i+1}</td>
										<td>{$item.provincename}</td>
										<td>{$item.cityname}</td>
										<td>{$item.countyname}</td>
										<td id="removeTd" data-cityId="{$item.id}">
											<a type="button" class="btn btn-xs admin-delete btn-danger" data-toggle="modal" data-target="#admin-delete-confirm">
												<i class="fa fa-trash-o fa-fw"></i>
												<span>删除</span>
											</a>
										</td>
									</tr>
									{/foreach}
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			{/if}
		</div>
<!--删除-->
		<div id='admin-delete-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">删除确认</h4>
					</div>
					<form class="modal-body">
						<p>确定要将城市删除吗?</p>
						<input type="hidden" name="id" class="admin-id">
						<p class="text-right">
							<button type="button" class="btn btn-primary">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>
		<!--清空所有分类-->
		<div id='passport-delete-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">清空 {$admin.name} 所有已经添加的区域</h4>
					</div>
					<form class="modal-body">
						<p>清空不可撤销，清空后只能重新添加</p>
						<input type="hidden" name="id" value="{$admin.id}">
						<p class="text-right">
							<button type="button" class="btn btn-primary">确认清空</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消清空</button>
						</p>
					</form>
				</div>
			</div>
		</div>
		<script type="text/html" id="select-2">
			<div class="form-group form-tags_2">
				<label for="tags_2" class="control-label">请选择市</label>
				<select class="form-control select2" id="sel">
					<option></option>
				</select>
			</div>
		</script>
		<script type="text/html" id="select-3">
			<div class="form-group form-tags_3">
				<label for="tags_3" class="control-label">请选择区/县</label>
				<select class="form-control select3 disabled" id="sel">
					<option value="1"></option>
				</select>
			</div>
		</script>
		<!--FileUpload-->
		<link rel="stylesheet" type="text/css" href="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_9e8ebab.css" />
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_bbeb1ca.js"></script>
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/operate/category/index_7070ffa.js"></script>
		{include file="radishadmin/widgets/footer/footer.tpl"}