<h1 class="page-header">
    Reports

</h1>

<h3><?php display_message(); ?></h3>
<table class="table table-hover">

    <thead>
        <tr>
            <th>Id</th>
            <th>Product Id</th>
            <th>Order Id</th>
            <th>Price</th>
            <th>Title</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
       <?php get_reports() ?>
    </tbody>
</table>

</div>