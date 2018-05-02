{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">编辑机构</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-5 col-md-12">
				<form role="form" id='form-create' method="post">
					<div class="form-group form-tel">
						<label for="tel" class="control-label">单位账号</label>
						<input id='tel' type="text" name='tel' class="form-control" maxlength="11" autocomplete="off" value="{$user.phone}">
					</div>
					<div class="form-group form-pw">
						<label for="pw" class="control-label">单位密码</label>
						<input id='pw' type="text" name='pw' class="form-control" autocomplete="off">
						<p class="help-block">如果留空，则不修改密码。</p>
					</div>
					<div class="form-group form-name">
						<label for="name" class="control-label">单位名称</label>
						<input id='name' type="text" name='name' class="form-control" value="{$user.org_name}">
					</div>
					<div class="form-group form-phone">
						<label for="phone" class="control-label">单位联系方式</label>
						<input id='phone' type="text" name='phone' class="form-control" value="{$user.org_phone}">
					</div>

					<!--城市-->
					<div class="form-group" id="select-1">
						<label for="tags_1" class="control-label">请选择省</label>
						<select class="form-control select1" name="" autocomplete="off">
							<option value="" class="disabled" style="height:0px;display:none;"></option>
						</select>
					</div>
					<div class="select2">
						<div class="form-group" style="display: none">
							<label class="control-label">选择场所 <span style="color:#e4393c;font-size:12px;">没有选择区县，则此选项不可选</span></label>
							<select class="form-control unit1" name="site" id="siteOne">
								<!--<option value="" class="disabled" style="height:0px;display:none;"></option>-->
								{foreach from=$site key=i item=item}
								<option value="{$item.id}" {if $user.site == $item.id}selected{/if}>{$item.name}</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="select3">

					</div>
					<input type="hidden" name="parent_code" id="parent_code">
					<input type="hidden" name="type" id="ptype">

					<input type="hidden" name="province" id="province" value="{if $user && $user.province}{$user.province}{elseif $list && $list.province}{$list.province}{/if}">
					<input type="hidden" name="city" id="city" value="{if $user && $user.city}{$user.city}{elseif $list && $list.city}{$list.city}{/if}">
					<input type="hidden" name="area" id="area" value="{if $user && $user.area}{$user.area}{elseif $list && $list.area}{$list.area}{/if}">

					<script type="text/html" id="select-2">
						<div class="form-group form-tags_2">
							<label for="tags_2" class="control-label">请选择市</label>
							<select class="form-control select2" id="sel">
								<option></option>
							</select>
						</div>
					</script>

					<script type="text/html" id="select-3">
						<div class="form-group form-tags_3">
							<label for="tags_3" class="control-label">请选择区/县</label>
							<select class="form-control select3 disabled" id="sel">
								<option></option>
							</select>
						</div>
					</script>
					<!--城市/-->
					
					<p class="help-block">所在区域为  {if $user.provincename}{$user.provincename}{/if} {if $user.cityname}{$user.cityname}{/if} {if $user.areaname}{$user.areaname}{/if}。</p>
					<p class="help-block">如果不选，则不修改所在区域。</p>
					<!--111-->
					<!--一二级-->
					<div class="form-group" id="unit-1">
						<label class="control-label">选择场所 <span style="color:#e4393c;font-size:12px;">没有选择区县，则此选项不可选</span></label>
						<select class="form-control unit1" name="site" id="siteOne">
							<!--<option value="" class="disabled" style="height:0px;display:none;"></option>-->
							{foreach from=$site key=i item=item}
							<option value="{$item.id}" {if $user.site == $item.id}selected{/if}>{$item.name}</option>
							{/foreach}
						</select>
					</div>
					<div class="form-group">
						<label class="control-label">选择二级场所</label>
						<select class="form-control" name="site_two" id="siteTwo">
							<option value="">选择二级场所</option>
						</select>
					</div>
					<!--<div id="unit2">-->
					<!--<div class="form-group">-->
					<!--<label class="control-label">选择二级单位类型</label>-->
					<!--<select class="form-control unit2">-->
					<!--<option></option>-->
					<!--</select>-->
					<!--</div>-->
					<!--</div>-->
					<input type="hidden"  id="unit" value="{if $user.unit}{$user.unit}{/if}">
					<input type="hidden"  id="unit_two" value="{if $user.unit_two}{$user.unit_two}{else}0{/if}">
					<!--111-->
					
					<p class="help-block">所在单位为  {if $user.unit_name}{$user.unit_name} {/if}{if $user.unit_name1}{$user.unit_name1} {/if}。</p>
					<p class="help-block">如果不选，则不修改所在单位。</p>
					
					
					<div class="form-group form-address">
						<label for="address" class="control-label">单位地址</label>
						<input id='address' type="text" name='address' class="form-control" value="{$user.address}">
					</div>
					<div class="telText">
						以下内容仅限内部联系使用
					</div>
					<div class="form-group form-linkname">
						<label for="linkname" class="control-label">单位联系人名字</label>
						<input id='linkname' type="text" name='linkname' class="form-control"  value="{$user.linkname}">
					</div>
					<div class="form-group form-linkphone">
						<label for="linkphone" class="control-label">单位联系人方式</label>
						<input id='linkphone' type="text" name='linkphone' class="form-control" value="{$user.linkphone}" maxlength="18">
					</div>
					
					<div class="form-group">
							<div id='lunbo' class="panel panel-default">
								<div class="panel-heading">添加执照照片</div>
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
									<p class="help-block">必须上传<code>2</code>张图片，请确认每张图片小于<code>2MB</code>,图片超过2MB上传文件将会导致系统卡顿。您也可以将需要上传的图片拖动到此处。</p>
								</div>
							</div>
						</div>
					
					<input type="hidden" name="id" value="{$user.id}">
					<p class="text-right">
						<button type='button' class="btn btn-primary">
							<i class="fa fa-edit fa-fw"></i> 编辑
						</button>
					</p>
				</form>
			</div>
		</div>
		
		<script type="text/html" id="images">
			{if $user.img}{$user.img['img1']['s']},{$user.img['img1']['m']},{$user.img['img1']['b']},{$user.img['img2']['s']},{$user.img['img2']['m']},{$user.img['img2']['b']},{/if}
		</script>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>
		<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=b253a2b2c53202149a1e6f1aa1e90a88&plugin=AMap.CitySearch"></script>
		<!--FileUpload-->
		<link rel="stylesheet" type="text/css" href="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_9e8ebab.css" />
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FileUpload/FileUpload_bbeb1ca.js"></script>
		<script src="//img.oranzh.cc/wiki/static/page/organization/edit/city_8c176a4.js"></script>
		<!--<script type="text/javascript" src="/widgets/city/city.js"></script>-->
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/widgets/unit/unit_4776f54.js"></script>
		
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/organization/edit/index_003fc95.js"></script>

		{include file="radishadmin/widgets/footer/footer.tpl"}