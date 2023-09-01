<?php

require_once("../../config/connection.php");

$sql = "SELECT m.id as id, m.name as medicine_name, m.mrp as mrp, m.photo as photo, m.category_id as medicine_category_id, m.packing_date as packing_date, m.expiry_date as expiry_date, m.description as description, m.mrp as mrp, c.name as category_name FROM `medicine` as m INNER JOIN `category` as c ON m.category_id = c.id AND m.name LIKE :search_str";
$stmt = $conn->prepare($sql);
$stmt->bindValue("search_str", "%" . $_POST['search_str'] . "%");
$stmt->execute();

if ($stmt->rowCount()) {
    while ($row = $stmt->fetch()) {
        echo '
        <div class="col-lg-3 col-md-6 col-sm-12 pb-4">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0 d-flex align-items-center" style="height:200px;">
                <img class="img-fluid w-100" style="object-fit: contain; background: rgba(245, 245, 245, 0.5); height:200px;" src="' . $domain_name . $row['photo'] . '" alt="medicine photo">
                </div>
                <div class="card-body border-left border-right p-2">
                    <h4 class="text-truncate">' . $row['medicine_name'] . '</h4>
                    <p style="font-size: 13px; color: black">Category name: ' . ($row['category_name']) . '</p>
                    <p class="text-truncate">' . $row['description'] . '</p>
                    <h6>MRP: ₹' . $row['mrp'] . '</h6>
                    <p style="font-size: 10px" class="m-0 p-0">Created At: ' . date('Y/m/d', strtotime($row['packing_date'])) . '</p>
                    <p style="font-size: 10px" class="m-0 p-0"> ' . ($row['expiry_date'] ? "Expired At: " . date('Y/m/d', strtotime($row['expiry_date'])) : "") . '</p>
                </div>
                <div class="card-footer d-flex justify-content-between border px-1">
                    <button type="button" class="btn btn-danger text-white mx-1 w-100" data-toggle="modal" data-target="#modal' . $row["id"] . '">
                        <i class="fa fa-remove mr-1"></i>Delete
                    </button>
                </div>
            </div>
        </div>';
        echo "
        <!-- Modal -->
        <div class='modal fade' id='modal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLongTitle'>Delete category</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    Are you sure you want to delete? 
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-outline-success' data-dismiss='modal'>No</button>
                    <form action='/medicine/admin/remove_medicine.php' method='POST'>
                        <input type='text' value='" . $row['id'] . "' name='id' hidden/>
                        <input type='Submit' value='Yes' name='delete_medicine' class='btn btn-outline-danger'/>
                    </form>
                </div>
                </div>
            </div>
        </div>";
    }
} else {
    echo "<div class='container py-5 text-center text-secondary'>No data found!</div>";
}
