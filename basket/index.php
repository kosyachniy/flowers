<?php
$title = 'Заказ цветов';
include('../sys/head.html');
?>

<div class="info" onclick="change();">↑ Нажми на лого ↑</div>

<script>
	place('.notes2', 3, 85, 20);
</script>

<div class="notes2">


<div id="sp-message-area" class="span6" style="width: 100%;"><section id="sp-component-area-wrapper" class=" "><div class="row-fluid" id="component-area">
<div id="sp-component-area" class="span12"><section id="sp-component-wrapper"><div id="sp-component"><div id="system-message-container">
	</div>


<section class="featured ">

		
				
		<section class="items-leading">
							<div class="leading-1">
					
<article class="post-4 post hentry status-publish category-uncategorised">

			
	
		
		
	<section class="entry-content">  

								
		
				
		<p>		</p><div class="moduletable">
	<div class="label_products list_product">

<?php
$basket = explode('-', $_COOKIE['basket']);
$empty = true;
$sum = 0;

$res = mysqli_query($db, "SELECT * FROM `products`");
while ($row = mysqli_fetch_array($res)) {
	if (in_array($row['id'], $basket)) {
		include('../sys/middle.html');
		$empty = false;
		$sum += $row['price'];
	}
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



<?php


print '</div>';

if ($empty) {
	print '<div style="margin: -20px 0 20px 10%;"><h2>Корзина пуста!</h2></div>';
} else {
	print '<a href="/buy"><div class="act">Заказать (' . $sum . ' руб.)</div></a>';
}

include('../sys/foot.html');
?>