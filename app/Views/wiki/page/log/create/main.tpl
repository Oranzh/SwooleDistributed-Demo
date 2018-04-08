{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
    {include file="radishadmin/widgets/nav/nav.tpl"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">添加操作日志</h1>
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <form role="form" id='form-log' onkeydown="if(event.keyCode==13)return false;">
                    <div class="form-group form-content">
                        <label for="content" class="control-label">填写日志信息</label>
                        <input id='content' type="text" name='content' class="form-control">
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

        <script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/log/create/index_3c8c653.js"></script>

        {include file="radishadmin/widgets/footer/footer.tpl"}