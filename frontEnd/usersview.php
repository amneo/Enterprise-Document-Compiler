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
$users_view = new users_view();

// Run the page
$users_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$users->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fusersview = currentForm = new ew.Form("fusersview", "view");

// Form_CustomValidate event
fusersview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusersview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusersview.lists["x_uLevel"] = <?php echo $users_view->uLevel->Lookup->toClientList() ?>;
fusersview.lists["x_uLevel"].options = <?php echo JsonEncode($users_view->uLevel->lookupOptions()) ?>;
fusersview.lists["x_uActivated[]"] = <?php echo $users_view->uActivated->Lookup->toClientList() ?>;
fusersview.lists["x_uActivated[]"].options = <?php echo JsonEncode($users_view->uActivated->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$users->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $users_view->ExportOptions->render("body") ?>
<?php $users_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $users_view->showPageHeader(); ?>
<?php
$users_view->showMessage();
?>
<form name="fusersview" id="fusersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($users_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $users_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="modal" value="<?php echo (int)$users_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($users->userName->Visible) { // userName ?>
	<tr id="r_userName">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_userName"><?php echo $users->userName->caption() ?></span></td>
		<td data-name="userName"<?php echo $users->userName->cellAttributes() ?>>
<span id="el_users_userName">
<span<?php echo $users->userName->viewAttributes() ?>>
<?php echo $users->userName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->userLoginId->Visible) { // userLoginId ?>
	<tr id="r_userLoginId">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_userLoginId"><?php echo $users->userLoginId->caption() ?></span></td>
		<td data-name="userLoginId"<?php echo $users->userLoginId->cellAttributes() ?>>
<span id="el_users_userLoginId">
<span<?php echo $users->userLoginId->viewAttributes() ?>>
<?php echo $users->userLoginId->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->uEmail->Visible) { // uEmail ?>
	<tr id="r_uEmail">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_uEmail"><?php echo $users->uEmail->caption() ?></span></td>
		<td data-name="uEmail"<?php echo $users->uEmail->cellAttributes() ?>>
<span id="el_users_uEmail">
<span<?php echo $users->uEmail->viewAttributes() ?>>
<?php echo $users->uEmail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->uLevel->Visible) { // uLevel ?>
	<tr id="r_uLevel">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_uLevel"><?php echo $users->uLevel->caption() ?></span></td>
		<td data-name="uLevel"<?php echo $users->uLevel->cellAttributes() ?>>
<span id="el_users_uLevel">
<span<?php echo $users->uLevel->viewAttributes() ?>>
<?php echo $users->uLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->uPassword->Visible) { // uPassword ?>
	<tr id="r_uPassword">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_uPassword"><?php echo $users->uPassword->caption() ?></span></td>
		<td data-name="uPassword"<?php echo $users->uPassword->cellAttributes() ?>>
<span id="el_users_uPassword">
<span<?php echo $users->uPassword->viewAttributes() ?>>
<?php echo $users->uPassword->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->uProfile->Visible) { // uProfile ?>
	<tr id="r_uProfile">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_uProfile"><?php echo $users->uProfile->caption() ?></span></td>
		<td data-name="uProfile"<?php echo $users->uProfile->cellAttributes() ?>>
<span id="el_users_uProfile">
<span<?php echo $users->uProfile->viewAttributes() ?>>
<?php echo $users->uProfile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->uReportsTo->Visible) { // uReportsTo ?>
	<tr id="r_uReportsTo">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_uReportsTo"><?php echo $users->uReportsTo->caption() ?></span></td>
		<td data-name="uReportsTo"<?php echo $users->uReportsTo->cellAttributes() ?>>
<span id="el_users_uReportsTo">
<span<?php echo $users->uReportsTo->viewAttributes() ?>>
<?php echo $users->uReportsTo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users->uActivated->Visible) { // uActivated ?>
	<tr id="r_uActivated">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_uActivated"><?php echo $users->uActivated->caption() ?></span></td>
		<td data-name="uActivated"<?php echo $users->uActivated->cellAttributes() ?>>
<span id="el_users_uActivated">
<span<?php echo $users->uActivated->viewAttributes() ?>>
<?php if (ConvertToBool($users->uActivated->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $users->uActivated->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $users->uActivated->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$users_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$users->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$users_view->terminate();
?>