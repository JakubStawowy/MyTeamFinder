<?php include('header.php') ?>
<div class="container">
    <div class="bottom-bar">
        <i class="fas fa-bars"></i>
        <a href="home">
            <i class="fas fa-home"></i>
        </a>
        <a href="personalProfile">
            <i class="fas fa-user"></i>
        </a>
        <ul>
            <li>
                <a href="home">
                    Home
                </a>
            </li>
            <li>
                <a href="normalSports">
                    Team sports
                </a>
            </li>
            <li>
                <a href="eSports">
                    E-sports
                </a>
            </li>
            <li>
                <a href="addEvent">
                    New event
                </a>
            </li>
        </ul>
    </div>
    <?
        if(isset($user)){
    ?>
    <form action="saveUser" method="post" ENCTYPE="multipart/form-data">
        <div class="section1 settings-section">
            <div class="label">
                <a>
                    Password
                </a>
                <input name="password" type="password" placeholder="password">
            </div>
            <div class="label">
                <a>
                    Repeat password
                </a>
                <input name="confirmedPassword" type="password" placeholder="repeat password">
            </div>
            <div class="label">
                <a>
                Phone number
                </a>
                <input name="phone" type="text" placeholder="<?= $user->getUserDetails()->getPhone()?>">
            </div>
        </div>
        <div class="section2 settings-section">
            <div class="label">
                <a>
                    Name
                </a>
                <input name="name" type="text" placeholder="<?= $user->getUserDetails()->getName()?>">
            </div>
            <div class="label">
                <a>
                    Surname
                </a>
                <input name="surname" type="text" placeholder="<?= $user->getUserDetails()->getSurname()?>">
            </div>
            <div class="label">
                <a>
                    Age
                </a>
                <input name="age" type="number" placeholder="<?= $user->getUserDetails()->getAge()?>">
            </div>
            <div class="label">
                <a>
                    Country
                </a>
                <input name="country" type="text" placeholder="<?= $user->getUserDetails()->getCountry()?>">
            </div>
        </div>
        <div class="section3 settings-section">
            <input type="file" name="image" class="image-button">
        </div>
        <div class="section4 settings-section">
            <textarea name="description" class="description" placeholder="<?= $user->getUserDetails()->getDescription() ?>"></textarea>
        
        </div>
        
        <div class="message">
                <?php
                if(isset($messages)){
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
                ?>
            </div>
        <button class="section6" type="submit">Save</button>
    </form>
    <?
        }
    ?>
</div>
</body>