{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
    {include file="radishadmin/widgets/nav/nav.tpl"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">抽成比例设置</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <form role="form" id='form-rate' method="post">
                 <input id='withdraw_quota' type="hidden" name='withdraw_quota' value="{$withdraw_quota}">
                   <h3 class="m-b20">打赏抽成比例设置</h3>
                    <div class="form-group form-reword_scale">
                        <label for="reword_scale" class="control-label">打赏抽成比例%</label>
                        <input id='reword_scale' type="text" name='reword_scale' class="form-control" autocomplete="off" placeholder="请输入打赏抽成比例数" value="{if $reword_scale >= 0}{$reword_scale}{/if}">
                    </div>
                    <h3 class="m-b20">提现抽成比例设置</h3>
                    <div class="form-group form-withdraw_scale">
                        <label for="withdraw_scale" class="control-label">提现抽成比例%</label>
                        <input id='withdraw_scale' type="text" name='withdraw_scale' class="form-control" autocomplete="off" placeholder="请输入提现抽成比例数" value="{if $withdraw_scale >= 0}{$withdraw_scale}{/if}">
                    </div>
                    
                    <p class="text-right">
                        <button type='button' class="btn btn-primary">
                            <i class="fa fa-plus fa-fw"></i> 添加
                        </button>
                    </p>
                </form>
            </div>
        </div>

        <script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>

        <script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/exist/ratepercent/index_43a8add.js"></script>

        {include file="radishadmin/widgets/footer/footer.tpl"}