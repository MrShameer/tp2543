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
        if(count($data)==1){
             $stmt = $conn->prepare("SELECT * FROM `tbl_products_a173586` WHERE fld_product_name LIKE ? OR fld_product_price LIKE ? OR fld_product_brand LIKE ?");
             $stmt->execute(["%{$search}%","%{$search}%", "%{$search}%"]);
        }
        // elseif(count($data)==2){
        //     $product = array();
        //     $price = array();
        //     $brand = array();
        //     foreach($data as $dat) {
        //         $product[] = ' fld_product_name LIKE %'.$dat.'%';
        //         $price[] = 'fld_product_price LIKE %'.$dat.'%';
        //         $brand[] = 'fld_product_brand LIKE %'.$dat.'%';
        //     }
        //     $sql = implode(' OR',$product);


        //    // $stmt = $conn->query("SELECT * FROM `tbl_products_a173586` WHERE fld_product_name LIKE '%{$name}%' AND fld_product_price LIKE %{$price}% OR fld_product_name LIKE %{$name}% AND fld_product_brand LIKE %{$brand}% OR fld_product_price LIKE %{$price}% AND fld_product_brand LIKE %{$brand}%");
        //     $stmt = $conn->query("SELECT * FROM `tbl_products_a173586` WHERE {$sql}");
        //     $stmt->execute();
        // }
        elseif(count($data)==3){
            $stmt = $conn->prepare("SELECT * FROM `tbl_products_a173586` WHERE fld_product_name LIKE ? AND fld_product_price LIKE ? AND fld_product_brand LIKE ?");
            $stmt->execute(["%{$name}%","%{$price}%", "%{$brand}%"]);
        }
        // $stmt = $db->prepare("SELECT * FROM `tbl_products_a174652_pt2` WHERE FLD_PRODUCT_NAME LIKE ? OR FLD_PRICE LIKE ? OR FLD_BRAND LIKE ?");
        // $stmt->execute(["%{$search}%","%{$search}%", "%{$search}%"]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $Json = array('status' => 200, 'data' => $res);
    } catch (PDOException $e) {
        $Json = array('status' => 400, 'data' => $e->getMessage());
    }

}

if (isset($Json))
    echo json_encode($Json);
