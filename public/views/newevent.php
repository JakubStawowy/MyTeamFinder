<?php include('header.php'); ?>
    <div class="container">
        <form action="addEvent" method="POST" class="new-event-section" ENCTYPE="multipart/form-data">
            <h2>
                New event
            </h2>
            <button type="submit" class="publish-button">
                Publish event
            </button>
            <input name="title" class="event-title" type="text" placeholder="Title">
            <input name="sport" class="sport" type="text" placeholder="Sport">
            <input name="numberOfPlayers" class="players" type="text" placeholder="Number of players">
            <input type="file" name="file" class="image-button">
            </input>
            <textarea name="description" class="description" placeholder="Description, requirements"></textarea>
            <div class="date-location">
                <div class="date">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" name="date">
                    <input type="time" name="time">
                </div>
                <div class="location">
                    <i class="fas fa-map-marker-alt"></i>
                    <a>
                        Location (optional)
                    </a>
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