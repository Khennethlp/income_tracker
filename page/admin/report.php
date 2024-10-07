<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card card-secondary card-outline mt-5">
            <div class="card-header">
              <h3 class="card-title text-uppercase"> reports dashboard</h3>
            </div>
            <div class="card-body">
              <div class="col-md-12">
                <div class="row">
                  <?php
                  // Get the current year
                  $currentYear = date('Y');
                  // Create an array for the months
                  $months = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                  ];
                  // Loop through each month to create a card
                  foreach ($months as $month) {
                  ?>
                    <div class="card mx-2 card-success card-outline">
                      <div class="card-body">
                        <h4><i class="fas fa-calendar text-lg"></i>&nbsp; <?= $month  . ' '. $currentYear ?></h4>
                      </div>
                    </div>
                  <?php
                  }
                  ?>


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
include 'plugins/js/datatable_script.php';
?>