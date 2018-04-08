{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
  {include file="radishadmin/widgets/nav/nav.tpl"}
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">机构详情</h1>
      </div>
    </div>

    <div class="row">
      <div id='trade-wrapper' class="col-lg-7 col-md-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            机构详情
          </div>
          <div class="panel-body">
            <div class="row clearfix">
              <div class="col-lg-12">
                <p>编号：
                  <span class="text-muted">{$list.id}</span></p>
              </div>
              <div class="col-lg-12">
                <p>账号：
                  <span class="text-muted">{$list.phone}</span>
                </p>
              </div>
              <div class="col-lg-12">
                <p>用户余额：
                  <span class="text-muted">{$list.banlance/100}</span>
                </p>
              </div>
              <div class="col-lg-12">
                <p>单位名称：
                  <span class="text-muted">{$list.org_name}</span></p>
              </div>
              <div class="col-lg-12">
                <p>单位类型：
                  <span class="text-muted">{$list.unit_name}</span></p>
              </div>
              <div class="col-lg-12">
                <p>单位联系电话：
                  <span class="text-muted">{$list.org_phone}</span>
                </p>
              </div>
              <div class="col-lg-12">
                <p>单位所在区域：
                  <span class="text-muted">{if $list.provincename}{$list.provincename} {/if}{if $list.cityname}{$list.cityname} {/if}{if $list.areaname}{$list.areaname} {/if}</span></p>
              </div>
              <div class="col-lg-12">
                <p>联系人：
                  <span class="text-muted">{$list.linkname}</span></p>
              </div>
              <div class="col-lg-12">
                <p>联系人电话：
                  <span class="text-muted">{$list.linkphone}</span></p>
              </div>
              <div class="col-lg-12">
                <p>单位地址：
                  <span class="text-muted">{$list.address}</span></p>
              </div>
              <div class="col-lg-12">
                <p>执照照片：
                  <span class="text-muted">
                  {if $list.img}
                  {foreach from=$list.img key=i item=item}
                  <a href="{$item.b}" target="_blank"><img src="{$item.s}" width="50px"></a>
                  {/foreach}
                  {else}
									无照片
                  {/if}
                  </span></p>
              </div>
              <div class="col-lg-12">
                <p>申请时间：
                  <span class="text-muted">{$list.create_time}</span></p>
              </div>
            </div>
          </div>
        </div>

        {include file="radishadmin/widgets/footer/footer.tpl"}
