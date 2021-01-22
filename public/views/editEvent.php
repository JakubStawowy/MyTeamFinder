<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/stylecss/style.min.css" type="text/css"/>
    <link rel="stylesheet" href="public/stylecss/newevent.min.css" type="text/css"/>
    <script src="https://kit.fontawesome.com/607b75d37b.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="public/js/mobileScript.js" defer></script>
    <script type="text/javascript" src="public/js/defaultScript.js" defer></script>
    <link rel="icon" href="public/img/Loggo1.png">

    <title>Edit event</title>
</head>

<?php

    include('header.php');
    if(isset($event)){
?>
    <div class="container">
        <form action="saveEvent" method="POST" class="new-event-section" ENCTYPE="multipart/form-data">
            <input type="hidden" name="eventId" value="<?= $event->getId() ?>">
            <h2>
                Edit event
            </h2>
            <button type="submit" class="publish-button">
                Confirm changes
            </button>
            <input name="title" class="event-title" type="text" value="<?= $event->getEventDetails()->getTitle()?>">
            <input name="sport" class="sport" type="text" value="<?= $event->getEventDetails()->getSport()?>">
            <input name="numberOfPlayers" class="players" type="text" value="<?= $event->getEventDetails()->getNumberOfPlayers()?>">
            <input type="file" name="file" class="image-button" value="<?= $event->getEventDetails()->getImage()?>">
            <textarea name="description" class="description">
                 <? $event->getEventDetails()->getDescription()?>
            </textarea>
            <div class="date-location">
                <div class="date">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" name="date" value="<?= substr($event->getEventDetails()->getDate(), 0, 10)?>">
                    <input type="time" name="time" value="<?= substr($event->getEventDetails()->getDate(), 11, 5)?>">
                </div>
                <div class="location">
                    <i class="fas fa-map-marker-alt"></i>
                    <input name="location" type="text" value="<?= $event->getEventDetails()->getLocation() ?>">
                </div>
            </div>

            <?php
                if(isset($messages)){
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
            ?>
        </form>
        <form class="remove-event" action="removeEvent" method="get">
            <input type="hidden" name="eventId" value="<?= $event->getId()?>">
            <input type="submit" value="Remove event">
        </form>
    </div>
<?php
    }
?>
</body>