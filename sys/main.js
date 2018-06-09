function change(min_width=480) {
	if (document.body.clientWidth <= min_width) {
		if (document.getElementById('menu').style.display == 'block')
			document.getElementById('menu').style.display = 'none';
		else
			document.getElementById('menu').style.display = 'block';
	} else {
		document.location.href = '/';
	}
}

function change2(elem) {
	if (document.getElementsByClassName(elem)[0].style.display == 'block')
		document.getElementsByClassName(elem)[0].style.display = 'none';
	else
		document.getElementsByClassName(elem)[0].style.display = 'block';
}

function place(elem, count=4, percent=100, margin=0, padding=0, max_width=1500, min_width=590) {
	var head = document.head || document.getElementsByTagName('head')[0];
	var style = document.getElementsByTagName('style')[0] || document.createElement('style');

	var ots = margin * 2 + padding * 2;
	var re = (max_width - min_width) / (count - 1);
	var obl = max_width * percent / 100;

	var css = elem + " a > div {margin: " + margin + "px; padding: " + padding + "px;}\n@media all and (max-width: " + min_width + "px) {" + elem + " {width: 100%;} " + elem + " a > div {width: calc(100% - " + ots + "px);}}\n";

	for (var i = 0; i < count-1; i++) {
		css += "@media all and (min-width: " + ~~(min_width + re * i) + "px) {" + elem + " {width: " + percent + "%; margin-left: " + (100 - percent) / 2 + "%;} " + elem + " a > div {width: calc(" + 100 / (i + 2) + "% - " + ots + "px);}}\n";
	}

	css += "@media all and (min-width: " + max_width + "px) {" + elem + " {width: " + obl + "px; margin-left: calc(50vw - " + obl / 2 + "px);} " + elem + " a > div {width: " + (obl / count - ots) + "px;}}";

	style.appendChild(document.createTextNode(css));

	head.appendChild(style);
}

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function deleteCookie(cname) {
	document.cookie = cname + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function basketon(elem, num, price) {
	elem.setAttribute('class', 'button active');
	elem.setAttribute('onclick', 'basketoff(this, ' + num + ', ' + price + ')');
	elem.innerHTML = 'Добавлено в корзину (' + price + ' руб.)';

	var x = getCookie('basket') + num + '-';
	deleteCookie('basket');
	setCookie('basket', x, 14); //$.cookie('basket', x, {expires: 14, path: '/'});
}

function basketoff(elem, num, price) {
	elem.setAttribute('class', 'button');
	elem.setAttribute('onclick', 'basketon(this, ' + num + ', ' + price + ')');
	elem.innerHTML = 'Добавить в корзину (' + price + ' руб.)';

	var x = getCookie('basket').split('-');
	//x = remove(x, num.toString());
	//x = x.splice(x.indexOf(num.toString()), 1);
	var y = num.toString();
	for (var i=0; i<x.length; i++) {
		if (x[i] == y) {
			delete x[i];
		}
	}
	setCookie('basket', x.join('-'), 14);
}