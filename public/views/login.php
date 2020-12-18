<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="public/stylecss/style.min.css" type="text/css"/>
    <link rel="stylesheet" href="public/stylecss/login.min.css" type="text/css"/>
    <title>Zaloguj sie</title>
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <img src="public/img/Graylogo.png">
        </div>
        <div class="login-register">
            <div class="logo">
                <img src="public/img/Loggo1.png">
            </div>
            <div class="login-container">
                <form class="login" action="login" method="POST">
                    <input name="email" type="text" placeholder="email@email.com">
                    <input name="password" type="password" placeholder="password">
                    <a>
                        forgot your password?
                    </a>
                    <button type="submit">Login</button>

                    <div class="message">
                        <?php
                        if(isset($messages)){
                            foreach ($messages as $message){
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                </form>
                <form action="register">
                    <button type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>