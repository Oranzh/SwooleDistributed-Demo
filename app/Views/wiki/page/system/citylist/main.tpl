{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
    {include file="radishadmin/widgets/nav/nav.tpl"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">区县设置</h1>
            </div>
        </div>
        <div class="row m-b20">
            <div class="col-lg-12">
                <a href="/radishadmin/system/citycreate" type="button" class="btn btn-success">添加区县</a>
            </div>
        </div>
        {if $list}
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id='admin-list' class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>市级单位</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach from=$list key=i item=item}
                        <tr data-id='{$item.id}'>
                            <td>{$item.id}</td>
                            <td>{$item.name}</td>
                            <td>
                                <div class="btn-group">
                                    <a type="button" class="btn btn-xs admin-delete btn-danger" data-toggle="modal" data-target="#admin-delete-confirm">
                                        <i class="fa fa-trash-o fa-fw"></i>
                                        <span>删除</span>
                                    </a>
                                    <a href='/radishadmin/system/citydetail?id={$item.id}' type="button" class="btn btn-xs class-edit btn-primary">
                                        <span>查看下级区县</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {include file="radishadmin/widgets/page/page.tpl"}
        {else}
        暂无数据
        {/if}

        <div id='admin-delete-confirm' aria-hidden="false" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">删除确认</h4>
                    </div>
                    <form class="modal-body">
                        <p>确定要将该市 ( 包括下级的所有区县 ) 从列表中删除么?</p>
                        <input type="hidden" name="id" class="admin-id">
                        <p class="text-right">
                            <button type="button" class="btn btn-primary">确认</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>



        <script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/system/citylist/index_6a1cb90.js"></script>

        {include file="radishadmin/widgets/footer/footer.tpl"}