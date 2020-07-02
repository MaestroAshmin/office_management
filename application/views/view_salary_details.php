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
            
            <div class="swipe-loader"></div>
            <div class="container table-responsive drag-scroll">
                <table class="table table-bordered" width = "100%" id="">
                    <thead class="thead-dark">
                        <tr>
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
                            <th scope="col">Print</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1;
                    foreach($salary_data as $data) { ?>
                        <tr>
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
                    <?php } ?>   
                    </tbody>
                </table>       
            </div>
        </div>
          <!-- Content Row -->
        </div>


        