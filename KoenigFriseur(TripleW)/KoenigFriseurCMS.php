<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <?php
        ///initialization of database and API object
        include("BarberShopCMS.php");
        $cmsObject = new BarberShopCMS();
        $conn = $cmsObject->connectDB();
        ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">-->


        <!--For Plugins external css-->
        <link rel="stylesheet" href="assets/css/plugins.css" />

        <link rel="stylesheet" href="assets/css/raleway-webfont.css" />

        <!--Theme custom css -->
        <link rel="stylesheet" href="assets/css/style.css">

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="assets/css/responsive.css" />

        <!--Slides show css -->
        <link rel="stylesheet" href="assets/css/slidesworking.css"/>
        <link rel="stylesheet" href="assets/css/slideservice.css"/>
        <link rel="stylesheet" href="assets/css/slidesproduct.css"/>

        <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>

    <script>
        function confirmDelete() {
            if (confirm("Do you want to delete it?")) {
                return true;
            } else {
                return false;
            }
        }
    </script>

        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

		<div class='preloader'><div class='loaded'>&nbsp;</div></div>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img class="navbar-logo" src="assets/images/Logo1.png" alt="" /></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">

                        <li class="active"><a href="#home">Home</a></li>
                        <li><a href="#about">Über uns</a></li>
                        <li><a href="#service">Service</a></li>
                        <li><a href="#product">Produkte</a></li>
                        <li><a href="#contact">Kontakt</a></li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <!--Home page style-->
        <header id="home" class="home" style="background: url(<?php
                                $imgSet = $cmsObject->getImg("home", $conn);
                                if ($imgSet->num_rows > 0) {
                                    // output data of each row
                                    while($row = $imgSet->fetch_assoc()) {
                                        echo $row["imgPath"];
                                    }
                                } else {
                                    echo "No image in this section<br>";
                                }
                                ?>) no-repeat center; -moz-background-size: cover; -webkit-background-size: cover; -o-background-size: cover; background-size: cover; width: 100%; overflow: hidden;">
            <div class="overlay-img">
                <div class="container">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="home-content">

                                <h5>Wählen sie könig friseur</h5>
                                <h1>weil wir <span>Professionell</span> und <span>Sachkundig</span> sind</h1>

                                <a target="_blank" href="https://www.facebook.com/KoenigFriseur/"><button class="btn btn-default btn-home"><img src="assets/images/icon/facebook-logo.png" width="25px" height="25px"> 4.9&nbsp;&nbsp;&nbsp;★ ★ ★ ★ ★<span></span></button></a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <p>Edit the main picture here</p>
        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#home" method = "POST" enctype="multipart/form-data">
            <input type = "file" name = "mainImg">
            <input type = "submit" name = "submitMainImg" value = "update" style = "display:inline-block">
        </form>

        <?php
        ///Display main image on the background of home
        $imgSet = $cmsObject->getImg("home", $conn);
        $imgPath = "";
        $sectionName = "";
        if ($imgSet->num_rows > 0) {
            // output data of each row
            while($row = $imgSet->fetch_assoc()) {
                $imgPath = $row["imgPath"];
                $sectionName = $row["sectionName"];
            }
        } else {
            echo "No image in this section<br>";
        }
        ///the image editor, interface for user to edit the image
        echo "<form class = 'imgEditor' action = 'delete.php?p=$sectionName&imgPath=$imgPath' method = 'POST' onsubmit = 'return confirmDelete();'>
                    <input type = 'submit' name = 'submitDelete' value = 'Delete Image'>
               </form>";
        ?>


        <?php
        ///Handle input from user
        if(isset($_POST["submitMainImg"])) {
            $imgSet = $cmsObject->getImg("home", $conn);
            if ($imgSet->num_rows > 0) {
                // output data of each row
                if(isset($_FILES["mainImg"]) && !empty($_FILES["mainImg"])) {
                    while ($row = $imgSet->fetch_assoc()) {
                        $cmsObject->deleteImg($row["imgPath"], $conn);
                    }
                    $cmsObject->uploadImg("assets/images/mainimage/", "mainImg", "home", $conn);
                }
            } else {
                echo "No image to delete<br>";
                $cmsObject->uploadImg("assets/images/mainimage/", "mainImg", "home", $conn);
            }

        }
        ?>

        <!-- Sections -->
        <section id="about" class="sections">

            <div class="heading-content text-center">

                <h3>Über uns</h3>

                <div class="separator"></div>

            </div>

            <div class="about-bg">
                <div class="container">

                    <!-- Example row of columns -->
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="about-content">

                                <h3>Wir sind am besten</h3>
                                <div class = "textEditor">
                                    <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#about" method = "POST">
                                        <textarea name = "aboutText" rows = "17" cols = "75"><?php
                                            $text = $cmsObject->getText("about",$conn);
                                            $text = str_replace("<br>", "\n", $text);
                                            echo $text;
                                            ?>
                                        </textarea>
                                        <input type = "submit" name = "submitAboutText">
                                    </form>
                                </div>
                                <?php
                                if(isset($_POST["submitAboutText"])) {
                                    $sectionContent = $_POST["aboutText"];
                                    $cmsObject->updateText("about", $sectionContent, $conn);
                                }
                                ?>

                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                            $imgSet = $cmsObject->getImg("about", $conn);
                            if ($imgSet->num_rows > 0) {
                                // output data of each row
                                while($row = $imgSet->fetch_assoc()) {
                                    echo $cmsObject->imgDisplay("about-img", $row["imgPath"], $row["sectionName"]);
                                }
                            } else {
                                echo "No image in this section<br>";
                            }
                            ?>
                        </div>

                    </div>
                </div> <!-- /container -->
            </div>
            <p>Edit the über uns picture here</p>
            <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#about" method = "POST" enctype="multipart/form-data">
                <input type = "file" name = "aboutImg">
                <input type = "submit" name = "submitAboutImg" value = "update" style = "display:inline-block">
            </form>
            <?php
            if(isset($_POST["submitAboutImg"])) {
                $imgSet = $cmsObject->getImg("about", $conn);
                if ($imgSet->num_rows > 0) {
                    // output data of each row
                    if(isset($_FILES["aboutImg"]) && !empty($_FILES["aboutImg"])) {
                        while ($row = $imgSet->fetch_assoc()) {
                            $cmsObject->deleteImg($row["imgPath"], $conn);
                        }
                        $cmsObject->uploadImg("assets/images/about/", "aboutImg", "about", $conn);
                    }
                } else {
                    echo "No image to delete<br>";
                    $cmsObject->uploadImg("assets/images/about/", "aboutImg", "about", $conn);
                }

            }
            ?>

        </section>


        <!-- Sections -->
        <section id="team" class="sections lightbg">
            <div class="container text-center">
                <div class="heading-content text-center">

                    <h3>Since 2007</h3>

                    <div class="separator"></div>


                </div>
                <!-- Example row of columns -->

                <div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- This slides show is referred to the tutorial on W3School. src: https://www.w3schools.com/howto/howto_js_slideshow.asp -->
                        <!-- Slideshow container -->
                        <div class="slideshow-container0">
                            <?php
                            $slideSet = $cmsObject->getImg("team", $conn);
                            if ($slideSet->num_rows > 0) {
                                $index = 1;
                                $slideSize = $slideSet->num_rows;
                                // output data of each row
                                while($row = $slideSet->fetch_assoc()) {
                                    echo $cmsObject->slideDisplay("slides0 faded0", $row["imgPath"], $row["imgName"], $row["sectionName"], $index, $slideSize);
                                    $index++;
                                }
                            } else {
                                echo "No image in this section<br>";
                            }
                            ?>



                            <!-- Next and last buttons -->
                            <a class="last0" onclick="lastSlides0()">&#10094;</a>
                            <a class="next0" onclick="nextSlides0()">&#10095;</a>
                        </div>
                        <script src = "assets/js/slidesworkingcms.js"></script>
                </div>
            </div> <!-- /container -->

            <p>Add a new team picture here</p>
            <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#team" method = "POST" enctype="multipart/form-data">
                <input type = "file" name = "teamImg">
                <input type = "submit" name = "submitTeamImg" value = "update" style = "display:inline-block">
            </form>
            <?php
            if(isset($_POST["submitTeamImg"])) {
                $cmsObject->uploadImg("assets/images/team/", "teamImg", "team", $conn);
            }
            ?>
        </section>







    <section id="service" class="sections">

        <div class="heading-content text-center">
                <div class="heading-title">
                    <h3>Service</h3>

                    <div class="separator"></div>

                </div>

        </div>
        <div class="about-bg">
            <div class="container">

                <!-- Example row of columns -->
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="about-content">

                            <h3>Preisliste</h3>
                            <?php
                                //Display the content of the table
                                $rowSet = $cmsObject->getTable("service", $conn);
                                $rowCount = $rowSet->num_rows;
                                $rowNo = 0;
                            echo "<form action = 'tableOperation.php?p=service&rowCount=$rowCount' method = 'POST'>";
                            ?>
                            <table width="100%">

                                <?php
                                if ($rowSet->num_rows > 0) {
                                    // output data of each row
                                    while($row = $rowSet->fetch_assoc()) {
                                        $rowID = $row["rowID"];
                                        $cmsObject->rowDisplay("service", $rowNo, $rowID, $row["col_0"], $row["col_1"]);
                                        $rowNo++;
                                    }
                                } else {
                                    echo "No content in this section<br>";
                                }
                                ?>

                            </table>
                                <input type = "submit" name = "newRow" value = "New row">
                                <input type = "submit" name = "submitServiceTable" value = "update">
                            </form>

                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div style="padding-top: 80px; padding-bottom: 60px;">
                            <div class="slideshow-container1">

                                <?php
                                $slideSet = $cmsObject->getImg("service", $conn);
                                if ($slideSet->num_rows > 0) {
                                    $index = 1;
                                    $slideSize = $slideSet->num_rows;
                                    // output data of each row
                                    while($row = $slideSet->fetch_assoc()) {
                                        echo $cmsObject->slideDisplay("slides1 faded1", $row["imgPath"], $row["imgName"], $row["sectionName"], $index, $slideSize);
                                        $index++;
                                    }
                                } else {
                                    echo "No image in this section<br>";
                                }
                                ?>


                                <!-- Next and last buttons -->
                                <a class="last1" onclick="lastSlides1()">&#10094;</a>
                                <a class="next1" onclick="nextSlides1()">&#10095;</a>
                            </div>
                            <script src = "assets/js/slidesservicecms.js"></script>
                        </div>
                        <p>Add a new service picture here</p>
                        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#service" method = "POST" enctype="multipart/form-data">
                            <input type = "file" name = "serviceImg">
                            <input type = "submit" name = "submitServiceImg" value = "update" style = "display:inline-block">
                        </form>
                        <?php
                        if(isset($_POST["submitServiceImg"])) {
                            $cmsObject->uploadImg("assets/images/service/", "serviceImg", "service", $conn);
                        }
                        ?>
                    </div>

                </div>
            </div> <!-- /container -->
        </div>
		<!-- Sections -->




    </section>

    <!-- Sections -->
    <section id="product" class="sections lightbg">
        <div class="container text-center">
            <div class="heading-content text-center">

                <h3>Produkte</h3>

                <div class="separator"></div>

                <p><?php echo $cmsObject->getText("product",$conn); ?></p>

            </div>

                <div class="slideshow-container2">

                    <?php
                    $cmsObject->multiSlideDisplay("slides2 faded2", "product", $conn);
                    ?>

                    <!-- Next and last buttons -->
                    <a class="last2" onclick="lastSlides2()">&#10094;</a>
                    <a class="next2" onclick="nextSlides2()">&#10095;</a>
                    <div class="space"></div>
                </div>
                <script src = "assets/js/slidesproductcms.js"></script>
        </div><!-- /container -->
        <p>Add a new product picture here</p>
        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#product" method = "POST" enctype="multipart/form-data">
            <input type = "file" name = "productImg">
            <input type = "submit" name = "submitProductImg" value = "update" style = "display:inline-block">
        </form>
        <?php
        if(isset($_POST["submitProductImg"])) {
            $cmsObject->uploadImg("assets/images/product/", "productImg", "product", $conn);
        }
        ?>
    </section>


    <!-- Sections -->
    <section id="our-client" class="sections different-bg">
        <div class="container text-center">

            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">


                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="10000">


                        <!-- Wrapper for slides -->
						<h3>What Our Customers are saying</h3>
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="client-content">
                                    <div class = "facebookComment" style = "position:relative;">
                                        <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fmarie.christine.5686%2Fposts%2F1777139828963567%3A0&width=750&show_text=true&height=421&appId" width="100%" height="524" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="client-content">
                                    <div class = "facebookComment" style = "position:relative;">
                                        <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fdomenic.krf%2Fposts%2F105612636891694%3A0&width=750&show_text=true&height=360&appId" width="100%" height="524" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="client-content">
                                    <div class = "facebookComment" style = "position:relative;">
                                        <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fvural.duran1%2Fposts%2F1445108052240338%3A0&width=750&show_text=true&height=360&appId" width="100%" height="524" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                                    </div>
                                </div>
                            </div>

                            <div class="client-basicinfo">
                                <h6>@KoenigFriseur</h6>
                                <a href="https://www.facebook.com/KoenigFriseur/" target="_blank">https://www.facebook.com/KoenigFriseur/</a>
                            </div>

                        </div>

						<!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>

                    </div>

                    <div><p><br></p></div>

                    <div>
                        <script type="text/javascript">
                            var review_token = 'zcSQDmRKPBdEMQzZ8he0jXjCk5wDngTuinj7lfWEzFiGZV3S0p';
                            var review_target = 'review-container';
                        </script>
                        <script src="https://reviewsonmywebsite.com/js/embed.js" type="text/javascript"></script>
                        <div id="review-container"></div>
                        <div><p><br></p></div>
                        <div class="client-basicinfo">
                            <h6>König-Friseur</h6>
                            <a href="https://www.google.de/maps/place/König-Friseur/" target="_blank">hhttps://www.google.de/maps/place/König-Friseur/</a>
                        </div>
                    </div>

                </div>

            </div>
        </div> <!-- /container -->
    </section>

    <section id="contact" class="sections lightbg">
        <div class="container">
            <div class="heading-content text-center">
                <div class="heading-title">
                    <h3>Kontakt</h3>
                </div>

            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">

                    <form action="sendmail.php" method="post" onsubmit="return validation();">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name*" name="name">
                                <p id="nameerror"></p>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email*" name="emailAdd">
                                <p id="emailerror"></p>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <textarea class="form-control txt-area" rows="5" placeholder="Message . . ." name="message"></textarea>
                                <p id="messageerror"></p>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="g-recaptcha middle" data-sitekey="6LcF2T8UAAAAABTE3tQN1CFJdwYNTaTnkNJ7vr8z"></div>
                            <p id="recaptchaerror" class="middle"></p>
                        </div>

                        <div class="submit-btn"><button type="submit" class="btn btn-default abt-btn">senden</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!--Footer-->
    <footer id="footer" class="sections footer different-bg">

        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-first-content">
                        <div class="logo"><img src="assets/images/footer-logo.png" alt="Company Logo" /></div>
                        <div class = "textEditor">
                            <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#contact?location=left" method = "POST">
                                        <textarea name = "footerLeftText" rows = "8" cols = "30"><?php
                                            $text = $cmsObject->getText("contact",$conn, "left");
                                            $text = str_replace("<br>", "\n", $text);
                                            echo $text;
                                            ?>
                                        </textarea>
                                <input type = "submit" name = "submitFooterLeft">
                            </form>
                        </div>
<!--                        <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore.</p>-->
<!--                        <p>eugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta</p>-->
                    </div>
                    <?php
                    if(isset($_POST["submitFooterLeft"])) {
                        $sectionContent = $_POST["footerLeftText"];
                        $cmsObject->updateText("contact", $sectionContent, $conn, "left");
                    }
                    ?>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="footer-mid-content">
                        <h4>Our Location</h4>
                        <div class = "map" style = "position:relative; left:0%;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2352.8093201283505!2d10.68416635171193!3d53.864038543410295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b2095a393f9e83%3A0xb85de641da729428!2sK%C3%B6nig-Friseur!5e0!3m2!1sen!2sde!4v1515318547732" width="100%" height="220" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-last-content">
                        <h4>Our Address</h4>
                        <div class = "textEditor">
                            <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#contact?location=rightUp" method = "POST">
                                        <textarea name = "footerRightUpText" rows = "4" cols = "30"><?php
                                            $text = $cmsObject->getText("contact",$conn, "rightUp");
                                            $text = str_replace("<br>", "\n", $text);
                                            echo $text;
                                            ?>
                                        </textarea>
                                <input type = "submit" name = "submitFooterRightUp">
                            </form>
                        </div>
                        <?php
                        if(isset($_POST["submitFooterRightUp"])) {
                            $sectionContent = $_POST["footerRightUpText"];
                            $cmsObject->updateText("contact", $sectionContent, $conn, "rightUp");
                        }
                        ?>
<!--                        <p>Öffnungszeiten: <br>Mo. - Fr. 09.00 - 19.00 Uhr <br>Sa. 09.00 - 18.00 Uhr</p>-->

                        <div class="contact-info">

                            <?php
                            if(isset($_POST["submitFooterRightAddr"])) {
                                $sectionContent = $_POST["footerRightAddrText"];
                                $cmsObject->updateText("contact", $sectionContent, $conn, "rightAddr");
                            }
                            ?>
                            <p><i class="fa fa-map-marker"></i>
                            <div class = "textEditor">
                                <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#contact?location=rightAddr" method = "POST">
                                        <textarea name = "footerRightAddrText" rows = "1" cols = "30"><?php
                                            $text = $cmsObject->getText("contact",$conn, "rightAddr");
                                            $text = str_replace("<br>", "\n", $text);
                                            echo $text;
                                            ?>
                                        </textarea>
                                    <input type = "submit" name = "submitFooterRightAddr">
                                </form>
                            </div>
                            </p>
                            <?php
                            if(isset($_POST["submitFooterRightAddr"])) {
                                $sectionContent = $_POST["footerRightAddrText"];
                                $cmsObject->updateText("contact", $sectionContent, $conn, "rightAddr");
                            }
                            ?>

                            <p><i class="fa fa-phone"></i>
                            <div class = "textEditor">
                                <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#contact?location=rightTel" method = "POST">
                                        <textarea name = "footerRightTelText" rows = "1" cols = "30"><?php
                                            $text = $cmsObject->getText("contact",$conn, "rightTel");
                                            $text = str_replace("<br>", "\n", $text);
                                            echo $text;
                                            ?>
                                        </textarea>
                                    <input type = "submit" name = "submitFooterRightTel">
                                </form>
                            </div>
                            </p>
                            <?php
                            if(isset($_POST["submitFooterRightTel"])) {
                                $sectionContent = $_POST["footerRightTelText"];
                                $cmsObject->updateText("contact", $sectionContent, $conn, "rightTel");
                            }
                            ?>
                            <p><br></p>
                            <p>
                                <a href="https://www.facebook.com/KoenigFriseur/" target="_blank"><img id="facebook" src="assets/images/icon/icon-facebook.jpg" alt="Facebook" onmouseover="flashFB()" onmouseout="flashbackFB()"/></a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="https://www.instagram.com/koenig_friseur/" target="_blank"><img id="instagram" src="assets/images/icon/icon-instagram.jpg" alt="Instagram" onmouseover="flashINS()" onmouseout="flashbackINS()"/></a>
                            </p>
                        </div>

                    </div>
                </div>

            </div>



        </div>

    </footer>

	<div class="scroll-top">

		<div class="scrollup">
			<i class="fa fa-angle-double-up"></i>
		</div>

	</div>

	<footer class="copyright-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="copyright text-center">
						<p>Made with <i class="fa fa-heart"></i> by <a target="_blank" href="http://bootstrapthemes.co"> Bootstrap Themes </a>2016. All rights reserved. Website developed by TripleW (Chen Xu, Hu Zhengjiang, Wang Wei).</p>
					</div>
				</div>
			</div>
		</div>
	</footer>

    <script>
        function confirmDelete() {
            if (confirm("Do you want to delete it?")) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>


    <script src="assets/js/jquery.easypiechart.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/modernizr.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/contactvalidation.js"></script>
    <script src="assets/js/flash.js"></script>

</body>
</html>
