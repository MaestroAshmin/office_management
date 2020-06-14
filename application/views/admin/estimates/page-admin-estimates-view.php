<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title;?></title>

    <style type="text/css" media="screen">
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
        .quotaion_date_block{
            float:right !important;
        }
        .thead-light th{border-color: black; background: #F9F9F9; border-bottom: none;}
    </style>

    <style type="text/css" media="print">
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
        .thead-light th{border-color: black; background: #F9F9F9; border-bottom: none;}
    </style>

</head>
<body>

<div style="background-color: #FFF;color: #000000;border-bottom: 2px solid #991b1e;">
    <table width="100%">
        <tr>
            <?php if($logo !=''){ ?>
                <td align="left" style="width: 5%; text-align: left;">
                    <img src="<?php echo site_url();?>img/company_logo/<?php echo $logo;?>" alt="Logo"class="logo" style="width:80px; margin-left: 60px;"/>
                </td>
            <?php } ?>
            <td align="center" style="width: 100%;">
                <h2><?php echo $company_name;?></h2>

                <?php if($company_address != ''){ ?>
                    <p><?php echo $company_address;?></p>
                <?php } ?>

                <?php if($company_contact != ''){ ?>
                    <small><b>Contact:</b> <?php echo $company_contact;?>,</small>
                <?php } ?>

                <?php if($company_email != ''){ ?>
                    <small><b>Email:</b> <?php echo $company_email;?>,</small>
                <?php } ?>

                <?php if($company_website != ''){ ?>
                    <small><b>Web:</b> <?php echo $company_website;?></small>
                <?php } ?>

            </td>
        </tr>

    </table>
</div>

<div style="float: right !important;margin-top:10px;">
       <table>
           <tr>
              <td>
                    <small>
                        <b>Quotation Date:</b> <?php echo $quote_details['quotation_date'];?>
                    </small>
                    <br/>
                    <small>
                        <b>Quotation Valid Date:</b> <?php echo $quote_details['quotation_valid_date'];?>
                    </small>
                    <br/>
                     <small>
                        <b>VAT No:</b> <?php echo $company_vat;?>
                    </small>
              </td>
           </tr>
       </table>
    </div>


<div class="invoice">
    <div style="margin-left:20px;">
       <table width="100%">
           <tr>
              <td align="left" style="width: 100%">
                    <small>
                        To,
                    </small>
                    <br/>
                    <?php 
                        $client_name = getClientData('client_name', $quote_details['client_id']);
                        if($client_name != ''){
                    ?>
                        <small>
                           <b><?php echo $client_name; ?>,</b>
                        </small>
                        <br/>
                    <?php } ?>
                    <?php 
                        $client_address = getClientData('client_address', $quote_details['client_id']);
                        if($client_address != ''){
                    ?>
                        <small>
                           <?php echo $client_address; ?>,
                        </small>
                        <br/>
                    <?php } ?>
              </td>
           </tr>
       </table>

       <table width="100%">
        <tr>
            <td align="center" style="width: 100%;">
                <p>
                    <b>Subject : </b><?php echo $quote_details['quotation_subject'];?>
                </p>
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td align="left">
                <p>
                    Dear Sir/Madam,
                    <br/>
                    <?php echo $quote_details['quotation_text'];?>
                </p>
            </td>
        </tr>
    </table>

    </div>
    
    <table style="border-collapse: collapse; border: 1px solid black;width: 100%">
        <thead class="thead-light">
            <tr>
                <th style="border-collapse: collapse; border: 1px solid black; text-align: left;">S.No</th>
                <th style="border-collapse: collapse; border: 1px solid black; text-align: left;">Item</th>
               
                <th style="border-collapse: collapse; border: 1px solid black; text-align: left;">Qty</th>
                <th style="border-collapse: collapse; border: 1px solid black; text-align: left;">Unit Price</th>
                <th style="border-collapse: collapse; border: 1px solid black; text-align: left;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                  $items_name_arr   = stringToArray($quote_details['items_name']);
                  $items_specs_arr  = stringToArray($quote_details['items_specs']);
                  $items_qty_arr    = stringToArray($quote_details['items_qty']);
                  $items_price_arr  = stringToArray($quote_details['items_price']);
                  $items_total_arr  = stringToArray($quote_details['items_total']);
                  $items_id_arr     = stringToArray($quote_details['item_ids']);

                    if(!empty($items_name_arr) && is_array($items_name_arr)){
                        $i = 1;
                        foreach($items_name_arr as $key => $row){
                            if($items_name_arr[$key] != ''){
            ?>
            <tr>
                <td style="border-collapse: collapse; border: 1px solid black;">
                    <?php echo $i;?>
                </td>
                <td style="border-collapse: collapse; border: 1px solid black;">
                    <p>
                        <?php 
                            echo '<b>'.$items_name_arr[$key].'</b>';

                            $item_brand =  getItemsDetails('item_brand', $items_id_arr[$key]);
                            if($item_brand != ''){
                                echo '<br/><b>'.$item_brand.'</b>';
                            }

                            $item_model = getItemsDetails('item_model', $items_id_arr[$key]);
                            if($item_model != ''){
                                echo '<br/><b>'.$item_model.'</b>';
                            }
                        ?>
                    </p>
                    <?php 
                        $image = getItemsImage($items_id_arr[$key]);
                        if($image != '' && file_exists('img/items/'.$image)){
                    ?>
                        <img src="<?php echo site_url();?>img/items/<?php echo $image;?>">
                        <br/>
                        <br/>
                    <?php       
                        }
                    ?>
                    <p>
                        Specification : <?php echo $items_specs_arr[$key];?>
                    </p>
                    

                </td>
                <td style="border-collapse: collapse; border: 1px solid black;">
                    <?php echo number_format($items_qty_arr[$key], 2);?>
                </td>
                <td style="border-collapse: collapse; border: 1px solid black;">
                    <?php echo number_format($items_price_arr[$key], 2);?>
                </td>
                <td style="border-collapse: collapse; border: 1px solid black;">
                    <?php echo number_format($items_total_arr[$key], 2);?>
                </td>
            </tr>
            

        <?php 
                    }
                $i++;
                } 
            }
        ?>


        <tr>
                <td colspan="4" style="border-collapse: collapse; border: 1px solid black; text-align: right"><b>Sub-Total</b></td>
                <td style="border-collapse: collapse; border: 1px solid black;"><?php echo number_format($quote_details['sub_total'],2);?></td>
            </tr>
            <tr>
                <td colspan="4" style="border-collapse: collapse; border: 1px solid black; text-align: right"><b>Discount %</b></td>
                <td style="border-collapse: collapse; border: 1px solid black;"><?php echo number_format($quote_details['discount_percent'], 2);?></td>
            </tr>

            <tr>
                <td colspan="4" style="border-collapse: collapse; border: 1px solid black; text-align: right"><b>VAT (13%)</b></td>
                <td style="border-collapse: collapse; border: 1px solid black;">
                    <?php 
                        $vat_amount = (13/100) * $quote_details['total'];

                        echo number_format($vat_amount, 2);
                    ?>      
                </td>
            </tr>

            <tr>
                <td colspan="4" style="border-collapse: collapse; border: 1px solid black; text-align: right"><b>Total</b></td>
                <td style="border-collapse: collapse; border: 1px solid black;">
                    <?php 
                        $grand_total = $vat_amount + $quote_details['total'];
                        
                        echo number_format($grand_total, 2);
                    ?>      
                </td>
            </tr>

        <tr>
            <td colspan="5" style="height:50px; border-collapse: collapse; border: 1px solid black; text-align: left"><b>In Words: </b><?php echo getNumbertoWords($grand_total);?></td>
            </tr>

        </tbody>
    </table>

    <br/>
    <br/>
    <table width="100%">
        <tr>
            <td align="left">
                <p>
                    ...........................
                    <br/>
                    For <?php echo $company_name;?>
                    <br/>
                    Date:  <?php echo date('Y-m-d');?>
                </p>
            </td>
        </tr>
    </table>
</div>


</body>
</html>