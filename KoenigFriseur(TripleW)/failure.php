<html>
<head>
    <title>Operation failed</title>
</head>
<body>
The Operation failed.
<?php
echo $_GET["msg"]."<br><br>";
if(isset($_GET["p"])) {
    $position = $_GET["p"];
    echo "<a href = 'KoenigFriseurCMS.php#$position'>Click here to return</a>";
}
?>
</body>
</html>