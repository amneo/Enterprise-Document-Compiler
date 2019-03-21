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
$countryOfOrigin_delete = new countryOfOrigin_delete();

// Run the page
$countryOfOrigin_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$countryOfOrigin_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcountryOfOrigindelete = currentForm = new ew.Form("fcountryOfOrigindelete", "delete");

// Form_CustomValidate event
fcountryOfOrigindelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcountryOfOrigindelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $countryOfOrigin_delete->showPageHeader(); ?>
<?php
$countryOfOrigin_delete->showMessage();
?>
<form name="fcountryOfOrigindelete" id="fcountryOfOrigindelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($countryOfOrigin_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $countryOfOrigin_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="countryOfOrigin">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($countryOfOrigin_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($countryOfOrigin->cooId->Visible) { // cooId ?>
		<th class="<?php echo $countryOfOrigin->cooId->headerCellClass() ?>"><span id="elh_countryOfOrigin_cooId" class="countryOfOrigin_cooId"><?php echo $countryOfOrigin->cooId->caption() ?></span></th>
<?php } ?>
<?php if ($countryOfOrigin->countryName->Visible) { // countryName ?>
		<th class="<?php echo $countryOfOrigin->countryName->headerCellClass() ?>"><span id="elh_countryOfOrigin_countryName" class="countryOfOrigin_countryName"><?php echo $countryOfOrigin->countryName->caption() ?></span></th>
<?php } ?>
<?php if ($countryOfOrigin->countryIsoCode->Visible) { // countryIsoCode ?>
		<th class="<?php echo $countryOfOrigin->countryIsoCode->headerCellClass() ?>"><span id="elh_countryOfOrigin_countryIsoCode" class="countryOfOrigin_countryIsoCode"><?php echo $countryOfOrigin->countryIsoCode->caption() ?></span></th>
<?php } ?>
<?php if ($countryOfOrigin->username->Visible) { // username ?>
		<th class="<?php echo $countryOfOrigin->username->headerCellClass() ?>"><span id="elh_countryOfOrigin_username" class="countryOfOrigin_username"><?php echo $countryOfOrigin->username->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$countryOfOrigin_delete->RecCnt = 0;
$i = 0;
while (!$countryOfOrigin_delete->Recordset->EOF) {
	$countryOfOrigin_delete->RecCnt++;
	$countryOfOrigin_delete->RowCnt++;

	// Set row properties
	$countryOfOrigin->resetAttributes();
	$countryOfOrigin->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$countryOfOrigin_delete->loadRowValues($countryOfOrigin_delete->Recordset);

	// Render row
	$countryOfOrigin_delete->renderRow();
?>
	<tr<?php echo $countryOfOrigin->rowAttributes() ?>>
<?php if ($countryOfOrigin->cooId->Visible) { // cooId ?>
		<td<?php echo $countryOfOrigin->cooId->cellAttributes() ?>>
<span id="el<?php echo $countryOfOrigin_delete->RowCnt ?>_countryOfOrigin_cooId" class="countryOfOrigin_cooId">
<span<?php echo $countryOfOrigin->cooId->viewAttributes() ?>>
<?php echo $countryOfOrigin->cooId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($countryOfOrigin->countryName->Visible) { // countryName ?>
		<td<?php echo $countryOfOrigin->countryName->cellAttributes() ?>>
<span id="el<?php echo $countryOfOrigin_delete->RowCnt ?>_countryOfOrigin_countryName" class="countryOfOrigin_countryName">
<span<?php echo $countryOfOrigin->countryName->viewAttributes() ?>>
<?php echo $countryOfOrigin->countryName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($countryOfOrigin->countryIsoCode->Visible) { // countryIsoCode ?>
		<td<?php echo $countryOfOrigin->countryIsoCode->cellAttributes() ?>>
<span id="el<?php echo $countryOfOrigin_delete->RowCnt ?>_countryOfOrigin_countryIsoCode" class="countryOfOrigin_countryIsoCode">
<span<?php echo $countryOfOrigin->countryIsoCode->viewAttributes() ?>>
<?php echo $countryOfOrigin->countryIsoCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($countryOfOrigin->username->Visible) { // username ?>
		<td<?php echo $countryOfOrigin->username->cellAttributes() ?>>
<span id="el<?php echo $countryOfOrigin_delete->RowCnt ?>_countryOfOrigin_username" class="countryOfOrigin_username">
<span<?php echo $countryOfOrigin->username->viewAttributes() ?>>
<?php echo $countryOfOrigin->username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$countryOfOrigin_delete->Recordset->moveNext();
}
$countryOfOrigin_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $countryOfOrigin_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$countryOfOrigin_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$countryOfOrigin_delete->terminate();
?>