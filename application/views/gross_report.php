<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gross Report</h1>
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
         
            <div class="container table-responsive drag-scroll">
                <table class="table" id="transaction">
                    <thead>
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Bus Company</th>
                            <th scope="col">Status</th>
                            <th scope="col">Number of Bus/es</th>
                            <th scope="col">Number of Seats</th>
                            <th scope="col">Live Seats</th>
                            <th scope="col">Employee</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1;
                    foreach ($reports as $report){?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $report['Company'] ?></td>
                            <td><?php echo $report['Status'] ?></td>
                            <td><?php echo $report['number_of_bus'] ?></td>
                            <td><?php echo $report['number_of_seat'] ?></td>
                            <td><?php echo $report['live_seat'] ?></td>
                            <td><?php echo $report['Name'] ?></td>
                        </tr>
                    <?php 
                $i++;
                } ?> 
                    </tbody>
                </table>       
            </div>
        </div>

        