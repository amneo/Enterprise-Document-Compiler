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
$users_add = new users_add();

// Run the page
$users_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fusersadd = currentForm = new ew.Form("fusersadd", "add");

// Validate form
fusersadd.validate = function() {
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
		<?php if ($users_add->userName->Required) { ?>
			elm = this.getElements("x" + infix + "_userName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->userName->caption(), $users->userName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_add->userLoginId->Required) { ?>
			elm = this.getElements("x" + infix + "_userLoginId");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->userLoginId->caption(), $users->userLoginId->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_add->uEmail->Required) { ?>
			elm = this.getElements("x" + infix + "_uEmail");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->uEmail->caption(), $users->uEmail->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_add->uLevel->Required) { ?>
			elm = this.getElements("x" + infix + "_uLevel");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->uLevel->caption(), $users->uLevel->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_add->uPassword->Required) { ?>
			elm = this.getElements("x" + infix + "_uPassword");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->uPassword->caption(), $users->uPassword->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_add->uProfile->Required) { ?>
			elm = this.getElements("x" + infix + "_uProfile");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->uProfile->caption(), $users->uProfile->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_add->uReportsTo->Required) { ?>
			elm = this.getElements("x" + infix + "_uReportsTo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->uReportsTo->caption(), $users->uReportsTo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_uReportsTo");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($users->uReportsTo->errorMessage()) ?>");
		<?php if ($users_add->uActivated->Required) { ?>
			elm = this.getElements("x" + infix + "_uActivated[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->uActivated->caption(), $users->uActivated->RequiredErrorMessage)) ?>");
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
fusersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusersadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusersadd.lists["x_uLevel"] = <?php echo $users_add->uLevel->Lookup->toClientList() ?>;
fusersadd.lists["x_uLevel"].options = <?php echo JsonEncode($users_add->uLevel->lookupOptions()) ?>;
fusersadd.lists["x_uActivated[]"] = <?php echo $users_add->uActivated->Lookup->toClientList() ?>;
fusersadd.lists["x_uActivated[]"].options = <?php echo JsonEncode($users_add->uActivated->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $users_add->showPageHeader(); ?>
<?php
$users_add->showMessage();
?>
<form name="fusersadd" id="fusersadd" class="<?php echo $users_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($users_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $users_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$users_add->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<?php if (!$users_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($users_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_usersadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($users->userName->Visible) { // userName ?>
<?php if ($users_add->IsMobileOrModal) { ?>
	<div id="r_userName" class="form-group row">
		<label id="elh_users_userName" for="x_userName" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users->userName->caption() ?><?php echo ($users->userName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div<?php echo $users->userName->cellAttributes() ?>>
<span id="el_users_userName">
<input type="text" data-table="users" data-field="x_userName" name="x_userName" id="x_userName" size="30" placeholder="<?php echo HtmlEncode($users->userName->getPlaceHolder()) ?>" value="<?php echo $users->userName->EditValue ?>"<?php echo $users->userName->editAttributes() ?>>
</span>
<?php echo $users->userName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_userName">
		<td class="<?php echo $users_add->TableLeftColumnClass ?>"><span id="elh_users_userName"><?php echo $users->userName->caption() ?><?php echo ($users->userName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $users->userName->cellAttributes() ?>>
<span id="el_users_userName">
<input type="text" data-table="users" data-field="x_userName" name="x_userName" id="x_userName" size="30" placeholder="<?php echo HtmlEncode($users->userName->getPlaceHolder()) ?>" value="<?php echo $users->userName->EditValue ?>"<?php echo $users->userName->editAttributes() ?>>
</span>
<?php echo $users->userName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($users->userLoginId->Visible) { // userLoginId ?>
<?php if ($users_add->IsMobileOrModal) { ?>
	<div id="r_userLoginId" class="form-group row">
		<label id="elh_users_userLoginId" for="x_userLoginId" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users->userLoginId->caption() ?><?php echo ($users->userLoginId->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div<?php echo $users->userLoginId->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$users->userIDAllow("add")) { // Non system admin ?>
<span id="el_users_userLoginId">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="users" data-field="x_userLoginId" data-value-separator="<?php echo $users->userLoginId->displayValueSeparatorAttribute() ?>" id="x_userLoginId" name="x_userLoginId"<?php echo $users->userLoginId->editAttributes() ?>>
		<?php echo $users->userLoginId->selectOptionListHtml("x_userLoginId") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el_users_userLoginId">
<input type="text" data-table="users" data-field="x_userLoginId" name="x_userLoginId" id="x_userLoginId" size="30" placeholder="<?php echo HtmlEncode($users->userLoginId->getPlaceHolder()) ?>" value="<?php echo $users->userLoginId->EditValue ?>"<?php echo $users->userLoginId->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $users->userLoginId->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_userLoginId">
		<td class="<?php echo $users_add->TableLeftColumnClass ?>"><span id="elh_users_userLoginId"><?php echo $users->userLoginId->caption() ?><?php echo ($users->userLoginId->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $users->userLoginId->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$users->userIDAllow("add")) { // Non system admin ?>
<span id="el_users_userLoginId">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="users" data-field="x_userLoginId" data-value-separator="<?php echo $users->userLoginId->displayValueSeparatorAttribute() ?>" id="x_userLoginId" name="x_userLoginId"<?php echo $users->userLoginId->editAttributes() ?>>
		<?php echo $users->userLoginId->selectOptionListHtml("x_userLoginId") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el_users_userLoginId">
<input type="text" data-table="users" data-field="x_userLoginId" name="x_userLoginId" id="x_userLoginId" size="30" placeholder="<?php echo HtmlEncode($users->userLoginId->getPlaceHolder()) ?>" value="<?php echo $users->userLoginId->EditValue ?>"<?php echo $users->userLoginId->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $users->userLoginId->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($users->uEmail->Visible) { // uEmail ?>
<?php if ($users_add->IsMobileOrModal) { ?>
	<div id="r_uEmail" class="form-group row">
		<label id="elh_users_uEmail" for="x_uEmail" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users->uEmail->caption() ?><?php echo ($users->uEmail->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div<?php echo $users->uEmail->cellAttributes() ?>>
<span id="el_users_uEmail">
<input type="text" data-table="users" data-field="x_uEmail" name="x_uEmail" id="x_uEmail" size="30" placeholder="<?php echo HtmlEncode($users->uEmail->getPlaceHolder()) ?>" value="<?php echo $users->uEmail->EditValue ?>"<?php echo $users->uEmail->editAttributes() ?>>
</span>
<?php echo $users->uEmail->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_uEmail">
		<td class="<?php echo $users_add->TableLeftColumnClass ?>"><span id="elh_users_uEmail"><?php echo $users->uEmail->caption() ?><?php echo ($users->uEmail->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $users->uEmail->cellAttributes() ?>>
<span id="el_users_uEmail">
<input type="text" data-table="users" data-field="x_uEmail" name="x_uEmail" id="x_uEmail" size="30" placeholder="<?php echo HtmlEncode($users->uEmail->getPlaceHolder()) ?>" value="<?php echo $users->uEmail->EditValue ?>"<?php echo $users->uEmail->editAttributes() ?>>
</span>
<?php echo $users->uEmail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($users->uLevel->Visible) { // uLevel ?>
<?php if ($users_add->IsMobileOrModal) { ?>
	<div id="r_uLevel" class="form-group row">
		<label id="elh_users_uLevel" for="x_uLevel" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users->uLevel->caption() ?><?php echo ($users->uLevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div<?php echo $users->uLevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_users_uLevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->uLevel->EditValue) ?>">
</span>
<?php } else { ?>
<span id="el_users_uLevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="users" data-field="x_uLevel" data-value-separator="<?php echo $users->uLevel->displayValueSeparatorAttribute() ?>" id="x_uLevel" name="x_uLevel"<?php echo $users->uLevel->editAttributes() ?>>
		<?php echo $users->uLevel->selectOptionListHtml("x_uLevel") ?>
	</select>
</div>
<?php echo $users->uLevel->Lookup->getParamTag("p_x_uLevel") ?>
</span>
<?php } ?>
<?php echo $users->uLevel->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_uLevel">
		<td class="<?php echo $users_add->TableLeftColumnClass ?>"><span id="elh_users_uLevel"><?php echo $users->uLevel->caption() ?><?php echo ($users->uLevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $users->uLevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_users_uLevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->uLevel->EditValue) ?>">
</span>
<?php } else { ?>
<span id="el_users_uLevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="users" data-field="x_uLevel" data-value-separator="<?php echo $users->uLevel->displayValueSeparatorAttribute() ?>" id="x_uLevel" name="x_uLevel"<?php echo $users->uLevel->editAttributes() ?>>
		<?php echo $users->uLevel->selectOptionListHtml("x_uLevel") ?>
	</select>
</div>
<?php echo $users->uLevel->Lookup->getParamTag("p_x_uLevel") ?>
</span>
<?php } ?>
<?php echo $users->uLevel->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($users->uPassword->Visible) { // uPassword ?>
<?php if ($users_add->IsMobileOrModal) { ?>
	<div id="r_uPassword" class="form-group row">
		<label id="elh_users_uPassword" for="x_uPassword" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users->uPassword->caption() ?><?php echo ($users->uPassword->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div<?php echo $users->uPassword->cellAttributes() ?>>
<span id="el_users_uPassword">
<input type="password" data-field="x_uPassword" name="x_uPassword" id="x_uPassword" size="30" placeholder="<?php echo HtmlEncode($users->uPassword->getPlaceHolder()) ?>"<?php echo $users->uPassword->editAttributes() ?>>
</span>
<?php echo $users->uPassword->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_uPassword">
		<td class="<?php echo $users_add->TableLeftColumnClass ?>"><span id="elh_users_uPassword"><?php echo $users->uPassword->caption() ?><?php echo ($users->uPassword->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $users->uPassword->cellAttributes() ?>>
<span id="el_users_uPassword">
<input type="password" data-field="x_uPassword" name="x_uPassword" id="x_uPassword" size="30" placeholder="<?php echo HtmlEncode($users->uPassword->getPlaceHolder()) ?>"<?php echo $users->uPassword->editAttributes() ?>>
</span>
<?php echo $users->uPassword->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($users->uProfile->Visible) { // uProfile ?>
<?php if ($users_add->IsMobileOrModal) { ?>
	<div id="r_uProfile" class="form-group row">
		<label id="elh_users_uProfile" for="x_uProfile" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users->uProfile->caption() ?><?php echo ($users->uProfile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div<?php echo $users->uProfile->cellAttributes() ?>>
<span id="el_users_uProfile">
<input type="text" data-table="users" data-field="x_uProfile" name="x_uProfile" id="x_uProfile" size="30" placeholder="<?php echo HtmlEncode($users->uProfile->getPlaceHolder()) ?>" value="<?php echo $users->uProfile->EditValue ?>"<?php echo $users->uProfile->editAttributes() ?>>
</span>
<?php echo $users->uProfile->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_uProfile">
		<td class="<?php echo $users_add->TableLeftColumnClass ?>"><span id="elh_users_uProfile"><?php echo $users->uProfile->caption() ?><?php echo ($users->uProfile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $users->uProfile->cellAttributes() ?>>
<span id="el_users_uProfile">
<input type="text" data-table="users" data-field="x_uProfile" name="x_uProfile" id="x_uProfile" size="30" placeholder="<?php echo HtmlEncode($users->uProfile->getPlaceHolder()) ?>" value="<?php echo $users->uProfile->EditValue ?>"<?php echo $users->uProfile->editAttributes() ?>>
</span>
<?php echo $users->uProfile->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($users->uReportsTo->Visible) { // uReportsTo ?>
<?php if ($users_add->IsMobileOrModal) { ?>
	<div id="r_uReportsTo" class="form-group row">
		<label id="elh_users_uReportsTo" for="x_uReportsTo" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users->uReportsTo->caption() ?><?php echo ($users->uReportsTo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div<?php echo $users->uReportsTo->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_users_uReportsTo">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="users" data-field="x_uReportsTo" data-value-separator="<?php echo $users->uReportsTo->displayValueSeparatorAttribute() ?>" id="x_uReportsTo" name="x_uReportsTo"<?php echo $users->uReportsTo->editAttributes() ?>>
		<?php echo $users->uReportsTo->selectOptionListHtml("x_uReportsTo") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el_users_uReportsTo">
<input type="text" data-table="users" data-field="x_uReportsTo" name="x_uReportsTo" id="x_uReportsTo" size="30" placeholder="<?php echo HtmlEncode($users->uReportsTo->getPlaceHolder()) ?>" value="<?php echo $users->uReportsTo->EditValue ?>"<?php echo $users->uReportsTo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $users->uReportsTo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_uReportsTo">
		<td class="<?php echo $users_add->TableLeftColumnClass ?>"><span id="elh_users_uReportsTo"><?php echo $users->uReportsTo->caption() ?><?php echo ($users->uReportsTo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $users->uReportsTo->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_users_uReportsTo">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="users" data-field="x_uReportsTo" data-value-separator="<?php echo $users->uReportsTo->displayValueSeparatorAttribute() ?>" id="x_uReportsTo" name="x_uReportsTo"<?php echo $users->uReportsTo->editAttributes() ?>>
		<?php echo $users->uReportsTo->selectOptionListHtml("x_uReportsTo") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el_users_uReportsTo">
<input type="text" data-table="users" data-field="x_uReportsTo" name="x_uReportsTo" id="x_uReportsTo" size="30" placeholder="<?php echo HtmlEncode($users->uReportsTo->getPlaceHolder()) ?>" value="<?php echo $users->uReportsTo->EditValue ?>"<?php echo $users->uReportsTo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $users->uReportsTo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($users->uActivated->Visible) { // uActivated ?>
<?php if ($users_add->IsMobileOrModal) { ?>
	<div id="r_uActivated" class="form-group row">
		<label id="elh_users_uActivated" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users->uActivated->caption() ?><?php echo ($users->uActivated->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div<?php echo $users->uActivated->cellAttributes() ?>>
<span id="el_users_uActivated">
<?php
$selwrk = (ConvertToBool($users->uActivated->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="users" data-field="x_uActivated" name="x_uActivated[]" id="x_uActivated[]" value="1"<?php echo $selwrk ?><?php echo $users->uActivated->editAttributes() ?>>
</span>
<?php echo $users->uActivated->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_uActivated">
		<td class="<?php echo $users_add->TableLeftColumnClass ?>"><span id="elh_users_uActivated"><?php echo $users->uActivated->caption() ?><?php echo ($users->uActivated->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $users->uActivated->cellAttributes() ?>>
<span id="el_users_uActivated">
<?php
$selwrk = (ConvertToBool($users->uActivated->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="users" data-field="x_uActivated" name="x_uActivated[]" id="x_uActivated[]" value="1"<?php echo $selwrk ?><?php echo $users->uActivated->editAttributes() ?>>
</span>
<?php echo $users->uActivated->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($users_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$users_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $users_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$users_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$users_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$users_add->terminate();
?>