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
                    <input type="submit" value="Filter">
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