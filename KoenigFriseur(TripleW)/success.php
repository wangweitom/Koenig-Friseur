<html>
<head>
    <title>Operation</title>
</head>
<body>

<?php
include("BarberShopCMS.php");
$cmsObject = new BarberShopCMS();
$conn = $cmsObject->connectDB();

///processing updating operation of text
if(isset($_GET["p"])) {
    $sectionName = $_GET["p"];
    echo "p1: ".$_GET["p"]."<br>";
    if (isset($_GET["location"])) {
        $imgPath = $_GET["location"];
        echo "sectionName1: ".$sectionName."<br>";
        $postedImgPath = str_replace(".", "_", $imgPath);
        if (isset($_POST["submitProductInfo$postedImgPath"])) {
            $productName = $_POST["productName$postedImgPath"];
            $productPrice = $_POST["productPrice$postedImgPath"];
            echo "p2: ".$_GET["p"]."<br>";
            echo "sectionName2: ".$sectionName."<br>";
            $cmsObject->updateText($sectionName, $productName, $conn, "productName" . $imgPath);
            $cmsObject->updateText($sectionName, $productPrice, $conn, "productPrice" . $imgPath);
        } else {
            echo "Updating table failed.<br>";
            echo "<a href = 'KoenigFriseurCMS.php#$sectionName'>Click here to return</a>";
        }
    }
}
echo "<script>window.location.href = 'KoenigFriseurCMS.php#$sectionName'</script>";


?>
</body>
</html>