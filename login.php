<?php
$title = "Login";

include_once "layouts/header.php";
include_once "middlewares/guest.php";
include_once "layouts/navbar.php";

$users = [
    [
        'id' => 1,
        'name'=> "abdulrahman",
        'email'=> "abdulrahman@gmail.com",
        'password'=>123456,
        'gender' => 'm',
        'image' =>'1.jpg'
    ],
    [
        'id' => 2,
        'name'=> "ahmed",
        'email'=> "ahmed@gmail.com",
        'password'=>123456,
        'gender' => 'm',
        'image' =>'2.jpg'
    ],
    [
        'id' => 3,
        'name'=> "sara",
        'email'=> "sara@gmail.com",
        'password'=>123456,
        'gender' => 'f',
        'image' =>'3.jpg'
    ]
];

if($_POST){
    //Validation
    $errors = [];
    if(empty($_POST['email'])){
        $errors['email-required'] ="<div class='text-danger font-weight-bold my-1'>* Email Is Required </div>";
    }

    if(empty($_POST['password'])){
        $errors['password-required'] ="<div class='text-danger font-weight-bold my-1'>* Password Is Required </div>";
    }
   // if no validation errors
   if(empty($errors)){
    foreach($users as $index => $user){
        if($user['email'] == $_POST['email'] && $user['password'] == $_POST['password']){
            $_SESSION['user'] = $user;
            header('location: index.php');die;
        }
    }
    $errors['wrong-credentials'] ="<div class='text-danger font-weight-bold my-1'>These credentials are incorrect</div>";

}
}
?>
<div class="container">
    <div class="row">
        <div class="col-12 h1 text-center mt-5">
            <?= $title ?>
        </div>
        <div class="col-4 offset-4">
            <form action="" method="post">
            <div class="form-group">
              <label for="Email">Email</label>
              <input type="Email" name="email" value= "<?= (isset($_POST['email'])) ? $_POST['email'] : ''; ?>"id="Email" class="form-control" placeholder="" aria-describedby="helpId">
              <?php
               if(isset($errors['email-required'])){
                echo $errors['email-required'];
               }
            ?>
            </div>
            
            <div class="form-group">
              <label for="Password">Password</label>
              <input type="Password" name="password" id="Password" class="form-control" placeholder="" aria-describedby="helpId">
              <?php
               if(isset($errors['password-required'])){
                echo $errors['password-required'];
               }
            ?>
            <?php
               if(isset($errors['wrong-credentials'])){
                echo $errors['wrong-credentials'];
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