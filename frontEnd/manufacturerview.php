<?php
namespace PHPMaker2019\SUBMITTAL;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$manufacturer_view = new manufacturer_view();

// Run the page
$manufacturer_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$manufacturer_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$manufacturer->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fmanufacturerview = currentForm = new ew.Form("fmanufacturerview", "view");

// Form_CustomValidate event
fmanufacturerview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmanufacturerview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$manufacturer->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $manufacturer_view->ExportOptions->render("body") ?>
<?php $manufacturer_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $manufacturer_view->showPageHeader(); ?>
<?php
$manufacturer_view->showMessage();
?>
<?php if (!$manufacturer_view->IsModal) { ?>
<?php if (!$manufacturer->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($manufacturer_view->Pager)) $manufacturer_view->Pager = new NumericPager($manufacturer_view->StartRec, $manufacturer_view->DisplayRecs, $manufacturer_view->TotalRecs, $manufacturer_view->RecRange, $manufacturer_view->AutoHidePager) ?>
<?php if ($manufacturer_view->Pager->RecordCount > 0 && $manufacturer_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($manufacturer_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $manufacturer_view->pageUrl() ?>start=<?php echo $manufacturer_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($manufacturer_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $manufacturer_view->pageUrl() ?>start=<?php echo $manufacturer_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($manufacturer_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $manufacturer_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($manufacturer_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $manufacturer_view->pageUrl() ?>start=<?php echo $manufacturer_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($manufacturer_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $manufacturer_view->pageUrl() ?>start=<?php echo $manufacturer_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fmanufacturerview" id="fmanufacturerview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($manufacturer_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $manufacturer_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="manufacturer">
<input type="hidden" name="modal" value="<?php echo (int)$manufacturer_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($manufacturer->manufacturerName->Visible) { // manufacturerName ?>
	<tr id="r_manufacturerName">
		<td class="<?php echo $manufacturer_view->TableLeftColumnClass ?>"><span id="elh_manufacturer_manufacturerName"><?php echo $manufacturer->manufacturerName->caption() ?></span></td>
		<td data-name="manufacturerName"<?php echo $manufacturer->manufacturerName->cellAttributes() ?>>
<span id="el_manufacturer_manufacturerName">
<span<?php echo $manufacturer->manufacturerName->viewAttributes() ?>>
<?php echo $manufacturer->manufacturerName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($manufacturer->manufacturerAddress->Visible) { // manufacturerAddress ?>
	<tr id="r_manufacturerAddress">
		<td class="<?php echo $manufacturer_view->TableLeftColumnClass ?>"><span id="elh_manufacturer_manufacturerAddress"><?php echo $manufacturer->manufacturerAddress->caption() ?></span></td>
		<td data-name="manufacturerAddress"<?php echo $manufacturer->manufacturerAddress->cellAttributes() ?>>
<span id="el_manufacturer_manufacturerAddress">
<span<?php echo $manufacturer->manufacturerAddress->viewAttributes() ?>>
<?php echo $manufacturer->manufacturerAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($manufacturer->manufacturerFactory->Visible) { // manufacturerFactory ?>
	<tr id="r_manufacturerFactory">
		<td class="<?php echo $manufacturer_view->TableLeftColumnClass ?>"><span id="elh_manufacturer_manufacturerFactory"><?php echo $manufacturer->manufacturerFactory->caption() ?></span></td>
		<td data-name="manufacturerFactory"<?php echo $manufacturer->manufacturerFactory->cellAttributes() ?>>
<span id="el_manufacturer_manufacturerFactory">
<span<?php echo $manufacturer->manufacturerFactory->viewAttributes() ?>>
<?php echo $manufacturer->manufacturerFactory->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$manufacturer_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$manufacturer->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$manufacturer_view->terminate();
?>