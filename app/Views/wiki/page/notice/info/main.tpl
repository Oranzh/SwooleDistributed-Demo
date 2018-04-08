{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
  {include file="radishadmin/widgets/nav/nav.tpl"}
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">公告详情</h1>
      </div>
    </div>

    <div class="row">
      <div id='trade-wrapper' class="col-lg-7 col-md-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            公告详情
          </div>
          <div class="panel-body">
            <div class="row clearfix">
              <div class="col-lg-12">
                <p>编号：
                  <span class="text-muted">{$list.id}</span></p>
              </div>
              <div class="col-lg-12">
                <p>公告内容：
                  <span class="text-muted">{$list.content}</span></p>
              </div>
              <div class="col-lg-12">
                <p>公告图片：
                  <span class="text-muted">
                    {if $list.images}
                    {foreach from=$list.images key=i item=item}
                    <a href="{$item.images.b}" target="_blank"><img src="{$item.images.s}" width="50px"></a>
                    {/foreach}
                    {/if}
                  </span></p>
              </div>
              <div class="col-lg-12">
                <p>发布者账号：
                  <span class="text-muted">{$list.phone}</span></p>
              </div>
              <div class="col-lg-12">
                <p>发布机构名称：
                  <span class="text-muted">{$list.name}</span></p>
              </div>
              <div class="col-lg-12">
                <p>发布时间：
                  <span class="text-muted">{$list.create_time}</span></p>
              </div>
            </div>
          </div>
        </div>

        {include file="radishadmin/widgets/footer/footer.tpl"}