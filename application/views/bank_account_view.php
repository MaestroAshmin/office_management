<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bank Account View</h1>
          </div>

            <style>
            thead input {
                    width: 100%;
                }
                </style>
         <?php
            if($this->session->flashdata("error"))
            {
                foreach($this->session->flashdata("error") as $error){
                    echo '<p class="error">*'.$error.'</p>';
                }
            }
          ?>
          <!-- Content Row -->
        <div class="row">
            <div class="container d-flex align-items-center">
                <div class="radio_date_filter1">
                    <input type="radio" name="filtertable" value="day" />Today
                    <input type="radio" name="filtertable"  value="month"/>This Month
                    <input type="radio" name="filtertable"  value="year"/>This Year
                </div>
                <div id="date_filter">
                    <!-- <span id="date-label-from" class="date-label">Date From (A.D): 
                    </span>
                    <input class="date_range_filter date" id="from_date" type="text"/>
                    <span id="date-label-to" class="date-label">To: 
                    </span> -->
                    <!-- <input class="date_range_filter date datepicker_to" id="to_date" type="text"/> -->
                    <button class="btn reset_btn1">Reset</button>
                </div>
            </div>
         
            <div class="container table-responsive drag-scroll">
                <table class="table table-bordered" id="transaction">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Bank Name</th>
                            <th scope="col">Bank Account Type</th>
                            <th scope="col">Account No</th>
                            <th scope="col">Closing Balance</th>
                            <?php if($role==1 || $role ==2){?>
                                <th scope="col">Action</th>
                            <?php }?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1;
                    foreach ($accounts as $account){
                        ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><h5><?php echo $account['bank_name']?></h5></td>
                                <td><?php echo $account['account_type']?></td>
                                <td><?php echo $account['account_no']?></td>
                                <td><?php echo $account['closing_balance']?></td>
                                <?php if($role==1 || $role ==2){?>
                                    <td style="display: inline-block; width:150px;">
                                    <?php if($role == 1){?>
                                            <a href="<?php echo site_url('bankAccount/bank_account_update/'.$account['ID']) ?>" class="btn btn-primary" style="display: inline-block"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo site_url('bankAccount/bank_account_delete/'.$account['ID']) ?>" class="delete btn btn-danger" data-confirm="Are you sure to delete this item?" style="display:inline-block"><i class="fa fa-trash"></i></a>
                                    <?php }?>
                                    </td>
                                <?php }?>
                            </tr>
                        <?php 
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>       
            </div>
        </div>
          <!-- Content Row -->
        </div>
        <!-- <?php foreach($transactions as $transaction){ ?> -->
            <div class="modal fade exampleModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <img src="" id="receipt_image">
                    </div>
                </div>
            </div>
        <!-- <?php }?> -->

        