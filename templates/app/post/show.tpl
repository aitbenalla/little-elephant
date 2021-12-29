{extends file="app/base.tpl"}
{$title = 'Posts'}
{block name="content"}
    <h1 class="h2">Posts:</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 py-4">
        {foreach from=$posts item=post}
            <div class="col">
                <div class="card mb-3">
                    {if isset($post->media_name)}
                        <img src="data:image/{$post->media_type};base64,{$post->media_name|base64_encode}" class="card-img-top" alt="...">
                    {/if}
                    <div class="card-body">
                        <h5 class="card-title mb-3">{$post->getTitle()|truncate:100}</h5>
                        <p class="mb-3">
                            <a href="/profile/{$post->author_username}">{$post->author_username}</a>
                            <a href="/category/{$post->category_slug}" class="float-end">{$post->category_name}</a>
                        </p>
                        <p class="card-text">
                            <small>
                                {$post->getContent()|strip_tags:false|truncate:100}
                            </small>
                        </p>
                        <p class="card-text">
                            <small class="text-muted">{$post->getCreatedAt()|date_format}</small>
                            <a href="/post/{$post->getSlug()}" class="float-end">Continue reading →</a>
                        </p>
                    </div>
                </div>
            </div>
        {/foreach}

    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
{/block}