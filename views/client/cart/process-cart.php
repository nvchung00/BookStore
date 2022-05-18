<?php 
    if(isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true, 512, JSON_UNESCAPED_UNICODE);
    }
    else {
        $cart_data = array();
    }
    //var_dump($cart_data);

    if (empty($_POST['id'])) {
        exit();
    }

    $item_id_list = array_column($cart_data, 'item_id');
    //var_dump($item_id_list);
    if(in_array($_POST["id"], $item_id_list)){
        foreach($cart_data as $keys => $values)
		{
			if($cart_data[$keys]["item_id"] == $_POST["id"])
			{
                $quantity = 1;
                if (!empty($_POST['quantity'])) {
                    $quantity =  $_POST['quantity'];
                }
				$cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $quantity;
			}
		}		
	}
    else {
        $item_array = array(
            'item_id'			=>	$_POST['id'],
            'item_name'			=>	$_POST['name'],
            'item_price'		=>	$_POST['price'],
            'item_city'         =>  !empty($_POST['city']) ? $_POST['city'] : '',
            'item_image'        =>  $_POST['image'],
            'item_quantity'     =>  !empty($_POST['quantity']) ? $_POST['quantity'] : '1'
        );
        $cart_data[] = $item_array;    
    }
    //var_dump($cart_data);
    
    $item_data = json_encode($cart_data, JSON_UNESCAPED_UNICODE);
    //$test = json_decode($item_data, true, 512, JSON_UNESCAPED_UNICODE);
    //var_dump($test);
    setcookie('shopping_cart', $item_data, time() + (86400 * 30), '/');
    //var_dump($_COOKIE["shopping_cart"])