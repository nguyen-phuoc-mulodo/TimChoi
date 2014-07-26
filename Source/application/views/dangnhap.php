<html>
    <body>
        <?php
        if(isset($_POST['submit']))
        {
        $user= $_POST["user"];
        $pass= $_POST["pass"];
        if($user=="user"&& $pass=="pass")
            echo 'dang nhap thanh cong';
        
        }
        ?>
        <form method="post" action="">
            Username: <input type="text" name="user" value=""><br>
            Password: <input type="password" name="pass" value=""><br>
            <input type="submit" value="Login" name="submit">
        </form>
        
        
    </body>
</html>
     