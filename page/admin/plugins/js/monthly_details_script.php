<script>
    document.addEventListener("DOMContentLoaded", function() {
    var monthly_details_btn = document.querySelectorAll('.monthly_details_btn');

    monthly_details_btn.forEach(button => {
        button.addEventListener('click', function() {
            const month = this.getAttribute('data-month');
            const year = this.getAttribute('data-year');

            console.log('Month: ', month, 'Year: ', year);

            // Move the AJAX request inside the button click event
            $.ajax({
                type: "POST",
                url: "../../process/admin/monthly_details.php",
                data: {
                    month: month,
                    year: year
                },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);

                    var income_table_body = document.getElementById('income_table_body');
                    var expense_table_body = document.getElementById('expense_table_body');

                   if (income_table_body && expense_table_body) {
                        // Clear the table before inserting new rows
                        income_table_body.innerHTML = '';
                        expense_table_body.innerHTML = '';

                        // Insert the new rows into the table body
                        income_table_body.innerHTML = jsonResponse.data_income;
                        expense_table_body.innerHTML = jsonResponse.data_expense;
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error occurred: ', status, error);
                }
            });
        });
    });
});

</script>