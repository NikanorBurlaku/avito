<?php include "page/header.php"; ?>

<script>
    const title = "Admin panel";
</script>
<style>
</style>

<?php
include "page/footer.php";

if($_SESSION['status'] === 'admin'){

    $link = require './database/connect.php';
    $selectUsers = 'SELECT * FROM user';
    $result = mysqli_query($link, $selectUsers) or die(mysqli_error($link));

    echo "<div class='main__table'><table>";
    echo "<thead>
        <td class='table__cell'>login</td>
        <td class='table__cell'>name</td>
        <td class='table__cell'>surname</td>
        <td class='table__cell'>email</td>
        <td class='table__cell'>verify</td>
        <td class='table__cell'>status</td>
        <td class='table__cell'>date registration</td>
        <td class='table__cell'>change status</td>
        <td class='table__cell'>block user</td>
        <td class='table__cell'>delete user</td>
        </thead><tbody>";
    for($data = []; $user = mysqli_fetch_assoc($result); $data[] = $user){

        if($user['block'] === 'true'){
            echo "<tr class='block__cell'>";
        }elseif($user['status'] === 'admin'){
            echo "<tr class='admin__cell'>";
        } else {
            echo "<tr class='user__cell'>";
        }
        echo "
        <td class='table__cell'>{$user['login']}</td>
        <td class='table__cell'>{$user['name']}</td>
        <td class='table__cell'>{$user['surname']}</td>
        <td class='table__cell'>{$user['email']}</td>
        <td class='table__cell'>{$user['verify']}</td>
        <td class='table__cell'>{$user['status']}</td>
        <td class='table__cell'>{$user['date_reg']}</td>
        <td class='table__cell'><a class='table__link' href='admin/changeStatus.php?login={$user['login']}'>change</a></td>
        <td class='table__cell'><a class='table__link' href='admin/blockUser.php?login={$user['login']}'>block</a></td>
        <td class='table__cell'><a class='table__link' href='admin/deleteUser.php?login={$user['login']}'>delete</a></td>
        </tr>";
    }

    echo "</tbody></table></div>";
}