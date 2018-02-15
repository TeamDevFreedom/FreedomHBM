<?php require_once 'header.php'; ?>
<script>
    var userClickHandler = function (id) {
        window.location.href = './login.php?id=' + id;
    };
    var documentReadyHandler = function () {
        $('#user1').click(function () {
            userClickHandler('user1');
        });
        $('#user2').click(function () {
            userClickHandler('user2');
        });
        $('#user3').click(function () {
            userClickHandler('user3');
        });
        $('#user4').click(function () {
            userClickHandler('user4');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<div class='home_container'>
    <div class='home_user' id='user1'>
        <img src="/img/user_1.png" alt="user1"/>
    </div>
    <div class='home_user' id='user2'>
        <img src="/img/user_2.png" alt="user2"/>
    </div>
    <div class='home_user' id='user3'>
        <img src="/img/user_1.png" alt="user3"/>
    </div>
    <div class='home_user' id='user4'>
        <img src="/img/user_2.png" alt="user4"/>
    </div>
</div>
<?php require_once 'footer.php'; ?>