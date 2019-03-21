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
$countryOfOrigin_add = new countryOfOrigin_add();

// Run the page
$countryOfOrigin_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$countryOfOrigin_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcountryOfOriginadd = currentForm = new ew.Form("fcountryOfOriginadd", "add");

// Validate form
fcountryOfOriginadd.validate = function() {
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
		<?php if ($countryOfOrigin_add->countryName->Required) { ?>
			elm = this.getElements("x" + infix + "_countryName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $countryOfOrigin->countryName->caption(), $countryOfOrigin->countryName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($countryOfOrigin_add->countryIsoCode->Required) { ?>
			elm = this.getElements("x" + infix + "_countryIsoCode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $countryOfOrigin->countryIsoCode->caption(), $countryOfOrigin->countryIsoCode->RequiredErrorMessage)) ?>");
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
fcountryOfOriginadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcountryOfOriginadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $countryOfOrigin_add->showPageHeader(); ?>
<?php
$countryOfOrigin_add->showMessage();
?>
<form name="fcountryOfOriginadd" id="fcountryOfOriginadd" class="<?php echo $countryOfOrigin_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($countryOfOrigin_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $countryOfOrigin_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="countryOfOrigin">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$countryOfOrigin_add->IsModal ?>">
<?php if (!$countryOfOrigin_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($countryOfOrigin_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_countryOfOriginadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($countryOfOrigin->countryName->Visible) { // countryName ?>
<?php if ($countryOfOrigin_add->IsMobileOrModal) { ?>
	<div id="r_countryName" class="form-group row">
		<label id="elh_countryOfOrigin_countryName" for="x_countryName" class="<?php echo $countryOfOrigin_add->LeftColumnClass ?>"><?php echo $countryOfOrigin->countryName->caption() ?><?php echo ($countryOfOrigin->countryName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $countryOfOrigin_add->RightColumnClass ?>"><div<?php echo $countryOfOrigin->countryName->cellAttributes() ?>>
<span id="el_countryOfOrigin_countryName">
<input type="text" data-table="countryOfOrigin" data-field="x_countryName" name="x_countryName" id="x_countryName" size="30" placeholder="<?php echo HtmlEncode($countryOfOrigin->countryName->getPlaceHolder()) ?>" value="<?php echo $countryOfOrigin->countryName->EditValue ?>"<?php echo $countryOfOrigin->countryName->editAttributes() ?>>
</span>
<?php echo $countryOfOrigin->countryName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_countryName">
		<td class="<?php echo $countryOfOrigin_add->TableLeftColumnClass ?>"><span id="elh_countryOfOrigin_countryName"><?php echo $countryOfOrigin->countryName->caption() ?><?php echo ($countryOfOrigin->countryName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $countryOfOrigin->countryName->cellAttributes() ?>>
<span id="el_countryOfOrigin_countryName">
<input type="text" data-table="countryOfOrigin" data-field="x_countryName" name="x_countryName" id="x_countryName" size="30" placeholder="<?php echo HtmlEncode($countryOfOrigin->countryName->getPlaceHolder()) ?>" value="<?php echo $countryOfOrigin->countryName->EditValue ?>"<?php echo $countryOfOrigin->countryName->editAttributes() ?>>
</span>
<?php echo $countryOfOrigin->countryName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($countryOfOrigin->countryIsoCode->Visible) { // countryIsoCode ?>
<?php if ($countryOfOrigin_add->IsMobileOrModal) { ?>
	<div id="r_countryIsoCode" class="form-group row">
		<label id="elh_countryOfOrigin_countryIsoCode" for="x_countryIsoCode" class="<?php echo $countryOfOrigin_add->LeftColumnClass ?>"><?php echo $countryOfOrigin->countryIsoCode->caption() ?><?php echo ($countryOfOrigin->countryIsoCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $countryOfOrigin_add->RightColumnClass ?>"><div<?php echo $countryOfOrigin->countryIsoCode->cellAttributes() ?>>
<span id="el_countryOfOrigin_countryIsoCode">
<input type="text" data-table="countryOfOrigin" data-field="x_countryIsoCode" name="x_countryIsoCode" id="x_countryIsoCode" size="30" placeholder="<?php echo HtmlEncode($countryOfOrigin->countryIsoCode->getPlaceHolder()) ?>" value="<?php echo $countryOfOrigin->countryIsoCode->EditValue ?>"<?php echo $countryOfOrigin->countryIsoCode->editAttributes() ?>>
</span>
<?php echo $countryOfOrigin->countryIsoCode->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_countryIsoCode">
		<td class="<?php echo $countryOfOrigin_add->TableLeftColumnClass ?>"><span id="elh_countryOfOrigin_countryIsoCode"><?php echo $countryOfOrigin->countryIsoCode->caption() ?><?php echo ($countryOfOrigin->countryIsoCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $countryOfOrigin->countryIsoCode->cellAttributes() ?>>
<span id="el_countryOfOrigin_countryIsoCode">
<input type="text" data-table="countryOfOrigin" data-field="x_countryIsoCode" name="x_countryIsoCode" id="x_countryIsoCode" size="30" placeholder="<?php echo HtmlEncode($countryOfOrigin->countryIsoCode->getPlaceHolder()) ?>" value="<?php echo $countryOfOrigin->countryIsoCode->EditValue ?>"<?php echo $countryOfOrigin->countryIsoCode->editAttributes() ?>>
</span>
<?php echo $countryOfOrigin->countryIsoCode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($countryOfOrigin_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$countryOfOrigin_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $countryOfOrigin_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $countryOfOrigin_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$countryOfOrigin_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$countryOfOrigin_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$countryOfOrigin_add->terminate();
?>