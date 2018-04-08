{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
    {include file="radishadmin/widgets/nav/nav.tpl"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">编辑分类</h1>
            </div>
        </div>
        <div class="row">
            <form role="form" id='form-edit' method="post" data-type='1'>
                <!--上级分类默认是0-->
                <!--<input type="hidden" value="{$superior}" name="superior">-->
                <!--分类等级是一级分类-->
                <!--<input type="hidden" value="{$grade}" name="grade">-->
                <input type="hidden" value="{$id}" name="id">
                <input type="hidden" value="{$parent}" name="parent" id="parent">
                <div class="col-lg-6 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">编辑标签</div>
                        <div class="panel-body">
                            <div class="form-group form-id">
                                <label for="id" class="control-label">编号</label>
                                <input id='id' type="text" name='id' class="form-control" maxlength="30" value="{$id}">
                            </div>
                            <div class="form-group form-name">
                                <label for="name" class="control-label">标签名</label>
                                <input id='name' type="text" name='name' class="form-control" maxlength="30" value="{$name}">
                            </div>
                            <p class="text-right">
                                <button type='button' class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>编辑</button>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>

        <!--<link rel="stylesheet" type="text/css" href="/util/FileUpload/FileUpload.css" />-->
        <!--<script type="text/javascript" src="/util/FileUpload/FileUpload.js"></script>-->

        {include file="radishadmin/widgets/ue-js/ue-js.tpl"}

        <script src="//img.oranzh.cc/wiki/static/page/system/genreedit/edit_7ccd8b9.js"></script>


        {include file="radishadmin/widgets/footer/footer.tpl"}