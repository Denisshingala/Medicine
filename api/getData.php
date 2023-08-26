<?php
require_once("../config/connection.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql = "SELECT photo, id, name FROM `medicine` WHERE name LIKE :str";
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
