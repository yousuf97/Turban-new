<?php #print_r($order_data);
$order_date = date('d/m/Y',  strtotime($order_data[0]['checkout_date']));
$check_items=json_decode($order_data[0]['checkout_items'],true);
?>
<style>
    @media print
    {
        #row
        {
            width:100% !important;
        }
    }
</style>
<body onload="window.print()">
    <div class="row" id="row" style="width:50%;margin:auto;" >
        <table class="" width="100%" style="font-size:9px;margin:2px;">
            <thead>
                <tr>
                    <th colspan="3">Nizami Cafe</th>
                </tr>
                <tr>
                    <th colspan="3" style="font-size:8px;"><span>Land2, Ezdan Oasis Road, Al Wukair Doha</span></th>
                </tr>
                <tr>
                    <td colspan="2">Order# <b><?php echo $order_data[0]['bill_no'];?></b></td>
                    <td style="float:right;">Date:<span><?php echo $order_date;?></span></td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom:1px dashed #000;">Cashier:POS</td>
                    <td style="border-bottom:1px dashed #000;">Customer:<?php echo $order_data[0]['name']; ?><br><span>Phone #:<?php echo $order_data[0]['phone']; ?></span></td>
                </tr>
                <tr>
                    <th style="border-bottom:1px dashed #000;">Item</th>
                    <th style="border-bottom:1px dashed #000;">Qty</th>
                    <th style="border-bottom:1px dashed #000;">Amount</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($check_items as $k => $v)
            {
                $product_data = $this->model_products->getProductData($v['prod_id']);
                ?>
                <tr>
                    <td><?php echo $v['prod_name'];?><br><span>(<?php echo $product_data['arabic_name'];?>)</span></td>
                    <td style="text-align:right;"><?php echo $v['qty'];?></td>
                    <td style="text-align:center;width:25%;"><?php echo $v['price']*$v['qty'];?>.00</td>
                </tr>
                <?php
            }
            ?>
                <tr>
                    <th colspan="2" style="border-top:1px dashed #000;">Gross Amount</th>
                    <th style="border-top:1px dashed #000;text-align:center;"><?php echo number_format($order_data[0]['total_price'],2);?></th>
                </tr>
                <tr>
                    <td colspan="">Discount</td>
                    <td style="text-align:right;">Qr.</td>
                    <th style="text-align:center;">0.00</th>
                </tr>
                <tr>
                    <td colspan="" style="border-bottom:1px dashed #000;">Delivery Charges</td>
                    <td style="border-bottom:1px dashed #000;text-align:right;">Qr.</td>
                    <th style="text-align:center;border-bottom:1px dashed #000;">0.00</th>
                </tr>
                <tr>
                    <th colspan="" style="border-bottom:1px dashed #000;">Net Amount</th>
                    <td style="border-bottom:1px dashed #000;text-align:right;">Qr.</td>
                    <th style="text-align:center ;border-bottom:1px dashed #000;font-weight:bold"><?php echo number_format($order_data[0]['total_price'],2);?></th>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align:center;" >**Thank You, Please visit again**</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-bottom:1px solid dotted #000000">
                        <span>Place:<?php echo $order_data[0]['place'];?></span><br>
                        <span>Zone:<?php echo $order_data[0]['zone'];?></span><br>
                        <span>Street:<?php echo $order_data[0]['street'];?></span><br>
                        <span>Building:<?php echo $order_data[0]['building'];?></span><br>
                        <span>Address:<?php echo $order_data[0]['address'];?></span><br>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>