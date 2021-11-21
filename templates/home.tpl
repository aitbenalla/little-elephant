{extends file="base.tpl"}
{$title = 'Home'}
{block name=content}
  <div class="text-center py-5 mb-5">
    <img class="d-block mx-auto mb-4" src="./assets/media/logo.png" alt="" width="80">
    <h1 class="display-5 fw-bold">Welcome Little Elephant</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Database Configuration:</p>
      <p class="fw-bold">Test or Create Database and Table.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <form action="/" method="post">
          <select class="form-select mb-2" aria-label="Default select example" name="db_execute">
            <option value="1">Test Server Connection</option>
            <option value="2">Create Database</option>
            <option value="3">Create Tables</option>
            <option value="4">Drop Database</option>
          </select>
          <button class="btn btn-primary" type="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
{/block}