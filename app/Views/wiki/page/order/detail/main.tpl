{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
  {include file="radishadmin/widgets/nav/nav.tpl"}
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">订单详情</h1>
      </div>
    </div>

    <div class="row">
      <div id='trade-wrapper' class="col-lg-7 col-md-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            订单详情
          </div>
          <div class="panel-body">
            <div class="row clearfix">
              <div class="col-lg-12">
                <p>编号：
                  <span class="text-muted">{$list.id}</span></p>
              </div>
              <div class="col-lg-12">
                <p>创建时间：
                  <span class="text-muted">{$list.create_time}</span></p>
              </div>
              <div class="col-lg-12">
                <p>用户账号：
                  <span class="text-muted">{$list.phone}</span></p>
              </div>
							 <div class="col-lg-12">
                <p>用户名：
                  <span class="text-muted">{$list.name}</span></p>
              </div>
              <div class="col-lg-12">
                <p>订单编号：
                  <span class="text-muted">{$list.order_id}</span></p>
              </div>
              <div class="col-lg-12">
                <p>订单金额：
                  <span class="text-muted">{$list.money}</span></p>
              </div>
              <div class="col-lg-12">
                <p>商品名称：
                  <span class="text-muted">{if $list.type==1}手机话费{elseif $list.type==2}流量{elseif $list.type==3}固话{elseif $list.type==4}火车票{elseif $list.type==5}机票{else}其他{/if}</span></p>
              </div>
              {if $list.type==4}
              <div class="col-lg-12">
                <p>出发位置：
                  <span class="text-muted">{$list.from_station_name}</span></p>
              </div>
              <div class="col-lg-12">
                <p>车次：
                  <span class="text-muted">{$list.checi}</span></p>
              </div>
              {elseif $list.type==5}
              <div class="col-lg-12">
                <p>出发位置：
                  <span class="text-muted">{$list.airport_name}</span></p>
              </div>
              <div class="col-lg-12">
                <p>航班号：
                  <span class="text-muted">{$list.flightNum}</span></p>
              </div>
              {/if}
              <div class="col-lg-12">
                <p>订单状态：
                  <span class="text-muted">{if $list.status==1}支付中{elseif $list.status==2}支付中{elseif $list.status==9}订单取消{elseif $list.status==10}已退款{elseif $list.status==20}支付成功{else}其他{/if}</span></p>
              </div>
              <div class="col-lg-12">
                <p>价格：
                  <span class="text-muted">{$list.price}</span></p>
              </div>
              {if $list.ticketnumber}
              <div class="col-lg-12">
                <p>取票号：
                  <span class="text-muted">{$list.ticketnumber}</span></p>
              </div>
              {/if}
            </div>
          </div>
        </div>

        {include file="radishadmin/widgets/footer/footer.tpl"}
