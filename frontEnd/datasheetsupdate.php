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
$datasheets_update = new datasheets_update();

// Run the page
$datasheets_update->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$datasheets_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "update";
var fdatasheetsupdate = currentForm = new ew.Form("fdatasheetsupdate", "update");

// Validate form
fdatasheetsupdate.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	if (!ew.updateSelected(fobj)) {
		ew.alert(ew.language.phrase("NoFieldSelected"));
		return false;
	}
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($datasheets_update->manufacturer->Required) { ?>
			elm = this.getElements("x" + infix + "_manufacturer");
			uelm = this.getElements("u" + infix + "_manufacturer");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->manufacturer->caption(), $datasheets->manufacturer->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($datasheets_update->cddFile->Required) { ?>
			felm = this.getElements("x" + infix + "_cddFile");
			elm = this.getElements("fn_x" + infix + "_cddFile");
			uelm = this.getElements("u" + infix + "_cddFile");
			if (uelm && uelm.checked) {
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $datasheets->cddFile->caption(), $datasheets->cddFile->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($datasheets_update->cddissue->Required) { ?>
			elm = this.getElements("x" + infix + "_cddissue");
			uelm = this.getElements("u" + infix + "_cddissue");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->cddissue->caption(), $datasheets->cddissue->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
			elm = this.getElements("x" + infix + "_cddissue");
			uelm = this.getElements("u" + infix + "_cddissue");
			if (uelm && uelm.checked && elm && !ew.checkDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($datasheets->cddissue->errorMessage()) ?>");
		<?php if ($datasheets_update->cddno->Required) { ?>
			elm = this.getElements("x" + infix + "_cddno");
			uelm = this.getElements("u" + infix + "_cddno");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->cddno->caption(), $datasheets->cddno->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($datasheets_update->duration->Required) { ?>
			elm = this.getElements("x" + infix + "_duration");
			uelm = this.getElements("u" + infix + "_duration");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->duration->caption(), $datasheets->duration->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($datasheets_update->expirydt->Required) { ?>
			elm = this.getElements("x" + infix + "_expirydt");
			uelm = this.getElements("u" + infix + "_expirydt");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->expirydt->caption(), $datasheets->expirydt->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
			elm = this.getElements("x" + infix + "_expirydt");
			uelm = this.getElements("u" + infix + "_expirydt");
			if (uelm && uelm.checked && elm && !ew.checkDate(elm.value))
				return this.onError(elm, "<?php echo JsEncode($datasheets->expirydt->errorMessage()) ?>");
		<?php if ($datasheets_update->systrade->Required) { ?>
			elm = this.getElements("x" + infix + "_systrade");
			uelm = this.getElements("u" + infix + "_systrade");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->systrade->caption(), $datasheets->systrade->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($datasheets_update->isdatasheet->Required) { ?>
			elm = this.getElements("x" + infix + "_isdatasheet");
			uelm = this.getElements("u" + infix + "_isdatasheet");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->isdatasheet->caption(), $datasheets->isdatasheet->RequiredErrorMessage)) ?>");
			}
		<?php } ?>
		<?php if ($datasheets_update->nativeFiles->Required) { ?>
			elm = this.getElements("x" + infix + "_nativeFiles");
			uelm = this.getElements("u" + infix + "_nativeFiles");
			if (uelm && uelm.checked) {
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $datasheets->nativeFiles->caption(), $datasheets->nativeFiles->RequiredErrorMessage)) ?>");
			}
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fdatasheetsupdate.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdatasheetsupdate.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdatasheetsupdate.lists["x_manufacturer"] = <?php echo $datasheets_update->manufacturer->Lookup->toClientList() ?>;
fdatasheetsupdate.lists["x_manufacturer"].options = <?php echo JsonEncode($datasheets_update->manufacturer->lookupOptions()) ?>;
fdatasheetsupdate.autoSuggests["x_manufacturer"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdatasheetsupdate.lists["x_duration"] = <?php echo $datasheets_update->duration->Lookup->toClientList() ?>;
fdatasheetsupdate.lists["x_duration"].options = <?php echo JsonEncode($datasheets_update->duration->options(FALSE, TRUE)) ?>;
fdatasheetsupdate.lists["x_systrade"] = <?php echo $datasheets_update->systrade->Lookup->toClientList() ?>;
fdatasheetsupdate.lists["x_systrade"].options = <?php echo JsonEncode($datasheets_update->systrade->options(FALSE, TRUE)) ?>;
fdatasheetsupdate.lists["x_isdatasheet"] = <?php echo $datasheets_update->isdatasheet->Lookup->toClientList() ?>;
fdatasheetsupdate.lists["x_isdatasheet"].options = <?php echo JsonEncode($datasheets_update->isdatasheet->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $datasheets_update->showPageHeader(); ?>
<?php
$datasheets_update->showMessage();
?>
<form name="fdatasheetsupdate" id="fdatasheetsupdate" class="<?php echo $datasheets_update->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($datasheets_update->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $datasheets_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="datasheets">
<?php if ($datasheets->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$datasheets_update->IsModal ?>">
<?php foreach ($datasheets_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<?php if (!$datasheets_update->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($datasheets_update->IsMobileOrModal) { ?>
<div id="tbl_datasheetsupdate" class="ew-update-div"><!-- page -->
	<div class="form-check">
		<input type="checkbox" class="form-check-input" name="u" id="u" onclick="ew.selectAll(this);"<?php echo $datasheets_update->Disabled ?>><label class="form-check-label" for="u"><?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php } else { ?>
<table id="tbl_datasheetsupdate" class="table table-striped table-sm ew-desktop-table"><!-- desktop table -->
	<thead>
	<tr>
		<th colspan="2"><div class="form-check"><input type="checkbox" class="form-check-input" name="u" id="u" onclick="ew.selectAll(this);"<?php echo $datasheets_update->Disabled ?>><label class="form-check-label" for="u"><?php echo $Language->Phrase("UpdateSelectAll") ?></label></div></th>
	</tr>
	</thead>
	<tbody>
<?php } ?>
<?php if ($datasheets->manufacturer->Visible) { // manufacturer ?>
<?php if ($datasheets_update->IsMobileOrModal) { ?>
	<div id="r_manufacturer" class="form-group row">
		<label class="<?php echo $datasheets_update->LeftColumnClass ?>"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_manufacturer" id="u_manufacturer" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->manufacturer->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_manufacturer" id="u_manufacturer" value="<?php echo $datasheets->manufacturer->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->manufacturer->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_manufacturer"><?php echo $datasheets->manufacturer->caption() ?></label></div></label>
		<div class="<?php echo $datasheets_update->RightColumnClass ?>"><div<?php echo $datasheets->manufacturer->cellAttributes() ?>>
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
		</div>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $datasheets->manufacturer->displayValueSeparatorAttribute() ?>" name="x_manufacturer" id="x_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetsupdate.createAutoSuggest({"id":"x_manufacturer","forceSelect":true});
</script>
<?php echo $datasheets->manufacturer->Lookup->getParamTag("p_x_manufacturer") ?>
</span>
<?php } else { ?>
<span id="el_datasheets_manufacturer">
<span<?php echo $datasheets->manufacturer->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->manufacturer->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" name="x_manufacturer" id="x_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->manufacturer->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_manufacturer">
		<td class="<?php echo $datasheets_update->TableLeftColumnClass ?>"<?php echo $datasheets->manufacturer->cellAttributes() ?>><span id="elh_datasheets_manufacturer"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_manufacturer" id="u_manufacturer" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->manufacturer->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_manufacturer" id="u_manufacturer" value="<?php echo $datasheets->manufacturer->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->manufacturer->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_manufacturer"><?php echo $datasheets->manufacturer->caption() ?></label></div></span></td>
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
		</div>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $datasheets->manufacturer->displayValueSeparatorAttribute() ?>" name="x_manufacturer" id="x_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetsupdate.createAutoSuggest({"id":"x_manufacturer","forceSelect":true});
</script>
<?php echo $datasheets->manufacturer->Lookup->getParamTag("p_x_manufacturer") ?>
</span>
<?php } else { ?>
<span id="el_datasheets_manufacturer">
<span<?php echo $datasheets->manufacturer->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->manufacturer->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" name="x_manufacturer" id="x_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->manufacturer->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->cddFile->Visible) { // cddFile ?>
<?php if ($datasheets_update->IsMobileOrModal) { ?>
	<div id="r_cddFile" class="form-group row">
		<label class="<?php echo $datasheets_update->LeftColumnClass ?>"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_cddFile" id="u_cddFile" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->cddFile->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_cddFile" id="u_cddFile" value="<?php echo $datasheets->cddFile->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->cddFile->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_cddFile"><?php echo $datasheets->cddFile->caption() ?></label></div></label>
		<div class="<?php echo $datasheets_update->RightColumnClass ?>"><div<?php echo $datasheets->cddFile->cellAttributes() ?>>
<span id="el_datasheets_cddFile">
<div id="fd_x_cddFile">
<span title="<?php echo $datasheets->cddFile->title() ? $datasheets->cddFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cddFile->ReadOnly || $datasheets->cddFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cddFile" name="x_cddFile" id="x_cddFile"<?php echo $datasheets->cddFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_cddFile" id= "fn_x_cddFile" value="<?php echo $datasheets->cddFile->Upload->FileName ?>">
<?php if (Post("fa_x_cddFile") == "0") { ?>
<input type="hidden" name="fa_x_cddFile" id= "fa_x_cddFile" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_cddFile" id= "fa_x_cddFile" value="1">
<?php } ?>
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
		<td class="<?php echo $datasheets_update->TableLeftColumnClass ?>"<?php echo $datasheets->cddFile->cellAttributes() ?>><span id="elh_datasheets_cddFile"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_cddFile" id="u_cddFile" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->cddFile->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_cddFile" id="u_cddFile" value="<?php echo $datasheets->cddFile->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->cddFile->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_cddFile"><?php echo $datasheets->cddFile->caption() ?></label></div></span></td>
		<td<?php echo $datasheets->cddFile->cellAttributes() ?>>
<span id="el_datasheets_cddFile">
<div id="fd_x_cddFile">
<span title="<?php echo $datasheets->cddFile->title() ? $datasheets->cddFile->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($datasheets->cddFile->ReadOnly || $datasheets->cddFile->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="datasheets" data-field="x_cddFile" name="x_cddFile" id="x_cddFile"<?php echo $datasheets->cddFile->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_cddFile" id= "fn_x_cddFile" value="<?php echo $datasheets->cddFile->Upload->FileName ?>">
<?php if (Post("fa_x_cddFile") == "0") { ?>
<input type="hidden" name="fa_x_cddFile" id= "fa_x_cddFile" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_cddFile" id= "fa_x_cddFile" value="1">
<?php } ?>
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
<?php if ($datasheets->cddissue->Visible) { // cddissue ?>
<?php if ($datasheets_update->IsMobileOrModal) { ?>
	<div id="r_cddissue" class="form-group row">
		<label for="x_cddissue" class="<?php echo $datasheets_update->LeftColumnClass ?>"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_cddissue" id="u_cddissue" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->cddissue->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_cddissue" id="u_cddissue" value="<?php echo $datasheets->cddissue->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->cddissue->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_cddissue"><?php echo $datasheets->cddissue->caption() ?></label></div></label>
		<div class="<?php echo $datasheets_update->RightColumnClass ?>"><div<?php echo $datasheets->cddissue->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_cddissue">
<input type="text" data-table="datasheets" data-field="x_cddissue" data-format="5" name="x_cddissue" id="x_cddissue" placeholder="<?php echo HtmlEncode($datasheets->cddissue->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddissue->EditValue ?>"<?php echo $datasheets->cddissue->editAttributes() ?>>
<?php if (!$datasheets->cddissue->ReadOnly && !$datasheets->cddissue->Disabled && !isset($datasheets->cddissue->EditAttrs["readonly"]) && !isset($datasheets->cddissue->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetsupdate", "x_cddissue", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_datasheets_cddissue">
<span<?php echo $datasheets->cddissue->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->cddissue->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddissue" name="x_cddissue" id="x_cddissue" value="<?php echo HtmlEncode($datasheets->cddissue->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->cddissue->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cddissue">
		<td class="<?php echo $datasheets_update->TableLeftColumnClass ?>"<?php echo $datasheets->cddissue->cellAttributes() ?>><span id="elh_datasheets_cddissue"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_cddissue" id="u_cddissue" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->cddissue->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_cddissue" id="u_cddissue" value="<?php echo $datasheets->cddissue->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->cddissue->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_cddissue"><?php echo $datasheets->cddissue->caption() ?></label></div></span></td>
		<td<?php echo $datasheets->cddissue->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_cddissue">
<input type="text" data-table="datasheets" data-field="x_cddissue" data-format="5" name="x_cddissue" id="x_cddissue" placeholder="<?php echo HtmlEncode($datasheets->cddissue->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddissue->EditValue ?>"<?php echo $datasheets->cddissue->editAttributes() ?>>
<?php if (!$datasheets->cddissue->ReadOnly && !$datasheets->cddissue->Disabled && !isset($datasheets->cddissue->EditAttrs["readonly"]) && !isset($datasheets->cddissue->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetsupdate", "x_cddissue", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_datasheets_cddissue">
<span<?php echo $datasheets->cddissue->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->cddissue->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_cddissue" name="x_cddissue" id="x_cddissue" value="<?php echo HtmlEncode($datasheets->cddissue->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->cddissue->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->cddno->Visible) { // cddno ?>
<?php if ($datasheets_update->IsMobileOrModal) { ?>
	<div id="r_cddno" class="form-group row">
		<label for="x_cddno" class="<?php echo $datasheets_update->LeftColumnClass ?>"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_cddno" id="u_cddno" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->cddno->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_cddno" id="u_cddno" value="<?php echo $datasheets->cddno->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->cddno->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_cddno"><?php echo $datasheets->cddno->caption() ?></label></div></label>
		<div class="<?php echo $datasheets_update->RightColumnClass ?>"><div<?php echo $datasheets->cddno->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_cddno">
<input type="text" data-table="datasheets" data-field="x_cddno" name="x_cddno" id="x_cddno" size="30" placeholder="<?php echo HtmlEncode($datasheets->cddno->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddno->EditValue ?>"<?php echo $datasheets->cddno->editAttributes() ?>>
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
<input type="hidden" data-table="datasheets" data-field="x_cddno" name="x_cddno" id="x_cddno" value="<?php echo HtmlEncode($datasheets->cddno->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->cddno->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cddno">
		<td class="<?php echo $datasheets_update->TableLeftColumnClass ?>"<?php echo $datasheets->cddno->cellAttributes() ?>><span id="elh_datasheets_cddno"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_cddno" id="u_cddno" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->cddno->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_cddno" id="u_cddno" value="<?php echo $datasheets->cddno->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->cddno->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_cddno"><?php echo $datasheets->cddno->caption() ?></label></div></span></td>
		<td<?php echo $datasheets->cddno->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_cddno">
<input type="text" data-table="datasheets" data-field="x_cddno" name="x_cddno" id="x_cddno" size="30" placeholder="<?php echo HtmlEncode($datasheets->cddno->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddno->EditValue ?>"<?php echo $datasheets->cddno->editAttributes() ?>>
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
<input type="hidden" data-table="datasheets" data-field="x_cddno" name="x_cddno" id="x_cddno" value="<?php echo HtmlEncode($datasheets->cddno->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->cddno->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->duration->Visible) { // duration ?>
<?php if ($datasheets_update->IsMobileOrModal) { ?>
	<div id="r_duration" class="form-group row">
		<label for="x_duration" class="<?php echo $datasheets_update->LeftColumnClass ?>"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_duration" id="u_duration" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->duration->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_duration" id="u_duration" value="<?php echo $datasheets->duration->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->duration->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_duration"><?php echo $datasheets->duration->caption() ?></label></div></label>
		<div class="<?php echo $datasheets_update->RightColumnClass ?>"><div<?php echo $datasheets->duration->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_duration">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="datasheets" data-field="x_duration" data-value-separator="<?php echo $datasheets->duration->displayValueSeparatorAttribute() ?>" id="x_duration" name="x_duration"<?php echo $datasheets->duration->editAttributes() ?>>
		<?php echo $datasheets->duration->selectOptionListHtml("x_duration") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el_datasheets_duration">
<span<?php echo $datasheets->duration->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->duration->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_duration" name="x_duration" id="x_duration" value="<?php echo HtmlEncode($datasheets->duration->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->duration->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_duration">
		<td class="<?php echo $datasheets_update->TableLeftColumnClass ?>"<?php echo $datasheets->duration->cellAttributes() ?>><span id="elh_datasheets_duration"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_duration" id="u_duration" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->duration->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_duration" id="u_duration" value="<?php echo $datasheets->duration->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->duration->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_duration"><?php echo $datasheets->duration->caption() ?></label></div></span></td>
		<td<?php echo $datasheets->duration->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_duration">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="datasheets" data-field="x_duration" data-value-separator="<?php echo $datasheets->duration->displayValueSeparatorAttribute() ?>" id="x_duration" name="x_duration"<?php echo $datasheets->duration->editAttributes() ?>>
		<?php echo $datasheets->duration->selectOptionListHtml("x_duration") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el_datasheets_duration">
<span<?php echo $datasheets->duration->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->duration->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_duration" name="x_duration" id="x_duration" value="<?php echo HtmlEncode($datasheets->duration->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->duration->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->expirydt->Visible) { // expirydt ?>
<?php if ($datasheets_update->IsMobileOrModal) { ?>
	<div id="r_expirydt" class="form-group row">
		<label for="x_expirydt" class="<?php echo $datasheets_update->LeftColumnClass ?>"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_expirydt" id="u_expirydt" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->expirydt->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_expirydt" id="u_expirydt" value="<?php echo $datasheets->expirydt->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->expirydt->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_expirydt"><?php echo $datasheets->expirydt->caption() ?></label></div></label>
		<div class="<?php echo $datasheets_update->RightColumnClass ?>"><div<?php echo $datasheets->expirydt->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_expirydt">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-format="5" name="x_expirydt" id="x_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetsupdate", "x_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_datasheets_expirydt">
<span<?php echo $datasheets->expirydt->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->expirydt->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_expirydt" name="x_expirydt" id="x_expirydt" value="<?php echo HtmlEncode($datasheets->expirydt->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->expirydt->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_expirydt">
		<td class="<?php echo $datasheets_update->TableLeftColumnClass ?>"<?php echo $datasheets->expirydt->cellAttributes() ?>><span id="elh_datasheets_expirydt"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_expirydt" id="u_expirydt" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->expirydt->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_expirydt" id="u_expirydt" value="<?php echo $datasheets->expirydt->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->expirydt->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_expirydt"><?php echo $datasheets->expirydt->caption() ?></label></div></span></td>
		<td<?php echo $datasheets->expirydt->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_expirydt">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-format="5" name="x_expirydt" id="x_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetsupdate", "x_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_datasheets_expirydt">
<span<?php echo $datasheets->expirydt->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->expirydt->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_expirydt" name="x_expirydt" id="x_expirydt" value="<?php echo HtmlEncode($datasheets->expirydt->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->expirydt->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->systrade->Visible) { // systrade ?>
<?php if ($datasheets_update->IsMobileOrModal) { ?>
	<div id="r_systrade" class="form-group row">
		<label for="x_systrade" class="<?php echo $datasheets_update->LeftColumnClass ?>"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_systrade" id="u_systrade" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->systrade->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_systrade" id="u_systrade" value="<?php echo $datasheets->systrade->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->systrade->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_systrade"><?php echo $datasheets->systrade->caption() ?></label></div></label>
		<div class="<?php echo $datasheets_update->RightColumnClass ?>"><div<?php echo $datasheets->systrade->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_systrade">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($datasheets->systrade->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $datasheets->systrade->ViewValue ?></button>
		<div id="dsl_x_systrade" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $datasheets->systrade->radioButtonListHtml(TRUE, "x_systrade") ?>
			</div><!-- /.ew-items ##-->
		</div><!-- /.dropdown-menu ##-->
		<div id="tp_x_systrade" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_systrade" data-value-separator="<?php echo $datasheets->systrade->displayValueSeparatorAttribute() ?>" name="x_systrade" id="x_systrade" value="{value}"<?php echo $datasheets->systrade->editAttributes() ?>></div>
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
<input type="hidden" data-table="datasheets" data-field="x_systrade" name="x_systrade" id="x_systrade" value="<?php echo HtmlEncode($datasheets->systrade->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->systrade->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_systrade">
		<td class="<?php echo $datasheets_update->TableLeftColumnClass ?>"<?php echo $datasheets->systrade->cellAttributes() ?>><span id="elh_datasheets_systrade"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_systrade" id="u_systrade" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->systrade->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_systrade" id="u_systrade" value="<?php echo $datasheets->systrade->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->systrade->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_systrade"><?php echo $datasheets->systrade->caption() ?></label></div></span></td>
		<td<?php echo $datasheets->systrade->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_systrade">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($datasheets->systrade->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $datasheets->systrade->ViewValue ?></button>
		<div id="dsl_x_systrade" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $datasheets->systrade->radioButtonListHtml(TRUE, "x_systrade") ?>
			</div><!-- /.ew-items ##-->
		</div><!-- /.dropdown-menu ##-->
		<div id="tp_x_systrade" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_systrade" data-value-separator="<?php echo $datasheets->systrade->displayValueSeparatorAttribute() ?>" name="x_systrade" id="x_systrade" value="{value}"<?php echo $datasheets->systrade->editAttributes() ?>></div>
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
<input type="hidden" data-table="datasheets" data-field="x_systrade" name="x_systrade" id="x_systrade" value="<?php echo HtmlEncode($datasheets->systrade->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->systrade->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->isdatasheet->Visible) { // isdatasheet ?>
<?php if ($datasheets_update->IsMobileOrModal) { ?>
	<div id="r_isdatasheet" class="form-group row">
		<label class="<?php echo $datasheets_update->LeftColumnClass ?>"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_isdatasheet" id="u_isdatasheet" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->isdatasheet->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_isdatasheet" id="u_isdatasheet" value="<?php echo $datasheets->isdatasheet->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->isdatasheet->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_isdatasheet"><?php echo $datasheets->isdatasheet->caption() ?></label></div></label>
		<div class="<?php echo $datasheets_update->RightColumnClass ?>"><div<?php echo $datasheets->isdatasheet->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_isdatasheet">
<div id="tp_x_isdatasheet" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_isdatasheet" data-value-separator="<?php echo $datasheets->isdatasheet->displayValueSeparatorAttribute() ?>" name="x_isdatasheet" id="x_isdatasheet" value="{value}"<?php echo $datasheets->isdatasheet->editAttributes() ?>></div>
<div id="dsl_x_isdatasheet" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->isdatasheet->radioButtonListHtml(FALSE, "x_isdatasheet") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_datasheets_isdatasheet">
<span<?php echo $datasheets->isdatasheet->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->isdatasheet->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_isdatasheet" name="x_isdatasheet" id="x_isdatasheet" value="<?php echo HtmlEncode($datasheets->isdatasheet->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->isdatasheet->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_isdatasheet">
		<td class="<?php echo $datasheets_update->TableLeftColumnClass ?>"<?php echo $datasheets->isdatasheet->cellAttributes() ?>><span id="elh_datasheets_isdatasheet"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_isdatasheet" id="u_isdatasheet" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->isdatasheet->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_isdatasheet" id="u_isdatasheet" value="<?php echo $datasheets->isdatasheet->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->isdatasheet->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_isdatasheet"><?php echo $datasheets->isdatasheet->caption() ?></label></div></span></td>
		<td<?php echo $datasheets->isdatasheet->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_isdatasheet">
<div id="tp_x_isdatasheet" class="ew-template"><input type="radio" class="form-check-input" data-table="datasheets" data-field="x_isdatasheet" data-value-separator="<?php echo $datasheets->isdatasheet->displayValueSeparatorAttribute() ?>" name="x_isdatasheet" id="x_isdatasheet" value="{value}"<?php echo $datasheets->isdatasheet->editAttributes() ?>></div>
<div id="dsl_x_isdatasheet" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $datasheets->isdatasheet->radioButtonListHtml(FALSE, "x_isdatasheet") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_datasheets_isdatasheet">
<span<?php echo $datasheets->isdatasheet->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->isdatasheet->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_isdatasheet" name="x_isdatasheet" id="x_isdatasheet" value="<?php echo HtmlEncode($datasheets->isdatasheet->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->isdatasheet->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->nativeFiles->Visible) { // nativeFiles ?>
<?php if ($datasheets_update->IsMobileOrModal) { ?>
	<div id="r_nativeFiles" class="form-group row">
		<label for="x_nativeFiles" class="<?php echo $datasheets_update->LeftColumnClass ?>"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_nativeFiles" id="u_nativeFiles" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->nativeFiles->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_nativeFiles" id="u_nativeFiles" value="<?php echo $datasheets->nativeFiles->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->nativeFiles->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_nativeFiles"><?php echo $datasheets->nativeFiles->caption() ?></label></div></label>
		<div class="<?php echo $datasheets_update->RightColumnClass ?>"><div<?php echo $datasheets->nativeFiles->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_nativeFiles">
<textarea data-table="datasheets" data-field="x_nativeFiles" name="x_nativeFiles" id="x_nativeFiles" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->nativeFiles->getPlaceHolder()) ?>"<?php echo $datasheets->nativeFiles->editAttributes() ?>><?php echo $datasheets->nativeFiles->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_datasheets_nativeFiles">
<span<?php echo $datasheets->nativeFiles->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->nativeFiles->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_nativeFiles" name="x_nativeFiles" id="x_nativeFiles" value="<?php echo HtmlEncode($datasheets->nativeFiles->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->nativeFiles->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_nativeFiles">
		<td class="<?php echo $datasheets_update->TableLeftColumnClass ?>"<?php echo $datasheets->nativeFiles->cellAttributes() ?>><span id="elh_datasheets_nativeFiles"><div class="form-check">
<?php if (!$datasheets->isConfirm()) { ?>
<input type="checkbox" name="u_nativeFiles" id="u_nativeFiles" class="form-check-input ew-multi-select" value="1"<?php echo ($datasheets->nativeFiles->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } else { ?>
<input type="hidden" name="u_nativeFiles" id="u_nativeFiles" value="<?php echo $datasheets->nativeFiles->MultiUpdate ?>">
<input type="checkbox" class="form-check-input" disabled<?php echo ($datasheets->nativeFiles->MultiUpdate == "1") ? " checked" : "" ?>>
<?php } ?>
<label class="form-check-label" for="u_nativeFiles"><?php echo $datasheets->nativeFiles->caption() ?></label></div></span></td>
		<td<?php echo $datasheets->nativeFiles->cellAttributes() ?>>
<?php if (!$datasheets->isConfirm()) { ?>
<span id="el_datasheets_nativeFiles">
<textarea data-table="datasheets" data-field="x_nativeFiles" name="x_nativeFiles" id="x_nativeFiles" cols="35" rows="4" placeholder="<?php echo HtmlEncode($datasheets->nativeFiles->getPlaceHolder()) ?>"<?php echo $datasheets->nativeFiles->editAttributes() ?>><?php echo $datasheets->nativeFiles->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_datasheets_nativeFiles">
<span<?php echo $datasheets->nativeFiles->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($datasheets->nativeFiles->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="datasheets" data-field="x_nativeFiles" name="x_nativeFiles" id="x_nativeFiles" value="<?php echo HtmlEncode($datasheets->nativeFiles->FormValue) ?>">
<?php } ?>
<?php echo $datasheets->nativeFiles->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets_update->IsMobileOrModal) { ?>
	</div><!-- /page -->
<?php } else { ?>
	</tbody>
</table><!-- /desktop table -->
<?php } ?>
<?php if (!$datasheets_update->IsModal) { ?>
	<div class="form-group row"><!-- buttons .form-group -->
		<div class="<?php echo $datasheets_update->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$datasheets->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("UpdateBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $datasheets_update->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$datasheets_update->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$datasheets_update->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$datasheets_update->terminate();
?>