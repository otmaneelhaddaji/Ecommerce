<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


<div class="container">

    <div class="row">

        <h1>Checkout</h1>
        <h4 class="text-center bg-danger"><?php display_message(); ?></h4>
        
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="business" value="houtf@business.com">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="upload" value="1">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Sub-total</th>

                    </tr>
                </thead>
                <tbody>
                    <?php cart(); ?>
                </tbody>
            </table>
            <?php echo show_paypal(); ?> 
        </form>


        <div class="col-xs-4 pull-right ">
            <h2>Cart Totals</h2>

            <table class="table table-bordered" cellspacing="0">

                <tr class="cart-subtotal">
                    <th>Items:</th>
                    <td><span class="amount"><?php echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0" ?></span></td>
                </tr>
                <tr class="shipping">
                    <th>Shipping and Handling</th>
                    <td>Free Shipping</td>
                </tr>

                <tr class="order-total">
                    <th>Order Total</th>
                    <td><strong><span class="amount">MAD <?php echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0.00" ?></span></strong> </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
    <hr>
</div>

<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>