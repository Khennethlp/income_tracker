<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php';


?>
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card mt-2" style="border-radius: 15px;">
            <div class="card-body">
              <div class="col-md-12">
                <input type="hidden" id="user_id" value="<?= $_SESSION['id'] ?>">
                <div class="row">
                  <div class="col-md-2">
                    <div class="card card-danger card-outline p-2" style="border-radius: 15px;">
                      <div class="row">
                        <!-- <div class="col-md-6"> -->
                          <div class="pl-2">
                            <h2 id="current_balance"></h2>
                          </div>
                        <!-- </div> -->
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="card card-success card-outline p-2" style="border-radius: 15px;">
                      <div class="row">
                        <!-- <div class="col-md-7"> -->
                          <div class="pl-2">
                            <h2 id="available_balance"></h2>
                            <h6>Savings</h6>
                            <a href="#" data-target="#deposit" data-toggle="modal">Deposit</a>
                            
                          </div>
                        <!-- </div> -->
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-11">
                      <label for="">Income Entries</label>
                    </div>
                    <div class="col-md-1">
                      <i class="fas fa-filter filter" data-toggle="modal" data-target="#income_filter" id="Filter" style="cursor: pointer;">Filter</i>
                    </div>
                  </div>
                </div>
                <div class="card" style="border-radius: 15px; max-height: 550px; overflow-y:auto;">
                  <table class="table table-condensed table-hover">
                    <thead>
                      <th>No.</th>
                      <th>Amount</th>
                      <th>Category</th>
                      <th>Date</th>
                      <th>Notes</th>
                    </thead>
                    <tbody id="income_table">
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>

<!-- ADD Button -->
<button class="add-btn" data-toggle="modal" data-target="#add_income"><i class="fas fa-plus"></i></button>

<?php
include 'plugins/js/income_entries_script.php';
include 'plugins/footer.php';
?>