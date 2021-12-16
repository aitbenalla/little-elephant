{extends file="admin/base.tpl"}
{$title = 'Authors'}
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
      <a class="btn btn-primary mb-3" href="/admin/author/new"><i class="fas fa-user-edit"></i> Add New Author</a>
      <div class="table-responsive">
        <table class="table table-striped table-hover" id="table_list" class="display">
          <thead class="fw-bold">
          <tr>
            <th>ID</th>
            <th>Picture</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Birthdate</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          {if isset($authors)}
            {foreach from=$authors item=author}
              <tr>
                <td>{$author->getId()}</td>
                <td><img class="rounded-circle" src="data:image/png;base64,{$author->name|base64_encode}" width="40" height="40"/>
                <td>{$author->getFullName()}</td>
                <td>{$author->getUsername()}</td>
                <td>{$author->getBirthdate()}</td>
                <td>{$author->getEmail()}</td>
                <td>0{$author->getPhone()}</td>
                <td><span class="badge rounded-pill bg-primary">{$author->getCity()}</span> <span class="badge rounded-pill bg-primary">{$author->getCountry()}</span></td>
                <td><span class="badge rounded-pill bg-light text-dark">{$author->getCreatedAt()}</span></td>
                <td>
                  <div class="btn-group btn-group-sm" role="group" aria-label="...">
                    <a class="btn btn-sm btn-primary" href="/author/edit?id={$author->getId()}"><i class="fas fa-user-edit"></i></a>
                    <a class="btn btn-sm btn-danger" href="/author/delete?id={$author->getId()}" onclick="return confirm('Are you sure you want to delete this author?');"><i class="fas fa-user-times"></i></a>
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