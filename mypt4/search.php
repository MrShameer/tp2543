<?php
header("Content-Type: application/json;Charset=UTF-8");
require 'database.php';

$Json = array();

if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $data = explode(" ", $search);

    // 0 - name
    // 1 - price
    // 2 - brand

    $name = (isset($data[0]) ? $data[0] : '');
    $price = (isset($data[1]) ? $data[1] : '');
    $brand = (isset($data[2]) ? $data[2] : '');

    try {
        //kalo nk search pastu dapat specific product. like nk dapat product tu je
        /*if(count($data)<3){
             $stmt = $conn->prepare("SELECT * FROM `tbl_products_a173586` WHERE fld_product_name LIKE ? OR fld_product_price LIKE ? OR fld_product_brand LIKE ?");
             $stmt->execute(["%{$search}%","%{$search}%", "%{$search}%"]);
        }
        elseif(count($data)==3){
            $stmt = $conn->prepare("SELECT * FROM `tbl_products_a173586` WHERE fld_product_name LIKE ? AND fld_product_price LIKE ? AND fld_product_brand LIKE ?");
            $stmt->execute(["%{$name}%","%{$price}%", "%{$brand}%"]);
        }*/

        //kalo nk search any keyword and return all row yg ade words tu(harap faham) 
        $queries = array();
        foreach($data as $dat){
            $queries[] = "SELECT * FROM `tbl_products_a173586` WHERE fld_product_name LIKE '%{$dat}%' OR fld_product_price LIKE '%{$dat}%' OR fld_product_brand LIKE '%{$dat}%'";
        }
        $sql = implode(' UNION ',$queries);
        $stmt = $conn->prepare($sql);


        //penting for both cara
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $Json = array('status' => 200, 'data' => $res);
    } catch (PDOException $e) {
        $Json = array('status' => 400, 'data' => $e->getMessage());
    }

}

if (isset($Json))
    echo json_encode($Json);
