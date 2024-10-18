<div class="modal fade bd-example-modal-xl" id="update_expense" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="border-radius: 18px;">
            <div class="modal-header ">
                <h5 class="modal-title " id="exampleModalLabel">
                    <b>Update Expense Entry</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="user_id" value="<?= $_SESSION['id']; ?>">
                    <input type="text" id="id" class="form-control mb-2" placeholder="" autocomplete="off" required>
                    <div class="col-sm-12">
                        <span><b>Amount:</b></span>
                        <input type="text" id="update_expense_amount" class="form-control mb-2" onblur="formatToPeso(this)" onfocus="removeFormatting(this)" placeholder="" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12">
                        <span><b>Category:</b></span>
                        <input type="text" id="update_expense_category" class="form-control mb-2" placeholder="e.g. Foods, Clothes etc." autocomplete="off" required>
                    </div>
                    <div class="col-sm-12">
                        <label for="">Custom Date:</label>
                        <input type="date" name="update_custom_date" id="update_custom_date" class="form-control">
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer ">
                <div class="col-md-4">
                    <button class="btn btn-block btn_confirm" onclick="update_expense_entries();" >Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>