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
                <table class="table table-bordered" id="">
                    <thead class="thead-dark">
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
                    <?php } ?> 
                    </tbody>
                </table>       
            </div>
        </div>

        