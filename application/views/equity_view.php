<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Equity View</h1>
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
                            <th scope="col">S.N</th>
                            <th scope="col">Date (A.D)</th>
                            <th scope="col">Date (B.S)</th>
                            <th scope="col">Depositor</th>
                            <th scope="col">Status</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Remarks</th>
                            <?php if($role==1 || $role ==2){?>
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
                                <td><h5><?php echo $transaction['Depositor']?></h5></td>
                                <td><?php echo $transaction['Status']?></td>
                                <td><?php echo $transaction['Amount']?></td>
                                <td><?php echo $transaction['Remarks']?></td>
                                <?php if($role==1 || $role ==2){?>
                                    <td style="display: inline-block; width:150px;">
                                    <?php if($role == 1){?>
                                            <a href="<?php echo site_url('equity/equity_update/'.$transaction['ID']) ?>" class="btn btn-primary" style="display: inline-block"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo site_url('equity/equity_delete/'.$transaction['ID']) ?>" class="delete btn btn-danger" data-confirm="Are you sure to delete this item?" style="display:inline-block"><i class="fa fa-trash"></i></a>
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

        