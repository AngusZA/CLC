<?php 
    use CLC\Env;
    Env::startSession();
?>
<!DOCTYPE html>
<html lang="en">
<?php 
        $title= "Welcome";
        require_once("Shared/Header.php");
?>
<body>
    <h1 class="text-center">Welcome <?php echo $_SESSION['user']->getFirstName() ?? $_SESSION['user']->getUserName() ?></h1>
    <div class="text-center"><a href="/login">Log Out</a></div>
    
</body>
</html>