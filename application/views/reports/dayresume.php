<?php
/**
 * Página principal del administrador.
 * 
 * @author Carlos Bello
 */
?>
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Georgia;
	panose-1:2 4 5 2 5 4 5 2 3 3;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:647 0 0 0 159 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	mso-hyphenate:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";
	mso-font-kerning:1.5pt;}
h1
	{mso-style-unhide:no;
	mso-style-parent:Standard;
	margin-top:24.0pt;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	mso-outline-level:1;
	mso-hyphenate:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:18.0pt;
	font-family:"Arial","sans-serif";
	mso-fareast-font-family:Arial;
	color:black;
	mso-font-kerning:1.5pt;}
h2
	{mso-style-unhide:no;
	mso-style-parent:Standard;
	margin-top:18.0pt;
	margin-right:0cm;
	margin-bottom:4.0pt;
	margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	mso-outline-level:2;
	mso-hyphenate:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:14.0pt;
	font-family:"Arial","sans-serif";
	mso-fareast-font-family:Arial;
	color:black;
	mso-font-kerning:1.5pt;}
h3
	{mso-style-unhide:no;
	mso-style-parent:Standard;
	margin-top:14.0pt;
	margin-right:0cm;
	margin-bottom:4.0pt;
	margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	mso-outline-level:3;
	mso-hyphenate:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:12.0pt;
	font-family:"Arial","sans-serif";
	mso-fareast-font-family:Arial;
	color:#666666;
	mso-font-kerning:1.5pt;}
h4
	{mso-style-unhide:no;
	mso-style-parent:Standard;
	margin-top:12.0pt;
	margin-right:0cm;
	margin-bottom:2.0pt;
	margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	mso-outline-level:4;
	mso-hyphenate:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:11.0pt;
	font-family:"Arial","sans-serif";
	mso-fareast-font-family:Arial;
	color:#666666;
	mso-font-kerning:1.5pt;
	font-weight:normal;
	font-style:italic;}
h5
	{mso-style-unhide:no;
	mso-style-parent:Standard;
	margin-top:11.0pt;
	margin-right:0cm;
	margin-bottom:2.0pt;
	margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	mso-outline-level:5;
	mso-hyphenate:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	mso-fareast-font-family:Arial;
	color:#666666;
	mso-font-kerning:1.5pt;}
h6
	{mso-style-unhide:no;
	mso-style-parent:Standard;
	margin-top:10.0pt;
	margin-right:0cm;
	margin-bottom:2.0pt;
	margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	mso-outline-level:6;
	mso-hyphenate:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:10.0pt;
	font-family:"Arial","sans-serif";
	mso-fareast-font-family:Arial;
	color:#666666;
	mso-font-kerning:1.5pt;
	font-weight:normal;
	font-style:italic;}
p.MsoTitle, li.MsoTitle, div.MsoTitle
	{mso-style-unhide:no;
	mso-style-parent:Standard;
	margin-top:24.0pt;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	mso-hyphenate:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:36.0pt;
	font-family:"Arial","sans-serif";
	mso-fareast-font-family:Arial;
	color:black;
	mso-font-kerning:1.5pt;
	font-weight:bold;}
p.MsoSubtitle, li.MsoSubtitle, div.MsoSubtitle
	{mso-style-unhide:no;
	mso-style-parent:Standard;
	margin-top:18.0pt;
	margin-right:0cm;
	margin-bottom:4.0pt;
	margin-left:0cm;
	line-height:115%;
	mso-pagination:widow-orphan;
	mso-hyphenate:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:24.0pt;
	font-family:"Georgia","serif";
	mso-fareast-font-family:Georgia;
	mso-bidi-font-family:Georgia;
	color:#666666;
	mso-font-kerning:1.5pt;
	font-style:italic;}
p.Standard, li.Standard, div.Standard
	{mso-style-name:Standard;
	mso-style-unhide:no;
	mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	line-height:115%;
	mso-pagination:widow-orphan;
	mso-hyphenate:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:11.0pt;
	font-family:"Arial","sans-serif";
	mso-fareast-font-family:Arial;
	color:black;
	mso-font-kerning:1.5pt;}
p.Sinlista1, li.Sinlista1, div.Sinlista1
	{mso-style-name:"Sin lista1";
	mso-style-unhide:no;
	mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	mso-hyphenate:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";
	mso-font-kerning:1.5pt;}
span.SpellE
	{mso-style-name:"";
	mso-spl-e:yes;}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	font-size:10.0pt;
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	mso-font-kerning:1.5pt;}
.MsoPapDefault
	{mso-style-type:export-only;
	mso-hyphenate:none;
	punctuation-wrap:simple;
	text-autospace:none;}
@page WordSection1
	{size:612.0pt 792.0pt;
	margin:72.0pt 72.0pt 72.0pt 72.0pt;
	mso-header-margin:36.0pt;
	mso-footer-margin:36.0pt;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
-->
</style>

<h2>Resumen de pedidos del día <?php echo date("Y-m-d\n"); ?></h2>


<div class=WordSection1>

<h2><a name=h.grxrd6k0mtkx></a>Menús pedidos</h2>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=624
 style='margin-left:5.0pt;border-collapse:collapse;mso-table-layout-alt:fixed;
 mso-padding-alt:0cm .5pt 0cm .5pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b>Tipo de menú</b></p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b>Cantidad</b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Menú del día</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>15</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Menú del día (2 primeros)</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>2</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;mso-yfti-lastrow:yes'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Menú del día (2 segundos)</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>1</p>
  </td>
 </tr>
</table>

<p class=Standard><span style='mso-spacerun:yes'> </span></p>

<h2><a name=h.e44rdfpualdt></a>Productos pedidos</h2>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=624
 style='margin-left:5.0pt;border-collapse:collapse;mso-table-layout-alt:fixed;
 mso-padding-alt:0cm .5pt 0cm .5pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b>Producto</b></p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'><b>Cantidad</b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Ensalada mixta</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>8</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Ensalada de pasta y arroz</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>2</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Arroz a la cubana</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>7</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Ensaladilla rusa casera </p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>2</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Filete de pollo a la pimienta</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>5</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Bistec de ternera</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>7</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Pescadilla de ración</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>3</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Mero a la plancha</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>2</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Agua</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>13</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Cerveza</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>1</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Cerveza sin alcohol</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>1</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Coca Cola</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>2</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><span class=SpellE>Fanta</span>
  de naranja</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>1</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Fruta</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>13</p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15;mso-yfti-lastrow:yes'>
  <td width=527 valign=top style='width:395.25pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'>Flan</p>
  </td>
  <td width=97 valign=top style='width:72.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard align=right style='text-align:right;line-height:normal'>5</p>
  </td>
 </tr>
</table>

<p class=Standard><span style='mso-spacerun:yes'> </span></p>

</div>
