<script>
    document.addEventListener('DOMContentLoaded', function() {
        expense_table();
        balances();
      
    });

    
    const clear = () => {
        $('#user_id').val('');
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
        var user_id = document.getElementById('user_id').value;
        var expense_amount = document.getElementById('expense_amount').value;
        var expense_category = document.getElementById('expense_category').value;

        $.ajax({
            type: "POST",
            url: "../../process/admin/expense_entries.php",
            data: {
                method: 'expense_entries',
                user_id: user_id,
                amount: expense_amount,
                category: expense_category,
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
                    expense_table();
                    $('#add_expense').modal('hide');
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