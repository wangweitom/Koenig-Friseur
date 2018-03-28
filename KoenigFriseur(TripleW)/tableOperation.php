<html>
<head>
    <title>Table Operation</title>
</head>
<body>
<?php
    include("BarberShopCMS.php");
    $cmsObject = new BarberShopCMS();
    $conn = $cmsObject->connectDB();

    $sectionName = "";
    $rowCount = 0;

    if(isset($_GET["p"])) {
        $sectionName = $_GET["p"];
    }
    if(isset($_GET["rowCount"])) {
        $rowCount = $_GET["rowCount"];
    }

    //Processing submission from updating the table
    if(isset($_POST["submitServiceTable"])) {
        if($cmsObject->deleteTable($sectionName, $conn)) {
            for ($i = 0; $i < $rowCount; $i++) {
                $rowContent["sectionName"] = $sectionName;
                $rowContent["col_0"] = $_POST["$i"."_col_0"];
                $rowContent["col_1"] = $_POST["$i"."_col_1"];
                $cmsObject->updateRow($rowContent, $conn);
            }
            echo "<script>window.location.href = 'KoenigFriseurCMS.php#$sectionName'</script>";
        }else {
            echo "Deleting table failed.<br>";
            echo "<a href = 'KoenigFriseurCMS.php#$position'>Click here to return</a>";
        }
    }

    //Processing submission of adding a new row
    if(isset($_POST["newRow"])){
        $rowContent["sectionName"] = $sectionName;
        $rowContent["col_0"] = "";
        $rowContent["col_1"] = "";
        if($cmsObject->updateRow($rowContent, $conn)){
            echo "<script>window.location.href = 'KoenigFriseurCMS.php#$sectionName'</script>";
        }else{
            echo "Adding row failed.<br>";
            echo "<a href = 'KoenigFriseurCMS.php#$position'>Click here to return</a>";
        }
    }

    //Processing submission of deleting a row
    for($i = 0;$i < $rowCount; $i++) {
        if (isset($_POST["removeRow_$i"])) {
            if (isset($_POST["rowID_$i"])) {
                $rowID = $_POST["rowID_$i"];
                if ($cmsObject->removeRow($rowID, $conn)) {
                echo "<script>window.location.href = 'KoenigFriseurCMS.php#$sectionName'</script>";
                } else {
                    echo "Removing row failed.<br>";
                    echo "<a href = 'KoenigFriseurCMS.php#$position'>Click here to return</a>";
                }
            }
        }
    }
?>
</body>
</html>