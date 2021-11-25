{extends file="base.tpl"}
{$title = 'List'}
{block name=styles}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"> 
{/block}
{block name=scripts}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="./assets/js/datatable-config.js"></script>
{/block}
{block name=content}
<h1 class="fw-bold h2">Datatable List:</h1>
<div class="row p-3">
  <div class="col-lg-12">
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
              <td> <div class="rounded-circle"><img src="data:image/png;base64,{$member->name|base64_encode}" height="40"/></div>
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
                 <a class="btn btn-sm btn-warning" href="/edit_member?id={$member->getId()}"><i class="fas fa-edit"></i></a>
                 <a class="btn btn-sm btn-danger" href="/delete_member?id={$member->getId()}"><i class="fas fa-times"></i></a>
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