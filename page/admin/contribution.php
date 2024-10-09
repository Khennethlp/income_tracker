<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/admin_bar.php'; ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mt-2" style="border-radius: 15px;">
                        <div class="card-header">
                            <h3 class="card-title text-uppercase"> contribution dashboard</h3>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="user_id" value="<?= $_SESSION['id']; ?>">
                            <div class="row">
                            <div class="col-md-12">
                                    <div class="card" style="border-radius: 15px; max-height: 550px; overflow-y:auto;">
                                        <table class="table table-condensed table-hover">
                                            <thead>
                                                <th>No.</th>
                                                <th>SSS</th>
                                                <th>Philhealth</th>
                                                <th>Pag-Ibig</th>
                                                <th>Month</th>
                                                <th>Year</th>
                                                <th>Total</th>
                                            </thead>
                                            <tbody id="contribution_table">
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
<button class="add-btn" data-toggle="modal" data-target="#contributions"><i class="fas fa-plus"></i></button>
<?php
include 'plugins/footer.php';
include 'plugins/js/contribution_script.php';
?>