<!DOCTYPE html>
<html lang='ru'>
<head>
    <title>Иерархия сотрудников</title>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="jquery.js" ></script>
    <script type="text/javascript">
       
        $(function(){
                $("select").slice(1).hide();
                var i;
        $("div").on("change", "select", function(){
            i = $(this).index();
            if ($(this).val() == 0) {
                    $("select").slice(i+1).hide(); 
                } else {
            $.ajax({
                url: "select.php?id=" + $(this).val()
                })
                   .done(function(data){
                      $("select").eq(i+1).html(data);
                      $("select").eq(i+1).prop("disabled", false);
                      $("select").eq(i+1).show();
                      $("select").slice(i+2).hide();                     
                      if ($("select").val() == 0) {
                      $("select").slice(i+1).hide(); 
                    }
                });  
              }
          });
        });
    </script>
</head>
<body>
<?php
// Устанавливаем соединение с базой данных
require_once("connect.php");
$query = "SELECT * FROM staff
              WHERE dir_id = 0
              ORDER BY id";
$com = $pdo->query($query);
$catalog = $com->fetch();
    echo "<div value='{$catalog['id']}'><p>{$catalog['id']}  "."{$catalog['position']}<p/>";
// Формируем выпадающий список корневых разделов
$query = "SELECT * FROM staff
              WHERE dir_id = 1
              ORDER BY id";
echo "<select id='fst' size='20'>";
echo "<option value='0'>Выберите подчинённого</option>";
$com = $pdo->query($query);
while($catalog = $com->fetch()) {
    echo "<option value='{$catalog['id']}'>{$catalog['id']}"."{$catalog['position']}</option>";
}
echo "</select>";
?>
<select size="20" disabled='disabled'>
    <option value='0'>Выберите подчинённого</option>
</select>
<select size="20" disabled='disabled'>
    <option value='0'>Выберите подчинённого</option>
</select>
<select size="20" disabled='disabled'>
    <option value='0'>Выберите подчинённого</option>
</select>
<select size="20" disabled='disabled'>
    <option value='0'>Выберите подчинённого</option>
</select>
</div>
</body>
</html>