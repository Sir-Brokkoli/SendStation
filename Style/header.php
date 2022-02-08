<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="Style/mainStyle.css">
        <link rel="stylesheet" href="Style/ProgressBar.css">

        <?php session_start(); include_once('DEBUG/DEBUG.php'); $_SESSION['DEBUG'] = true;?>

        <title> Sendstation </title>

    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
            <div class="container">
                <a href="index.php" class="navbar-brand"><h3 class="text-col1"><i class="bi bi-bricks text-col2 mx-1"></i>Sendstation</h3></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navmenu"> 
                    <ul class="navbar-nav ms-auto">
                        <?php
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                            echo "<li class=\"nav-item\"><a href=\"home.php\" class=\"nav-link\">" . $_SESSION['nickname'] . "</a></li>";
                        }
                        else{
                            echo "<li class=\"nav-item\"><a href=\"index.php\" class=\"nav-link\">" . "Home" . "</a></li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a href="./routes.php" class="nav-link">Our selection</a>
                        </li>
                        <li class="nav-item">
                            <a href="about.php" class="nav-link">The competition</a>
                        </li>
                        <li class="nav-item">
                            <a href="contact.php" class="nav-link">Contact</a>
                        </li>
                        <?php
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                            echo "<li class=\"nav-item\"><a href=\"logOut.commit.php\" class=\"nav-link\">Log Out</a></li>";
                        }
                        else{
                            echo "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-bs-toggle=\"modal\" data-bs-target=\"#logInModal\">" . "Log In" . "</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sign Up Modal -->
        <div class="modal fade" id="signUpModal">
            <div class="modal-dialog">
                <form action="signUp.commit.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Join the competition!</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="#inputUsername" class="h6">Username</label>
                                <input type="text" class="form-control" name="username" id="inputUsername">
                            </div>
                            <div class="mb-3">
                                <label for="#inputMail" class="h6">E-Mail Adress</label>
                                <input type="email" class="form-control" name="email" id="inputMail">
                            </div>
                            <div class="mb-3">
                                <label for="#inputPassword" class="h6">Password</label>
                                <input type="password" class="form-control" name="password" id="inputPassword">
                            </div>
                            <div class="mb-3">
                                <label for="#inputPasswordRepeat" class="h6">Repeat Password</label>
                                <input type="password" class="form-control" id="inputPasswordRepeat">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Sign up!</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Log In Modal -->
        <div class="modal fade" id="logInModal">
            <div class="modal-dialog">
                <form action="logIn.commit.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Log in!</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="#inputMail" class="h6">E-Mail Adress</label>
                                <input type="email" class="form-control" name="email" id="inputMail">
                            </div>
                            <div class="mb-3">
                                <label for="#inputPassword" class="h6">Password</label>
                                <input type="password" class="form-control" name="password" id="inputPassword">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Log in!</button>
                            </br>
                            <p>Don't have an account? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign up now</a>.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        