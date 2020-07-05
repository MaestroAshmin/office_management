<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Salary Details</h1>
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
            <div class="container form-group col-12">
                <button class="btn btn-primary float-right" id="print_salary">Print</button>
            </div>
            <div class="swipe-loader"></div>
            <div class="col-12 container table-responsive drag-scroll">
                <table class="table calculated_salary_table" width = "100%" id="transaction">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">S.N</th>
                            <th scope="col">Date (FY Month)</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Gross Salary</th>
                            <th scope="col">Total Exemption</th>
                            <th scope="col">Tax Amount</th>
                            <th scope="col">Previous Advance</th>
                            <th scope="col">Deductions</th>
                            <th scope="col">Total Payable</th>
                            <th scope="col">Total Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1;
                    foreach($salary_data as $data) { ?>
                        <tr>
                           <td>
                                <input type="checkbox" name="print" value="<?php echo $data['id'] ?>">
                           </td>
                           <td><?php echo $i ?></td>
                           <td><?php echo $data['fiscal_year'].' '.$data['month'] ?></td>
                           <td><?php echo $data['name'] ?></td>
                           <td><?php echo $data['Designation'] ?></td>
                           <td><?php echo $data['monthly_total'] ?></td>
                           <td><?php echo $data['total_exemption'] ?></td>
                           <td><?php echo $data['monthly_tax'] ?></td>
                           <td><?php echo $data['previous_advance'] ?></td>
                           <td><?php echo $data['deductions'] ?></td>
                           <td><?php echo $data['total_payable'] ?></td>
                           <td><?php echo $data['monthly_total'] ?></td>
                        </tr>
                    <?php $i++; } ?>   
                    </tbody>
                </table>       
            </div>
        </div>
          <!-- Content Row -->
        </div>


        