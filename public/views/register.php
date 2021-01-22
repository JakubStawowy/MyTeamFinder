
<?php include('loginHeader.php') ?>
    <div class="container">
        <div class="login-register">
            <div class="logo">
                <img src="public/img/Loggo1.png">
            </div>
            <div class="login-container">
                <form action="registerUser" method="post">
                    <div class="login-section">
                        <input name="email" type="text" placeholder="email@email.com">
                        <input name="password" type="password" placeholder="password">
                        <input name="confirmedPassword" type="password" placeholder="repeat password">
                        <input name="phone" type="text" placeholder="phone">
                        <a class="password-message">

                        </a>
                        <div class="message">
                            <?php
                            if(isset($messages)){
                                foreach ($messages as $message){
                                    echo $message;
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="login-section">
                        <input name="name" type="text" placeholder="name">
                        <input name="surname" type="text" placeholder="surname">
                        <input name="age" type="number" placeholder="age">
                        <input name="country" type="text" placeholder="country">
                        <button class="input-disabled">Register</button>
                        <a href="login">I am already registered</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>