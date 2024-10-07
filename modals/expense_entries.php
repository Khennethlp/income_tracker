<div class="modal fade bd-example-modal-xl" id="add_expense" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="border-radius: 18px;">
            <div class="modal-header ">
                <h5 class="modal-title " id="exampleModalLabel">
                    <b>Expense Entry</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <span><b>Amount:</b></span>
                        <input type="number" id="expense_amount" class="form-control mb-2" placeholder="" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12">
                        <span><b>Category:</b></span>
                        <input type="text" id="expense_category" class="form-control mb-2" placeholder="e.g. Foods, Clothes etc." autocomplete="off" required>
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer ">
                <div class="col-md-4">
                    <button class="btn btn-block btn_confirm" onclick="expense_entries();" >Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>