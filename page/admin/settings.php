<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card mt-2" style="border-radius: 15px;">
            <div class="card-header">
              <h3 class="card-title text-uppercase"> settings dashboard</h3>
            </div>
            <div class="card-body">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-3">
                    <input type="hidden" id="user_id" value="<?= $_SESSION['id']; ?>">
                    <div class="card bg-success">
                      <div class="card-body">
                        <a href="../../template/income_entries.xlsx" class="btn btn-success">Download Template for Income Entries</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card bg-success">
                      <div class="card-body">
                        <a href="../../template/expense_entries.xlsx" class="btn btn-success">Download Template for Expense Entries</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <form id="csvFileForm" method="post" enctype="multipart/form-data">
                          <input type="file" class="form-control p-1" name="csvFile" accept=".csv, .xls, .xlsx" id="csvFileInput">
                          <input type="submit" class="form-control mt-2" value="Upload">
                        </form>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-4">
                          <select name="" id="entry_category" class="form-control" style="display: none;">
                            <option value="" disabled selected>Select Entry Category</option>
                            <option value="income_entries">Income Entries</option>
                            <option value="expense_entries">Expense Entries</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <button class="btn btn-block active" id="uploadBtn" style="display: none;">Upload</button>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                      <table id="table_file" class="table table-striped table-bordered table-hover mt-3">
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<?php
include 'plugins/footer.php';
include 'plugins/js/file_upload_script.php';
?>