<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Report</h1>
        </div>

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
            <div class="container col-lg-12">
                <table class="table report table-reponsive table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Date</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Follow up Date</th>
                            <th scope="col">Follow up(Round)</th>
                            <th scope="col">Contract Signed</th></th>
                            <th scope="col">Contract Category</th>
                            <th scope="col">Live</th>
                            <th scope="col">Active Seats</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1;
                    foreach($reports as $report){?>
                    <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $report['csv_date']?></td>
                            <td><?php echo $report['Name']?>, <?php echo $report['mobile_number']?>, <?php echo $report['Company']?>, <?php echo $report['Address']?></td>
                            <td><?php echo $report['date']?></td></th>
                            <td><?php echo $report['follow_up_round']?></td>
                            <td>
                                <?php echo ($report['Status'] == 'CONTRACT SIGNED') ?  'YES': 'NO' ?>
                            </td>
                            <td><?php echo $report['Purpose']?></td>
                            <td>
                                <?php echo ($report['Status'] == 'LIVE') ?  'YES': 'NO' ?>
                            </td>
                            <td>
                                <?php echo ($report['live_seat'] == 0 ) ?  'NO': $report['live_seat'] ?>
                            </td>
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