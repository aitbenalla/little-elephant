{extends file="base.tpl"}
{$title = 'List'}
{block name=stylesheets}
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
{/block}
{block name=javascripts}
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="./assets/js/datatable-config.js"></script>
{/block}

{block name=content}
  <h1 class="fw-bold h2">Members:</h1>
  <div class="row p-3">
    <div class="col-lg-12">
      <a class="btn btn-primary mb-3" href="/add">Add New <i class="fas fa-user-edit"></i></a>
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
            {foreach from=$members item=member}
              <tr>
                <td>{$member->getId()}</td>
                <td><img class="rounded-circle" src="data:image/png;base64,{$member->name|base64_encode}" width="40" height="40"/>
                <td>{$member->getFullName()}</td>
                <td>{$member->getUsername()}</td>
                <td>{$member->getBirthdate()}</td>
                <td>{$member->getEmail()}</td>
                <td>0{$member->getPhone()}</td>
                <td><span class="badge rounded-pill bg-primary">{$member->getCity()}</span> <span class="badge rounded-pill bg-primary">{$member->getCountry()}</span></td>
                <td><span class="badge rounded-pill bg-danger">{$member->getRole()}</span></td>
                <td><span class="badge rounded-pill bg-light text-dark">{$member->getCreatedAt()}</span></td>
                <td> 
                  <div class="btn-group btn-group-sm" role="group" aria-label="...">
                  <a class="btn btn-sm btn-primary" href="/edit_member?id={$member->getId()}"><i class="fas fa-user-edit"></i></a>
                  <a class="btn btn-sm btn-danger" href="/delete_member?id={$member->getId()}" onclick="return confirm('Are you sure you want to delete this member?');"><i class="fas fa-user-times"></i></a>
                  </div>
                </td>
              </tr>
            {/foreach}
          </tbody>
        </table>
      </div>
    </div>
  </div>
{/block}