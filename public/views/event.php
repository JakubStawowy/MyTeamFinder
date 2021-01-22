<div id="<?= $event->getId() ?>" class="event">
    <div class="event-image">
        <img src="public/uploads/<?=$event->getEventDetails()->getImage()?>">
    </div>
    <section class="event-container">
        <form method="get" action="event">
            <input type="hidden" name="eventId" value="<?= $event->getId() ?>">
            <input class="title" type="submit" value="<?= $event->getEventDetails()->getTitle() ?>">
        </form>
        <form action="userProfile" method="post">
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
                    <i class="fas fa-map-marker-alt">
                        <a>

                            <?= $event->getEventDetails()->getLocation()?>
                        </a>
                    </i>
                    <i class="fas fa-calendar-alt">
                        <a>

                            <?= $event->getEventDetails()->getDate()?>
                        </a>
                    </i>
            </section>
            <?
                if($event->getAddedById() == $_COOKIE['id']){
            ?>
                <form action="editEvent" method="get">
                    <input type="hidden" name="eventId" value="<?= $event->getId()?>">
                    <button class="mybutton" type="submit">
                        Edit
                        <i class="fas fa-cog"></i>
                    </button>
                </form>
            <?
                }
                else{
                    if(!in_array($event->getId(), $userSignedEvents)){
            ?>
                    <a id="sign-<?= $event->getId()?>" class="sign-in mybutton">
                        Sign in
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                </form>
            <?
                    }
                    else{
            ?>
                <a id="sign-out-<?= $event->getId()?>" class="sign-out mybutton">
                    Sign out
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            <?
                    }
                }
            ?>
        </section>
    </section>
</div>