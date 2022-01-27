<?php
// if you need to change the uploads directory.

$upload_directory = "uploads";

// helper fuctions

function last_id()
{
    global $connection;
    return mysqli_insert_id($connection);
}

function set_message($msg)
{
    if (!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}

function display_message()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function redirect($location)
{
    header("Location: $location");
}

function query($sql)
{
    global $connection;
    return mysqli_query($connection, $sql);
}

function confirm($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED " . mysqli_error($connection));
    }
}

function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result)
{
    return mysqli_fetch_array($result);
}

// get products

function get_products()
{
    $query = query("SELECT * FROM products");
    confirm($query);

    while ($row =  fetch_array($query)) {
        $product = <<<DELIMETER
        <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                           <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
                            <div class="caption">
                                <h4 class="pull-right">R {$row['product_price']}</h4>
                                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                </h4>
                                <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
                            </div>
                        </div>
                    </div>
        DELIMETER;

        echo $product;
    }
}

// get categories

function get_categories()
{
    $query = query("SELECT * FROM categories");
    confirm($query);

    while ($row = mysqli_fetch_array($query)) {
        $category_links = <<<DELIMETER
        <a href='category.php?id={$row['cat_id']}' class ='list-group-item'>{$row['cat_title']}</a>
        DELIMETER;
        echo $category_links;
    }
}

function get_products_category_page()
{
    $query = query("SELECT * FROM products WHERE product_category_id = " . escape_string($_GET['id']) . " ");
    confirm($query);

    while ($row =  fetch_array($query)) {
        $product = <<<DELIMETER
        <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>
                        <p>R {$row['product_price']}</p>
                        <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a> <a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
        DELIMETER;

        echo $product;
    }
}

function login_user()
{

    if (isset($_POST['submit'])) {

        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' ");
        confirm($query);

        if (mysqli_num_rows($query) == 0) {
            set_message("Your Password or Username is wrong");
            redirect("login.php");
        } else {
            $_SESSION['username'] = $username;
            redirect("admin");
        }
    }
}

function send_message()
{

    if (isset($_POST['submit'])) {

        $to          = "mornef.dt@gmail.com";
        $from_name   =   $_POST['name'];
        $subject     =   $_POST['subject'];
        $email       =   $_POST['email'];
        $message     =   $_POST['message'];

        $headers = "From: {$from_name} {$email}";
        $result = mail($to, $subject, $message, $headers);

        if (!$result) {
            set_message("Sorry we could not send your message");
            redirect("contact.php");
        } else {
            set_message("Your Message has been sent");
            redirect("contact.php");
        }
    }
}

function display_orders()
{
    $query = query("SELECT * FROM orders");
    confirm($query);

    while ($row = fetch_array($query)) {
        $orders = <<<DELIMETER

            <tr>
                <td>{$row['order_id']}</td>
                <td>{$row['order_amount']}</td>
                <td>{$row['order_transaction']}</td>
                <td>{$row['order_currency']}</td>
                <td>{$row['order_status']}</td>
                <td><a class="btn" href="index.php?delete_order_id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>

        DELIMETER;
        if (isset($orders)) {
            echo $orders;
        }
    }
}

function display_image($picture)
{
    global $upload_directory;
    return $upload_directory . DS . $picture;
}

function get_products_in_admin()
{
    $query = query("SELECT * FROM products");
    confirm($query);

    while ($row =  fetch_array($query)) {
        $category = show_product_category_title($row['product_category_id']);
        $product_image = display_image($row['product_image']);
        $product = <<<DELIMETER
            <tr>
                <td>{$row['product_id']}</td>
                <td><a href="../item.php?id={$row['product_id']}">{$row['product_title']}<br>
                <img src="{$row['product_image']}" alt="" width="62" height="auto">
                <img src="../resources/{$product_image}" alt="" width="62" height="auto"></a>
                </td>
                <td>{$category}</td>
                <td>{$row['product_quantity']}</td>
                <td>R {$row['product_price']}</td>
                <td><a class="btn" href="index.php?edit_product&id={$row['product_id']}"><span class="glyphicon glyphicon-edit"></span></a>   <a class="btn" href="index.php?delete_product_id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
        DELIMETER;

        echo $product;
    }
}


function show_product_category_title($product_category_id)
{
    $category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}'");
    confirm($category_query);

    while ($category_row = fetch_array($category_query)) {
        return $category_row['cat_title'];
    }
}

function add_product()
{
    if (isset($_POST['publish'])) {
        $product_title              = escape_string($_POST['product_title']);
        $product_category_id        = escape_string($_POST['product_category_id']);
        $product_price              = escape_string($_POST['product_price']);
        $product_short_description  = escape_string($_POST['product_short_description']);
        $product_description        = escape_string($_POST['product_description']);
        $product_quantity           = escape_string($_POST['product_quantity']);
        $product_image              = escape_string($_FILES['file']['name']);
        $image_temp_location        = escape_string($_FILES['file']['tmp_name']);
        $product_large_image        = escape_string($_FILES['file']['name']);
        $Large_image_temp_location  = escape_string($_FILES['file']['tmp_name']);

        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);
        move_uploaded_file($Large_image_temp_location, UPLOAD_DIRECTORY . DS . $product_large_image);

        $query = query("INSERT INTO products(product_title, product_category_id, product_price, product_short_description, product_description, product_quantity, product_image, product_large_image) VALUES('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_short_description}', '{$product_description}', '{$product_quantity}', '{$product_image}', '{$product_large_image}')");
        $last_id = last_id();
        confirm($query);
        set_message("New Product with id ($last_id) was Added");
        redirect("index.php?products");
    }
}

function show_categories_add_product_page()
{
    $query = query("SELECT * FROM categories");
    confirm($query);

    while ($row = mysqli_fetch_array($query)) {
        $category_options = <<<DELIMETER
        <option value="{$row['cat_id']}">{$row['cat_title']}</option>
        DELIMETER;
        echo $category_options;
    }
}

function update_product()
{
    if (isset($_POST['update'])) {
        $product_title              = escape_string($_POST['product_title']);
        $product_category_id        = escape_string($_POST['product_category_id']);
        $product_price              = escape_string($_POST['product_price']);
        $product_short_description  = escape_string($_POST['product_short_description']);
        $product_description        = escape_string($_POST['product_description']);
        $product_quantity           = escape_string($_POST['product_quantity']);
        $product_image              = escape_string($_FILES['file']['name']);
        $image_temp_location        = escape_string($_FILES['file']['tmp_name']);
        $product_large_image        = escape_string($_FILES['file']['name']);
        $Large_image_temp_location  = escape_string($_FILES['file']['tmp_name']);

        if (empty($product_image)) {
            $get_pic = query("SELECT * FROM products WHERE product_id =" . escape_string($_GET['id']) . " ");
            confirm($get_pic);

            while ($pic = fetch_array($get_pic)) {
                $product_image = $pic['product_image'];
            }
        }
        if (empty($product_large_image)) {
            $get_pic = query("SELECT * FROM products WHERE product_id =" . escape_string($_GET['id']) . " ");
            confirm($get_pic);

            while ($pic = fetch_array($get_pic)) {
                $product_large_image = $pic['product_large_image'];
            }
        }

        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);
        move_uploaded_file($Large_image_temp_location, UPLOAD_DIRECTORY . DS . $product_large_image);

        $query = "UPDATE products SET ";
        $query .= "product_title                = '{$product_title}'                , ";
        $query .= "product_category_id          = '{$product_category_id}'          , ";
        $query .= "product_price                = '{$product_price}'                , ";
        $query .= "product_short_description    = '{$product_short_description}'    , ";
        $query .= "product_description          = '{$product_description}'          , ";
        $query .= "product_quantity             = '{$product_quantity}'             , ";
        $query .= "product_image                = '{$product_image}'                , ";
        $query .= "product_large_image          = '{$product_large_image}'          , ";
        $query .= "WHERE product_id=" . escape_string($_GET['id']);

        $send_update_query = query($query);
        confirm($send_update_query);
        set_message("Product has been updated");
        redirect("index.php?products");
    }
}

function show_categories_in_admin()
{
    $query = "SELECT * FROM categories";
    $category_query = query($query);
    confirm($query);

    while ($row = fetch_array($category_query)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        $category = <<<DELIMETER
        <tr>
            <td>{$cat_id}</td>
            <td>{$cat_title}</td>
            <td><a class="btn" href="index.php?delete_category_id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        DELIMETER;
        echo $category;
    }
}

function add_category()
{
    if (isset($_POST['add_category'])) {
        $cat_title = escape_string($_POST['cat_title']);
        if (empty($cat_title || $cat_title == " ")) {
            echo "<p >Cannot be empty</p>";
        } else {
            $insert_cat = query("INSERT INTO categories(cat_title) VALUES('{$cat_title}')");
            confirm($insert_cat);
            redirect("index.php?categories");
        }
    }
}

function display_users()
{
    $query = "SELECT * FROM users";
    $category_query = query($query);
    confirm($query);

    while ($row = fetch_array($category_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['password'];

        $user = <<<DELIMETER
        <tr>
            <td>{$user_id}</td>
            <td>{$username}</td>
            <td>{$email}</td>
            <td><a class="btn" href="index.php?delete_user_id={$row['user_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        DELIMETER;
        echo $user;
    }
}

function add_user()
{
    if (isset($_POST['add_user'])) {

        $username   = escape_string($_POST['username']);
        $email      = escape_string($_POST['email']);
        $password   = escape_string($_POST['password']);
        // $user_photo = escape_string($_FILES['file']['name']);
        // $photo_temp = escape_string($_FILES['file']['tmp_name']);
        // move_uploaded_file($photo_temp, UPLOAD_DIRECTORY . DS . $user_photo);
        $query = query("INSERT INTO users(username,email,password) VALUES('{$username}','{$email}','{$password}')");
        confirm($query);
        set_message("USER CREATED");
        redirect("index.php?users");
    }
}

function get_reports()
{
    $query = query("SELECT * FROM reports");
    confirm($query);

    while ($row =  fetch_array($query)) {
        $report = <<<DELIMETER
            <tr>
                <td>{$row['report_id']}</td>
                <td>{$row['product_id']}</td>
                <td>{$row['order_id']}</td>
                <td>R {$row['product_price']}</td>
                <td>{$row['product_title']}</td>
                <td>{$row['product_quantity']}</td>
                <td><a class="btn" href="index.php?delete_reports_id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>

            </tr>
        DELIMETER;

        echo $report;
    }
}

function add_slides(){

    if(isset($_POST['add_slide'])) {
        $slide_title        = escape_string($_POST['slide_title']);
        $slide_image        = escape_string($_FILES['file']['name']);
        $slide_image_loc    = escape_string($_FILES['file']['tmp_name']);
        if(empty($slide_title) || empty($slide_image)) {

            echo "<p class='bg-danger'>This field cannot be empty</p>";
        } else {
            move_uploaded_file($slide_image_loc, UPLOAD_DIRECTORY . DS . $slide_image);

            $query = query("INSERT INTO slides(slide_title, slide_image) VALUES('{$slide_title}', '{$slide_image}')");
            confirm($query);
            set_message("Slide Added");
            redirect("index.php?slides");
        }
    }
}
function get_current_slide(){


}

function get_current_slide_in_admin(){
    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);

    while($row = fetch_array($query)) {
        $slide_image = display_image($row['slide_image']);
        $slide_active_admin = <<<DELIMETER
        <img class="img-responsive" src="../../resources/{$slide_image}" alt="">
        DELIMETER;
        echo $slide_active_admin;
    }
}

function get_active_slide(){
    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);

    while($row = fetch_array($query)) {
        $slide_image = display_image($row['slide_image']);
        $slide_active = <<<DELIMETER
        <div class="item active">
            <img class="slide-image" src="../resources/{$slide_image}" alt="">
        </div>
        DELIMETER;
        echo $slide_active;
    }
}

function get_slides(){
    $query = query("SELECT * FROM slides");
    confirm($query);

    while($row = fetch_array($query)) {
        $slide_image = display_image($row['slide_image']);
        $slides = <<<DELIMETER
        <div class="item">
            <img class="slide-image" src="../resources/{$slide_image}" alt="">
        </div>
        DELIMETER;
        echo $slides;
    }
}

function get_slide_thumbnails(){

    $query = query("SELECT * FROM slides ORDER BY slide_id ASC ");
    confirm($query);

    while($row = fetch_array($query)) {
        $slide_image = display_image($row['slide_image']);
        $slide_thumb_admin = <<<DELIMETER
        <div class="col-xs-6 col-md-3 image_container">
            
            <a href="index.php?delete_slide_id={$row['slide_id']}">
                
                <img  class="img-responsive slide_image" src="../../resources/{$slide_image}" alt=""></a>
            <div class="caption">
            <p>{$row['slide_title']}</p>
            </div>
        </div>
        DELIMETER;
        echo $slide_thumb_admin;
    }
}