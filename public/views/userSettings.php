<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/stylecss/style.min.css" type="text/css"/>
    <link rel="stylesheet" href="public/stylecss/settings.min.css" type="text/css"/>
    <script src="https://kit.fontawesome.com/607b75d37b.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="public/js/homeScript.js" defer></script>
    <title>Moj profil</title>
</head>
<body onload="onLoad()">
<div class="container">
    <div class="menu-bar">
        <img src="public/img/Graylogo.png">
        <ul>
            <li>
                <a href="home">
                    Home
                </a>
            </li>
            <li>
                <a href="eSports">
                    E-sports
                </a>
            </li>
            <li>
                <a href="normalSports">
                    Team-sports
                </a>
            </li>
            <li>
                <a href="newEvent">
                    New event
                </a>
            </li>

        </ul>
    </div>
    <div id="right-side-bar-hidden" class="right-side-bar-hidden">
        <i class="fas fa-angle-up nav-icon"></i>
        <i id="nav-icon-hidden" class="fas fa-angle-left nav-icon"></i>
    </div>
    <div id="right-side-bar" class="right-side-bar">
        <a>
            <i class="fas fa-angle-up nav-icon"></i>
        </a>

        <div class="user-image">

        </div>
        <a>
            <?
            if(isset($_COOKIE['name']) && isset($_COOKIE['surname'])){
                echo $_COOKIE['name'].' '.$_COOKIE['surname'];
            }
            ?>
        </a>
        <a href="personalProfile">My profile</a>
        <a href="personalProfile">Sports</a>
        <a href="userSignedEvents">Events</a>
        <a href="userEvents">My events</a>
        <a href="userSettings">
            <i class="fas fa-cog"></i>
            Account settings
        </a>
        <a href="logout" >
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>
        <a>
            <i id="nav-icon" class="fas fa-angle-right nav-icon"></i>
        </a>

    </div>
    <div class="bottom-bar">
        <i class="fas fa-bars"></i>
        <a href="home">
            <i class="fas fa-home"></i>
        </a>
        <a href="profile">
            <i class="fas fa-user"></i>
        </a>
    </div>
    <?
        if(isset($user)){
    ?>
    <form action="saveUser" method="POST">
        <div class="settings-section">
            <input name="password" type="password" placeholder="password">
            <input name="confirmedPassword" type="password" placeholder="repeat password">
            <input name="phone" type="text" placeholder="<?= $user->getPhone()?>">
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
        <div class="settings-section">
            <input name="name" type="text" placeholder="<?= $user->getName()?>">
            <input name="surname" type="text" placeholder="<?= $user->getSurname()?>">
            <input name="age" type="number" placeholder="<?= $user->getAge()?>">
            <input name="country" type="text" placeholder="<?= $user->getCountry()?>">
            <button type="submit">Save</button>
        </div>
        <div class="settings-section">
            Description
            <textarea name="description" class="description" placeholder="<?= $user->getDescription() ?>"></textarea>
        </div>
    </form>
    <?
        }
    ?>
</div>
</body>