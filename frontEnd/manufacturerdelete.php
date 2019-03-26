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
$manufacturer_delete = new manufacturer_delete();

// Run the page
$manufacturer_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$manufacturer_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fmanufacturerdelete = currentForm = new ew.Form("fmanufacturerdelete", "delete");

// Form_CustomValidate event
fmanufacturerdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmanufacturerdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $manufacturer_delete->showPageHeader(); ?>
<?php
$manufacturer_delete->showMessage();
?>
<form name="fmanufacturerdelete" id="fmanufacturerdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($manufacturer_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $manufacturer_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="manufacturer">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($manufacturer_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($manufacturer->manufacturerName->Visible) { // manufacturerName ?>
		<th class="<?php echo $manufacturer->manufacturerName->headerCellClass() ?>"><span id="elh_manufacturer_manufacturerName" class="manufacturer_manufacturerName"><?php echo $manufacturer->manufacturerName->caption() ?></span></th>
<?php } ?>
<?php if ($manufacturer->manufacturerAddress->Visible) { // manufacturerAddress ?>
		<th class="<?php echo $manufacturer->manufacturerAddress->headerCellClass() ?>"><span id="elh_manufacturer_manufacturerAddress" class="manufacturer_manufacturerAddress"><?php echo $manufacturer->manufacturerAddress->caption() ?></span></th>
<?php } ?>
<?php if ($manufacturer->manufacturerFactory->Visible) { // manufacturerFactory ?>
		<th class="<?php echo $manufacturer->manufacturerFactory->headerCellClass() ?>"><span id="elh_manufacturer_manufacturerFactory" class="manufacturer_manufacturerFactory"><?php echo $manufacturer->manufacturerFactory->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$manufacturer_delete->RecCnt = 0;
$i = 0;
while (!$manufacturer_delete->Recordset->EOF) {
	$manufacturer_delete->RecCnt++;
	$manufacturer_delete->RowCnt++;

	// Set row properties
	$manufacturer->resetAttributes();
	$manufacturer->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$manufacturer_delete->loadRowValues($manufacturer_delete->Recordset);

	// Render row
	$manufacturer_delete->renderRow();
?>
	<tr<?php echo $manufacturer->rowAttributes() ?>>
<?php if ($manufacturer->manufacturerName->Visible) { // manufacturerName ?>
		<td<?php echo $manufacturer->manufacturerName->cellAttributes() ?>>
<span id="el<?php echo $manufacturer_delete->RowCnt ?>_manufacturer_manufacturerName" class="manufacturer_manufacturerName">
<span<?php echo $manufacturer->manufacturerName->viewAttributes() ?>>
<?php echo $manufacturer->manufacturerName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($manufacturer->manufacturerAddress->Visible) { // manufacturerAddress ?>
		<td<?php echo $manufacturer->manufacturerAddress->cellAttributes() ?>>
<span id="el<?php echo $manufacturer_delete->RowCnt ?>_manufacturer_manufacturerAddress" class="manufacturer_manufacturerAddress">
<span<?php echo $manufacturer->manufacturerAddress->viewAttributes() ?>>
<?php echo $manufacturer->manufacturerAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($manufacturer->manufacturerFactory->Visible) { // manufacturerFactory ?>
		<td<?php echo $manufacturer->manufacturerFactory->cellAttributes() ?>>
<span id="el<?php echo $manufacturer_delete->RowCnt ?>_manufacturer_manufacturerFactory" class="manufacturer_manufacturerFactory">
<span<?php echo $manufacturer->manufacturerFactory->viewAttributes() ?>>
<?php echo $manufacturer->manufacturerFactory->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$manufacturer_delete->Recordset->moveNext();
}
$manufacturer_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $manufacturer_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$manufacturer_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$manufacturer_delete->terminate();
?>