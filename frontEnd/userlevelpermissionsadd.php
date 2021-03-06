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
$userlevelpermissions_add = new userlevelpermissions_add();

// Run the page
$userlevelpermissions_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$userlevelpermissions_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fuserlevelpermissionsadd = currentForm = new ew.Form("fuserlevelpermissionsadd", "add");

// Validate form
fuserlevelpermissionsadd.validate = function() {
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
		<?php if ($userlevelpermissions_add->_tablename->Required) { ?>
			elm = this.getElements("x" + infix + "__tablename");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $userlevelpermissions->_tablename->caption(), $userlevelpermissions->_tablename->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($userlevelpermissions_add->permission->Required) { ?>
			elm = this.getElements("x" + infix + "_permission");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $userlevelpermissions->permission->caption(), $userlevelpermissions->permission->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_permission");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($userlevelpermissions->permission->errorMessage()) ?>");

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
fuserlevelpermissionsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserlevelpermissionsadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuserlevelpermissionsadd.lists["x__tablename"] = <?php echo $userlevelpermissions_add->_tablename->Lookup->toClientList() ?>;
fuserlevelpermissionsadd.lists["x__tablename"].options = <?php echo JsonEncode($userlevelpermissions_add->_tablename->lookupOptions()) ?>;
fuserlevelpermissionsadd.autoSuggests["x__tablename"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $userlevelpermissions_add->showPageHeader(); ?>
<?php
$userlevelpermissions_add->showMessage();
?>
<form name="fuserlevelpermissionsadd" id="fuserlevelpermissionsadd" class="<?php echo $userlevelpermissions_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($userlevelpermissions_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $userlevelpermissions_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="userlevelpermissions">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$userlevelpermissions_add->IsModal ?>">
<?php if (!$userlevelpermissions_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($userlevelpermissions_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_userlevelpermissionsadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($userlevelpermissions->_tablename->Visible) { // tablename ?>
<?php if ($userlevelpermissions_add->IsMobileOrModal) { ?>
	<div id="r__tablename" class="form-group row">
		<label id="elh_userlevelpermissions__tablename" class="<?php echo $userlevelpermissions_add->LeftColumnClass ?>"><?php echo $userlevelpermissions->_tablename->caption() ?><?php echo ($userlevelpermissions->_tablename->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $userlevelpermissions_add->RightColumnClass ?>"><div<?php echo $userlevelpermissions->_tablename->cellAttributes() ?>>
<span id="el_userlevelpermissions__tablename">
<?php
$wrkonchange = "" . trim(@$userlevelpermissions->_tablename->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$userlevelpermissions->_tablename->EditAttrs["onchange"] = "";
?>
<span id="as_x__tablename" class="text-nowrap" style="z-index: 8980">
	<input type="text" class="form-control" name="sv_x__tablename" id="sv_x__tablename" value="<?php echo RemoveHtml($userlevelpermissions->_tablename->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($userlevelpermissions->_tablename->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($userlevelpermissions->_tablename->getPlaceHolder()) ?>"<?php echo $userlevelpermissions->_tablename->editAttributes() ?>>
</span>
<input type="hidden" data-table="userlevelpermissions" data-field="x__tablename" data-value-separator="<?php echo $userlevelpermissions->_tablename->displayValueSeparatorAttribute() ?>" name="x__tablename" id="x__tablename" value="<?php echo HtmlEncode($userlevelpermissions->_tablename->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fuserlevelpermissionsadd.createAutoSuggest({"id":"x__tablename","forceSelect":true});
</script>
<?php echo $userlevelpermissions->_tablename->Lookup->getParamTag("p_x__tablename") ?>
</span>
<?php echo $userlevelpermissions->_tablename->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__tablename">
		<td class="<?php echo $userlevelpermissions_add->TableLeftColumnClass ?>"><span id="elh_userlevelpermissions__tablename"><?php echo $userlevelpermissions->_tablename->caption() ?><?php echo ($userlevelpermissions->_tablename->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $userlevelpermissions->_tablename->cellAttributes() ?>>
<span id="el_userlevelpermissions__tablename">
<?php
$wrkonchange = "" . trim(@$userlevelpermissions->_tablename->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$userlevelpermissions->_tablename->EditAttrs["onchange"] = "";
?>
<span id="as_x__tablename" class="text-nowrap" style="z-index: 8980">
	<input type="text" class="form-control" name="sv_x__tablename" id="sv_x__tablename" value="<?php echo RemoveHtml($userlevelpermissions->_tablename->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($userlevelpermissions->_tablename->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($userlevelpermissions->_tablename->getPlaceHolder()) ?>"<?php echo $userlevelpermissions->_tablename->editAttributes() ?>>
</span>
<input type="hidden" data-table="userlevelpermissions" data-field="x__tablename" data-value-separator="<?php echo $userlevelpermissions->_tablename->displayValueSeparatorAttribute() ?>" name="x__tablename" id="x__tablename" value="<?php echo HtmlEncode($userlevelpermissions->_tablename->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fuserlevelpermissionsadd.createAutoSuggest({"id":"x__tablename","forceSelect":true});
</script>
<?php echo $userlevelpermissions->_tablename->Lookup->getParamTag("p_x__tablename") ?>
</span>
<?php echo $userlevelpermissions->_tablename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($userlevelpermissions->permission->Visible) { // permission ?>
<?php if ($userlevelpermissions_add->IsMobileOrModal) { ?>
	<div id="r_permission" class="form-group row">
		<label id="elh_userlevelpermissions_permission" for="x_permission" class="<?php echo $userlevelpermissions_add->LeftColumnClass ?>"><?php echo $userlevelpermissions->permission->caption() ?><?php echo ($userlevelpermissions->permission->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $userlevelpermissions_add->RightColumnClass ?>"><div<?php echo $userlevelpermissions->permission->cellAttributes() ?>>
<span id="el_userlevelpermissions_permission">
<input type="text" data-table="userlevelpermissions" data-field="x_permission" name="x_permission" id="x_permission" size="30" placeholder="<?php echo HtmlEncode($userlevelpermissions->permission->getPlaceHolder()) ?>" value="<?php echo $userlevelpermissions->permission->EditValue ?>"<?php echo $userlevelpermissions->permission->editAttributes() ?>>
</span>
<?php echo $userlevelpermissions->permission->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_permission">
		<td class="<?php echo $userlevelpermissions_add->TableLeftColumnClass ?>"><span id="elh_userlevelpermissions_permission"><?php echo $userlevelpermissions->permission->caption() ?><?php echo ($userlevelpermissions->permission->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $userlevelpermissions->permission->cellAttributes() ?>>
<span id="el_userlevelpermissions_permission">
<input type="text" data-table="userlevelpermissions" data-field="x_permission" name="x_permission" id="x_permission" size="30" placeholder="<?php echo HtmlEncode($userlevelpermissions->permission->getPlaceHolder()) ?>" value="<?php echo $userlevelpermissions->permission->EditValue ?>"<?php echo $userlevelpermissions->permission->editAttributes() ?>>
</span>
<?php echo $userlevelpermissions->permission->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($userlevelpermissions_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$userlevelpermissions_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $userlevelpermissions_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $userlevelpermissions_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$userlevelpermissions_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$userlevelpermissions_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$userlevelpermissions_add->terminate();
?>