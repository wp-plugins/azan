<?php
header("Content-type: application/x-javascript");
$scriptbody = '
function showdate() {
	a = new Date(CurrentDate);
	d = a.getDay();
	day = a.getDate();
	wpcmsmonth = a.getMonth() + 1;
	year = a.getYear();
	year = (year == 0) ? 2000 : year;
	(year < 1000) ? (year += 2000) : true;
	year -= ((wpcmsmonth < 3) || ((wpcmsmonth == 3) && (day < 21))) ? 622 : 621;
	switch (wpcmsmonth) {
	case 1:
		(day < 21) ? (wpcmsmonth = 10, day += 10) : (wpcmsmonth = 11, day -= 20);
		break;
	case 2:
		(day < 20) ? (wpcmsmonth = 11, day += 11) : (wpcmsmonth = 12, day -= 19);
		break;
	case 3:
		(day < 21) ? (wpcmsmonth = 12, day += 9) : (wpcmsmonth = 1, day -= 20);
		break;
	case 4:
		(day < 21) ? (wpcmsmonth = 1, day += 11) : (wpcmsmonth = 2, day -= 20);
		break;
	case 5:
	case 6:
		(day < 22) ? (wpcmsmonth -= 3, day += 10) : (wpcmsmonth -= 2, day -= 21);
		break;
	case 7:
	case 8:
	case 9:
		(day < 23) ? (wpcmsmonth -= 3, day += 9) : (wpcmsmonth -= 2, day -= 22);
		break;
	case 10:
		(day < 23) ? (wpcmsmonth = 7, day += 8) : (wpcmsmonth = 8, day -= 22);
		break;
	case 11:
	case 12:
		(day < 22) ? (wpcmsmonth -= 3, day += 9) : (wpcmsmonth -= 2, day -= 21);
		break;
	default:
		break;
	}
	document.getElementById("azanday").value = day;
	document.getElementById("azanwpcmsmonth").value = wpcmsmonth;
}
function main() {
	showdate();
	var i = document.getElementById("cities").selectedIndex;
	if (i == 0)
		return
		var m = document.getElementById("azanwpcmsmonth").value;
	var d = eval(document.getElementById("azanday").value);
	var lg = eval(document.getElementById("longitude").value);
	var lat = eval(document.getElementById("latitude").value);
	var ep = sun(m, d, 4, lg)
		var zr = ep[0];
	delta = ep[1];
	ha = loc2hor(108.0, delta, lat)
		var t1 = Round(zr - ha, 24)
		ep = sun(m, d, t1, lg)
		zr = ep[0];
	delta = ep[1];
	ha = loc2hor(108.0, delta, lat)
		var t1 = Round(zr - ha + 0.025, 24)

		document.getElementById("azan_t1").innerHTML = hms(t1);
	document.getElementById("azan_ht1").value = hhh(t1);
	document.getElementById("azan_mt1").value = mmm(t1);
	ep = sun(m, d, 6, lg)
		zr = ep[0];
	delta = ep[1];
	ha = loc2hor(90.833, delta, lat)
		var t2 = Round(zr - ha, 24)
		ep = sun(m, d, t2, lg)
		zr = ep[0];
	delta = ep[1];
	ha = loc2hor(90.833, delta, lat)
		t2 = Round(zr - ha + 0.008, 24)

		document.getElementById("azan_t2").innerHTML = hms(t2);
	document.getElementById("azan_ht2").value = hhh(t2);
	document.getElementById("azan_mt2").value = mmm(t2);
	ep = sun(m, d, 12, lg)
		ep = sun(m, d, ep[0], lg)
		zr = ep[0] + 0.01;

	document.getElementById("azan_t3").innerHTML = hms(zr);
	document.getElementById("azan_ht3").value = hhh(zr);
	document.getElementById("azan_mt3").value = mmm(zr);
	ep = sun(m, d, 18, lg)
		zr = ep[0];
	delta = ep[1];
	ha = loc2hor(90.833, delta, lat)
		var t3 = Round(zr + ha, 24)
		ep = sun(m, d, t3, lg)
		zr = ep[0];
	delta = ep[1];
	ha = loc2hor(90.833, delta, lat)
		t3 = Round(zr + ha - 0.014, 24)
		document.getElementById("azan_t4").innerHTML = hms(t3);
	document.getElementById("azan_ht4").value = hhh(t3);
	document.getElementById("azan_mt4").value = mmm(t3);
	ep = sun(m, d, 18.5, lg)
		zr = ep[0];
	delta = ep[1];
	ha = loc2hor(94.3, delta, lat)
		var t4 = Round(zr + ha, 24)
		ep = sun(m, d, t4, lg)
		zr = ep[0];
	delta = ep[1];
	ha = loc2hor(94.3, delta, lat)
		t4 = Round(zr + ha + 0.013, 24)
		document.getElementById("azan_t5").innerHTML = hms(t4);
	document.getElementById("azan_ht5").value = hhh(t4);
	document.getElementById("azan_mt5").value = mmm(t4);
	setTimeout("main()", 60000);
	shownow();
}
function sun(m, d, h, lg) {
	if (m < 7)
		d = 31 * (m - 1) + d + h / 24;
	else
		d = 6 + 30 * (m - 1) + d + h / 24;
	var M = 74.2023 + 0.98560026 * d;
	var L = -2.75043 + 0.98564735 * d;
	var lst = 8.3162159 + 0.065709824 * Math.floor(d) + 1.00273791 * 24 * (d % 1) + lg / 15;
	var e = 0.0167065;
	var omega = 4.85131 - 0.052954 * d;
	var ep = 23.4384717 + 0.00256 * cosd(omega);
	var ed = 180.0 / Math.PI * e;
	var u = M;
	for (var i = 1; i < 5; i++)
		u = u - (u - ed * sind(u) - M) / (1 - e * cosd(u));
	var v = 2 * atand(tand(u / 2) * Math.sqrt((1 + e) / (1 - e)));
	var theta = L + v - M - 0.00569 - 0.00479 * sind(omega);
	var delta = asind(sind(ep) * sind(theta));
	var alpha = 180.0 / Math.PI * Math.atan2(cosd(ep) * sind(theta), cosd(theta));
	if (alpha >= 360)
		alpha -= 360;
	var ha = lst - alpha / 15;
	var zr = Round(h - ha, 24);
	return ([zr, delta])
}
function init() {
	lgs = [0, 49.70, 48.30, 45.07, 51.64, 48.68, 46.42, 57.33, 56.29, 50.84, 59.21, 46.28, 51.41, 48.34, 49.59, 60.86, 48.50, 53.06, 53.39, 47.00, 50.86, 52.52, 50.00, 50.88, 57.06, 47.09, 54.44, 59.58, 48.52, 51.59, 54.35];
	lats = [0, 34.09, 38.25, 37.55, 32.68, 31.32, 33.64, 37.47, 27.19, 28.97, 32.86, 38.08, 35.70, 33.46, 37.28, 29.50, 36.68, 36.57, 35.58, 35.31, 32.33, 29.62, 36.28, 34.64, 30.29, 34.34, 36.84, 36.31, 34.80, 30.67, 31.89];
}
function coord() {
	var c = document.getElementById("cities");
	var i = c.selectedIndex;
	if (i == 0) {
		document.getElementById("longitude").value = "";
		document.getElementById("latitude").value = "";
	} else {
		document.getElementById("longitude").value = lgs[i].toString()
			document.getElementById("latitude").value = lats[i].toString()
	}
}
function sind(x) {
	return (Math.sin(Math.PI / 180.0 * x));
}
function cosd(x) {
	return (Math.cos(Math.PI / 180.0 * x));
}
function tand(x) {
	return (Math.tan(Math.PI / 180.0 * x));
}
function atand(x) {
	return (Math.atan(x) * 180.0 / Math.PI);
}
function asind(x) {
	return (Math.asin(x) * 180.0 / Math.PI);
}
function acosd(x) {
	return (Math.acos(x) * 180.0 / Math.PI);
}
function sqrt(x) {
	return (Math.sqrt(x));
}
function frac(x) {
	return (x % 1);
}
function floor(x) {
	return (Math.floor(x));
}
function ceil(x) {
	return (Math.ceil(x));
}
function loc2hor(z, d, p) {
	return (acosd((cosd(z) - sind(d) * sind(p)) / cosd(d) / cosd(p)) / 15);
}
function Round(x, a) {
	var tmp = x % a;
	if (tmp < 0)
		tmp += a;
	return (tmp)
}
function hms(x) {
	x = Math.floor(3600 * x);
	h = Math.floor(x / 3600) + JAT;
	mp = x - 3600 * h;
	m = Math.floor(mp / 60) + (JAT * 60);
	s = Math.floor(mp - 60 * m) + (JAT * 3600);
	return (((h < 10) ? "0" : "") + h.toString() + ":" + ((m < 10) ? "0" : "") + m.toString() + ":" + ((s < 10) ? "0" : "") + s.toString())
}

function hhh(x) {
	x = Math.floor(3600 * x);
	h = Math.floor(x / 3600) + JAT;
	mp = x - 3600 * h;
	m = Math.floor(mp / 60);
	s = Math.floor(mp - 60 * m);
	return (((h < 10) ? "0" : "") + h.toString())
}

function mmm(x) {
	x = Math.floor(3600 * x);
	h = Math.floor(x / 3600);
	mp = x - 3600 * h;
	m = Math.floor(mp / 60);
	s = Math.floor(mp - 60 * m);
	return (((m < 10) ? "0" : "") + m.toString())
}

function offshownow() {
	document.getElementById("azan_p1").src = "" + azan_plugin_url + "s-flash.gif"
		document.getElementById("azan_p2").src = "" + azan_plugin_url + "s-flash.gif"
		document.getElementById("azan_p3").src = "" + azan_plugin_url + "s-flash.gif"
		document.getElementById("azan_p4").src = "" + azan_plugin_url + "s-flash.gif"
		document.getElementById("azan_p5").src = "" + azan_plugin_url + "s-flash.gif"
}

function shownow() {

	today = new Date();
	azan_ttt = new Date();
	azan_ttt.setHours(document.getElementById("azan_ht1").value);
	azan_ttt.setMinutes(document.getElementById("azan_mt1").value);
	if (azan_ttt.getTime() > today.getTime()) {
		offshownow();
		document.getElementById("azan_p1").src = "" + azan_plugin_url + "flasher.gif"
			diff = azan_ttt.getTime() - today.getTime();
		diff = Math.floor(diff / (1000 * 60));
		hh = Math.floor(diff / (60));
		ss = diff - (hh * 60)
			document.getElementById("azanazan").innerHTML = "<font color=#F27900>" + hh + "</font><font color=#F27900 id=donokh>:</font><font color=#F27900>" + ss + "</font> &#1605;&#1575;&#1606;&#1583;&#1607; &#1578;&#1575; <font color=#F27900>&#1575;&#1584;&#1575;&#1606; &#1589;&#1576;&#1581;</font>";
		donokh_show();

	} else {

		if (azan_ttt.getTime() == today.getTime()) {

			offshownow();
			document.getElementById("azan_p1").src = "" + azan_plugin_url + "flasher.gif"
				document.getElementById("azanazan").innerHTML = "<font color=#F27900 id=donokh></font><font color=#F27900>&#1575;&#1584;&#1575;&#1606; &#1589;&#1576;&#1581; &#1576;&#1607; &#1575;&#1601;&#1602; " + document.getElementById("cities").value + "</font>";
			document.getElementById("pazanbox").innerHTML = "&#1575;&#1584;&#1575;&#1606; &#1589;&#1576;&#1581; &#1576;&#1607; &#1575;&#1601;&#1602; " + document.getElementById("cities").value;
			if (document.getElementById( \'pzpzpz\').style.display=="none"){	pz();}
							}

							else
								{
								azan_ttt = new Date( );
								azan_ttt.setHours(document.getElementById("azan_ht2").value);
								azan_ttt.setMinutes(document.getElementById("azan_mt2").value);
								if (azan_ttt.getTime( ) > today.getTime( ))
								{
								offshownow();
								document.getElementById("azan_p2").src=""+azan_plugin_url+"flasher.gif"
								diff = azan_ttt.getTime( ) - today.getTime( );
								diff = Math.floor(diff / (1000 * 60 ));
								hh= Math.floor(diff / ( 60 ));
								ss=diff-(hh * 60)
									document.getElementById("azanazan").innerHTML="<font color=#F27900>" + hh + "</font><font color=#F27900 id=donokh>:</font><font color=#F27900>" + ss + "</font> &#1605;&#1575;&#1606;&#1583;&#1607; &#1578;&#1575; <font color=#F27900>&#1591;&#1604;&#1608;&#1593; &#1582;&#1608;&#1585;&#1588;&#1740;&#1583;</font>";
								donokh_show();

								}

								else
									{
									if (azan_ttt.getTime() == today.getTime())
									{
									offshownow();
									document.getElementById("azan_p2").src=""+azan_plugin_url+"flasher.gif"
										document.getElementById("azanazan").innerHTML="<font color=#F27900 id=donokh></font><font color=#F27900>&#1591;&#1604;&#1608;&#1593; &#1582;&#1608;&#1585;&#1588;&#1740;&#1583;</font>";



									}

									else
										{

										azan_ttt = new Date( );
										azan_ttt.setHours(document.getElementById("azan_ht3").value);
										azan_ttt.setMinutes(document.getElementById("azan_mt3").value);
										if (azan_ttt.getTime( ) > today.getTime( ))
										{
										offshownow();
										document.getElementById("azan_p3").src=""+azan_plugin_url+"flasher.gif"
										diff = azan_ttt.getTime( ) - today.getTime( );
										diff = Math.floor(diff / (1000 * 60 ));
										hh= Math.floor(diff / ( 60 ));
										ss=diff-(hh * 60)
											document.getElementById("azanazan").innerHTML="<font color=#F27900>" + hh + "</font><font color=#F27900 id=donokh>:</font><font color=#F27900>" + ss + "</font> &#1605;&#1575;&#1606;&#1583;&#1607; &#1578;&#1575; <font color=#F27900>&#1575;&#1584;&#1575;&#1606; &#1592;&#1607;&#1585;</font>";
										donokh_show();
										}

										else
											{

											if (azan_ttt.getTime() == today.getTime())
											{
											offshownow();
											document.getElementById("azan_p3").src=""+azan_plugin_url+"flasher.gif"
												document.getElementById("azanazan").innerHTML="<font color=#F27900 id=donokh></font><font color=#F27900>&#1575;&#1584;&#1575;&#1606; &#1592;&#1607;&#1585; &#1576;&#1607; &#1575;&#1601;&#1602; " + document.getElementById("cities").value + "</font>";

															document.getElementById("pazanbox").innerHTML="&#1575;&#1584;&#1575;&#1606; &#1592;&#1607;&#1585; &#1576;&#1607; &#1575;&#1601;&#1602; " + document.getElementById("cities").value ;
								if (document.getElementById(\'pzpzpz\').style.display=="none"){	pz();}
											}

											else
												{

												azan_ttt = new Date( );
												azan_ttt.setHours(document.getElementById("azan_ht4").value);
												azan_ttt.setMinutes(document.getElementById("azan_mt4").value);
												if (azan_ttt.getTime( ) > today.getTime( ))
												{
												offshownow();
												document.getElementById("azan_p4").src=""+azan_plugin_url+"flasher.gif"
												diff = azan_ttt.getTime( ) - today.getTime( );
												diff = Math.floor(diff / (1000 * 60 ));
												hh= Math.floor(diff / ( 60 ));
												ss=diff-(hh * 60)
													document.getElementById("azanazan").innerHTML="<font color=#F27900>" + hh + "</font><font color=#F27900 id=donokh>:</font><font color=#F27900>" + ss + "</font> &#1605;&#1575;&#1606;&#1583;&#1607; &#1578;&#1575; <font color=#F27900>&#1594;&#1585;&#1608;&#1576; &#1582;&#1608;&#1585;&#1588;&#1740;&#1583;</font>";
												donokh_show();
												}
												else
													{
													if (azan_ttt.getTime() == today.getTime())
													{
													offshownow();
													document.getElementById("azan_p4").src=""+azan_plugin_url+"flasher.gif"
														document.getElementById("azanazan").innerHTML="<font color=#F27900 id=donokh></font><font color=#F27900>&#1594;&#1585;&#1608;&#1576; &#1582;&#1608;&#1585;&#1588;&#1740;&#1583;</font>";
													}
													else
														{

														azan_ttt = new Date( );
														azan_ttt.setHours(document.getElementById("azan_ht5").value);
														azan_ttt.setMinutes(document.getElementById("azan_mt5").value);
														if (azan_ttt.getTime( ) > today.getTime( ))
														{
														offshownow();
														document.getElementById("azan_p5").src=""+azan_plugin_url+"flasher.gif"
														diff = azan_ttt.getTime( ) - today.getTime( );
														diff = Math.floor(diff / (1000 * 60 ));
														hh= Math.floor(diff / ( 60 ));
														ss=diff-(hh * 60)
															document.getElementById("azanazan").innerHTML="<font color=#F27900>" + hh + "</font><font color=#F27900 id=donokh>:</font><font color=#F27900>" + ss + "</font> &#1605;&#1575;&#1606;&#1583;&#1607; &#1578;&#1575; <font color=#F27900>&#1575;&#1584;&#1575;&#1606; &#1605;&#1594;&#1585;&#1576;</font>";
														donokh_show();
														}
														else
															{

															if (azan_ttt.getTime() == today.getTime())
															{
															offshownow();
															document.getElementById("azan_p5").src=""+azan_plugin_url+"flasher.gif"
																document.getElementById("azanazan").innerHTML="<font color=#F27900 id=donokh></font><font color=#F27900>&#1575;&#1584;&#1575;&#1606; &#1605;&#1594;&#1585;&#1576; &#1576;&#1607; &#1575;&#1601;&#1602; " + document.getElementById("cities").value + "</font>";

					document.getElementById("pazanbox").innerHTML="&#1575;&#1584;&#1575;&#1606; &#1605;&#1594;&#1585;&#1576; &#1576;&#1607; &#1575;&#1601;&#1602; " + document.getElementById("cities").value ;
								if (document.getElementById(\'pzpzpz\').style.display=="none"){	pz();}

															}
															else
																{

																azan_ttt = new Date( );
																azan_ttt.setHours(23);
																azan_ttt.setMinutes(59);
																diff = azan_ttt.getTime( ) - today.getTime( );
																diff = Math.floor(diff / (1000 * 60 ));
																hh= Math.floor(diff / ( 60 ));
																ss=diff-(hh * 60) ;


																offshownow();
																document.getElementById("azan_p1").src=""+azan_plugin_url+"flasher.gif";
																hh+=Math.floor(document.getElementById("azan_ht1").value);
																ss+=Math.floor(document.getElementById("azan_mt1").value);
																	document.getElementById("azanazan").innerHTML="<font color=#F27900>" + hh + "</font><font color=#F27900 id=donokh>:</font><font color=#F27900>" + ss + "</font> &#1605;&#1575;&#1606;&#1583;&#1607; &#1578;&#1575; <font color=#F27900>&#1575;&#1584;&#1575;&#1606; &#1589;&#1576;&#1581;</font>";
																donokh_show();
					}}}}}}}}}}setTimeout("shownow()",20000);
					}


					function donokh_show(){
					//document.getElementById("donokh").color="#F27900"
					//setTimeout("donokh_hide()",500);
					}
					function donokh_hide(){
					//document.getElementById("donokh").color="#FFFFFF"
					//setTimeout("donokh_show()",500);
					}
					document.write("<input type=hidden id=latitude  name=latitude><input id=azanday type=hidden name=azanday><input id=azanwpcmsmonth type=hidden name=azanwpcmsmonth><input  type=hidden id=longitude name=longitude ><input type=hidden id=azan_ht1 name=azan_ht1 ><input type=hidden id=azan_mt1 name=azan_mt1 ><input type=hidden id=azan_ht2 name=azan_ht2 ><input type=hidden id=azan_mt2 name=azan_mt2 ><input type=hidden id=azan_ht3 name=azan_ht3 ><input type=hidden id=azan_mt3 name=azan_mt3 ><input type=hidden id=azan_ht4 name=azan_ht4 ><input type=hidden id=azan_mt4 name=azan_mt4 ><input type=hidden id=azan_ht5 name=azan_ht5 ><input type=hidden id=azan_mt5 name=azan_mt5 >")
					document.write("<table border=0 width=151 style=\'font-family: Tahoma; font-size: 8pt\' dir=rtl height=30><tr>	<td align=center><span id=azanazan></span>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>	</table>")
					document.write("<table border=0 width=156 style=\'font-family: Tahoma; font-size: 8pt\'><tr><td align=center id=azan_t1>&nbsp;</td><td dir=rtl width=58%>	<img border=0 src="+azan_plugin_url+"s-flash.gif width=10 height=7 id=azan_p1> <span>&#1575;&#1584;&#1575;&#1606; &#1589;&#1576;&#1581;</span></td></tr><tr><td align=center id=azan_t2>&nbsp;</td><td dir=rtl width=58%><img border=0 src="+azan_plugin_url+"s-flash.gif width=10 height=7 id=azan_p2> <span>&#1591;&#1604;&#1608;&#1593; &#1582;&#1608;&#1585;&#1588;&#1740;&#1583;</span></td>	</tr><tr><td align=center id=azan_t3>&nbsp;</td><td dir=rtl width=58%><img border=0 src="+azan_plugin_url+"s-flash.gif width=10 height=7 id=azan_p3> <span>&#1575;&#1584;&#1575;&#1606; &#1592;&#1607;&#1585;</span></td></tr><tr><td align=center id=azan_t4>&nbsp;</td><td dir=rtl width=58%><img border=0 src="+azan_plugin_url+"s-flash.gif width=10 height=7 id=azan_p4>	 <span>&#1594;&#1585;&#1608;&#1576; &#1582;&#1608;&#1585;&#1588;&#1740;&#1583;</span></td></tr><tr><td align=center id=azan_t5>&nbsp;</td><td dir=rtl width=58%><img border=0 src="+azan_plugin_url+"s-flash.gif width=10 height=7 id=azan_p5> 	<span>&#1575;&#1584;&#1575;&#1606; &#1605;&#1594;&#1585;&#1576;</span></td></tr></table>")
					document.write("<table border=0 width=150 cellspacing=0 cellpadding=0 style=\'font-family: Tahoma; font-size: 8pt\' dir=\'rtl\' height=30><tr>	<td align=center><span>&#1575;&#1608;&#1602;&#1575;&#1578; &#1576;&#1607; &#1575;&#1601;&#1602; : <select id=cities size=1 name=c dir=rtl style=\'font-family: Tahoma; font-size: 8pt; width: 69; height: 19\' onchange=\'coord();main();\'><option value=\'\'>&#1575;&#1606;&#1578;&#1582;&#1575;&#1576; &#1588;&#1607;&#1585;</option><option value=\'&#1575;&#1585;&#1575;&#1705;\'>&#1575;&#1585;&#1575;&#1705;</option><option value=\'&#1575;&#1585;&#1583;&#1576;&#1740;&#1604;\'>&#1575;&#1585;&#1583;&#1576;&#1740;&#1604;</option><option value=\'&#1575;&#1585;&#1608;&#1605;&#1740;&#1607;\'>&#1575;&#1585;&#1608;&#1605;&#1740;&#1607;</option><option value=\'&#1575;&#1589;&#1601;&#1607;&#1575;&#1606;\'>&#1575;&#1589;&#1601;&#1607;&#1575;&#1606;</option><option value=\'&#1575;&#1607;&#1608;&#1575;&#1586;\'>&#1575;&#1607;&#1608;&#1575;&#1586;</option><option value=\'&#1575;&#1740;&#1604;&#1575;&#1605;\'>&#1575;&#1740;&#1604;&#1575;&#1605;</option><option value=\'&#1576;&#1580;&#1606;&#1608;&#1585;&#1583;\'>&#1576;&#1580;&#1606;&#1608;&#1585;&#1583;</option>	<option value=\'&#1576;&#1606;&#1583;&#1585;&#1593;&#1576;&#1575;&#1587;\'>&#1576;&#1606;&#1583;&#1585;&#1593;&#1576;&#1575;&#1587;</option><option value=\'&#1576;&#1608;&#1588;&#1607;&#1585;\'>&#1576;&#1608;&#1588;&#1607;&#1585;</option><option value=\'&#1576;&#1740;&#1585;&#1580;&#1606;&#1583;\'>&#1576;&#1740;&#1585;&#1580;&#1606;&#1583;</option><option value=\'&#1578;&#1576;&#1585;&#1740;&#1586;\'>&#1578;&#1576;&#1585;&#1740;&#1586;</option><option value=\'&#1578;&#1607;&#1585;&#1575;&#1606;\'>&#1578;&#1607;&#1585;&#1575;&#1606;</option><option value=\'&#1582;&#1585;&#1605; &#1570;&#1576;&#1575;&#1583;\'>&#1582;&#1585;&#1605; &#1570;&#1576;&#1575;&#1583;</option><option value=\'&#1585;&#1588;&#1578;\'>&#1585;&#1588;&#1578;</option><option value=\'&#1586;&#1575;&#1607;&#1583;&#1575;&#1606;\'>&#1586;&#1575;&#1607;&#1583;&#1575;&#1606;</option><option value=\'&#1586;&#1606;&#1580;&#1575;&#1606;\'>&#1586;&#1606;&#1580;&#1575;&#1606;</option><option value=\'&#1587;&#1575;&#1585;&#1740;\'>&#1587;&#1575;&#1585;&#1740;</option><option value=\'&#1587;&#1605;&#1606;&#1575;&#1606;\'>&#1587;&#1605;&#1606;&#1575;&#1606;</option><option value=\'&#1587;&#1606;&#1606;&#1583;&#1580;\'>&#1587;&#1606;&#1606;&#1583;&#1580;</option><option value=\'&#1588;&#1607;&#1585;&#1705;&#1585;&#1583;\'>&#1588;&#1607;&#1585;&#1705;&#1585;&#1583;</option><option value=\'&#1588;&#1740;&#1585;&#1575;&#1586;\'>&#1588;&#1740;&#1585;&#1575;&#1586;</option><option value=\'&#1602;&#1586;&#1608;&#1740;&#1606;\'>&#1602;&#1586;&#1608;&#1740;&#1606;</option><option value=\'&#1602;&#1605;\'>&#1602;&#1605;</option><option value=\'&#1705;&#1585;&#1605;&#1575;&#1606;\'>&#1705;&#1585;&#1605;&#1575;&#1606;</option>	<option value=\'&#1705;&#1585;&#1605;&#1575;&#1606;&#1588;&#1575;&#1607;\'>&#1705;&#1585;&#1605;&#1575;&#1606;&#1588;&#1575;&#1607;</option><option value=\'&#1711;&#1585;&#1711;&#1575;&#1606;\'>&#1711;&#1585;&#1711;&#1575;&#1606;</option><option value=\'&#1605;&#1588;&#1607;&#1583;\'>&#1605;&#1588;&#1607;&#1583;</option><option value=\'&#1607;&#1605;&#1583;&#1575;&#1606;\'>&#1607;&#1605;&#1583;&#1575;&#1606;</option><option value=\'&#1740;&#1575;&#1587;&#1608;&#1580;\'>&#1740;&#1575;&#1587;&#1608;&#1580;</option><option value=\'&#1740;&#1586;&#1583;\'>&#1740;&#1586;&#1583;</option></select></span>&nbsp;&nbsp;&nbsp; </td></table>")

';
echo $scriptbody;

?>