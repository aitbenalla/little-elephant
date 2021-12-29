{include file="app/components/head.tpl"}
{include file="app/components/navbar.tpl"}
<main class="flex-shrink-0">
<div class="container mt-4">
  {if isset($smarty.session.flash)}
      {foreach from=$smarty.session.flash item=flash}
          <div class='alert alert-{$flash.type}' role='alert'>{$flash.message}</div>
      {/foreach}
    {php}
      unset($_SESSION['flash']);
    {/php}
  {/if}
  {block name="content"}{/block}
</div>
</main>
{include file="app/components/footer.tpl"}