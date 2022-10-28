<?php
include "functions/sql_conn.php";

$sql = "SELECT `additional_value` FROM `user_info` WHERE `description` = 'platforms'";
$query = mysqli_query($mysqli, $sql);
$data = mysqli_fetch_all($query)[0][0];
$platforms = json_decode($data);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al Evan Castillo | Portfolio</title>
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/a2501cd80b.js" crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity=" sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.5/waypoints.min.js"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Typed.js -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

    <!-- Local Files -->
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3 fixed-top">
        <a class="navbar-brand mx-2 py-0 align-middle" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 226.88 334.71" width="32" height="40">
                <defs>
                    <style>
                        .cls-1 {
                            fill: #fff;
                            stroke: #fff;
                            stroke-miterlimit: 10;
                            stroke-width: 12px;
                        }
                    </style>
                </defs>
                <g id="Layer_2" data-name="Layer 2">
                    <g id="Layer_1-2" data-name="Layer 1">
                        <g id="Layer_2-2" data-name="Layer 2">
                            <g id="Layer_1-2-2" data-name="Layer 1-2">
                                <path class="cls-1" d="M212.42,227.67c-.55-1.34-.91-2.33-1.35-3.28q-19.23-40.9-38.42-81.84c-1-2.15-2.12-2.94-4.55-2.93-23.6.09-47.21.06-70.84.06-1,0-2.19.33-2.86-.13-1.1-.76-2.59-2-2.59-3.1s1.43-2.34,2.53-3.11c.65-.45,1.87-.13,2.85-.13h71L113.39,16.51c-.7,1.42-1.22,2.42-1.73,3.46Q62.42,124.73,13.16,229.5c-.54,1.16-.95,2.59-1.88,3.31s-2.83,1.25-3.61.76c-1-.62-1.51-2.33-1.66-3.63-.1-.93.73-2,1.19-2.95L109,10.44a6,6,0,0,1,.87-1.73c1.1-1,2.31-2.7,3.45-2.71s2.86,1.45,3.46,2.69c4,8.1,7.78,16.32,11.62,24.51Q151.24,81.86,174,130.56a4,4,0,0,0,4.32,2.71c12.5-.12,25-.07,37.51,0,1.15,0,2.6,0,3.37.62s1.78,2.67,1.43,3.12c-.92,1.18-2.5,2.59-3.83,2.59-11.42.21-22.85.12-34.28.12H178.5c.56,1.33,1,2.38,1.43,3.38l39.51,83.81a25.13,25.13,0,0,1,1.18,2.65c.79,2.3-.25,4.09-2.65,4.48a20.35,20.35,0,0,1-3.22.1H98.37v88H214.91c1,0,2.17-.36,2.86.09,1.2.8,2.87,2.07,2.87,3.15s-1.73,2.3-2.88,3.13c-.58.41-1.68.09-2.54.09h-118c-4.94,0-5.53-.59-5.53-5.58V233.08c0-4.77.64-5.41,5.37-5.41Z" />
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
            Al Evan Castillo
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".nav-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center nav-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" id="nav-home">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item" id="nav-aboutme">
                    <a class="nav-link" href="#aboutme">About Me</a>
                </li>
                <li class="nav-item" id="nav-certificates">
                    <a class="nav-link" href="#certificates">Certificates</a>
                </li>
                <li class="nav-item" id="nav-projects">
                    <a class="nav-link" href="#projects">Projects</a>
                </li>
                <li class="nav-item" id="nav-contact">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse flex-grow-0 nav-collapse flex-row">
            <ul class="navbar-nav mr-auto flex-row justify-content-around">
                <li class="nav-item">
                    <a class="nav-link" href="https://facebook.com"><i class="fa-brands fa-facebook-f"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://instagram.com"><i class="fa-brands fa-instagram"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com"><i class="fa-brands fa-github"></i></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="section" id="home">
        <div class="text w-25 p-3">
            <h4>Hi I'm</h4>
            <h2>Al Evan Castillo</h2>
            <hr>
            <p><a class="typer"></a> Developer</p>
            <br>
            <p>I'm a System and Mobile Developer and currently a BS Information Technology Student at <a href="https://up.phinma.edu.ph">PHINMA - University of Pangasinan</a></p>
        </div>

        <img src="assets/home.png" alt="">
    </div>
    <hr>
    <div class="section" id="aboutme">
        <img src="assets/aboutme.png" alt="">

        <div class="details w-25 p-3">
            <p>Hi! I'm <strong>Al Evan Castillo</strong>, a 4th year Bachelor of Science in Information Technology Student
                from <a href="https://up.phinma.edu.ph">PHINMA - University of Pangasinan</a>. I mainly develop mobile
                applications but I've also tried developing for desktop and web systems, and even games!</p>
            <p>When I was a kid, I found computers fascinating and even dreamt of developing my own Operating System. That's
                why I chose to pursue this degree. I've learnt my first programming language (Java) during my Senior High School
                days and immediately fell in love with it and the rest is history.
            </p>
            <button type="button" class="btn btn-outline-light">Download CV</button>
        </div>
    </div>
    <hr>
    <div class="section" id="certificates">
        <div class="w-50 title-text">
            <h4>Certificates</h4>
            <hr>
            <h6>Here are certificates and awards I've previously received.</h6>
        </div>
    </div>
    <hr>
    <div class="section" id="projects">
        <div class="w-50 title-text">
            <h4>Projects</h4>
            <hr>
            <h6>Here are the projects that I've worked on or been a part of.</h6>
        </div>
    </div>
    <hr>
    <div class="section d-flex flex-row justify-content-around align-items-stretch" id="contact">
        <div class="contact-left flex-grow-1">
            <form action="functions/saveForm.php" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHint" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHint" placeholder="Enter Email">
                    <small id="emailHint" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" class="form-control" id="message" rows="3"></textarea>
                </div>
                <br>
                <input type="submit" name="saveForm" value="Submit" class="btn btn-outline-light" />
            </form>
        </div>
        <div class="contact-right flex-grow-1">
            <h5>You can also reach out to me through these platforms!</h5>
            <hr>
            <div class="flex-platform">
                <?php
                foreach ($platforms as $k => $v) {
                    $fa = $v->fa;
                    $title = $v->title;
                    $url = $v->url;
                    echo <<<HTML
                    <a href="{$url}" target="_blank">
                        <div class="card">
                            <i class="{$fa}"></i>
                            <div class="card-body">
                                <h5 class="card-title">{$title}</h5>
                            </div>
                        </div>
                    </a>
                    HTML;
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Navigation Script -->
    <script>
        var logo = $('.navbar-brand');
        // Default Active
        $('#nav-home').addClass("active");

        var navItems = ["home", "aboutme", "certificates", "projects", "contact"];

        navItems.forEach(item => {
            // Click
            $("#nav-" + item).click(function() {
                $('html, body').animate({
                    scrollTop: $("#" + item).offset().top
                }, 500);
                logo.focus();
                return false;
            });

            // Waypoints
            $('#' + item).waypoint(function() {
                $(".nav-item").removeClass("active");
                $("#nav-" + item).addClass("active");
            }, {
                offset: -10
            });

            $('#' + item).waypoint(function() {
                $(".nav-item").removeClass("active");
                $("#nav-" + item).addClass("active");
            }, {
                offset: 10
            });
        });
    </script>

    <script>
        var options = {
            strings: ['System', 'Mobile'],
            typeSpeed: 100,
            backSpeed: 50,
            loop: true
        };

        var typed = new Typed('.typer', options);
    </script>
</body>

</html>