<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $title;?> - Bonjour Management Pvt. Ltd</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo site_url();?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo site_url();?>css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
  <link href="<?php echo site_url();?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" rel="stylesheet" href="<?php echo site_url();?>css/nepali.datepicker.v2.2.min.css">

<link rel="stylesheet" type="text/css" rel="stylesheet" href="<?php echo site_url();?>css/jquery-ui-themes-1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" rel="stylesheet" href="<?php echo site_url();?>css/jquery-ui-themes-1.12.1/jquery-ui.structure.min.css">
<link rel="stylesheet" type="text/css" rel="stylesheet" href="<?php echo site_url();?>css/jquery-ui-themes-1.12.1/jquery-ui.theme.min.css">
<!-- 
<link rel="stylesheet" type="text/css" rel="stylesheet" href="<?php echo site_url();?>css/jquery-ui-1.12.1/jquery-ui.min.css">
<link rel="stylesheet" type="text/css" rel="stylesheet" href="<?php echo site_url();?>css/jquery-ui-1.12.1/jquery-ui.structure.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" rel="stylesheet" href="<?php echo site_url();?>css/jquery-ui-1.12.1/jquery-ui.theme.min.css"> -->

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url();?>user/dashboard">
        <div class="sidebar-brand-text mx-3">Bonjour Management Pvt. Ltd</div>
  </a>

      <!-- Divider -->
      <!-- <hr class="sidebar-divider my-0"> -->

      <!-- Nav Item - Dashboard -->
      <!-- <li class="nav-item active">
        <a class="nav-link" href="<?php echo site_url();?>user/dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li> -->

      <!-- Divider -->
      <?php if($role==1){?>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url();?>user/add">
            <i class="fas fa-plus"></i>
            <span>Add</span>
          </a>
        </li>
      <?php }?>
       <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url();?>user/view">
          <i class="fas fa-eye"></i>
          <span>View</span>
        </a>
      </li>
      <?php if($role==1){?>
      <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user"></i>
            <span>Role Manager</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="<?php echo site_url();?>user/view_roles">View Roles</a>
              <a class="collapse-item" href="<?php echo site_url();?>user/add_role">View Role</a>
              <a class="collapse-item" href="<?php echo site_url();?>user/add_user">Add User</a>

            </div>
          </div>
        </li>
      <?php }?>

    </ul>
    <!-- End of Sidebar -->
     <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php 
                    $sess_data = $this->session->all_userdata();
                    echo $sess_data['user_fullname'];
                  ?>
                </span>
                <img class="img-profile rounded-circle" src="<?php echo site_url();?>img/avatar.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo site_url();?>user/settings">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo site_url();?>user/logout">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
