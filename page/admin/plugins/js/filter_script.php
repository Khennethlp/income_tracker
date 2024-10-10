<script>
    document.addEventListener("DOMContentLoaded", function(){
        document.getElementById('ascCheckbox').addEventListener('change', function() {
           if (this.checked) {
               document.getElementById('descCheckbox').checked = false;
           }
       });
   
       document.getElementById('descCheckbox').addEventListener('change', function() {
           if (this.checked) {
               document.getElementById('ascCheckbox').checked = false;
           }
       });
    });

    const filter = () => {
        var sort_asc = document.getElementById('ascCheckbox').checked;
        var sort_desc = document.getElementById('descCheckbox').checked;

        var category = document.getElementById('category').value;

        var sortOrder = '';
        if (sort_asc) {
            sortOrder = 'asc';
        } else if (sort_desc) {
            sortOrder = 'desc';
        }

        $.ajax({
            type: "POST",
            url: "../../process/admin/filter.php",
            data: {
                sortOrder: sortOrder,
                category: category
            },
            success: function(response) {
                document.getElementById('income_table').innerHTML = response;
                console.log(sortOrder);
            }
        });
    }
</script>