<h1 class="page-header">
    All Products

</h1>

<h3><?php display_message(); ?></h3>
<table class="table table-hover">


    <thead>

        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
       <?php  get_products_in_admin() ?>

    </tbody>
</table>

</div>