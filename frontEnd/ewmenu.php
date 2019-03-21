<?php
namespace PHPMaker2019\SUBMITTAL;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
$topMenu->addMenuItem(4, "mci_Workspace", $MenuLanguage->MenuPhrase("4", "MenuText"), "", -1, "", TRUE, TRUE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(1, "mi_datasheets", $MenuLanguage->MenuPhrase("1", "MenuText"), "datasheetslist.php", 4, "", TRUE, FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(5, "mci_Masters", $MenuLanguage->MenuPhrase("5", "MenuText"), "", -1, "", TRUE, TRUE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(2, "mi_manufacturer", $MenuLanguage->MenuPhrase("2", "MenuText"), "manufacturerlist.php", 5, "", TRUE, FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(3, "mi_countryOfOrigin", $MenuLanguage->MenuPhrase("3", "MenuText"), "countryOfOriginlist.php", 5, "", TRUE, FALSE, FALSE, "", "", TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(4, "mci_Workspace", $MenuLanguage->MenuPhrase("4", "MenuText"), "", -1, "", TRUE, TRUE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(1, "mi_datasheets", $MenuLanguage->MenuPhrase("1", "MenuText"), "datasheetslist.php", 4, "", TRUE, FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(5, "mci_Masters", $MenuLanguage->MenuPhrase("5", "MenuText"), "", -1, "", TRUE, TRUE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(2, "mi_manufacturer", $MenuLanguage->MenuPhrase("2", "MenuText"), "manufacturerlist.php", 5, "", TRUE, FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(3, "mi_countryOfOrigin", $MenuLanguage->MenuPhrase("3", "MenuText"), "countryOfOriginlist.php", 5, "", TRUE, FALSE, FALSE, "", "", TRUE);
echo $sideMenu->toScript();
?>