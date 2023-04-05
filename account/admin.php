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
    $selectUser = $link->query("SELECT * FROM user");


    echo "<div class='main__table'><table>";
    echo "<thead>
        <td class='table__cell'>login</td>
        <td class='table__cell'>name</td>
        <td class='table__cell'>surname</td>
        <td class='table__cell'>email</td>
        <td class='table__cell'>photo</td>
        <td class='table__cell'>verify</td>
        <td class='table__cell'>status</td>
        <td class='table__cell'>date registration</td>
        <td class='table__cell'>change status</td>
        <td class='table__cell'>block user</td>
        <td class='table__cell'>delete user</td>
        </thead><tbody>";
    for($data = []; $user = $selectUser->fetch_assoc(); $data[] = $user){

        if($user['block'] === 'true'){
            echo "<tr class='block__cell'>";
            $block_text = 'unblock';
        }elseif($user['status'] === 'admin'){
            echo "<tr class='admin__cell'>";
            $block_text = 'block';
        } else {
            echo "<tr class='user__cell'>";
            $block_text = 'block';
        }
        echo "
        <td class='table__cell'>{$user['login']}</td>
        <td class='table__cell'>{$user['name']}</td>
        <td class='table__cell'>{$user['surname']}</td>
        <td class='table__cell'>{$user['email']}</td>
        <td class='table__cell'><img class='table__img' src=../upload/{$user['img']}></td>
        <td class='table__cell'>{$user['verify']}</td>
        <td class='table__cell'>{$user['status']}</td>
        <td class='table__cell'>{$user['date_reg']}</td>
        <td class='table__cell'><a class='table__link' href='admin/changeStatus.php?login={$user['login']}'>change</a></td>
        <td class='table__cell'><a class='table__link' href='admin/blockUser.php?login={$user['login']}'>$block_text</a></td>
        <td class='table__cell'><a class='table__link' href='admin/deleteUser.php?login={$user['login']}'>delete</a></td>
        </tr>";
    }

    echo "</tbody></table></div>";
}