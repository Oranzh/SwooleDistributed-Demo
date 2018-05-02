{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
  {include file="radishadmin/widgets/nav/nav.tpl"}
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">游戏详情</h1>
      </div>
    </div>

    <div class="row">
      <div id='trade-wrapper' class="col-lg-7 col-md-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            游戏详情
          </div>
          <div class="panel-body">
            <div class="row clearfix">
              <div class="col-lg-12">
                <p>编号：
                  <span class="text-muted">{$list.id}</span></p>
              </div>
              <div class="col-lg-12">
                <p>标题：
                  <span class="text-muted">{$list.title}</span></p>
              </div>
							 <div class="col-lg-12">
                <p>简介：
                  <span class="text-muted">{$list.short_desc}</span></p>
              </div>
              <div class="col-lg-12">
                <p>类型：
                  <span class="text-muted">{if $list.type==1}H5{elseif $list.type==2}下载链接{else}其他{/if}</span></p>
              </div>
							<div class="col-lg-12">
                <p>链接地址：
                  <span class="text-muted"><a href="{$list.url}">{$list.url}</a></span></p>
              </div>
              <div class="col-lg-12">
                <p>缩略图：
                  <span class="text-muted">
										<a href="{$list.avatar.b}" target="_blank"><img src="{$list.avatar.s}" width="50px;"></a>
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>

        {include file="radishadmin/widgets/footer/footer.tpl"}
