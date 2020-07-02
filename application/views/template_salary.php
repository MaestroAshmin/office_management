<html>
<head>
    <title>Template</title>
</head>
<body>
        <?php for($i=0;$i<7;$i++){    
            if($i%2==0 && $i!=0){
                echo "<div style='clear:both'></div>";
            }
        ?>
        <div style="page-break-inside:avoid;width:340px;height:500px;float:left;margin-right:40px;">
            <table style="width:100%;">
                <tr>
                    <td colspan="2">
                        <b>Bonjour Management Pvt. Ltd.</b>
                    </td>
                </tr>
                <tr>
                    <td>Employee Name : </td>
                    <td>Ram Bahadur<?php echo $i; ?></td>
                </tr>
                <tr>
                    <td>Fiscal Year : </td>
                    <td>2056</td>
                </tr>
                <tr>
                    <td>Month : </td>
                    <td>Baisakh</td>
                </tr>
                <tr>
                    <td>Working Days : </td>
                    <td>25</td>
                </tr>
                <tr>
                    <td>Unpaid Leaves : </td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>Remain Advances : </td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>Insurance : </td>
                    <td>20000</td>
                </tr>
                <tr>
                    <td>Citizen Investment Trust : </td>
                    <td>20000</td>
                </tr>
                <tr>
                    <td>Providend Fund : </td>
                    <td>20000</td>
                </tr>
                <tr>
                    <td>Social Security : </td>
                    <td>20000</td>
                </tr>
                <tr>
                    <td>Total Exception : </td>
                    <td>60000</td>
                </tr>
                <tr>
                    <td>Annual Total Exception : </td>
                    <td>1000000</td>
                </tr>
                <tr>
                    <td>Insurance : </td>
                    <td>20000</td>
                </tr>
                <tr>
                    <td>Citizen Investment Trust : </td>
                    <td>20000</td>
                </tr>
                <tr>
                    <td>Providend Fund : </td>
                    <td>20000</td>
                </tr>
                <tr>
                    <td>Social Security : </td>
                    <td>20000</td>
                </tr>
                <tr>
                    <td>Total Exception : </td>
                    <td>60000</td>
                </tr>
                <tr>
                    <td>Annual Total Exception : </td>
                    <td>1000000</td>
                </tr>
            </table>
        </div>
        <?php 
        } 
        ?>
</body>
</html>