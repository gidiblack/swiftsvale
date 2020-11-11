<?php
    //Import PHPMailer class into the global namespace
    use PHPMailer\PHPMailer\PHPMailer;
    

    $msg = '';
    //Don't run this unless we're handling a form submission
    if (array_key_exists('email', $_POST)) {
        date_default_timezone_set('Etc/UTC');
        require 'vendor/autoload.php';

        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        
        //Send using SMTP to localhost (faster and safer than using mail()) – requires a local mail server
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'swiftvale.com@gmail.com';
        $mail->Password = 'swiftvale123';
        $mail->Port = 587;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = 'tls';

        // SMTP::DEBUG_SERVER = client and server messages
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; 

        //Use a fixed address in your own domain as the from address
        //**DO NOT** use the submitter's address here as it will be forgery
        //and will cause your messages to fail SPF checks
        // echo "trying to send";
        $mail->setFrom('swiftvale.com@gmail.com', 'Swiftvale Logistics');
        
        //Choose who the message should be sent to
        //the important thing is *not* to trust an email address submitted from the form directly,
        //as an attacker can substitute their own and try to use your form to send spam
            $mail->addAddress('info@swiftvale.com');
        //Put the submitter's address in a reply-to header
        //This will fail if the address provided is invalid,
        //in which case we should ignore the whole request
        
        if ($mail->addReplyTo($_POST['email'], $_POST['fullName'])) {
            $mail->Subject = 'I want a free quote';
            //Keep it simple - don't use HTML
            $mail->isHTML(false);
            //Build a simple message body
            $mail->Body = " Email: {$_POST['email']} \r\n
                            Name: {$_POST['fullName']} \r\n
                            Pickup Contact Number: {$_POST['pickupNumber']} \r\n
                            Delivery Contact Number: {$_POST['deliveryNumber']} \r\n
                            Message: I would like to move a package from {$_POST['movingFrom']} to {$_POST['movingTo']}";
            //Send the message, check for errors
            
            // echo "trying to send";
            
            if (!$mail->send()) {
                //The reason for failing to send will be in $mail->ErrorInfo
                //but it's unsafe to display errors directly to users - process the error, log it on your server.
                $mail->ErrorInfo;
                $msg = 'Sorry, something went wrong. Please try again later.';
            } else {
                $msg = 'Message sent! Thanks for contacting us.';
            }
        } else {
            $msg = 'Invalid email address, message ignored.';
        }
    }

?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SwiftVale Logistics</title>
    <meta name="description" content="Rendering quality service by providing EASY, FAST, RELIABLE dispatch bikes and trucks accross major LGA & LCDA in Lagos state and accross Nigeria.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon-16x16.png">

    <!--Google Font link-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/93c48aecb0.js" crossorigin="anonymous"></script>

    <!-- custom css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>


<body>
    <header>
        <!-- top nav -->
    <div class="navbar__top bg-main">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="navbar__callus">
                        <ul>
                            <li><a class="text-white" href="#"><i class="fas fa-phone"></i> Call us: 07058930124, 09087210137</a></li>
                            <li><a class="text-white" href="#"><i class="fas fa-envelope"></i> Contact us: info@swiftvale.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="navbar__social">
                        <ul class="">
                            <li><a href=""><i class="fab fa-facebook-f text-white"></i></a></li>
                            <li><a href=""><i class="fab fa-twitter text-white"></i></a></li>
                            <li><a href=""><i class="fab fa-instagram text-white"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/images/swiftvale-logo-inverted.svg" alt="swiftvale-logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#services">Services</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    </header>

    <!--Home Section-->
    <section id="home" class="home">
        <div class="overlay"></div>
        <div class="hero container">
            <div class="row">
                <div class="col-md-6 my-auto pb-5">
                    <h1 class="hero-heading">Easy. Fast. Reliable!</h1>
                </div>
                <div class="col-md-6">
                <?php if (!empty($msg)) {
                    echo "<h2>$msg</h2>";
                } ?>
                <!-- Get qoute form -->
                    <form class="getQuote text-white bg-main" method="POST" action="index.php">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="movingFrom">Pickup address</label>
                                <input type="text" class="form-control" name="movingFrom" id="movingFrom" placeholder="Enter pickup address" required >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="movingTo">Delivery address</label>
                                <input type="text" class="form-control" name="movingTo" id="movingTo" placeholder="Enter delivery address" required >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pickupNumber">Pickup contact number</label>
                                <input type="tel" class="form-control" name="pickupNumber" id="pickupNumber" placeholder="Enter Pickup contact" required >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="deliveryNumber">Delivery contact number</label>
                                <input type="tel" class="form-control" name="deliveryNumber" id="deliveryNumber" placeholder="Enter Delivery contact" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fullName">Full Name</label>
                                <input type="text" class="form-control" name="fullName" id="fullName" placeholder="Enter Full Name">
                            </div>
                            
                                <div class="form-group col-md-6">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                                </div>
                            <input type="submit" class="btn btn-primary mx-auto mt-3 text-uppercase" value="request quote"></input>
                        </div>
                    </form>
                </div>
            </div><!--End off row-->
        </div><!--End off container -->
    </section> <!--End off Home Sections-->

    <!--About Section-->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6 my-5">
                    <div id="about-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="assets/images/despatch-truck-1.png" class="d-block w-100" alt="despatch-truck-1">
                          </div>
                          <div class="carousel-item">
                            <img src="assets/images/despatch-truck-2.png" class="d-block w-100" alt="despatch-truck-2">
                          </div>
                          <div class="carousel-item">
                            <img src="assets/images/design.jfif" class="d-block w-100" alt="logistics">
                          </div>
                        </div>
                        <a class="carousel-control-prev" href="#about-carousel" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#about-carousel" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6  my-5">
                    <h2 class="heading">About</h2>

                    <p class="mt-3">SwiftVale is a logistic company founded in Nigeria, its head office is situated at No 5 Mudashiru awe street, Jibowu Yaba Lagos. One of our core objective is to provide haulage and logistics services to our client. Our logistic services are design to ensure that every of our customer is carefully co-ordinated and managed.</p>
                    <p class="mt-3">Our professional team ensure that goods always get to their designated location and more importantly to continuously keep that smile on the face of our customer.</p>
                </div>
            </div>
        </div>
    </section><!-- End off About section -->


    <!--Services Section-->
    <section id="services" class="services">
        <div class="container">
            <div class="service__heading mb-5">
                <h2 class="heading text-center mb-4">Our Services</h2>
                <p>We strive to understand the specific needs and expectations of our customer and work closely to achieving it. We work 24hours a day and 365 days to ensure that our customer needs are met and ensure full commitment to our customer goals and objectives. We provide pan Nigeria services through our dedicated service.</p>
            </div>
            <div class="row">
                <div class="col-md-4 my-4">
                    <div class="service__item">
                        <i class="fas fa-truck-loading"></i>
                        <h3>LOADING PROCESS</h3>
                        <p>Trucks are loaded in turns as they arrive the DC. Driver is asked to position at the loading bar with the help of a safety marshal using the dock-leveller.</p>
                        <p>The loading team comprises of three personnel with driver inclusive. The warehouse representative (Tally clerk) and the security officer for proper and accurate checkmating while loading.</p>
                        <p>The driver is mandated to have a writing material for proper documentation and reconciliation with the loading team after each loading.</p>
                    </div>
                </div>
                <div class="col-md-4 my-4">
                    <div class="service__item">
                        <i class="fas fa-truck-moving"></i>
                        <h3>DESPATCH</h3>
                        <p>After every loading driver is expected to proceed to the dispatch office situated close to the transport office to pick up his loading waybills and check properly to ensure what is loading into his truck tallies with what is documented on the waybill.</p>
                    </div>
                </div>
                <div class="col-md-4 my-4">
                    <div class="service__item">
                        <i class="fas fa-gas-pump"></i>
                        <h3>DIESEL ALOCATION</h3>
                        <p>The operational manager is always available to give directive on diesel issuance. He/she informs the transport team on the quantity of diesel to issue to driver. The driver then picks up a duly sign form from by the operations manager from the transport office and proceeds to the fuel dump site which is situated within the premises for collection of diesel.</p>
                    </div>
                </div>
                <div class="col-md-6 my-4">
                    <div class="service__item">
                        <i class="fas fa-sliders-h"></i>
                        <h3>EXPECTED DAYS OF DELIEVERY.</h3>
                        <p>Lagos                           1day</p>
                        <p>West                            2days</p>
                        <p>South central (SC)      3days</p>
                        <p>South East (SE)           3days</p>
                        <p>North East (NE)          4days</p>
                        <p>North Central (NC)    4days</p>
                        <p>North West (NW)      4days</p>
                        <p>Middle Belt (MB)      4days</p>
                        <p>Trucks are expected to do deliveries between the expected delivery days except on exceptional cases, which must be communicated by via mail or phone calls to the client within a close number of hours. And issues must be resolve within a very short period of time to avoid delay or late delivery.</p>
                    </div>
                </div>
                <div class="col-md-6 my-4">
                    <div class="service__item">
                        <i class="fas fa-tablet-alt"></i>
                        <h3>SECURITY AND TRACKING</h3>
                        <p>We have a robust 24hrs security system that is responsible for resolving issues with government officials on the road also securing the life and properties of both the driver, goods and the truck, which is at a cost monthly.</p>
                        <p>We run an electronic tracking device that is used to monitor the current location of the trucks per time when driver is on transit to the customer outlet, the device is been managed by a third-party company Salcomms Nigeria limited. This service attracts an annual cost which will be shared with you in due cause.</p>
                    </div>
                </div>
            </div><!-- End off row -->
        </div><!-- End off container -->
    </section><!-- End off Services Section-->

    <!--Contact Us section-->
    <h2 class="heading text-center">Contact Us</h2>
    <section id="contact" class="action bg-main">
        <div class="container">
            <div class="maine_action">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.020666939854!2d3.36759341477066!3d6.519067195284564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b8c51f86ec0d5%3A0x11422c827118cc4d!2s5+Alhaji+Mudashiru+Awe+St%2C+Jibowu+100001%2C+Lagos!5e0!3m2!1sen!2sng!4v1542197423681" width="1150" height="450" frameborder="0" style="border:0; max-width:100%" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <footer class="footer action-lage bg-black">
        <div class="container">
            <div class="row">
                <div class="col-md-3 my-3">
                    <h4 class="text-white">About Us</h5>
                    <p class="mt-3">SwiftVale is a logistic company founded in Nigeria. One of our core objective is to provide haulage and logistics services to our client. Our logistic services are design to ensure that every of our customer is carefully co-ordinated and managed.</p>
                </div><!-- End off col-md-3 -->

                <div class="col-md-3 my-3">
                    <h4 class="text-white">Contact</h5>
                        <div class="widget_ab_item">
                            <div class="item_icon"><i class="fas fa-location-arrow"></i></div>
                            <div class="widget_ab_item_text">
                                <div class="widget_item widget_newsletter sm-m-top-50">

                                <h6 class="text-white">Location</h6>
                                <p>No 5 Mudashiru awe street, Jibowu Yaba Lagos.</p>
                            </div>
                        </div>
                        <div class="widget_ab_item">
                            <div class="item_icon"><i class="fas fa-phone"></i></div>
                            <div class="widget_ab_item_text">
                                <h6 class="text-white">Phone :</h6>
                                <p>07058930124, 09087210137</p>
                            </div>
                        </div>
                        <div class="widget_ab_item">
                            <div class="item_icon"><i class="fas fa-envelope"></i></div>
                            <div class="widget_ab_item_text">
                                <h6 class="text-white">Email Address :</h6>
                                <p>info@swiftvale.com</p>
                            </div>
                        </div>
                    </div><!-- End off widget item -->
                </div><!-- End off col-md-3 -->

                <div class="col-md-3 my-3">
                    <h4 class="text-white text-uppercase">swiftvale</h4>
                    <p>We are a Logistics Company</p>
                    <ul class="social-icons">
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div><!-- End off col-md-3 -->

                <div class="col-md-3 my-3">
                    <div class="widget_item widget_newsletter">
                        <h4 class="text-white">Newsletter</h5>
                        <form class="form-inline m-top-30">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter you Email">
                                <button type="submit" class="btn text-center"><i class="fas fa-arrow-right"></i></button>
                            </div>
                        </form>
                    </div><!-- End off widget item -->
                </div><!-- End off col-md-3 -->
            </div>
        </div>
        <div class="footer__bottom bg-main text-white text-center">
            <p>copyright &copy; <a target="_blank" href="https://swiftvale.com">Swiftvale</a> 2020. All Rights Reserved</p>
        </div>
    </footer>

    <!-- Preloader -->
    <!-- <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_four"></div>
            </div>
        </div>
    </div> -->
    <!--End off Preloader -->
</body>
    <!-- Jquery, Popper & Bootstrap js CDN -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="assets/js/main.js"></script>
</html>
