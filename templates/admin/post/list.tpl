{extends file="admin/base.tpl"}
{$title = 'Posts'}
{block name=stylesheets}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
{/block}
{block name=javascripts}
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="/assets/admin/js/datatable-config.js"></script>
{/block}

{block name=content}
    <div class="row row-cols-1 row-cols-md-3 g-4 py-4">
        <div class="col-lg-12">
            <a class="btn btn-primary mb-3" href="/admin/post/new"><i class="fas fa-user-edit"></i> Add New Post as Admin</a>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="table_list" class="display">
                    <thead class="fw-bold">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
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
                                <td>{$post->getUsername()}</td>
                                <td>{$post->getCreatedAt()}</td>
                                <td>{$post->getUpdatedAt()}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                        <a class="btn btn-sm btn-primary" href="/admin/post/edit?id={$post->getId()}"><i class="fas fa-user-edit"></i></a>
                                        <a class="btn btn-sm btn-danger" href="/admin/post/delete?id={$post->getId()}" onclick="return confirm('Are you sure you want to delete this post?');"><i class="fas fa-user-times"></i></a>
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
{/block}