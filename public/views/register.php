<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/stylecss/style.min.css" type="text/css"/>
    <link rel="stylesheet" href="public/stylecss/login.min.css" type="text/css"/>
    <script type="text/javascript" src="public/js/registerScript.js" defer></script>
    <title>Rejestracja</title>
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
                <form class="login" action="registerUser" method="post">
                    <input name="name" type="text" placeholder="name">
                    <input name="surname" type="text" placeholder="surname">
                    <input name="email" type="text" placeholder="email@email.com">
                    <input name="password" type="password" placeholder="password">
                    <input name="confirmedPassword" type="password" placeholder="repeat password">
                    <button>Register</button>
                    <div class="message">
                        <?php
                        if(isset($messages)){
                            foreach ($messages as $message){
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <button>I alredy have an account</button>
                </form>
            </div>
        </div>
    </div>
</body>