<?php require_once('includes/init.php'); ?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["submit"])) {
            $listItem = new ListItem();
            $listItem->name = $_POST["name"];
            $listItem->create();
                    
        } elseif (isset($_POST["edit"])) {
            $item = ListItem::find_list_item_by_id($_POST["id"]);
            $item->name = $_POST["name"];
            $item->update();
        }
    } 
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>Broadnet ToDo App Coding Challenge</title>
  </head>
  <body>
    <?php if (isset($message)) { ?>
        <div class="row justify-content-around">
            <?php echo $message; ?>
        </div>
    <?php } ?>
    <div class="row justify-content-around p-5">
        <h1>To Do List</h1>

        <form action="" method="post">
            <input type="text" name="name" id="name">
            <input class="btn btn-secondary" type="submit" name="submit" value="Add Item">
        </form>
    </div>
    <div class="row justify-content-around">
        <div class="col-12 col-md-8 col-lg-6">
            <ol>
                <?php 
                    $items = ListItem::find_all_list_items();
                    foreach($items as $item) {
                ?>
                        <div class="row justify-content-around list-item">
                            <div class="col col-sm-7 float-left">
                                <?php echo $item->name; ?>
                            </div>
                            <div class="col col-sm-5 py-1 float-right">
                                <a href="edit_list_item.php?id=<?php echo $item->id; ?>" class="btn btn-primary"><i class="fas fa-edit px-1"></i>Edit</a>
                                <a href="delete_list_item.php?id=<?php echo $item->id; ?>" class="btn btn-danger"><i class="fas fa-trash-alt px-1"></i>Delete</a>
                            </div>
                        </div>
                <?php  
                    }
                ?>
            </ol>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
