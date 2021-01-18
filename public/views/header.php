<!--<!DOCTYPE html>-->
<!--<head>-->
<!--    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet">-->
<!--    <link rel="stylesheet" href="public/stylecss/style.min.css" type="text/css"/>-->
<!--    <link rel="stylesheet" href="public/stylecss/home.min.css" type="text/css"/>-->
<!--    <link rel="stylesheet" href="public/stylecss/newevent.min.css" type="text/css"/>-->
<!--    <link rel="stylesheet" href="public/stylecss/profile.min.css" type="text/css"/>-->
<!--    <link rel="stylesheet" href="public/stylecss/settings.min.css" type="text/css"/>-->
<!--    <script src="https://kit.fontawesome.com/607b75d37b.js" crossorigin="anonymous"></script>-->
<!--    <script type="text/javascript" src="public/js/homeScript.js" defer></script>-->
<!--    <script type="text/javascript" src="public/js/profileScript.js" defer></script>-->
<!--    <script type="text/javascript" src="public/js/searchScript.js" defer></script>-->
<!--    <script type="text/javascript" src="public/js/mobileScript.js" defer></script>-->
<!--    <script type="text/javascript" src="public/js/statistics.js" defer></script>-->
<!--    <script type="text/javascript" src="public/js/defaultScript.js" defer></script>-->
<!---->
<!--    <title>My Team Finder</title>-->
<!--</head>-->
<body>
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
                    <ul class="sports-list">
                        <?
                        if(isset($eSports)){
                                foreach($eSports as $eSport):
                        ?>
                        <li>
                            <?
                                echo $eSport;
                            ?>
                        </li>
                        <?
                            endforeach;
                        }
                        ?>
                    </ul>
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
        <div class="sports">
            <ul class="sports-list">
                <?
                    if(isset($eSports)){
                        foreach($eSports as $eSport):
                ?>
                <li>
                    <?
                        echo $eSport;
                    ?>
                </li>
                <?
                    endforeach;
                }
                ?>
            </ul>
            <ul class="sports-list">
                <?
                    if(isset($normalSports)){
                        foreach($normalSports as $normalSport):
                ?>
                <li>
                    <?
                        echo $normalSport;
                    ?>
                </li>
                <?
                    endforeach;
                }
                ?>
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

            <?
                if(isset($user)){
                    ?>
                <img src="public/uploads/<?=$user->getUserDetails()->getImage()?>">
            <a>
                <?
                    echo $user->getUserDetails()->getName().' '.$user->getUserDetails()->getSurname();
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
    <a href="personalProfile">
        <i class="fas fa-user"></i>
    </a>
    <ul class="bottom-menu">
        <li>
            <a href="home">
                Home
            </a>
        </li>
        <li>
            <a href="normalSports">
                Team sports
            </a>
        </li>
        <li>
            <a href="eSports">
                E-sports
            </a>
        </li>
        <li>
            <a href="addEvent">
                New event
            </a>
        </li>
    </ul>
</div>