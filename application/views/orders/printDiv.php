<?php
$store_data = $this->model_stores->getStoresData($order_data['store_id']);
#print_r($order_data);
$order_date = date('d/m/Y', $order_data['date_time']);
$paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";

$table_data = $this->model_tables->getTableData($order_data['table_id']);

if ($order_data['discount'] > 0) {
    $discount = $this->currency_code . ' ' .$order_data['discount'];
}
else {
    $discount = '0';
}
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
                <td colspan="3" style="border-bottom:1px dashed #dddddd;">Cashier:POS</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($orders_items as $k => $v)
            {$product_data = $this->model_products->getProductData($v['product_id']); #print_r($product_data);
                ?>
                <tr>
                    <td><?php echo $product_data['name'];?><br><span>(<?php echo $product_data['arabic_name'];?>)</span></td>
                    <td><?php echo $v['qty'];?></td>
                    <th style="text-align:right;"><?php echo $v['amount'];?></th>
                </tr>
            <?php
            }
            ?>
            <tr>
                <th colspan="2" style="border-top:1px dashed #dddddd;">Gross Amount</th>
                <th style="border-top:1px dashed #dddddd;text-align:right;"><?php echo 'Qr. ' .$order_data['gross_amount'];?></th>
            </tr>
            <tr>
                <td colspan="2">Discount</td>
                <th style="text-align:right;"><?php echo $discount;?></th>
            </tr>
            <tr>
                <td colspan="2" style="border-bottom:1px dashed #dddddd;">Delivery Charges</td>
                <th style="text-align:right;border-bottom:1px dashed #dddddd;">0.00</th>
            </tr>
            <tr>
                <th colspan="2" style="border-bottom:1px dashed #000;">Net Amount</th>
                <th style="text-align:right;border-bottom:1px dashed #000;"><?php echo $order_data['net_amount'];?></th>
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