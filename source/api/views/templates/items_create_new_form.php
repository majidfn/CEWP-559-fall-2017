<?php require __DIR__. '/header.php'; ?>

<div id="new_item_container">
    <form action="./items/" method="post">
        <div class="block"><label>Title:</label><input type="text" name="name" id="new_item_title"/></div>
        <div class="separator"></div>
        <div class="block"><label>Desc:</label><textarea rows="5" cols="50" name="description" id="new_item_desc"></textarea></div>
        <div class="separator"></div>
        <div class="block"><label>Price:</label><input type="text" name="price" id="new_item_price"/></div>
        <div class="separator"></div>
        <input type="submit" class="create" value="Create"/>
    </form>
</div>
<?php require __DIR__. '/footer.php';