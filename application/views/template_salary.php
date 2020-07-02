<html>
<head>
    <title>Template</title>
</head>
<body>
        <?php for($i=0;$i<count($salary_data);$i++){    
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
                    <td><?php echo $salary_data[$i]['name'] ?></td>
                </tr>
                <tr>
                    <td>Designation : </td>
                    <td><?php echo $salary_data[$i]['Designation'] ?></td>
                </tr>
                <tr>
                    <td>Fiscal Year : </td>
                    <td><?php echo $salary_data[$i]['fiscal_year'] ?></td>
                </tr>
                <tr>
                    <td>Month : </td>
                    <td><?php echo $salary_data[$i]['month'] ?></td>
                </tr>
                <tr>
                    <td>Monthly Gross Salary : </td>
                    <td><?php echo $salary_data[$i]['monthly_total'] ?></td>
                </tr>
                <tr>
                    <td>Basic Salary</td>
                    <td><?php echo $salary_data[$i]['basic_salary'] ?></td>
                </tr>
                <tr>
                    <td>House Rent Allowance</td>
                    <td><?php echo $salary_data[$i]['house_rent'] ?></td>
                </tr>
                <tr>
                    <td>Food Allowance</td>
                    <td><?php echo $salary_data[$i]['food'] ?></td>
                </tr>
                <tr>
                    <td>Conveyance Allowance</td>
                    <td><?php echo $salary_data[$i]['conveyance'] ?></td>
                </tr>
                <tr>
                    <td>Other Allowance</td>
                    <td><?php echo $salary_data[$i]['other'] ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><?php echo $salary_data[$i]['monthly_total'] ?></td>
                </tr>
                <tr>
                    <td>Previous Advances : </td>
                    <td><?php echo $salary_data[$i]['previous_advance'] ?></td>
                </tr>
                <tr>
                    <td>Deductions : </td>
                    <td><?php echo $salary_data[$i]['deductions'] ?></td>
                </tr>
                <tr>
                    <td>Total Exemption : </td>
                    <td><?php echo $salary_data[$i]['total_exemption'] ?></td>
                </tr>
                <tr>
                    <td>Monthly Tax : </td>
                    <td><?php echo $salary_data[$i]['monthly_tax'] ?></td>
                </tr>
                <tr>
                    <td>Total Payable : </td>
                    <td><?php echo $salary_data[$i]['total_payable'] ?></td>
                </tr>
                <tr>
                    <td>Paid Amount : </td>
                    <td><?php echo $salary_data[$i]['monthly_total'] ?></td>
                </tr>
            </table>
        </div>
        <?php 
        } 
        ?>
</body>
</html>