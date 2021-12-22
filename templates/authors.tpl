{extends file="base.tpl"}
{$title = 'Authors'}
{block name="content"}
    <h1 class="fw-bold h2">Authors:</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 py-4">
        {if isset($authors)}
            {foreach from=$authors item=author}
                <div class="col">
                    <div class="card text-center justify-content-center d-block p-3">
                        <img class="rounded-circle" src="data:image/png;base64,{$author->name|base64_encode}" alt="author-photo" width="150" height="150">
                        <div class="card-body">
                            <h5 class="card-title">{$author->getFullName()}</h5>
                            <p class="text-muted">@{$author->getUsername()} <span>| </span><span><a href="#" class="text-pink">{$author->getEmail()}</a></span></p>
                            <a href="/profile/{$author->getUsername()}" class="btn btn-primary">Profile</a>
                            <div class="mt-4">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mt-3">
                                            <h4>2563</h4>
                                            <p class="mb-0 text-muted">Posts</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-3">
                                            <h4>6952</h4>
                                            <p class="mb-0 text-muted">Followers</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-3">
                                            <h4>1125</h4>
                                            <p class="mb-0 text-muted">Following</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/foreach}
            {else}
            <h2>Not Author yet !</h2>
        {/if}
    </div>
{/block}