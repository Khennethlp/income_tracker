<footer class="main-footer text-sm">
  Developed by: <em>Khennethlp</em>
  <div class="float-right d-none d-sm-inline-block">
    <strong>Copyright &copy;
      <script>
        var currentYear = new Date().getFullYear();
        if (currentYear !== 2024) {
          document.write("2024 - " + currentYear);
        } else {
          document.write(currentYear);
        };
      </script>.
    </strong>
    All rights reserved.
  </div>
</footer>
<?php
//MODALS
include '../../modals/logout_modal.php';
include '../../modals/timeout.php';
include '../../modals/income_entries.php';
include '../../modals/expense_entries.php';
include '../../modals/income_filter.php';
include '../../modals/expense_filter.php';
include '../../modals/savings.php';
include '../../modals/deposit.php';
include '../../modals/monthly_details.php';

?>

<script>
 document.addEventListener('DOMContentLoaded', function() {
    // Handle ASC checkbox
    $('#ascCheckbox').on('change', function() {
      if ($(this).is(':checked')) {
        $('#descCheckbox').prop('checked', false); // Uncheck the DESC checkbox
        $('label[for="descCheckbox"]').removeClass('active'); // Remove active class from DESC
        $('label[for="ascCheckbox"]').addClass('active'); // Add active class to ASC

        console.log('I am checked ASC');
      } else {
        $('label[for="ascCheckbox"]').removeClass('active'); // Remove active class from ASC
      }
    });
    
    // Handle DESC checkbox
    $('#descCheckbox').on('change', function() {
      if ($(this).is(':checked')) {
        $('#ascCheckbox').prop('checked', false); // Uncheck the ASC checkbox
        $('label[for="ascCheckbox"]').removeClass('active'); // Remove active class from ASC
        $('label[for="descCheckbox"]').addClass('active'); // Add active class to DESC
        console.log('I am checked DESC');
      } else {
        $('label[for="descCheckbox"]').removeClass('active'); // Remove active class from DESC
      }
    });

  });
</script>
<!-- jquery -->
<script src="../../plugins/jquery/dist/jquery.min.js"></script>
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>

<!-- datatable -->
<script src="../../plugins/DataTables/datatables.min.js"></script>
<script src="../../dist/js/chart.js"></script>
<script src="../../dist/js/chart.umd.min.js"></script>
<script type="text/javascript" src="../../plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="../../dist/js/core-popper.js"></script>
<script src="../../dist/js/dom-popper.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../../dist/js/adminlte.js"></script>
<script src="../../dist/js/popup_center.js"></script>
<script src="../../dist/js/session.js"></script>

</body>

</html>