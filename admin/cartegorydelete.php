<?php
include "class/cartegory-class.php";
$cartegory = new Cartegory;
if(!isset($_GET['cartegory_id']) || $_GET['cartegory_id']==NULL){
    echo "window.location = 'cartegorylist.php'</script>";
 }
 else{
    $cartegory_id = $_GET['cartegory_id'];
 }
    $delete_cartegory = $cartegory -> delete_cartegory( cartegory_id: $cartegory_id );
    
 ?>
 