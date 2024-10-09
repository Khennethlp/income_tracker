<?php
//SESSION
include '../../process/login.php';

if (!isset($_SESSION['username'])) {
  header('location:../../');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?> - Admin</title>


  <link rel="icon" href="../../dist/img/coffee.gif" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../../dist/css/font.min.css">

  <link rel="stylesheet" href="../../plugins/DataTables/datatables.min.css">
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="../../dist/css/datatable/dataTables.dataTables.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="../../plugins/sweetalert2/dist/sweetalert2.min.css">

  <link rel="stylesheet" href="../../plugins/datatable/dist/dataTables.dataTables.min.css">


  <style>
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #536A6D;
      width: 50px;
      height: 50px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(1080deg);
      }
    }

    .active {
      background-color: #275DAD !important;
      /*#000EA4*/
      border-bottom: 2px solid #9DD1F1 !important;
      color: #fff;
    }


    /* Style the button */
    .add-btn {
      display: block;
      /* Visible by default */
      position: fixed;
      /* Fixed/sticky position */
      bottom: 50px;
      /* Place the button at the bottom of the page */
      right: 30px;
      /* Place the button 30px from the right */
      z-index: 99;
      /* Make sure it appears on top of other elements */
      border: none;
      /* Remove borders */
      outline: none;
      /* Remove outline */
      background-color: #275DAD;
      /* Dark background */
      color: white;
      /* White text */
      padding: 10px 17px;
      /* Some padding */
      font-size: 20px;
      /* Increase font size */
      cursor: pointer;
      /* Pointer/hand icon on hover */
      border-radius: 100%;
      /* Rounded corners */
    }

    .add-btn:hover {
      background-color: #276DBD;
      /* Darker background on hover */
    }

    .dateRange_btn {
      border-radius: 50px;
    }

    .dateRange_btn:hover {
      background-color: #f3f3f3;
    }

    .btn_confirm {
      background: #3765AA !important;
      color: #ffffff;
      height: 34px;
      border-radius: 15px;
      font-size: 15px;
      font-weight: normal;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .btn_confirm:hover {
      color: #f3f3f3;
    }

    .btnSort {
      border-radius: 15px;
    }

    .btnSort:hover {
      background-color: #f3f3f3;
    }

    input[type=text],
    input[type=number],
    input[type=date],
    textarea,
    select {
      border-radius: 15px;
    }

    .filter {
      font-size: 15px;
      color: #847C8D;
      padding: 8px 12px;
      border: 2px solid #E0DEE3;
      border-radius: 15px;
      margin-bottom: 5px;
    }

    .filter:hover {
      color: #524C57;
    }

    /* Style for the button labels */
    .btn-sort {
      border-radius: 15px;
      display: inline-block;
      padding: 8px 18px;
      background-color: #f0f0f0;
      color: #333;
      border: 1px solid #ccc;
      cursor: pointer;
      transition: background-color 0.3s ease, color 0.3s ease;
      margin-right: 10px;
      font-size: 13px;
    }

    /* Active (checked) state */
    .btn-sort.active {
      background-color: #007bff;
      color: #fff;
      border-color: #007bff;
    }

    /* Hide the actual checkbox */
    .sort-checkbox {
      display: none;
    }

    .active-nav .icon-image {
      filter: brightness(0) invert(1);
    }

    .icon-image {
      filter: none;/
    }
  </style>
</head>

<!-- sidebar-collapse sidebar-mini-->
<div id="preloader" class="preloader flex-column justify-content-center align-items-center">
  <img class="" src="../../dist/img/loader.gif" alt="logo" height="60" width="60">
</div>
<!-- sidebar-collapse -->
<body class="hold-transition sidebar-mini layout-fixed ">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-light" style="background-color: #F5F5F5;">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-black" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>