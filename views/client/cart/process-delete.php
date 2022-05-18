<?php  
    if (!empty($_GET['action']) && $_GET['action']  == 'delete') {
        $id = $_GET['id'];
        //var_dump($id);
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true); 
        $index = array_search($id,array_column($cart_data,"item_id"));
        //var_dump($index);
        array_splice($cart_data, $index, 1);  
        //var_dump($cart_data);
        if (count($cart_data) == 0) {
            setcookie('shopping_cart', '' , time() - 3600, '/');
            header("location: index.php");
        }
        else {
            $item_data = json_encode($cart_data, JSON_UNESCAPED_UNICODE);
            //var_dump($item_data);
            setcookie('shopping_cart', $item_data, time() + (86400 * 30), '/');
            header("location: index.php");
            //var_dump($_COOKIE);
        }
    }




    