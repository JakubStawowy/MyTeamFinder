<div id="<?= $event->getId() ?>" class="event">
    <div class="event-image">
        <img src="public/uploads/<?=$event->getEventDetails()->getImage()?>">
    </div>
    <section>
        <form method="get" action="event">
            <input type="hidden" name="eventId" value="<?= $event->getId() ?>">
            <input class="title" type="submit" value="<?= $event->getEventDetails()->getTitle() ?>">
        </form>
        <form action="userProfile" method="get">
            <input type="hidden" name="userId" value="<?= $event->getAddedById()?>">
            <input class="username" type="submit" value="<?= $event->getAddedByNameSurname()?>">
        </form>
        <div class="signed-players-section">
            signed players: 
            <a id="event-signed-players-<?= $event->getId()?>">
                <?= $event->getSignedPlayers()?>
            </a>
            /
            <?= $event->getEventDetails()->getNumberOfPlayers()?>
        </div>
        
        <a class="event-description">
            <?= $event->getEventDetails()->getDescription() ?>
        </a>

        <section class="icons-section">
            <section class="location-date-section">
                <a>
                    <i class="fas fa-map-marker-alt"></i>
                    <?= $event->getEventDetails()->getLocation()?>
                </a>
                <a>
                    <i class="fas fa-calendar-alt"></i>
                    <?= $event->getEventDetails()->getDate()?>
                </a>
            </section>
            <?
                if($event->getAddedById() == $_COOKIE['id']){
            ?>
                
                <a class="mybutton" type="submit">
                    Edit
                    <i class="fas fa-cog"></i>
                </a>
                <a class="mybutton">
                    Remove
                    <i class="fas fa-times-circle"></i>
                </a>
            <?
                }
                else{
            ?>
                    <a class="sign-in mybutton">
                        Sign in
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                </form>
            <?
                }
            ?>
        </section>
    </section>
</div>