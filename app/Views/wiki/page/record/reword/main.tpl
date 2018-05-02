{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
    {include file="radishadmin/widgets/nav/nav.tpl"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">赞赏列表<a type="button" style="float:right;margin-right:20px;" class="btn btn-success excel">导出Excel</a></h1>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form class="form-inline" role="form">
                    {include file="radishadmin/widgets/filter/filter-time/filter-time.tpl"}
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
                            <th>赞赏金币</th>
                            <th>赞赏时间</th>
                            <th>赞赏用户</th>
                            <th>赞赏用户名</th>
                            <th>被赞赏用户</th>
                            <th>被赞赏用户名</th>
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
                            <td>{$item.from_phone}</td>
                            <td>{$item.from_name}</td>
                            <td>{$item.to_phone}</td>
                            <td>{$item.to_name}</td>
                            <td>{$item.rate_money}</td>
                            <td>{$item.rate}</td>
                        </tr>
                        {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="//img.oranzh.cc/wiki/static/page/record/reword/index_9f28a30.js"></script>
        {include file="radishadmin/widgets/page/page.tpl"} {else} 暂无数据 {/if}
        {include file="radishadmin/widgets/footer/footer.tpl"}