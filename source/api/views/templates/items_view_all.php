<?php require __DIR__. '/header.php'; ?>

<?php foreach ($data as $key => $value) { ?>
    <div id="list_items_container" class="item_box">
        <div class="title"><a href="items/<?=$value->id?>"><?=$value->name?></a></div>
        <div class="description"><?=$value->description?></div>
        <div class="price">$<?=$value->price?></div>
    </div>
<?php } ?>

<?php require __DIR__. '/footer.php';