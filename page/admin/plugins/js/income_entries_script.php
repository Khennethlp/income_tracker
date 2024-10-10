<script>
    document.addEventListener('DOMContentLoaded', function() {
        income_table();
        balances();
        savings();
    });

    function formatToPeso(input) {
        let value = input.value.replace(/[₱,]/g, '');

        if (!isNaN(value) && value !== '') {
            let formatted = parseFloat(value).toLocaleString('en-PH', {
                style: 'currency',
                currency: 'PHP',
            });

            input.value = formatted;
        } else {
            input.value = '';
        }
    }

    function removeFormatting(input) {
        input.value = input.value.replace(/[₱,]/g, '');
    }

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

        let current_balance = amount.toLocaleString('en-PH', {
            style: 'currency',
            currency: 'PHP'
        });

        console.log('User ID:', user_id);
        console.log('current_balance:', current_balance);

        $('#current_balance_to_save').val(current_balance);
        $('#new_balance').val(amount);
    }

    const depositAddToBalance = (param) => {
        var data = param.split('~!~');
        var user_id = data[0];
        var amount = parseFloat(data[1]); // Now you can access the amount

        let current_balance = amount.toLocaleString('en-PH', {
            style: 'currency',
            currency: 'PHP'
        });

        console.log('User ID:', user_id);
        console.log('current_balance:', current_balance);

        $('#current_balance_from_savings').val(current_balance);

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
                document.getElementById("available_savings").innerHTML = response;
            }
        });
    }

    const deposit = () => {
        var user_id = document.getElementById('user_id').value;
        var savings_to_deposit = document.getElementById('current_balance_from_savings').value;
        var deposit_amount = document.getElementById('deposit_amount').value;

        var clean_balance = deposit_amount.replace(/[₱,]/g, '');
        var clean_amount = clean_balance.replace(/[₱,]/g, '');

        if(deposit_amount == ''){
            Swal.fire({
                icon: 'warning',
                title: 'Sorry, we\'re not able to granted your deposit right now.',
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }
        $.ajax({
            type: "POST",
            url: "../../process/admin/income_entries.php",
            data: {
                method: 'deposit',
                user_id: user_id,
                deposit: clean_amount,
            },
            success: function(response) {

                if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Amount deposited successfully!',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    balances();
                    savings();
                    income_table();
                    clear();
                    $('#deposit').modal('hide');
                } else if (response == 'failed') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Failed to deposit amount.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else if (response == 'not enough savings') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Not enough savings to cover the deposit.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else if (response == 'no savings found') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No savings found.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            }
        });
    }

    const amount_saved = () => {
        var user_id = document.getElementById('user_id').value;
        var current_balance = document.getElementById('current_balance_to_save').value;
        var amount = document.getElementById('savings_amount').value;

        var clean_balance = current_balance.replace(/[₱,]/g, '');
        var clean_amount = amount.replace(/[₱,]/g, '');

        var new_balance = parseFloat(clean_balance); // Convert to float
        var new_amount = parseFloat(clean_amount); // Convert to float

        if (clean_amount === '' || isNaN(new_amount)) {
            Swal.fire({
                icon: 'warning',
                title: 'Amount should not be empty.',
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }

        if (new_amount > new_balance) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops! Insufficient balance.',
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }
        $.ajax({
            type: "POST",
            url: "../../process/admin/income_entries.php",
            data: {
                method: 'amount_saved',
                user_id: user_id,
                savings: clean_amount
            },
            success: function(response) {
                if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Amount saved!',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    console.log(new_amount);

                    balances();
                    savings();
                    income_table();
                    clear();
                    $('#savings').modal('hide');
                } else if (response == 'failed') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Amount failed to save!',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $('#savings').modal('hide');
                }
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

        var clean_balance = income_amount.replace(/[₱,]/g, '');
        var new_amount = parseFloat(clean_balance); // Convert to float

        if (income_amount == '' || income_category == '' || income_date_from == '' || income_date_to == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Fields should not be empty.',
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: "../../process/admin/income_entries.php",
            data: {
                method: 'income_entries',
                user_id: user_id,
                amount: new_amount,
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
                        timer: 3000
                    });

                    balances();
                    savings();
                    income_table();
                    clear();
                    $('#add_income').modal('hide');
                } else if (response == 'failed') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Amount failed to save!',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $('#add_income').modal('hide');
                }
            }
        });
    }
</script>