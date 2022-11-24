<?php

$title = "Change Profile Information";

include_once "layouts/header.php";
include_once "middlewares/auth.php";
include_once "layouts/navbar.php";
define("ALLOWED_EXTENSIONS", [
    'png', 'jpg', 'jpeg'
]);
define('MAX_UPLOAD_SIZE', 10 ** 6);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // print_r($_FILES);
    // print_r($_POST);die;
    $errors = [];
    if (empty($_POST['name'])) {
        $errors['name-required'] = "<div class='text-danger font-weight-bold my-1'>* Name Is Required </div>";
    }
    if (empty($_POST['email'])) {
        $errors['email-required'] = "<div class='text-danger font-weight-bold my-1'>* Email Is Required </div>";
    }
    if (empty($_POST['gender'])) {
        $errors['gender-required'] = "<div class='text-danger font-weight-bold my-1'>* Gender Is Required </div>";
    }
    if (empty($errors)) {
        #update information

        //Check if request has image
        if ($_FILES['image']['error'] == 0) {
            // validate extension
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if (!in_array($ext, ALLOWED_EXTENSIONS)) {
                $errors['image']['extension'] = "<div class='text-danger font-weight-bold my-1'>Available Extensions are: " . implode(', ', ALLOWED_EXTENSIONS) . "</div>";
            }
            // print_r($ext);die;
            // validate on size
            if ($_FILES['image']['size'] > MAX_UPLOAD_SIZE) {
                $errors['image']['size'] = "<div class='text-danger font-weight-bold my-1'>* Maximum Uploaded Files Must Be Less Than " . MAX_UPLOAD_SIZE . " Bytes</div>";
            }

            if (empty($error)) {
                $imagePath = 'images/users';
                $photoName = time() . '.' . $ext;
                $permenantPath = "$imagePath/$photoName";
                move_uploaded_file($_FILES['image']['tmp_name'], $permenantPath);
                // move img from tmp => per

                // update is session
                $_SESSION['user']['image'] = $photoName;
            }
        }

        //Check if request has no image
        if (empty($errors)) {
            $_SESSION['user']['name'] = $_POST['name'];
            $_SESSION['user']['email'] = $_POST['email'];
            $_SESSION['user']['gender'] = $_POST['gender'];
            $success = "<div class='text-success alert alert-success font-weight-bold my-1'>profile updated successfully</div>";
        }
    }
}
?>
<div class="container mb-5">
    <div class="row">
        <div class="col-12 h1 text-center mt-5">
            <?= $title ?>
        </div>
        <div class="col-4 offset-4">


            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group text-center">
                    <?php
                    if (isset($success)) {
                        echo $success;
                    }
                    ?>
                    <label for="image"><img src="images/users/<?= $_SESSION['user']['image'] ?>" alt="<?= $_SESSION['user']['name'] ?>" class="w-100 rounded-circle" style="cursor: pointer;"></label>
                    <input type="file" name="image" id="image" class="d-none">
                    <?php
                    if (!empty($errors['image'])) {
                        foreach ($errors['image'] as $error) {
                            echo $error;
                        }
                    }
                    ?>
                </div>
                <hr class="w-100">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" value="<?= $_SESSION['user']['name'] ?>" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId">
                    <?php
                    if (isset($errors['name-required'])) {
                        echo $errors['name-required'];
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="Email" value="<?= $_SESSION['user']['email'] ?>" name="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : ''; ?>" id="Email" class="form-control" placeholder="" aria-describedby="helpId">
                    <?php
                    if (isset($errors['email-required'])) {
                        echo $errors['email-required'];
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="Gender">Gender</label>
                    <div class="form-check">
                        <input class="form-check-input" value="m" type="radio" name="gender" <?= ($_SESSION['user']['gender'] == 'm') ? 'checked' : '' ?> id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="f" type="radio" name="gender" <?= ($_SESSION['user']['gender'] == 'f') ? 'checked' : '' ?> id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Female
                        </label>
                    </div>
                    <?php
                    if (isset($errors['gender-required'])) {
                        echo $errors['gender-required'];
                    }
                    ?>
                </div>



                <div class="form-group">
                    <button class="btn btn-outline-dark rounded"><?= $title ?></button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
include_once "layouts/footer.php";
?>