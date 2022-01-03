{extends file="app/base.tpl"}
{$title = $smarty.session.author->getUsername()|capitalize}
{block name="stylesheets"}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
{/block}
{block name="javascripts"}
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="/assets/admin/js/datatable-config.js"></script>
{/block}
{block name="content"}
    <div class="row">
        <div class="col-12">
            <div class="p-3 mb-4 bg-light rounded-3">
                <div class="container text-center">
                    <img class="rounded-circle" src="data:image/png;base64,{$smarty.session.author->name|base64_encode}"
                         alt="" width="170" height="170">
                    <h1 class="display-5 fw-bold">{$smarty.session.author->getFullName()|capitalize}</h1>
                    <p class="text-muted text-regular">Themes built by or reviewed by Bootstrap's creators.</p>
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
        <div class="col-12">
            <div class="p-3 mb-4 bg-light rounded-3">
                <div class="container">
                    <h2 class="text-center fw-bold">My Posts:</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table_list" class="display">
                            <thead class="fw-bold">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            {if isset($posts)}
                                {foreach from=$posts item=post}
                                    <tr>
                                        <td>{$post->getId()}</td>
                                        <td>{$post->getTitle()}</td>
                                        <td>{$post->getCreatedAt()|date_format}</td>
                                        <td>{if $post->getUpdatedAt()}{$post->getUpdatedAt()|date_format}{else}Never Updated{/if}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                <a class="btn btn-sm btn-primary"
                                                   href="/post/update/{$post->getId()}"><i
                                                            class="fas fa-user-edit"></i></a>
                                                <a class="btn btn-sm btn-danger"
                                                   href="/post/delete/{$post->getId()}"
                                                   onclick="return confirm('Are you sure you want to delete this post?');"><i
                                                            class="fas fa-user-times"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                {/foreach}
                            {/if}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}