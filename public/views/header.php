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
            <a class="name-surname">
                <?
                    echo $user->getUserDetails()->getName().' '.$user->getUserDetails()->getSurname();
                }
                ?>
            </a>
            <a href="personalProfile"
                >My profile
            </a>
            <a href="personalProfile">
                My Sports
            </a>
            <a href="userSignedEvents">
                My Signed Events
            </a>
            <a href="userEvents">
                My Created Events
            </a>
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