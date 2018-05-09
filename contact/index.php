<?php
$title = 'Заказ цветов';
include('../sys/head.html');
?>

<style type="text/css">
    .table {width: 70%; margin: 30px 0 50px 10%; border: 0;}
    .table td {padding: 15px; border: 0;}
    .table tr {border: 0;}
</style>

<table class="table">
    <tr>
        <td>
            Телефон
        </td>
        <td>
            <a href="tel:<?=$set['tel']?>"><?=$set['tel']?></a>
        </td>
    </tr>
    <tr>
        <td>
            Адрес
        </td>
        <td>
            <?=$set['geo']?>
        </td>
    </tr>
    <tr>
        <td>
            Время работы
        </td>
        <td>
            с <?=$set['timestart']?> до <?=$set['timestop']?>
        </td>
    </tr>
</table>


<div style="width: 100%; height: 500px;">
    <a class="dg-widget-link" href="http://2gis.ru/n_novgorod/firm/2674541559940084/center/43.95288705825806,56.340401698160264/zoom/16?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Посмотреть на карте Нижнего Новгорода</a><div class="dg-widget-link"><a href="http://2gis.ru/n_novgorod/firm/2674541559940084/photos/2674541559940084/center/43.95288705825806,56.340401698160264/zoom/17?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=photos">Фотографии компании</a></div><div class="dg-widget-link"><a href="http://2gis.ru/n_novgorod/center/43.95289,56.339959/zoom/16/routeTab/rsType/bus/to/43.95289,56.339959╎Цветочка, букетная лавка?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=route">Найти проезд до Цветочка, букетная лавка</a></div><script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js"></script><script charset="utf-8">new DGWidgetLoader({"width":640,"height":600,"borderColor":"#a3a3a3","pos":{"lat":56.340401698160264,"lon":43.95288705825806,"zoom":16},"opt":{"city":"n_novgorod"},"org":[{"id":"2674541559940084"}]});</script><noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. Включите его в настройках вашего браузера.</noscript>
</div>
<style>
    iframe {width: 100%;}
</style>

<?php
include('../sys/foot.html');
?>