<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">

			<li class="sidebar-search">
				<form class="input-group">
					<div class="input-group-btn">
						<button id='sidebar-search-button' type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<span id='mod_name'>信息</span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li data-value="/radishadmin/user/list"><a href="javascript:;">用户</a></li>
							<li data-value="/radishadmin/volunteer/list"><a href="javascript:;">志愿者</a></li>
							<li data-value="/radishadmin/organization/list"><a href="javascript:;">机构</a></li>
							<li data-value="/radishadmin/message/list"><a href="javascript:;">信息</a></li>
						</ul>
					</div>
					<!--不同接口的搜索，添加input-->
					<input type="hidden" id='message-value' class="form-control" value="/radishadmin/message/list">
					<input type="hidden" id='mod-value' class="form-control" value="/radishadmin/user/list">
					<input type="hidden" id='volunteer-value' class="form-control" value="/radishadmin/volunteer/list">
					<input type="hidden" id='organization-value' class="form-control" value="/radishadmin/organization/list">
					


					<input type="text" class="form-control" name='keywords'>
					<span class="input-group-btn">
            <button class="btn btn-primary" type="submit" id='search-submit'>
              <i class="fa fa-search"></i>
            </button>
          </span>
				</form>
			</li>
			{if $session.role==0}
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;管理员列表<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/admin/create"><i class="fa fa-plus fa-fw"></i>&nbsp;添加管理员</a>
					</li>
					<li>
						<a href="/radishadmin/admin/index"><i class="fa fa-list-alt fa-fw"></i>&nbsp;管理员列表</a>
					</li>
				</ul>
			</li>
			{/if}
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;信息列表<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/message/list"><i class="fa fa-list-alt fa-fw"></i>&nbsp;信息列表</a>
					</li>
					<li>
						<a href="/radishadmin/message/reportlist"><i class="fa fa-list-alt fa-fw"></i>&nbsp;信息举报列表</a>
					</li>
				</ul>
			</li>
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;用户管理<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/organization/list"><i class="fa fa-list-alt fa-fw"></i>&nbsp;机构管理</a>
					</li>
					<li>
						<a href="/radishadmin/volunteer/list"><i class="fa fa-list-alt fa-fw"></i>&nbsp;志愿者管理</a>
					</li>
					<li>
						<a href="/radishadmin/user/list"><i class="fa fa-list-alt fa-fw"></i>&nbsp;用户管理</a>
					</li>
				</ul>
			</li>
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;评论管理<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/comments/list"><i class="fa fa-list-alt fa-fw"></i>&nbsp;评论管理</a>
					</li>
					<li>
						<a href="/radishadmin/notice/commentslist"><i class="fa fa-list-alt fa-fw"></i>&nbsp;公告评论管理</a>
					</li>
				</ul>
			</li>
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;轮播管理<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/banner/list"><i class="fa fa-list-alt fa-fw"></i>&nbsp;轮播图管理</a>
					</li>
				</ul>
			</li>
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;广告图管理<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/advertise/list"><i class="fa fa-list-alt fa-fw"></i>&nbsp;广告图管理</a>
					</li>
				</ul>
			</li>
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;信息统计<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/message/statistics"><i class="fa fa-list-alt fa-fw"></i>&nbsp;信息统计</a>
					</li>
				</ul>
			</li>
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;消息推送<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/push/push"><i class="fa fa-list-alt fa-fw"></i>&nbsp;消息推送</a>
					</li>
				</ul>
			</li>
			{if $session.role==0}
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;操作日志<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					{if $session.role==0 || $session.role==1}
					<li>
						<a href="/radishadmin/log/create"><i class="fa fa-list-alt fa-fw"></i>&nbsp;添加操作日志</a>
					</li>
					{/if}
					<li>
						<a href="/radishadmin/log/list"><i class="fa fa-list-alt fa-fw"></i>&nbsp;操作日志列表</a>
					</li>
				</ul>
			</li>
			{/if}
			{if $session.role==0 || $session.role==1}
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;生活管理<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/exist/list"><i class="fa fa-list-alt fa-fw"></i>&nbsp;游戏管理</a>
					</li>
					<li>
						<a href="/radishadmin/exist/ratecreate"><i class="fa fa-list-alt fa-fw"></i>&nbsp;票务话费</a>
					</li>
				</ul>
			</li>
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;订单管理<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/order/airportlist"><i class="fa fa-list-alt fa-fw"></i>&nbsp;机票管理</a>
					</li>
					<li>
						<a href="/radishadmin/order/trainlist"><i class="fa fa-list-alt fa-fw"></i>&nbsp;火车票管理</a>
					</li>
					<li>
						<a href="/radishadmin/order/ofpaylist"><i class="fa fa-list-alt fa-fw"></i>&nbsp;话费管理</a>
					</li>
				</ul>
			</li>
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;赞赏管理<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/record/reword"><i class="fa fa-list-alt fa-fw"></i>&nbsp;赞赏列表</a>
					</li>
					<li>
						<a href="/radishadmin/record/topup"><i class="fa fa-list-alt fa-fw"></i>&nbsp;充值列表</a>
					</li>
					<li>
						<a href="/radishadmin/record/index"><i class="fa fa-list-alt fa-fw"></i>&nbsp;提现列表</a>
					</li>
				</ul>
			</li>
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;区域人员管理<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/operate/create"><i class="fa fa-plus fa-fw"></i>&nbsp;添加区域运营人员</a>
					</li>
					<li>
						<a href="/radishadmin/operate/list"><i class="fa fa-list-alt fa-fw"></i>&nbsp;区域运营列表</a>
					</li>
				</ul>
			</li>

             <li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;公告列表<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/notice/index"><i class="fa fa-list-alt fa-fw"></i>&nbsp;公告列表</a>
					</li>
				</ul>
			</li>
			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;反馈列表<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/notice/list"><i class="fa fa-list-alt fa-fw"></i>&nbsp;反馈列表</a>
					</li>
				</ul>
			</li>

			<li class="">
				<a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;系统设置<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/radishadmin/system/sitelist"><i class="fa fa-list-alt fa-fw"></i>&nbsp;场所设置</a>
					</li>
					<li>
						<a href="/radishadmin/system/citylist"><i class="fa fa-list-alt fa-fw"></i>&nbsp;区县设置</a>
					</li>
					<li>
					<a href="/radishadmin/system/genrelist"><i class="fa fa-list-alt fa-fw"></i>&nbsp;信息类型设置</a>
					</li>
					<li>
					<a href="/radishadmin/category/list"><i class="fa fa-list-alt fa-fw"></i>&nbsp;单位设置</a>
					</li>
					{if $session.role==0}
					<li>
					<a href="/radishadmin/exist/ratepercent"><i class="fa fa-list-alt fa-fw"></i>&nbsp;抽成比例设置</a>
					</li>
					{/if}
					<li>
					<a href="/radishadmin/exist/user"><i class="fa fa-list-alt fa-fw"></i>&nbsp;用户协议设置</a>
					</li>
					<li>
					<a href="/radishadmin/exist/help"><i class="fa fa-list-alt fa-fw"></i>&nbsp;我的余额帮助设置</a>
					</li>
					<li>
						<a href="/radishadmin/exist/about"><i class="fa fa-list-alt fa-fw"></i>&nbsp;关于我们设置</a>
					</li>
					<li>
						<a href="/radishadmin/exist/manual"><i class="fa fa-list-alt fa-fw"></i>&nbsp;使用说明设置</a>
					</li>
				</ul>
			</li>
			{/if}


		</ul>
	</div>
</div>
<script type="text/javascript" src="//img.oranzh.cc/wiki/static/widgets/nav/nav-sidebar_8f36b05.js"></script>