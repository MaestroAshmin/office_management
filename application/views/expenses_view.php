<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Expense View</h1>
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
            
            <div class="swipe-loader"></div>
            <div class="container table-responsive drag-scroll">
                <table class="table table-bordered" id="transaction">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Date (A.D)</th>
                            <th scope="col">Date (B.S)</th>
                            <th scope="col">Heading</th>
                            <th scope="col">Bill/Invoice No</th>
                            <th scope="col">Responsible Person</th>
                            <th scope="col">To</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Remarks</th>
                            <th scope="col">Details</th>
                            <th scope="col">Image & Report</th>
                            <?php if($role==1 || $dept==1){?>
                                <th scope="col">Action</th>
                            <?php }?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1;
                    foreach ($transactions as $transaction){
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $transaction['english_date']?></h5></td>
                            <td><?php echo $transaction['nepali_date']?></h5></td>
                            <td><h5><?php echo $transaction['Heading']?></h5></td>
                            <td><?php echo $transaction['bill_invoice_no']?></td>
                            <td><?php echo $transaction['responsible_person']?></td>
                            <td><?php echo $transaction['to_person']?></td>
                            <td><?php echo $transaction['Amount']?></td>
                            <td><?php echo $transaction['Remarks']?></td>
                            <td><?php echo $transaction['Details']?></td>
                            <td style="white-space: nowrap;">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".exampleModal" data-whatever="<?php echo $transaction['Image']?>">
                                View Receipt
                            </button>
                            <?php if($transaction['Excel']!='' || !empty($transaction['Excel'])){?>
                                <p>
                                    <?=anchor('images/'.$transaction['Excel'], 'Download Report')?>
                                </p>
                            <?php }else{?>
                                <p>No File</p>
                            <?php }?>
                            
                            </td>
                            <?php if($role==1 || $dept==1){?>
                                <td style="display: inline-block; width:150px;">
                                    <?php
                                    if($des==5 || $role==1){
                                        if($transaction['Status']==0){?>
                                            <a href="<?php echo site_url('user/update_expenses_status/'.$transaction['ID']) ?>" class="btn btn-success update_pending" style="display: inline-block">
                                            <i class="fas fa-check"></i></a>
                                        <?php }?>
                                            <a href="<?php echo site_url('user/expenses_update/'.$transaction['ID']) ?>" class="btn btn-primary" style="display: inline-block"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo site_url('user/expenses_delete/'.$transaction['ID']) ?>" class="delete btn btn-danger" data-confirm="Are you sure to delete this item?" style="display:inline-block"><i class="fa fa-trash"></i></a>
                                    <?php }else{ 
                                        if($transaction['Status']==0){?>
                                            <label id="unapproved">UnApproved</label>
                                        <?php }else{?>
                                            <label id="approved">Approved</label>
                                    <?php } }?>
                                </td>
                            <?php }?>
                        </tr>
                                    <?php 
                                    $i++;
                    } ?>
                        
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

        