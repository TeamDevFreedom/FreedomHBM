<?php require_once 'header.php'; ?>
<svg class="clip-svg">
<defs>
<clipPath id="hexagon-clip" clipPathUnits="objectBoundingBox">
    <polygon points="0.25 0.05, 0.75 0.05, 1 0.5, 0.75 0.95, 0.25 0.95, 0 0.5"></polygon>
</clipPath>
</defs>
</svg>
<script>
    var userClickHandler = function (id) {
        window.location.href = './login.php?id=' + id;
    };
    var documentReadyHandler = function () {
        $('#user1').click(function () {
            userClickHandler('<?php echo array_keys($USERS)[0]; ?>');
        });
        $('#user2').click(function () {
            userClickHandler('<?php echo array_keys($USERS)[1]; ?>');
        });
        $('#user3').click(function () {
            userClickHandler('<?php echo array_keys($USERS)[2]; ?>');
        });
        $('#user4').click(function () {
            userClickHandler('<?php echo array_keys($USERS)[3]; ?>');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<div class='home_container'>
    <div class='home_user' id='user1'>
        <img class="home_user_back" src="/img/user_1.png" alt="user1"/>
        <img class="home_user_portrait left" src="/img/user_portraits/user1.jpg"  alt="user1"/>
    </div>
    <div class='home_user' id='user2'>
        <img class="home_user_back" src="/img/user_2.png" alt="user2"/>
       <img class="home_user_portrait right"  src="/img/user_portraits/user2.jpg" alt="user2"/>
    </div>
    <div class='home_user' id='user3'>
        <img class="home_user_back" src="/img/user_1.png" alt="user3"/>
        <img class="home_user_portrait left"  src="/img/user_portraits/user3.jpg" alt="user3"/>
    </div>
    <div class='home_user' id='user4'>
        <img class="home_user_back" src="/img/user_2.png" alt="user4"/>
       <img class="home_user_portrait right"  src="/img/user_portraits/user4.jpg" alt="user4"/>
    </div>
</div>
<?php require_once 'footer.php'; ?>