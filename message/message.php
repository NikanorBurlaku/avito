<?php
include "page/header.php";
date_default_timezone_set('Europe/Chisinau');

if (!empty($_SESSION['auth'])) :

    $user1 = $_SESSION['login'];
    $user2 = key($_REQUEST);
    $link = require './database/connect.php';

    $selectDate = $link->query("SELECT date FROM message WHERE (to_user='$user1' AND from_user='$user2') OR (to_user='$user2' AND from_user='$user1')");
    $countRow = mysqli_num_rows($selectDate);

    $selectUserImg = $link->query("SELECT img FROM user WHERE login='$user1'");
    $userImg = $selectUserImg->fetch_assoc()['img'];

    echo "<div class='message__list'>";

    if ($countRow > 0) {
        $days = [];

        for ($data = []; $date = $selectDate->fetch_assoc(); $data[] = $date) {

            if (!in_array($date['date'], $days)) {
                $days[] = $date['date'];
            }
        }


        foreach ($days as $day) {

            $changeReadStatus = $link->query("UPDATE message SET read_status='1' WHERE to_user='$user1' AND from_user='$user2'");

            echo "<span class='day'>$day</span>";
            $selectMessages = $link->query("SELECT * FROM message WHERE 
            ((to_user='$user1' AND from_user='$user2') OR (to_user='$user2' AND from_user='$user1')) AND date='$day'");

            for ($data = []; $message = $selectMessages->fetch_assoc(); $data[] = $message) {

                if ($message['from_user'] == $user1) {
                    $selectUser = $link->query("SELECT name, img FROM user WHERE login='$user1'");
                    $user = $selectUser->fetch_assoc();
                    $name = 'you';
                    $icon = '<svg viewBox="0 0 16 15" width="16" height="15"><path fill="currentColor" d="m15.01 3.316-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z"></path></svg>';
                    if ($message['read_status'] == false) {
                        $readStatus = '';
                    } else {
                        $readStatus = 'active';
                    }
                    echo "<div class='message__block recipient'><div class='message'><div class='message__head'><img src='../upload/{$user['img']}' class='ava__img'><span class='name'>$name:</span></div><p>{$message['value']}</p><div class='time'><span>{$message['time']}</span><span class='message__icon $readStatus'>$icon</span></div></div></div>";
                } else {
                    $selectUser = $link->query("SELECT name, img FROM user WHERE login='$user2'");
                    $user = $selectUser->fetch_assoc();
                    echo "<div class='message__block sender'><div class='message'><div class='message__head'><img src='../upload/{$user['img']}' class='ava__img'><span class='name'>{$user['name']}:</span></div><p>{$message['value']}</p>
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
        <input type="hidden" name="from_user" value="<?= $user1 ?>">
        <input type="hidden" name="to_user" value="<?= $user2 ?>">
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
        const request = new XMLHttpRequest();

        request.onload = function() {
            if (request.status == 200) {

                let userImg = '<?php echo $userImg ?>';
                let time = '<?php echo (date('H:i')) ?>';
                let icon = '<span class="message__icon"><svg viewBox="0 0 16 15" width="16" height="15"><path fill="currentColor" d="m15.01 3.316-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z"></path></svg></span>';
                let messageValue = document.querySelector('.message__input').value;
                let newMessage = `<div class='message__block recipient'><div class='message'><div class='message__head'><img src='../upload/${userImg}' class='ava__img'><span class='name'>you:</span></div><p>${messageValue}</p><div class='time'><span>${time}</span>${icon}</div></div></div>`;
                document.querySelector('.message__list').innerHTML += newMessage;
                document.querySelector('.message__input').value = '';

                let emptyMessage = document.querySelector('.message__list .empty');
                if (emptyMessage) {
                    document.querySelector('.message__list .empty').style.display = 'none';
                }
                console.log("OK")
            } else {
                alert('Message not sent');
            }
        };
        let message = messageForm.querySelector('[name="message"]');
        let fromUser = messageForm.querySelector('[name="from_user"]');
        let toUser = messageForm.querySelector('[name="to_user"]');

        data = 'message=' + encodeURIComponent(message.value) +
            '&from_user=' + encodeURIComponent(fromUser.value) +
            '&to_user=' + encodeURIComponent(toUser.value);
        console.log(data);

        request.open("POST", './send_message.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        request.send(data);
        return false;
    })
</script>

<?php
include "page/footer.php";
?>