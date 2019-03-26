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
$register = new register();

// Run the page
$register->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$register->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "register";
var fregister = currentForm = new ew.Form("fregister", "register");

// Validate form
fregister.validate = function() {
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
		<?php if ($register->userName->Required) { ?>
			elm = this.getElements("x" + infix + "_userName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->userName->caption(), $users->userName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($register->userLoginId->Required) { ?>
			elm = this.getElements("x" + infix + "_userLoginId");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, ew.language.phrase("EnterUserName"));
		<?php } ?>
		<?php if ($register->uEmail->Required) { ?>
			elm = this.getElements("x" + infix + "_uEmail");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->uEmail->caption(), $users->uEmail->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($register->uPassword->Required) { ?>
			elm = this.getElements("x" + infix + "_uPassword");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, ew.language.phrase("EnterPassword"));
		<?php } ?>
			if (fobj.c_uPassword.value != fobj.x_uPassword.value)
				return this.onError(fobj.c_uPassword, ew.language.phrase("MismatchPassword"));

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fregister.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fregister.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $register->showPageHeader(); ?>
<?php
$register->showMessage();
?>
<form name="fregister" id="fregister" class="<?php echo $register->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($register->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $register->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="insert">
<!-- Fields to prevent google autofill -->
<input type="hidden" type="text" name="<?php echo Encrypt(Random()) ?>">
<input type="hidden" type="password" name="<?php echo Encrypt(Random()) ?>">
<?php if ($users->isConfirm()) { // Confirm page ?>
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } ?>
<?php if (!IsMobile()) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if (IsMobile()) { ?>
<div class="ew-register-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_register" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($users->userName->Visible) { // userName ?>
<?php if (IsMobile()) { ?>
	<div id="r_userName" class="form-group row">
		<label id="elh_users_userName" for="x_userName" class="<?php echo $register->LeftColumnClass ?>"><?php echo $users->userName->caption() ?><?php echo ($users->userName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $users->userName->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_userName">
<input type="text" data-table="users" data-field="x_userName" name="x_userName" id="x_userName" size="30" placeholder="<?php echo HtmlEncode($users->userName->getPlaceHolder()) ?>" value="<?php echo $users->userName->EditValue ?>"<?php echo $users->userName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_userName">
<span<?php echo $users->userName->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->userName->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_userName" name="x_userName" id="x_userName" value="<?php echo HtmlEncode($users->userName->FormValue) ?>">
<?php } ?>
<?php echo $users->userName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_userName">
		<td class="<?php echo $register->TableLeftColumnClass ?>"><span id="elh_users_userName"><?php echo $users->userName->caption() ?><?php echo ($users->userName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $users->userName->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_userName">
<input type="text" data-table="users" data-field="x_userName" name="x_userName" id="x_userName" size="30" placeholder="<?php echo HtmlEncode($users->userName->getPlaceHolder()) ?>" value="<?php echo $users->userName->EditValue ?>"<?php echo $users->userName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_userName">
<span<?php echo $users->userName->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->userName->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_userName" name="x_userName" id="x_userName" value="<?php echo HtmlEncode($users->userName->FormValue) ?>">
<?php } ?>
<?php echo $users->userName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($users->userLoginId->Visible) { // userLoginId ?>
<?php if (IsMobile()) { ?>
	<div id="r_userLoginId" class="form-group row">
		<label id="elh_users_userLoginId" for="x_userLoginId" class="<?php echo $register->LeftColumnClass ?>"><?php echo $users->userLoginId->caption() ?><?php echo ($users->userLoginId->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $users->userLoginId->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_userLoginId">
<input type="text" data-table="users" data-field="x_userLoginId" name="x_userLoginId" id="x_userLoginId" size="30" placeholder="<?php echo HtmlEncode($users->userLoginId->getPlaceHolder()) ?>" value="<?php echo $users->userLoginId->EditValue ?>"<?php echo $users->userLoginId->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_userLoginId">
<span<?php echo $users->userLoginId->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->userLoginId->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_userLoginId" name="x_userLoginId" id="x_userLoginId" value="<?php echo HtmlEncode($users->userLoginId->FormValue) ?>">
<?php } ?>
<?php echo $users->userLoginId->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_userLoginId">
		<td class="<?php echo $register->TableLeftColumnClass ?>"><span id="elh_users_userLoginId"><?php echo $users->userLoginId->caption() ?><?php echo ($users->userLoginId->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $users->userLoginId->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_userLoginId">
<input type="text" data-table="users" data-field="x_userLoginId" name="x_userLoginId" id="x_userLoginId" size="30" placeholder="<?php echo HtmlEncode($users->userLoginId->getPlaceHolder()) ?>" value="<?php echo $users->userLoginId->EditValue ?>"<?php echo $users->userLoginId->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_userLoginId">
<span<?php echo $users->userLoginId->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->userLoginId->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_userLoginId" name="x_userLoginId" id="x_userLoginId" value="<?php echo HtmlEncode($users->userLoginId->FormValue) ?>">
<?php } ?>
<?php echo $users->userLoginId->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($users->uEmail->Visible) { // uEmail ?>
<?php if (IsMobile()) { ?>
	<div id="r_uEmail" class="form-group row">
		<label id="elh_users_uEmail" for="x_uEmail" class="<?php echo $register->LeftColumnClass ?>"><?php echo $users->uEmail->caption() ?><?php echo ($users->uEmail->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $users->uEmail->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_uEmail">
<input type="text" data-table="users" data-field="x_uEmail" name="x_uEmail" id="x_uEmail" size="30" placeholder="<?php echo HtmlEncode($users->uEmail->getPlaceHolder()) ?>" value="<?php echo $users->uEmail->EditValue ?>"<?php echo $users->uEmail->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_uEmail">
<span<?php echo $users->uEmail->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->uEmail->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_uEmail" name="x_uEmail" id="x_uEmail" value="<?php echo HtmlEncode($users->uEmail->FormValue) ?>">
<?php } ?>
<?php echo $users->uEmail->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_uEmail">
		<td class="<?php echo $register->TableLeftColumnClass ?>"><span id="elh_users_uEmail"><?php echo $users->uEmail->caption() ?><?php echo ($users->uEmail->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $users->uEmail->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_uEmail">
<input type="text" data-table="users" data-field="x_uEmail" name="x_uEmail" id="x_uEmail" size="30" placeholder="<?php echo HtmlEncode($users->uEmail->getPlaceHolder()) ?>" value="<?php echo $users->uEmail->EditValue ?>"<?php echo $users->uEmail->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_uEmail">
<span<?php echo $users->uEmail->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->uEmail->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_uEmail" name="x_uEmail" id="x_uEmail" value="<?php echo HtmlEncode($users->uEmail->FormValue) ?>">
<?php } ?>
<?php echo $users->uEmail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($users->uPassword->Visible) { // uPassword ?>
<?php if (IsMobile()) { ?>
	<div id="r_uPassword" class="form-group row">
		<label id="elh_users_uPassword" for="x_uPassword" class="<?php echo $register->LeftColumnClass ?>"><?php echo $users->uPassword->caption() ?><?php echo ($users->uPassword->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $users->uPassword->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_uPassword">
<input type="text" data-table="users" data-field="x_uPassword" name="x_uPassword" id="x_uPassword" size="30" placeholder="<?php echo HtmlEncode($users->uPassword->getPlaceHolder()) ?>" value="<?php echo $users->uPassword->EditValue ?>"<?php echo $users->uPassword->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_uPassword">
<span<?php echo $users->uPassword->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->uPassword->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_uPassword" name="x_uPassword" id="x_uPassword" value="<?php echo HtmlEncode($users->uPassword->FormValue) ?>">
<?php } ?>
<?php echo $users->uPassword->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_uPassword">
		<td class="<?php echo $register->TableLeftColumnClass ?>"><span id="elh_users_uPassword"><?php echo $users->uPassword->caption() ?><?php echo ($users->uPassword->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $users->uPassword->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_users_uPassword">
<input type="text" data-table="users" data-field="x_uPassword" name="x_uPassword" id="x_uPassword" size="30" placeholder="<?php echo HtmlEncode($users->uPassword->getPlaceHolder()) ?>" value="<?php echo $users->uPassword->EditValue ?>"<?php echo $users->uPassword->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_users_uPassword">
<span<?php echo $users->uPassword->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->uPassword->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_uPassword" name="x_uPassword" id="x_uPassword" value="<?php echo HtmlEncode($users->uPassword->FormValue) ?>">
<?php } ?>
<?php echo $users->uPassword->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($users->uPassword->Visible) { // uPassword ?>
<?php if (IsMobile()) { ?>
	<div id="r_c_uPassword" class="form-group row">
		<label id="elh_c_users_uPassword" for="c_uPassword" class="<?php echo $register->LeftColumnClass ?>"><?php echo $Language->phrase("Confirm") ?> <?php echo $users->uPassword->caption() ?><?php echo ($users->uPassword->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $users->uPassword->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_c_users_uPassword">
<input type="text" data-table="users" data-field="c_uPassword" name="c_uPassword" id="c_uPassword" size="30" placeholder="<?php echo HtmlEncode($users->uPassword->getPlaceHolder()) ?>" value="<?php echo $users->uPassword->EditValue ?>"<?php echo $users->uPassword->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_c_users_uPassword">
<span<?php echo $users->uPassword->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->uPassword->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="c_uPassword" name="c_uPassword" id="c_uPassword" value="<?php echo HtmlEncode($users->uPassword->FormValue) ?>">
<?php } ?>
</div></div>
	</div>
<?php } else { ?>
	<tr id="r_c_uPassword">
		<td class="<?php echo $register->TableLeftColumnClass ?>"><span id="elh_c_users_uPassword" class="ew-confirm-password"><?php echo $Language->phrase("Confirm") ?> <?php echo $users->uPassword->caption() ?><?php echo ($users->uPassword->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $users->uPassword->cellAttributes() ?>>
<?php if (!$users->isConfirm()) { ?>
<span id="el_c_users_uPassword">
<input type="text" data-table="users" data-field="c_uPassword" name="c_uPassword" id="c_uPassword" size="30" placeholder="<?php echo HtmlEncode($users->uPassword->getPlaceHolder()) ?>" value="<?php echo $users->uPassword->EditValue ?>"<?php echo $users->uPassword->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_c_users_uPassword">
<span<?php echo $users->uPassword->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($users->uPassword->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="c_uPassword" name="c_uPassword" id="c_uPassword" value="<?php echo HtmlEncode($users->uPassword->FormValue) ?>">
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if (IsMobile()) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $register->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$users->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("RegisterBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php if (!IsMobile()) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$register->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$register->terminate();
?>