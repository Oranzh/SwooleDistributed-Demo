{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">公告列表<a type="button" style="float:right;margin-right:20px;" class="btn btn-success excel">导出Excel</a></h1>

			</div>
		</div>
	   <div class="row">
			<div class="col-lg-12">
				<form class="form-inline" role="form">
					
				
<!-- 城市 -->


	<div class="form-group" id="select-1">
	<label for="tags_1" class="control-label">请选择省</label>
	<select class="form-control select1" name="" autocomplete="off">
		<option value="" class="disabled" style="height:0px;display:none;"></option>
	</select>
    </div>
<div class="select2" style="height:0px;display:inline;">

</div>
<div class="select3" style="height:0px;display:inline;">

</div>
<input type="hidden" name="parent_code" id="parent_code">
<input type="hidden" name="type" id="ptype">

<input type="hidden" name="province" id="province" value="{if $user && $user.province}{$user.province}{elseif $list && $list.province}{$list.province}{/if}">
<input type="hidden" name="city" id="city" value="{if $user && $user.city}{$user.city}{elseif $list && $list.city}{$list.city}{/if}">
<input type="hidden" name="area" id="area" value="{if $user && $user.area}{$user.area}{elseif $list && $list.area}{$list.area}{/if}">

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

<!--/城市 -->


					&nbsp;&nbsp;
					<div class="form-group">
						<label class="control-label">场所</label>
						<select class="form-control" name="site" id='siteOne'>
							<option value="" class="disabled" style="height:0px;display:none;"></option>
						{foreach from=$site key=i item=item}
							<option value="{$item.id}">{$item.name}</option>
							{/foreach}
						</select>
					</div>
						<div class="form-group">
							<label class="control-label">二级场所</label>
							<select class="form-control" name="site_two" id="siteTwo">
              					<option value="">请选择城市和场所</option>
            				</select>
						</div>
                   			&nbsp;&nbsp;
					{include file="radishadmin/widgets/filter/filter-time/filter-time.tpl"}
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
								<th>公告内容</th>
								<th>发布者(账号)</th>
								<th>发布机构名称</th>
								<th>发布时间</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}'>
								<td>{$item.id}</td>
								<td class="cnt">{$item.content|truncate:35:"...":true}</td>
								<td>{$item.phone}</td>
								<td>{$item.name}</td>
								<td>{$item.create_time}</td>
							<td>
									<div class="btn-group">
										<a href='/radishadmin/notice/info?id={$item.id}' type="button" class="btn btn-xs btn-info">
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
										<a href='/radishadmin/notice/comments?id={$item.id}' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-info fa-fw"></i>
											<span>评论</span>
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
						<p>确定要将该条公告信息从系统中删除么?</p>
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
							<label for="content" class="control-label">编辑公告内容：</label>
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
		
		<script type="text/ecmascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/notice/index/index_e191475.js"></script>




<link rel="stylesheet" type="text/css" href="//img.oranzh.cc/wiki/static/libs/select2-3.5.2/select2_01157dc.css" />
<link rel="stylesheet" type="text/css" href="//img.oranzh.cc/wiki/static/libs/select2-3.5.2/select2-bootstrap_7339ad7.css" />
<script type="text/javascript" src="//img.oranzh.cc/wiki/static/libs/select2-3.5.2/select2.min_cc8b63f.js"></script>
<script type="text/javascript" src="//img.oranzh.cc/wiki/static/libs/select2-3.5.2/select2_locale_zh-CN_b5834eb.js"></script>
<script src="//img.oranzh.cc/wiki/static/page/notice/index/city_9c82644.js"></script>
		<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=b253a2b2c53202149a1e6f1aa1e90a88&plugin=AMap.CitySearch"></script>
<!-- <script src="list.js"></script> -->
	

		{include file="radishadmin/widgets/footer/footer.tpl"}