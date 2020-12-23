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
        <section class="profile">
            <?
                if(isset($user)){
            ?>
            <div class="profile-data">
                
                <button class="profile-image">
                    <i class="fas fa-image"></i>
                </button>
                <div class="data">
                    <h2>
                        <?
                            echo $user->getName().' '.$user->getSurname();
                        ?>
                    </h2>
                    <a>
                        <?
                            echo $user->getCountry();
                        ?>
                    </a>
                    <a>
                        <?
                            echo $user->getAge();
                        ?>
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
                    <a href="userSettings">
                        <i class="fas fa-cog"></i>
                        profile settings
                    </a>
                </div>
            </div>
            <section class="event-section">
            <a href="userSignedEvents">Events</a>
            <a href="userEvents">My events</a>
            <?
            if(isset($events)){
                foreach ($events as $event):
                    ?>
                    <div class="post">
                        <div class="image">
                            <img src="public/uploads/<?=$event->getImage()?>">
                        </div>
                        <div class="post-description">
                            <h2><?= $event->getTitle() ?></h2>
                            <a><?= $event->getAddedByNameSurname()?></a>
                                <h4>
                                    signed players: <?= $event->getSignedPlayers().'/'.$event->getNumberOfPlayers() ?>
                                </h4>
                                <a class="description">
                                    <?= $event->getDescription() ?>
                                </a>
                                <section class="icons-section">
                                    <section class="location-date-section">
                                        <a>
                                            <i class="fas fa-map-marker-alt"></i>
                                            Cracowa
                                        </a>
                                        <a>
                                            <i class="fas fa-calendar-alt"></i>
                                            6 pm, 24-06-2020
                                        </a>
                                    </section>
                                    <form class="sign-section" action="signOut" method="post">
                                        <input type="hidden" name="eventId" value="<?= $event->getId() ?>"/>
                                        <button class="mybutton" type="submit">
                                            Sign out
                                            <i class="fas fa-sign-in-alt"></i>
                                        </button>
                                    </form>
                                </section>
                        </div>
                    </div>
                <?
                endforeach;
            }
            ?>
            </section>
            <div class="profile-description">

                <h2>
                    About me
                </h2>
                <a>
                    <?
                        echo $user->getDescription();
                    ?>
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
            <?
                }
            ?>
        </section>
    </div>
</body>