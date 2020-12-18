<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="public/stylecss/style.min.css" type="text/css"/>
    <link rel="stylesheet" href="public/stylecss/profile.min.css" type="text/css"/>
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
                    <a href="home">
                        E-sports
                    </a>
                </li>
                <li>
                    <a href="home">
                        Team-sports
                    </a>
                </li>
                <li>
                    <a href="newevent">
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
            <a href="profile">My profile</a>
            <a href="profile">Sports</a>
            <a href="profile">Events</a>
            <a>
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
        <section class="profile">
            <div class="profile-data">
                
                <button class="profile-image">
                    <i class="fas fa-image"></i>
                </button>
                <div class="data">
                    <h2>
                        <?
                        if(isset($_COOKIE['name']) && isset($_COOKIE['surname'])){
                            echo $_COOKIE['name'].' '.$_COOKIE['surname'];
                        }
                        ?>
                    </h2>
                    <a>
                        country
                    </a>
                    <a>
                        age
                    </a>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
                <div class="profile-settings">
                    <a>
                        <i class="fas fa-cog"></i>
                        profile settings
                    </a>
                </div>
            </div>
            <div class="profile-description">

                <h2>
                    About me
                </h2>
                <a>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su
                </a>
            </div>
            <h2>
                Sports
            </h2>
            <div class="profile-sports">
                <div class="sport">
                    <i class="fas fa-volleyball-ball"></i>
                    Volleyball
                </div>
                <div class="sport">
                    <i class="fas fa-laptop"></i>
                    Leauge of legends
                </div>
            </div>
            <section class="profile-feedback">
                <h2>
                    User feedback
                </h2>
                <div class="feedback">

                <div class="image">

                </div>
                <a>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                   
                </a>
                <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                </div>
                </div>
            </section>
        </section>
    </div>
</body>