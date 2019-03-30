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
fdatasheetssearch.lists["x_systrade"] = <?php echo $datasheets_search->systrade->Lookup->toClientList() ?>;
fdatasheetssearch.lists["x_systrade"].options = <?php echo JsonEncode($datasheets_search->systrade->options(FALSE, TRUE)) ?>;

// Form object for search
// Validate function for search

fdatasheetssearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_cddissue");
	if (elm && !ew.checkDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($datasheets->cddissue->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_expirydt");
	if (elm && !ew.checkDate(elm.value))
		return this.onError(elm, "<?php echo JsEncode($datasheets->expirydt->errorMessage()) ?>");

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
<?php if ($datasheets->cddissue->Visible) { // cddissue ?>
<?php if ($datasheets_search->IsMobileOrModal) { ?>
	<div id="r_cddissue" class="form-group row">
		<label for="x_cddissue" class="<?php echo $datasheets_search->LeftColumnClass ?>"><span id="elh_datasheets_cddissue"><?php echo $datasheets->cddissue->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_cddissue" id="z_cddissue" value="="></span>
		</label>
		<div class="<?php echo $datasheets_search->RightColumnClass ?>"><div<?php echo $datasheets->cddissue->cellAttributes() ?>>
			<span id="el_datasheets_cddissue">
<input type="text" data-table="datasheets" data-field="x_cddissue" data-format="5" name="x_cddissue" id="x_cddissue" placeholder="<?php echo HtmlEncode($datasheets->cddissue->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddissue->EditValue ?>"<?php echo $datasheets->cddissue->editAttributes() ?>>
<?php if (!$datasheets->cddissue->ReadOnly && !$datasheets->cddissue->Disabled && !isset($datasheets->cddissue->EditAttrs["readonly"]) && !isset($datasheets->cddissue->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetssearch", "x_cddissue", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_cddissue">
		<td class="<?php echo $datasheets_search->TableLeftColumnClass ?>"><span id="elh_datasheets_cddissue"><?php echo $datasheets->cddissue->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_cddissue" id="z_cddissue" value="="></span></td>
		<td<?php echo $datasheets->cddissue->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_datasheets_cddissue">
<input type="text" data-table="datasheets" data-field="x_cddissue" data-format="5" name="x_cddissue" id="x_cddissue" placeholder="<?php echo HtmlEncode($datasheets->cddissue->getPlaceHolder()) ?>" value="<?php echo $datasheets->cddissue->EditValue ?>"<?php echo $datasheets->cddissue->editAttributes() ?>>
<?php if (!$datasheets->cddissue->ReadOnly && !$datasheets->cddissue->Disabled && !isset($datasheets->cddissue->EditAttrs["readonly"]) && !isset($datasheets->cddissue->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetssearch", "x_cddissue", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
			</div>
		</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($datasheets->expirydt->Visible) { // expirydt ?>
<?php if ($datasheets_search->IsMobileOrModal) { ?>
	<div id="r_expirydt" class="form-group row">
		<label for="x_expirydt" class="<?php echo $datasheets_search->LeftColumnClass ?>"><span id="elh_datasheets_expirydt"><?php echo $datasheets->expirydt->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->phrase(">=") ?><input type="hidden" name="z_expirydt" id="z_expirydt" value=">="></span>
		</label>
		<div class="<?php echo $datasheets_search->RightColumnClass ?>"><div<?php echo $datasheets->expirydt->cellAttributes() ?>>
			<span id="el_datasheets_expirydt">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-format="5" name="x_expirydt" id="x_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetssearch", "x_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
			<span class="ew-search-cond btw0_expirydt"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="v_expirydt_1" name="v_expirydt" value="AND"<?php if ($datasheets->expirydt->AdvancedSearch->SearchCondition <> "OR") echo " checked" ?>><label class="form-check-label" for="v_expirydt_1"><?php echo $Language->phrase("AND") ?></label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="v_expirydt_2" name="v_expirydt" value="OR"<?php if ($datasheets->expirydt->AdvancedSearch->SearchCondition == "OR") echo " checked" ?>><label class="form-check-label" for="v_expirydt_2"><?php echo $Language->phrase("OR") ?></label></div></span>
			<span class="ew-search-operator btw0_expirydt"><?php echo $Language->phrase("<=") ?><input type="hidden" name="w_expirydt" id="w_expirydt" value="<="></span>
			<span id="e2_datasheets_expirydt" class="">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-format="5" name="y_expirydt" id="y_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue2 ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetssearch", "y_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } else { ?>
	<tr id="r_expirydt">
		<td class="<?php echo $datasheets_search->TableLeftColumnClass ?>"><span id="elh_datasheets_expirydt"><?php echo $datasheets->expirydt->caption() ?></span></td>
		<td class="w-col-1"><span class="ew-search-operator"><?php echo $Language->phrase(">=") ?><input type="hidden" name="z_expirydt" id="z_expirydt" value=">="></span></td>
		<td<?php echo $datasheets->expirydt->cellAttributes() ?>>
			<div class="text-nowrap">
				<span id="el_datasheets_expirydt">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-format="5" name="x_expirydt" id="x_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetssearch", "x_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
</span>
				<span class="ew-search-cond btw0_expirydt"><div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="v_expirydt_1" name="v_expirydt" value="AND"<?php if ($datasheets->expirydt->AdvancedSearch->SearchCondition <> "OR") echo " checked" ?>><label class="form-check-label" for="v_expirydt_1"><?php echo $Language->phrase("AND") ?></label></div><div class="form-check form-check-inline"><input class="form-check-input" type="radio" id="v_expirydt_2" name="v_expirydt" value="OR"<?php if ($datasheets->expirydt->AdvancedSearch->SearchCondition == "OR") echo " checked" ?>><label class="form-check-label" for="v_expirydt_2"><?php echo $Language->phrase("OR") ?></label></div></span>
				<span class="ew-search-operator btw0_expirydt"><?php echo $Language->phrase("<=") ?><input type="hidden" name="w_expirydt" id="w_expirydt" value="<="></span>
				<span id="e2_datasheets_expirydt" class="">
<input type="text" data-table="datasheets" data-field="x_expirydt" data-format="5" name="y_expirydt" id="y_expirydt" placeholder="<?php echo HtmlEncode($datasheets->expirydt->getPlaceHolder()) ?>" value="<?php echo $datasheets->expirydt->EditValue2 ?>"<?php echo $datasheets->expirydt->editAttributes() ?>>
<?php if (!$datasheets->expirydt->ReadOnly && !$datasheets->expirydt->Disabled && !isset($datasheets->expirydt->EditAttrs["readonly"]) && !isset($datasheets->expirydt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fdatasheetssearch", "y_expirydt", {"ignoreReadonly":true,"useCurrent":false,"format":5});
</script>
<?php } ?>
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