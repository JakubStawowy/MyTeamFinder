<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/607b75d37b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/stylecss/style.min.css" type="text/css"/>
    <link rel="stylesheet" href="public/stylecss/home.min.css" type="text/css"/>
    <link rel="icon" href="public/img/Loggo1.png">
    <script type="text/javascript" src="public/js/homeScript.js" defer></script>
    <script type="text/javascript" src="public/js/searchScript.js" defer></script>
    <script type="text/javascript" src="public/js/mobileScript.js" defer></script>
    <script type="text/javascript" src="public/js/statistics.js" defer></script>
    <script type="text/javascript" src="public/js/defaultScript.js" defer></script>

    <title>My Team Finder</title>
</head>

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
                <form class="hidden-element filters" action="filterEvents" method="post">
                    <input type="number" name="spots" placeholder="Free spots">
                    <input type="text" name="location" placeholder="location">
                    <input type="text" name="dateFrom" placeholder="date (from)">
                    <input type="text" name="dateTo" placeholder="date (to)">
                    <input type="text" name="sport" placeholder="sport">
                    <!-- <input class="filter-button" type="submit" value="Filter"> -->
                    <i class="fas fa-search filter-button input-disabled">
                        <a>
                            Filter
                            Filter
                        </a>
                    </i>

                    <i class="fas fa-times-circle">
                        <a>
                            Close
                        </a>
                    </i>
                </form>


                <a class="element open-search">
                    <i class="fas fa-search"></i>
                    Search
                </a>
                <div class="hidden-element search">
                    <input class="search-area" type="text" name="search" placeholder="Title, description, user">

                    <i class="fas fa-search search-button input-disabled">
                        <a>
                            Search
                        </a>
                    </i>
                    <!-- <input class="search-button" type="submit" value="Search"> -->
                    <i class="fas fa-times-circle">
                        <a>
                            Close
                        </a>
                    </i>
                </div>


                <?
                    if($user->getRole() == 'admin'){
                ?>
                    <a class="element open-add-sport">
                        <i class="fas fa-plus"></i>
                        Add sport
                    </a>
                    <div class="hidden-element add-sport">
                        <input type="text" name="sport-name" placeholder="Sport name">
                        <select name="type">
                            <option value="normal">normal sport</option>
                            <option value="esport">e-sport</option>
                        </select>
<!--                        <input type="submit" class="add-sport-button input-disabled" value="Add">-->

                        <i class="fas fa-plus add-sport-button input-disabled">
                            <a>
                                Add
                            </a>
                        </i>
                        <i class="close-add-sport fas fa-times-circle">

                            <a>
                                Close
                            </a>
                        </i>
                    </div>
                <?
                    }
                ?>


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
                        include('event.php');
                    endforeach;
                }
                ?>
            </section>
        </div>
    </div>
</body>
<template id="event-template">
    <? include('event.php')?>
</template>