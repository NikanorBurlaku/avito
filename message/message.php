<?php
include "page/header.php";

if (!empty($_SESSION['auth'])) :

    $user1 = $_SESSION['login'];
    $user2 = key($_REQUEST);
    $link = require './database/connect.php';

    $selectDate = $link->query("SELECT date FROM message WHERE (recipient='$user1' AND sender='$user2') OR (recipient='$user2' AND sender='$user1')");
    $countRow = mysqli_num_rows($selectDate);

    echo "<div class='message__list'>";

    if ($countRow > 0) {
        $days = [];

        for ($data = []; $date = $selectDate->fetch_assoc(); $data[] = $date) {

            if (!in_array($date['date'], $days)) {
                $days[] = $date['date'];
            }
        }


        foreach ($days as $day) {

            echo "<span class='day'>$day</span>";
            $selectDays = $link->query("SELECT * FROM message WHERE ((recipient='$user1' AND sender='$user2') OR (recipient='$user2' AND sender='$user1')) AND date='$day'");

            for ($data = []; $message = $selectDays->fetch_assoc(); $data[] = $message) {

                if ($message['sender'] == $user1) {

                    $selectUser = $link->query("SELECT name, img FROM user WHERE login='$user2'");
                    $user = $selectUser->fetch_assoc();
                    echo "<div class='message__block sender'><div class='message'><div class='message__head'><img src='../upload/{$user['img']}' class='ava__img'><span class='name'>{$user['name']}:</span></div><p>{$message['value']}</p>
                    <span class='time'>{$message['time']}</span></div></div>";
                } else {

                    $selectUser = $link->query("SELECT name, img FROM user WHERE login='$user2'");
                    $user = $selectUser->fetch_assoc();
                    $name = 'you';
                    echo "<div class='message__block recipient'><div class='message'><div class='message__head'><img src='../upload/{$user['img']}' class='ava__img'><span class='name'>$name:</span></div><p>{$message['value']}</p>
                    <span class='time'>{$message['time']}</span></div></div>";
                }
            }

        }
    } else {

        echo "<div class='empty'><img classs=empty__img' src='../images/empty.png'><span>no messages</span></div>";
    }
    echo "</div>";

?>

    <style>
        body {
            background: rgba(0, 0, 0, 0.1);
        }
    </style>

    <form class="message__form" id="message__form" action="./send_message.php" method="POST">
        <input type="text" name="message" class="message__input"><button class="message__button">send message</button>
        <input type="hidden" name="sender" value="<?= $sender ?>">
        <input type="hidden" name="recipient" value="<?= $recipient ?>">
    </form>


<?php else : ?>
    <p class="error_text">please <a href="/login.php">sign in</a> or <a href="/register.php">sign up</a></p>
<?php endif;

?>

<script>
    const title = "message";

    var messageList = document.querySelector(".message__list");
    messageList.scrollTop = messageList.scrollHeight;

    let messageForm = document.querySelector('.message__form');

    messageForm.addEventListener('click', (e) => {
        e.preventDefault();
    })

    document.querySelector('.message__button').addEventListener('click', () => {
        var request = new XMLHttpRequest();
        request.onload = function() {
            if (request.status == 200) {
                document.querySelector('.message__list').innerHTML += document.querySelector('.message__input').value;
                console.log("OK")
            } else {
                alert('Message not sent');
            }
        };
        request.open(messageForm.method, messageForm.action, true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var message = messageForm.querySelector('[name="message"]');
        request.send('message=' + encodeURIComponent(message.value));
        return false;
    })
</script>

<?php
include "page/footer.php";
?>