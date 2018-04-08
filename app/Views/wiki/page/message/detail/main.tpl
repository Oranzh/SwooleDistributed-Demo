{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
    {include file="radishadmin/widgets/nav/nav.tpl"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">信息详情</h1>
            </div>
        </div>

        <div class="row">
            <div id='trade-wrapper' class="col-lg-7 col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        信息详情
                    </div>
                    <div class="panel-body">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <p>编号：
                                    <span class="text-muted">{$list.id}</span></p>
                            </div>
                            <div class="col-lg-12">
                                <p>信息内容：
                                    <span class="text-muted">{$list.content}</span></p>
                            </div>
                            <div class="col-lg-12" style="vertical-align: top">
                                <p><span style="vertical-align: top">信息{if $list.images}图片{else}{if $list.video}视频{/if}{/if}：</span>
                                    <span class="text-muted">
                  	{if $list.images}
                  	{foreach from=$list.images key=i item=item}
					<a href="{$item.image.b}" target="_blank"><img src="{$item.image.s}" width="50px"></a>
                  	{/foreach}
					{else}
					{if $list.video}
					<video src="{$list.video}" controls="controls" class="videoMp4"></video>
					{/if}
                  	{/if}
                  </span></p>
                            </div>
                            <div class="col-lg-12">
                                <p>发布者账号：
                                    <span class="text-muted">{$list.user_phone}</span></p>
                            </div>
                            <div class="col-lg-12">
                                <p>发布者昵称：
                                    <span class="text-muted">{$list.user_name}</span></p>
                            </div>
                            <div class="col-lg-12">
                                <p>发布时间：
                                    <span class="text-muted">{$list.create_time}</span></p>
                            </div>
                            <div class="col-lg-12">
                                <p>联系人：
                                    <span class="text-muted">{$list.name}</span></p>
                            </div>
                            <div class="col-lg-12">
                                <p>联系人电话：
                                    <span class="text-muted">{$list.phone}</span></p>
                            </div>
                            <div class="col-lg-12">
                                <p>状态：
                                    <span class="text-muted">{if $list.status==0}未找到{elseif $list.status==11}已找到{/if}</span>
                                </p>
                            </div>
                            <div class="col-lg-12">
                                <p>场所：
                                    <span class="text-muted">{if $list.site_name}{$list.site_name}{else}无{/if}</span>
                                </p>
                            </div>
                            <div class="col-lg-12">
                                <p>类型：
                                    <span class="text-muted">{$list.g_name}</span></p>
                            </div>
                            <div class="col-lg-12">
                                <p>区域：
                                    <span class="text-muted">{if $list.provincename}{$list.provincename}{/if}{if $list.cityname}{$list.cityname}{/if}{if $list.areaname}{$list.areaname}{/if}</span>
                                </p>
                            </div>
                            <div class="col-lg-12">
                                <p>找到信息：
                                    <span class="text-muted">{if $list.remark}{$list.remark}{else}无{/if}</span></p>
                            </div>
                            <div class="col-lg-12">
                                <p>备注信息：
                                    <span class="text-muted">
                  {if $list.note}
                  	{foreach from=$list.note key=i item = item}
										{$i+1}： {$item.content}&nbsp;&nbsp;
                  	{/foreach}
                  {else}
                  	无
                  {/if}
                  </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {include file="radishadmin/widgets/footer/footer.tpl"}