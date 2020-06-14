<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-medium;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-medium;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #FFF;
            color: #991b1e;
            border-bottom: 2px solid #991b1e;
        }

        .footer_information {
            background-color: #991b1e;
            color: #FFF;
            margin-bottom: 10px;
        }

        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
             <td align="left" style="width: 5%; text-align: left">
                <img src="<?php echo $logo;?>" alt="Logo" width="70" class="logo"/>
            </td>
            <td align="center" style="width: 45%;">
                <h2>Unified Communications Pvt. Ltd.</h2>
                <h3>Damak, State-1</h3>
                <h3>Nepal</h3>
            </td>

        </tr>

    </table>
</div>

<div class="invoice">
    <h3 style="text-align: center;">Fuel Request</h3>
    <div style="margin-left:20px;">

        <h5>Status: <?php echo $type;?></h5>
        <h5>From Date: <?php echo $from_date;?> - To Date: <?php echo $to_date;?></h3>
    </div>
    
    <table width="100%">
        <thead style=" background-color: #991b1e;color: #FFF;font-size: 13px">
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Kilometers</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if(!empty($results) && is_array($results)){
                    foreach($results as $result){
            ?>
            <tr>
                <td><?php echo $result['name'];?></td>
                <td><?php echo $result['position'];?></td>
                <td align="left"><?php echo number_format($result['km'], 2);?></td>
            </tr>
            <?php 
                    }
                }else{
            ?>
                <tr>
                        <td colspan="3"> No records Found</td>
                </tr>
            <?php     
            } 
            ?>
        </tbody>
    </table>
</div>

<div class="footer_information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="center" style="width: 50%;font-size: 15px;">
                &copy; <?php echo date('Y');?> Unified Communications Pvt. Ltd. - All rights reserved.
            </td>
        </tr>

    </table>
</div>
</body>
</html>