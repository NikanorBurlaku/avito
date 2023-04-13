<?php
include "page/header.php";

if (!empty($_SESSION['auth'])) :

    $sender = $_SESSION['login'];
    $recipient = key($_REQUEST);
    $link = require './database/connect.php';

    $selectMessages = $link->query("SELECT * FROM message WHERE recipient='$recipient' AND sender='$sender'");
    $countRow = mysqli_num_rows($selectMessages);

    echo "<div class='message__list'>";

    if ($countRow > 0) {

        for ($data = []; $message = $selectMessages->fetch_assoc(); $data[] = $message) {

            $date = mb_substr($message['date'], 0, 5);
            echo "<div class='message__block'><div class='message'><p>{$message['value']}</p><span class='date'>$date</span></div></div>";
        }

    } else {
        echo "<div class='empty'><img classs=empty__img' src='../images/empty.png'><span>no messages</span></div>";
    }

    echo "</div>";
?>

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