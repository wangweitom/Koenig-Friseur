<?php
$emailState = false;
// if submitted check response
if ($_POST["g-recaptcha-response"]) {

    $secret = '6LeTr0EUAAAAAJ3uOVkuJQsDAnL9qmGEAzl--yrU';
    $response = $_POST['g-recaptcha-response'];
    $remoteip = $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify";

    $post_data = http_build_query(
        array(
            'secret' => $secret,
            'response' => $response,
            'remoteip' => $remoteip
        )
    );

    $options=array(

        'http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $post_data
            )
    );

    $context = stream_context_create( $options );

    $result_json = file_get_contents( $url, false, $context );
    $resulting = json_decode($result_json, true);
    //determine whether the chaptcha is valid, and whether variable has been sent here.
    if($resulting['success'] && isset($_POST["name"]) && isset($_POST["emailAdd"]) && isset($_POST["message"])) {
        //determine whether the form is filled
        if ($_POST["name"] != "" && $_POST["emailAdd"] != "" && $_POST["message"] != "") {
            //determine whether Email address is valid
            if (preg_match("/^([a-zA-Z0-9_-]+\.?)+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+$/", $_POST["emailAdd"])) {
                $to = "triplew13579@gmail.com"; // this is taget Email address
                $from = $_POST["emailAdd"]; // this is the customer's Email address
                $name = $_POST["name"];
                $subject = "Form submission";
                $message = $name . " wrote you a message:" . "\n\n" . $_POST['message'] . "\n\n" . "His/Her email address is: " . $from;
                $headers = "From:" . $from;
                if(mail($to,$subject,$message,$headers)) {
                    $emailState = true;
                    //echo "Mail sent successfully."
                } else {
                    $emailState = false;
                    //echo "Sending failed";
                }
            } else {
                $emailState = false;
                //echo "Email Address not valid";
            }
        } else {
            $emailState = false;
            //echo "form not completed";
        }
    } else {
        $emailState = false;
        //echo "verification failed. Please refresh the former website and try again.";
    }

}else
{
    $emailState = false;
    //echo "captcha not receive";// action for no response
}
?>

<html>
    <head>
        <?php
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
        <link rel="stylesheet" href="assets/css/slides.css"/>

        <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body onload="time()">
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

                        <li><a href="index.php#home">Home</a></li>
                        <li><a href="index.php#about">Über uns</a></li>
                        <li><a href="index.php#service">Service</a></li>
                        <li><a href="index.php#product">Produkte</a></li>
                        <li class="active"><a href="index.php#contact">Kontakt</a></li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <section id="contact" class="sections">
            <div class="heading-content text-center">
                <h3 style="margin-top: 2cm;">
                    <?php
                    if ($emailState == false) {
                    ?>
                    Email sending failed. Please try again.
                    <?php
                    } else {
                    ?>
                    Email has been sent. We will contact you soon.
                    <?php
                    }
                    ?>
                </h3>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="text-center" align="middle">
                    <img src="assets/images/koenig1.jpg" alt=""/>
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
                            <p>
                                <?php
                                echo $cmsObject->getText("contact",$conn, "left");
                                ?>
                            </p>
                        </div>
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
                            <p>
                                <?php
                                echo $cmsObject->getText("contact",$conn, "rightUp");
                                ?>
                            </p>

                            <div class="contact-info">
                                <p><i class="fa fa-map-marker"></i>
                                    <?php
                                    echo $cmsObject->getText("contact",$conn, "rightAddr");
                                    ?>
                                </p>
                                <p><i class="fa fa-phone"></i>
                                    <?php
                                    echo $cmsObject->getText("contact",$conn, "rightTel");
                                    ?>
                                </p>
                                <br>
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

        <div class="scroll-top">

            <div class="scrollup">
                <i class="fa fa-angle-double-up"></i>
            </div>

        </div>

        <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>


        <script src="assets/js/jquery.easypiechart.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/modernizr.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>