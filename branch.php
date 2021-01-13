<?php


if(isset($_POST['disp'])==true)
{
    if(isset($_POST['code'])==false)
    {
        header('Location: ng.php');
        exit();
    }
    $code=$_POST['code'];
    header('Location: disp.php?code='.$code);
    exit();
}


if(isset($_POST['edit'])==true)
{
    if(isset($_POST['code'])==false)
    {
        header('Location:ng.php');
        exit();
    }
    $code=$_POST['code'];
    header('Location:edit.php?code='.$code);
    exit();
}

if(isset($_POST['delete'])==true)
{
    if(isset($_POST['code'])==false)
    {
        header('Location:ng.php');
        exit();
    }
    $code=$_POST['code'];
    header('Location:delete.php?code='.$code);
    exit();
}

?>
</body>