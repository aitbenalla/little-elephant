<?php $styles = '';
include './components/head.php' ?>
<?php include './components/navbar.php' ?>
<div class="container mt-4">
  <?php include './src/exceptions.php' ?>
  <div class="text-center py-5 mb-5">
    <img class="d-block mx-auto mb-4" src="./assets/media/logo.png" alt="" width="80">
    <h1 class="display-5 fw-bold">Welcome Little Elephant</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Database Configuration:</p>
      <p class="fw-bold">Test or Create Database and Table.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <form action="src/config.php" method="post">
          <select class="form-select mb-2" aria-label="Default select example" name="db_execute">
            <option value="1">Test Connection</option>
            <option value="2">Create Database</option>
            <option value="3">Create Table</option>
          </select>
          <button class="btn btn-primary" type="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $scripts = '';
include './components/footer.php' ?>