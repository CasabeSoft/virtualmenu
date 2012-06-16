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
	punctuation-wrap:simple;
	text-autospace:none;}
 /* Page Definitions */
 @page
	{mso-footnote-separator:url("InformeDetallesdepedidos_archivos/header.htm") fs;
	mso-footnote-continuation-separator:url("InformeDetallesdepedidos_archivos/header.htm") fcs;
	mso-endnote-separator:url("InformeDetallesdepedidos_archivos/header.htm") es;
	mso-endnote-continuation-separator:url("InformeDetallesdepedidos_archivos/header.htm") ecs;}
@page WordSection1
	{size:612.0pt 792.0pt;
	margin:72.0pt 2.0cm 72.0pt 2.0cm;
	mso-header-margin:36.0pt;
	mso-footer-margin:36.0pt;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Tabla normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";
	mso-font-kerning:1.5pt;}
</style>
<![endif]-->
<h2>Detalles de pedidos del día <?php echo date("Y-m-d\n"); ?></h2>
<div class=WordSection1>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=664
 style='margin-left:5.0pt;border-collapse:collapse;mso-table-layout-alt:fixed;
 mso-padding-alt:0cm .5pt 0cm .5pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
  <td width=285 valign=top style='width:213.75pt;border:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><span class=SpellE><b><span
  style='font-size:10.0pt'>Yael</span></b></span><b><span style='font-size:
  10.0pt'> Bravo</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Ensalada
  mixta, Ensaladilla rusa casera </span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Agua,
  Fruta</span></p>
  </td>
  <td width=44 valign=top style='width:33.0pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>1</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D2P</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=293 valign=top style='width:219.75pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><span class=SpellE><b><span
  style='font-size:10.0pt'>Servio</span></b></span><b><span style='font-size:
  10.0pt'> Herrera</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Ensalada
  mixta, Arroz a la cubana</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Agua,
  Fruta</span></p>
  </td>
  <td width=42 valign=top style='width:31.5pt;border:solid black 1.0pt;
  border-left:none;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>2</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D2P</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1'>
  <td width=285 valign=top style='width:213.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><span class=SpellE><b><span
  style='font-size:10.0pt'>Laina</span></b></span><b><span style='font-size:
  10.0pt'> Iglesias</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Ensalada
  mixta, Filete de pollo a la pimienta</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Coca
  Cola, Flan</span></p>
  </td>
  <td width=44 valign=top style='width:33.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>3</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=293 valign=top style='width:219.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>Job
  Ulloa</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Ensalada
  mixta, Filete de pollo a la pimienta</span></p>
  <p class=Standard style='line-height:normal'><span class=SpellE><span
  style='font-size:10.0pt'>Fanta</span></span><span style='font-size:10.0pt'>
  de naranja, Flan</span></p>
  </td>
  <td width=42 valign=top style='width:31.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>4</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2'>
  <td width=285 valign=top style='width:213.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>Pamela
  Carmona</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Ensalada
  de pasta y arroz, Bistec de ternera</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Agua,
  Fruta</span></p>
  </td>
  <td width=44 valign=top style='width:33.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>5</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=293 valign=top style='width:219.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>Otilio
  Ybarra</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Ensalada
  mixta, Filete de pollo a la pimienta</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Agua,
  Fruta</span></p>
  </td>
  <td width=42 valign=top style='width:31.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>6</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3'>
  <td width=285 valign=top style='width:213.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><span class=SpellE><b><span
  style='font-size:10.0pt'>Ticiana</span></b></span><b><span style='font-size:
  10.0pt'> Barreto</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Arroz
  a la cubana, Bistec de ternera</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Agua,
  Fruta</span></p>
  </td>
  <td width=44 valign=top style='width:33.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>7</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=293 valign=top style='width:219.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><span class=SpellE><b><span
  style='font-size:10.0pt'>Leonides</span></b></span><b><span style='font-size:
  10.0pt'> Barrios</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Ensalada
  mixta, Filete de pollo a la pimienta</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Agua,
  Fruta</span></p>
  </td>
  <td width=42 valign=top style='width:31.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>8</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4'>
  <td width=285 valign=top style='width:213.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>Olaya
  Pantoja</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Arroz
  a la cubana, Bistec de ternera</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Coca
  Cola, Flan</span></p>
  </td>
  <td width=44 valign=top style='width:33.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>9</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  </td>
  <td width=293 valign=top style='width:219.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>Simón
  Benítez</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Ensalada
  mixta, Bistec de ternera</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Agua,
  Fruta</span></p>
  </td>
  <td width=42 valign=top style='width:31.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>10</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5'>
  <td width=285 valign=top style='width:213.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>Librado
  Chapa</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Ensalada
  de pasta y arroz, Bistec de ternera</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Agua,
  Fruta</span></p>
  </td>
  <td width=44 valign=top style='width:33.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>11</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  </td>
  <td width=293 valign=top style='width:219.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>Rebecca
  Pizarro</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Arroz
  a la cubana, Bistec de ternera</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Agua,
  Fruta</span></p>
  </td>
  <td width=42 valign=top style='width:31.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>12</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6'>
  <td width=285 valign=top style='width:213.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><span class=SpellE><b><span
  style='font-size:10.0pt'>Ezio</span></b></span><b><span style='font-size:
  10.0pt'> Nazario</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Arroz
  a la cubana, Pescadilla de ración</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Agua,
  Fruta</span></p>
  </td>
  <td width=44 valign=top style='width:33.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>13</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  </td>
  <td width=293 valign=top style='width:219.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>Eneida
  Paredes</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Arroz
  a la cubana, Pescadilla de ración</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Agua,
  Fruta</span></p>
  </td>
  <td width=42 valign=top style='width:31.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>14</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7'>
  <td width=285 valign=top style='width:213.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>Michel
  Caballero</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Arroz
  a la cubana, Pescadilla de ración</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Agua,
  Fruta</span></p>
  </td>
  <td width=44 valign=top style='width:33.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>15</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  </td>
  <td width=293 valign=top style='width:219.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>Oswaldo
  <span class=SpellE>Saenz</span></span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Ensalada
  mixta, Mero a la plancha</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Agua,
  Fruta</span></p>
  </td>
  <td width=42 valign=top style='width:31.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>16</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;mso-yfti-lastrow:yes'>
  <td width=285 valign=top style='width:213.75pt;border:solid black 1.0pt;
  border-top:none;mso-border-top-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><span class=SpellE><b><span
  style='font-size:10.0pt'>Freya</span></b></span><b><span style='font-size:
  10.0pt'> Padilla</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Ensaladilla
  rusa casera, Mero a la plancha</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Cerveza
  sin <span class=SpellE>acohol</span>, Flan</span></p>
  </td>
  <td width=44 valign=top style='width:33.0pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>17</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D11</span></p>
  </td>
  <td width=293 valign=top style='width:219.75pt;border-top:none;border-left:
  none;border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;
  mso-border-top-alt:solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;
  padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b><span style='font-size:10.0pt'>Ana
  Barrera</span></b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Filete
  de pollo a la pimienta, Bistec de ternera</span></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>Cerveza,
  Flan</span></p>
  </td>
  <td width=42 valign=top style='width:31.5pt;border-top:none;border-left:none;
  border-bottom:solid black 1.0pt;border-right:solid black 1.0pt;mso-border-top-alt:
  solid black 1.0pt;mso-border-left-alt:solid black 1.0pt;padding:5.0pt 5.0pt 5.0pt 5.0pt'>
  <p class=Standard style='line-height:normal'><b>18</b></p>
  <p class=Standard style='line-height:normal'><span style='font-size:10.0pt'>D2S</span></p>
  </td>
 </tr>
</table>

<p class=Standard><o:p>&nbsp;</o:p></p>

<p class=Standard><o:p>&nbsp;</o:p></p>

</div>

