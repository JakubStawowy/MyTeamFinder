
<?php include('loginHeader.php') ?>
    <div class="container">
        <div class="login-register">
            <div class="logo">
                <img src="public/img/Loggo1.png">
            </div>
            <div class="login-container">
                <form action="login" method="POST">
                    <div class="login-section">
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
                        <a href="register">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>