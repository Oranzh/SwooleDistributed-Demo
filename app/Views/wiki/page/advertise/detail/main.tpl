{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
    {include file="radishadmin/widgets/nav/nav.tpl"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">广告图详情</h1>
            </div>
        </div>

        <div class="row">
            <div id='trade-wrapper' class="col-lg-7 col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        广告图详情
                    </div>
                    <div class="panel-body">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <p>编号：
                                    <span class="text-muted">{$list.id}</span></p>
                            </div>
                            <div class="col-lg-12">
                                <p>名称：
                                    <span class="text-muted">{$list.name}</span></p>
                            </div>
                            <div class="col-lg-12">
                                <p>缩略图：
                                    <a href="{$list.images.b}" target="_blank"><img src="{$list.images.s}"
                                                                                    style="width:50px"></a>
                            </div>
                            <div class="col-lg-12">
                                <p>链接地址：
                                    <span class="text-muted"><a href="{$list.link}"
                                                                target="_blank">{$list.link}</a></span></p>
                            </div>
                        </div>
                    </div>
                </div>

                {include file="radishadmin/widgets/footer/footer.tpl"}
