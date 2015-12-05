<ul>
    <?php foreach ($products as $product) : ?>
        <li>
            <?php echo $product->title ?>
            <?php echo $product->price ?>
        </li>
    <?php endforeach ?>
</ul>