<?php
$title = 'Заказ цветов';
include('sys/head.html');
?>

<section id="sp-main-body-wrapper" class=" "><div class="container"><div class="row-fluid" id="main-body">
<aside id="sp-left" class="span3"><?php
    $res2 = mysqli_query($db, "SELECT * FROM `categories` ORDER BY `priority` DESC");
    while ($row = mysqli_fetch_array($res2)) {
        print '<div class="jshop_menu_level_0">
            <a href="?i=' . $row['id'] . '">' . $row['name'] . '</a>
      </div>';
    }
?>
  </aside>

<div id="sp-message-area" class="span6"><section id="sp-component-area-wrapper" class=" "><div class="row-fluid" id="component-area">
<div id="sp-component-area" class="span12"><section id="sp-component-wrapper"><div id="sp-component"><div id="system-message-container">
	</div>


<section class="featured ">

		
				
		<section class="items-leading">
							<div class="leading-1">
					
<article class="post-4 post hentry status-publish category-uncategorised">

			
	
		
		
	<section class="entry-content">  

								
		
				
		<p>		</p><div class="moduletable">

<?php
$cat = $_GET['i'];
if ($cat>0) {
    $res2 = mysqli_query($db, "SELECT * FROM `categories` WHERE `id`='$cat'");
    while ($row = mysqli_fetch_array($res2)) {
        $cat2 = mb_strtoupper_first($row['name']);
    }
} else {
    $cat2 = 'Лидеры продаж';
}
?>							<h3><?=$cat2?>:</h3>
						<div class="label_products list_product">


<?php
if ($cat>0) {
    $res2 = mysqli_query($db, "SELECT * FROM `products` WHERE `category`='$cat' ORDER BY `priority` DESC");
} else {
    $res2 = mysqli_query($db, "SELECT * FROM `products` ORDER BY `priority` DESC LIMIT 9");
}
    while ($row = mysqli_fetch_array($res2)) {
        include('sys/middle.html');
    }
?>
     
</div>		</div>
	<p></p>		
    </section>
	
	<footer class="entry-meta">
	
				
			
				    
				
    </footer>	
	
</article>				</div>
				<div class="clearfix"></div>
									</section>
		
		<div class="clearfix"></div>
		
	
				
		
		
		
		</section></div></section></div>
</div></section></div>

<!--
<aside id="sp-right" class="span3"><div class="module ">	
	<div class="mod-wrapper clearfix">		
					<h3 class="header">			
				<span>Отзывы</span>			</h3>
								<div class="mod-content clearfix">	
			<div class="mod-inner clearfix">
	
			</div>
		</div>
	</div>
</div>
<div class="gap"></div>
</aside>
!-->
</div></div></section>



<style>
@media all and (min-width: 768px) {
    #sp-message-area {width: 70%;}
}
</style>


<div style="width: 80%; margin: 0 0 50px 10%;">
    <div id="vk_comments"></div>
    <script type="text/javascript">
    VK.Widgets.Comments("vk_comments", {limit: 5, attach: "*"});
    </script>
</div>

<div style="width: 100%; height: 500px;">
    <a class="dg-widget-link" href="http://2gis.ru/n_novgorod/firm/2674541559940084/center/43.95288705825806,56.340401698160264/zoom/16?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Посмотреть на карте Нижнего Новгорода</a><div class="dg-widget-link"><a href="http://2gis.ru/n_novgorod/firm/2674541559940084/photos/2674541559940084/center/43.95288705825806,56.340401698160264/zoom/17?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=photos">Фотографии компании</a></div><div class="dg-widget-link"><a href="http://2gis.ru/n_novgorod/center/43.95289,56.339959/zoom/16/routeTab/rsType/bus/to/43.95289,56.339959╎Цветочка, букетная лавка?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=route">Найти проезд до Цветочка, букетная лавка</a></div><script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js"></script><script charset="utf-8">new DGWidgetLoader({"width":640,"height":600,"borderColor":"#a3a3a3","pos":{"lat":56.340401698160264,"lon":43.95288705825806,"zoom":16},"opt":{"city":"n_novgorod"},"org":[{"id":"2674541559940084"}]});</script><noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. Включите его в настройках вашего браузера.</noscript>
</div>
<style>
    iframe {width: 100%;}
</style>

<?php
include('sys/foot.html');
?>