<?php
// Устанавливаем соединение с базой данных
require_once("connect.php");
$query = "SELECT * 
            FROM staff
            WHERE
              dir_id = :id
            ORDER BY id";
$cat = $pdo->prepare($query);
$cat->execute(['id' => $_GET['id']]);
echo "<option value='0'>Выберите подчинённого</option>";
while($catalog = $cat->fetch()) {
    echo "<option value='{$catalog['id']}'>{$catalog['id']}"."{$catalog['position']}  </option>";
}