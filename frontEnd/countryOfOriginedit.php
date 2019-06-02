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
$countryOfOrigin_edit = new countryOfOrigin_edit();

// Run the page
$countryOfOrigin_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$countryOfOrigin_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcountryOfOriginedit = currentForm = new ew.Form("fcountryOfOriginedit", "edit");

// Validate form
fcountryOfOriginedit.validate = function() {
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
		<?php if ($countryOfOrigin_edit->cooId->Required) { ?>
			elm = this.getElements("x" + infix + "_cooId");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $countryOfOrigin->cooId->caption(), $countryOfOrigin->cooId->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($countryOfOrigin_edit->countryName->Required) { ?>
			elm = this.getElements("x" + infix + "_countryName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $countryOfOrigin->countryName->caption(), $countryOfOrigin->countryName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($countryOfOrigin_edit->countryIsoCode->Required) { ?>
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
fcountryOfOriginedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcountryOfOriginedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $countryOfOrigin_edit->showPageHeader(); ?>
<?php
$countryOfOrigin_edit->showMessage();
?>
<?php if (!$countryOfOrigin_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($countryOfOrigin_edit->Pager)) $countryOfOrigin_edit->Pager = new NumericPager($countryOfOrigin_edit->StartRec, $countryOfOrigin_edit->DisplayRecs, $countryOfOrigin_edit->TotalRecs, $countryOfOrigin_edit->RecRange, $countryOfOrigin_edit->AutoHidePager) ?>
<?php if ($countryOfOrigin_edit->Pager->RecordCount > 0 && $countryOfOrigin_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($countryOfOrigin_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_edit->pageUrl() ?>start=<?php echo $countryOfOrigin_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($countryOfOrigin_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_edit->pageUrl() ?>start=<?php echo $countryOfOrigin_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($countryOfOrigin_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $countryOfOrigin_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($countryOfOrigin_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_edit->pageUrl() ?>start=<?php echo $countryOfOrigin_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($countryOfOrigin_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_edit->pageUrl() ?>start=<?php echo $countryOfOrigin_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcountryOfOriginedit" id="fcountryOfOriginedit" class="<?php echo $countryOfOrigin_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($countryOfOrigin_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $countryOfOrigin_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="countryOfOrigin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$countryOfOrigin_edit->IsModal ?>">
<?php if (!$countryOfOrigin_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($countryOfOrigin_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_countryOfOriginedit" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($countryOfOrigin->cooId->Visible) { // cooId ?>
<?php if ($countryOfOrigin_edit->IsMobileOrModal) { ?>
	<div id="r_cooId" class="form-group row">
		<label id="elh_countryOfOrigin_cooId" class="<?php echo $countryOfOrigin_edit->LeftColumnClass ?>"><?php echo $countryOfOrigin->cooId->caption() ?><?php echo ($countryOfOrigin->cooId->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $countryOfOrigin_edit->RightColumnClass ?>"><div<?php echo $countryOfOrigin->cooId->cellAttributes() ?>>
<span id="el_countryOfOrigin_cooId">
<span<?php echo $countryOfOrigin->cooId->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($countryOfOrigin->cooId->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="countryOfOrigin" data-field="x_cooId" name="x_cooId" id="x_cooId" value="<?php echo HtmlEncode($countryOfOrigin->cooId->CurrentValue) ?>">
<?php echo $countryOfOrigin->cooId->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cooId">
		<td class="<?php echo $countryOfOrigin_edit->TableLeftColumnClass ?>"><span id="elh_countryOfOrigin_cooId"><?php echo $countryOfOrigin->cooId->caption() ?><?php echo ($countryOfOrigin->cooId->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $countryOfOrigin->cooId->cellAttributes() ?>>
<span id="el_countryOfOrigin_cooId">
<span<?php echo $countryOfOrigin->cooId->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($countryOfOrigin->cooId->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="countryOfOrigin" data-field="x_cooId" name="x_cooId" id="x_cooId" value="<?php echo HtmlEncode($countryOfOrigin->cooId->CurrentValue) ?>">
<?php echo $countryOfOrigin->cooId->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($countryOfOrigin->countryName->Visible) { // countryName ?>
<?php if ($countryOfOrigin_edit->IsMobileOrModal) { ?>
	<div id="r_countryName" class="form-group row">
		<label id="elh_countryOfOrigin_countryName" for="x_countryName" class="<?php echo $countryOfOrigin_edit->LeftColumnClass ?>"><?php echo $countryOfOrigin->countryName->caption() ?><?php echo ($countryOfOrigin->countryName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $countryOfOrigin_edit->RightColumnClass ?>"><div<?php echo $countryOfOrigin->countryName->cellAttributes() ?>>
<span id="el_countryOfOrigin_countryName">
<input type="text" data-table="countryOfOrigin" data-field="x_countryName" name="x_countryName" id="x_countryName" size="30" placeholder="<?php echo HtmlEncode($countryOfOrigin->countryName->getPlaceHolder()) ?>" value="<?php echo $countryOfOrigin->countryName->EditValue ?>"<?php echo $countryOfOrigin->countryName->editAttributes() ?>>
</span>
<?php echo $countryOfOrigin->countryName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_countryName">
		<td class="<?php echo $countryOfOrigin_edit->TableLeftColumnClass ?>"><span id="elh_countryOfOrigin_countryName"><?php echo $countryOfOrigin->countryName->caption() ?><?php echo ($countryOfOrigin->countryName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $countryOfOrigin->countryName->cellAttributes() ?>>
<span id="el_countryOfOrigin_countryName">
<input type="text" data-table="countryOfOrigin" data-field="x_countryName" name="x_countryName" id="x_countryName" size="30" placeholder="<?php echo HtmlEncode($countryOfOrigin->countryName->getPlaceHolder()) ?>" value="<?php echo $countryOfOrigin->countryName->EditValue ?>"<?php echo $countryOfOrigin->countryName->editAttributes() ?>>
</span>
<?php echo $countryOfOrigin->countryName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($countryOfOrigin->countryIsoCode->Visible) { // countryIsoCode ?>
<?php if ($countryOfOrigin_edit->IsMobileOrModal) { ?>
	<div id="r_countryIsoCode" class="form-group row">
		<label id="elh_countryOfOrigin_countryIsoCode" for="x_countryIsoCode" class="<?php echo $countryOfOrigin_edit->LeftColumnClass ?>"><?php echo $countryOfOrigin->countryIsoCode->caption() ?><?php echo ($countryOfOrigin->countryIsoCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $countryOfOrigin_edit->RightColumnClass ?>"><div<?php echo $countryOfOrigin->countryIsoCode->cellAttributes() ?>>
<span id="el_countryOfOrigin_countryIsoCode">
<input type="text" data-table="countryOfOrigin" data-field="x_countryIsoCode" name="x_countryIsoCode" id="x_countryIsoCode" size="30" placeholder="<?php echo HtmlEncode($countryOfOrigin->countryIsoCode->getPlaceHolder()) ?>" value="<?php echo $countryOfOrigin->countryIsoCode->EditValue ?>"<?php echo $countryOfOrigin->countryIsoCode->editAttributes() ?>>
</span>
<?php echo $countryOfOrigin->countryIsoCode->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_countryIsoCode">
		<td class="<?php echo $countryOfOrigin_edit->TableLeftColumnClass ?>"><span id="elh_countryOfOrigin_countryIsoCode"><?php echo $countryOfOrigin->countryIsoCode->caption() ?><?php echo ($countryOfOrigin->countryIsoCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $countryOfOrigin->countryIsoCode->cellAttributes() ?>>
<span id="el_countryOfOrigin_countryIsoCode">
<input type="text" data-table="countryOfOrigin" data-field="x_countryIsoCode" name="x_countryIsoCode" id="x_countryIsoCode" size="30" placeholder="<?php echo HtmlEncode($countryOfOrigin->countryIsoCode->getPlaceHolder()) ?>" value="<?php echo $countryOfOrigin->countryIsoCode->EditValue ?>"<?php echo $countryOfOrigin->countryIsoCode->editAttributes() ?>>
</span>
<?php echo $countryOfOrigin->countryIsoCode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($countryOfOrigin_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$countryOfOrigin_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $countryOfOrigin_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $countryOfOrigin_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$countryOfOrigin_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
<?php if (!$countryOfOrigin_edit->IsModal) { ?>
<?php if (!isset($countryOfOrigin_edit->Pager)) $countryOfOrigin_edit->Pager = new NumericPager($countryOfOrigin_edit->StartRec, $countryOfOrigin_edit->DisplayRecs, $countryOfOrigin_edit->TotalRecs, $countryOfOrigin_edit->RecRange, $countryOfOrigin_edit->AutoHidePager) ?>
<?php if ($countryOfOrigin_edit->Pager->RecordCount > 0 && $countryOfOrigin_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($countryOfOrigin_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_edit->pageUrl() ?>start=<?php echo $countryOfOrigin_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($countryOfOrigin_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_edit->pageUrl() ?>start=<?php echo $countryOfOrigin_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($countryOfOrigin_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $countryOfOrigin_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($countryOfOrigin_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_edit->pageUrl() ?>start=<?php echo $countryOfOrigin_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($countryOfOrigin_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_edit->pageUrl() ?>start=<?php echo $countryOfOrigin_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$countryOfOrigin_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$countryOfOrigin_edit->terminate();
?>