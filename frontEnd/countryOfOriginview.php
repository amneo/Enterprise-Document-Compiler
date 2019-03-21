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
$countryOfOrigin_view = new countryOfOrigin_view();

// Run the page
$countryOfOrigin_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$countryOfOrigin_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$countryOfOrigin->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcountryOfOriginview = currentForm = new ew.Form("fcountryOfOriginview", "view");

// Form_CustomValidate event
fcountryOfOriginview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcountryOfOriginview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$countryOfOrigin->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $countryOfOrigin_view->ExportOptions->render("body") ?>
<?php $countryOfOrigin_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $countryOfOrigin_view->showPageHeader(); ?>
<?php
$countryOfOrigin_view->showMessage();
?>
<?php if (!$countryOfOrigin_view->IsModal) { ?>
<?php if (!$countryOfOrigin->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($countryOfOrigin_view->Pager)) $countryOfOrigin_view->Pager = new NumericPager($countryOfOrigin_view->StartRec, $countryOfOrigin_view->DisplayRecs, $countryOfOrigin_view->TotalRecs, $countryOfOrigin_view->RecRange, $countryOfOrigin_view->AutoHidePager) ?>
<?php if ($countryOfOrigin_view->Pager->RecordCount > 0 && $countryOfOrigin_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($countryOfOrigin_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_view->pageUrl() ?>start=<?php echo $countryOfOrigin_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($countryOfOrigin_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_view->pageUrl() ?>start=<?php echo $countryOfOrigin_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($countryOfOrigin_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $countryOfOrigin_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($countryOfOrigin_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_view->pageUrl() ?>start=<?php echo $countryOfOrigin_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($countryOfOrigin_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_view->pageUrl() ?>start=<?php echo $countryOfOrigin_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcountryOfOriginview" id="fcountryOfOriginview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($countryOfOrigin_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $countryOfOrigin_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="countryOfOrigin">
<input type="hidden" name="modal" value="<?php echo (int)$countryOfOrigin_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($countryOfOrigin->cooId->Visible) { // cooId ?>
	<tr id="r_cooId">
		<td class="<?php echo $countryOfOrigin_view->TableLeftColumnClass ?>"><span id="elh_countryOfOrigin_cooId"><?php echo $countryOfOrigin->cooId->caption() ?></span></td>
		<td data-name="cooId"<?php echo $countryOfOrigin->cooId->cellAttributes() ?>>
<span id="el_countryOfOrigin_cooId">
<span<?php echo $countryOfOrigin->cooId->viewAttributes() ?>>
<?php echo $countryOfOrigin->cooId->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($countryOfOrigin->countryName->Visible) { // countryName ?>
	<tr id="r_countryName">
		<td class="<?php echo $countryOfOrigin_view->TableLeftColumnClass ?>"><span id="elh_countryOfOrigin_countryName"><?php echo $countryOfOrigin->countryName->caption() ?></span></td>
		<td data-name="countryName"<?php echo $countryOfOrigin->countryName->cellAttributes() ?>>
<span id="el_countryOfOrigin_countryName">
<span<?php echo $countryOfOrigin->countryName->viewAttributes() ?>>
<?php echo $countryOfOrigin->countryName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($countryOfOrigin->countryIsoCode->Visible) { // countryIsoCode ?>
	<tr id="r_countryIsoCode">
		<td class="<?php echo $countryOfOrigin_view->TableLeftColumnClass ?>"><span id="elh_countryOfOrigin_countryIsoCode"><?php echo $countryOfOrigin->countryIsoCode->caption() ?></span></td>
		<td data-name="countryIsoCode"<?php echo $countryOfOrigin->countryIsoCode->cellAttributes() ?>>
<span id="el_countryOfOrigin_countryIsoCode">
<span<?php echo $countryOfOrigin->countryIsoCode->viewAttributes() ?>>
<?php echo $countryOfOrigin->countryIsoCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$countryOfOrigin_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$countryOfOrigin->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$countryOfOrigin_view->terminate();
?>