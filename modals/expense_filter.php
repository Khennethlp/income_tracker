<div class="modal fade bd-example-modal-xl" id="expense_filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="border-radius: 18px;">
            <div class="modal-header ">
                <h5 class="modal-title " id="exampleModalLabel">
                    <b>Filter by expenses</b>
                </h5>
                <hr>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label for="">Sort</label>
                        <div class="sort-buttons">
                            <input type="checkbox" id="ascCheckbox" class="sort-checkbox">
                            <label for="ascCheckbox" class="btn-sort" data-sort="asc"><img src="../../dist/img/asc.png" height="20" width="20" alt="">ASC</label>

                            <input type="checkbox" id="descCheckbox" class="sort-checkbox">
                            <label for="descCheckbox" class="btn-sort" data-sort="desc"><img src="../../dist/img/desc.png" height="20" width="20" alt="">DESC</label>
                        </div>

                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="category">Category</label>
                        <select class="form-control" id="category">
                            <option value=""></option>
                            <option value="">Work</option>
                            <option value="">Freelance</option>
                            <option value="">Business</option>
                        </select>
                    </div>
                    <div class="col-md-12 p-2 mb-2">
                        <label for="">Date Range</label>
                        <button class="form-control m-1 dateRange_btn" id="30">30 days</button>
                        <button class="form-control m-1 dateRange_btn" id="60">60 days</button>
                        <button class="form-control m-1 dateRange_btn" id="90">90 days</button>
                    </div>
                    <div class="col-md-12">
                        <label for="">Custom Date</label>
                        <input type="date" id="filter_date_from" class="form-control mb-2">
                        <input type="date" id="filter_date_to" class="form-control mb-2">
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer ">
                <div class="col-md-5">
                    <button class="btn btn-block btn_confirm" onclick="">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>