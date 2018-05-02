{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">单位类型</h1>
			</div>
		</div>
		<div class="row m-b20">
			<div class="col-lg-12">
				<a type="button" class="btn btn-success" data-toggle="modal" data-target="#pay-metho-confirm2">添加单位类型</a>
			</div>
		</div>
		{if $list}
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id='passport-list' class="table table-striped table-hover">
						<colgroup>
							<col>
								<col>
									<col>
										<col>
											<col>
						</colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>单位类型</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}' data-name='{$item.name}' data-prese="{$item.prese}">
								<td>{$item.id}</td>
								<td>{$item.name}</td>
								<td>
									<div class="btn-group">
										<!--<a type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#pay-metho-confirm3">-->
											<!--<i class="fa fa-plus fa-fw"></i>添加二级分类-->
										<!--</a>-->
										<!--<a type="button" href="/radishadmin/category/detail?id={$item.id}" class="btn btn-xs btn-info">-->
											<!--<i class="fa fa-share fa-fw"></i>查看二级分类-->
										<!--</a>-->
										<a type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#passport-delete-confirm">
											<i class="fa fa-trash-o fa-fw"></i>
											<span>删除</span>
										</a>
										<a type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#pay-metho-confirm">
											<i class="fa fa-edit fa-fw"></i>
											<span>编辑</span>
										</a>
										<a href='/radishadmin/category/orglist?unit={$item.id}' type="button" class="btn btn-xs btn-warning">
											<i class="fa fa-reply fa-fw"></i>
											<span>所有机构</span>
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
		<div id='passport-delete-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">删除确认</h4>
					</div>
					<form class="modal-body">
						<p>确定删除此单位类型吗?</p>
						<input type="hidden" name="id" class="passport-id">
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
					<form class="modal-body"  onkeydown="if(event.keyCode==13)return false;">
						<div class="form-group form-name1">
							<label for="name1" class="control-label">编辑单位类型：</label>
							<input id='name1' type="text" name='name1' class="form-control passport-name">
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

		<div id='pay-metho-confirm2' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<span>添加单位类型</span>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					</div>
					<form class="modal-body"  onkeydown="if(event.keyCode==13)return false;">
						<div class="form-group form-name">
							<label for="name" class="control-label">请输入单位类型名称：</label>
							<input id='name' type="text" name='name' class="form-control passport-name">
						</div>

						<p class="text-right">
							<button type="button" class="btn btn-primary">添加</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>

		<div id='pay-metho-confirm3' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					</div>
					<form class="modal-body"  onkeydown="if(event.keyCode==13)return false;">
						<div class="form-group form-name2">
							<label for='name2' class="control-label">请输入二级分类名称：</label>
							<input id='name2' type="text" name='name2' class="form-control passport-name">
						</div>
						<div class="form-group">
							<label for="tags_1" class="control-label">请选择省</label>
							<select class="form-control select1" autocomplete="off">
								<option value="" class="disabled" style="height:0px;display:none;"></option>
								{foreach from=$city key=i item=item}
								<option value="{$item.adcode}">{$item.name}</option>
								{/foreach}
							</select>
						</div>
						<div class="select2">

						</div>
						<div class="select3">

						</div>
						<input type="hidden" name="id" class="passport-id">
						<input type="hidden" name="province" id="province">
						<input type="hidden" name="city" id="city">
						<input type="hidden" name="area" id="area">

						<p class="text-right">
							<button type="button" class="btn btn-primary city-btn">添加</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
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
					<option></option>
				</select>
			</div>
		</script>

		<!--FormValid-->
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/category/list/index_8bf9b79.js"></script>



		{include file="radishadmin/widgets/footer/footer.tpl"}