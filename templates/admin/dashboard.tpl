{extends file="base.tpl"}
{$title = 'Admin | Dashboard'}

{block name=content}
    <h1>Welcome {$smarty.session.admin->getFullName()|upper}</h1>
{/block}