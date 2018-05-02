{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
  {include file="radishadmin/widgets/nav/nav.tpl"}
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">评论详情</h1>
      </div>
    </div>

    <div class="row">
      <div id='trade-wrapper' class="col-lg-7 col-md-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            评论详情
          </div>
          <div class="panel-body">
            <div class="row clearfix">
              <div class="col-lg-12">
                <p>编号：
                  <span class="text-muted">{$list.id}</span></p>
              </div>
              <div class="col-lg-12">
                <p>评论内容：
                  <span class="text-muted">{$list.content}</span></p>
              </div>
              <div class="col-lg-12">
                <p>评论图片：
                  <span class="text-muted">
                  	{if $list.images}
                  	{foreach from=$list.images key=i item=item}
<!--										<img src="{$item[0]}">-->
                  	{/foreach}
                  	{/if}
                  </span></p>
              </div>
              <div class="col-lg-12">
                <p>评论者账号：
                  <span class="text-muted">{$list.phone}</span></p>
              </div>
               <div class="col-lg-12">
                <p>评论者昵称：
                  <span class="text-muted">{$list.name}</span></p>
              </div>
              <div class="col-lg-12">
                <p>发布时间：
                  <span class="text-muted">{$list.create_time}</span></p>
              </div>
              <div class="col-lg-12">
                <p>状态：
                  <span class="text-muted">{if $list.status==0}未找到{elseif $list.status==11}已找到{/if}</span></p>
              </div>
              <div class="col-lg-12">
                <p>类型：
                  <span class="text-muted">{$list.type}类型</span></p>
              </div>
              <div class="col-lg-12">
                <p>区域：
                  <span class="text-muted">{if $list.provincename}{$list.provincename}{/if}{if $list.cityname}{$list.cityname}{/if}{if $list.areaname}{$list.areaname}{/if}</span></p>
              </div>
              <div class="col-lg-12">
                <p>备注信息：
                  <span class="text-muted">{$list.remark}</span></p>
              </div>
            </div>
          </div>
        </div>

        {include file="radishadmin/widgets/footer/footer.tpl"}
