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
$countryOfOrigin_addopt = new countryOfOrigin_addopt();

// Run the page
$countryOfOrigin_addopt->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$countryOfOrigin_addopt->Page_Render();
?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "addopt";
var fcountryOfOriginaddopt = currentForm = new ew.Form("fcountryOfOriginaddopt", "addopt");

// Validate form
fcountryOfOriginaddopt.validate = function() {
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
		<?php if ($countryOfOrigin_addopt->countryName->Required) { ?>
			elm = this.getElements("x" + infix + "_countryName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $countryOfOrigin->countryName->caption(), $countryOfOrigin->countryName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($countryOfOrigin_addopt->countryIsoCode->Required) { ?>
			elm = this.getElements("x" + infix + "_countryIsoCode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $countryOfOrigin->countryIsoCode->caption(), $countryOfOrigin->countryIsoCode->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fcountryOfOriginaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcountryOfOriginaddopt.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $countryOfOrigin_addopt->showPageHeader(); ?>
<?php
$countryOfOrigin_addopt->showMessage();
?>
<form name="fcountryOfOriginaddopt" id="fcountryOfOriginaddopt" class="ew-form ew-horizontal" action="<?php echo API_URL ?>" method="post">
<?php //if ($countryOfOrigin_addopt->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $countryOfOrigin_addopt->Token ?>">
<?php //} ?>
<input type="hidden" name="<?php echo API_ACTION_NAME ?>" id="<?php echo API_ACTION_NAME ?>" value="<?php echo API_ADD_ACTION ?>">
<input type="hidden" name="<?php echo API_OBJECT_NAME ?>" id="<?php echo API_OBJECT_NAME ?>" value="<?php echo $countryOfOrigin_addopt->TableVar ?>">
<?php if ($countryOfOrigin->countryName->Visible) { // countryName ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_countryName"><?php echo $countryOfOrigin->countryName->caption() ?><?php echo ($countryOfOrigin->countryName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="countryOfOrigin" data-field="x_countryName" name="x_countryName" id="x_countryName" size="30" placeholder="<?php echo HtmlEncode($countryOfOrigin->countryName->getPlaceHolder()) ?>" value="<?php echo $countryOfOrigin->countryName->EditValue ?>"<?php echo $countryOfOrigin->countryName->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($countryOfOrigin->countryIsoCode->Visible) { // countryIsoCode ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_countryIsoCode"><?php echo $countryOfOrigin->countryIsoCode->caption() ?><?php echo ($countryOfOrigin->countryIsoCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="countryOfOrigin" data-field="x_countryIsoCode" name="x_countryIsoCode" id="x_countryIsoCode" size="30" placeholder="<?php echo HtmlEncode($countryOfOrigin->countryIsoCode->getPlaceHolder()) ?>" value="<?php echo $countryOfOrigin->countryIsoCode->EditValue ?>"<?php echo $countryOfOrigin->countryIsoCode->editAttributes() ?>>
</div>
	</div>
<?php } ?>
</form>
<?php
$countryOfOrigin_addopt->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php
$countryOfOrigin_addopt->terminate();
?>