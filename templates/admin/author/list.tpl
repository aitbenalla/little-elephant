{extends file="admin/base.tpl"}
{$title = 'List'}
{block name=stylesheets}
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
{/block}
{block name=javascripts}
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="./assets/js/datatable-config.js"></script>
{/block}

{block name=content}
  <h1 class="fw-bold h2">Authors:</h1>
  <div class="row row-cols-1 row-cols-md-3 g-4 py-4">
    {if isset($smarty.session.admin)}
      <div class="col-lg-12">
      <a class="btn btn-primary mb-3" href="/author/new">Add New <i class="fas fa-user-edit"></i></a>
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
              <th>Role</th>
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
                <td><span class="badge rounded-pill bg-danger">{$author->getRole()}</span></td>
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
      {else}
      <div class="col">
        <div class="card text-center justify-content-center d-block p-3">
          <img class="rounded-circle author-img" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
          <div class="card-body">
            <h5 class="card-title">Author Name</h5>
            <p class="text-muted">@Founder <span>| </span><span><a href="#" class="text-pink">email@email.com</a></span></p>
            <a href="#" class="btn btn-primary">Follow</a>
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
                    <p class="mb-0 text-muted">Comments</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    {/if}
  </div>
{/block}