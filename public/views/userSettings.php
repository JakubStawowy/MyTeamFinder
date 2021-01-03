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
    <div class="menu-bar">
        <a class="image" href="home">
            <img src="public/img/Graylogo.png">
        </a>
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
<div class="container">
    <div id="right-side-bar-hidden" class="right-side-bar-hidden">
        <i class="fas fa-angle-up nav-icon"></i>
        <i id="nav-icon-hidden" class="fas fa-angle-left nav-icon"></i>
    </div>
    <div id="right-side-bar" class="right-side-bar">
        <a>
            <i class="fas fa-angle-up nav-icon"></i>
        </a>
        <?
        if(isset($user)){
        ?>
        <img src="public/uploads/<?=$user->getImage()?>">
        <a>
            <?
            echo $user->getName().' '.$user->getSurname();

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
    <form action="saveUser" method="post" ENCTYPE="multipart/form-data">
        <div class="section1 settings-section">
            <div class="label">
                <a>
                    Password
                </a>
                <input name="password" type="password" placeholder="password">
            </div>
            <div class="label">
                <a>
                    Repeat password
                </a>
                <input name="confirmedPassword" type="password" placeholder="repeat password">
            </div>
            <div class="label">
                <a>
                Phone number
                </a>
                <input name="phone" type="text" placeholder="<?= $user->getPhone()?>">
            </div>
        </div>
        <div class="section2 settings-section">
            <div class="label">
                <a>
                    Name
                </a>
                <input name="name" type="text" placeholder="<?= $user->getName()?>">
            </div>
            <div class="label">
                <a>
                    Surname
                </a>
                <input name="surname" type="text" placeholder="<?= $user->getSurname()?>">
            </div>
            <div class="label">
                <a>
                    Age
                </a>
                <input name="age" type="number" placeholder="<?= $user->getAge()?>">
            </div>
            <div class="label">
                <a>
                    Country
                </a>
                <input name="country" type="text" placeholder="<?= $user->getCountry()?>">
            </div>
        </div>
        <div class="section3 settings-section">
            <input type="file" name="image" class="image-button">
        </div>
        <div class="section4 settings-section">
            <textarea name="description" class="description" placeholder="<?= $user->getDescription() ?>"></textarea>
        
        </div>
        
        <div class="message">
                <?php
                if(isset($messages)){
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
                ?>
            </div>
        <button class="section6" type="submit">Save</button>
    </form>
    <?
        }
    ?>
</div>
</body>