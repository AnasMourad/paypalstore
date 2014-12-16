<?php


function get_list_view_html($product) {
    
    $output = "";

    $output = $output . "<li>";
    $output = $output . '<a href="' . URL_BASE . 'shirts/' . $product["sku"] . '/">';
    $output = $output . '<img src="' . URL_BASE . $product["img"] . '" alt="' . $product["name"] . '">';
    $output = $output . "<p>View Details</p>";
    $output = $output . "</a>";
    $output = $output . "</li>";

    return $output;
}

function get_recent_products() {
    
    require(ROOT_PATH."inc/database.php");
    try{

        $results = $db->query("SELECT name, price, img, sku, paypal 
            FROM products
            ORDER BY sku DESC 
            LIMIT 4");

    }catch(Exception $e){
        echo "An error occured";
    }
    
    $recent  = $results->fetchAll(PDO::FETCH_ASSOC);
    $recent = array_reverse($recent);
    return $recent;
}
function get_products_all() {
        
    
    require(ROOT_PATH . "inc/database.php" );
    try{

        $results = $db->query("SELECT sku, name, price, img, paypal FROM products ORDER BY sku ASC");
        
    }catch(Exception $e){

    }

    try{

        $products = $results->fetchAll(PDO::FETCH_ASSOC);
       // var_dump($products);
        //FETCH_ASSOC returns array indexed by column name :D

    }catch(Exception $e){

    }



    return $products;
}





    function payPalMe($product){

        $ret="";
        $ret.='<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">';
        $ret.='<input type="hidden" name="cmd" value="_s-xclick">';
        $ret.='<input type="hidden" name="hosted_button_id" value="'.$product["paypal"].'">';
        $ret.='<input type="hidden" name="item_name" value="'.$product["name"].'">';
        $ret.='<table>';
        $ret.='<tr>';
        $ret.='<th>';
        $ret.='<input type="hidden" name="on0" value="Sizes">';
        $ret.='<label for="os0">Sizes<label>';
        $ret.='</th>';
        $ret.='</tr>';
        $ret.='<tr>';
        $ret.='<td>';
        $ret.='<select name="os0" id="os0">';
        
        foreach($product["sizes"] as $size) {
            $ret.='<option value="'. $size.'">'. $size.'</option>';
        }
        
        $ret.='</select>';
        $ret.='</td>';
        $ret.='</tr>';
        $ret.='</table>';

        $ret.='<input type="submit" value="add to cart"  name="submit" >';
        $ret.='</form>';
        return $ret;


    }
    function getProductsSearch($searchTerm){
       
       require(ROOT_PATH."inc/database.php");
       try{

            $results= $db->prepare("SELECT name, price, img, sku, paypal 
            FROM products 
            WHERE name LIKE ?
            ORDER BY sku");
            $results->bindValue(1,"%".$searchTerm."%");
            $results->execute();

       }catch(Exception $e){

            echo "an error occured";
            exit;
       }

       $matches = $results->fetchAll(PDO::FETCH_ASSOC);
       return $matches;

    }

    function get_product_count(){

        require(ROOT_PATH."inc/database.php");
        try{

            $results = $db->query("SELECT COUNT(sku)
                FROM products");


        }catch(Exception $e){
            echo "An error happened"; 
        }
        $count = $results->fetchColumn(0);
        return intval($count);
    }
    function get_products_subset($start, $end){

        $offset = $start-1;
        $rows = $end - $start + 1;
        require(ROOT_PATH."inc/database.php");
        try{

            $results = $db->prepare("SELECT name, price, img, sku, paypal 
                FROM products 
                ORDER BY sku 
                LIMIT ?, ?");
            $results->bindParam(1, $offset, PDO::PARAM_INT);
            $results->bindParam(2, $rows, PDO::PARAM_INT);
            $results->execute();

        }catch(Exception $e){
            echo "something wrong happened";
            exit;
        }

        $subset = $results->fetchAll(); 
        return $subset;
    }
    function get_product_single($sku){
        // RETURNS FALSE IF 
        require(ROOT_PATH."inc/database.php");
        try{

            $results = $db->prepare("SELECT name, price, img, sku, paypal FROM products WHERE sku = ?");
            $results->bindParam(1,$sku);
            $results->execute();

        }catch(Exception $e){
        
            echo "No data";
        
        }
        
        $product = $results->fetch(PDO::FETCH_ASSOC);
        if($product === false){
            return $product;
        }
        $product["sizes"]=array();
        try{

            $results = $db->prepare("
                SELECT product_sku, size_id, size
                FROM products_sizes
                INNER JOIN sizes ON products_sizes.size_id = sizes.id
                WHERE product_sku = ?
                ORDER BY `order`");
            $results->bindParam(1, $sku);
            $results->execute();

        }catch(Exception $e){

        }

        while($row = $results->fetch(PDO::FETCH_ASSOC)){
            $product["sizes"][]=$row["size"];
        }

        return $product;
    }


?>