<script>
    document.addEventListener('DOMContentLoaded', function() {
        expense_table();
        balances();

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
        $('#expense_amount').val('');
        $('#expense_category').val('');
    }

    const expense_table = () => {
        $.ajax({
            type: "POST",
            url: "../../process/admin/expense_entries.php",
            data: {
                method: 'load_expense'
            },
            success: function(response) {
                $('#expense_table').html(response);

            }
        });
    }

    const balances = () => {
        var user_id = document.getElementById('user_id').value;

        $.ajax({
            type: "POST",
            url: "../../process/admin/expense_entries.php",
            data: {
                method: 'balances',
                user_id: user_id,
            },
            success: function(response) {
                document.getElementById("current_balance").innerHTML = response;
            }
        });
    }

    const expense_entries = () => {
    var user_id = document.getElementById('user_id').value.trim(); // Trim to remove whitespace
    var expense_amount = document.getElementById('expense_amount').value.trim();
    var expense_category = document.getElementById('expense_category').value.trim();

    var clean_expense_amount = expense_amount.replace(/[₱,]/g, ''); // Clean expense amount
    var new_amount = parseFloat(clean_expense_amount);

    // Validate if the fields are empty
    if (user_id === '') {
        Swal.fire({
            icon: 'warning',
            title: 'No user ID provided.',
            showConfirmButton: false,
            timer: 1500
        });
        return; // Stop execution if no user_id
    }

    if (expense_amount === '' || isNaN(new_amount)) {
        Swal.fire({
            icon: 'warning',
            title: 'Invalid or empty amount provided.',
            showConfirmButton: false,
            timer: 1500
        });
        return; // Stop execution if no amount or invalid amount
    }

    if (expense_category === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Category must not be empty.',
            showConfirmButton: false,
            timer: 1500
        });
        return; // Stop execution if no category
    }

    // Proceed with AJAX request if validation passes
    $.ajax({
        type: "POST",
        url: "../../process/admin/expense_entries.php",
        data: {
            method: 'expense_entries',
            user_id: user_id,
            amount: new_amount,
            category: expense_category,
        },
        success: function(response) {
            if (response == 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Expense saved successfully!',
                    showConfirmButton: false,
                    timer: 1000
                });

                // Call functions to update balances and table, clear inputs, and hide modal
                balances();
                expense_table();
                $('#add_expense').modal('hide');
                clear();
            } else if (response == 'failed') {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to save expense!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'An error occurred. Please try again.',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
};

</script>