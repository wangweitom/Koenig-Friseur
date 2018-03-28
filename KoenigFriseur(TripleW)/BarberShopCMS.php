<?php
///This class is the API of the content management system of the website Koenig Friseur
/// It contains functionalities such as displaying content, database interaction and form handling.
/// Developed by Team TripleW, primary author: Zhengjiang Hu
/// Version 1.2
class BarberShopCMS
{
    private $database = "koenigfriseur";
    private $server = "localhost";
    private $userName = "koenigfriseur";
    private $password = "000000";

    //This function is responsible for connecting to the database
    public function connectDB(){
        $conn = new mysqli($this->server, $this->userName, $this->password, $this->database);
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error."<br>");
        }
        echo "Connected successfully<br>".$conn->connect_error."<br>";


        return $conn;
    }

    //This function is responsible for getting content from the database. This function is mainly used in index.php
    public function getText($sectionName, $conn, $location = "") {
        $content = "";
        $sql = "SELECT * FROM text WHERE sectionName = '$sectionName' AND location = '$location'";

        $results = $conn->query($sql);
        if ($results->num_rows > 0) {
            // output data of each row
            while($row = $results->fetch_assoc()) {
                $content = $row["sectionContent"];
            }
        } else {
            return "0 results<br>";
        }

        return $content;
    }

    //This function is responsible for retriving the image whose path is stored in the database
    public function getImg($sectionName = "", $conn) {
        $querySql = "SELECT * FROM image WHERE sectionName = '$sectionName'";
        $imgSet = $conn->query($querySql);
        return $imgSet;
    }

    //This function is responsible for updating content of the website, mainly used in ContentManager.php
    public function updateText($sectionName, $sectionContent, $conn, $location = "") {


        if(strpos($sectionContent, "'")) {
            $sectionContent = str_replace("'", "''", $sectionContent);
        }
//          $sectionContent = str_replace(" ", "&nbsp", $sectionContent);
          $sectionContent = str_replace("\n", "<br>", $sectionContent);

        $timeStamp = date("d.m.y H:i:s",time());
        $querySql = "SELECT * FROM text WHERE sectionName = '$sectionName' AND location = '$location'";
        $updateSql = "UPDATE text SET sectionContent = '$sectionContent', location = '$location' WHERE sectionName = '$sectionName' AND location = '$location'";
        $insertSql = "INSERT INTO text (sectionName, sectionContent, location, timeStamp) VALUES ('$sectionName', '$sectionContent', '$location', '$timeStamp')";

        $results = $conn->query($querySql);
        if($results->num_rows > 0) {
            if ($conn->query($updateSql) === TRUE) {
                echo "Text updated successfully, please refresh the page<br>";
                echo "<script>window.location.href = 'success.php?p=$sectionName'</script>";
                return true;
            } else {
                echo "Updating text failed: " . $conn->error."<br>";
                echo "<script>window.location.href = 'failure.php?p=$sectionName'</script>";
                return false;
            }
        }else {
            if ($conn->query($insertSql) === true) {
                echo "Text created and saved successfully<br>";
                echo "<script>window.location.href = 'success.php?p=$sectionName'</script>";
                return true;
            } else {
                echo "Text creation failed: " . $conn->error . "<br>";
                echo "<script>window.location.href = 'failure.php?p=$sectionName'</script>";
                return false;
            }
        }
    }

    //This function is responsible for updating images. If the image's path is stored in the database already,
    //then update the path of the image. If the image does not exist, create this image and store its target path in database
    //imgPath: the path of the image to be saved.
    //imgName: the name of the image
    //sectionName: the name of the section where the image belongs to
    //conn: connection object of database
    public function updateImg($imgPath, $imgName, $sectionName, $conn) {
        if(strpos($imgPath, "'")) {
            $imgPath = str_replace("'", "''", $imgPath);
        }
        if(strpos($imgName, "'")) {
            $imgName = str_replace("'", "''", $imgName);
        }

        $timeStamp = date("d.m.y H:i:s",time());
        $querySql = "SELECT * FROM image WHERE imgPath = '$imgPath'";
        $updateSql = "UPDATE image SET imgPath = '$imgPath', imgName = '$imgName', timeStamp = '$timeStamp' WHERE sectionName = '$imgPath'";

        $results = $conn->query($querySql);
        if($results->num_rows > 0) {
            if ($conn->query($updateSql) === true) {
                echo "Image updated successfully, please refresh the page<br>";
                return true;
            } else {
                echo "Updating failed: " . $conn->error . "<br>";
                return false;
            }
        }else {
            $insertSql = "INSERT INTO image (sectionName, imgPath, imgName, timeStamp) VALUES ('$sectionName', '$imgPath', '$imgName', '$timeStamp')";
            if ($conn->query($insertSql) === true) {
                echo "Image created and saved successfully<br>";
                return true;
            } else {
                echo "Image creation failed: " . $conn->error."<br>";
                return false;
            }
        }
    }

    //This function is responsible for updating the content of the table
    //rowContent: the new content of this row
    //rowName: the old name of this row
    public function updateRow($rowContent, $conn){
        $sectionName = $rowContent["sectionName"];
        $col_0 = $rowContent["col_0"];
        $col_1 = $rowContent["col_1"];
        $timeStamp = date("d.m.y H:i:s",time());

        if(strpos($col_0, "'")) {
            $col_0 = str_replace("'", "''", $col_0);
        }
        if(strpos($col_1, "'")) {
            $col_1 = str_replace("'", "''", $col_1);
        }

        $insertSql = "INSERT INTO tabletext (sectionName, col_0, col_1, timeStamp) VALUES ('$sectionName', '$col_0', '$col_1', '$timeStamp')";

            if ($conn->query($insertSql) === true) {
                echo "row created and saved successfully<br>";
                return true;
            } else {
                echo "row creation failed: " . $conn->error."<br>";
                return false;
            }
//        }


    }

    //This function is responsible for getting the content of the table from database
    public function getTable($sectionName, $conn){
        $querySql = "SELECT * FROM tabletext WHERE sectionName = '$sectionName'";
        $rowSet = $conn->query($querySql);
        return $rowSet;
    }

    //This function is responsible for remove a row of the table
    public function removeRow($rowID, $conn){
        $deleteSql = "DELETE FROM tabletext WHERE rowID = $rowID";
        if ($conn->query($deleteSql) === TRUE) {
            echo "row deleted successfully<br>";
            echo "The row has been deleted.<br>";
            return true;
        } else {
            echo "Error occurs when removing the row: " . $conn->error . "<br>";
            return false;
        }
    }

    //This function is responsible for deleting the table
    public function deleteTable($sectionName, $conn){
        $deleteSql = "DELETE FROM tableText WHERE sectionName = '$sectionName'";
        if ($conn->query($deleteSql) === TRUE) {
            echo "table deleted successfully<br>";
            echo "The table has been deleted.<br>";
            return true;
        } else {
            echo "Error occurs when deleting the table: " . $conn->error . "<br>";
            return false;
        }
    }

//This function is responsible for providing editing interface for user to edit the content of web page,
// the position of the code cannot be changed. The identifier "adminForm" must start at position 0 of the line.
public function textEditor($sectionName, $content)
{
    return <<<adminForm
    <form action = "ContentManager.php?page=$sectionName" method = "POST">
        <textarea name = "content" rows = "30" cols = "100">$content</textarea><br>
        <input type = "submit" name = "adminSubmit" value = "update">
    </form>
adminForm;
}

    //Display image editor
    public function imgEditor($sectionName, $conn){
        echo "<p>Add a new picture here</p>
                        <form action = \"<?php echo htmlspecialchars($_SERVER[PHP_SELF]);?>#service\" method = \"POST\" enctype=\"multipart/form-data\">
                            <input type = \"file\" name = \"serviceImg\">
                            <input type = \"submit\" name = \"serviceImg\" value = \"update\" style = \"display:inline-block\">
                        </form>";
        if(isset($_POST["serviceImg"])) {
            $this->uploadImg("assets/images/service/", "serviceImg", "service", $conn);
        }
    }

    //This function is responsible for displaying image on CMS
    public function imgDisplay($imgClass, $imgPath, $sectionName) {
        return "<div class = '$imgClass'>
                    <img src= '$imgPath' alt=''/>
                 </div>
                 <form class = '$imgClass' action = 'delete.php?p=$sectionName&imgPath=$imgPath' method = 'POST' onsubmit = 'return confirmDelete();'>
                    <input type = 'submit' name = 'submitDelete' value = 'Delete Image'>
                 </form>";
    }

    //This function is responsible for displaying image on website
    public function imgFrontEnd($imgClass, $imgPath, $sectionName) {
        return "<div class = '$imgClass'>
                    <img src= '$imgPath' alt=''/>
                 </div>
                 ";
    }

    //This function is responsible for displaying slide on CMS
    public function slideDisplay($imgClass, $imgPath, $imgName, $sectionName, $index, $slideSize) {
        return "<div class = '$imgClass'>
                     <div class = 'index0'>$index / $slideSize</div>
                        <img src='$imgPath' style = 'width:100%'>
                        <form action = 'delete.php?p=$sectionName&imgPath=$imgPath' method = 'POST' onsubmit = 'return confirmDelete();'>
                            <input type = 'submit' name = 'submitDelete' value = 'Delete Image $index'>
                        </form>
                 </div>";
    }

    //This function is responsible for displaying slide on website
    public function slideFrontEnd($imgClass, $imgPath, $imgName, $sectionName, $index, $slideSize) {
        return "<div class = '$imgClass'>
                     <div class = 'index0'>$index / $slideSize</div>
                        <img src='$imgPath' style = 'width:100%'>                    
                 </div>";
    }


    //This function is responsible for displaying multiple slides at a time on CMS
    public function multiSlideDisplay($imgClass, $sectionName, $conn) {
        $imgSet = $this->getImg($sectionName, $conn);
        $index = 1;
        $slideSize = $imgSet->num_rows;
        $inLoop = 3;
        $outLoop = (int)$slideSize/$inLoop;

        for($i = 0; $i < $outLoop; $i++) {

            echo "<div class = '$imgClass'>";

            for($j = 0; $j < $inLoop; $j++) {
                $row = $imgSet->fetch_assoc();
                $imgPath = $row["imgPath"];
                $productName = $this->getText($sectionName, $conn, "productName".$imgPath);
                $productPrice = $this->getText($sectionName, $conn, "productPrice".$imgPath);

                echo "<div class = 'col-md-4 col-sm-4 col-xs-12'>
                            <div class = 'main-team'>
                                <img src='".$imgPath."' alt=''/>
                                <form action = 'delete.php?p=$sectionName&imgPath=$imgPath' method = 'POST' onsubmit = 'return confirmDelete();'>
                                    <input type = 'submit' name = 'submitDelete' value = 'Delete Image $index'>
                                </form>
                                <div class='members-info'>
                                <form action = 'success.php?p=$sectionName&location=$imgPath' method = 'POST'>
                                    <input type = text' name = 'productName$imgPath' value = '$productName'><br>
                                    <input type = text' name = 'productPrice$imgPath' value = '$productPrice'><br>
                                    <input type = 'submit' name = 'submitProductInfo$imgPath' value = 'Update'>
                                </form>
                                </div>
                                <br>
                            </div>
                        </div>";
                }

            echo "</div>";
            $index++;
        }
    }

    //This function is responsible for displaying multiple slides at a time website
    public function multiSlideFrontEnd($imgClass, $sectionName, $conn) {
        $imgSet = $this->getImg($sectionName, $conn);
        $index = 1;
        $slideSize = $imgSet->num_rows;
        $inLoop = 3;
        $outLoop = (int)$slideSize/$inLoop;

        for($i = 0; $i < $outLoop; $i++) {

            echo "<div class = '$imgClass'>";

            for($j = 0; $j < $inLoop; $j++) {
                $row = $imgSet->fetch_assoc();
                $imgPath = $row["imgPath"];
                $productName = $this->getText($sectionName, $conn, "productName".$imgPath);
                $productPrice = $this->getText($sectionName, $conn, "productPrice".$imgPath);

                echo "<div class = 'col-md-4 col-sm-4 col-xs-12'>
                            <div class = 'main-team'>
                                <img src='".$imgPath."' alt='' />
                                <div class='members-info'>
                                    <h4>$productName</h4>
                                    <h6>$productPrice</h6>
                                </div>
                                <br>
                            </div>
                        </div>";

            }
            echo "</div>";
            $index++;

        }
    }

    //This function is responsible for displaying a row of table on CMS
    public function rowDisplay($sectionName, $rowNo, $rowID, $col_0, $col_1){
        echo " <tr name = '$rowNo'>
                    <td name = 'col_1'><input type = 'text' name = '$rowNo"."_col_0' value = '$col_0'/></td>
                    <td name = 'col_2'class='price'><input type = 'text' name = '$rowNo"."_col_1' value = '$col_1'/></td>
                    <input type = 'hidden' name = 'rowID_$rowNo' value = '$rowID'>
                    <td><input type = 'submit' name = 'removeRow_$rowNo' value = '-'></td>
                </tr>";
    }

    //This function is responsible for displaying a row of table on website
    public function rowFrontEnd($sectionName, $rowNo, $col_0, $col_1){
        echo "<tr name = '$rowNo'>
                   <td name = 'col_1'><p>$col_0</p></td>
                   <td name = 'col_2'class='price'><p>$col_1</p></td>
               </tr>";
    }

    //This function is responsible for uploading the image selected by the user to the specific place of the website.
    //The folder here is the destination where this image is going to be saved
    //The source marks the origin where the request of the upload comes from
    public function uploadImg($targetFolder, $source, $sectionName, $conn){
        $validExt = array("jpg", "jpeg", "png", "bmp");
        $selectedImg = $_FILES[$source];

        $imgName = $_FILES[$source]["name"];
        $imgTmpName = $_FILES[$source]["tmp_name"];
        $imgType = $_FILES[$source]["type"];
        $imgErr = $_FILES[$source]["error"];
        $imgSize = $_FILES[$source]["size"];

        //getting the file extention of the selected image unified in lower case.
        $nameAndExt = explode(".", $imgName);
        $imgExt = strtolower(end($nameAndExt));

        if(in_array($imgExt, $validExt)) {
            if($imgErr === 0){
                $targetPath = $targetFolder.$imgName;
                if($this->updateImg($targetPath, $imgName, $sectionName, $conn)) {
                    move_uploaded_file($imgTmpName, $targetPath);
                    echo "Image uploaded successfully. Please refresh the page.<br>";
                    echo "<script>window.location.href = 'success.php?p=$sectionName'</script>";
                }else {
                    echo "Uploading image failed.<br>";
                    echo "<script>window.location.href = 'failure.php?p=$sectionName&msg=Uploading image failed.'</script>";
                }
            }else {
                echo "Error occurs when uploading the image<br>Error message: $imgErr<br>";
                echo "<script>window.location.href = 'failure.php?p=$sectionName&msg=Error occurs when uploading the image<br>Error message: $imgErr'</script>";
            }
        }else {
            echo "This type of image is not allowed to upload or no file has been uploaded.<br>";
            echo "<script>window.location.href = 'failure.php?p=$sectionName&msg=This type of image is not allowed to upload or no file has been uploaded.'</script>";
        }
    }

    //Delete image, both the file and record in database
    //path: the path where the image to be deleted locates
    //conn: connection object of database
    public function deleteImg($imgPath, $conn) {
        if(strpos($imgPath, "'")) {
            $imgPath = str_replace("'", "''", $imgPath);
        }

        $deleteSql = "DELETE FROM image WHERE imgPath = '$imgPath'";

        if(!unlink($imgPath)) {
            echo "Error occurs when deleting the file.<br>";
            return false;
        } else {
            if ($conn->query($deleteSql) === TRUE) {
                echo "Image deleted successfully<br>";
                echo "The file has been deleted.<br>";
                return true;
            } else {
                echo "Error occurs when deleting the image: " . $conn->error."<br>";
                return false;
            }
        }
    }
}
?>
