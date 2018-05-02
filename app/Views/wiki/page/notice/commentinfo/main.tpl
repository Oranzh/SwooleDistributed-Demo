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
            公告评论详情
          </div>
          <div class="panel-body">
            <div class="row clearfix">
              <div class="col-lg-12">
                <p>编号：
                  <span class="text-muted">{$info.id}</span></p>
              </div>
              <div class="col-lg-12">
                <p>公告评论内容：
                  <span class="text-muted">{$info.content}</span></p>
              </div>
              
              <div class="col-lg-12">
                <p>评论者账号：
                  <span class="text-muted">{$info.notice_id}</span></p>
              </div>
               <div class="col-lg-12">
                <p>评论者昵称：
                  <span class="text-muted">{$info.user}</span></p>
              </div>
              <div class="col-lg-12">
                <p>公告评论时间：
                  <span class="text-muted">{$info.create_time}</span></p>
              </div>
            </div>
          </div>
        </div>

        {include file="radishadmin/widgets/footer/footer.tpl"}
