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
      <table id="table_list" class="display">
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
          <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
{/block}
