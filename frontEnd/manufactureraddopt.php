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
$manufacturer_addopt = new manufacturer_addopt();

// Run the page
$manufacturer_addopt->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$manufacturer_addopt->Page_Render();
?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "addopt";
var fmanufactureraddopt = currentForm = new ew.Form("fmanufactureraddopt", "addopt");

// Validate form
fmanufactureraddopt.validate = function() {
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
		<?php if ($manufacturer_addopt->manufacturerName->Required) { ?>
			elm = this.getElements("x" + infix + "_manufacturerName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $manufacturer->manufacturerName->caption(), $manufacturer->manufacturerName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($manufacturer_addopt->manufacturerAddress->Required) { ?>
			elm = this.getElements("x" + infix + "_manufacturerAddress");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $manufacturer->manufacturerAddress->caption(), $manufacturer->manufacturerAddress->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($manufacturer_addopt->manufacturerFactory->Required) { ?>
			elm = this.getElements("x" + infix + "_manufacturerFactory");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $manufacturer->manufacturerFactory->caption(), $manufacturer->manufacturerFactory->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fmanufactureraddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmanufactureraddopt.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $manufacturer_addopt->showPageHeader(); ?>
<?php
$manufacturer_addopt->showMessage();
?>
<form name="fmanufactureraddopt" id="fmanufactureraddopt" class="ew-form ew-horizontal" action="<?php echo API_URL ?>" method="post">
<?php //if ($manufacturer_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $manufacturer_addopt->Token ?>">
<?php //} ?>
<input type="hidden" name="<?php echo API_ACTION_NAME ?>" id="<?php echo API_ACTION_NAME ?>" value="<?php echo API_ADD_ACTION ?>">
<input type="hidden" name="<?php echo API_OBJECT_NAME ?>" id="<?php echo API_OBJECT_NAME ?>" value="<?php echo $manufacturer_addopt->TableVar ?>">
<?php if ($manufacturer->manufacturerName->Visible) { // manufacturerName ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_manufacturerName"><?php echo $manufacturer->manufacturerName->caption() ?><?php echo ($manufacturer->manufacturerName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="manufacturer" data-field="x_manufacturerName" name="x_manufacturerName" id="x_manufacturerName" size="30" placeholder="<?php echo HtmlEncode($manufacturer->manufacturerName->getPlaceHolder()) ?>" value="<?php echo $manufacturer->manufacturerName->EditValue ?>"<?php echo $manufacturer->manufacturerName->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($manufacturer->manufacturerAddress->Visible) { // manufacturerAddress ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_manufacturerAddress"><?php echo $manufacturer->manufacturerAddress->caption() ?><?php echo ($manufacturer->manufacturerAddress->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<textarea data-table="manufacturer" data-field="x_manufacturerAddress" name="x_manufacturerAddress" id="x_manufacturerAddress" cols="35" rows="4" placeholder="<?php echo HtmlEncode($manufacturer->manufacturerAddress->getPlaceHolder()) ?>"<?php echo $manufacturer->manufacturerAddress->editAttributes() ?>><?php echo $manufacturer->manufacturerAddress->EditValue ?></textarea>
</div>
	</div>
<?php } ?>
<?php if ($manufacturer->manufacturerFactory->Visible) { // manufacturerFactory ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_manufacturerFactory"><?php echo $manufacturer->manufacturerFactory->caption() ?><?php echo ($manufacturer->manufacturerFactory->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<textarea data-table="manufacturer" data-field="x_manufacturerFactory" name="x_manufacturerFactory" id="x_manufacturerFactory" cols="35" rows="4" placeholder="<?php echo HtmlEncode($manufacturer->manufacturerFactory->getPlaceHolder()) ?>"<?php echo $manufacturer->manufacturerFactory->editAttributes() ?>><?php echo $manufacturer->manufacturerFactory->EditValue ?></textarea>
</div>
	</div>
<?php } ?>
</form>
<?php
$manufacturer_addopt->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$manufacturer_addopt->terminate();
?>