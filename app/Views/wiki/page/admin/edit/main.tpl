{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
  {include file="radishadmin/widgets/nav/nav.tpl"}
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">编辑管理员</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5 col-md-12">
        <form role="form" id='form-edit' method="post">
          <input type="hidden" value="{$id}" name="id">
          <div class="form-group form-tel">
            <label for="tel" class="control-label">电话</label>
            <input id='tel' type="text" name='tel' class="form-control" maxlength="11" value="{$tel}">
          </div>
          <div class="form-group form-pw">
            <label for="pw" class="control-label">密码</label>
            <input id='pw' type="pw" name='pw' class="form-control">
            <p class="help-block">如果留空，则不修改密码。</p>
          </div>
          <div class="form-group form-name">
            <label for="name" class="control-label">姓名</label>
            <input id='name' type="text" name='name' class="form-control" maxlength="16" value="{$name}">
          </div>
           <p class="text-right">
            <button type='button' class="btn btn-primary">
              <i class="fa fa-edit fa-fw"></i> 保存
            </button>
          </p>
        </form>
      </div>
    </div>

    <script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>

    <script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/admin/edit/index_99ddabd.js"></script>

    {include file="radishadmin/widgets/footer/footer.tpl"}