<div class="modal fade bd-example-modal-xl" id="contributions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="border-radius: 18px;">
            <div class="modal-header ">
                <h5 class="modal-title " id="exampleModalLabel">
                    <b>Contribution Entry</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="user_id" value="<?= $_SESSION['id']; ?>">
                    <div class="col-sm-12">
                        <input type="text" id="sss" class="form-control mb-2" onblur="formatToPeso(this)" onfocus="removeFormatting(this)" placeholder="SSS" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12">
                        <input type="text" id="philhealth" class="form-control mb-2" onblur="formatToPeso(this)" onfocus="removeFormatting(this)" placeholder="Philhealth" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12">
                        <input type="text" id="pagibig" class="form-control mb-2" onblur="formatToPeso(this)" onfocus="removeFormatting(this)" placeholder="Pag-Ibig" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12">
                        <select id="month" class="form-control" style="border-radius:15px;">
                            <option value="">Select a month for this contribution</option>
                            <option value="January">JANUARY</option>
                            <option value="February">FEBRUARY</option>
                            <option value="March">MARCH</option>
                            <option value="April">APRIL</option>
                            <option value="May">MAY</option>
                            <option value="June">JUNE</option>
                            <option value="July">JULY</option>
                            <option value="August">AUGUST</option>
                            <option value="September">SEPTEMBER</option>
                            <option value="October">OCTOBER</option>
                            <option value="November">NOVEMBER</option>
                            <option value="December">DECEMBER</option>
                        </select>
                    </div>

                </div>
                <br>
            </div>
            <div class="modal-footer ">
                <div class="col-md-4">
                    <button class="btn btn-block btn_confirm" onclick="contribution_entries();">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>