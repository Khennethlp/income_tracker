<div class="modal fade bd-example-modal-xl" id="monthly_deets" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 18px;">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">
                    <b>Monthly Details</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- <span><b>user ID:</b></span> -->
                        <input type="hidden" id="user_id" class="form-control mb-2" value="<?= $_SESSION['id']; ?>" autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label for="">Income Entries</label>
                    </div>
                </div>
                <table class="table table-condensed table-hover">
                    <thead>
                        <th>No.</th>
                        <th>Amount</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Notes</th>
                    </thead>
                    <tbody id="income_table_body"></tbody>
                </table>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- <span><b>user ID:</b></span> -->
                        <input type="hidden" id="user_id" class="form-control mb-2" value="<?= $_SESSION['id']; ?>" autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label for="">Expense Entries</label>
                    </div>
                </div>
                <table class="table table-condensed table-hover">
                    <thead>
                        <th>No.</th>
                        <th>Amount</th>
                        <th>Category</th>
                        <th>Date</th>
                    </thead>
                    <tbody id="expense_table_body"></tbody>
                </table>
            </div>
            <div class="modal-footer ">
                <div class="col-md-2">
                    <button class="btn  btn-block btn_confirm" onclick="">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>