{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">机构列表<a type="button" style="float:right;margin-right:20px;" class="btn btn-success excel">导出Excel</a></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form class="form-inline" role="form">
					{include file="radishadmin/widgets/filter/filter-time/filter-time.tpl"}
					{include file="radishadmin/widgets/filter/filter-unit/filter-unit.tpl"}
					{include file="radishadmin/widgets/filter/filter-city/filter-city.tpl"}
					<a type="button" class="btn btn-sm btn-warning filter_btn">筛选</a>
				</form>
			</div>
		</div>
		<hr>
		<div class="row m-b20">
			<div class="col-lg-12">
				<a href="/radishadmin/organization/apply" type="button" class="btn btn-success">查看机构认证申请</a>&nbsp;&nbsp;
				<a href="/radishadmin/organization/create" type="button" class="btn btn-success">添加机构</a>
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
								<th>机构账号</th>
								<th>机构名称</th>
								<th>单位类型</th>
								<th>用户余额</th>
								<th>所在区域</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}' data-notice_count='{$item.notice_count}' data-privilege="{$item.privilege}">
								<td>{$item.id}</td>
								<td>{$item.phone}</td>
								<td>{$item.org_name}</td>
								<td>{$item.unit_name}</td>
								<td>{$item.banlance/100}</td>
								<td>{if $item.provincename}{$item.provincename} {/if}{if $item.cityname}{$item.cityname} {/if}{if $item.countyname}{$item.countyname} {/if}
								</td>
								<td>
									<div class="btn-group">
										<a href='/radishadmin/organization/detail?id={$item.id}' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-share fa-fw"></i>
											<span>查看</span>
										</a>
										{if $session.role == 0}
										<a type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#user-delete-confirm">
											<i class="fa fa-trash-o fa-fw"></i>
											<span>删除</span>
										</a>
										{/if}
										<a href='/radishadmin/organization/edit?id={$item.id}' type="button" class="btn btn-xs btn-primary">
											<i class="fa fa-edit fa-fw"></i>
											<span>编辑</span>
										</a>
										<a href='/radishadmin/record/topup?passid={$item.id}' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-share fa-fw"></i>
											<span>充值明细</span>
										</a>
										<a href='/radishadmin/record/reword?passid={$item.id}' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-share fa-fw"></i>
											<span>赞赏明细</span>
										</a>
										{if $item.status==1}
										<a type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#user-delete-confirm1">
											<span>加入黑名单</span>
										</a>
										{else}
										<a type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#user-delete-confirm2">
											<span>解除黑名单</span>
										</a>
										{/if}
                                         <a href='/radishadmin/user/messagelist?id={$item.id}' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-info fa-fw"></i>
											<span>发布的信息</span>
										</a>
										{if $session.role == 0}
									<a href='/radishadmin/user/ratecash?passid={$item.id}' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-share fa-fw"></i>
											<span>抽成比例</span>
										</a>
										 <a data-toggle="modal" data-target="#message-edit-confirm" type="button" class="btn btn-xs btn-primary">
                                      <i class="fa fa-edit fa-fw"></i>
                                      <span>设置超级用户权限</span>
                                        </a>
										{/if}
                                       	<a data-toggle="modal" data-target="#message-noticecount-confirm" type="button" class="btn btn-xs btn-primary">
											<i class="fa fa-edit fa-fw"></i>
											<span>最多发布公告数</span>
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
		{include file="radishadmin/widgets/page/page.tpl"} 
    {else} 
    暂无数据 
    {/if}

		<div id='user-delete-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">删除确认</h4>
					</div>
					<form class="modal-body">
						<p>确定要将该机构从系统中删除么?</p>
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
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">加入黑名单确认</h4>
					</div>
					<form class="modal-body">
						<p>确定要将该用户加入黑名单吗?</p>
						<input type="hidden" name="id" class="admin-id">
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
						<input type="hidden" name="id" class="admin-id">
						<input type="hidden" name="status" value="1">
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
              <label for="content" class="control-label">图片权限设置：</label>
             <!--  <textarea id='content' type="text" name='content' class="form-control" maxlength="500" rows="5"></textarea> -->
             <br>
             <label><input name="privilege" type="radio"  class="onPrivilege"
             	value="1" />允许查看图片 </label> &nbsp;&nbsp;
             <label><input name="privilege" class="offPrivilege" type="radio"
             	value="0" />不允许查看图片 </label> 
            </div>
            <input type="hidden" name="passid" class="admin-id">

            <p class="text-right">
              <button type="button" class="btn btn-primary">确认</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </p>
          </form>
        </div>
      </div>
    </div>
      
  <div id='message-noticecount-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					</div>
					<form class="modal-body">
						<div class="form-group form-content">
							<label for="content" class="control-label">请输入当天最多公告数：</label>
							<textarea id='notice_count' type="number" name='notice_count' class="form-control" maxlength="200" rows="2">{$item.notice_count}</textarea>
						</div>
						 <input type="hidden" name="passid" class="admin-id"> 

						<p class="text-right">
							<button type="button" class="btn btn-primary">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>


        <script type="text/ecmascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/organization/list/index_d681924.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}