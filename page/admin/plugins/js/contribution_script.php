<script>
    document.addEventListener("DOMContentLoaded", function() {
        contribution_table();
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
        $('#sss').val('');
        $('#philhealth').val('');
        $('#pagibig').val('');
    }

    const contribution_table = () => {
        var user_id = document.getElementById('user_id').value;
        $.ajax({
            type: "POST",
            url: "../../process/admin/contribution.php",
            data: {
                method: 'load_contribution',
                user_id: user_id
            },
            success: function(response) {
                $('#contribution_table').html(response);

            }
        });
    }

    const contribution_entries = () => {
        var user_id = document.getElementById('user_id').value;
        var sss = document.getElementById('sss').value;
        var philhealth = document.getElementById('philhealth').value;
        var pagibig = document.getElementById('pagibig').value;
        var month = document.getElementById('month').value;

        var clean_sss_amount = sss.replace(/[₱,]/g, '');
        var clean_philhealth_amount = philhealth.replace(/[₱,]/g, '');
        var clean_pagibig_amount = pagibig.replace(/[₱,]/g, '');

        var new_sss = parseFloat(clean_sss_amount);
        var new_philhealth = parseFloat(clean_philhealth_amount);
        var new_pagibig = parseFloat(clean_pagibig_amount);

        if (sss == '' || philhealth == '' || pagibig == '') {
            Swal.fire({
                icon: 'warning',
                title: 'SSS, Philhealth, and Pag-Ibig must not be empty.',
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }

        if (month == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Please, select a month for this contribution.',
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: "../../process/admin/contribution.php",
            data: {
                method: 'contribution_entry',
                user_id: user_id,
                sss: new_sss,
                philhealth: new_philhealth,
                pagibig: new_pagibig,
                month: month
            },
            success: function(response) {
                if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Contributions saved!',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    contribution_table();
                    $('#contributions').modal('hide');
                    clear();
                } else if (response == 'failed to update balance') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Sorry, something went wrong with your balance.',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    $('#contributions').modal('hide');
                    clear();
                } else if (response == 'failed to insert contributions') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Cannot submit your contributions. Please, Try again.',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    $('#contributions').modal('hide');
                    clear();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong.',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            }
        });
    }
</script>