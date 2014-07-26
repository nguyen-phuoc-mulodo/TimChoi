<html>
    <body>
        <?php
            if(isset($_POST['submit'])){
                echo "chao ".$_POST['gender'];
            }
        ?>
        <form method="post" action="">
            <select name="gender">
                <option>Gioi tinh</option>
                <option value="nam">nam</option>
                <option value="nu">nu</option>
            </select> 
            <input type="submit" name="submit" value="submit">
        </form>
    </body>
</html>    