<!DOCTYPE html>
<html lang="en">
<?php 
    
    $title="Login";
    require_once("Shared/Header.php");
?>
<style>
    .invalid-inputs{
        border: 2px solid red;
    }

    input:valid {
        border: 2px solid black;
    }
</style>
<body>
    <h1 class="text-center">Register User</h1>
    <p class="text-center">Register a new user here</p>
    <div class="p-2">
        <form id="user-register" novalidate>
            <div class="inputs text-center my-2"><input type="text" name="userName" placeholder="User Name*" required></div>
            <div class="inputs text-center my-2"><input type="text" name="firstName" placeholder="First Name*" required></div>
            <div class="inputs text-center my-2"><input type="text" name="lastName" placeholder="Last Name"></div>
            <div class="inputs text-center my-2"><input type="password" name="password" placeholder="Password*" required pattern="^(?=.*[A-Z])(?=.*[\W_]).{8,}$"><div>
            <div class="inputs text-center my-2"><input type="password" name="password2" placeholder="Confirm Password*" required pattern="^(?=.*[A-Z])(?=.*[\W_]).{8,}$"><div>
            <div class="text-center my-2"><img src="<?php echo $captchaBuilder->inline();?>" alt="" srcset=""></div>
            <div class="inputs text-center my-2"><input type="text" name="captcha" placeholder="Enter Matching Text" required></div>
                <p class="text-danger font-weight-bold d-none text-center py-2" id="error"></p>
                <p class="text-success font-weight-bold d-none text-center py-2" id="success">User created successfully!</p>
                <p class="text-center py-2"><i>* Required fields.</i></p>
            <div class="btn-wrapper my-2"><button class="btn btn-primary" type="submit">Create User</button></div>
        </form>
    </div>
    <script src="/src/js/registerUser.js"></script>
</body>
</html>