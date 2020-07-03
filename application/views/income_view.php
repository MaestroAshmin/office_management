<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Income View</h1>
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
                    <button class="reset_btn1">Reset</button>
                </div>
            </div>
         
            <div class="swipe-loader"></div>
            <div class="container table-responsive drag-scroll">
                <table class="table" id="transaction">
                    <thead>
                        <tr>
                            <th scope="col" style="width:40px;">S.N</th>
                            <th scope="col">Date (A.D)</th>
                            <th scope="col">Date (B.S)</th>
                            <th scope="col">Heading</th>
                            <th scope="col">Bill/Invoice No</th>
                            <th scope="col">Responsible Person</th>
                            <th scope="col">From</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Remarks</th>
                            <th scope="col">Details</th>
                            <th scope="col">Image & Report</th>
                            <?php if($role==1 || $dept ==1){?>
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
                                <td ><?php echo $i ?></td>
                                <td><?php echo $transaction['english_date']?></h5></td>
                                <td><?php echo $transaction['nepali_date']?></h5></td>
                                <td><h5><?php echo $transaction['Heading']?></h5></td>
                                <td><?php echo $transaction['bill_invoice_no']?></td>
                                <td><?php echo $transaction['responsible_person']?></td>
                                <td><?php echo $transaction['from_person']?></td>
                                <td><?php echo $transaction['Amount']?></td>
                                <td><?php echo $transaction['Remarks']?></td>
                                <td><?php echo $transaction['Details']?></td>
                                <td>
                                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target=".exampleModal" data-whatever="<?php echo $transaction['Image']?>">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <?php if($transaction['Excel']!='' || !empty($transaction['Excel'])){?>
                                    <a class="btn btn-success" style="margin-left:5px;" href="<?php echo site_url().'images/'.$transaction['Excel']?>"><i class="fas fa-file-excel"></i></a>
                                <?php }else{?>
                                    <p>No File</p>
                                <?php }?>
                                
                                </td>
                                <?php if($role==1 || $dept ==1){?>
                                    <td style="display: inline-block; width:150px;">
                                    <?php if($role == 1 || $des==5){?>
                                        <?php if($transaction['Status']==0){?>
                                            <a href="<?php echo site_url('income/update_income_status/'.$transaction['ID']) ?>" class="btn btn-success update_pending" style="display: inline-block">
                                            <i class="fas fa-check"></i></a>
                                        <?php }?>
                                            <a href="<?php echo site_url('income/income_update/'.$transaction['ID']) ?>" class="btn btn-primary" style="display: inline-block"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo site_url('income/income_delete/'.$transaction['ID']) ?>" class="delete btn btn-danger" data-confirm="Are you sure to delete this item?" style="display:inline-block"><i class="fa fa-trash"></i></a>
                                    <?php }else{ 
                                        if($transaction['Status']==0){ ?>
                                            <label id="unapproved">UnApproved</label>
                                        <?php }else{?>
                                            <label id="approved">Approved</label>
                                    <?php } }?>
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

        