{extends file="admin/base.tpl"}
{$title = 'Managers'}
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
            <a class="btn btn-primary mb-3" href="/admin/manager/new"><i class="fas fa-user-edit"></i> Add New Manager</a>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="table_list" class="display">
                    <thead class="fw-bold">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {if isset($managers)}
                        {foreach from=$managers item=manager}
                            <tr>
                                <td>{$manager->getId()}</td>
                                <td>{$manager->getFullName()}</td>
                                <td>{$manager->getEmail()}</td>
                                <td>{$manager->getRole()}</td>
                                <td><span class="badge rounded-pill bg-light text-dark">{$manager->getCreatedAt()}</span></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                        <a class="btn btn-sm btn-primary" href="/admin/author/edit?id={$manager->getId()}"><i class="fas fa-user-edit"></i></a>
                                        <a class="btn btn-sm btn-danger" href="/admin/author/delete?id={$manager->getId()}" onclick="return confirm('Are you sure you want to delete this manager?');"><i class="fas fa-user-times"></i></a>
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