<?php 
$store_data = $this->model_stores->getStoresData($order_data['store_id']);
#print_r($order_data);echo '<br/>';print_r($orders_items);
$order_date = date('d/m/Y', $order_data['date_time']);
$paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";

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
                <td colspan="2">Order# <b><?php echo $order_data['bill_no'];?></b></td>
                <td style="float:right;">Date:<span><?php echo $order_date;?></span></td>
            </tr>
            <tr>
                <td colspan="2" style="border-bottom:1px dashed #000;">Cashier:POS</td>
                <td style="border-bottom:1px dashed #000;">Customer:<?php echo $order_data['customer_name']; ?><br><span>Phone #:<?php echo $order_data['customer_number']; ?></span></td>
            </tr>
            <tr>
                <th style="border-bottom:1px dashed #000;">Item</th>
                <th style="border-bottom:1px dashed #000;">Qty</th>
                <th style="border-bottom:1px dashed #000;text-align:right;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $item_ids = json_decode($orders_items[0]['product_id'],true);
            foreach ($item_ids as $k=>$pd)
            {$product_data = $this->model_products->getProductData($pd['product_id']); 
                ?>
                <tr>
                    <td><?php echo $product_data['name'];?><br/><span>(<?php echo $product_data['arabic_name'];?>)</span></td>
                    <td style="text-align:center;"><?php echo $pd['qty'];?></td>
                    <td style="width:25%;text-align:right;"><?php echo number_format($pd['subtot'],2);?></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <th colspan="2" style="border-top:1px dashed #dddddd;">Gross Amount</th>
                <th style="border-top:1px dashed #dddddd;text-align:right;"><?php echo $order_data['amount'];?></th>
            </tr>
            <tr>
                <td colspan="2">Discount</td>
                <th style="text-align:right;">0.00</th>
            </tr>
            <tr>
                <td colspan="2" style="border-bottom:1px dashed #dddddd;">Delivery Charges</td>
                <th style="text-align:right;border-bottom:1px dashed #dddddd;">0.00</th>
            </tr>
            <tr>
                <th colspan="2" style="border-bottom:1px dashed #000;">Net Amount</th>
                <th style="text-align:right;border-bottom:1px dashed #000;"><?php echo $order_data['amount'];?></th>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align:center;" >**Thank You, Please visit again**</td>
            </tr>
        </tfoot>
    </table>
</div>
</body>