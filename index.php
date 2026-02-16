<?php 
    include('./session.php');
    include('./assets/connection/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./index.css">
<?php require "./links/header_link.php" ?>
<title>Dental Login</title>
</head>
<body>

    <div class="page-wrapper">
        <!-- Decorative Background Wave -->
        <svg class="bg-wave" viewBox="0 0 1440 320">
            <path fill="#2F4AA0" fill-opacity="0.08"
                d="M0,224L40,202.7C80,181,160,139,240,117.3C320,96,400,96,480,117.3C560,139,640,181,720,213.3C800,245,880,267,960,272C1040,277,1120,267,1200,245.3C1280,224,1360,192,1400,176L1440,160L1440,320L0,320Z">
            </path>
        </svg>

        <div class="auth-container">

            <div class="auth-left">
                <h1 class="brand-title">Dental</h1>
                <p class="brand-subtitle">
                    Welcome back. Please enter your credentials to access your dashboard.
                </p>

                <form class="login-form">
                    <h2 class="form-title">Sign In</h2>

                    <div class="input-group">
                        <input id="username" type="text" placeholder=" " required>
                        <label>Username</label>
                    </div>

                    <div class="input-group">
                        <input id="password" type="password" placeholder=" " required>
                        <label>Password</label>
                    </div>

                    <div class="form-options">
                        <label class="remember">
                            <input type="checkbox"> Remember me
                        </label>
                        <a href="#" class="forgot">Forgot password?</a>
                    </div>

                    <button type="submit" id="login-btn">Login</button>
                </form>
            </div>

            <div class="auth-right">
                <div class="logo-card">
                    <img src="./source/landing_img/tooth.png" alt="">
                    <h2>Dental</h2>
                    <p>Electronic Medical Records</p>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript" src="./index.js?v=<?php echo time(); ?>"></script>
</body>
</html>
