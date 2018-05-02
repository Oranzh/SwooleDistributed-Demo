{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
    {include file="radishadmin/widgets/nav/nav.tpl"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">添加管理员</h1>
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <form role="form" id='form-create' method="post">
                    <div class="form-group form-tel">
                        <label for="tel" class="control-label">电话</label>
                        <input id='tel' type="text" name='tel' class="form-control" maxlength="11" autocomplete="off">
                    </div>
                    <div class="form-group form-pw">
                        <label for="pw" class="control-label">密码</label>
                        <input id='pw' type="password" name='pw' class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group form-name">
                        <label for="name" class="control-label">姓名</label>
                        <input id='name' type="text" name='name' class="form-control">
                    </div>
                    <div class="form-group form-role">
                        <label for="role" class="control-label">类型</label>
                        <select class="form-control" name="role">
                            <option value="0">超级管理员</option>
                            <option value="1" selected>普通管理员</option>
                        </select>
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

        <script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/admin/create/index_dd1c04d.js"></script>

        {include file="radishadmin/widgets/footer/footer.tpl"}