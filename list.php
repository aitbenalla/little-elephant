<?php
$styles = '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">';
include './components/head.php'
?>
<?php include './components/navbar.php' ?>
<div class="container mt-4">
  <?php include './src/exceptions.php' ?>
  <h1 class="fw-bold h2">Datatable List:</h1>
  <div class="row p-3">
    <div class="col-lg-12">
      <table id="table_list" class="display">
        <thead>
          <tr>
            <th>Column 1</th>
            <th>Column 2</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
          </tr>
          <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
$scripts = '
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script src="./assets/js/datatable-config.js"></script>
';
include './components/footer.php'
?>