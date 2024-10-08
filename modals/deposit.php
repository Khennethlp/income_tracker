<div class="modal fade bd-example-modal-xl" id="deposit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="border-radius: 18px;">
            <div class="modal-header ">
                <h5 class="modal-title " id="exampleModalLabel">
                    <b>Deposit</b>
                </h5>
              <hr>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="user_id" value="<?= $_SESSION['id']; ?>">
                    <div class="col-md-12 mb-2">
                        <label for="">Current Savings</label>
                        <input type="text" class="form-control" id="current_balance_to_save" readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="">Amount</label>
                        <input type="text" class="form-control" onblur="formatToPeso(this)" onfocus="removeFormatting(this)" name="" id="savings_amount" autocomplete="off">
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer ">
                <div class="col-md-8">
                    <button class="btn btn-block btn_confirm" onclick="">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>