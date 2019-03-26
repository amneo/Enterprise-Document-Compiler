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
$users_delete = new users_delete();

// Run the page
$users_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fusersdelete = currentForm = new ew.Form("fusersdelete", "delete");

// Form_CustomValidate event
fusersdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusersdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusersdelete.lists["x_uLevel"] = <?php echo $users_delete->uLevel->Lookup->toClientList() ?>;
fusersdelete.lists["x_uLevel"].options = <?php echo JsonEncode($users_delete->uLevel->lookupOptions()) ?>;
fusersdelete.lists["x_uActivated[]"] = <?php echo $users_delete->uActivated->Lookup->toClientList() ?>;
fusersdelete.lists["x_uActivated[]"].options = <?php echo JsonEncode($users_delete->uActivated->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $users_delete->showPageHeader(); ?>
<?php
$users_delete->showMessage();
?>
<form name="fusersdelete" id="fusersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($users_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $users_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($users_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($users->seqid->Visible) { // seqid ?>
		<th class="<?php echo $users->seqid->headerCellClass() ?>"><span id="elh_users_seqid" class="users_seqid"><?php echo $users->seqid->caption() ?></span></th>
<?php } ?>
<?php if ($users->userName->Visible) { // userName ?>
		<th class="<?php echo $users->userName->headerCellClass() ?>"><span id="elh_users_userName" class="users_userName"><?php echo $users->userName->caption() ?></span></th>
<?php } ?>
<?php if ($users->userLoginId->Visible) { // userLoginId ?>
		<th class="<?php echo $users->userLoginId->headerCellClass() ?>"><span id="elh_users_userLoginId" class="users_userLoginId"><?php echo $users->userLoginId->caption() ?></span></th>
<?php } ?>
<?php if ($users->uEmail->Visible) { // uEmail ?>
		<th class="<?php echo $users->uEmail->headerCellClass() ?>"><span id="elh_users_uEmail" class="users_uEmail"><?php echo $users->uEmail->caption() ?></span></th>
<?php } ?>
<?php if ($users->uLevel->Visible) { // uLevel ?>
		<th class="<?php echo $users->uLevel->headerCellClass() ?>"><span id="elh_users_uLevel" class="users_uLevel"><?php echo $users->uLevel->caption() ?></span></th>
<?php } ?>
<?php if ($users->uPassword->Visible) { // uPassword ?>
		<th class="<?php echo $users->uPassword->headerCellClass() ?>"><span id="elh_users_uPassword" class="users_uPassword"><?php echo $users->uPassword->caption() ?></span></th>
<?php } ?>
<?php if ($users->uProfile->Visible) { // uProfile ?>
		<th class="<?php echo $users->uProfile->headerCellClass() ?>"><span id="elh_users_uProfile" class="users_uProfile"><?php echo $users->uProfile->caption() ?></span></th>
<?php } ?>
<?php if ($users->uReportsTo->Visible) { // uReportsTo ?>
		<th class="<?php echo $users->uReportsTo->headerCellClass() ?>"><span id="elh_users_uReportsTo" class="users_uReportsTo"><?php echo $users->uReportsTo->caption() ?></span></th>
<?php } ?>
<?php if ($users->uActivated->Visible) { // uActivated ?>
		<th class="<?php echo $users->uActivated->headerCellClass() ?>"><span id="elh_users_uActivated" class="users_uActivated"><?php echo $users->uActivated->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$users_delete->RecCnt = 0;
$i = 0;
while (!$users_delete->Recordset->EOF) {
	$users_delete->RecCnt++;
	$users_delete->RowCnt++;

	// Set row properties
	$users->resetAttributes();
	$users->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$users_delete->loadRowValues($users_delete->Recordset);

	// Render row
	$users_delete->renderRow();
?>
	<tr<?php echo $users->rowAttributes() ?>>
<?php if ($users->seqid->Visible) { // seqid ?>
		<td<?php echo $users->seqid->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_seqid" class="users_seqid">
<span<?php echo $users->seqid->viewAttributes() ?>>
<?php echo $users->seqid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->userName->Visible) { // userName ?>
		<td<?php echo $users->userName->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_userName" class="users_userName">
<span<?php echo $users->userName->viewAttributes() ?>>
<?php echo $users->userName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->userLoginId->Visible) { // userLoginId ?>
		<td<?php echo $users->userLoginId->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_userLoginId" class="users_userLoginId">
<span<?php echo $users->userLoginId->viewAttributes() ?>>
<?php echo $users->userLoginId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->uEmail->Visible) { // uEmail ?>
		<td<?php echo $users->uEmail->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_uEmail" class="users_uEmail">
<span<?php echo $users->uEmail->viewAttributes() ?>>
<?php echo $users->uEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->uLevel->Visible) { // uLevel ?>
		<td<?php echo $users->uLevel->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_uLevel" class="users_uLevel">
<span<?php echo $users->uLevel->viewAttributes() ?>>
<?php echo $users->uLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->uPassword->Visible) { // uPassword ?>
		<td<?php echo $users->uPassword->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_uPassword" class="users_uPassword">
<span<?php echo $users->uPassword->viewAttributes() ?>>
<?php echo $users->uPassword->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->uProfile->Visible) { // uProfile ?>
		<td<?php echo $users->uProfile->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_uProfile" class="users_uProfile">
<span<?php echo $users->uProfile->viewAttributes() ?>>
<?php echo $users->uProfile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->uReportsTo->Visible) { // uReportsTo ?>
		<td<?php echo $users->uReportsTo->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_uReportsTo" class="users_uReportsTo">
<span<?php echo $users->uReportsTo->viewAttributes() ?>>
<?php echo $users->uReportsTo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users->uActivated->Visible) { // uActivated ?>
		<td<?php echo $users->uActivated->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCnt ?>_users_uActivated" class="users_uActivated">
<span<?php echo $users->uActivated->viewAttributes() ?>>
<?php if (ConvertToBool($users->uActivated->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $users->uActivated->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $users->uActivated->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$users_delete->Recordset->moveNext();
}
$users_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$users_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$users_delete->terminate();
?>