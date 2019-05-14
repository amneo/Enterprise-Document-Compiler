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
$datasheets_add = new datasheets_add();

// Run the page
$datasheets_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$datasheets_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fdatasheetsadd = currentForm = new ew.Form("fdatasheetsadd", "add");

// Validate form
fdatasheetsadd.validate = function() {
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
		<?php if ($datasheets_add->partno->Required) { ?>
			elm = this.getElements("x" + infix + "_partno");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->partno->caption(), $datasheets->partno->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->dataSheetFile->Required) { ?>
			felm = this.getElements("x" + infix + "_dataSheetFile");
			elm = this.getElements("fn_x" + infix + "_dataSheetFile");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $datasheets->dataSheetFile->caption(), $datasheets->dataSheetFile->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->manufacturer->Required) { ?>
			elm = this.getElements("x" + infix + "_manufacturer");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->manufacturer->caption(), $datasheets->manufacturer->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->cddFile->Required) { ?>
			felm = this.getElements("x" + infix + "_cddFile");
			elm = this.getElements("fn_x" + infix + "_cddFile");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $datasheets->cddFile->caption(), $datasheets->cddFile->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->thirdPartyFile->Required) { ?>
			felm = this.getElements("x" + infix + "_thirdPartyFile");
			elm = this.getElements("fn_x" + infix + "_thirdPartyFile");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $datasheets->thirdPartyFile->caption(), $datasheets->thirdPartyFile->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->tittle->Required) { ?>
			elm = this.getElements("x" + infix + "_tittle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->tittle->caption(), $datasheets->tittle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->cover->Required) { ?>
			felm = this.getElements("x" + infix + "_cover");
			elm = this.getElements("fn_x" + infix + "_cover");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $datasheets->cover->caption(), $datasheets->cover->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->cddissue->Required) { ?>
			elm = this.getElements("x" + infix + "_cddissue");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->cddissue->caption(), $datasheets->cddissue->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_cddissue");
			if (elm && !ew.checkDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($datasheets->cddissue->errorMessage()) ?>");
		<?php if ($datasheets_add->cddno->Required) { ?>
			elm = this.getElements("x" + infix + "_cddno");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->cddno->caption(), $datasheets->cddno->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->thirdPartyNo->Required) { ?>
			elm = this.getElements("x" + infix + "_thirdPartyNo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->thirdPartyNo->caption(), $datasheets->thirdPartyNo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->duration->Required) { ?>
			elm = this.getElements("x" + infix + "_duration");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->duration->caption(), $datasheets->duration->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->expirydt->Required) { ?>
			elm = this.getElements("x" + infix + "_expirydt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->expirydt->caption(), $datasheets->expirydt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_expirydt");
			if (elm && !ew.checkDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($datasheets->expirydt->errorMessage()) ?>");
		<?php if ($datasheets_add->highlighted->Required) { ?>
			elm = this.getElements("x" + infix + "_highlighted");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->highlighted->caption(), $datasheets->highlighted->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->coo->Required) { ?>
			elm = this.getElements("x" + infix + "_coo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->coo->caption(), $datasheets->coo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->hssCode->Required) { ?>
			elm = this.getElements("x" + infix + "_hssCode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->hssCode->caption(), $datasheets->hssCode->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->systrade->Required) { ?>
			elm = this.getElements("x" + infix + "_systrade");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->systrade->caption(), $datasheets->systrade->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->isdatasheet->Required) { ?>
			elm = this.getElements("x" + infix + "_isdatasheet");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->isdatasheet->caption(), $datasheets->isdatasheet->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->cddrenewal_required->Required) { ?>
			elm = this.getElements("x" + infix + "_cddrenewal_required");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->cddrenewal_required->caption(), $datasheets->cddrenewal_required->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($datasheets_add->nativeFiles->Required) { ?>
			elm = this.getElements("x" + infix + "_nativeFiles");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->nativeFiles->caption(), $datasheets->nativeFiles->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fdatasheetsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdatasheetsadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Multi-Page
fdatasheetsadd.multiPage = new ew.MultiPage("fdatasheetsadd");

// Dynamic selection lists
fdatasheetsadd.lists["x_manufacturer"] = <?php echo $datasheets_add->manufacturer->Lookup->toClientList() ?>;
fdatasheetsadd.lists["x_manufacturer"].options = <?php echo JsonEncode($datasheets_add->manufacturer->lookupOptions()) ?>;
fdatasheetsadd.autoSuggests["x_manufacturer"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdatasheetsadd.lists["x_duration"] = <?php echo $datasheets_add->duration->Lookup->toClientList() ?>;
fdatasheetsadd.lists["x_duration"].options = <?php echo JsonEncode($datasheets_add->duration->options(FALSE, TRUE)) ?>;
fdatasheetsadd.lists["x_highlighted"] = <?php echo $datasheets_add->highlighted->Lookup->toClientList() ?>;
fdatasheetsadd.lists["x_highlighted"].options = <?php echo JsonEncode($datasheets_add->highlighted->options(FALSE, TRUE)) ?>;
fdatasheetsadd.lists["x_coo"] = <?php echo $datasheets_add->coo->Lookup->toClientList() ?>;
fdatasheetsadd.lists["x_coo"].options = <?php echo JsonEncode($datasheets_add->coo->lookupOptions()) ?>;
fdatasheetsadd.autoSuggests["x_coo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdatasheetsadd.lists["x_systrade"] = <?php echo $datasheets_add->systrade->Lookup->toClientList() ?>;
fdatasheetsadd.lists["x_systrade"].options = <?php echo JsonEncode($datasheets_add->systrade->options(FALSE, TRUE)) ?>;
fdatasheetsadd.lists["x_isdatasheet"] = <?php echo $datasheets_add->isdatasheet->Lookup->toClientList() ?>;
fdatasheetsadd.lists["x_isdatasheet"].options = <?php echo JsonEncode($datasheets_add->isdatasheet->options(FALSE, TRUE)) ?>;
fdatasheetsadd.lists["x_cddrenewal_required"] = <?php echo $datasheets_add->cddrenewal_required->Lookup->toClientList() ?>;
fdatasheetsadd.lists["x_cddrenewal_required"].options = <?php echo JsonEncode($datasheets_add->cddrenewal_required->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $datasheets_add->showPageHeader(); ?>
<?php
$datasheets_add->showMessage();
?>
<form name="fdatasheetsadd" id="fdatasheetsadd" class="<?php echo $datasheets_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($datasheets_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $datasheets_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="datasheets">
<?php if ($datasheets->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$datasheets_add->IsModal ?>">
<?php if (!$datasheets_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($datasheets_add->MultiPages->Items[0]->Visible) { ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page0 -->
<?php } else { ?>
<table id="tbl_datasheetsadd0" class="table table-striped table-sm ew-desktop-table"><!-- page0 table -->
<?php } ?>
<?php if ($datasheets->partno->Visible) { // partno ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_partno" class="form-group row">
		<label id="elh_datasheets_partno" for="x_partno" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->partno->caption() ?><?php echo ($datasheets->partno->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->partno->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_partno">
<input type="text" data-table="datasheets" data-field="x_partno" data-page="0" name="x_partno" id="x_partno" size="30" placeholder="<?php echo HtmlEncode($datasheets->partno->getPlaceHolder()) ?>" value="<?php echo $datasheets->partno->EditValue ?>"<?php echo $datasheets->partno->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_datasheets_partno">
<span<?php echo $datasheets->partno->viewAttributes() ?>>
<?php if ((!EmptyString($datasheets->partno->ViewValue)) && $datasheets->partno->linkAttributes() <> "") { ?>
<a<?php echo $datasheets->partno->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->partno->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->partno->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_partno" data-page="0" name="x_partno" id="x_partno" value="<?php echo HtmlEncode($datasheets->partno->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->partno->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_partno">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_partno"><?php echo $datasheets->partno->caption() ?><?php echo ($datasheets->partno->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->partno->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_partno">
<input type="text" data-table="datasheets" data-field="x_partno" data-page="0" name="x_partno" id="x_partno" size="30" placeholder="<?php echo HtmlEncode($datasheets->partno->getPlaceHolder()) ?>" value="<?php echo $datasheets->partno->EditValue ?>"<?php echo $datasheets->partno->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_datasheets_partno">
<span<?php echo $datasheets->partno->viewAttributes() ?>>
<?php if ((!EmptyString($datasheets->partno->ViewValue)) && $datasheets->partno->linkAttributes() <> "") { ?>
<a<?php echo $datasheets->partno->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->partno->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->partno->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_partno" data-page="0" name="x_partno" id="x_partno" value="<?php echo HtmlEncode($datasheets->partno->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->partno->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->manufacturer->Visible) { // manufacturer ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_manufacturer" class="form-group row">
		<label id="elh_datasheets_manufacturer" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->manufacturer->caption() ?><?php echo ($datasheets->manufacturer->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->manufacturer->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_manufacturer">
<?php
$wrkonchange = "" . trim(@$datasheets->manufacturer->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->manufacturer->EditAttrs["onchange"] = "";
?>
<span id="as_x_manufacturer" class="text-nowrap" style="z-index: 8960">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_manufacturer" id="sv_x_manufacturer" value="<?php echo RemoveHtml($datasheets->manufacturer->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->manufacturer->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->manufacturer->getPlaceHolder()) ?>"<?php echo $datasheets->manufacturer->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($datasheets->manufacturer->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_manufacturer',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($datasheets->manufacturer->ReadOnly || $datasheets->manufacturer->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "manufacturer") && !$datasheets->manufacturer->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_manufacturer" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $datasheets->manufacturer->caption() ?>" data-title="<?php echo $datasheets->manufacturer->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_manufacturer',url:'manufactureraddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" data-page="0" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $datasheets->manufacturer->displayValueSeparatorAttribute() ?>" name="x_manufacturer" id="x_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetsadd.createAutoSuggest({"id":"x_manufacturer","forceSelect":true});
</script>
<?php echo $datasheets->manufacturer->Lookup->getParamTag("p_x_manufacturer") ?>
</span>
<?php } else { ?>
<span id="el_datasheets_manufacturer">
<span<?php echo $datasheets->manufacturer->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->manufacturer->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" data-page="0" name="x_manufacturer" id="x_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->manufacturer->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_manufacturer">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_manufacturer"><?php echo $datasheets->manufacturer->caption() ?><?php echo ($datasheets->manufacturer->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->manufacturer->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_manufacturer">
<?php
$wrkonchange = "" . trim(@$datasheets->manufacturer->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->manufacturer->EditAttrs["onchange"] = "";
?>
<span id="as_x_manufacturer" class="text-nowrap" style="z-index: 8960">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="sv_x_manufacturer" id="sv_x_manufacturer" value="<?php echo RemoveHtml($datasheets->manufacturer->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->manufacturer->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->manufacturer->getPlaceHolder()) ?>"<?php echo $datasheets->manufacturer->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($datasheets->manufacturer->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_manufacturer',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo (($datasheets->manufacturer->ReadOnly || $datasheets->manufacturer->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
<?php if (AllowAdd(CurrentProjectID() . "manufacturer") && !$datasheets->manufacturer->ReadOnly) { ?>
<button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_manufacturer" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $datasheets->manufacturer->caption() ?>" data-title="<?php echo $datasheets->manufacturer->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_manufacturer',url:'manufactureraddopt.php'});"><i class="fa fa-plus ew-icon"></i></button>
<?php } ?>
		</div>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" data-page="0" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $datasheets->manufacturer->displayValueSeparatorAttribute() ?>" name="x_manufacturer" id="x_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetsadd.createAutoSuggest({"id":"x_manufacturer","forceSelect":true});
</script>
<?php echo $datasheets->manufacturer->Lookup->getParamTag("p_x_manufacturer") ?>
</span>
<?php } else { ?>
<span id="el_datasheets_manufacturer">
<span<?php echo $datasheets->manufacturer->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->manufacturer->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" data-page="0" name="x_manufacturer" id="x_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->manufacturer->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->tittle->Visible) { // tittle ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_tittle" class="form-group row">
		<label id="elh_datasheets_tittle" for="x_tittle" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->tittle->caption() ?><?php echo ($datasheets->tittle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->tittle->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_tittle">
<textarea data-table="datasheets" data-field="x_tittle" data-page="0" name="x_tittle" id="x_tittle" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->tittle->getPlaceHolder()) ?>"<?php echo $datasheets->tittle->editAttributes() ?>><?php echo $datasheets->tittle->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_datasheets_tittle">
<span<?php echo $datasheets->tittle->viewAttributes() ?>>
<?php echo $datasheets->tittle->ViewValue ?></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_tittle" data-page="0" name="x_tittle" id="x_tittle" value="<?php echo HtmlEncode($datasheets->tittle->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->tittle->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tittle">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_tittle"><?php echo $datasheets->tittle->caption() ?><?php echo ($datasheets->tittle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->tittle->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_tittle">
<textarea data-table="datasheets" data-field="x_tittle" data-page="0" name="x_tittle" id="x_tittle" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->tittle->getPlaceHolder()) ?>"<?php echo $datasheets->tittle->editAttributes() ?>><?php echo $datasheets->tittle->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_datasheets_tittle">
<span<?php echo $datasheets->tittle->viewAttributes() ?>>
<?php echo $datasheets->tittle->ViewValue ?></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_tittle" data-page="0" name="x_tittle" id="x_tittle" value="<?php echo HtmlEncode($datasheets->tittle->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->tittle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
</div><!-- /page0 -->
<?php } else { ?>
</table><!-- /page0 table -->
<?php } ?>
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="datasheets_add"><!-- multi-page tabs -->
	<ul class="<?php echo $datasheets_add->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $datasheets_add->MultiPages->pageStyle("1") ?>" href="#tab_datasheets1" data-toggle="tab"><?php echo $datasheets->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $datasheets_add->MultiPages->pageStyle("2") ?>" href="#tab_datasheets2" data-toggle="tab"><?php echo $datasheets->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $datasheets_add->MultiPages->pageStyle("1") ?>" id="tab_datasheets1"><!-- multi-page .tab-pane -->
<?php if ($datasheets_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_datasheetsadd1" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($datasheets->cddissue->Visible) { // cddissue ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_cddissue" class="form-group row">
		<label id="elh_datasheets_cddissue" for="x_cddissue" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->cddissue->caption() ?><?php echo ($datasheets->cddissue->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->cddissue->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_cddissue">
<input type="text" data-table="datasheets" data-field="x_cddissue" data-page="1" data-format="5" name="x_cddissue" id="x_cddissue" placeholder="<?php echo HtmlEncode($datasheets->cddissue->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddissue->EditValue ?>"<?php echo $datasheets->cddissue->editAttributes() ?>>
<?php if (!$datasheets->cddissue->ReadOnly && !$datasheets->cddissue->Disabled && !isset($datasheets->cddissue->EditAttrs["readonly"]) && !isset($datasheets->cddissue->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetsadd", "x_cddissue", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_datasheets_cddissue">
<span<?php echo $datasheets->cddissue->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->cddissue->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddissue" data-page="1" name="x_cddissue" id="x_cddissue" value="<?php echo HtmlEncode($datasheets->cddissue->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->cddissue->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cddissue">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_cddissue"><?php echo $datasheets->cddissue->caption() ?><?php echo ($datasheets->cddissue->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->cddissue->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_cddissue">
<input type="text" data-table="datasheets" data-field="x_cddissue" data-page="1" data-format="5" name="x_cddissue" id="x_cddissue" placeholder="<?php echo HtmlEncode($datasheets->cddissue->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddissue->EditValue ?>"<?php echo $datasheets->cddissue->editAttributes() ?>>
<?php if (!$datasheets->cddissue->ReadOnly && !$datasheets->cddissue->Disabled && !isset($datasheets->cddissue->EditAttrs["readonly"]) && !isset($datasheets->cddissue->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetsadd", "x_cddissue", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_datasheets_cddissue">
<span<?php echo $datasheets->cddissue->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->cddissue->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddissue" data-page="1" name="x_cddissue" id="x_cddissue" value="<?php echo HtmlEncode($datasheets->cddissue->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->cddissue->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->cddno->Visible) { // cddno ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_cddno" class="form-group row">
		<label id="elh_datasheets_cddno" for="x_cddno" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->cddno->caption() ?><?php echo ($datasheets->cddno->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->cddno->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_cddno">
<input type="text" data-table="datasheets" data-field="x_cddno" data-page="1" name="x_cddno" id="x_cddno" size="30" placeholder="<?php echo HtmlEncode($datasheets->cddno->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddno->EditValue ?>"<?php echo $datasheets->cddno->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_datasheets_cddno">
<span<?php echo $datasheets->cddno->viewAttributes() ?>>
<?php if ((!EmptyString($datasheets->cddno->ViewValue)) && $datasheets->cddno->linkAttributes() <> "") { ?>
<a<?php echo $datasheets->cddno->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->cddno->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->cddno->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddno" data-page="1" name="x_cddno" id="x_cddno" value="<?php echo HtmlEncode($datasheets->cddno->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->cddno->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cddno">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_cddno"><?php echo $datasheets->cddno->caption() ?><?php echo ($datasheets->cddno->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->cddno->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_cddno">
<input type="text" data-table="datasheets" data-field="x_cddno" data-page="1" name="x_cddno" id="x_cddno" size="30" placeholder="<?php echo HtmlEncode($datasheets->cddno->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddno->EditValue ?>"<?php echo $datasheets->cddno->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_datasheets_cddno">
<span<?php echo $datasheets->cddno->viewAttributes() ?>>
<?php if ((!EmptyString($datasheets->cddno->ViewValue)) && $datasheets->cddno->linkAttributes() <> "") { ?>
<a<?php echo $datasheets->cddno->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->cddno->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->cddno->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddno" data-page="1" name="x_cddno" id="x_cddno" value="<?php echo HtmlEncode($datasheets->cddno->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->cddno->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->thirdPartyNo->Visible) { // thirdPartyNo ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_thirdPartyNo" class="form-group row">
		<label id="elh_datasheets_thirdPartyNo" for="x_thirdPartyNo" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->thirdPartyNo->caption() ?><?php echo ($datasheets->thirdPartyNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->thirdPartyNo->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_thirdPartyNo">
<input type="text" data-table="datasheets" data-field="x_thirdPartyNo" data-page="1" name="x_thirdPartyNo" id="x_thirdPartyNo" size="30" placeholder="<?php echo HtmlEncode($datasheets->thirdPartyNo->getPlaceHolder()) ?>" value="<?php echo $datasheets->thirdPartyNo->EditValue ?>"<?php echo $datasheets->thirdPartyNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_datasheets_thirdPartyNo">
<span<?php echo $datasheets->thirdPartyNo->viewAttributes() ?>>
<?php if ((!EmptyString($datasheets->thirdPartyNo->ViewValue)) && $datasheets->thirdPartyNo->linkAttributes() <> "") { ?>
<a<?php echo $datasheets->thirdPartyNo->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->thirdPartyNo->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->thirdPartyNo->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_thirdPartyNo" data-page="1" name="x_thirdPartyNo" id="x_thirdPartyNo" value="<?php echo HtmlEncode($datasheets->thirdPartyNo->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->thirdPartyNo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_thirdPartyNo">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_thirdPartyNo"><?php echo $datasheets->thirdPartyNo->caption() ?><?php echo ($datasheets->thirdPartyNo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->thirdPartyNo->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_thirdPartyNo">
<input type="text" data-table="datasheets" data-field="x_thirdPartyNo" data-page="1" name="x_thirdPartyNo" id="x_thirdPartyNo" size="30" placeholder="<?php echo HtmlEncode($datasheets->thirdPartyNo->getPlaceHolder()) ?>" value="<?php echo $datasheets->thirdPartyNo->EditValue ?>"<?php echo $datasheets->thirdPartyNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_datasheets_thirdPartyNo">
<span<?php echo $datasheets->thirdPartyNo->viewAttributes() ?>>
<?php if ((!EmptyString($datasheets->thirdPartyNo->ViewValue)) && $datasheets->thirdPartyNo->linkAttributes() <> "") { ?>
<a<?php echo $datasheets->thirdPartyNo->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->thirdPartyNo->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->thirdPartyNo->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_thirdPartyNo" data-page="1" name="x_thirdPartyNo" id="x_thirdPartyNo" value="<?php echo HtmlEncode($datasheets->thirdPartyNo->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->thirdPartyNo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->duration->Visible) { // duration ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_duration" class="form-group row">
		<label id="elh_datasheets_duration" for="x_duration" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->duration->caption() ?><?php echo ($datasheets->duration->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->duration->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_duration">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="datasheets" data-field="x_duration" data-page="1" data-value-separator="<?php echo $datasheets->duration->displayValueSeparatorAttribute() ?>" id="x_duration" name="x_duration"<?php echo $datasheets->duration->editAttributes() ?>>
		<?php echo $datasheets->duration->selectOptionListHtml("x_duration") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el_datasheets_duration">
<span<?php echo $datasheets->duration->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->duration->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_duration" data-page="1" name="x_duration" id="x_duration" value="<?php echo HtmlEncode($datasheets->duration->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->duration->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_duration">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_duration"><?php echo $datasheets->duration->caption() ?><?php echo ($datasheets->duration->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->duration->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_duration">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="datasheets" data-field="x_duration" data-page="1" data-value-separator="<?php echo $datasheets->duration->displayValueSeparatorAttribute() ?>" id="x_duration" name="x_duration"<?php echo $datasheets->duration->editAttributes() ?>>
		<?php echo $datasheets->duration->selectOptionListHtml("x_duration") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el_datasheets_duration">
<span<?php echo $datasheets->duration->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->duration->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_duration" data-page="1" name="x_duration" id="x_duration" value="<?php echo HtmlEncode($datasheets->duration->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->duration->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->expirydt->Visible) { // expirydt ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_expirydt" class="form-group row">
		<label id="elh_datasheets_expirydt" for="x_expirydt" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->expirydt->caption() ?><?php echo ($datasheets->expirydt->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->expirydt->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_expirydt">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-page="1" data-format="5" name="x_expirydt" id="x_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetsadd", "x_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_datasheets_expirydt">
<span<?php echo $datasheets->expirydt->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->expirydt->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_expirydt" data-page="1" name="x_expirydt" id="x_expirydt" value="<?php echo HtmlEncode($datasheets->expirydt->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->expirydt->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_expirydt">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_expirydt"><?php echo $datasheets->expirydt->caption() ?><?php echo ($datasheets->expirydt->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->expirydt->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_expirydt">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-page="1" data-format="5" name="x_expirydt" id="x_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetsadd", "x_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_datasheets_expirydt">
<span<?php echo $datasheets->expirydt->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->expirydt->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_expirydt" data-page="1" name="x_expirydt" id="x_expirydt" value="<?php echo HtmlEncode($datasheets->expirydt->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->expirydt->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->highlighted->Visible) { // highlighted ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_highlighted" class="form-group row">
		<label id="elh_datasheets_highlighted" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->highlighted->caption() ?><?php echo ($datasheets->highlighted->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->highlighted->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_highlighted">
<div id="tp_x_highlighted" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_highlighted" data-page="1" data-value-separator="<?php echo $datasheets->highlighted->displayValueSeparatorAttribute() ?>" name="x_highlighted" id="x_highlighted" value="{value}"<?php echo $datasheets->highlighted->editAttributes() ?>></div>
<div id="dsl_x_highlighted" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->highlighted->radioButtonListHtml(FALSE, "x_highlighted", 1) ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_datasheets_highlighted">
<span<?php echo $datasheets->highlighted->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->highlighted->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_highlighted" data-page="1" name="x_highlighted" id="x_highlighted" value="<?php echo HtmlEncode($datasheets->highlighted->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->highlighted->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_highlighted">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_highlighted"><?php echo $datasheets->highlighted->caption() ?><?php echo ($datasheets->highlighted->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->highlighted->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_highlighted">
<div id="tp_x_highlighted" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_highlighted" data-page="1" data-value-separator="<?php echo $datasheets->highlighted->displayValueSeparatorAttribute() ?>" name="x_highlighted" id="x_highlighted" value="{value}"<?php echo $datasheets->highlighted->editAttributes() ?>></div>
<div id="dsl_x_highlighted" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->highlighted->radioButtonListHtml(FALSE, "x_highlighted", 1) ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_datasheets_highlighted">
<span<?php echo $datasheets->highlighted->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->highlighted->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_highlighted" data-page="1" name="x_highlighted" id="x_highlighted" value="<?php echo HtmlEncode($datasheets->highlighted->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->highlighted->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->coo->Visible) { // coo ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_coo" class="form-group row">
		<label id="elh_datasheets_coo" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->coo->caption() ?><?php echo ($datasheets->coo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->coo->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_coo">
<?php
$wrkonchange = "" . trim(@$datasheets->coo->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->coo->EditAttrs["onchange"] = "";
?>
<span id="as_x_coo" class="text-nowrap" style="z-index: 8850">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_coo" id="sv_x_coo" value="<?php echo RemoveHtml($datasheets->coo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>"<?php echo $datasheets->coo->editAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "countryOfOrigin") && !$datasheets->coo->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_coo" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $datasheets->coo->caption() ?>" data-title="<?php echo $datasheets->coo->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_coo',url:'countryOfOriginaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_coo" data-page="1" data-value-separator="<?php echo $datasheets->coo->displayValueSeparatorAttribute() ?>" name="x_coo" id="x_coo" value="<?php echo HtmlEncode($datasheets->coo->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetsadd.createAutoSuggest({"id":"x_coo","forceSelect":false});
</script>
<?php echo $datasheets->coo->Lookup->getParamTag("p_x_coo") ?>
</span>
<?php } else { ?>
<span id="el_datasheets_coo">
<span<?php echo $datasheets->coo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->coo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_coo" data-page="1" name="x_coo" id="x_coo" value="<?php echo HtmlEncode($datasheets->coo->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->coo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_coo">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_coo"><?php echo $datasheets->coo->caption() ?><?php echo ($datasheets->coo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->coo->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_coo">
<?php
$wrkonchange = "" . trim(@$datasheets->coo->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->coo->EditAttrs["onchange"] = "";
?>
<span id="as_x_coo" class="text-nowrap" style="z-index: 8850">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_coo" id="sv_x_coo" value="<?php echo RemoveHtml($datasheets->coo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>"<?php echo $datasheets->coo->editAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "countryOfOrigin") && !$datasheets->coo->ReadOnly) { ?>
<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x_coo" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $datasheets->coo->caption() ?>" data-title="<?php echo $datasheets->coo->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x_coo',url:'countryOfOriginaddopt.php'});"><i class="fa fa-plus ew-icon"></i></button></div>
<?php } ?>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_coo" data-page="1" data-value-separator="<?php echo $datasheets->coo->displayValueSeparatorAttribute() ?>" name="x_coo" id="x_coo" value="<?php echo HtmlEncode($datasheets->coo->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetsadd.createAutoSuggest({"id":"x_coo","forceSelect":false});
</script>
<?php echo $datasheets->coo->Lookup->getParamTag("p_x_coo") ?>
</span>
<?php } else { ?>
<span id="el_datasheets_coo">
<span<?php echo $datasheets->coo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->coo->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_coo" data-page="1" name="x_coo" id="x_coo" value="<?php echo HtmlEncode($datasheets->coo->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->coo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->hssCode->Visible) { // hssCode ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_hssCode" class="form-group row">
		<label id="elh_datasheets_hssCode" for="x_hssCode" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->hssCode->caption() ?><?php echo ($datasheets->hssCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->hssCode->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_hssCode">
<input type="text" data-table="datasheets" data-field="x_hssCode" data-page="1" name="x_hssCode" id="x_hssCode" size="30" placeholder="<?php echo HtmlEncode($datasheets->hssCode->getPlaceHolder()) ?>" value="<?php echo $datasheets->hssCode->EditValue ?>"<?php echo $datasheets->hssCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_datasheets_hssCode">
<span<?php echo $datasheets->hssCode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->hssCode->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_hssCode" data-page="1" name="x_hssCode" id="x_hssCode" value="<?php echo HtmlEncode($datasheets->hssCode->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->hssCode->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_hssCode">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_hssCode"><?php echo $datasheets->hssCode->caption() ?><?php echo ($datasheets->hssCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->hssCode->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_hssCode">
<input type="text" data-table="datasheets" data-field="x_hssCode" data-page="1" name="x_hssCode" id="x_hssCode" size="30" placeholder="<?php echo HtmlEncode($datasheets->hssCode->getPlaceHolder()) ?>" value="<?php echo $datasheets->hssCode->EditValue ?>"<?php echo $datasheets->hssCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_datasheets_hssCode">
<span<?php echo $datasheets->hssCode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->hssCode->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_hssCode" data-page="1" name="x_hssCode" id="x_hssCode" value="<?php echo HtmlEncode($datasheets->hssCode->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->hssCode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->systrade->Visible) { // systrade ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_systrade" class="form-group row">
		<label id="elh_datasheets_systrade" for="x_systrade" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->systrade->caption() ?><?php echo ($datasheets->systrade->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->systrade->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_systrade">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($datasheets->systrade->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $datasheets->systrade->ViewValue ?></button>
		<div id="dsl_x_systrade" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $datasheets->systrade->radioButtonListHtml(TRUE, "x_systrade", 1) ?>
			</div><!-- /.ew-items ##-->
		</div><!-- /.dropdown-menu ##-->
		<div id="tp_x_systrade" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_systrade" data-page="1" data-value-separator="<?php echo $datasheets->systrade->displayValueSeparatorAttribute() ?>" name="x_systrade" id="x_systrade" value="{value}"<?php echo $datasheets->systrade->editAttributes() ?>></div>
	</div><!-- /.btn-group ##-->
	<?php if (!$datasheets->systrade->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fa fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list ##-->
</span>
<?php } else { ?>
<span id="el_datasheets_systrade">
<span<?php echo $datasheets->systrade->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->systrade->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_systrade" data-page="1" name="x_systrade" id="x_systrade" value="<?php echo HtmlEncode($datasheets->systrade->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->systrade->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_systrade">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_systrade"><?php echo $datasheets->systrade->caption() ?><?php echo ($datasheets->systrade->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->systrade->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_systrade">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($datasheets->systrade->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $datasheets->systrade->ViewValue ?></button>
		<div id="dsl_x_systrade" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $datasheets->systrade->radioButtonListHtml(TRUE, "x_systrade", 1) ?>
			</div><!-- /.ew-items ##-->
		</div><!-- /.dropdown-menu ##-->
		<div id="tp_x_systrade" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_systrade" data-page="1" data-value-separator="<?php echo $datasheets->systrade->displayValueSeparatorAttribute() ?>" name="x_systrade" id="x_systrade" value="{value}"<?php echo $datasheets->systrade->editAttributes() ?>></div>
	</div><!-- /.btn-group ##-->
	<?php if (!$datasheets->systrade->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fa fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list ##-->
</span>
<?php } else { ?>
<span id="el_datasheets_systrade">
<span<?php echo $datasheets->systrade->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->systrade->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_systrade" data-page="1" name="x_systrade" id="x_systrade" value="<?php echo HtmlEncode($datasheets->systrade->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->systrade->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $datasheets_add->MultiPages->pageStyle("2") ?>" id="tab_datasheets2"><!-- multi-page .tab-pane -->
<?php if ($datasheets_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_datasheetsadd2" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($datasheets->dataSheetFile->Visible) { // dataSheetFile ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_dataSheetFile" class="form-group row">
		<label id="elh_datasheets_dataSheetFile" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->dataSheetFile->caption() ?><?php echo ($datasheets->dataSheetFile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->dataSheetFile->cellAttributes() ?>>
<span id="el_datasheets_dataSheetFile">
<div id="fd_x_dataSheetFile">
<span title="<?php echo $datasheets->dataSheetFile->title() ? $datasheets->dataSheetFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->dataSheetFile->ReadOnly || $datasheets->dataSheetFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_dataSheetFile" data-page="2" name="x_dataSheetFile" id="x_dataSheetFile"<?php echo $datasheets->dataSheetFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_dataSheetFile" id= "fn_x_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->Upload->FileName ?>">
<input type="hidden" name="fa_x_dataSheetFile" id= "fa_x_dataSheetFile" value="0">
<input type="hidden" name="fs_x_dataSheetFile" id= "fs_x_dataSheetFile" value="0">
<input type="hidden" name="fx_x_dataSheetFile" id= "fx_x_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_dataSheetFile" id= "fm_x_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x_dataSheetFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $datasheets->dataSheetFile->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_dataSheetFile">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_dataSheetFile"><?php echo $datasheets->dataSheetFile->caption() ?><?php echo ($datasheets->dataSheetFile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->dataSheetFile->cellAttributes() ?>>
<span id="el_datasheets_dataSheetFile">
<div id="fd_x_dataSheetFile">
<span title="<?php echo $datasheets->dataSheetFile->title() ? $datasheets->dataSheetFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->dataSheetFile->ReadOnly || $datasheets->dataSheetFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_dataSheetFile" data-page="2" name="x_dataSheetFile" id="x_dataSheetFile"<?php echo $datasheets->dataSheetFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_dataSheetFile" id= "fn_x_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->Upload->FileName ?>">
<input type="hidden" name="fa_x_dataSheetFile" id= "fa_x_dataSheetFile" value="0">
<input type="hidden" name="fs_x_dataSheetFile" id= "fs_x_dataSheetFile" value="0">
<input type="hidden" name="fx_x_dataSheetFile" id= "fx_x_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_dataSheetFile" id= "fm_x_dataSheetFile" value="<?php echo $datasheets->dataSheetFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x_dataSheetFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $datasheets->dataSheetFile->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->cddFile->Visible) { // cddFile ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_cddFile" class="form-group row">
		<label id="elh_datasheets_cddFile" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->cddFile->caption() ?><?php echo ($datasheets->cddFile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->cddFile->cellAttributes() ?>>
<span id="el_datasheets_cddFile">
<div id="fd_x_cddFile">
<span title="<?php echo $datasheets->cddFile->title() ? $datasheets->cddFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cddFile->ReadOnly || $datasheets->cddFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cddFile" data-page="2" name="x_cddFile" id="x_cddFile"<?php echo $datasheets->cddFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_cddFile" id= "fn_x_cddFile" value="<?php echo $datasheets->cddFile->Upload->FileName ?>">
<input type="hidden" name="fa_x_cddFile" id= "fa_x_cddFile" value="0">
<input type="hidden" name="fs_x_cddFile" id= "fs_x_cddFile" value="0">
<input type="hidden" name="fx_x_cddFile" id= "fx_x_cddFile" value="<?php echo $datasheets->cddFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_cddFile" id= "fm_x_cddFile" value="<?php echo $datasheets->cddFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x_cddFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $datasheets->cddFile->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cddFile">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_cddFile"><?php echo $datasheets->cddFile->caption() ?><?php echo ($datasheets->cddFile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->cddFile->cellAttributes() ?>>
<span id="el_datasheets_cddFile">
<div id="fd_x_cddFile">
<span title="<?php echo $datasheets->cddFile->title() ? $datasheets->cddFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cddFile->ReadOnly || $datasheets->cddFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cddFile" data-page="2" name="x_cddFile" id="x_cddFile"<?php echo $datasheets->cddFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_cddFile" id= "fn_x_cddFile" value="<?php echo $datasheets->cddFile->Upload->FileName ?>">
<input type="hidden" name="fa_x_cddFile" id= "fa_x_cddFile" value="0">
<input type="hidden" name="fs_x_cddFile" id= "fs_x_cddFile" value="0">
<input type="hidden" name="fx_x_cddFile" id= "fx_x_cddFile" value="<?php echo $datasheets->cddFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_cddFile" id= "fm_x_cddFile" value="<?php echo $datasheets->cddFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x_cddFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $datasheets->cddFile->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->thirdPartyFile->Visible) { // thirdPartyFile ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_thirdPartyFile" class="form-group row">
		<label id="elh_datasheets_thirdPartyFile" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->thirdPartyFile->caption() ?><?php echo ($datasheets->thirdPartyFile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->thirdPartyFile->cellAttributes() ?>>
<span id="el_datasheets_thirdPartyFile">
<div id="fd_x_thirdPartyFile">
<span title="<?php echo $datasheets->thirdPartyFile->title() ? $datasheets->thirdPartyFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->thirdPartyFile->ReadOnly || $datasheets->thirdPartyFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_thirdPartyFile" data-page="2" name="x_thirdPartyFile" id="x_thirdPartyFile"<?php echo $datasheets->thirdPartyFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_thirdPartyFile" id= "fn_x_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->Upload->FileName ?>">
<input type="hidden" name="fa_x_thirdPartyFile" id= "fa_x_thirdPartyFile" value="0">
<input type="hidden" name="fs_x_thirdPartyFile" id= "fs_x_thirdPartyFile" value="0">
<input type="hidden" name="fx_x_thirdPartyFile" id= "fx_x_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_thirdPartyFile" id= "fm_x_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x_thirdPartyFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $datasheets->thirdPartyFile->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_thirdPartyFile">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_thirdPartyFile"><?php echo $datasheets->thirdPartyFile->caption() ?><?php echo ($datasheets->thirdPartyFile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->thirdPartyFile->cellAttributes() ?>>
<span id="el_datasheets_thirdPartyFile">
<div id="fd_x_thirdPartyFile">
<span title="<?php echo $datasheets->thirdPartyFile->title() ? $datasheets->thirdPartyFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->thirdPartyFile->ReadOnly || $datasheets->thirdPartyFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_thirdPartyFile" data-page="2" name="x_thirdPartyFile" id="x_thirdPartyFile"<?php echo $datasheets->thirdPartyFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_thirdPartyFile" id= "fn_x_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->Upload->FileName ?>">
<input type="hidden" name="fa_x_thirdPartyFile" id= "fa_x_thirdPartyFile" value="0">
<input type="hidden" name="fs_x_thirdPartyFile" id= "fs_x_thirdPartyFile" value="0">
<input type="hidden" name="fx_x_thirdPartyFile" id= "fx_x_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_thirdPartyFile" id= "fm_x_thirdPartyFile" value="<?php echo $datasheets->thirdPartyFile->UploadMaxFileSize ?>">
</div>
<table id="ft_x_thirdPartyFile" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $datasheets->thirdPartyFile->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->cover->Visible) { // cover ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_cover" class="form-group row">
		<label id="elh_datasheets_cover" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->cover->caption() ?><?php echo ($datasheets->cover->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->cover->cellAttributes() ?>>
<span id="el_datasheets_cover">
<div id="fd_x_cover">
<span title="<?php echo $datasheets->cover->title() ? $datasheets->cover->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cover->ReadOnly || $datasheets->cover->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cover" data-page="2" name="x_cover" id="x_cover"<?php echo $datasheets->cover->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_cover" id= "fn_x_cover" value="<?php echo $datasheets->cover->Upload->FileName ?>">
<input type="hidden" name="fa_x_cover" id= "fa_x_cover" value="0">
<input type="hidden" name="fs_x_cover" id= "fs_x_cover" value="0">
<input type="hidden" name="fx_x_cover" id= "fx_x_cover" value="<?php echo $datasheets->cover->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_cover" id= "fm_x_cover" value="<?php echo $datasheets->cover->UploadMaxFileSize ?>">
</div>
<table id="ft_x_cover" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $datasheets->cover->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cover">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_cover"><?php echo $datasheets->cover->caption() ?><?php echo ($datasheets->cover->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->cover->cellAttributes() ?>>
<span id="el_datasheets_cover">
<div id="fd_x_cover">
<span title="<?php echo $datasheets->cover->title() ? $datasheets->cover->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cover->ReadOnly || $datasheets->cover->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cover" data-page="2" name="x_cover" id="x_cover"<?php echo $datasheets->cover->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_cover" id= "fn_x_cover" value="<?php echo $datasheets->cover->Upload->FileName ?>">
<input type="hidden" name="fa_x_cover" id= "fa_x_cover" value="0">
<input type="hidden" name="fs_x_cover" id= "fs_x_cover" value="0">
<input type="hidden" name="fx_x_cover" id= "fx_x_cover" value="<?php echo $datasheets->cover->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_cover" id= "fm_x_cover" value="<?php echo $datasheets->cover->UploadMaxFileSize ?>">
</div>
<table id="ft_x_cover" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $datasheets->cover->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->isdatasheet->Visible) { // isdatasheet ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_isdatasheet" class="form-group row">
		<label id="elh_datasheets_isdatasheet" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->isdatasheet->caption() ?><?php echo ($datasheets->isdatasheet->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->isdatasheet->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_isdatasheet">
<div id="tp_x_isdatasheet" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_isdatasheet" data-page="2" data-value-separator="<?php echo $datasheets->isdatasheet->displayValueSeparatorAttribute() ?>" name="x_isdatasheet" id="x_isdatasheet" value="{value}"<?php echo $datasheets->isdatasheet->editAttributes() ?>></div>
<div id="dsl_x_isdatasheet" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->isdatasheet->radioButtonListHtml(FALSE, "x_isdatasheet", 2) ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_datasheets_isdatasheet">
<span<?php echo $datasheets->isdatasheet->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->isdatasheet->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_isdatasheet" data-page="2" name="x_isdatasheet" id="x_isdatasheet" value="<?php echo HtmlEncode($datasheets->isdatasheet->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->isdatasheet->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_isdatasheet">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_isdatasheet"><?php echo $datasheets->isdatasheet->caption() ?><?php echo ($datasheets->isdatasheet->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->isdatasheet->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_isdatasheet">
<div id="tp_x_isdatasheet" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_isdatasheet" data-page="2" data-value-separator="<?php echo $datasheets->isdatasheet->displayValueSeparatorAttribute() ?>" name="x_isdatasheet" id="x_isdatasheet" value="{value}"<?php echo $datasheets->isdatasheet->editAttributes() ?>></div>
<div id="dsl_x_isdatasheet" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->isdatasheet->radioButtonListHtml(FALSE, "x_isdatasheet", 2) ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_datasheets_isdatasheet">
<span<?php echo $datasheets->isdatasheet->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->isdatasheet->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_isdatasheet" data-page="2" name="x_isdatasheet" id="x_isdatasheet" value="<?php echo HtmlEncode($datasheets->isdatasheet->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->isdatasheet->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->cddrenewal_required->Visible) { // cddrenewal_required ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_cddrenewal_required" class="form-group row">
		<label id="elh_datasheets_cddrenewal_required" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->cddrenewal_required->caption() ?><?php echo ($datasheets->cddrenewal_required->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->cddrenewal_required->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_cddrenewal_required">
<div id="tp_x_cddrenewal_required" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_cddrenewal_required" data-page="2" data-value-separator="<?php echo $datasheets->cddrenewal_required->displayValueSeparatorAttribute() ?>" name="x_cddrenewal_required" id="x_cddrenewal_required" value="{value}"<?php echo $datasheets->cddrenewal_required->editAttributes() ?>></div>
<div id="dsl_x_cddrenewal_required" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->cddrenewal_required->radioButtonListHtml(FALSE, "x_cddrenewal_required", 2) ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_datasheets_cddrenewal_required">
<span<?php echo $datasheets->cddrenewal_required->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->cddrenewal_required->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddrenewal_required" data-page="2" name="x_cddrenewal_required" id="x_cddrenewal_required" value="<?php echo HtmlEncode($datasheets->cddrenewal_required->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->cddrenewal_required->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cddrenewal_required">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_cddrenewal_required"><?php echo $datasheets->cddrenewal_required->caption() ?><?php echo ($datasheets->cddrenewal_required->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->cddrenewal_required->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_cddrenewal_required">
<div id="tp_x_cddrenewal_required" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_cddrenewal_required" data-page="2" data-value-separator="<?php echo $datasheets->cddrenewal_required->displayValueSeparatorAttribute() ?>" name="x_cddrenewal_required" id="x_cddrenewal_required" value="{value}"<?php echo $datasheets->cddrenewal_required->editAttributes() ?>></div>
<div id="dsl_x_cddrenewal_required" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->cddrenewal_required->radioButtonListHtml(FALSE, "x_cddrenewal_required", 2) ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_datasheets_cddrenewal_required">
<span<?php echo $datasheets->cddrenewal_required->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->cddrenewal_required->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddrenewal_required" data-page="2" name="x_cddrenewal_required" id="x_cddrenewal_required" value="<?php echo HtmlEncode($datasheets->cddrenewal_required->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->cddrenewal_required->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->nativeFiles->Visible) { // nativeFiles ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
	<div id="r_nativeFiles" class="form-group row">
		<label id="elh_datasheets_nativeFiles" for="x_nativeFiles" class="<?php echo $datasheets_add->LeftColumnClass ?>"><?php echo $datasheets->nativeFiles->caption() ?><?php echo ($datasheets->nativeFiles->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $datasheets_add->RightColumnClass ?>"><div<?php echo $datasheets->nativeFiles->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_nativeFiles">
<textarea data-table="datasheets" data-field="x_nativeFiles" data-page="2" name="x_nativeFiles" id="x_nativeFiles" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->nativeFiles->getPlaceHolder()) ?>"<?php echo $datasheets->nativeFiles->editAttributes() ?>><?php echo $datasheets->nativeFiles->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_datasheets_nativeFiles">
<span<?php echo $datasheets->nativeFiles->viewAttributes() ?>>
<?php echo $datasheets->nativeFiles->ViewValue ?></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_nativeFiles" data-page="2" name="x_nativeFiles" id="x_nativeFiles" value="<?php echo HtmlEncode($datasheets->nativeFiles->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->nativeFiles->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_nativeFiles">
		<td class="<?php echo $datasheets_add->TableLeftColumnClass ?>"><span id="elh_datasheets_nativeFiles"><?php echo $datasheets->nativeFiles->caption() ?><?php echo ($datasheets->nativeFiles->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $datasheets->nativeFiles->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_nativeFiles">
<textarea data-table="datasheets" data-field="x_nativeFiles" data-page="2" name="x_nativeFiles" id="x_nativeFiles" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->nativeFiles->getPlaceHolder()) ?>"<?php echo $datasheets->nativeFiles->editAttributes() ?>><?php echo $datasheets->nativeFiles->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_datasheets_nativeFiles">
<span<?php echo $datasheets->nativeFiles->viewAttributes() ?>>
<?php echo $datasheets->nativeFiles->ViewValue ?></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_nativeFiles" data-page="2" name="x_nativeFiles" id="x_nativeFiles" value="<?php echo HtmlEncode($datasheets->nativeFiles->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->nativeFiles->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
<?php if (!$datasheets_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $datasheets_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$datasheets->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $datasheets_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$datasheets_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$datasheets_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$datasheets_add->terminate();
?>