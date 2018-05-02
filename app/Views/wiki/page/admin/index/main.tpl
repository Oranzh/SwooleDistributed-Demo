{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
    {include file="radishadmin/widgets/nav/nav.tpl"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">管理员列表</h1>
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
                            <th>电话</th>
                            <th>姓名</th>
                            <th>类型</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach from=$list key=i item=item}
                        <tr data-id='{$item.id}'>
                            <td>{$item.id}</td>
                            <td>{$item.tel}</td>
                            <td>{$item.name}</td>
                            <td>{if $item.role ==0}超级管理员{else}普通管理员{/if}</td>
                            <td>
                                <div class="btn-group">
                                   {if $item.role == 1}
                                    <a type="button" class="btn btn-xs admin-delete btn-danger" data-toggle="modal" data-target="#admin-delete-confirm">
                                        <i class="fa fa-trash-o fa-fw"></i>
                                        <span>删除</span>
                                    </a>
                                    {/if}
                                    {if $item.role ==1 || $item.tel == $session.tel}

                                    <a href='/radishadmin/admin/edit?id={$item.id}' type="button" class="btn btn-xs class-edit btn-primary">
                                        <i class="fa fa-edit fa-fw"></i>
                                        <span>编辑</span>
                                    </a>

                                    {/if}
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
                        <p>确定要将该管理员从系统中删除么?</p>
                        <input type="hidden" name="id" class="admin-id">
                        <p class="text-right">
                            <button type="button" class="btn btn-primary">确认</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>



        <script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/admin/index/index_c9c4c1a.js"></script>

        {include file="radishadmin/widgets/footer/footer.tpl"}