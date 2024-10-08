<script>
    $(document).ready(function() {
        // Handle form submission
        $('#csvFileForm').on('submit', function(event) {
            event.preventDefault(); // Prevent form from submitting traditionally

            var formData = new FormData();
            var fileInput = $('#csvFileInput')[0].files[0]; // Get the uploaded file

            if (!fileInput) {
                alert("Please select a CSV file to upload.");
                return;
            }

            formData.append('csvFile', fileInput); // Append file to FormData object

            $.ajax({
                url: '../../process/admin/file_upload.php', // URL of PHP file to handle upload
                type: 'POST',
                data: formData,
                processData: false, // Do not process data
                contentType: false, // Do not set content-type
                success: function(response) {
                    $('#table_file').html(response); // Load the returned table into the div
                    $('#uploadBtn').css('display', 'block');
                    $('#entry_category').css('display', 'block');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Error uploading file.');
                }
            });
        });
    });

    // Handle the "Upload" button click to import CSV data into the database
    $('#uploadBtn').on('click', function() {
        var user_id = document.getElementById('user_id').value;
        var entry_category = document.getElementById('entry_category').value;

        if (entry_category == '') {
            Swal.fire({
                icon: 'warning',
                title: 'Oops! Please select entry category.',
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        // Read the table data and send it for processing
        var tableData = [];
        $('#table_file tbody tr').each(function() {
            var row = [];
            $(this).find('td').each(function() {
                row.push($(this).text()); // Extract table cell data
            });
            tableData.push(row); // Add row data to tableData array
        });

        // Send the data via AJAX to the backend for importing to the database
        $.ajax({
            url: '../../process/import/import_income.php', // URL to handle CSV data import
            type: 'POST',
            data: {
                tableData: tableData,
                user_id: user_id,
                entry_category: entry_category
            },
            success: function(response) {
                if (response === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Imported Successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Data Import Failed',
                        text: response,
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Data Import Error',
                    text: error,
                });
            }
        });
    });
</script>