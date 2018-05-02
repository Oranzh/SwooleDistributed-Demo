{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">信息类型设置</h1>
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
								<th>信息类型</th>
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
										<a type="button" href="/radishadmin/system/genredetail?id={$item.id}" class="btn btn-xs btn-info">
											<i class="fa fa-share fa-fw"></i>
											<span>查看所有标签</span>
										</a>
										<a href="/radishadmin/system/genreedit?id={$item.id}" type="button" class="btn btn-xs class-edit btn-primary">
											<i class="fa fa-edit fa-fw"></i>
											<span>编辑</span>
										</a>
										<a type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#pay-metho-confirm">
											<i class="fa fa-edit fa-fw"></i>
											<span>添加标签</span>
										</a>
										<!--Delete-->
										<a id="" type="button" class="btn btn-xs btn-danger" data-toggle="modal">
                                        	<i class=""></i>
                                        	<span>删除</span>
                                    	</a>
									</div>
								</td>
							</tr>
							{/foreach}
							
						</tbody>
					</table>
					<a type="button" href="#" id="submit" class="btn btn-primary" data-toggle="modal" data-target="#newGenre">添加新类型</a>
				</div>
			</div>
		</div>
		{include file="radishadmin/widgets/page/page.tpl"} {else} 暂无数据 {/if}

		<div id='newGenre' aria-hidden="false" class="modal fade" id='form-edit' method="post">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					</div>
					<form id="form-edit" class="modal-body" onkeydown="if(event.keyCode==13)return false;">
						<div class="form-group form-name">
							<label for="name" class="control-label">添加信息类型1：</label>
							<input id="test" type="text" name='name' class="form-control passport-name">
						</div>
						<input type="hidden" name="id" class="passport-id">

						<p class="text-right">
							<button type="button" class="btn btn-primary" id="submitBtn">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>
		<!--classify-->
		<div id='pay-metho-confirm' aria-hidden="false" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					</div>
					<form class="modal-body" onkeydown="if(event.keyCode==13)return false;">
						<div class="form-group form-name">
							<label for="name" class="control-label">添加标签：</label>
							<input id='name' type="text" name='name' class="form-control passport-name">
						</div>
						<input type="hidden" name="id" class="passport-id" id="tag2">

						<p class="text-right">
							<button type="button" class="btn btn-primary" id="submitBtn1" value="">确认</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal" value="">取消</button>
						</p>
					</form>
				</div>
			</div>
		</div>
		
		<!--FormValid-->
		<script type="text/javascript">
			$('#submitBtn').click(function(){
				var val1 =$('#test').val();
				console.log(val1+'2')
				$.ajax({
					type: "POST",
					url: '/radishadmin/system/genreCreate',
					data: { id:0, name: val1},
					success: function (res) {
						console.log(res);
						location.reload();
						
					}

				})
			});

			$('#submitBtn1').click(function(){
				var val =$('#tag2').val();
				console.log(val)
				var title = $('#name').val();
				console.log(title);
				$.ajax({
					type: "POST",
					url: '/radishadmin/system/genreCreate',
					data: { id:val, name: title},
					success: function (res) {
						console.log(res);
						location.reload();
						
					}

				})
			});

			$('.btn-danger').click(function(){
				var val = $(this).parent().parent().parent();
				var val1 = val[0].firstChild.nextElementSibling.innerHTML;
				val.remove();
				console.log(val1);
				$.ajax({
					type: "POST",
					url: '/radishadmin/system/genreDelete',
					data: { id:val1},
					success: function (res) {
						console.log(res);
						location.reload();
						
					}

				})
			});
			
		</script>
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/util/FormValid_080a673.js"></script>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/system/genrelist/index_ad09b59.js"></script>
		

		{include file="radishadmin/widgets/footer/footer.tpl"}