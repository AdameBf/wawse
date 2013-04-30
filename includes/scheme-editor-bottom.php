</div> <!--div Corps-->
</div> <!--div background-->
<div id="vagues3"></div>
<div id="vagues2"></div>
<div id="vagues"></div>
<div id="Basdepage">
<?php
$fichier = fopen('../../version.ver', 'r');
$version = fgets($fichier);
fclose($fichier);

$fichier_vues_total = fopen('../../statistiques/vues/vues_total.cpt', 'r+');
$vues_total = fgets($fichier_vues_total);
$vues_total++;
fseek($fichier_vues_total, 0);
fputs($fichier_vues_total, $vues_total);
fclose($fichier_vues_total);

//Vues de la page
if (isset($compteur_page) AND $compteur_page != '' AND $compteur_page != NULL)
{
	$fichier_vues_page = fopen('../../statistiques/vues/'.$compteur_page, 'r+');
	$vues_page = fgets($fichier_vues_page);
	$vues_page++;
	fseek($fichier_vues_page, 0);
	fputs($fichier_vues_page, $vues_page);
	fclose($fichier_vues_page);
}
if (isset($language) AND $language === 'fr')
{
?>
<p>Site et éditeur de schemes créés par LeTotalKiller.<!-- Merci à FFie et GreeN ;).--><br />
Liens pratiques :</p>
<ul>
	<li><a href="../index.php">Accueil</a></li>
	<li><a href="../plan-du-site.php">Plan du site</a></li>
	<li><a href="../contact.php">Contact</a></li>
</ul>
<?php
}
else
{
?>
<p style="margin-bottom: 20px;">Scheme editor by LeTotalKiller.<!--<br />
Special thanks to FFie and GreeN ;).--></p>
<?php
}
?>
<p id="vues">
<?php
if (isset($vues_page))
{
	if(isset($language) AND $language === 'fr')
	{
	?>
	Cette page a été vue <?php echo $vues_page; ?> fois depuis le <?php echo $date_comptage_vues; ?>.<br />
	<?php
	}
	else
	{
	?>
	This page has been viewed <?php echo $vues_page; ?> times since <?php echo $date_comptage_vues; ?>.<br />
	<?php
	}
}
if(isset($language) AND $language === 'fr')
{
?>
En tout, les pages du site ont été vues <?php echo $vues_total; ?> fois depuis le 18 juillet 2011.</p>
<?php
}
else
{
?>
This website's pages have been loaded <?php echo $vues_total; ?> times since July 18th, 2011.</p>
<?php
}
?>
</div>
</div>
</div>
<div id="bas-de-fenetre">
<p id="bas-gauche">
<img src="../../images/xhtml-valide.gif" alt="XHTML 1.0 Valide !" height="24" width="66" />
<!--[if gte IE 7]>
<img style="border:0;" src="../../images/valid-css-blue.png" alt="CSS Valide !" height="24"  width="66" />
<![endif]-->
<!--[if !IE]><-->
<img style="border:0;" src="../../images/valid-css-blue.png" alt="CSS Valide !" height="24"  width="66" />
<!--><![endif]-->
</p>
<p id="copyright">
&copy; LeTotalKiller, 2008-2013, version <?php echo $version; ?>.
</p>
</div>
</body>
</html>