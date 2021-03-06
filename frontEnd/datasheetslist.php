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
$datasheets_list = new datasheets_list();

// Run the page
$datasheets_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$datasheets_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$datasheets->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fdatasheetslist = currentForm = new ew.Form("fdatasheetslist", "list");
fdatasheetslist.formKeyCountName = '<?php echo $datasheets_list->FormKeyCountName ?>';

// Validate form
fdatasheetslist.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
		<?php if ($datasheets_list->partno->Required) { ?>
			elm = this.getElements("x" + infix + "_partno");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->partno->caption(), $datasheets->partno->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->dataSheetFile->Required) { ?>
			felm = this.getElements("x" + infix + "_dataSheetFile");
			elm = this.getElements("fn_x" + infix + "_dataSheetFile");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $datasheets->dataSheetFile->caption(), $datasheets->dataSheetFile->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->manufacturer->Required) { ?>
			elm = this.getElements("x" + infix + "_manufacturer");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->manufacturer->caption(), $datasheets->manufacturer->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->tittle->Required) { ?>
			elm = this.getElements("x" + infix + "_tittle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->tittle->caption(), $datasheets->tittle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->cddissue->Required) { ?>
			elm = this.getElements("x" + infix + "_cddissue");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->cddissue->caption(), $datasheets->cddissue->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_cddissue");
			if (elm && !ew.checkDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($datasheets->cddissue->errorMessage()) ?>");
		<?php if ($datasheets_list->cddno->Required) { ?>
			elm = this.getElements("x" + infix + "_cddno");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->cddno->caption(), $datasheets->cddno->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->cddFile->Required) { ?>
			felm = this.getElements("x" + infix + "_cddFile");
			elm = this.getElements("fn_x" + infix + "_cddFile");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $datasheets->cddFile->caption(), $datasheets->cddFile->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->thirdPartyNo->Required) { ?>
			elm = this.getElements("x" + infix + "_thirdPartyNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->thirdPartyNo->caption(), $datasheets->thirdPartyNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->thirdPartyFile->Required) { ?>
			felm = this.getElements("x" + infix + "_thirdPartyFile");
			elm = this.getElements("fn_x" + infix + "_thirdPartyFile");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $datasheets->thirdPartyFile->caption(), $datasheets->thirdPartyFile->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->cover->Required) { ?>
			felm = this.getElements("x" + infix + "_cover");
			elm = this.getElements("fn_x" + infix + "_cover");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $datasheets->cover->caption(), $datasheets->cover->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->expirydt->Required) { ?>
			elm = this.getElements("x" + infix + "_expirydt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->expirydt->caption(), $datasheets->expirydt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_expirydt");
			if (elm && !ew.checkDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($datasheets->expirydt->errorMessage()) ?>");
		<?php if ($datasheets_list->coo->Required) { ?>
			elm = this.getElements("x" + infix + "_coo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->coo->caption(), $datasheets->coo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->hssCode->Required) { ?>
			elm = this.getElements("x" + infix + "_hssCode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->hssCode->caption(), $datasheets->hssCode->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->systrade->Required) { ?>
			elm = this.getElements("x" + infix + "_systrade");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->systrade->caption(), $datasheets->systrade->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->isdatasheet->Required) { ?>
			elm = this.getElements("x" + infix + "_isdatasheet");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->isdatasheet->caption(), $datasheets->isdatasheet->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->cddrenewal_required->Required) { ?>
			elm = this.getElements("x" + infix + "_cddrenewal_required");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->cddrenewal_required->caption(), $datasheets->cddrenewal_required->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_list->nativeFiles->Required) { ?>
			elm = this.getElements("x" + infix + "_nativeFiles");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->nativeFiles->caption(), $datasheets->nativeFiles->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	if (gridinsert && addcnt == 0) { // No row added
		ew.alert(ew.language.phrase("NoAddRecord"));
		return false;
	}
	return true;
}

// Check empty row
fdatasheetslist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "partno", false)) return false;
	if (ew.valueChanged(fobj, infix, "dataSheetFile", false)) return false;
	if (ew.valueChanged(fobj, infix, "manufacturer", false)) return false;
	if (ew.valueChanged(fobj, infix, "tittle", false)) return false;
	if (ew.valueChanged(fobj, infix, "cddissue", false)) return false;
	if (ew.valueChanged(fobj, infix, "cddno", false)) return false;
	if (ew.valueChanged(fobj, infix, "cddFile", false)) return false;
	if (ew.valueChanged(fobj, infix, "thirdPartyNo", false)) return false;
	if (ew.valueChanged(fobj, infix, "thirdPartyFile", false)) return false;
	if (ew.valueChanged(fobj, infix, "cover", false)) return false;
	if (ew.valueChanged(fobj, infix, "expirydt", false)) return false;
	if (ew.valueChanged(fobj, infix, "coo", false)) return false;
	if (ew.valueChanged(fobj, infix, "hssCode", false)) return false;
	if (ew.valueChanged(fobj, infix, "systrade", false)) return false;
	if (ew.valueChanged(fobj, infix, "isdatasheet", true)) return false;
	if (ew.valueChanged(fobj, infix, "cddrenewal_required", true)) return false;
	if (ew.valueChanged(fobj, infix, "nativeFiles", false)) return false;
	return true;
}

// Form_CustomValidate event
fdatasheetslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdatasheetslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdatasheetslist.lists["x_manufacturer"] = <?php echo $datasheets_list->manufacturer->Lookup->toClientList() ?>;
fdatasheetslist.lists["x_manufacturer"].options = <?php echo JsonEncode($datasheets_list->manufacturer->lookupOptions()) ?>;
fdatasheetslist.autoSuggests["x_manufacturer"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdatasheetslist.lists["x_coo"] = <?php echo $datasheets_list->coo->Lookup->toClientList() ?>;
fdatasheetslist.lists["x_coo"].options = <?php echo JsonEncode($datasheets_list->coo->lookupOptions()) ?>;
fdatasheetslist.autoSuggests["x_coo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdatasheetslist.lists["x_systrade"] = <?php echo $datasheets_list->systrade->Lookup->toClientList() ?>;
fdatasheetslist.lists["x_systrade"].options = <?php echo JsonEncode($datasheets_list->systrade->options(FALSE, TRUE)) ?>;
fdatasheetslist.lists["x_isdatasheet"] = <?php echo $datasheets_list->isdatasheet->Lookup->toClientList() ?>;
fdatasheetslist.lists["x_isdatasheet"].options = <?php echo JsonEncode($datasheets_list->isdatasheet->options(FALSE, TRUE)) ?>;
fdatasheetslist.lists["x_cddrenewal_required"] = <?php echo $datasheets_list->cddrenewal_required->Lookup->toClientList() ?>;
fdatasheetslist.lists["x_cddrenewal_required"].options = <?php echo JsonEncode($datasheets_list->cddrenewal_required->options(FALSE, TRUE)) ?>;

// Form object for search
var fdatasheetslistsrch = currentSearchForm = new ew.Form("fdatasheetslistsrch");

// Validate function for search
fdatasheetslistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_expirydt");
	if (elm && !ew.checkDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($datasheets->expirydt->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fdatasheetslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdatasheetslistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Filters

fdatasheetslistsrch.filterList = <?php echo $datasheets_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$datasheets->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($datasheets_list->TotalRecs > 0 && $datasheets_list->ExportOptions->visible()) { ?>
<?php $datasheets_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($datasheets_list->ImportOptions->visible()) { ?>
<?php $datasheets_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($datasheets_list->SearchOptions->visible()) { ?>
<?php $datasheets_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($datasheets_list->FilterOptions->visible()) { ?>
<?php $datasheets_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$datasheets_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$datasheets->isExport() && !$datasheets->CurrentAction) { ?>
<form name="fdatasheetslistsrch" id="fdatasheetslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($datasheets_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fdatasheetslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="datasheets">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$datasheets_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$datasheets->RowType = ROWTYPE_SEARCH;

// Render row
$datasheets->resetAttributes();
$datasheets_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($datasheets->partno->Visible) { // partno ?>
	<div id="xsc_partno" class="ew-cell form-group">
		<label for="x_partno" class="ew-search-caption ew-label"><?php echo $datasheets->partno->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_partno" id="z_partno" value="="></span>
		<span class="ew-search-field">
<input type="text" data-table="datasheets" data-field="x_partno" name="x_partno" id="x_partno" size="30" placeholder="<?php echo HtmlEncode($datasheets->partno->getPlaceHolder()) ?>" value="<?php echo $datasheets->partno->EditValue ?>"<?php echo $datasheets->partno->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
<?php if ($datasheets->tittle->Visible) { // tittle ?>
	<div id="xsc_tittle" class="ew-cell form-group">
		<label for="x_tittle" class="ew-search-caption ew-label"><?php echo $datasheets->tittle->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_tittle" id="z_tittle" value="LIKE"></span>
		<span class="ew-search-field">
<input type="text" data-table="datasheets" data-field="x_tittle" name="x_tittle" id="x_tittle" placeholder="<?php echo HtmlEncode($datasheets->tittle->getPlaceHolder()) ?>" value="<?php echo $datasheets->tittle->EditValue ?>"<?php echo $datasheets->tittle->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ew-row d-sm-flex">
<?php if ($datasheets->expirydt->Visible) { // expirydt ?>
	<div id="xsc_expirydt" class="ew-cell form-group">
		<label for="x_expirydt" class="ew-search-caption ew-label"><?php echo $datasheets->expirydt->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase(">=") ?><input type="hidden" name="z_expirydt" id="z_expirydt" value=">="></span>
		<span class="ew-search-field">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-format="5" name="x_expirydt" id="x_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetslistsrch", "x_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
		<span class="ew-search-cond btw0_expirydt"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="v_expirydt_1" name="v_expirydt" value="AND"<?php if ($datasheets->expirydt->AdvancedSearch->SearchCondition <> "OR") echo " checked" ?>><label class="form-check-label" for="v_expirydt_1"><?php echo $Language->phrase("AND") ?></label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="v_expirydt_2" name="v_expirydt" value="OR"<?php if ($datasheets->expirydt->AdvancedSearch->SearchCondition == "OR") echo " checked" ?>><label class="form-check-label" for="v_expirydt_2"><?php echo $Language->phrase("OR") ?></label></div></span>
		<span class="ew-search-operator btw0_expirydt"><?php echo $Language->phrase("<=") ?><input type="hidden" name="w_expirydt" id="w_expirydt" value="<="></span>
		<span class="ew-search-field">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-format="5" name="y_expirydt" id="y_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue2 ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetslistsrch", "y_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_4" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($datasheets_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($datasheets_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $datasheets_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($datasheets_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($datasheets_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($datasheets_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($datasheets_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $datasheets_list->showPageHeader(); ?>
<?php
$datasheets_list->showMessage();
?>
<?php if ($datasheets_list->TotalRecs > 0 || $datasheets->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($datasheets_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> datasheets">
<?php if (!$datasheets->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$datasheets->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($datasheets_list->Pager)) $datasheets_list->Pager = new NumericPager($datasheets_list->StartRec, $datasheets_list->DisplayRecs, $datasheets_list->TotalRecs, $datasheets_list->RecRange, $datasheets_list->AutoHidePager) ?>
<?php if ($datasheets_list->Pager->RecordCount > 0 && $datasheets_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($datasheets_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $datasheets_list->pageUrl() ?>start=<?php echo $datasheets_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($datasheets_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $datasheets_list->pageUrl() ?>start=<?php echo $datasheets_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($datasheets_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $datasheets_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($datasheets_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $datasheets_list->pageUrl() ?>start=<?php echo $datasheets_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($datasheets_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $datasheets_list->pageUrl() ?>start=<?php echo $datasheets_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($datasheets_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $datasheets_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $datasheets_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $datasheets_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $datasheets_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdatasheetslist" id="fdatasheetslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($datasheets_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $datasheets_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="datasheets">
<div id="gmp_datasheets" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($datasheets_list->TotalRecs > 0 || $datasheets->isAdd() || $datasheets->isCopy() || $datasheets->isGridEdit()) { ?>
<table id="tbl_datasheetslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$datasheets_list->RowType = ROWTYPE_HEADER;

// Render list options
$datasheets_list->renderListOptions();

// Render list options (header, left)
$datasheets_list->ListOptions->render("header", "left");
?>
<?php if ($datasheets->partno->Visible) { // partno ?>
	<?php if ($datasheets->sortUrl($datasheets->partno) == "") { ?>
		<th data-name="partno" class="<?php echo $datasheets->partno->headerCellClass() ?>" style="width: 10px;"><div id="elh_datasheets_partno" class="datasheets_partno"><div class="ew-table-header-caption"><?php echo $datasheets->partno->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="partno" class="<?php echo $datasheets->partno->headerCellClass() ?>" style="width: 10px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->partno) ?>',2);"><div id="elh_datasheets_partno" class="datasheets_partno">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->partno->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($datasheets->partno->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->partno->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->dataSheetFile->Visible) { // dataSheetFile ?>
	<?php if ($datasheets->sortUrl($datasheets->dataSheetFile) == "") { ?>
		<th data-name="dataSheetFile" class="<?php echo $datasheets->dataSheetFile->headerCellClass() ?>" style="width: 1px;"><div id="elh_datasheets_dataSheetFile" class="datasheets_dataSheetFile"><div class="ew-table-header-caption"><?php echo $datasheets->dataSheetFile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dataSheetFile" class="<?php echo $datasheets->dataSheetFile->headerCellClass() ?>" style="width: 1px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->dataSheetFile) ?>',2);"><div id="elh_datasheets_dataSheetFile" class="datasheets_dataSheetFile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->dataSheetFile->caption() ?></span><span class="ew-table-header-sort"><?php if ($datasheets->dataSheetFile->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->dataSheetFile->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->manufacturer->Visible) { // manufacturer ?>
	<?php if ($datasheets->sortUrl($datasheets->manufacturer) == "") { ?>
		<th data-name="manufacturer" class="<?php echo $datasheets->manufacturer->headerCellClass() ?>" style="width: 10px;"><div id="elh_datasheets_manufacturer" class="datasheets_manufacturer"><div class="ew-table-header-caption"><?php echo $datasheets->manufacturer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="manufacturer" class="<?php echo $datasheets->manufacturer->headerCellClass() ?>" style="width: 10px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->manufacturer) ?>',2);"><div id="elh_datasheets_manufacturer" class="datasheets_manufacturer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->manufacturer->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($datasheets->manufacturer->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->manufacturer->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->tittle->Visible) { // tittle ?>
	<?php if ($datasheets->sortUrl($datasheets->tittle) == "") { ?>
		<th data-name="tittle" class="<?php echo $datasheets->tittle->headerCellClass() ?>"><div id="elh_datasheets_tittle" class="datasheets_tittle"><div class="ew-table-header-caption"><?php echo $datasheets->tittle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tittle" class="<?php echo $datasheets->tittle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->tittle) ?>',2);"><div id="elh_datasheets_tittle" class="datasheets_tittle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->tittle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($datasheets->tittle->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->tittle->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->cddissue->Visible) { // cddissue ?>
	<?php if ($datasheets->sortUrl($datasheets->cddissue) == "") { ?>
		<th data-name="cddissue" class="<?php echo $datasheets->cddissue->headerCellClass() ?>" style="width: 10px;"><div id="elh_datasheets_cddissue" class="datasheets_cddissue"><div class="ew-table-header-caption"><?php echo $datasheets->cddissue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cddissue" class="<?php echo $datasheets->cddissue->headerCellClass() ?>" style="width: 10px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->cddissue) ?>',2);"><div id="elh_datasheets_cddissue" class="datasheets_cddissue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->cddissue->caption() ?></span><span class="ew-table-header-sort"><?php if ($datasheets->cddissue->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->cddissue->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->cddno->Visible) { // cddno ?>
	<?php if ($datasheets->sortUrl($datasheets->cddno) == "") { ?>
		<th data-name="cddno" class="<?php echo $datasheets->cddno->headerCellClass() ?>" style="width: 10px;"><div id="elh_datasheets_cddno" class="datasheets_cddno"><div class="ew-table-header-caption"><?php echo $datasheets->cddno->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cddno" class="<?php echo $datasheets->cddno->headerCellClass() ?>" style="width: 10px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->cddno) ?>',2);"><div id="elh_datasheets_cddno" class="datasheets_cddno">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->cddno->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($datasheets->cddno->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->cddno->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->cddFile->Visible) { // cddFile ?>
	<?php if ($datasheets->sortUrl($datasheets->cddFile) == "") { ?>
		<th data-name="cddFile" class="<?php echo $datasheets->cddFile->headerCellClass() ?>" style="width: 1px;"><div id="elh_datasheets_cddFile" class="datasheets_cddFile"><div class="ew-table-header-caption"><?php echo $datasheets->cddFile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cddFile" class="<?php echo $datasheets->cddFile->headerCellClass() ?>" style="width: 1px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->cddFile) ?>',2);"><div id="elh_datasheets_cddFile" class="datasheets_cddFile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->cddFile->caption() ?></span><span class="ew-table-header-sort"><?php if ($datasheets->cddFile->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->cddFile->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->thirdPartyNo->Visible) { // thirdPartyNo ?>
	<?php if ($datasheets->sortUrl($datasheets->thirdPartyNo) == "") { ?>
		<th data-name="thirdPartyNo" class="<?php echo $datasheets->thirdPartyNo->headerCellClass() ?>" style="width: 5px;"><div id="elh_datasheets_thirdPartyNo" class="datasheets_thirdPartyNo"><div class="ew-table-header-caption"><?php echo $datasheets->thirdPartyNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thirdPartyNo" class="<?php echo $datasheets->thirdPartyNo->headerCellClass() ?>" style="width: 5px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->thirdPartyNo) ?>',2);"><div id="elh_datasheets_thirdPartyNo" class="datasheets_thirdPartyNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->thirdPartyNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($datasheets->thirdPartyNo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->thirdPartyNo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->thirdPartyFile->Visible) { // thirdPartyFile ?>
	<?php if ($datasheets->sortUrl($datasheets->thirdPartyFile) == "") { ?>
		<th data-name="thirdPartyFile" class="<?php echo $datasheets->thirdPartyFile->headerCellClass() ?>" style="width: 1px;"><div id="elh_datasheets_thirdPartyFile" class="datasheets_thirdPartyFile"><div class="ew-table-header-caption"><?php echo $datasheets->thirdPartyFile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thirdPartyFile" class="<?php echo $datasheets->thirdPartyFile->headerCellClass() ?>" style="width: 1px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->thirdPartyFile) ?>',2);"><div id="elh_datasheets_thirdPartyFile" class="datasheets_thirdPartyFile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->thirdPartyFile->caption() ?></span><span class="ew-table-header-sort"><?php if ($datasheets->thirdPartyFile->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->thirdPartyFile->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->cover->Visible) { // cover ?>
	<?php if ($datasheets->sortUrl($datasheets->cover) == "") { ?>
		<th data-name="cover" class="<?php echo $datasheets->cover->headerCellClass() ?>" style="width: 1px;"><div id="elh_datasheets_cover" class="datasheets_cover"><div class="ew-table-header-caption"><?php echo $datasheets->cover->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cover" class="<?php echo $datasheets->cover->headerCellClass() ?>" style="width: 1px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->cover) ?>',2);"><div id="elh_datasheets_cover" class="datasheets_cover">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->cover->caption() ?></span><span class="ew-table-header-sort"><?php if ($datasheets->cover->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->cover->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->expirydt->Visible) { // expirydt ?>
	<?php if ($datasheets->sortUrl($datasheets->expirydt) == "") { ?>
		<th data-name="expirydt" class="<?php echo $datasheets->expirydt->headerCellClass() ?>" style="width: 10px;"><div id="elh_datasheets_expirydt" class="datasheets_expirydt"><div class="ew-table-header-caption"><?php echo $datasheets->expirydt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="expirydt" class="<?php echo $datasheets->expirydt->headerCellClass() ?>" style="width: 10px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->expirydt) ?>',2);"><div id="elh_datasheets_expirydt" class="datasheets_expirydt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->expirydt->caption() ?></span><span class="ew-table-header-sort"><?php if ($datasheets->expirydt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->expirydt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->coo->Visible) { // coo ?>
	<?php if ($datasheets->sortUrl($datasheets->coo) == "") { ?>
		<th data-name="coo" class="<?php echo $datasheets->coo->headerCellClass() ?>" style="width: 10px;"><div id="elh_datasheets_coo" class="datasheets_coo"><div class="ew-table-header-caption"><?php echo $datasheets->coo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="coo" class="<?php echo $datasheets->coo->headerCellClass() ?>" style="width: 10px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->coo) ?>',2);"><div id="elh_datasheets_coo" class="datasheets_coo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->coo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($datasheets->coo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->coo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->hssCode->Visible) { // hssCode ?>
	<?php if ($datasheets->sortUrl($datasheets->hssCode) == "") { ?>
		<th data-name="hssCode" class="<?php echo $datasheets->hssCode->headerCellClass() ?>" style="width: 10px;"><div id="elh_datasheets_hssCode" class="datasheets_hssCode"><div class="ew-table-header-caption"><?php echo $datasheets->hssCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hssCode" class="<?php echo $datasheets->hssCode->headerCellClass() ?>" style="width: 10px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->hssCode) ?>',2);"><div id="elh_datasheets_hssCode" class="datasheets_hssCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->hssCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($datasheets->hssCode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->hssCode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->systrade->Visible) { // systrade ?>
	<?php if ($datasheets->sortUrl($datasheets->systrade) == "") { ?>
		<th data-name="systrade" class="<?php echo $datasheets->systrade->headerCellClass() ?>" style="width: 10px;"><div id="elh_datasheets_systrade" class="datasheets_systrade"><div class="ew-table-header-caption"><?php echo $datasheets->systrade->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="systrade" class="<?php echo $datasheets->systrade->headerCellClass() ?>" style="width: 10px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->systrade) ?>',2);"><div id="elh_datasheets_systrade" class="datasheets_systrade">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->systrade->caption() ?></span><span class="ew-table-header-sort"><?php if ($datasheets->systrade->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->systrade->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->isdatasheet->Visible) { // isdatasheet ?>
	<?php if ($datasheets->sortUrl($datasheets->isdatasheet) == "") { ?>
		<th data-name="isdatasheet" class="<?php echo $datasheets->isdatasheet->headerCellClass() ?>" style="width: 10px;"><div id="elh_datasheets_isdatasheet" class="datasheets_isdatasheet"><div class="ew-table-header-caption"><?php echo $datasheets->isdatasheet->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="isdatasheet" class="<?php echo $datasheets->isdatasheet->headerCellClass() ?>" style="width: 10px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->isdatasheet) ?>',2);"><div id="elh_datasheets_isdatasheet" class="datasheets_isdatasheet">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->isdatasheet->caption() ?></span><span class="ew-table-header-sort"><?php if ($datasheets->isdatasheet->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->isdatasheet->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->cddrenewal_required->Visible) { // cddrenewal_required ?>
	<?php if ($datasheets->sortUrl($datasheets->cddrenewal_required) == "") { ?>
		<th data-name="cddrenewal_required" class="<?php echo $datasheets->cddrenewal_required->headerCellClass() ?>" style="width: 10px;"><div id="elh_datasheets_cddrenewal_required" class="datasheets_cddrenewal_required"><div class="ew-table-header-caption"><?php echo $datasheets->cddrenewal_required->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cddrenewal_required" class="<?php echo $datasheets->cddrenewal_required->headerCellClass() ?>" style="width: 10px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->cddrenewal_required) ?>',2);"><div id="elh_datasheets_cddrenewal_required" class="datasheets_cddrenewal_required">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->cddrenewal_required->caption() ?></span><span class="ew-table-header-sort"><?php if ($datasheets->cddrenewal_required->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->cddrenewal_required->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($datasheets->nativeFiles->Visible) { // nativeFiles ?>
	<?php if ($datasheets->sortUrl($datasheets->nativeFiles) == "") { ?>
		<th data-name="nativeFiles" class="<?php echo $datasheets->nativeFiles->headerCellClass() ?>" style="width: 1px;"><div id="elh_datasheets_nativeFiles" class="datasheets_nativeFiles"><div class="ew-table-header-caption"><?php echo $datasheets->nativeFiles->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nativeFiles" class="<?php echo $datasheets->nativeFiles->headerCellClass() ?>" style="width: 1px;"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $datasheets->SortUrl($datasheets->nativeFiles) ?>',2);"><div id="elh_datasheets_nativeFiles" class="datasheets_nativeFiles">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $datasheets->nativeFiles->caption() ?></span><span class="ew-table-header-sort"><?php if ($datasheets->nativeFiles->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($datasheets->nativeFiles->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$datasheets_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($datasheets->isAdd() || $datasheets->isCopy()) {
		$datasheets_list->RowIndex = 0;
		$datasheets_list->KeyCount = $datasheets_list->RowIndex;
		if ($datasheets->isCopy() && !$datasheets_list->loadRow())
			$datasheets->CurrentAction = "add";
		if ($datasheets->isAdd())
			$datasheets_list->loadRowValues();
		if ($datasheets->EventCancelled) // Insert failed
			$datasheets_list->restoreFormValues(); // Restore form values

		// Set row properties
		$datasheets->resetAttributes();
		$datasheets->RowAttrs = array_merge($datasheets->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_datasheets', 'data-rowtype'=>ROWTYPE_ADD));
		$datasheets->RowType = ROWTYPE_ADD;

		// Render row
		$datasheets_list->renderRow();

		// Render list options
		$datasheets_list->renderListOptions();
		$datasheets_list->StartRowCnt = 0;
?>
	<tr<?php echo $datasheets->rowAttributes() ?>>
<?php

// Render list options (body, left)
$datasheets_list->ListOptions->render("body", "left", $datasheets_list->RowCnt);
?>
	<?php if ($datasheets->partno->Visible) { // partno ?>
		<td data-name="partno">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_partno" class="form-group datasheets_partno">
<input type="text" data-table="datasheets" data-field="x_partno" name="x<?php echo $datasheets_list->RowIndex ?>_partno" id="x<?php echo $datasheets_list->RowIndex ?>_partno" size="30" placeholder="<?php echo HtmlEncode($datasheets->partno->getPlaceHolder()) ?>" value="<?php echo $datasheets->partno->EditValue ?>"<?php echo $datasheets->partno->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_partno" name="o<?php echo $datasheets_list->RowIndex ?>_partno" id="o<?php echo $datasheets_list->RowIndex ?>_partno" value="<?php echo HtmlEncode($datasheets->partno->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->dataSheetFile->Visible) { // dataSheetFile ?>
		<td data-name="dataSheetFile">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_dataSheetFile" class="form-group datasheets_dataSheetFile">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile">
<span title="<?php echo $datasheets->dataSheetFile->title() ? $datasheets->dataSheetFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->dataSheetFile->ReadOnly || $datasheets->dataSheetFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_dataSheetFile" name="x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id="x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile"<?php echo $datasheets->dataSheetFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="0">
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="datasheets" data-field="x_dataSheetFile" name="o<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id="o<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo HtmlEncode($datasheets->dataSheetFile->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->manufacturer->Visible) { // manufacturer ?>
		<td data-name="manufacturer">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_manufacturer" class="form-group datasheets_manufacturer">
<?php
$wrkonchange = "" . trim(@$datasheets->manufacturer->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->manufacturer->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" class="text-nowrap" style="z-index: <?php echo (9000 - $datasheets_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" id="sv_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" value="<?php echo RemoveHtml($datasheets->manufacturer->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->manufacturer->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->manufacturer->getPlaceHolder()) ?>"<?php echo $datasheets->manufacturer->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($datasheets->manufacturer->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $datasheets_list->RowIndex ?>_manufacturer',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($datasheets->manufacturer->ReadOnly || $datasheets->manufacturer->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "manufacturer") && !$datasheets->manufacturer->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $datasheets->manufacturer->caption() ?>" data-title="<?php echo $datasheets->manufacturer->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $datasheets_list->RowIndex ?>_manufacturer',url:'manufactureraddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $datasheets->manufacturer->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_manufacturer" id="x<?php echo $datasheets_list->RowIndex ?>_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetslist.createAutoSuggest({"id":"x<?php echo $datasheets_list->RowIndex ?>_manufacturer","forceSelect":true});
</script>
<?php echo $datasheets->manufacturer->Lookup->getParamTag("p_x" . $datasheets_list->RowIndex . "_manufacturer") ?>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" name="o<?php echo $datasheets_list->RowIndex ?>_manufacturer" id="o<?php echo $datasheets_list->RowIndex ?>_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->tittle->Visible) { // tittle ?>
		<td data-name="tittle">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_tittle" class="form-group datasheets_tittle">
<textarea data-table="datasheets" data-field="x_tittle" name="x<?php echo $datasheets_list->RowIndex ?>_tittle" id="x<?php echo $datasheets_list->RowIndex ?>_tittle" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->tittle->getPlaceHolder()) ?>"<?php echo $datasheets->tittle->editAttributes() ?>><?php echo $datasheets->tittle->EditValue ?></textarea>
</span>
<input type="hidden" data-table="datasheets" data-field="x_tittle" name="o<?php echo $datasheets_list->RowIndex ?>_tittle" id="o<?php echo $datasheets_list->RowIndex ?>_tittle" value="<?php echo HtmlEncode($datasheets->tittle->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->cddissue->Visible) { // cddissue ?>
		<td data-name="cddissue">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddissue" class="form-group datasheets_cddissue">
<input type="text" data-table="datasheets" data-field="x_cddissue" data-format="5" name="x<?php echo $datasheets_list->RowIndex ?>_cddissue" id="x<?php echo $datasheets_list->RowIndex ?>_cddissue" placeholder="<?php echo HtmlEncode($datasheets->cddissue->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddissue->EditValue ?>"<?php echo $datasheets->cddissue->editAttributes() ?>>
<?php if (!$datasheets->cddissue->ReadOnly && !$datasheets->cddissue->Disabled && !isset($datasheets->cddissue->EditAttrs["readonly"]) && !isset($datasheets->cddissue->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetslist", "x<?php echo $datasheets_list->RowIndex ?>_cddissue", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddissue" name="o<?php echo $datasheets_list->RowIndex ?>_cddissue" id="o<?php echo $datasheets_list->RowIndex ?>_cddissue" value="<?php echo HtmlEncode($datasheets->cddissue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->cddno->Visible) { // cddno ?>
		<td data-name="cddno">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddno" class="form-group datasheets_cddno">
<input type="text" data-table="datasheets" data-field="x_cddno" name="x<?php echo $datasheets_list->RowIndex ?>_cddno" id="x<?php echo $datasheets_list->RowIndex ?>_cddno" size="30" placeholder="<?php echo HtmlEncode($datasheets->cddno->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddno->EditValue ?>"<?php echo $datasheets->cddno->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddno" name="o<?php echo $datasheets_list->RowIndex ?>_cddno" id="o<?php echo $datasheets_list->RowIndex ?>_cddno" value="<?php echo HtmlEncode($datasheets->cddno->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->cddFile->Visible) { // cddFile ?>
		<td data-name="cddFile">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddFile" class="form-group datasheets_cddFile">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_cddFile">
<span title="<?php echo $datasheets->cddFile->title() ? $datasheets->cddFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cddFile->ReadOnly || $datasheets->cddFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cddFile" name="x<?php echo $datasheets_list->RowIndex ?>_cddFile" id="x<?php echo $datasheets_list->RowIndex ?>_cddFile"<?php echo $datasheets->cddFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo $datasheets->cddFile->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="0">
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo $datasheets->cddFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo $datasheets->cddFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_cddFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddFile" name="o<?php echo $datasheets_list->RowIndex ?>_cddFile" id="o<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo HtmlEncode($datasheets->cddFile->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->thirdPartyNo->Visible) { // thirdPartyNo ?>
		<td data-name="thirdPartyNo">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_thirdPartyNo" class="form-group datasheets_thirdPartyNo">
<input type="text" data-table="datasheets" data-field="x_thirdPartyNo" name="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" id="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" size="30" placeholder="<?php echo HtmlEncode($datasheets->thirdPartyNo->getPlaceHolder()) ?>" value="<?php echo $datasheets->thirdPartyNo->EditValue ?>"<?php echo $datasheets->thirdPartyNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_thirdPartyNo" name="o<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" id="o<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" value="<?php echo HtmlEncode($datasheets->thirdPartyNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->thirdPartyFile->Visible) { // thirdPartyFile ?>
		<td data-name="thirdPartyFile">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_thirdPartyFile" class="form-group datasheets_thirdPartyFile">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile">
<span title="<?php echo $datasheets->thirdPartyFile->title() ? $datasheets->thirdPartyFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->thirdPartyFile->ReadOnly || $datasheets->thirdPartyFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_thirdPartyFile" name="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile"<?php echo $datasheets->thirdPartyFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="0">
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="datasheets" data-field="x_thirdPartyFile" name="o<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id="o<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo HtmlEncode($datasheets->thirdPartyFile->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->cover->Visible) { // cover ?>
		<td data-name="cover">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cover" class="form-group datasheets_cover">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_cover">
<span title="<?php echo $datasheets->cover->title() ? $datasheets->cover->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cover->ReadOnly || $datasheets->cover->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cover" name="x<?php echo $datasheets_list->RowIndex ?>_cover" id="x<?php echo $datasheets_list->RowIndex ?>_cover"<?php echo $datasheets->cover->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo $datasheets->cover->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_cover" value="0">
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_cover" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo $datasheets->cover->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo $datasheets->cover->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_cover" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cover" name="o<?php echo $datasheets_list->RowIndex ?>_cover" id="o<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo HtmlEncode($datasheets->cover->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->expirydt->Visible) { // expirydt ?>
		<td data-name="expirydt">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_expirydt" class="form-group datasheets_expirydt">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-format="5" name="x<?php echo $datasheets_list->RowIndex ?>_expirydt" id="x<?php echo $datasheets_list->RowIndex ?>_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetslist", "x<?php echo $datasheets_list->RowIndex ?>_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="datasheets" data-field="x_expirydt" name="o<?php echo $datasheets_list->RowIndex ?>_expirydt" id="o<?php echo $datasheets_list->RowIndex ?>_expirydt" value="<?php echo HtmlEncode($datasheets->expirydt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->coo->Visible) { // coo ?>
		<td data-name="coo">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_coo" class="form-group datasheets_coo">
<?php
$wrkonchange = "" . trim(@$datasheets->coo->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->coo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $datasheets_list->RowIndex ?>_coo" class="text-nowrap" style="z-index: <?php echo (9000 - $datasheets_list->RowCnt * 10) ?>">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $datasheets_list->RowIndex ?>_coo" id="sv_x<?php echo $datasheets_list->RowIndex ?>_coo" value="<?php echo RemoveHtml($datasheets->coo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>"<?php echo $datasheets->coo->editAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "countryOfOrigin") && !$datasheets->coo->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $datasheets_list->RowIndex ?>_coo" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $datasheets->coo->caption() ?>" data-title="<?php echo $datasheets->coo->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $datasheets_list->RowIndex ?>_coo',url:'countryOfOriginaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_coo" data-value-separator="<?php echo $datasheets->coo->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_coo" id="x<?php echo $datasheets_list->RowIndex ?>_coo" value="<?php echo HtmlEncode($datasheets->coo->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetslist.createAutoSuggest({"id":"x<?php echo $datasheets_list->RowIndex ?>_coo","forceSelect":false});
</script>
<?php echo $datasheets->coo->Lookup->getParamTag("p_x" . $datasheets_list->RowIndex . "_coo") ?>
</span>
<input type="hidden" data-table="datasheets" data-field="x_coo" name="o<?php echo $datasheets_list->RowIndex ?>_coo" id="o<?php echo $datasheets_list->RowIndex ?>_coo" value="<?php echo HtmlEncode($datasheets->coo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->hssCode->Visible) { // hssCode ?>
		<td data-name="hssCode">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_hssCode" class="form-group datasheets_hssCode">
<input type="text" data-table="datasheets" data-field="x_hssCode" name="x<?php echo $datasheets_list->RowIndex ?>_hssCode" id="x<?php echo $datasheets_list->RowIndex ?>_hssCode" size="30" placeholder="<?php echo HtmlEncode($datasheets->hssCode->getPlaceHolder()) ?>" value="<?php echo $datasheets->hssCode->EditValue ?>"<?php echo $datasheets->hssCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_hssCode" name="o<?php echo $datasheets_list->RowIndex ?>_hssCode" id="o<?php echo $datasheets_list->RowIndex ?>_hssCode" value="<?php echo HtmlEncode($datasheets->hssCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->systrade->Visible) { // systrade ?>
		<td data-name="systrade">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_systrade" class="form-group datasheets_systrade">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="datasheets" data-field="x_systrade" data-value-separator="<?php echo $datasheets->systrade->displayValueSeparatorAttribute() ?>" id="x<?php echo $datasheets_list->RowIndex ?>_systrade" name="x<?php echo $datasheets_list->RowIndex ?>_systrade"<?php echo $datasheets->systrade->editAttributes() ?>>
		<?php echo $datasheets->systrade->selectOptionListHtml("x<?php echo $datasheets_list->RowIndex ?>_systrade") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_systrade" name="o<?php echo $datasheets_list->RowIndex ?>_systrade" id="o<?php echo $datasheets_list->RowIndex ?>_systrade" value="<?php echo HtmlEncode($datasheets->systrade->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->isdatasheet->Visible) { // isdatasheet ?>
		<td data-name="isdatasheet">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_isdatasheet" class="form-group datasheets_isdatasheet">
<div id="tp_x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_isdatasheet" data-value-separator="<?php echo $datasheets->isdatasheet->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" id="x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" value="{value}"<?php echo $datasheets->isdatasheet->editAttributes() ?>></div>
<div id="dsl_x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->isdatasheet->radioButtonListHtml(FALSE, "x{$datasheets_list->RowIndex}_isdatasheet") ?>
</div></div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_isdatasheet" name="o<?php echo $datasheets_list->RowIndex ?>_isdatasheet" id="o<?php echo $datasheets_list->RowIndex ?>_isdatasheet" value="<?php echo HtmlEncode($datasheets->isdatasheet->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->cddrenewal_required->Visible) { // cddrenewal_required ?>
		<td data-name="cddrenewal_required">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddrenewal_required" class="form-group datasheets_cddrenewal_required">
<div id="tp_x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_cddrenewal_required" data-value-separator="<?php echo $datasheets->cddrenewal_required->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" id="x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" value="{value}"<?php echo $datasheets->cddrenewal_required->editAttributes() ?>></div>
<div id="dsl_x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->cddrenewal_required->radioButtonListHtml(FALSE, "x{$datasheets_list->RowIndex}_cddrenewal_required") ?>
</div></div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddrenewal_required" name="o<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" id="o<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" value="<?php echo HtmlEncode($datasheets->cddrenewal_required->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->nativeFiles->Visible) { // nativeFiles ?>
		<td data-name="nativeFiles">
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_nativeFiles" class="form-group datasheets_nativeFiles">
<textarea data-table="datasheets" data-field="x_nativeFiles" name="x<?php echo $datasheets_list->RowIndex ?>_nativeFiles" id="x<?php echo $datasheets_list->RowIndex ?>_nativeFiles" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->nativeFiles->getPlaceHolder()) ?>"<?php echo $datasheets->nativeFiles->editAttributes() ?>><?php echo $datasheets->nativeFiles->EditValue ?></textarea>
</span>
<input type="hidden" data-table="datasheets" data-field="x_nativeFiles" name="o<?php echo $datasheets_list->RowIndex ?>_nativeFiles" id="o<?php echo $datasheets_list->RowIndex ?>_nativeFiles" value="<?php echo HtmlEncode($datasheets->nativeFiles->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$datasheets_list->ListOptions->render("body", "right", $datasheets_list->RowCnt);
?>
<script>
fdatasheetslist.updateLists(<?php echo $datasheets_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($datasheets->ExportAll && $datasheets->isExport()) {
	$datasheets_list->StopRec = $datasheets_list->TotalRecs;
} else {

	// Set the last record to display
	if ($datasheets_list->TotalRecs > $datasheets_list->StartRec + $datasheets_list->DisplayRecs - 1)
		$datasheets_list->StopRec = $datasheets_list->StartRec + $datasheets_list->DisplayRecs - 1;
	else
		$datasheets_list->StopRec = $datasheets_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $datasheets_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($datasheets_list->FormKeyCountName) && ($datasheets->isGridAdd() || $datasheets->isGridEdit() || $datasheets->isConfirm())) {
		$datasheets_list->KeyCount = $CurrentForm->getValue($datasheets_list->FormKeyCountName);
		$datasheets_list->StopRec = $datasheets_list->StartRec + $datasheets_list->KeyCount - 1;
	}
}
$datasheets_list->RecCnt = $datasheets_list->StartRec - 1;
if ($datasheets_list->Recordset && !$datasheets_list->Recordset->EOF) {
	$datasheets_list->Recordset->moveFirst();
	$selectLimit = $datasheets_list->UseSelectLimit;
	if (!$selectLimit && $datasheets_list->StartRec > 1)
		$datasheets_list->Recordset->move($datasheets_list->StartRec - 1);
} elseif (!$datasheets->AllowAddDeleteRow && $datasheets_list->StopRec == 0) {
	$datasheets_list->StopRec = $datasheets->GridAddRowCount;
}

// Initialize aggregate
$datasheets->RowType = ROWTYPE_AGGREGATEINIT;
$datasheets->resetAttributes();
$datasheets_list->renderRow();
$datasheets_list->EditRowCnt = 0;
if ($datasheets->isEdit())
	$datasheets_list->RowIndex = 1;
if ($datasheets->isGridAdd())
	$datasheets_list->RowIndex = 0;
if ($datasheets->isGridEdit())
	$datasheets_list->RowIndex = 0;
while ($datasheets_list->RecCnt < $datasheets_list->StopRec) {
	$datasheets_list->RecCnt++;
	if ($datasheets_list->RecCnt >= $datasheets_list->StartRec) {
		$datasheets_list->RowCnt++;
		if ($datasheets->isGridAdd() || $datasheets->isGridEdit() || $datasheets->isConfirm()) {
			$datasheets_list->RowIndex++;
			$CurrentForm->Index = $datasheets_list->RowIndex;
			if ($CurrentForm->hasValue($datasheets_list->FormActionName) && $datasheets_list->EventCancelled)
				$datasheets_list->RowAction = strval($CurrentForm->getValue($datasheets_list->FormActionName));
			elseif ($datasheets->isGridAdd())
				$datasheets_list->RowAction = "insert";
			else
				$datasheets_list->RowAction = "";
		}

		// Set up key count
		$datasheets_list->KeyCount = $datasheets_list->RowIndex;

		// Init row class and style
		$datasheets->resetAttributes();
		$datasheets->CssClass = "";
		if ($datasheets->isGridAdd()) {
			$datasheets_list->loadRowValues(); // Load default values
		} else {
			$datasheets_list->loadRowValues($datasheets_list->Recordset); // Load row values
		}
		$datasheets->RowType = ROWTYPE_VIEW; // Render view
		if ($datasheets->isGridAdd()) // Grid add
			$datasheets->RowType = ROWTYPE_ADD; // Render add
		if ($datasheets->isGridAdd() && $datasheets->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$datasheets_list->restoreCurrentRowFormValues($datasheets_list->RowIndex); // Restore form values
		if ($datasheets->isEdit()) {
			if ($datasheets_list->checkInlineEditKey() && $datasheets_list->EditRowCnt == 0) { // Inline edit
				$datasheets->RowType = ROWTYPE_EDIT; // Render edit
				if (!$datasheets->EventCancelled)
					$datasheets_list->HashValue = $datasheets_list->getRowHash($datasheets_list->Recordset); // Get hash value for record
			}
		}
		if ($datasheets->isGridEdit()) { // Grid edit
			if ($datasheets->EventCancelled)
				$datasheets_list->restoreCurrentRowFormValues($datasheets_list->RowIndex); // Restore form values
			if ($datasheets_list->RowAction == "insert")
				$datasheets->RowType = ROWTYPE_ADD; // Render add
			else
				$datasheets->RowType = ROWTYPE_EDIT; // Render edit
			if (!$datasheets->EventCancelled)
				$datasheets_list->HashValue = $datasheets_list->getRowHash($datasheets_list->Recordset); // Get hash value for record
		}
		if ($datasheets->isEdit() && $datasheets->RowType == ROWTYPE_EDIT && $datasheets->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$datasheets_list->restoreFormValues(); // Restore form values
		}
		if ($datasheets->isGridEdit() && ($datasheets->RowType == ROWTYPE_EDIT || $datasheets->RowType == ROWTYPE_ADD) && $datasheets->EventCancelled) // Update failed
			$datasheets_list->restoreCurrentRowFormValues($datasheets_list->RowIndex); // Restore form values
		if ($datasheets->RowType == ROWTYPE_EDIT) // Edit row
			$datasheets_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$datasheets->RowAttrs = array_merge($datasheets->RowAttrs, array('data-rowindex'=>$datasheets_list->RowCnt, 'id'=>'r' . $datasheets_list->RowCnt . '_datasheets', 'data-rowtype'=>$datasheets->RowType));

		// Render row
		$datasheets_list->renderRow();

		// Render list options
		$datasheets_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($datasheets_list->RowAction <> "delete" && $datasheets_list->RowAction <> "insertdelete" && !($datasheets_list->RowAction == "insert" && $datasheets->isConfirm() && $datasheets_list->emptyRow())) {
?>
	<tr<?php echo $datasheets->rowAttributes() ?>>
<?php

// Render list options (body, left)
$datasheets_list->ListOptions->render("body", "left", $datasheets_list->RowCnt);
?>
	<?php if ($datasheets->partno->Visible) { // partno ?>
		<td data-name="partno"<?php echo $datasheets->partno->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_partno" class="form-group datasheets_partno">
<input type="text" data-table="datasheets" data-field="x_partno" name="x<?php echo $datasheets_list->RowIndex ?>_partno" id="x<?php echo $datasheets_list->RowIndex ?>_partno" size="30" placeholder="<?php echo HtmlEncode($datasheets->partno->getPlaceHolder()) ?>" value="<?php echo $datasheets->partno->EditValue ?>"<?php echo $datasheets->partno->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_partno" name="o<?php echo $datasheets_list->RowIndex ?>_partno" id="o<?php echo $datasheets_list->RowIndex ?>_partno" value="<?php echo HtmlEncode($datasheets->partno->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_partno" class="form-group datasheets_partno">
<span<?php echo $datasheets->partno->viewAttributes() ?>>
<?php if ((!EmptyString($datasheets->partno->EditValue)) && $datasheets->partno->linkAttributes() <> "") { ?>
<a<?php echo $datasheets->partno->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->partno->EditValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->partno->EditValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_partno" name="x<?php echo $datasheets_list->RowIndex ?>_partno" id="x<?php echo $datasheets_list->RowIndex ?>_partno" value="<?php echo HtmlEncode($datasheets->partno->CurrentValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_partno" class="datasheets_partno">
<span<?php echo $datasheets->partno->viewAttributes() ?>>
<?php if ((!EmptyString($datasheets->partno->getViewValue())) && $datasheets->partno->linkAttributes() <> "") { ?>
<a<?php echo $datasheets->partno->linkAttributes() ?>><?php echo $datasheets->partno->getViewValue() ?></a>
<?php } else { ?>
<?php echo $datasheets->partno->getViewValue() ?>
<?php } ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="datasheets" data-field="x_partid" name="x<?php echo $datasheets_list->RowIndex ?>_partid" id="x<?php echo $datasheets_list->RowIndex ?>_partid" value="<?php echo HtmlEncode($datasheets->partid->CurrentValue) ?>">
<input type="hidden" data-table="datasheets" data-field="x_partid" name="o<?php echo $datasheets_list->RowIndex ?>_partid" id="o<?php echo $datasheets_list->RowIndex ?>_partid" value="<?php echo HtmlEncode($datasheets->partid->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT || $datasheets->CurrentMode == "edit") { ?>
<input type="hidden" data-table="datasheets" data-field="x_partid" name="x<?php echo $datasheets_list->RowIndex ?>_partid" id="x<?php echo $datasheets_list->RowIndex ?>_partid" value="<?php echo HtmlEncode($datasheets->partid->CurrentValue) ?>">
<?php } ?>
	<?php if ($datasheets->dataSheetFile->Visible) { // dataSheetFile ?>
		<td data-name="dataSheetFile"<?php echo $datasheets->dataSheetFile->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_dataSheetFile" class="form-group datasheets_dataSheetFile">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile">
<span title="<?php echo $datasheets->dataSheetFile->title() ? $datasheets->dataSheetFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->dataSheetFile->ReadOnly || $datasheets->dataSheetFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_dataSheetFile" name="x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id="x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile"<?php echo $datasheets->dataSheetFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="0">
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="datasheets" data-field="x_dataSheetFile" name="o<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id="o<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo HtmlEncode($datasheets->dataSheetFile->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_dataSheetFile" class="form-group datasheets_dataSheetFile">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile">
<span title="<?php echo $datasheets->dataSheetFile->title() ? $datasheets->dataSheetFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->dataSheetFile->ReadOnly || $datasheets->dataSheetFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_dataSheetFile" name="x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id="x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile"<?php echo $datasheets->dataSheetFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->Upload->FileName ?>">
<?php if (Post("fa_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile") == "0") { ?>
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_dataSheetFile" class="datasheets_dataSheetFile">
<span<?php echo $datasheets->dataSheetFile->viewAttributes() ?>>
<?php echo GetFileViewTag($datasheets->dataSheetFile, $datasheets->dataSheetFile->getViewValue()) ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->manufacturer->Visible) { // manufacturer ?>
		<td data-name="manufacturer"<?php echo $datasheets->manufacturer->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_manufacturer" class="form-group datasheets_manufacturer">
<?php
$wrkonchange = "" . trim(@$datasheets->manufacturer->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->manufacturer->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" class="text-nowrap" style="z-index: <?php echo (9000 - $datasheets_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" id="sv_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" value="<?php echo RemoveHtml($datasheets->manufacturer->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->manufacturer->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->manufacturer->getPlaceHolder()) ?>"<?php echo $datasheets->manufacturer->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($datasheets->manufacturer->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $datasheets_list->RowIndex ?>_manufacturer',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($datasheets->manufacturer->ReadOnly || $datasheets->manufacturer->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "manufacturer") && !$datasheets->manufacturer->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $datasheets->manufacturer->caption() ?>" data-title="<?php echo $datasheets->manufacturer->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $datasheets_list->RowIndex ?>_manufacturer',url:'manufactureraddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $datasheets->manufacturer->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_manufacturer" id="x<?php echo $datasheets_list->RowIndex ?>_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetslist.createAutoSuggest({"id":"x<?php echo $datasheets_list->RowIndex ?>_manufacturer","forceSelect":true});
</script>
<?php echo $datasheets->manufacturer->Lookup->getParamTag("p_x" . $datasheets_list->RowIndex . "_manufacturer") ?>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" name="o<?php echo $datasheets_list->RowIndex ?>_manufacturer" id="o<?php echo $datasheets_list->RowIndex ?>_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_manufacturer" class="form-group datasheets_manufacturer">
<?php
$wrkonchange = "" . trim(@$datasheets->manufacturer->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->manufacturer->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" class="text-nowrap" style="z-index: <?php echo (9000 - $datasheets_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" id="sv_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" value="<?php echo RemoveHtml($datasheets->manufacturer->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->manufacturer->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->manufacturer->getPlaceHolder()) ?>"<?php echo $datasheets->manufacturer->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($datasheets->manufacturer->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $datasheets_list->RowIndex ?>_manufacturer',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($datasheets->manufacturer->ReadOnly || $datasheets->manufacturer->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "manufacturer") && !$datasheets->manufacturer->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $datasheets->manufacturer->caption() ?>" data-title="<?php echo $datasheets->manufacturer->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $datasheets_list->RowIndex ?>_manufacturer',url:'manufactureraddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $datasheets->manufacturer->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_manufacturer" id="x<?php echo $datasheets_list->RowIndex ?>_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetslist.createAutoSuggest({"id":"x<?php echo $datasheets_list->RowIndex ?>_manufacturer","forceSelect":true});
</script>
<?php echo $datasheets->manufacturer->Lookup->getParamTag("p_x" . $datasheets_list->RowIndex . "_manufacturer") ?>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_manufacturer" class="datasheets_manufacturer">
<span<?php echo $datasheets->manufacturer->viewAttributes() ?>>
<?php echo $datasheets->manufacturer->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->tittle->Visible) { // tittle ?>
		<td data-name="tittle"<?php echo $datasheets->tittle->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_tittle" class="form-group datasheets_tittle">
<textarea data-table="datasheets" data-field="x_tittle" name="x<?php echo $datasheets_list->RowIndex ?>_tittle" id="x<?php echo $datasheets_list->RowIndex ?>_tittle" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->tittle->getPlaceHolder()) ?>"<?php echo $datasheets->tittle->editAttributes() ?>><?php echo $datasheets->tittle->EditValue ?></textarea>
</span>
<input type="hidden" data-table="datasheets" data-field="x_tittle" name="o<?php echo $datasheets_list->RowIndex ?>_tittle" id="o<?php echo $datasheets_list->RowIndex ?>_tittle" value="<?php echo HtmlEncode($datasheets->tittle->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_tittle" class="form-group datasheets_tittle">
<textarea data-table="datasheets" data-field="x_tittle" name="x<?php echo $datasheets_list->RowIndex ?>_tittle" id="x<?php echo $datasheets_list->RowIndex ?>_tittle" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->tittle->getPlaceHolder()) ?>"<?php echo $datasheets->tittle->editAttributes() ?>><?php echo $datasheets->tittle->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_tittle" class="datasheets_tittle">
<span<?php echo $datasheets->tittle->viewAttributes() ?>>
<?php echo $datasheets->tittle->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->cddissue->Visible) { // cddissue ?>
		<td data-name="cddissue"<?php echo $datasheets->cddissue->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddissue" class="form-group datasheets_cddissue">
<input type="text" data-table="datasheets" data-field="x_cddissue" data-format="5" name="x<?php echo $datasheets_list->RowIndex ?>_cddissue" id="x<?php echo $datasheets_list->RowIndex ?>_cddissue" placeholder="<?php echo HtmlEncode($datasheets->cddissue->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddissue->EditValue ?>"<?php echo $datasheets->cddissue->editAttributes() ?>>
<?php if (!$datasheets->cddissue->ReadOnly && !$datasheets->cddissue->Disabled && !isset($datasheets->cddissue->EditAttrs["readonly"]) && !isset($datasheets->cddissue->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetslist", "x<?php echo $datasheets_list->RowIndex ?>_cddissue", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddissue" name="o<?php echo $datasheets_list->RowIndex ?>_cddissue" id="o<?php echo $datasheets_list->RowIndex ?>_cddissue" value="<?php echo HtmlEncode($datasheets->cddissue->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddissue" class="form-group datasheets_cddissue">
<input type="text" data-table="datasheets" data-field="x_cddissue" data-format="5" name="x<?php echo $datasheets_list->RowIndex ?>_cddissue" id="x<?php echo $datasheets_list->RowIndex ?>_cddissue" placeholder="<?php echo HtmlEncode($datasheets->cddissue->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddissue->EditValue ?>"<?php echo $datasheets->cddissue->editAttributes() ?>>
<?php if (!$datasheets->cddissue->ReadOnly && !$datasheets->cddissue->Disabled && !isset($datasheets->cddissue->EditAttrs["readonly"]) && !isset($datasheets->cddissue->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetslist", "x<?php echo $datasheets_list->RowIndex ?>_cddissue", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddissue" class="datasheets_cddissue">
<span<?php echo $datasheets->cddissue->viewAttributes() ?>>
<?php echo $datasheets->cddissue->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->cddno->Visible) { // cddno ?>
		<td data-name="cddno"<?php echo $datasheets->cddno->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddno" class="form-group datasheets_cddno">
<input type="text" data-table="datasheets" data-field="x_cddno" name="x<?php echo $datasheets_list->RowIndex ?>_cddno" id="x<?php echo $datasheets_list->RowIndex ?>_cddno" size="30" placeholder="<?php echo HtmlEncode($datasheets->cddno->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddno->EditValue ?>"<?php echo $datasheets->cddno->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddno" name="o<?php echo $datasheets_list->RowIndex ?>_cddno" id="o<?php echo $datasheets_list->RowIndex ?>_cddno" value="<?php echo HtmlEncode($datasheets->cddno->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddno" class="form-group datasheets_cddno">
<input type="text" data-table="datasheets" data-field="x_cddno" name="x<?php echo $datasheets_list->RowIndex ?>_cddno" id="x<?php echo $datasheets_list->RowIndex ?>_cddno" size="30" placeholder="<?php echo HtmlEncode($datasheets->cddno->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddno->EditValue ?>"<?php echo $datasheets->cddno->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddno" class="datasheets_cddno">
<span<?php echo $datasheets->cddno->viewAttributes() ?>>
<?php if ((!EmptyString($datasheets->cddno->getViewValue())) && $datasheets->cddno->linkAttributes() <> "") { ?>
<a<?php echo $datasheets->cddno->linkAttributes() ?>><?php echo $datasheets->cddno->getViewValue() ?></a>
<?php } else { ?>
<?php echo $datasheets->cddno->getViewValue() ?>
<?php } ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->cddFile->Visible) { // cddFile ?>
		<td data-name="cddFile"<?php echo $datasheets->cddFile->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddFile" class="form-group datasheets_cddFile">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_cddFile">
<span title="<?php echo $datasheets->cddFile->title() ? $datasheets->cddFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cddFile->ReadOnly || $datasheets->cddFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cddFile" name="x<?php echo $datasheets_list->RowIndex ?>_cddFile" id="x<?php echo $datasheets_list->RowIndex ?>_cddFile"<?php echo $datasheets->cddFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo $datasheets->cddFile->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="0">
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo $datasheets->cddFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo $datasheets->cddFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_cddFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddFile" name="o<?php echo $datasheets_list->RowIndex ?>_cddFile" id="o<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo HtmlEncode($datasheets->cddFile->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddFile" class="form-group datasheets_cddFile">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_cddFile">
<span title="<?php echo $datasheets->cddFile->title() ? $datasheets->cddFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cddFile->ReadOnly || $datasheets->cddFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cddFile" name="x<?php echo $datasheets_list->RowIndex ?>_cddFile" id="x<?php echo $datasheets_list->RowIndex ?>_cddFile"<?php echo $datasheets->cddFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo $datasheets->cddFile->Upload->FileName ?>">
<?php if (Post("fa_x<?php echo $datasheets_list->RowIndex ?>_cddFile") == "0") { ?>
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo $datasheets->cddFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo $datasheets->cddFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_cddFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddFile" class="datasheets_cddFile">
<span<?php echo $datasheets->cddFile->viewAttributes() ?>>
<?php echo GetFileViewTag($datasheets->cddFile, $datasheets->cddFile->getViewValue()) ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->thirdPartyNo->Visible) { // thirdPartyNo ?>
		<td data-name="thirdPartyNo"<?php echo $datasheets->thirdPartyNo->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_thirdPartyNo" class="form-group datasheets_thirdPartyNo">
<input type="text" data-table="datasheets" data-field="x_thirdPartyNo" name="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" id="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" size="30" placeholder="<?php echo HtmlEncode($datasheets->thirdPartyNo->getPlaceHolder()) ?>" value="<?php echo $datasheets->thirdPartyNo->EditValue ?>"<?php echo $datasheets->thirdPartyNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_thirdPartyNo" name="o<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" id="o<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" value="<?php echo HtmlEncode($datasheets->thirdPartyNo->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_thirdPartyNo" class="form-group datasheets_thirdPartyNo">
<input type="text" data-table="datasheets" data-field="x_thirdPartyNo" name="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" id="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" size="30" placeholder="<?php echo HtmlEncode($datasheets->thirdPartyNo->getPlaceHolder()) ?>" value="<?php echo $datasheets->thirdPartyNo->EditValue ?>"<?php echo $datasheets->thirdPartyNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_thirdPartyNo" class="datasheets_thirdPartyNo">
<span<?php echo $datasheets->thirdPartyNo->viewAttributes() ?>>
<?php if ((!EmptyString($datasheets->thirdPartyNo->getViewValue())) && $datasheets->thirdPartyNo->linkAttributes() <> "") { ?>
<a<?php echo $datasheets->thirdPartyNo->linkAttributes() ?>><?php echo $datasheets->thirdPartyNo->getViewValue() ?></a>
<?php } else { ?>
<?php echo $datasheets->thirdPartyNo->getViewValue() ?>
<?php } ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->thirdPartyFile->Visible) { // thirdPartyFile ?>
		<td data-name="thirdPartyFile"<?php echo $datasheets->thirdPartyFile->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_thirdPartyFile" class="form-group datasheets_thirdPartyFile">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile">
<span title="<?php echo $datasheets->thirdPartyFile->title() ? $datasheets->thirdPartyFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->thirdPartyFile->ReadOnly || $datasheets->thirdPartyFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_thirdPartyFile" name="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile"<?php echo $datasheets->thirdPartyFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="0">
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="datasheets" data-field="x_thirdPartyFile" name="o<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id="o<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo HtmlEncode($datasheets->thirdPartyFile->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_thirdPartyFile" class="form-group datasheets_thirdPartyFile">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile">
<span title="<?php echo $datasheets->thirdPartyFile->title() ? $datasheets->thirdPartyFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->thirdPartyFile->ReadOnly || $datasheets->thirdPartyFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_thirdPartyFile" name="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile"<?php echo $datasheets->thirdPartyFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->Upload->FileName ?>">
<?php if (Post("fa_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile") == "0") { ?>
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_thirdPartyFile" class="datasheets_thirdPartyFile">
<span<?php echo $datasheets->thirdPartyFile->viewAttributes() ?>>
<?php echo GetFileViewTag($datasheets->thirdPartyFile, $datasheets->thirdPartyFile->getViewValue()) ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->cover->Visible) { // cover ?>
		<td data-name="cover"<?php echo $datasheets->cover->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cover" class="form-group datasheets_cover">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_cover">
<span title="<?php echo $datasheets->cover->title() ? $datasheets->cover->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cover->ReadOnly || $datasheets->cover->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cover" name="x<?php echo $datasheets_list->RowIndex ?>_cover" id="x<?php echo $datasheets_list->RowIndex ?>_cover"<?php echo $datasheets->cover->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo $datasheets->cover->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_cover" value="0">
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_cover" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo $datasheets->cover->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo $datasheets->cover->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_cover" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cover" name="o<?php echo $datasheets_list->RowIndex ?>_cover" id="o<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo HtmlEncode($datasheets->cover->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cover" class="form-group datasheets_cover">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_cover">
<span title="<?php echo $datasheets->cover->title() ? $datasheets->cover->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cover->ReadOnly || $datasheets->cover->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cover" name="x<?php echo $datasheets_list->RowIndex ?>_cover" id="x<?php echo $datasheets_list->RowIndex ?>_cover"<?php echo $datasheets->cover->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo $datasheets->cover->Upload->FileName ?>">
<?php if (Post("fa_x<?php echo $datasheets_list->RowIndex ?>_cover") == "0") { ?>
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_cover" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_cover" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_cover" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo $datasheets->cover->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo $datasheets->cover->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_cover" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cover" class="datasheets_cover">
<span<?php echo $datasheets->cover->viewAttributes() ?>>
<?php echo GetFileViewTag($datasheets->cover, $datasheets->cover->getViewValue()) ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->expirydt->Visible) { // expirydt ?>
		<td data-name="expirydt"<?php echo $datasheets->expirydt->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_expirydt" class="form-group datasheets_expirydt">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-format="5" name="x<?php echo $datasheets_list->RowIndex ?>_expirydt" id="x<?php echo $datasheets_list->RowIndex ?>_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetslist", "x<?php echo $datasheets_list->RowIndex ?>_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="datasheets" data-field="x_expirydt" name="o<?php echo $datasheets_list->RowIndex ?>_expirydt" id="o<?php echo $datasheets_list->RowIndex ?>_expirydt" value="<?php echo HtmlEncode($datasheets->expirydt->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_expirydt" class="form-group datasheets_expirydt">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-format="5" name="x<?php echo $datasheets_list->RowIndex ?>_expirydt" id="x<?php echo $datasheets_list->RowIndex ?>_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetslist", "x<?php echo $datasheets_list->RowIndex ?>_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_expirydt" class="datasheets_expirydt">
<span<?php echo $datasheets->expirydt->viewAttributes() ?>>
<?php echo $datasheets->expirydt->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->coo->Visible) { // coo ?>
		<td data-name="coo"<?php echo $datasheets->coo->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_coo" class="form-group datasheets_coo">
<?php
$wrkonchange = "" . trim(@$datasheets->coo->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->coo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $datasheets_list->RowIndex ?>_coo" class="text-nowrap" style="z-index: <?php echo (9000 - $datasheets_list->RowCnt * 10) ?>">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $datasheets_list->RowIndex ?>_coo" id="sv_x<?php echo $datasheets_list->RowIndex ?>_coo" value="<?php echo RemoveHtml($datasheets->coo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>"<?php echo $datasheets->coo->editAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "countryOfOrigin") && !$datasheets->coo->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $datasheets_list->RowIndex ?>_coo" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $datasheets->coo->caption() ?>" data-title="<?php echo $datasheets->coo->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $datasheets_list->RowIndex ?>_coo',url:'countryOfOriginaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_coo" data-value-separator="<?php echo $datasheets->coo->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_coo" id="x<?php echo $datasheets_list->RowIndex ?>_coo" value="<?php echo HtmlEncode($datasheets->coo->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetslist.createAutoSuggest({"id":"x<?php echo $datasheets_list->RowIndex ?>_coo","forceSelect":false});
</script>
<?php echo $datasheets->coo->Lookup->getParamTag("p_x" . $datasheets_list->RowIndex . "_coo") ?>
</span>
<input type="hidden" data-table="datasheets" data-field="x_coo" name="o<?php echo $datasheets_list->RowIndex ?>_coo" id="o<?php echo $datasheets_list->RowIndex ?>_coo" value="<?php echo HtmlEncode($datasheets->coo->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_coo" class="form-group datasheets_coo">
<?php
$wrkonchange = "" . trim(@$datasheets->coo->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->coo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $datasheets_list->RowIndex ?>_coo" class="text-nowrap" style="z-index: <?php echo (9000 - $datasheets_list->RowCnt * 10) ?>">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $datasheets_list->RowIndex ?>_coo" id="sv_x<?php echo $datasheets_list->RowIndex ?>_coo" value="<?php echo RemoveHtml($datasheets->coo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>"<?php echo $datasheets->coo->editAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "countryOfOrigin") && !$datasheets->coo->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $datasheets_list->RowIndex ?>_coo" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $datasheets->coo->caption() ?>" data-title="<?php echo $datasheets->coo->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $datasheets_list->RowIndex ?>_coo',url:'countryOfOriginaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_coo" data-value-separator="<?php echo $datasheets->coo->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_coo" id="x<?php echo $datasheets_list->RowIndex ?>_coo" value="<?php echo HtmlEncode($datasheets->coo->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetslist.createAutoSuggest({"id":"x<?php echo $datasheets_list->RowIndex ?>_coo","forceSelect":false});
</script>
<?php echo $datasheets->coo->Lookup->getParamTag("p_x" . $datasheets_list->RowIndex . "_coo") ?>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_coo" class="datasheets_coo">
<span<?php echo $datasheets->coo->viewAttributes() ?>>
<?php echo $datasheets->coo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->hssCode->Visible) { // hssCode ?>
		<td data-name="hssCode"<?php echo $datasheets->hssCode->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_hssCode" class="form-group datasheets_hssCode">
<input type="text" data-table="datasheets" data-field="x_hssCode" name="x<?php echo $datasheets_list->RowIndex ?>_hssCode" id="x<?php echo $datasheets_list->RowIndex ?>_hssCode" size="30" placeholder="<?php echo HtmlEncode($datasheets->hssCode->getPlaceHolder()) ?>" value="<?php echo $datasheets->hssCode->EditValue ?>"<?php echo $datasheets->hssCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_hssCode" name="o<?php echo $datasheets_list->RowIndex ?>_hssCode" id="o<?php echo $datasheets_list->RowIndex ?>_hssCode" value="<?php echo HtmlEncode($datasheets->hssCode->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_hssCode" class="form-group datasheets_hssCode">
<input type="text" data-table="datasheets" data-field="x_hssCode" name="x<?php echo $datasheets_list->RowIndex ?>_hssCode" id="x<?php echo $datasheets_list->RowIndex ?>_hssCode" size="30" placeholder="<?php echo HtmlEncode($datasheets->hssCode->getPlaceHolder()) ?>" value="<?php echo $datasheets->hssCode->EditValue ?>"<?php echo $datasheets->hssCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_hssCode" class="datasheets_hssCode">
<span<?php echo $datasheets->hssCode->viewAttributes() ?>>
<?php echo $datasheets->hssCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->systrade->Visible) { // systrade ?>
		<td data-name="systrade"<?php echo $datasheets->systrade->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_systrade" class="form-group datasheets_systrade">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="datasheets" data-field="x_systrade" data-value-separator="<?php echo $datasheets->systrade->displayValueSeparatorAttribute() ?>" id="x<?php echo $datasheets_list->RowIndex ?>_systrade" name="x<?php echo $datasheets_list->RowIndex ?>_systrade"<?php echo $datasheets->systrade->editAttributes() ?>>
		<?php echo $datasheets->systrade->selectOptionListHtml("x<?php echo $datasheets_list->RowIndex ?>_systrade") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_systrade" name="o<?php echo $datasheets_list->RowIndex ?>_systrade" id="o<?php echo $datasheets_list->RowIndex ?>_systrade" value="<?php echo HtmlEncode($datasheets->systrade->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_systrade" class="form-group datasheets_systrade">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="datasheets" data-field="x_systrade" data-value-separator="<?php echo $datasheets->systrade->displayValueSeparatorAttribute() ?>" id="x<?php echo $datasheets_list->RowIndex ?>_systrade" name="x<?php echo $datasheets_list->RowIndex ?>_systrade"<?php echo $datasheets->systrade->editAttributes() ?>>
		<?php echo $datasheets->systrade->selectOptionListHtml("x<?php echo $datasheets_list->RowIndex ?>_systrade") ?>
	</select>
</div>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_systrade" class="datasheets_systrade">
<span<?php echo $datasheets->systrade->viewAttributes() ?>>
<?php echo $datasheets->systrade->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->isdatasheet->Visible) { // isdatasheet ?>
		<td data-name="isdatasheet"<?php echo $datasheets->isdatasheet->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_isdatasheet" class="form-group datasheets_isdatasheet">
<div id="tp_x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_isdatasheet" data-value-separator="<?php echo $datasheets->isdatasheet->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" id="x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" value="{value}"<?php echo $datasheets->isdatasheet->editAttributes() ?>></div>
<div id="dsl_x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->isdatasheet->radioButtonListHtml(FALSE, "x{$datasheets_list->RowIndex}_isdatasheet") ?>
</div></div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_isdatasheet" name="o<?php echo $datasheets_list->RowIndex ?>_isdatasheet" id="o<?php echo $datasheets_list->RowIndex ?>_isdatasheet" value="<?php echo HtmlEncode($datasheets->isdatasheet->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_isdatasheet" class="form-group datasheets_isdatasheet">
<div id="tp_x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_isdatasheet" data-value-separator="<?php echo $datasheets->isdatasheet->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" id="x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" value="{value}"<?php echo $datasheets->isdatasheet->editAttributes() ?>></div>
<div id="dsl_x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->isdatasheet->radioButtonListHtml(FALSE, "x{$datasheets_list->RowIndex}_isdatasheet") ?>
</div></div>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_isdatasheet" class="datasheets_isdatasheet">
<span<?php echo $datasheets->isdatasheet->viewAttributes() ?>>
<?php echo $datasheets->isdatasheet->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->cddrenewal_required->Visible) { // cddrenewal_required ?>
		<td data-name="cddrenewal_required"<?php echo $datasheets->cddrenewal_required->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddrenewal_required" class="form-group datasheets_cddrenewal_required">
<div id="tp_x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_cddrenewal_required" data-value-separator="<?php echo $datasheets->cddrenewal_required->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" id="x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" value="{value}"<?php echo $datasheets->cddrenewal_required->editAttributes() ?>></div>
<div id="dsl_x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->cddrenewal_required->radioButtonListHtml(FALSE, "x{$datasheets_list->RowIndex}_cddrenewal_required") ?>
</div></div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddrenewal_required" name="o<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" id="o<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" value="<?php echo HtmlEncode($datasheets->cddrenewal_required->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddrenewal_required" class="form-group datasheets_cddrenewal_required">
<div id="tp_x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_cddrenewal_required" data-value-separator="<?php echo $datasheets->cddrenewal_required->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" id="x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" value="{value}"<?php echo $datasheets->cddrenewal_required->editAttributes() ?>></div>
<div id="dsl_x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->cddrenewal_required->radioButtonListHtml(FALSE, "x{$datasheets_list->RowIndex}_cddrenewal_required") ?>
</div></div>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_cddrenewal_required" class="datasheets_cddrenewal_required">
<span<?php echo $datasheets->cddrenewal_required->viewAttributes() ?>>
<?php echo $datasheets->cddrenewal_required->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($datasheets->nativeFiles->Visible) { // nativeFiles ?>
		<td data-name="nativeFiles"<?php echo $datasheets->nativeFiles->cellAttributes() ?>>
<?php if ($datasheets->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_nativeFiles" class="form-group datasheets_nativeFiles">
<textarea data-table="datasheets" data-field="x_nativeFiles" name="x<?php echo $datasheets_list->RowIndex ?>_nativeFiles" id="x<?php echo $datasheets_list->RowIndex ?>_nativeFiles" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->nativeFiles->getPlaceHolder()) ?>"<?php echo $datasheets->nativeFiles->editAttributes() ?>><?php echo $datasheets->nativeFiles->EditValue ?></textarea>
</span>
<input type="hidden" data-table="datasheets" data-field="x_nativeFiles" name="o<?php echo $datasheets_list->RowIndex ?>_nativeFiles" id="o<?php echo $datasheets_list->RowIndex ?>_nativeFiles" value="<?php echo HtmlEncode($datasheets->nativeFiles->OldValue) ?>">
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_nativeFiles" class="form-group datasheets_nativeFiles">
<textarea data-table="datasheets" data-field="x_nativeFiles" name="x<?php echo $datasheets_list->RowIndex ?>_nativeFiles" id="x<?php echo $datasheets_list->RowIndex ?>_nativeFiles" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->nativeFiles->getPlaceHolder()) ?>"<?php echo $datasheets->nativeFiles->editAttributes() ?>><?php echo $datasheets->nativeFiles->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($datasheets->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $datasheets_list->RowCnt ?>_datasheets_nativeFiles" class="datasheets_nativeFiles">
<span<?php echo $datasheets->nativeFiles->viewAttributes() ?>>
<?php echo $datasheets->nativeFiles->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$datasheets_list->ListOptions->render("body", "right", $datasheets_list->RowCnt);
?>
	</tr>
<?php if ($datasheets->RowType == ROWTYPE_ADD || $datasheets->RowType == ROWTYPE_EDIT) { ?>
<script>
fdatasheetslist.updateLists(<?php echo $datasheets_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$datasheets->isGridAdd())
		if (!$datasheets_list->Recordset->EOF)
			$datasheets_list->Recordset->moveNext();
}
?>
<?php
	if ($datasheets->isGridAdd() || $datasheets->isGridEdit()) {
		$datasheets_list->RowIndex = '$rowindex$';
		$datasheets_list->loadRowValues();

		// Set row properties
		$datasheets->resetAttributes();
		$datasheets->RowAttrs = array_merge($datasheets->RowAttrs, array('data-rowindex'=>$datasheets_list->RowIndex, 'id'=>'r0_datasheets', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($datasheets->RowAttrs["class"], "ew-template");
		$datasheets->RowType = ROWTYPE_ADD;

		// Render row
		$datasheets_list->renderRow();

		// Render list options
		$datasheets_list->renderListOptions();
		$datasheets_list->StartRowCnt = 0;
?>
	<tr<?php echo $datasheets->rowAttributes() ?>>
<?php

// Render list options (body, left)
$datasheets_list->ListOptions->render("body", "left", $datasheets_list->RowIndex);
?>
	<?php if ($datasheets->partno->Visible) { // partno ?>
		<td data-name="partno">
<span id="el$rowindex$_datasheets_partno" class="form-group datasheets_partno">
<input type="text" data-table="datasheets" data-field="x_partno" name="x<?php echo $datasheets_list->RowIndex ?>_partno" id="x<?php echo $datasheets_list->RowIndex ?>_partno" size="30" placeholder="<?php echo HtmlEncode($datasheets->partno->getPlaceHolder()) ?>" value="<?php echo $datasheets->partno->EditValue ?>"<?php echo $datasheets->partno->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_partno" name="o<?php echo $datasheets_list->RowIndex ?>_partno" id="o<?php echo $datasheets_list->RowIndex ?>_partno" value="<?php echo HtmlEncode($datasheets->partno->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->dataSheetFile->Visible) { // dataSheetFile ?>
		<td data-name="dataSheetFile">
<span id="el$rowindex$_datasheets_dataSheetFile" class="form-group datasheets_dataSheetFile">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile">
<span title="<?php echo $datasheets->dataSheetFile->title() ? $datasheets->dataSheetFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->dataSheetFile->ReadOnly || $datasheets->dataSheetFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_dataSheetFile" name="x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id="x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile"<?php echo $datasheets->dataSheetFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="0">
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="datasheets" data-field="x_dataSheetFile" name="o<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" id="o<?php echo $datasheets_list->RowIndex ?>_dataSheetFile" value="<?php echo HtmlEncode($datasheets->dataSheetFile->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->manufacturer->Visible) { // manufacturer ?>
		<td data-name="manufacturer">
<span id="el$rowindex$_datasheets_manufacturer" class="form-group datasheets_manufacturer">
<?php
$wrkonchange = "" . trim(@$datasheets->manufacturer->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->manufacturer->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" class="text-nowrap" style="z-index: <?php echo (9000 - $datasheets_list->RowCnt * 10) ?>">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" id="sv_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" value="<?php echo RemoveHtml($datasheets->manufacturer->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->manufacturer->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->manufacturer->getPlaceHolder()) ?>"<?php echo $datasheets->manufacturer->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($datasheets->manufacturer->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $datasheets_list->RowIndex ?>_manufacturer',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($datasheets->manufacturer->ReadOnly || $datasheets->manufacturer->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "manufacturer") && !$datasheets->manufacturer->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $datasheets_list->RowIndex ?>_manufacturer" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $datasheets->manufacturer->caption() ?>" data-title="<?php echo $datasheets->manufacturer->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $datasheets_list->RowIndex ?>_manufacturer',url:'manufactureraddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $datasheets->manufacturer->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_manufacturer" id="x<?php echo $datasheets_list->RowIndex ?>_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetslist.createAutoSuggest({"id":"x<?php echo $datasheets_list->RowIndex ?>_manufacturer","forceSelect":true});
</script>
<?php echo $datasheets->manufacturer->Lookup->getParamTag("p_x" . $datasheets_list->RowIndex . "_manufacturer") ?>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" name="o<?php echo $datasheets_list->RowIndex ?>_manufacturer" id="o<?php echo $datasheets_list->RowIndex ?>_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->tittle->Visible) { // tittle ?>
		<td data-name="tittle">
<span id="el$rowindex$_datasheets_tittle" class="form-group datasheets_tittle">
<textarea data-table="datasheets" data-field="x_tittle" name="x<?php echo $datasheets_list->RowIndex ?>_tittle" id="x<?php echo $datasheets_list->RowIndex ?>_tittle" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->tittle->getPlaceHolder()) ?>"<?php echo $datasheets->tittle->editAttributes() ?>><?php echo $datasheets->tittle->EditValue ?></textarea>
</span>
<input type="hidden" data-table="datasheets" data-field="x_tittle" name="o<?php echo $datasheets_list->RowIndex ?>_tittle" id="o<?php echo $datasheets_list->RowIndex ?>_tittle" value="<?php echo HtmlEncode($datasheets->tittle->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->cddissue->Visible) { // cddissue ?>
		<td data-name="cddissue">
<span id="el$rowindex$_datasheets_cddissue" class="form-group datasheets_cddissue">
<input type="text" data-table="datasheets" data-field="x_cddissue" data-format="5" name="x<?php echo $datasheets_list->RowIndex ?>_cddissue" id="x<?php echo $datasheets_list->RowIndex ?>_cddissue" placeholder="<?php echo HtmlEncode($datasheets->cddissue->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddissue->EditValue ?>"<?php echo $datasheets->cddissue->editAttributes() ?>>
<?php if (!$datasheets->cddissue->ReadOnly && !$datasheets->cddissue->Disabled && !isset($datasheets->cddissue->EditAttrs["readonly"]) && !isset($datasheets->cddissue->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetslist", "x<?php echo $datasheets_list->RowIndex ?>_cddissue", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddissue" name="o<?php echo $datasheets_list->RowIndex ?>_cddissue" id="o<?php echo $datasheets_list->RowIndex ?>_cddissue" value="<?php echo HtmlEncode($datasheets->cddissue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->cddno->Visible) { // cddno ?>
		<td data-name="cddno">
<span id="el$rowindex$_datasheets_cddno" class="form-group datasheets_cddno">
<input type="text" data-table="datasheets" data-field="x_cddno" name="x<?php echo $datasheets_list->RowIndex ?>_cddno" id="x<?php echo $datasheets_list->RowIndex ?>_cddno" size="30" placeholder="<?php echo HtmlEncode($datasheets->cddno->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddno->EditValue ?>"<?php echo $datasheets->cddno->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddno" name="o<?php echo $datasheets_list->RowIndex ?>_cddno" id="o<?php echo $datasheets_list->RowIndex ?>_cddno" value="<?php echo HtmlEncode($datasheets->cddno->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->cddFile->Visible) { // cddFile ?>
		<td data-name="cddFile">
<span id="el$rowindex$_datasheets_cddFile" class="form-group datasheets_cddFile">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_cddFile">
<span title="<?php echo $datasheets->cddFile->title() ? $datasheets->cddFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cddFile->ReadOnly || $datasheets->cddFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cddFile" name="x<?php echo $datasheets_list->RowIndex ?>_cddFile" id="x<?php echo $datasheets_list->RowIndex ?>_cddFile"<?php echo $datasheets->cddFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo $datasheets->cddFile->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="0">
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo $datasheets->cddFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_cddFile" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo $datasheets->cddFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_cddFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddFile" name="o<?php echo $datasheets_list->RowIndex ?>_cddFile" id="o<?php echo $datasheets_list->RowIndex ?>_cddFile" value="<?php echo HtmlEncode($datasheets->cddFile->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->thirdPartyNo->Visible) { // thirdPartyNo ?>
		<td data-name="thirdPartyNo">
<span id="el$rowindex$_datasheets_thirdPartyNo" class="form-group datasheets_thirdPartyNo">
<input type="text" data-table="datasheets" data-field="x_thirdPartyNo" name="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" id="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" size="30" placeholder="<?php echo HtmlEncode($datasheets->thirdPartyNo->getPlaceHolder()) ?>" value="<?php echo $datasheets->thirdPartyNo->EditValue ?>"<?php echo $datasheets->thirdPartyNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_thirdPartyNo" name="o<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" id="o<?php echo $datasheets_list->RowIndex ?>_thirdPartyNo" value="<?php echo HtmlEncode($datasheets->thirdPartyNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->thirdPartyFile->Visible) { // thirdPartyFile ?>
		<td data-name="thirdPartyFile">
<span id="el$rowindex$_datasheets_thirdPartyFile" class="form-group datasheets_thirdPartyFile">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile">
<span title="<?php echo $datasheets->thirdPartyFile->title() ? $datasheets->thirdPartyFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->thirdPartyFile->ReadOnly || $datasheets->thirdPartyFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_thirdPartyFile" name="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id="x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile"<?php echo $datasheets->thirdPartyFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="0">
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="datasheets" data-field="x_thirdPartyFile" name="o<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" id="o<?php echo $datasheets_list->RowIndex ?>_thirdPartyFile" value="<?php echo HtmlEncode($datasheets->thirdPartyFile->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->cover->Visible) { // cover ?>
		<td data-name="cover">
<span id="el$rowindex$_datasheets_cover" class="form-group datasheets_cover">
<div id="fd_x<?php echo $datasheets_list->RowIndex ?>_cover">
<span title="<?php echo $datasheets->cover->title() ? $datasheets->cover->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cover->ReadOnly || $datasheets->cover->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cover" name="x<?php echo $datasheets_list->RowIndex ?>_cover" id="x<?php echo $datasheets_list->RowIndex ?>_cover"<?php echo $datasheets->cover->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fn_x<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo $datasheets->cover->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fa_x<?php echo $datasheets_list->RowIndex ?>_cover" value="0">
<input type="hidden" name="fs_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fs_x<?php echo $datasheets_list->RowIndex ?>_cover" value="0">
<input type="hidden" name="fx_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fx_x<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo $datasheets->cover->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $datasheets_list->RowIndex ?>_cover" id= "fm_x<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo $datasheets->cover->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $datasheets_list->RowIndex ?>_cover" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cover" name="o<?php echo $datasheets_list->RowIndex ?>_cover" id="o<?php echo $datasheets_list->RowIndex ?>_cover" value="<?php echo HtmlEncode($datasheets->cover->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->expirydt->Visible) { // expirydt ?>
		<td data-name="expirydt">
<span id="el$rowindex$_datasheets_expirydt" class="form-group datasheets_expirydt">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-format="5" name="x<?php echo $datasheets_list->RowIndex ?>_expirydt" id="x<?php echo $datasheets_list->RowIndex ?>_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetslist", "x<?php echo $datasheets_list->RowIndex ?>_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="datasheets" data-field="x_expirydt" name="o<?php echo $datasheets_list->RowIndex ?>_expirydt" id="o<?php echo $datasheets_list->RowIndex ?>_expirydt" value="<?php echo HtmlEncode($datasheets->expirydt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->coo->Visible) { // coo ?>
		<td data-name="coo">
<span id="el$rowindex$_datasheets_coo" class="form-group datasheets_coo">
<?php
$wrkonchange = "" . trim(@$datasheets->coo->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->coo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $datasheets_list->RowIndex ?>_coo" class="text-nowrap" style="z-index: <?php echo (9000 - $datasheets_list->RowCnt * 10) ?>">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $datasheets_list->RowIndex ?>_coo" id="sv_x<?php echo $datasheets_list->RowIndex ?>_coo" value="<?php echo RemoveHtml($datasheets->coo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>"<?php echo $datasheets->coo->editAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "countryOfOrigin") && !$datasheets->coo->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $datasheets_list->RowIndex ?>_coo" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $datasheets->coo->caption() ?>" data-title="<?php echo $datasheets->coo->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $datasheets_list->RowIndex ?>_coo',url:'countryOfOriginaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_coo" data-value-separator="<?php echo $datasheets->coo->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_coo" id="x<?php echo $datasheets_list->RowIndex ?>_coo" value="<?php echo HtmlEncode($datasheets->coo->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetslist.createAutoSuggest({"id":"x<?php echo $datasheets_list->RowIndex ?>_coo","forceSelect":false});
</script>
<?php echo $datasheets->coo->Lookup->getParamTag("p_x" . $datasheets_list->RowIndex . "_coo") ?>
</span>
<input type="hidden" data-table="datasheets" data-field="x_coo" name="o<?php echo $datasheets_list->RowIndex ?>_coo" id="o<?php echo $datasheets_list->RowIndex ?>_coo" value="<?php echo HtmlEncode($datasheets->coo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->hssCode->Visible) { // hssCode ?>
		<td data-name="hssCode">
<span id="el$rowindex$_datasheets_hssCode" class="form-group datasheets_hssCode">
<input type="text" data-table="datasheets" data-field="x_hssCode" name="x<?php echo $datasheets_list->RowIndex ?>_hssCode" id="x<?php echo $datasheets_list->RowIndex ?>_hssCode" size="30" placeholder="<?php echo HtmlEncode($datasheets->hssCode->getPlaceHolder()) ?>" value="<?php echo $datasheets->hssCode->EditValue ?>"<?php echo $datasheets->hssCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_hssCode" name="o<?php echo $datasheets_list->RowIndex ?>_hssCode" id="o<?php echo $datasheets_list->RowIndex ?>_hssCode" value="<?php echo HtmlEncode($datasheets->hssCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->systrade->Visible) { // systrade ?>
		<td data-name="systrade">
<span id="el$rowindex$_datasheets_systrade" class="form-group datasheets_systrade">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="datasheets" data-field="x_systrade" data-value-separator="<?php echo $datasheets->systrade->displayValueSeparatorAttribute() ?>" id="x<?php echo $datasheets_list->RowIndex ?>_systrade" name="x<?php echo $datasheets_list->RowIndex ?>_systrade"<?php echo $datasheets->systrade->editAttributes() ?>>
		<?php echo $datasheets->systrade->selectOptionListHtml("x<?php echo $datasheets_list->RowIndex ?>_systrade") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_systrade" name="o<?php echo $datasheets_list->RowIndex ?>_systrade" id="o<?php echo $datasheets_list->RowIndex ?>_systrade" value="<?php echo HtmlEncode($datasheets->systrade->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->isdatasheet->Visible) { // isdatasheet ?>
		<td data-name="isdatasheet">
<span id="el$rowindex$_datasheets_isdatasheet" class="form-group datasheets_isdatasheet">
<div id="tp_x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_isdatasheet" data-value-separator="<?php echo $datasheets->isdatasheet->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" id="x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" value="{value}"<?php echo $datasheets->isdatasheet->editAttributes() ?>></div>
<div id="dsl_x<?php echo $datasheets_list->RowIndex ?>_isdatasheet" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->isdatasheet->radioButtonListHtml(FALSE, "x{$datasheets_list->RowIndex}_isdatasheet") ?>
</div></div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_isdatasheet" name="o<?php echo $datasheets_list->RowIndex ?>_isdatasheet" id="o<?php echo $datasheets_list->RowIndex ?>_isdatasheet" value="<?php echo HtmlEncode($datasheets->isdatasheet->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->cddrenewal_required->Visible) { // cddrenewal_required ?>
		<td data-name="cddrenewal_required">
<span id="el$rowindex$_datasheets_cddrenewal_required" class="form-group datasheets_cddrenewal_required">
<div id="tp_x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_cddrenewal_required" data-value-separator="<?php echo $datasheets->cddrenewal_required->displayValueSeparatorAttribute() ?>" name="x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" id="x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" value="{value}"<?php echo $datasheets->cddrenewal_required->editAttributes() ?>></div>
<div id="dsl_x<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->cddrenewal_required->radioButtonListHtml(FALSE, "x{$datasheets_list->RowIndex}_cddrenewal_required") ?>
</div></div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddrenewal_required" name="o<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" id="o<?php echo $datasheets_list->RowIndex ?>_cddrenewal_required" value="<?php echo HtmlEncode($datasheets->cddrenewal_required->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($datasheets->nativeFiles->Visible) { // nativeFiles ?>
		<td data-name="nativeFiles">
<span id="el$rowindex$_datasheets_nativeFiles" class="form-group datasheets_nativeFiles">
<textarea data-table="datasheets" data-field="x_nativeFiles" name="x<?php echo $datasheets_list->RowIndex ?>_nativeFiles" id="x<?php echo $datasheets_list->RowIndex ?>_nativeFiles" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->nativeFiles->getPlaceHolder()) ?>"<?php echo $datasheets->nativeFiles->editAttributes() ?>><?php echo $datasheets->nativeFiles->EditValue ?></textarea>
</span>
<input type="hidden" data-table="datasheets" data-field="x_nativeFiles" name="o<?php echo $datasheets_list->RowIndex ?>_nativeFiles" id="o<?php echo $datasheets_list->RowIndex ?>_nativeFiles" value="<?php echo HtmlEncode($datasheets->nativeFiles->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$datasheets_list->ListOptions->render("body", "right", $datasheets_list->RowIndex);
?>
<script>
fdatasheetslist.updateLists(<?php echo $datasheets_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if ($datasheets->isAdd() || $datasheets->isCopy()) { ?>
<input type="hidden" name="<?php echo $datasheets_list->FormKeyCountName ?>" id="<?php echo $datasheets_list->FormKeyCountName ?>" value="<?php echo $datasheets_list->KeyCount ?>">
<?php } ?>
<?php if ($datasheets->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $datasheets_list->FormKeyCountName ?>" id="<?php echo $datasheets_list->FormKeyCountName ?>" value="<?php echo $datasheets_list->KeyCount ?>">
<?php echo $datasheets_list->MultiSelectKey ?>
<?php } ?>
<?php if ($datasheets->isEdit()) { ?>
<input type="hidden" name="<?php echo $datasheets_list->FormKeyCountName ?>" id="<?php echo $datasheets_list->FormKeyCountName ?>" value="<?php echo $datasheets_list->KeyCount ?>">
<?php } ?>
<?php if ($datasheets->isGridEdit()) { ?>
<?php if ($datasheets->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="action" id="action" value="gridoverwrite">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<?php } ?>
<input type="hidden" name="<?php echo $datasheets_list->FormKeyCountName ?>" id="<?php echo $datasheets_list->FormKeyCountName ?>" value="<?php echo $datasheets_list->KeyCount ?>">
<?php echo $datasheets_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$datasheets->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($datasheets_list->Recordset)
	$datasheets_list->Recordset->Close();
?>
<?php if (!$datasheets->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$datasheets->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($datasheets_list->Pager)) $datasheets_list->Pager = new NumericPager($datasheets_list->StartRec, $datasheets_list->DisplayRecs, $datasheets_list->TotalRecs, $datasheets_list->RecRange, $datasheets_list->AutoHidePager) ?>
<?php if ($datasheets_list->Pager->RecordCount > 0 && $datasheets_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($datasheets_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $datasheets_list->pageUrl() ?>start=<?php echo $datasheets_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($datasheets_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $datasheets_list->pageUrl() ?>start=<?php echo $datasheets_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($datasheets_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $datasheets_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($datasheets_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $datasheets_list->pageUrl() ?>start=<?php echo $datasheets_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($datasheets_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $datasheets_list->pageUrl() ?>start=<?php echo $datasheets_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($datasheets_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $datasheets_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $datasheets_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $datasheets_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $datasheets_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($datasheets_list->TotalRecs == 0 && !$datasheets->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $datasheets_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$datasheets_list->showPageFooter();
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
$datasheets_list->terminate();
?>