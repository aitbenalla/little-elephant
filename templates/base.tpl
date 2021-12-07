{include file="components/head.tpl"}
{include file="components/navbar.tpl"}
<main class="flex-shrink-0">
<div class="container mt-4">
  {if isset($smarty.session.flash)}
  {$type = $smarty.session.flash.type}
    <div class='alert alert-{$type}' role='alert'>{$smarty.session.flash.message}</div>
    {php}
      unset($_SESSION['flash']);
    {/php}
  {/if}
  {block name=content}{/block}
</div>
</main>
{include file="components/footer.tpl"}