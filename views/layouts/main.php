<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>Document</title>

</head>

<body>
<?if ($auth):?>
    Добро пожаловать <?=$username?> <a href="/?c=user&a=logout"> [Выход]</a>
<?else:?>
    <form action="/?c=user&a=login" method="post">
        <input type="text" name="login" placeholder="Логин">
        <input type="text" name="pass" placeholder="Пароль">
        <input type="submit" name="submit" value="Войти">
    </form>
<?endif;?>
<br>
<a href="/">Главная</a>
<a href="/?c=product&a=catalog">Каталог</a>
<a href="/?c=basket">Корзина</a> <span id="count"><?=$count?></span>
<br>



<?=$content?>

</body>
</html>