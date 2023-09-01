<?php
require_once("../config/connection.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql = "SELECT m.id as id, m.name as medicine_name, m.mrp as mrp, m.photo as photo, m.category_id as medicine_category_id, m.packing_date as packing_date, m.expiry_date as expiry_date, m.packing_date as packing_date, m.description as description, c.name as category_name FROM `medicine` as m INNER JOIN `category` as c ON m.category_id = c.id AND m.name LIKE :str";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue("str", "%" . $_POST['search_str'] . "%");
    $res = $stmt->execute();

    if ($res) {
        $res = $stmt->fetchAll();
        echo json_encode(["success" => "Success!", "data" => $res]);
    } else {
        echo json_encode(["error" => "Somthing went wrong with server!"]);
    }
} else {
    echo json_encode(["error" => "Invalid request!"]);
}
