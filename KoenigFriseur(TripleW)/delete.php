<html>
<head>
    <?php
    include("BarberShopCMS.php");
    $cmsObject = new BarberShopCMS();
    $conn = $cmsObject->connectDB();
    ?>
    <title>Deleting operation</title>
</head>
<body>
<?php
///process deleting operation and then automatically return to the position of the website where the user was
if(isset($_POST["submitDelete"])) {
    if(isset($_GET["imgPath"])) {
        $imgPath = $_GET["imgPath"];
        if($cmsObject->deleteImg($imgPath, $conn)){
            if (isset($_GET["p"])) {
                $position = $_GET["p"];
                echo "<script>window.location.href = 'KoenigFriseurCMS.php#$position'</script>";
            } else {
                echo "<script>window.location.href = 'KoenigFriseurCMS.php'</script>";
            }
        }else{
            echo "Deleting image failed.<br>";
            echo "<a href = 'KoenigFriseurCMS.php#$position'>Click here to return</a>";
        }
    }else {
        echo "Failed to get the path of the image to delete.";
    }
}
?>
</body>
</html>