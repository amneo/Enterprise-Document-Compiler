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
$datasheets_search = new datasheets_search();

// Run the page
$datasheets_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$datasheets_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($datasheets_search->IsModal) { ?>
var fdatasheetssearch = currentAdvancedSearchForm = new ew.Form("fdatasheetssearch", "search");
<?php } else { ?>
var fdatasheetssearch = currentForm = new ew.Form("fdatasheetssearch", "search");
<?php } ?>

// Form_CustomValidate event
fdatasheetssearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fdatasheetssearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdatasheetssearch.lists["x_manufacturer"] = <?php echo $datasheets_search->manufacturer->Lookup->toClientList() ?>;
fdatasheetssearch.lists["x_manufacturer"].options = <?php echo JsonEncode($datasheets_search->manufacturer->lookupOptions()) ?>;
fdatasheetssearch.autoSuggests["x_manufacturer"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdatasheetssearch.lists["x_coo"] = <?php echo $datasheets_search->coo->Lookup->toClientList() ?>;
fdatasheetssearch.lists["x_coo"].options = <?php echo JsonEncode($datasheets_search->coo->lookupOptions()) ?>;
fdatasheetssearch.autoSuggests["x_coo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fdatasheetssearch.lists["x_systrade"] = <?php echo $datasheets_search->systrade->Lookup->toClientList() ?>;
fdatasheetssearch.lists["x_systrade"].options = <?php echo JsonEncode($datasheets_search->systrade->options(FALSE, TRUE)) ?>;

// Form object for search
// Validate function for search

fdatasheetssearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $datasheets_search->showPageHeader(); ?>
<?php
$datasheets_search->showMessage();
?>
<form name="fdatasheetssearch" id="fdatasheetssearch" class="<?php echo $datasheets_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($datasheets_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $datasheets_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="datasheets">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$datasheets_search->IsModal ?>">
<?php if (!$datasheets_search->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($datasheets_search->IsMobileOrModal) { ?>
<div class="ew-search-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_datasheetssearch" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($datasheets->partno->Visible) { // partno ?>
<?php if ($datasheets_search->IsMobileOrModal) { ?>
	<div id="r_partno" class="form-group row">
		<label for="x_partno" class="<?php echo $datasheets_search->LeftColumnClass ?>"><span id="elh_datasheets_partno"><?php echo $datasheets->partno->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_partno" id="z_partno" value="LIKE"></span>
		</label>
		<div class="<?php echo $datasheets_search->RightColumnClass ?>"><div<?php echo $datasheets->partno->cellAttributes() ?>>
			<span id="el_datasheets_partno">
<input type="text" data-table="datasheets" data-field="x_partno" name="x_partno" id="x_partno" size="30" placeholder="<?php echo HtmlEncode($datasheets->partno->getPlaceHolder()) ?>" value="<?php echo $datasheets->partno->EditValue ?>"<?php echo $datasheets->partno->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_partno">
		<td class="<?php echo $datasheets_search->TableLeftColumnClass ?>"><span id="elh_datasheets_partno"><?php echo $datasheets->partno->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_partno" id="z_partno" value="LIKE"></span></td>
		<td<?php echo $datasheets->partno->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_datasheets_partno">
<input type="text" data-table="datasheets" data-field="x_partno" name="x_partno" id="x_partno" size="30" placeholder="<?php echo HtmlEncode($datasheets->partno->getPlaceHolder()) ?>" value="<?php echo $datasheets->partno->EditValue ?>"<?php echo $datasheets->partno->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->manufacturer->Visible) { // manufacturer ?>
<?php if ($datasheets_search->IsMobileOrModal) { ?>
	<div id="r_manufacturer" class="form-group row">
		<label class="<?php echo $datasheets_search->LeftColumnClass ?>"><span id="elh_datasheets_manufacturer"><?php echo $datasheets->manufacturer->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_manufacturer" id="z_manufacturer" value="LIKE"></span>
		</label>
		<div class="<?php echo $datasheets_search->RightColumnClass ?>"><div<?php echo $datasheets->manufacturer->cellAttributes() ?>>
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
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($datasheets->manufacturer->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_manufacturer',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo (($datasheets->manufacturer->ReadOnly || $datasheets->manufacturer->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $datasheets->manufacturer->displayValueSeparatorAttribute() ?>" name="x_manufacturer" id="x_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetssearch.createAutoSuggest({"id":"x_manufacturer","forceSelect":false});
</script>
<?php echo $datasheets->manufacturer->Lookup->getParamTag("p_x_manufacturer") ?>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_manufacturer">
		<td class="<?php echo $datasheets_search->TableLeftColumnClass ?>"><span id="elh_datasheets_manufacturer"><?php echo $datasheets->manufacturer->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_manufacturer" id="z_manufacturer" value="LIKE"></span></td>
		<td<?php echo $datasheets->manufacturer->cellAttributes() ?>>
			<div class="text-nowrap">
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
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($datasheets->manufacturer->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_manufacturer',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo (($datasheets->manufacturer->ReadOnly || $datasheets->manufacturer->Disabled) ? " disabled" : "")?>><i class="fa fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="datasheets" data-field="x_manufacturer" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $datasheets->manufacturer->displayValueSeparatorAttribute() ?>" name="x_manufacturer" id="x_manufacturer" value="<?php echo HtmlEncode($datasheets->manufacturer->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetssearch.createAutoSuggest({"id":"x_manufacturer","forceSelect":false});
</script>
<?php echo $datasheets->manufacturer->Lookup->getParamTag("p_x_manufacturer") ?>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->tittle->Visible) { // tittle ?>
<?php if ($datasheets_search->IsMobileOrModal) { ?>
	<div id="r_tittle" class="form-group row">
		<label for="x_tittle" class="<?php echo $datasheets_search->LeftColumnClass ?>"><span id="elh_datasheets_tittle"><?php echo $datasheets->tittle->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_tittle" id="z_tittle" value="LIKE"></span>
		</label>
		<div class="<?php echo $datasheets_search->RightColumnClass ?>"><div<?php echo $datasheets->tittle->cellAttributes() ?>>
			<span id="el_datasheets_tittle">
<input type="text" data-table="datasheets" data-field="x_tittle" name="x_tittle" id="x_tittle" placeholder="<?php echo HtmlEncode($datasheets->tittle->getPlaceHolder()) ?>" value="<?php echo $datasheets->tittle->EditValue ?>"<?php echo $datasheets->tittle->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_tittle">
		<td class="<?php echo $datasheets_search->TableLeftColumnClass ?>"><span id="elh_datasheets_tittle"><?php echo $datasheets->tittle->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_tittle" id="z_tittle" value="LIKE"></span></td>
		<td<?php echo $datasheets->tittle->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_datasheets_tittle">
<input type="text" data-table="datasheets" data-field="x_tittle" name="x_tittle" id="x_tittle" placeholder="<?php echo HtmlEncode($datasheets->tittle->getPlaceHolder()) ?>" value="<?php echo $datasheets->tittle->EditValue ?>"<?php echo $datasheets->tittle->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->cddno->Visible) { // cddno ?>
<?php if ($datasheets_search->IsMobileOrModal) { ?>
	<div id="r_cddno" class="form-group row">
		<label for="x_cddno" class="<?php echo $datasheets_search->LeftColumnClass ?>"><span id="elh_datasheets_cddno"><?php echo $datasheets->cddno->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_cddno" id="z_cddno" value="LIKE"></span>
		</label>
		<div class="<?php echo $datasheets_search->RightColumnClass ?>"><div<?php echo $datasheets->cddno->cellAttributes() ?>>
			<span id="el_datasheets_cddno">
<input type="text" data-table="datasheets" data-field="x_cddno" name="x_cddno" id="x_cddno" size="30" placeholder="<?php echo HtmlEncode($datasheets->cddno->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddno->EditValue ?>"<?php echo $datasheets->cddno->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_cddno">
		<td class="<?php echo $datasheets_search->TableLeftColumnClass ?>"><span id="elh_datasheets_cddno"><?php echo $datasheets->cddno->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_cddno" id="z_cddno" value="LIKE"></span></td>
		<td<?php echo $datasheets->cddno->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_datasheets_cddno">
<input type="text" data-table="datasheets" data-field="x_cddno" name="x_cddno" id="x_cddno" size="30" placeholder="<?php echo HtmlEncode($datasheets->cddno->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddno->EditValue ?>"<?php echo $datasheets->cddno->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->thirdPartyNo->Visible) { // thirdPartyNo ?>
<?php if ($datasheets_search->IsMobileOrModal) { ?>
	<div id="r_thirdPartyNo" class="form-group row">
		<label for="x_thirdPartyNo" class="<?php echo $datasheets_search->LeftColumnClass ?>"><span id="elh_datasheets_thirdPartyNo"><?php echo $datasheets->thirdPartyNo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_thirdPartyNo" id="z_thirdPartyNo" value="LIKE"></span>
		</label>
		<div class="<?php echo $datasheets_search->RightColumnClass ?>"><div<?php echo $datasheets->thirdPartyNo->cellAttributes() ?>>
			<span id="el_datasheets_thirdPartyNo">
<input type="text" data-table="datasheets" data-field="x_thirdPartyNo" name="x_thirdPartyNo" id="x_thirdPartyNo" size="30" placeholder="<?php echo HtmlEncode($datasheets->thirdPartyNo->getPlaceHolder()) ?>" value="<?php echo $datasheets->thirdPartyNo->EditValue ?>"<?php echo $datasheets->thirdPartyNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_thirdPartyNo">
		<td class="<?php echo $datasheets_search->TableLeftColumnClass ?>"><span id="elh_datasheets_thirdPartyNo"><?php echo $datasheets->thirdPartyNo->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_thirdPartyNo" id="z_thirdPartyNo" value="LIKE"></span></td>
		<td<?php echo $datasheets->thirdPartyNo->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_datasheets_thirdPartyNo">
<input type="text" data-table="datasheets" data-field="x_thirdPartyNo" name="x_thirdPartyNo" id="x_thirdPartyNo" size="30" placeholder="<?php echo HtmlEncode($datasheets->thirdPartyNo->getPlaceHolder()) ?>" value="<?php echo $datasheets->thirdPartyNo->EditValue ?>"<?php echo $datasheets->thirdPartyNo->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->coo->Visible) { // coo ?>
<?php if ($datasheets_search->IsMobileOrModal) { ?>
	<div id="r_coo" class="form-group row">
		<label class="<?php echo $datasheets_search->LeftColumnClass ?>"><span id="elh_datasheets_coo"><?php echo $datasheets->coo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_coo" id="z_coo" value="LIKE"></span>
		</label>
		<div class="<?php echo $datasheets_search->RightColumnClass ?>"><div<?php echo $datasheets->coo->cellAttributes() ?>>
			<span id="el_datasheets_coo">
<?php
$wrkonchange = "" . trim(@$datasheets->coo->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->coo->EditAttrs["onchange"] = "";
?>
<span id="as_x_coo" class="text-nowrap" style="z-index: 8850">
	<input type="text" class="form-control" name="sv_x_coo" id="sv_x_coo" value="<?php echo RemoveHtml($datasheets->coo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>"<?php echo $datasheets->coo->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_coo" data-value-separator="<?php echo $datasheets->coo->displayValueSeparatorAttribute() ?>" name="x_coo" id="x_coo" value="<?php echo HtmlEncode($datasheets->coo->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetssearch.createAutoSuggest({"id":"x_coo","forceSelect":false});
</script>
<?php echo $datasheets->coo->Lookup->getParamTag("p_x_coo") ?>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_coo">
		<td class="<?php echo $datasheets_search->TableLeftColumnClass ?>"><span id="elh_datasheets_coo"><?php echo $datasheets->coo->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_coo" id="z_coo" value="LIKE"></span></td>
		<td<?php echo $datasheets->coo->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_datasheets_coo">
<?php
$wrkonchange = "" . trim(@$datasheets->coo->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$datasheets->coo->EditAttrs["onchange"] = "";
?>
<span id="as_x_coo" class="text-nowrap" style="z-index: 8850">
	<input type="text" class="form-control" name="sv_x_coo" id="sv_x_coo" value="<?php echo RemoveHtml($datasheets->coo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($datasheets->coo->getPlaceHolder()) ?>"<?php echo $datasheets->coo->editAttributes() ?>>
</span>
<input type="hidden" data-table="datasheets" data-field="x_coo" data-value-separator="<?php echo $datasheets->coo->displayValueSeparatorAttribute() ?>" name="x_coo" id="x_coo" value="<?php echo HtmlEncode($datasheets->coo->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fdatasheetssearch.createAutoSuggest({"id":"x_coo","forceSelect":false});
</script>
<?php echo $datasheets->coo->Lookup->getParamTag("p_x_coo") ?>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->systrade->Visible) { // systrade ?>
<?php if ($datasheets_search->IsMobileOrModal) { ?>
	<div id="r_systrade" class="form-group row">
		<label for="x_systrade" class="<?php echo $datasheets_search->LeftColumnClass ?>"><span id="elh_datasheets_systrade"><?php echo $datasheets->systrade->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_systrade" id="z_systrade" value="LIKE"></span>
		</label>
		<div class="<?php echo $datasheets_search->RightColumnClass ?>"><div<?php echo $datasheets->systrade->cellAttributes() ?>>
			<span id="el_datasheets_systrade">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($datasheets->systrade->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $datasheets->systrade->AdvancedSearch->ViewValue ?></button>
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
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_systrade">
		<td class="<?php echo $datasheets_search->TableLeftColumnClass ?>"><span id="elh_datasheets_systrade"><?php echo $datasheets->systrade->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_systrade" id="z_systrade" value="LIKE"></span></td>
		<td<?php echo $datasheets->systrade->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_datasheets_systrade">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($datasheets->systrade->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $datasheets->systrade->AdvancedSearch->ViewValue ?></button>
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
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->nativeFiles->Visible) { // nativeFiles ?>
<?php if ($datasheets_search->IsMobileOrModal) { ?>
	<div id="r_nativeFiles" class="form-group row">
		<label for="x_nativeFiles" class="<?php echo $datasheets_search->LeftColumnClass ?>"><span id="elh_datasheets_nativeFiles"><?php echo $datasheets->nativeFiles->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_nativeFiles" id="z_nativeFiles" value="LIKE"></span>
		</label>
		<div class="<?php echo $datasheets_search->RightColumnClass ?>"><div<?php echo $datasheets->nativeFiles->cellAttributes() ?>>
			<span id="el_datasheets_nativeFiles">
<input type="text" data-table="datasheets" data-field="x_nativeFiles" name="x_nativeFiles" id="x_nativeFiles" placeholder="<?php echo HtmlEncode($datasheets->nativeFiles->getPlaceHolder()) ?>" value="<?php echo $datasheets->nativeFiles->EditValue ?>"<?php echo $datasheets->nativeFiles->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_nativeFiles">
		<td class="<?php echo $datasheets_search->TableLeftColumnClass ?>"><span id="elh_datasheets_nativeFiles"><?php echo $datasheets->nativeFiles->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("LIKE") ?><input type="hidden" name="z_nativeFiles" id="z_nativeFiles" value="LIKE"></span></td>
		<td<?php echo $datasheets->nativeFiles->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_datasheets_nativeFiles">
<input type="text" data-table="datasheets" data-field="x_nativeFiles" name="x_nativeFiles" id="x_nativeFiles" placeholder="<?php echo HtmlEncode($datasheets->nativeFiles->getPlaceHolder()) ?>" value="<?php echo $datasheets->nativeFiles->EditValue ?>"<?php echo $datasheets->nativeFiles->editAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets_search->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$datasheets_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $datasheets_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$datasheets_search->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$datasheets_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$datasheets_search->terminate();
?>