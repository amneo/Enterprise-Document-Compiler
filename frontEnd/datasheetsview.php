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
$datasheets_view = new datasheets_view();

// Run the page
$datasheets_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$datasheets_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$datasheets->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fdatasheetsview = currentForm = new ew.Form("fdatasheetsview", "view");

// Form_CustomValidate event
fdatasheetsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdatasheetsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdatasheetsview.lists["x_manufacturer"] = <?php echo $datasheets_view->manufacturer->Lookup->toClientList() ?>;
fdatasheetsview.lists["x_manufacturer"].options = <?php echo JsonEncode($datasheets_view->manufacturer->lookupOptions()) ?>;
fdatasheetsview.autoSuggests["x_manufacturer"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdatasheetsview.lists["x_duration"] = <?php echo $datasheets_view->duration->Lookup->toClientList() ?>;
fdatasheetsview.lists["x_duration"].options = <?php echo JsonEncode($datasheets_view->duration->options(FALSE, TRUE)) ?>;
fdatasheetsview.lists["x_highlighted"] = <?php echo $datasheets_view->highlighted->Lookup->toClientList() ?>;
fdatasheetsview.lists["x_highlighted"].options = <?php echo JsonEncode($datasheets_view->highlighted->options(FALSE, TRUE)) ?>;
fdatasheetsview.lists["x_coo"] = <?php echo $datasheets_view->coo->Lookup->toClientList() ?>;
fdatasheetsview.lists["x_coo"].options = <?php echo JsonEncode($datasheets_view->coo->lookupOptions()) ?>;
fdatasheetsview.autoSuggests["x_coo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdatasheetsview.lists["x_systrade"] = <?php echo $datasheets_view->systrade->Lookup->toClientList() ?>;
fdatasheetsview.lists["x_systrade"].options = <?php echo JsonEncode($datasheets_view->systrade->options(FALSE, TRUE)) ?>;
fdatasheetsview.lists["x_isdatasheet"] = <?php echo $datasheets_view->isdatasheet->Lookup->toClientList() ?>;
fdatasheetsview.lists["x_isdatasheet"].options = <?php echo JsonEncode($datasheets_view->isdatasheet->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$datasheets->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $datasheets_view->ExportOptions->render("body") ?>
<?php $datasheets_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $datasheets_view->showPageHeader(); ?>
<?php
$datasheets_view->showMessage();
?>
<?php if (!$datasheets_view->IsModal) { ?>
<?php if (!$datasheets->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($datasheets_view->Pager)) $datasheets_view->Pager = new NumericPager($datasheets_view->StartRec, $datasheets_view->DisplayRecs, $datasheets_view->TotalRecs, $datasheets_view->RecRange, $datasheets_view->AutoHidePager) ?>
<?php if ($datasheets_view->Pager->RecordCount > 0 && $datasheets_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($datasheets_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $datasheets_view->pageUrl() ?>start=<?php echo $datasheets_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($datasheets_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $datasheets_view->pageUrl() ?>start=<?php echo $datasheets_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($datasheets_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $datasheets_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($datasheets_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $datasheets_view->pageUrl() ?>start=<?php echo $datasheets_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($datasheets_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $datasheets_view->pageUrl() ?>start=<?php echo $datasheets_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdatasheetsview" id="fdatasheetsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($datasheets_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $datasheets_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="datasheets">
<input type="hidden" name="modal" value="<?php echo (int)$datasheets_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($datasheets->partno->Visible) { // partno ?>
	<tr id="r_partno">
		<td class="<?php echo $datasheets_view->TableLeftColumnClass ?>"><span id="elh_datasheets_partno"><?php echo $datasheets->partno->caption() ?></span></td>
		<td data-name="partno"<?php echo $datasheets->partno->cellAttributes() ?>>
<span id="el_datasheets_partno">
<span<?php echo $datasheets->partno->viewAttributes() ?>>
<?php if ((!EmptyString($datasheets->partno->getViewValue())) && $datasheets->partno->linkAttributes() <> "") { ?>
<a<?php echo $datasheets->partno->linkAttributes() ?>><?php echo $datasheets->partno->getViewValue() ?></a>
<?php } else { ?>
<?php echo $datasheets->partno->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($datasheets->manufacturer->Visible) { // manufacturer ?>
	<tr id="r_manufacturer">
		<td class="<?php echo $datasheets_view->TableLeftColumnClass ?>"><span id="elh_datasheets_manufacturer"><?php echo $datasheets->manufacturer->caption() ?></span></td>
		<td data-name="manufacturer"<?php echo $datasheets->manufacturer->cellAttributes() ?>>
<span id="el_datasheets_manufacturer">
<span<?php echo $datasheets->manufacturer->viewAttributes() ?>>
<?php echo $datasheets->manufacturer->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($datasheets->tittle->Visible) { // tittle ?>
	<tr id="r_tittle">
		<td class="<?php echo $datasheets_view->TableLeftColumnClass ?>"><span id="elh_datasheets_tittle"><?php echo $datasheets->tittle->caption() ?></span></td>
		<td data-name="tittle"<?php echo $datasheets->tittle->cellAttributes() ?>>
<span id="el_datasheets_tittle">
<span<?php echo $datasheets->tittle->viewAttributes() ?>>
<?php echo $datasheets->tittle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($datasheets->cddissue->Visible) { // cddissue ?>
	<tr id="r_cddissue">
		<td class="<?php echo $datasheets_view->TableLeftColumnClass ?>"><span id="elh_datasheets_cddissue"><?php echo $datasheets->cddissue->caption() ?></span></td>
		<td data-name="cddissue"<?php echo $datasheets->cddissue->cellAttributes() ?>>
<span id="el_datasheets_cddissue">
<span<?php echo $datasheets->cddissue->viewAttributes() ?>>
<?php echo $datasheets->cddissue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($datasheets->cddno->Visible) { // cddno ?>
	<tr id="r_cddno">
		<td class="<?php echo $datasheets_view->TableLeftColumnClass ?>"><span id="elh_datasheets_cddno"><?php echo $datasheets->cddno->caption() ?></span></td>
		<td data-name="cddno"<?php echo $datasheets->cddno->cellAttributes() ?>>
<span id="el_datasheets_cddno">
<span<?php echo $datasheets->cddno->viewAttributes() ?>>
<?php if ((!EmptyString($datasheets->cddno->getViewValue())) && $datasheets->cddno->linkAttributes() <> "") { ?>
<a<?php echo $datasheets->cddno->linkAttributes() ?>><?php echo $datasheets->cddno->getViewValue() ?></a>
<?php } else { ?>
<?php echo $datasheets->cddno->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($datasheets->duration->Visible) { // duration ?>
	<tr id="r_duration">
		<td class="<?php echo $datasheets_view->TableLeftColumnClass ?>"><span id="elh_datasheets_duration"><?php echo $datasheets->duration->caption() ?></span></td>
		<td data-name="duration"<?php echo $datasheets->duration->cellAttributes() ?>>
<span id="el_datasheets_duration">
<span<?php echo $datasheets->duration->viewAttributes() ?>>
<?php echo $datasheets->duration->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($datasheets->expirydt->Visible) { // expirydt ?>
	<tr id="r_expirydt">
		<td class="<?php echo $datasheets_view->TableLeftColumnClass ?>"><span id="elh_datasheets_expirydt"><?php echo $datasheets->expirydt->caption() ?></span></td>
		<td data-name="expirydt"<?php echo $datasheets->expirydt->cellAttributes() ?>>
<span id="el_datasheets_expirydt">
<span<?php echo $datasheets->expirydt->viewAttributes() ?>>
<?php echo $datasheets->expirydt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($datasheets->highlighted->Visible) { // highlighted ?>
	<tr id="r_highlighted">
		<td class="<?php echo $datasheets_view->TableLeftColumnClass ?>"><span id="elh_datasheets_highlighted"><?php echo $datasheets->highlighted->caption() ?></span></td>
		<td data-name="highlighted"<?php echo $datasheets->highlighted->cellAttributes() ?>>
<span id="el_datasheets_highlighted">
<span<?php echo $datasheets->highlighted->viewAttributes() ?>>
<?php echo $datasheets->highlighted->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($datasheets->coo->Visible) { // coo ?>
	<tr id="r_coo">
		<td class="<?php echo $datasheets_view->TableLeftColumnClass ?>"><span id="elh_datasheets_coo"><?php echo $datasheets->coo->caption() ?></span></td>
		<td data-name="coo"<?php echo $datasheets->coo->cellAttributes() ?>>
<span id="el_datasheets_coo">
<span<?php echo $datasheets->coo->viewAttributes() ?>>
<?php echo $datasheets->coo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($datasheets->hssCode->Visible) { // hssCode ?>
	<tr id="r_hssCode">
		<td class="<?php echo $datasheets_view->TableLeftColumnClass ?>"><span id="elh_datasheets_hssCode"><?php echo $datasheets->hssCode->caption() ?></span></td>
		<td data-name="hssCode"<?php echo $datasheets->hssCode->cellAttributes() ?>>
<span id="el_datasheets_hssCode">
<span<?php echo $datasheets->hssCode->viewAttributes() ?>>
<?php echo $datasheets->hssCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($datasheets->systrade->Visible) { // systrade ?>
	<tr id="r_systrade">
		<td class="<?php echo $datasheets_view->TableLeftColumnClass ?>"><span id="elh_datasheets_systrade"><?php echo $datasheets->systrade->caption() ?></span></td>
		<td data-name="systrade"<?php echo $datasheets->systrade->cellAttributes() ?>>
<span id="el_datasheets_systrade">
<span<?php echo $datasheets->systrade->viewAttributes() ?>>
<?php echo $datasheets->systrade->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($datasheets->isdatasheet->Visible) { // isdatasheet ?>
	<tr id="r_isdatasheet">
		<td class="<?php echo $datasheets_view->TableLeftColumnClass ?>"><span id="elh_datasheets_isdatasheet"><?php echo $datasheets->isdatasheet->caption() ?></span></td>
		<td data-name="isdatasheet"<?php echo $datasheets->isdatasheet->cellAttributes() ?>>
<span id="el_datasheets_isdatasheet">
<span<?php echo $datasheets->isdatasheet->viewAttributes() ?>>
<?php echo $datasheets->isdatasheet->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($datasheets->nativeFiles->Visible) { // nativeFiles ?>
	<tr id="r_nativeFiles">
		<td class="<?php echo $datasheets_view->TableLeftColumnClass ?>"><span id="elh_datasheets_nativeFiles"><?php echo $datasheets->nativeFiles->caption() ?></span></td>
		<td data-name="nativeFiles"<?php echo $datasheets->nativeFiles->cellAttributes() ?>>
<span id="el_datasheets_nativeFiles">
<span<?php echo $datasheets->nativeFiles->viewAttributes() ?>>
<?php echo $datasheets->nativeFiles->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$datasheets_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$datasheets->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$datasheets_view->terminate();
?>