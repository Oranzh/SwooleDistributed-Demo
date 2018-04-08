{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
    {include file="radishadmin/widgets/nav/nav.tpl"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">票务话费管理</h1>
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <form role="form" id='form-rate' method="post">
                   <h3 class="m-b20">火车票费率</h3>
                    <div class="form-group form-ofpay_quota">
                        <label for="ofpay_quota" class="control-label">定额费率</label>
                        <input id='ofpay_quota' type="text" name='ofpay_quota' class="form-control" autocomplete="off" placeholder="请输入非负浮点数" value="{if $ofpay_quota >= 0}{$ofpay_quota}{/if}">
                    </div>
                    <div class="form-group form-ofpay_scale">
                        <label for="ofpay_scale" class="control-label">比例费率</label>
                        <input id='ofpay_scale' type="text" name='ofpay_scale' class="form-control" autocomplete="off" placeholder="请输入非负浮点数" value="{if $ofpay_scale >= 0}{$ofpay_scale}{/if}">
                    </div>
                    <div class="form-group form-train_scale2">
                        <label for="ofpay_scale" class="control-label">最后支付费率</label>
                        <input id='train_scale2' type="text" name='train_scale2' class="form-control" autocomplete="off" placeholder="请输入非负浮点数" value="{if $train_scale2 >= 0}{$train_scale2}{/if}">
                    </div>
                    <h3 class="m-b20">机票费率</h3>
                    <div class="form-group form-train_quota">
                        <label for="train_quota" class="control-label">定额费率</label>
                        <input id='train_quota' type="text" name='train_quota' class="form-control" autocomplete="off" placeholder="请输入非负浮点数" value="{if $train_quota >= 0}{$train_quota}{/if}">
                    </div>
                    <div class="form-group form-train_scale">
                        <label for="train_scale" class="control-label">比例费率</label>
                        <input id='train_scale' type="text" name='train_scale' class="form-control" autocomplete="off" placeholder="请输入非负浮点数" value="{if $train_scale >= 0}{$train_scale}{/if}">
                    </div>
                    <div class="form-group form-air_scale2">
                        <label for="ofpay_scale" class="control-label">最后支付费率</label>
                        <input id='air_scale2' type="text" name='air_scale2' class="form-control" autocomplete="off" placeholder="请输入非负浮点数" value="{if $air_scale2 >= 0}{$air_scale2}{/if}">
                    </div>
                    <h3 class="m-b20">话费费率</h3>
                    <div class="form-group form-airport_quota">
                        <label for="airport_quota" class="control-label">定额费率</label>
                        <input id='airport_quota' type="text" name='airport_quota' class="form-control" autocomplete="off" placeholder="请输入非负浮点数" value="{if $airport_quota >= 0}{$airport_quota}{/if}">
                    </div>
                    <div class="form-group form-airport_scale">
                        <label for="airport_scale" class="control-label">比例费率</label>
                        <input id='airport_scale' type="text" name='airport_scale' class="form-control" autocomplete="off" placeholder="请输入非负浮点数" value="{if $airport_scale >= 0}{$airport_scale}{/if}">
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

        <script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/exist/ratecreate/index_f544e74.js"></script>
</div>
    </div>
        {include file="radishadmin/widgets/footer/footer.tpl"}