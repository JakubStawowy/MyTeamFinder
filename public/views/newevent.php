<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="public/stylecss/style.min.css" type="text/css"/>
    <link rel="stylesheet" href="public/stylecss/newevent.min.css" type="text/css"/>
    <script src="https://kit.fontawesome.com/607b75d37b.js" crossorigin="anonymous"></script>
    <title>Dodaj wydarzenie</title>
</head>
<body>
    <div class="container">
        <div class="menu-bar">
            
            <img src="public/img/Graylogo.png">
            <ul>
                <li>
                    <a href="home">
                        Home
                    </a>
                </li>
                <li>
                    <a href="home">
                        E-sports
                    </a>
                </li>
                <li>
                    <a href="home">
                        Team-sports
                    </a>
                </li>
                <li>
                    <a href="newevent">
                        New event
                    </a>
                </li>
                
            </ul>
        </div>
        <div class="right-side-bar-hidden">
            <i class="fas fa-angle-up nav-icon"></i>
            <i class="fas fa-angle-left nav-icon"></i>
        </div>
        <div class="right-side-bar">
            <a>
                <i class="fas fa-angle-up nav-icon"></i>
            </a>
                
            <div class="user-image">
                
            </div>
            <a>Name Surname</a>
            <a href="profile">My profile</a>
            <a href="profile">Sports</a>
            <a href="profile">Events</a>
            <a>
                <i class="fas fa-cog"></i>
                Account settings
            </a>
            <a href="login">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
            <a>
                <i class="fas fa-angle-right nav-icon"></i>
            </a>
            
        </div>
        <div class="bottom-bar">
            <i class="fas fa-bars"></i>
            <a href="home">
                <i class="fas fa-home"></i>
            </a>
            <a href="profile">
                <i class="fas fa-user"></i>
            </a>
        </div>
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
                <!-- <i class="fas fa-image"></i>
                <a>
                    Picture (optional)
                </a> -->
            </input>
            <textarea name="description" class="description" placeholder="Description, requirements"></textarea>
            <div class="date-location">
                <div class="date">
                    <i class="fas fa-calendar-alt"></i>
                    <a>
                        Date
                    </a>
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