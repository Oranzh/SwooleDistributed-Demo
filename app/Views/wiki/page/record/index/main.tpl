{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
    {include file="radishadmin/widgets/nav/nav.tpl"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">提现列表<a type="button" style="float:right;margin-right:20px;" class="btn btn-success excel">导出Excel</a></h1>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form class="form-inline" role="form">
                    {include file="radishadmin/widgets/filter/filter-time/filter-time.tpl"}
                    <div class="form-group" id="unit-1">
                        <label class="control-label">提现状态 ： </label>
                        <select class="form-control" name="status">
                            <option value="" class="disabled" style="height:0px;display:none;"></option>
                            <option value="1">提现成功</option>
                            <option value="2">提现失败</option>
                        </select>
                    </div>
                    &nbsp; &nbsp; &nbsp;
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
                            <th>提现金额</th>
                            <th>提现时间</th>
                            <th>提现用户</th>
                            <th>提现用户名</th>
                            <th>提现状态</th>
                            <th>平台抽成</th>
                            <th>平台抽成比例</th>
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
                            <td>{if $item.status == 1}提现成功{else if  $item.status == 2}提现失败{/if}</td>
                            <td>{$item.rate_money}</td>
                            <td>{$item.rate}</td>
                        </tr>
                        {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="//img.oranzh.cc/wiki/static/page/record/index/index1_6c4a75a.js"></script>
        {include file="radishadmin/widgets/page/page.tpl"} {else} 暂无数据 {/if}
        {include file="radishadmin/widgets/footer/footer.tpl"}