{include file="components/head.tpl"}
{include file="components/navbar.tpl"}
<div class="container mt-4">
  {if isset($smarty.session.flash)}
  {$type = $smarty.session.flash.type}
    <div class='alert alert-{$type}' role='alert'>{$smarty.session.flash.message}</div>
    {php}
      unset($_SESSION['FLASH_MESSAGES']);
    {/php}
  {/if}
  {block name=content}{/block}
</div>
{include file="components/footer.tpl"}