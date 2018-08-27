<?php require_once('includes/init.php'); ?>

<?php

	if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["id"])) {
		
        $result = ListItem::find_list_item_by_id($_GET["id"]);
        if ($result) {
        	// print_r($listItem);
        	$result->delete();
        	// echo $listItem->name;
        }
    }

    redirect('index.php');
?>


