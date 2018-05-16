<?php
$title = 'Доставка и оплата';
include('../sys/head.html');

if ($_SESSION['admin'] == 1) {
    print '<form action="edit.php" method="post">
    <textarea name="pay" style="width: 90%; height: 300px; margin: 20px 0 0 5%;">' . $set['pay'] . '</textarea>
    <input type="submit" value="Сохранить" style="width: 90%; margin: 20px 0 0 5%;">
    </form>';
} else {
    print '<div style="margin: 20px 0 20px 10%; width: 80%;">' . nl2br($set['pay']) . '</div>';
}
?>


<div style="width: 100%; height: 500px;">
    <a class="dg-widget-link" href="http://2gis.ru/n_novgorod/firm/2674541559940084/center/43.95288705825806,56.340401698160264/zoom/16?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Посмотреть на карте Нижнего Новгорода</a><div class="dg-widget-link"><a href="http://2gis.ru/n_novgorod/firm/2674541559940084/photos/2674541559940084/center/43.95288705825806,56.340401698160264/zoom/17?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=photos">Фотографии компании</a></div><div class="dg-widget-link"><a href="http://2gis.ru/n_novgorod/center/43.95289,56.339959/zoom/16/routeTab/rsType/bus/to/43.95289,56.339959╎Цветочка, букетная лавка?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=route">Найти проезд до Цветочка, букетная лавка</a></div><script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js"></script><script charset="utf-8">new DGWidgetLoader({"width":640,"height":600,"borderColor":"#a3a3a3","pos":{"lat":56.340401698160264,"lon":43.95288705825806,"zoom":16},"opt":{"city":"n_novgorod"},"org":[{"id":"2674541559940084"}]});</script><noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. Включите его в настройках вашего браузера.</noscript>
</div>
<style>
    iframe {width: 100%;}
</style>

<?php
include('../sys/foot.html');
?>