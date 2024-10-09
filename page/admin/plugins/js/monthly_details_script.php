<script>
    document.addEventListener("DOMContentLoaded", function(){

        var monthly_details_btn = document.getElementById('monthly_details_btn');

        monthly_details_btn.addEventListener('click', function(){
            const month = this.getAttribute('data-month');
            const year = this.getAttribute('data-year');

            console.log('Month: ', month, 'Year: ', year);
        });
    });
</script>