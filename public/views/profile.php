<?php include('header.php') ?>
    <div class="container">
        <? if(isset($userProfile)){?>
        <section class="profile">
            <div class="profile-data">

                <img src="public/uploads/<?=$userProfile->getUserDetails()->getImage()?>">
                <div class="data">
                    <h2>
                        <?
                            echo $userProfile->getUserDetails()->getName().' '.$userProfile->getUserDetails()->getSurname();
                        ?>
                    </h2>
                    <a>
                        <?
                            echo $userProfile->getUserDetails()->getCountry();
                        ?>
                    </a>
                    <a>
                        <?
                            echo $userProfile->getUserDetails()->getAge();

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
                    <?
                        if($userProfile->getId() == $_COOKIE['id']){
                    ?>
                    <a href="userSettings">
                        <i class="fas fa-cog"></i>
                        profile settings
                    </a>
                    <?
                        }
                    ?>
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
                            <img src="public/uploads/<?=$event->getEventDetails()->getImage()?>">
                        </div>
                        <div class="post-description">
                            <h2><?= $event->getEventDetails()->getTitle() ?></h2>
                            <a><?= $event->getAddedByNameSurname()?></a>
                                <h4>
                                    signed players: <?= $event->getSignedPlayers().'/'.$event->getEventDetails()->getNumberOfPlayers() ?>
                                </h4>
                                <a class="description">
                                    <?= $event->getEventDetails()->getDescription() ?>
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
                        echo $userProfile->getUserDetails()->getDescription();
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
        </section>
            <?
        }
        ?>
    </div>
</body>