{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">编辑场所</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<form role="form" id='form-create' onkeydown="if(event.keyCode==13)return false;" autocomplete="off">
					<div class="form-group form-name">
						<label for="name" class="control-label">场所名字</label>
						<input id='name' type="text" name='name' class="form-control" value="{$name}">
					</div>
         <input type="hidden" name='id' value="{$id}">
          <div id='lunbo' class="panel panel-default">
              <div class="panel-heading">
                  场所头像
              </div>
              <div class="panel-body">
                  <div class="table-responsive">
                      <p class="add-file">
                          <span class="btn btn-success fileinput-button">
                              <i class="fa fa-plus fa-fw"></i>
                              <span>添加并上传</span>
                              <input type="file" multiple accept="image/*">
                          </span>
                      </p>
                      <table class="table table-striped table-hover table-file-upload">
                          <tr>
                              <th>预览</th>
                              <th>状态</th>
                              <th></th>
                          </tr>
                      </table>
                  </div>
                   <p class="help-block">最多上传<code>1</code>张图片，请确认每张图片小于<code>2MB</code>,图片超过2MB上传文件将会导致系统卡顿。您也可以将需要上传的图片拖动到此处。</p>
              </div>
          </div>
           
					<p class="text-right">
						<button type='button' class="btn btn-primary">
							<i class="fa fa-edit fa-fw"></i> 编辑
						</button>
					</p>
				</form>
			</div>
		</div>
   
   <script type="text/html" id="avatar">
      {$avatar.s},{$avatar.m},{$avatar.b}
		</script>
   
    <!--FormValid-->
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>
   
    <!--FileUpload-->
		<link rel="stylesheet" type="text/css" href="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_9e8ebab.css" />
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_bbeb1ca.js"></script>
		
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/system/siteedit/index_c9c372c.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}