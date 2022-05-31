<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


<div class="container">


    <header>
        <h1>
            <?php
            $query = query("SELECT * FROM categories WHERE cat_id =" . escape_string($_GET['id']) . "");
            confirm($query);

            while ($row =  fetch_array($query)) {
                echo $row['cat_title'];
            }
            ?>
            <h1>

    </header>


    <hr>

    <!-- Title -->
    <div class="row">
    </div>
    <!-- /.row -->

    <!-- Page Features -->
    <div class="row text-center">

        <?php get_products_category_page(); ?>


    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>