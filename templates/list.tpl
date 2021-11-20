{extends file="base.tpl"}
{$title = 'List'}
{block name=styles}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
{/block}
{block name=scripts}
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
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
          {foreach from=$members item=member key=key name=name}
          <tr>
            <td>{$member.id}</td>
            <td>#</td>
            <td>{$member.full_name}</td>
            <td>{$member.username}</td>
            <td>{$member.birth_date}</td>
            <td>{$member.email}</td>
            <td>{$member.phone}</td>
            <td>{$member.country} / {$member.city}</td>
            <td>{$member.account_type}</td>
            <td>{$member.created_at}</td>
            <td>
              <a class="btn btn-sm btn-warning mb-2" href="#">Edit</a>
              <a class="btn btn-sm btn-danger" href="#">Delete</a>
            </td>
          </tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  </div>
</div>
{/block}