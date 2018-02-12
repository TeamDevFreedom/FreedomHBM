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
    <div class='home_col_left'>
        <div class='home_user_left' id='user1'>User 1</div>
        <div class='home_user_left' id='user3'>User 3</div>
    </div>
    <div class='home_col_right'>
        <div class='home_user_right' id='user2'>User 2</div>
        <div class='home_user_right' id='user4'>User 4</div>
    </div>
</div>
<?php require_once 'footer.php'; ?>