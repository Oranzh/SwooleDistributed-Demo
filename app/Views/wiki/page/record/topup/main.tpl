{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
    {include file="radishadmin/widgets/nav/nav.tpl"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">充值列表<a type="button" style="float:right;margin-right:20px;" class="btn btn-success excel">导出Excel</a></h1>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form class="form-inline" role="form">
                    {include file="radishadmin/widgets/filter/filter-time/filter-time.tpl"}
                    <div class="form-group" id="unit-1">
                        <label class="control-label">订单状态 ： </label>
                        <select class="form-control" name="status">
                            <option value="" class="disabled" style="height:0px;display:none;"></option>
                            <option value="1">充值成功</option>
                            <option value="2">充值失败</option>
                        </select>
                    </div>
                    &nbsp; &nbsp; &nbsp;
                    <!--<a type="button" class="btn btn-sm btn-warning filter_btn">筛选</a>-->
                    <button type="submit" class="filter_btn btn_filter2">筛选</button>
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
                            <col>
                        </colgroup>
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>充值金额</th>
                            <th>充值时间</th>
                            <th>充值用户</th>
                            <th>充值用户名</th>
                            <th>订单状态</th>
                            <th>充值途径</th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach from=$list key=i item=item}
                        <tr data-id='{$item.id}'>
                            <td>{$item.id}</td>
                            <td>{$item.price}</td>
                            <td>{$item.create_time}</td>
                            <td>{$item.to_phone}</td>
                            <td>{$item.to_name}</td>
                            <td>{if $item.status =='1'}充值成功{else if $item.status =='2'}充值失败{/if}</td>
                            <td>{if $item.pay =='1'}支付宝充值{else if $item.pay =='2'}微信充值{else}银联充值{/if}</td>
                        </tr>
                        {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="//img.oranzh.cc/wiki/static/page/record/topup/topup_29fd198.js"></script>
        {include file="radishadmin/widgets/page/page.tpl"} {else} 暂无数据 {/if}
        {include file="radishadmin/widgets/footer/footer.tpl"}