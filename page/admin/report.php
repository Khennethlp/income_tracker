<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card mt-2" style="border-radius: 15px;">
            <div class="card-body">
              <label for="">Reports Dashboard</label>
              <div class="card" style="border-radius: 15px; max-height: 550px; overflow-y:auto;">
                <div class="col-md-12 mt-2">
                  <div class="row">
                    <?php
                    require '../../process/conn.php';

                    $sql = "SELECT DISTINCT DATE_FORMAT(date_from, '%M') AS month, YEAR(date_from) AS year FROM income_entries ORDER BY date_from";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $monthsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($monthsData as $data) {
                      $month = $data['month'];
                      $year = $data['year'];
                    ?>
                      <div class="card mx-2 card-success card-outline" style="border-radius: 15px;">
                        <div class="card-body">
                          <h4><i class="fas fa-calendar text-lg"></i>&nbsp; <?= $month . ' ' . $year ?></h4>
                          <button class="btn btn-success btn-block mt-3 monthly_details_btn" data-month="<?= $month; ?>" data-year="<?= $year; ?>" data-toggle="modal" data-target="#monthly_deets">View</button>
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
          <div class="card">
            <div id="myChart_bar"></div>
          </div>
        </div>
      </div>
  </section>
</div>


<?php
include 'plugins/footer.php';
include 'plugins/js/monthly_details_script.php';
include 'plugins/js/barChart_script.';

?>