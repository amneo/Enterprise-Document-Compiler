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
$manufacturer_edit = new manufacturer_edit();

// Run the page
$manufacturer_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$manufacturer_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fmanufactureredit = currentForm = new ew.Form("fmanufactureredit", "edit");

// Validate form
fmanufactureredit.validate = function() {
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
		<?php if ($manufacturer_edit->manufacturerName->Required) { ?>
			elm = this.getElements("x" + infix + "_manufacturerName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $manufacturer->manufacturerName->caption(), $manufacturer->manufacturerName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($manufacturer_edit->manufacturerAddress->Required) { ?>
			elm = this.getElements("x" + infix + "_manufacturerAddress");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $manufacturer->manufacturerAddress->caption(), $manufacturer->manufacturerAddress->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($manufacturer_edit->manufacturerFactory->Required) { ?>
			elm = this.getElements("x" + infix + "_manufacturerFactory");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $manufacturer->manufacturerFactory->caption(), $manufacturer->manufacturerFactory->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($manufacturer_edit->username->Required) { ?>
			elm = this.getElements("x" + infix + "_username");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $manufacturer->username->caption(), $manufacturer->username->RequiredErrorMessage)) ?>");
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
fmanufactureredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmanufactureredit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $manufacturer_edit->showPageHeader(); ?>
<?php
$manufacturer_edit->showMessage();
?>
<form name="fmanufactureredit" id="fmanufactureredit" class="<?php echo $manufacturer_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($manufacturer_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $manufacturer_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="manufacturer">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$manufacturer_edit->IsModal ?>">
<?php if (!$manufacturer_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($manufacturer_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_manufactureredit" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($manufacturer->manufacturerName->Visible) { // manufacturerName ?>
<?php if ($manufacturer_edit->IsMobileOrModal) { ?>
	<div id="r_manufacturerName" class="form-group row">
		<label id="elh_manufacturer_manufacturerName" for="x_manufacturerName" class="<?php echo $manufacturer_edit->LeftColumnClass ?>"><?php echo $manufacturer->manufacturerName->caption() ?><?php echo ($manufacturer->manufacturerName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $manufacturer_edit->RightColumnClass ?>"><div<?php echo $manufacturer->manufacturerName->cellAttributes() ?>>
<span id="el_manufacturer_manufacturerName">
<input type="text" data-table="manufacturer" data-field="x_manufacturerName" name="x_manufacturerName" id="x_manufacturerName" size="30" placeholder="<?php echo HtmlEncode($manufacturer->manufacturerName->getPlaceHolder()) ?>" value="<?php echo $manufacturer->manufacturerName->EditValue ?>"<?php echo $manufacturer->manufacturerName->editAttributes() ?>>
</span>
<?php echo $manufacturer->manufacturerName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_manufacturerName">
		<td class="<?php echo $manufacturer_edit->TableLeftColumnClass ?>"><span id="elh_manufacturer_manufacturerName"><?php echo $manufacturer->manufacturerName->caption() ?><?php echo ($manufacturer->manufacturerName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $manufacturer->manufacturerName->cellAttributes() ?>>
<span id="el_manufacturer_manufacturerName">
<input type="text" data-table="manufacturer" data-field="x_manufacturerName" name="x_manufacturerName" id="x_manufacturerName" size="30" placeholder="<?php echo HtmlEncode($manufacturer->manufacturerName->getPlaceHolder()) ?>" value="<?php echo $manufacturer->manufacturerName->EditValue ?>"<?php echo $manufacturer->manufacturerName->editAttributes() ?>>
</span>
<?php echo $manufacturer->manufacturerName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($manufacturer->manufacturerAddress->Visible) { // manufacturerAddress ?>
<?php if ($manufacturer_edit->IsMobileOrModal) { ?>
	<div id="r_manufacturerAddress" class="form-group row">
		<label id="elh_manufacturer_manufacturerAddress" for="x_manufacturerAddress" class="<?php echo $manufacturer_edit->LeftColumnClass ?>"><?php echo $manufacturer->manufacturerAddress->caption() ?><?php echo ($manufacturer->manufacturerAddress->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $manufacturer_edit->RightColumnClass ?>"><div<?php echo $manufacturer->manufacturerAddress->cellAttributes() ?>>
<span id="el_manufacturer_manufacturerAddress">
<textarea data-table="manufacturer" data-field="x_manufacturerAddress" name="x_manufacturerAddress" id="x_manufacturerAddress" cols="35" rows="4" placeholder="<?php echo HtmlEncode($manufacturer->manufacturerAddress->getPlaceHolder()) ?>"<?php echo $manufacturer->manufacturerAddress->editAttributes() ?>><?php echo $manufacturer->manufacturerAddress->EditValue ?></textarea>
</span>
<?php echo $manufacturer->manufacturerAddress->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_manufacturerAddress">
		<td class="<?php echo $manufacturer_edit->TableLeftColumnClass ?>"><span id="elh_manufacturer_manufacturerAddress"><?php echo $manufacturer->manufacturerAddress->caption() ?><?php echo ($manufacturer->manufacturerAddress->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $manufacturer->manufacturerAddress->cellAttributes() ?>>
<span id="el_manufacturer_manufacturerAddress">
<textarea data-table="manufacturer" data-field="x_manufacturerAddress" name="x_manufacturerAddress" id="x_manufacturerAddress" cols="35" rows="4" placeholder="<?php echo HtmlEncode($manufacturer->manufacturerAddress->getPlaceHolder()) ?>"<?php echo $manufacturer->manufacturerAddress->editAttributes() ?>><?php echo $manufacturer->manufacturerAddress->EditValue ?></textarea>
</span>
<?php echo $manufacturer->manufacturerAddress->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($manufacturer->manufacturerFactory->Visible) { // manufacturerFactory ?>
<?php if ($manufacturer_edit->IsMobileOrModal) { ?>
	<div id="r_manufacturerFactory" class="form-group row">
		<label id="elh_manufacturer_manufacturerFactory" for="x_manufacturerFactory" class="<?php echo $manufacturer_edit->LeftColumnClass ?>"><?php echo $manufacturer->manufacturerFactory->caption() ?><?php echo ($manufacturer->manufacturerFactory->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $manufacturer_edit->RightColumnClass ?>"><div<?php echo $manufacturer->manufacturerFactory->cellAttributes() ?>>
<span id="el_manufacturer_manufacturerFactory">
<textarea data-table="manufacturer" data-field="x_manufacturerFactory" name="x_manufacturerFactory" id="x_manufacturerFactory" cols="35" rows="4" placeholder="<?php echo HtmlEncode($manufacturer->manufacturerFactory->getPlaceHolder()) ?>"<?php echo $manufacturer->manufacturerFactory->editAttributes() ?>><?php echo $manufacturer->manufacturerFactory->EditValue ?></textarea>
</span>
<?php echo $manufacturer->manufacturerFactory->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_manufacturerFactory">
		<td class="<?php echo $manufacturer_edit->TableLeftColumnClass ?>"><span id="elh_manufacturer_manufacturerFactory"><?php echo $manufacturer->manufacturerFactory->caption() ?><?php echo ($manufacturer->manufacturerFactory->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $manufacturer->manufacturerFactory->cellAttributes() ?>>
<span id="el_manufacturer_manufacturerFactory">
<textarea data-table="manufacturer" data-field="x_manufacturerFactory" name="x_manufacturerFactory" id="x_manufacturerFactory" cols="35" rows="4" placeholder="<?php echo HtmlEncode($manufacturer->manufacturerFactory->getPlaceHolder()) ?>"<?php echo $manufacturer->manufacturerFactory->editAttributes() ?>><?php echo $manufacturer->manufacturerFactory->EditValue ?></textarea>
</span>
<?php echo $manufacturer->manufacturerFactory->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($manufacturer_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
	<input type="hidden" data-table="manufacturer" data-field="x_manufacturerId" name="x_manufacturerId" id="x_manufacturerId" value="<?php echo HtmlEncode($manufacturer->manufacturerId->CurrentValue) ?>">
<?php if (!$manufacturer_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $manufacturer_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $manufacturer_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$manufacturer_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$manufacturer_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$manufacturer_edit->terminate();
?>