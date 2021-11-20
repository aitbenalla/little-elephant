{include file="components/head.tpl"}
{include file="components/navbar.tpl"}
<div class="container mt-4">
  {if isset($flash)}
    <div class='alert alert-{$flash.type}' role='alert'>{$flash.message}</div>
  {/if}
  {* {if isset($smarty.session.flash)}
    <div class='alert alert-danger' role='alert'>{$smarty.session.flash}</div>
  {/if} *}
  {block name=content}{/block}
</div>
{include file="components/footer.tpl"}
