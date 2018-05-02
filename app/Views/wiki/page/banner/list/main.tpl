{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header col-lg-12">
					Banner图列表
				</h1>
			</div>
		</div>
		<div class="row m-b20">
			<div class="col-lg-12">
				<a href="/radishadmin/banner/index" type="button" class="btn btn-success">添加轮播图</a>
			</div>
		</div>
		{if $list}
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table id='passport-list' class="table table-striped table-hover">
						<thead>
							<tr>
								<th>编号</th>
               					 <th>名称</th>
               					 <th>时间</th>
               					 <th>类型</th>
               					 <th>缩略图</th>
              					  <th>区域</th>
               					 <th>链接地址</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}' data-status='{$item.status}'>
								<td>{$item.id}</td>
								<td>{$item.name}</td>
								<td>{$item.start_time}~{$item.end_time}</td>
								<td>{if $item.type == 1}限时{else}不限时{/if}</td>
                				<td><img src="{$item.images.s}" width="32px"></td>
								<td>{if $item.provincename}{$item.provincename} {/if}{if $item.cityname}{$item.cityname} {/if}{if $item.areaname}{$item.areaname} {/if}</td>
								<td><a href="{$item.link}">{$item.link}</a></td>
								<td>
									<div class="btn-group">
										<a href='/radishadmin/banner/detail?id={$item.id}' type="button" class="btn btn-xs class-reply btn-info">
											<i class="fa fa-reply-all fa-fw"></i>
											<span>查看</span>
										</a>
										<a type="button" class="btn btn-xs admin-delete btn-danger" data-toggle="modal" data-target="#passport-delete-confirm">
											<i class="fa fa-trash-o fa-fw"></i>
											<span>删除</span>
										</a>
										<a href='/radishadmin/banner/edit?id={$item.id}' type="button" class="btn btn-xs class-edit btn-primary">
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

    <!--删除Banner-->
		<div id='passport-delete-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">删除Banner</h4>
					</div>
					<form class="modal-body">
						<p>确定删除这条轮播图吗?</p>
						<input type="hidden" name="id" class="passport-id">
						<input type="hidden" name="status" class="passport-status" value="99">
						
						<p class="text-right">
							<button type="button" class="btn btn-primary">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>
   
    
    <!--FormValid-->
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>
   
   
    <script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/banner/list/index_b0ada36.js"></script>
    

		{include file="radishadmin/widgets/footer/footer.tpl"}