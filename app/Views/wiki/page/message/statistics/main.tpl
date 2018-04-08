{include file="radishadmin/widgets/header/header.tpl"}
<div id="wrapper">
	{include file="radishadmin/widgets/nav/nav.tpl"}
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"> 信息统计图</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form class="form-inline" role="form">
					<div class="form-group">
						<label class="control-label">用户类型</label>
						<select class="form-control" name="role">
							<option value="" class="disabled" style="height:0px;display:none;"></option>
							<option value="3">普通用户</option>
							<option value="1">志愿者</option>
							<option value="2">机构</option>
						</select>
					</div>
					&nbsp;&nbsp;
					<div class="form-group">
						<label class="control-label">场所</label>
						<select class="form-control" name="site">
							<option value="" class="disabled" style="height:0px;display:none;"></option>
							{foreach from=$site key=i item=item}
							<option value="{$item.id}">{$item.name}</option>
							{/foreach}
						</select>
					</div>
					&nbsp;&nbsp;
					{include file="radishadmin/widgets/filter/filter-unit/filter-unit.tpl"}
					<div class="form-group nav_group">
						<label for="start_time">开始时间：</label>
						<input type="text" class="form-control" id="start_time" style="width:100px;background:#fff;cursor:inherit" readonly>
						<input type="hidden" name="start" value="">
					</div>
					&nbsp;&nbsp;
					<div class="form-group nav_group">
						<label for="end_time">结束时间：</label>
						<input type="text" class="form-control" id="end_time" style="width:100px;background:#fff;cursor:inherit" readonly>
						<input type="hidden" name="end" value="">
					</div>
					&nbsp;&nbsp; {include file="radishadmin/widgets/filter/filter-city/filter-city.tpl"}
					<a type="button" class="btn btn-sm btn-warning filter_btn">筛选</a>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<!--柱状图-->
				<div id="bar" class="col-lg-12" style="width:50%; height:400px;"></div>
				<!--饼图-->
				<div id="pie" class="col-lg-12" style="width:50%; height:400px;"></div>
				<!--折线图-->
				<div id="line" class="col-lg-12" style="width:100%; height:400px;"></div>
			</div>
		</div>




		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/libs/echarts_988da6a.js"></script>

		<link rel="stylesheet" href="//img.oranzh.cc/wiki/static/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min_214bb4f.css">
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min_b8d2a8d.js"></script>
		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/libs/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN_2eaeae4.js"></script>

		<script type="text/javascript" src="//img.oranzh.cc/wiki/static/page/message/statistics/index_567948d.js"></script>

		<script type="text/html" id="listcount">
			{$listcount|json_encode nofilter}
		</script>
		<script type="text/html" id="num">
			{$num|json_encode nofilter}
		</script>
		<script type="text/html" id="day">
			{$day|json_encode nofilter} 
		</script>
  

		{include file="radishadmin/widgets/footer/footer.tpl"}