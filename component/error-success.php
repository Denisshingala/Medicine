<?php
if ($error) {
    echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> $error
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    ";
    $error = "";
}

if ($success) {
    echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> $success
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    ";
    $success = "";
}
