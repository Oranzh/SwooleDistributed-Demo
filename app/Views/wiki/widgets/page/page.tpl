 {if $page.nc >= 1}
  <div class="row">
  <div class="col-sm-6">
    <div class="list-page-info">
      现在是第{$page.pn}/{$page.pn_count}页,每页{$page.rn}条,共{$page.count}条
    </div>
  </div>
  <div class="col-sm-6">
    <div class="pull-right">
      <ul class="pagination">
        {if $page.has_prev != 0}
        <li class="paginate_button previous">
          <a href="{$page.uri}&rn={$page.rn}&pn={$page.pn-1}">上一页</a>
        </li>
        {/if} {foreach from=$page.display_pages key=i item=item}
        <li class="paginate_button {if $page.pn==$item} active{/if}">
          <a href="{if $page.pn==$item} javascript:void(0) {else}{$page.uri}&rn={$page.rn}&pn={$item} {/if}">{$item}</a>
        </li>
        {/foreach} {if $page.has_next != 0}
        <li class="paginate_button">
          <a href="{$page.uri}&rn={$page.rn}&pn={$page.pn+1}">下一页</a>
        </li>
        {/if}
        <li class="paginate_button">
          <a>跳转到</a>
        </li>
        <li class="paginate_button">
          <a>
            <input class="pageNum" value="">
          </a>
        </li>
        <li class="paginate_button">
          <a href="javascript:void(0)" class="pageHref" data-rn="{$page.rn}" data-uri="{$page.uri}">跳转</a>
        </li>
      </ul>
    </div>
  </div>
</div>
{/if} 