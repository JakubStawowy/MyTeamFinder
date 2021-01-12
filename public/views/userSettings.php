<?php include('header.php') ?>
<div class="container">
    <?
        if(isset($user)){
    ?>
    <form class="settings" action="saveUser" method="post" ENCTYPE="multipart/form-data">
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
                <input name="phone" type="text" value="<?= $user->getUserDetails()->getPhone()?>">
            </div>
        </div>
        <div class="section2 settings-section">
            <div class="label">
                <a>
                    Name
                </a>
                <input name="name" type="text" value="<?= $user->getUserDetails()->getName()?>">
            </div>
            <div class="label">
                <a>
                    Surname
                </a>
                <input name="surname" type="text" value="<?= $user->getUserDetails()->getSurname()?>">
            </div>
            <div class="label">
                <a>
                    Age
                </a>
                <input name="age" type="number" value="<?= $user->getUserDetails()->getAge()?>">
            </div>
            <div class="label">
                <a>
                    Country
                </a>
                <input name="country" type="text" value="<?= $user->getUserDetails()->getCountry()?>">
            </div>
        </div>
        <div class="section3 settings-section">
            <label>
                <textarea name="description" class="description">
                    aa
                    <?= $user->getUserDetails()->getDescription() ?>
                </textarea>
            </label>
        </div>
        <div class="section4 settings-section">
            <input type="file" name="image" class="image-button">
        <button type="submit">Save</button>
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
    </form>
    <?
        }
    ?>
</div>
</body>