<?php
    include('header.php');
?>
    <div class="container">

        <section class="home-page">
            <div class="filtration-panel">
                <a class="element open-filters">
                    <i class="fas fa-sliders-h"></i>
                    Filtration (location, date etc.)
                </a>
                <a class="element open-search">
                    <i class="fas fa-search"></i>
                    Search
                </a>
                <form class="hidden-element filters" action="filterEvents" method="post">
                    <input type="number" name="free-spots" placeholder="Free spots">
                    <input type="text" name="location" placeholder="location">
                    <input type="text" name="date" placeholder="date">
                    <input type="text" name="sport" placeholder="sport">
                    <input class="filter" type="submit" value="Filter">
                    <i class="fas fa-times-circle"></i>
                </form>
                <div class="hidden-element search" action="search" method="post">
                    <input type="text" name="search" placeholder="Title, description, user">
                    <input class="filter" type="submit" value="Search">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
            <section class="events">
                <?
                if(isset($messages)){
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
                if(isset($events)){
                    foreach ($events as $event):
                ?>
                <div class="post">
                    <div class="image">
                        <img src="public/uploads/<?=$event->getEventDetails()->getImage()?>">
                    </div>
                    <div class="post-description">
                        <h2><?= $event->getEventDetails()->getTitle() ?></h2>
                        <form action="userProfile" method="POST">
                            <input type="hidden" name="userId" value="<?= $event->getAddedById()?>">
<!--                            <input type="submit" value="0">-->
                            <input type="submit" value="<?= $event->getAddedByNameSurname()?>">
                        </form>
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
                            <?
                                if($event->getAddedById() == $_COOKIE['id']){
                            ?>
                            <form class="sign-section" action="removeEvent" method="post">
                                <input type="hidden" name="eventId" value="<?= $event->getId() ?>"/>
                                <button class="mybutton" type="submit">
                                    Remove
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            </form>
                            <?
                                }
                                else{
                            ?>
                            <form class="sign-section" action="signUpUserForEvent" method="post">
                                <input type="hidden" name="eventId" value="<?= $event->getId() ?>"/>
                                <button class="mybutton" type="submit">
                                    Sign in
                                    <i class="fas fa-sign-in-alt"></i>
                                </button>
                            </form>
                            <?
                                }
                            ?>
                        </section>
                    </div>
                </div>
                <?
                    endforeach;
                }
                ?>
            </section>
        </div>
    </div>
</body>
<template id="event-template">
    <div class="post">
        <div class="image">
            <img src="">
        </div>
        <div class="post-description">
            <h2></h2>
            <form action="userProfile" method="POST">
                <input type="hidden" name="userId" value="">
                <input type="submit" name="username-surname" value="">
            </form>
            <h4>

            </h4>
            <a class="description">

            </a>
            <section class="icons-section">
                <section class="location-date-section">
                    <a>
                        <i class="fas fa-map-marker-alt"></i>
                        <a class="location">
                            Cracowa
                        </a>
                    </a>
                    <a>
                        <i class="fas fa-calendar-alt"></i>
                        <a class="date">
                            6 pm, 24-06-2020
                        </a>
                    </a>
                </section>
                <form class="sign-section" action="signUpUserForEvent" method="post">
                    <input type="hidden" name="eventId" value=""/>
                    <button class="mybutton" type="submit">
                        Sign in
                        <i class="fas fa-sign-in-alt"></i>
                    </button>
                </form>
            </section>
        </div>
    </div>
</template>