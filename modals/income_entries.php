<div class="modal fade bd-example-modal-xl" id="add_income" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="border-radius: 18px;">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">
                    <b>Income Entry</b>
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
                    <div class="col-sm-12">
                        <span><b>Amount:</b></span>
                        <input type="number" id="income_amount" class="form-control mb-2" placeholder="" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12">
                        <span><b>Category:</b></span>
                        <input type="text" id="income_category" class="form-control mb-2" placeholder="e.g. Work, Freelance etc." autocomplete="off" required>
                    </div>
                    <div class="col-sm-6">
                        <span><b>Date From:</b></span>
                        <input type="date" id="income_date_from" class="form-control mb-2" placeholder="e.g. emp_id or name" autocomplete="off" required>
                    </div>
                    <div class="col-sm-6">
                        <span><b>Date To:</b></span>
                        <input type="date" id="income_date_to" class="form-control mb-2" placeholder="e.g. emp_id or name" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12 ">
                        <span><b>Notes:</b></span>
                        <textarea class="form-control" name="" id="income_notes"></textarea>
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer ">
                <div class="col-md-4">
                    <button class="btn  btn-block btn_confirm" onclick="income_entries();" >Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>