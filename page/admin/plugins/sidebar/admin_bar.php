<aside class="main-sidebar sidebar-light-primary sidebar-light-primary elevation-0" id="sidebar">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link" style="background-color: #306BAC; color: #fff;">
    <img src="../../dist/img/coffee.gif" alt="Logo" class="brand-image img-circle " style="opacity: .8">
    <span class="brand-text font-weight-light text-uppercase">&ensp; <?=$title;?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../dist/img/user.gif" class="img-circle" alt="User Image">
      </div>
      <div class="info">
        <a href="index.php" class="d-block"><?= htmlspecialchars($_SESSION['name']); ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/income/page/admin/index.php") { ?>
            <a href="index.php" class="nav-link active">
            <?php } else { ?>
              <a href="index.php" class="nav-link">
              <?php } ?>
              <!-- <i class="nav-icon fa fa-tachometer-alt"></i> -->
              <img src="../../dist/img/Pinwheel.gif" height="25" width="25">&nbsp;&nbsp;&nbsp;
              <p style="margin-left: 30px;">
                Overview
              </p>
              </a>
        </li>
        <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/income/page/admin/transaction.php") { ?>
            <a href="transaction.php" class="nav-link active">
            <?php } else { ?>
              <a href="transaction.php" class="nav-link">
              <?php } ?>
              <!-- <i class="nav-icon fa fa-tachometer-alt"></i> -->
              <img src="../../dist/img/Fidget.gif" height="25" width="25" >&nbsp;&nbsp;&nbsp;
              <p style="margin-left: 30px;">
                Transactions
              </p>
              </a>
        </li>
        <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/income/page/admin/contribution.php") { ?>
            <a href="contribution.php" class="nav-link active">
            <?php } else { ?>
              <a href="contribution.php" class="nav-link">
              <?php } ?>
              <!-- <i class="nav-icon fa fa-tachometer-alt"></i> -->
              <img src="../../dist/img/Fidget.gif" height="25" width="25" >&nbsp;&nbsp;&nbsp;
              <p style="margin-left: 30px;">
                Contributions
              </p>
              </a>
        </li>
        <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/income/page/admin/report.php") { ?>
            <a href="report.php" class="nav-link active">
            <?php } else { ?>
              <a href="report.php" class="nav-link">
              <?php } ?>
              <!-- <i class="nav-icon fa fa-tachometer-alt"></i> -->
              <img src="../../dist/img/Pacman.gif" height="25" width="25" >&nbsp;&nbsp;&nbsp;
              <p style="margin-left: 30px;">
                Reports
              </p>
              </a>
        </li>
        <li class="nav-item">
          <?php if ($_SERVER['REQUEST_URI'] == "/income/page/admin/settings.php") { ?>
            <a href="settings.php" class="nav-link active">
            <?php } else { ?>
              <a href="settings.php" class="nav-link">
              <?php } ?>
              <!-- <i class="nav-icon fa fa-tachometer-alt"></i> -->
              <img src="../../dist/img/Settings.gif" height="25" width="25" >&nbsp;&nbsp;&nbsp;
              <p style="margin-left: 30px;">
                Settings
              </p>
              </a>
        </li>
        

       
        <?php include 'logout.php'; ?>
      </ul>
    </nav>
  </div>
  <div class="sidebar-bottom">
    <p class="text-muted text-center" style="font-size: 11px; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);">Version 1.0.0</p>
  </div>
</aside>