<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body>

<h3>DBテスト</h3>
<?php echo $msg ?>
<br>
<form action="/seeder/point" method="post">
<input type="submit" value="pointランダム付与">
</form>
<br>

<table border="1">
    <tr>
        <td>id</td>
        <td>point</td>
    </tr>
    <?php $rank = 0; ?>
    <?php foreach ($users as $user) : ?>
        <tr>
            <td>
                <?php echo $user->id ?>
            </td>
            <td>
                <?php echo $user->point ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
