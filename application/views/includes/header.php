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


    <!-- Custom styles for this page -->
  <link href="<?php echo site_url();?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" real="text/css">
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

  <!-- Custom styles for this template-->
  <link href="<?php echo site_url();?>css/sb-admin-2.css" rel="stylesheet">
  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url();?>user/dashboard">
        <div class="sidebar-brand-text mx-3">Bonjour Management Pvt. Ltd</div>
  </a>
      <!-- Divider -->
      <?php if($role==1 || $role==2 || $dept==1){?>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-user"></i>
            <span>Income</span>
          </a>
          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <?php if($role==1 || $dept==1){?>
              <a class="collapse-item" href="<?php echo site_url();?>income/income_add">Add</a>
            <?php }?>
              <a class="collapse-item" href="<?php echo site_url();?>income/income_view">View</a>
            </div>
          </div>
      <?php } ?>

      <?php if($role==1 || $role==2 || $dept==1){?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user"></i>
            <span>Expenses</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <?php if($role==1 || $dept==1){?>
              <a class="collapse-item" href="<?php echo site_url();?>user/expenses_add">Add</a>
            <?php }?>
              <a class="collapse-item" href="<?php echo site_url();?>user/expenses_view">View</a>
            </div>
          </div>
        </li>
      <?php } ?>
      
      <?php if($role==1 || $dept==1){?>

         <!-- Nav Item - Pages Collapse Menu -->
         <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-user"></i>
            <span>Equity</span>
          </a>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="<?php echo site_url();?>equity/equity_add">Add</a>
              <a class="collapse-item" href="<?php echo site_url();?>equity/equity_view">View</a>
            </div>
          </div>
        </li>

        
         <!-- Nav Item - Pages Collapse Menu -->
         <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-user"></i>
            <span>Bank Accounts</span>
          </a>
          <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="<?php echo site_url();?>bankAccount/bank_account_add">Add</a>
              <a class="collapse-item" href="<?php echo site_url();?>bankAccount/bank_account_view">View</a>
            </div>
          </div>
        </li>
      <?php }?>

      <?php if($role==1){?>
      <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
            <i class="fas fa-user"></i>
            <span>Role Manager</span>
          </a>
          <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="<?php echo site_url();?>user/view_roles">View User</a>
              <a class="collapse-item" href="<?php echo site_url();?>user/add_user">Add User</a>
              <a class="collapse-item" href="<?php echo site_url();?>user/add_role">View/Add Role</a>
            </div>
          </div>
        </li>
      <?php }?>
      <?php if($dept==3){ ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url();?>user/view_contact">
            <i class="fa fa-address-book"></i>
            <span>View Contacts</span>
          </a>
        </li>
      <?php
       }
      ?>
      <?php if($role==1 || $role==3){?>

      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
            <i class="fas fa-user"></i>
            <span>Employee Report</span>
          </a>

            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseActivity" aria-expanded="true" aria-controls="collapseActivity">Activities Report</a>
                <?php if($dept==2 || $role==1){?>
                  <a class="collapse-item" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseContact" aria-expanded="true" aria-controls="collapseContent">Contact Management</a>
                  <a class="collapse-item" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTarget" aria-expanded="true" aria-controls="collapseTarget">Target Report</a>
                  <a class="collapse-item" href="<?php echo site_url();?>user/report_generate">Generate Report</a>
                  <a class="collapse-item" href="<?php echo site_url();?>grossReport/gross_report">Gross Report</a>
                <?php } ?>
              </div>
            </div>
            <div id="collapseContact" class="collapse" aria-labelledby="headingContent" data-parent="#accordionSidebar">
              <div class="bg-white py-1 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo site_url();?>user/view_contact">View Contacts</a>
                <a class="collapse-item" href="<?php echo site_url();?>user/add_contact">Add Contact</a>
              </div>
            </div>
            <div id="collapseActivity" class="collapse" aria-labelledby="headingActivity" data-parent="#accordionSidebar">
              <div class="bg-white py-1 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo site_url();?>user/view_activity">View Tasks</a>
                <a class="collapse-item" href="<?php echo site_url();?>user/add_daily_task">Add Daily Activity</a>
              </div>
            </div>
            <div id="collapseTarget" class="collapse" aria-labelledby="headingTarget" data-parent="#accordionSidebar">
              <div class="bg-white py-1 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo site_url();?>user/view_target">View Target</a>
                <?php if($role==1){ ?>
                <a class="collapse-item" href="<?php echo site_url();?>user/add_target">Add Target</a>
                <?php } ?>
              </div>
            </div>
        </li>
      <?php } ?>
      <?php if($role==1 || $role==2 || $dept==1){?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTax" aria-expanded="true" aria-controls="collapseTax">
            <i class="fas fa-user"></i>
            <span>Tax Structure</span>
          </a>
          <div id="collapseTax" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <?php if($role==1 || $dept==1){?>
              <a class="collapse-item" href="<?php echo site_url();?>tax/add_fiscal_year">Add Fiscal Year</a>
              <a class="collapse-item" href="<?php echo site_url();?>tax/add_tax_structure">Add Tax Structure</a>
            <?php }?>
              <a class="collapse-item" href="<?php echo site_url();?>tax/view_tax_structure">View Tax Structure</a>
              <a class="collapse-item" href="<?php echo site_url();?>salary/salary_table">Salary Table</a>
              <a class="collapse-item" href="<?php echo site_url();?>salary/view_salary_details">View/Print Salary Details</a>

            </div>
          </div>
        </li>
      <?php } ?>

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
