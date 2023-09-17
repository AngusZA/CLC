<!DOCTYPE html>
<html lang="en">
<?php 
    $title="Login";
    require_once("Shared/Header.php");
?>
<body>
    <h1 class="text-center">User Login</h1>
    <p class="text-center">Please log in to access your user portal.</p>
    <div class="p-2">
        <form id="user-login">
            <div class="inputs text-center"><input type="text" name="userName" placeholder="User Name"></div>
            <div class="inputs text-center my-2"><input type="password" name="password" placeholder="Password"><div>
                <p class="text-danger font-weight-bold d-none text-center py-2" id="error"></p>
            <div class="btn-wrapper my-2"><button class="btn btn-primary" type="submit">Login</button></div>
            <div class="btn-wrapper my-2"><a href="/create-user" class="btn btn-outline-primary">Create User</a></div>
        </form>
    </div>
    <script src="/src/js/login.js"></script>
</body>
</html>