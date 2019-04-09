    <?php
    session_start();

    $name = $_REQUEST['name'];
    $address = $_REQUEST['address'];
    $suburb = $_REQUEST['suburb'];
    $state = $_REQUEST['state'];
    $country = $_REQUEST['country'];
    $email = $_REQUEST['email'];

    $subject = "Receipt";

    $message = "Delivery details\n";
    $message .= "----------------------------\n";
    $message .= "$name\n";
    $message .= "$address\n";
    $message .= "$suburb\n";
    $message .= "$state\n";
    $message .= "$country\n\n";
    $message .= "Buy items\n";
    $message .= "----------------------------\n";
    $message .= "Item Amount Price\n";

    if (isset($_SESSION['products'])) {
        $total_price = 0;
        foreach ($_SESSION['products'] as $key=>$val) {
            $product_name = $val[0];
            $product_quantity = $val[1];
            $product_price = $val[2];
            $message .= "$product_name $product_quantity $product_price\n";
            $total_price += $product_price;
        }
        $message .= "----------------------------\n";
        $message .= "Total: $total_price";
        unset($_SESSION['products']);  // 清空购物车
        if (mail($email, $subject, $message)) {
            echo "<h1>Payment success!</h1>";
        } else {
            echo "<h1>Payment fail!</h1>";
        }
    } else {
        echo "<h1>Empty cart</h1>";
    }
    echo "<script type='text/javascript'>resetCart();</script>";
    ?>