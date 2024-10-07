<script>
    document.addEventListener('DOMContentLoaded', function() {
        income_table();
        balances();
        savings();
    })

    const clear = () => {
        $('#user_id').val('');
        $('#income_amount').val('');
        $('#income_category').val('');
        $('#income_date_from').val('');
        $('#income_date_to').val('');
        $('#income_notes').val('');
    }

    const income_table = () => {
        $.ajax({
            type: "POST",
            url: "../../process/admin/income_entries.php",
            data: {
                method: 'load_income'
            },
            success: function(response) {
                $('#income_table').html(response);

            }
        });
    }

    const addToSavings = (param) => {
        var data = param.split('~!~');
        var user_id = data[0];
        var amount = parseFloat(data[1]); // Now you can access the amount

        let current_balance = amount.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' });
        
        console.log('User ID:', user_id);
        console.log('current_balance:', current_balance);

        $('#current_balance_to_save').val(current_balance);
    }

    const amount_saved = () => {
        var user_id = document.getElementById('user_id').value;
        var to_save = document.getElementById('savings_amount').value;

        $.ajax({
            type: "POST",
            url: "../../process/admin/income_entries.php",
            data: {
                method: 'amount_saved',
                user_id: user_id,
                savings: to_save
            },
            success: function(response) {
                if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Amount saved!',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    balances();
                    savings();
                    income_table();
                    $('#savings').modal('hide');
                    clear();
                } else if (response == 'failed') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Amount failed to save!',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    $('#savings').modal('hide');
                }
            }
        });
    }

    const balances = () => {
        var user_id = document.getElementById('user_id').value;

        $.ajax({
            type: "POST",
            url: "../../process/admin/income_entries.php",
            data: {
                method: 'balances',
                user_id: user_id,
            },
            success: function(response) {
                document.getElementById("current_balance").innerHTML = response;
            }
        });
    }

    const savings = () => {
        var user_id = document.getElementById('user_id').value;

        $.ajax({
            type: "POST",
            url: "../../process/admin/income_entries.php",
            data: {
                method: 'savings',
                user_id: user_id,
            },
            success: function(response) {
                document.getElementById("available_balance").innerHTML = response;
            }
        });
    }


    const income_entries = () => {
        var user_id = document.getElementById('user_id').value;
        var income_amount = document.getElementById('income_amount').value;
        var income_category = document.getElementById('income_category').value;
        var income_date_from = document.getElementById('income_date_from').value;
        var income_date_to = document.getElementById('income_date_to').value;
        var income_notes = document.getElementById('income_notes').value;

        $.ajax({
            type: "POST",
            url: "../../process/admin/income_entries.php",
            data: {
                method: 'income_entries',
                user_id: user_id,
                amount: income_amount,
                category: income_category,
                date_from: income_date_from,
                date_to: income_date_to,
                notes: income_notes
            },
            success: function(response) {

                if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Amount saved!',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    balances();
                    savings();
                    income_table();
                    $('#add_income').modal('hide');
                    clear();
                } else if (response == 'failed') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Amount failed to save!',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    $('#add_income').modal('hide');
                }
            }
        });
    }
</script>