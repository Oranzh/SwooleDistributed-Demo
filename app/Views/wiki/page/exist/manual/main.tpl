{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
    {include file="radishadmin/widgets/nav/nav.tpl"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">使用说明设置</h1>
                
            </div>
        </div>
         <div class="row">
            <form role="form" id='form-edit' method="post" data-type='1'>
                <input type="hidden" value="{$id}" name="id">
                <div class="col-lg-6 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">使用说明设置</div>
                        <div class="panel-content">
                            <div class="form-group form-editor">
                                <textarea id="editor" name="content">{$content}</textarea>
                            </div>
                            <p class="text-right">
                                <button type='button' class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>保存</button>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>

        <link rel="stylesheet" type="text/css" href="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_9e8ebab.css" />
        <script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_bbeb1ca.js"></script>

        {include file="radishadmin/widgets/ue-js/ue-js.tpl"}

        <script src="//img.oranzh.cc/wiki/static/page/exist/manual/index_0835307.js"></script>

        {include file="radishadmin/widgets/footer/footer.tpl"}