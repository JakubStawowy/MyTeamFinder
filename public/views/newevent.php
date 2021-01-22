<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/stylecss/style.min.css" type="text/css"/>
    <link rel="stylesheet" href="public/stylecss/newevent.min.css" type="text/css"/>
    <link rel="icon" href="public/img/Loggo1.png">
    <script src="https://kit.fontawesome.com/607b75d37b.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="public/js/mobileScript.js" defer></script>
    <script type="text/javascript" src="public/js/eventEditorScript.js" defer></script>
    <script type="text/javascript" src="public/js/defaultScript.js" defer></script>

    <title>My Team Finder</title>
</head>
<?php include('header.php'); ?>
    <div class="container">
        <form action="addEvent" method="POST" class="new-event-section" ENCTYPE="multipart/form-data">
            <h2>
                New event
            </h2>
            <button type="submit" class="publish-button input-disabled">
                Publish event
            </button>
            <input name="title" class="event-title" type="text" placeholder="Title">
            <input name="sport" class="sport" type="text" placeholder="Sport">
            <input name="numberOfPlayers" class="players" type="number" placeholder="Number of players">
            <input type="file" name="file" class="image-button">
            <textarea name="description" class="description" placeholder="Description, requirements"></textarea>
            <div class="date-location">
                <div class="date">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" name="date">
                    <input type="time" name="time">
                </div>
                <div class="location">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" name="location" placeholder="location(optional)">
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
    </div>
</body>