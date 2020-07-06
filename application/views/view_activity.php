<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Activity</h1>
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

            <div class="swipe-loader"></div>
                <div class="col-12 container">
                    <div class="radio_date_filter1">
                        <input type="radio" name="filtertable" value="day" />Today
                        <input type="radio" name="filtertable"  value="month"/>This Month
                        <input type="radio" name="filtertable"  value="year"/>This Year
                        <button class="reset_btn1">Reset</button>
                    </div>
                </div>
                <div class="col-12 container table-responsive drag-scroll">
                    <table class="table" id='transaction'>
                        <thead>
                            <tr>
                                <th scope="col" style="width:40px;">S.N</th>
                                <th scope="col">Entry Date</th>
                                <th scope="col">Task Undertaken</th>
                                <th scope="col">Progress</th>
                                <th scope="col">Remarks</th>
                                <th scope="col">Assigned To/By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        foreach ($activity as $act){ ?>
                            <tr>
                            <td><?php echo $i ?></td>

                                <td scope="col" style="width:150px;"><?php echo $act['entry_date']?></td>
                                <td scope="col" style="width:250px;"><?php echo $act['task_undertaken']?></td>
                                <td scope="col"><?php echo $act['progress']?></td>
                                <td scope="col" style="width:150px;"><?php echo $act['remarks']?></td>
                                <td scope="col" style="width:250px;"><?php echo $act['name']?>(By)</td>
                                <td>
                                <a href="<?php echo site_url('user/get_each_activity/'.$act['a_id'])?>" class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                </a>
                            </td>
                            </tr>
                        <?php 
                            $i++;
                            }
                        foreach ($activity_target as $act_target){ ?>
                            <tr>
                            <td><?php echo $i ?></td>

                                <td scope="col" style="width:150px;"><?php echo $act_target['date']?></td>
                                <td scope="col" style="width:250px;"><?php echo $act_target['title']?></td>
                                <td scope="col" style="width:250px;"><?php echo $act_target['task_details']?></td>
                                <td scope="col" style="width:150px;"><?php echo $act_target['remarks']?></td>
                                <td scope="col" style="width:250px;"><?php echo $act_target['name']?>(To)</td>
                                <td>
                                <a href="<?php echo site_url('user/get_each_activity_target/'.$act_target['t_id'])?>" class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                </a>
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