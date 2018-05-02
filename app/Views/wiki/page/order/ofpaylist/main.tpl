{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">话费订单列表</h1>
				
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form class="form-inline" role="form">
					{include file="radishadmin/widgets/filter/filter-time/filter-time.tpl"}
					
					<div class="form-group">
						<label class="control-label">订单状态</label>
						<select class="form-control" name="status">
							<option value="" class="disabled" style="height:0px;display:none;"></option>
							<option value="2">支付中</option>
							<option value="9">订单取消</option>
							<option value="10">已退款</option>
							<option value="20">支付成功</option>
						</select>
					</div>
					&nbsp;&nbsp;
					<a type="button" class="btn btn-sm btn-warning filter_btn">筛选</a>
				</form>
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
								<th>创建时间</th>
								<th>用户账号</th>
								<th>用户名</th>
								<th>订单编号</th>
								<th>订单金额</th>
								<th>商品名称</th>
								<th>订单状态</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$list key=i item=item}
							<tr data-id='{$item.id}'>
								<td>{$item.id}</td>
								<td>{$item.create_time}</td>
								<td>{$item.phone}</td>
								<td>{$item.name}</td>
								<td>{$item.order_id}</td>
								<td>{$item.money}</td>
								<td>{if $item.type==1}手机话费{elseif $item.type==2}流量{elseif $item.type==3}固话{else}其它{/if}</td>
								<td>{if $item.status==1}支付中{elseif $item.status==2}支付中{elseif $item.status==9}订单取消{elseif $item.status==10}已退款{elseif $item.status==20}支付成功{else}其他{/if}</td>
								<td>
									<div class="btn-group">
										<a href='/radishadmin/order/detail?id={$item.id}' type="button" class="btn btn-xs btn-info">
											<i class="fa fa-share fa-fw"></i>
											<span>查看</span>
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

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/order/ofpaylist/index_15e5168.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}