{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header col-lg-12">
					二级分类列表
				</h1>
			</div>
		</div>
		<div class="row m-b20">
            <div class="col-lg-12">
                <a href="/radishadmin/category/list" type="button" class="btn btn-success">
									<i class="fa fa-reply-all fa-fw"></i>
									<span>返回单位列表</span>
                </a>
            </div>
        </div>
		{if $list}
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id='passport-list' class="table table-striped table-hover">
						<colgroup>
							<col>
								<col >
									<col>
										<col>
											<col>
						</colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>二级分类</th>
								<th>所在区域</th>
							  <th>操作</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}' data-name='{$item.name}' data-provincename='{$item.provincename}' data-cityname='{$item.cityname}' data-countyname='{$item.countyname}' data-province='{$item.province}' data-city='{$item.city}' data-area='{$item.area}'>
								<td>{$item.id}</td>
								<td>{$item.name}</td>
								<td>{if $item.provincename}{$item.provincename} {/if}{if $item.cityname}{$item.cityname} {/if}{if $item.countyname}{$item.countyname} {/if}</td>
								<td>
									<div class="btn-group">
                    <a type="button" class="btn btn-xs class-edit btn-primary" data-toggle="modal" data-target="#pay-metho-confirm">
											<i class="fa fa-edit fa-fw"></i>
											<span>编辑</span>
										</a>
									  <a type="button" class="btn btn-xs admin-delete btn-danger" data-toggle="modal" data-target="#passport-delete-confirm">
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
   
    <div id='passport-delete-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">删除二级分类</h4>
					</div>
					<form class="modal-body">
						<p>确定删除吗?</p>
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
					<form class="modal-body" onkeydown="if(event.keyCode==13)return false;">

						<div class="form-group form-name">
							<label for="name" class="control-label">编辑二级分类</label>
							<input id='name' type="text" name='name' class="form-control passport-name">
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
						
						<p class="help-block p1"></p>
					<p class="help-block">如果不选，则不修改所在区域。</p>

						<p class="text-right">
							<button type="button" class="btn btn-primary city-btn">确认</button>
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
		
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/category/detail/index_b1cdec3.js"></script>
		

		{include file="radishadmin/widgets/footer/footer.tpl"}