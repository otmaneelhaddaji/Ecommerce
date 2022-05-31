<?php require_once("config.php"); ?>

<?php

if (isset($_GET['add'])) {
    $query = query("SELECT *FROM products WHERE product_id = " . escape_string($_GET['add']) . " ");
    confirm($query);

    while ($row = fetch_array($query)) {
        if ($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
            $_SESSION['product_' . $_GET['add']]++;
            redirect("../public/checkout.php");
        } else {
            set_message("We only have " . $row['product_quantity'] . " of the " . $row['product_title'] . "s " . "available.");
            redirect("../public/checkout.php");
        }
    }

}


if (isset($_GET['remove'])) {
    $_SESSION['product_' . $_GET['remove']]--;
    if ($_SESSION['product_' . $_GET['remove']] < 1) {
        unset($_SESSION['item_total']);
        unset($_SESSION['item_quantity']);
        redirect("../public/checkout.php");
    } else {
        redirect("../public/checkout.php");
    }
}


if (isset($_GET['delete'])) {
    $_SESSION['product_' . $_GET['delete']] = '0';
    unset($_SESSION['item_total']);
    unset($_SESSION['item_quantity']);
    redirect("../public/checkout.php");
}


function cart()
{
    $total = 0;
    $item_quantity = 0;
    $item_name = 1;
    $item_number = 1;
    $amount = 1;
    $quantity = 1;

    foreach ($_SESSION as $name => $value) {

        if ($value > 0) {
            if (substr($name, 0, 8) == "product_") {
     
                $length = strlen($name);
                $id = substr($name, 8, $length);

                $query = query("SELECT * FROM products WHERE product_id =" . escape_string($id) . " ");
                confirm($query);

                while ($row = fetch_array($query)) {
       
                    $sub = $row['product_price'] * $value;
                    $item_quantity += $value;
                    $currency_convert = $row['product_price'] * 0.06;

                    $product = <<< DELIMETER
                        <tr>
                            <td>{$row['product_title']}<br>
                            <img width='60' src ='{$row['product_image']}'>
                            </td>
                            <td>MAD {$row['product_price']}</td>
                            <td>{$value}</td>
                            <td>MAD {$sub}</td>
                            <td><a class='btn' href="../resources/cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a><a class='btn' href="../resources/cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></a><a class='btn' href="../resources/cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></a></td>
                        </tr>
                        <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
                        <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
                        <input type="hidden" name="amount_{$amount}" value="{$currency_convert}">
                        <input type="hidden" name="quantity_{$quantity}" value="{$value}">

                    DELIMETER;

                    echo $product;
    
                    $item_name++;
                    $item_number++;
                    $amount++;
                    $quantity++;
                }
   
                $_SESSION['item_total'] = $total += $sub;
                $_SESSION['item_quantity'] = $item_quantity;
            }
        }
    }
}

function show_paypal()
{
    if (isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) {
        $paypal_button = <<<DELIMETER
    <input type="image" name="upload" src="http://www.iptvchoice.com/wp-content/uploads/2015/02/Buy-Now-Button.png" width = "170px"  height = "auto" alt="PayPal - The safer, easier way to pay online">
    DELIMETER;
        return $paypal_button;
    }
}

function process_transaction()
{
    if (isset($_GET['tx'])) {
        $amount = $_GET['amt'];
        $currency = $_GET['cc'];
        $transaction = $_GET['tx'];
        $status = $_GET['st'];

        $total = 0;
        $item_quantity = 0;

        foreach ($_SESSION as $name => $value) {
  
            if ($value > 0) {
                if (substr($name, 0, 8) == "product_") {
             
                    $length = strlen($name);
                    $id = substr($name, 8, $length);

                    $send_order = query("INSERT INTO orders (order_amount, order_transaction, order_status, order_currency) VALUES ('{$amount}','{$transaction}','{$status}','{$currency}')");
                    $last_id = last_id();
                    confirm($send_order);

                    $query = query("SELECT * FROM products WHERE product_id =" . escape_string($id) . " ");
                    confirm($query);

                    while ($row = fetch_array($query)) {
                        $product_price = $row['product_price'];
                        $product_title = $row['product_title'];
                        $sub = $row['product_price'] * $value;
                        $item_quantity += $value;

           

                        $insert_report = query("INSERT INTO reports (product_id, order_id, product_price, product_title, product_quantity) VALUES ('{$id}','{$last_id}','{$product_price}','{$product_title}','{$value}')");
                        confirm($insert_report);
                    }
       
                    $total += $sub;
                    $item_quantity;
                }
            }
        }
        session_destroy(); 
    } else {
        redirect("index.php");
    }
}

?>