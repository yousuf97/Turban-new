<?php
    $total=0;
    $cart_items=$this->cart->contents();
    if($cart_items)
    {
        foreach($cart_items as $cart_item => $c) {
            $total = $total + $c['subtotal'];
        }	
    }
?>
<footer class="main-footer text-center" id="ui_footer">
    <span>
    Total:<span class="total_price">Qr.<?php if(isset($total)){ echo $total; } else { echo '00';} ?></span>&nbsp;&nbsp;&nbsp; <button class="btn btn-success" onclick="view_order()">View Order</button>
    </span>
</footer>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade fade in" tabindex="-1" role="dialog" id="view_modal">
                    <div class="modal-dialog" style="width: 50% !important;" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-dark">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                <h4 class="modal-title">Your Order</h4>
                            </div>
                            <div class="modal-body" id="updatecart">
                                
                                
                            </div>
                            <div class="modal-footer">
                                <p><span>Add additional notes:</span><textarea class="additional-notes" rows="4"></textarea></p>
                                <a class="btn btn-info pull-left" data-dismiss="modal">Close</a>
                                <button type="button" onclick="place_order()" class="btn btn-success pull-right">Add Items</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
            </div>
        </div>
    </div>
</section>

</body>
</html>

<script>
    function view_order()
    {
		$.ajax({
            type:'post',
            data:'',
            url:'./User_interface/update_model',
            success:function(data)
            {
				$("#updatecart").html(data);
				$("#view_modal").modal('show');
            }
        });
        
    }
	function remove_cart(i)
    {
        $.ajax({
            type:'post',
            data:'rowid='+i,
            url:'./User_interface/remove_cart',
            success:function(data)
            {
				$("#updatecart").html(data);
				var total = $(".modal-cart-total").html();
				$(".main-footer .total_price").html(total);
            }
        });
    }
	function increase_cart(i,j)
    {
        var qty=$("#qty"+j).html();
        var new_qty=Number(qty)+1;
        $("#qty"+j).html(new_qty);
        $.ajax({
            type:'post',
            data:'qty='+new_qty+'&rowid='+i,
            url:'./User_interface/update_cart',
            success:function(data)
            {
                $("#updatecart").html(data);
				var total = $(".modal-cart-total").html();
				$(".main-footer .total_price").html(total);
            }
        }); 
    }
	function decrease_cart(i,j)
    {
        var qty=$("#qty"+j).html();
        var new_qty=Number(qty)-1;
        $("#qty"+j).html(new_qty);
        $.ajax({
            type:'post',
            data:'qty='+new_qty+'&rowid='+i,
            url:'./User_interface/update_cart',
            success:function(data)
            {
                $("#updatecart").html(data);
				var total = $(".modal-cart-total").html();
				$(".main-footer .total_price").html(total);
            }
        });
    }
    function place_order() {
        var amount=$(".modal-cart-total").html();
        var add_notes=$(".additional-notes").val();
        $.ajax({
            type:'post',
            data:'amt='+amount+'&notes='+add_notes,
            url:'./User_interface/create_order',
            success:function(data)
            {
                location.reload();
            }
        });
    }
</script>
</body>
</html>

