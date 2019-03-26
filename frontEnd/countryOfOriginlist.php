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
$countryOfOrigin_list = new countryOfOrigin_list();

// Run the page
$countryOfOrigin_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$countryOfOrigin_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$countryOfOrigin->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcountryOfOriginlist = currentForm = new ew.Form("fcountryOfOriginlist", "list");
fcountryOfOriginlist.formKeyCountName = '<?php echo $countryOfOrigin_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcountryOfOriginlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcountryOfOriginlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcountryOfOriginlistsrch = currentSearchForm = new ew.Form("fcountryOfOriginlistsrch");

// Filters
fcountryOfOriginlistsrch.filterList = <?php echo $countryOfOrigin_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$countryOfOrigin->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($countryOfOrigin_list->TotalRecs > 0 && $countryOfOrigin_list->ExportOptions->visible()) { ?>
<?php $countryOfOrigin_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($countryOfOrigin_list->ImportOptions->visible()) { ?>
<?php $countryOfOrigin_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($countryOfOrigin_list->SearchOptions->visible()) { ?>
<?php $countryOfOrigin_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($countryOfOrigin_list->FilterOptions->visible()) { ?>
<?php $countryOfOrigin_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$countryOfOrigin_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$countryOfOrigin->isExport() && !$countryOfOrigin->CurrentAction) { ?>
<form name="fcountryOfOriginlistsrch" id="fcountryOfOriginlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($countryOfOrigin_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcountryOfOriginlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="countryOfOrigin">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($countryOfOrigin_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($countryOfOrigin_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $countryOfOrigin_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($countryOfOrigin_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($countryOfOrigin_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($countryOfOrigin_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($countryOfOrigin_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $countryOfOrigin_list->showPageHeader(); ?>
<?php
$countryOfOrigin_list->showMessage();
?>
<?php if ($countryOfOrigin_list->TotalRecs > 0 || $countryOfOrigin->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($countryOfOrigin_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> countryOfOrigin">
<?php if (!$countryOfOrigin->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$countryOfOrigin->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($countryOfOrigin_list->Pager)) $countryOfOrigin_list->Pager = new NumericPager($countryOfOrigin_list->StartRec, $countryOfOrigin_list->DisplayRecs, $countryOfOrigin_list->TotalRecs, $countryOfOrigin_list->RecRange, $countryOfOrigin_list->AutoHidePager) ?>
<?php if ($countryOfOrigin_list->Pager->RecordCount > 0 && $countryOfOrigin_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($countryOfOrigin_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_list->pageUrl() ?>start=<?php echo $countryOfOrigin_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($countryOfOrigin_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_list->pageUrl() ?>start=<?php echo $countryOfOrigin_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($countryOfOrigin_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $countryOfOrigin_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($countryOfOrigin_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_list->pageUrl() ?>start=<?php echo $countryOfOrigin_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($countryOfOrigin_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $countryOfOrigin_list->pageUrl() ?>start=<?php echo $countryOfOrigin_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($countryOfOrigin_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $countryOfOrigin_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $countryOfOrigin_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $countryOfOrigin_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $countryOfOrigin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcountryOfOriginlist" id="fcountryOfOriginlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($countryOfOrigin_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $countryOfOrigin_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="countryOfOrigin">
<div id="gmp_countryOfOrigin" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($countryOfOrigin_list->TotalRecs > 0 || $countryOfOrigin->isGridEdit()) { ?>
<table id="tbl_countryOfOriginlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$countryOfOrigin_list->RowType = ROWTYPE_HEADER;

// Render list options
$countryOfOrigin_list->renderListOptions();

// Render list options (header, left)
$countryOfOrigin_list->ListOptions->render("header", "left");
?>
<?php if ($countryOfOrigin->cooId->Visible) { // cooId ?>
	<?php if ($countryOfOrigin->sortUrl($countryOfOrigin->cooId) == "") { ?>
		<th data-name="cooId" class="<?php echo $countryOfOrigin->cooId->headerCellClass() ?>"><div id="elh_countryOfOrigin_cooId" class="countryOfOrigin_cooId"><div class="ew-table-header-caption"><?php echo $countryOfOrigin->cooId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cooId" class="<?php echo $countryOfOrigin->cooId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $countryOfOrigin->SortUrl($countryOfOrigin->cooId) ?>',2);"><div id="elh_countryOfOrigin_cooId" class="countryOfOrigin_cooId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $countryOfOrigin->cooId->caption() ?></span><span class="ew-table-header-sort"><?php if ($countryOfOrigin->cooId->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($countryOfOrigin->cooId->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($countryOfOrigin->countryName->Visible) { // countryName ?>
	<?php if ($countryOfOrigin->sortUrl($countryOfOrigin->countryName) == "") { ?>
		<th data-name="countryName" class="<?php echo $countryOfOrigin->countryName->headerCellClass() ?>"><div id="elh_countryOfOrigin_countryName" class="countryOfOrigin_countryName"><div class="ew-table-header-caption"><?php echo $countryOfOrigin->countryName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="countryName" class="<?php echo $countryOfOrigin->countryName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $countryOfOrigin->SortUrl($countryOfOrigin->countryName) ?>',2);"><div id="elh_countryOfOrigin_countryName" class="countryOfOrigin_countryName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $countryOfOrigin->countryName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($countryOfOrigin->countryName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($countryOfOrigin->countryName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($countryOfOrigin->countryIsoCode->Visible) { // countryIsoCode ?>
	<?php if ($countryOfOrigin->sortUrl($countryOfOrigin->countryIsoCode) == "") { ?>
		<th data-name="countryIsoCode" class="<?php echo $countryOfOrigin->countryIsoCode->headerCellClass() ?>"><div id="elh_countryOfOrigin_countryIsoCode" class="countryOfOrigin_countryIsoCode"><div class="ew-table-header-caption"><?php echo $countryOfOrigin->countryIsoCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="countryIsoCode" class="<?php echo $countryOfOrigin->countryIsoCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $countryOfOrigin->SortUrl($countryOfOrigin->countryIsoCode) ?>',2);"><div id="elh_countryOfOrigin_countryIsoCode" class="countryOfOrigin_countryIsoCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $countryOfOrigin->countryIsoCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($countryOfOrigin->countryIsoCode->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($countryOfOrigin->countryIsoCode->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($countryOfOrigin->username->Visible) { // username ?>
	<?php if ($countryOfOrigin->sortUrl($countryOfOrigin->username) == "") { ?>
		<th data-name="username" class="<?php echo $countryOfOrigin->username->headerCellClass() ?>"><div id="elh_countryOfOrigin_username" class="countryOfOrigin_username"><div class="ew-table-header-caption"><?php echo $countryOfOrigin->username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="username" class="<?php echo $countryOfOrigin->username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $countryOfOrigin->SortUrl($countryOfOrigin->username) ?>',2);"><div id="elh_countryOfOrigin_username" class="countryOfOrigin_username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $countryOfOrigin->username->caption() ?></span><span class="ew-table-header-sort"><?php if ($countryOfOrigin->username->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($countryOfOrigin->username->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$countryOfOrigin_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($countryOfOrigin->ExportAll && $countryOfOrigin->isExport()) {
	$countryOfOrigin_list->StopRec = $countryOfOrigin_list->TotalRecs;
} else {

	// Set the last record to display
	if ($countryOfOrigin_list->TotalRecs > $countryOfOrigin_list->StartRec + $countryOfOrigin_list->DisplayRecs - 1)
		$countryOfOrigin_list->StopRec = $countryOfOrigin_list->StartRec + $countryOfOrigin_list->DisplayRecs - 1;
	else
		$countryOfOrigin_list->StopRec = $countryOfOrigin_list->TotalRecs;
}
$countryOfOrigin_list->RecCnt = $countryOfOrigin_list->StartRec - 1;
if ($countryOfOrigin_list->Recordset && !$countryOfOrigin_list->Recordset->EOF) {
	$countryOfOrigin_list->Recordset->moveFirst();
	$selectLimit = $countryOfOrigin_list->UseSelectLimit;
	if (!$selectLimit && $countryOfOrigin_list->StartRec > 1)
		$countryOfOrigin_list->Recordset->move($countryOfOrigin_list->StartRec - 1);
} elseif (!$countryOfOrigin->AllowAddDeleteRow && $countryOfOrigin_list->StopRec == 0) {
	$countryOfOrigin_list->StopRec = $countryOfOrigin->GridAddRowCount;
}

// Initialize aggregate
$countryOfOrigin->RowType = ROWTYPE_AGGREGATEINIT;
$countryOfOrigin->resetAttributes();
$countryOfOrigin_list->renderRow();
while ($countryOfOrigin_list->RecCnt < $countryOfOrigin_list->StopRec) {
	$countryOfOrigin_list->RecCnt++;
	if ($countryOfOrigin_list->RecCnt >= $countryOfOrigin_list->StartRec) {
		$countryOfOrigin_list->RowCnt++;

		// Set up key count
		$countryOfOrigin_list->KeyCount = $countryOfOrigin_list->RowIndex;

		// Init row class and style
		$countryOfOrigin->resetAttributes();
		$countryOfOrigin->CssClass = "";
		if ($countryOfOrigin->isGridAdd()) {
		} else {
			$countryOfOrigin_list->loadRowValues($countryOfOrigin_list->Recordset); // Load row values
		}
		$countryOfOrigin->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$countryOfOrigin->RowAttrs = array_merge($countryOfOrigin->RowAttrs, array('data-rowindex'=>$countryOfOrigin_list->RowCnt, 'id'=>'r' . $countryOfOrigin_list->RowCnt . '_countryOfOrigin', 'data-rowtype'=>$countryOfOrigin->RowType));

		// Render row
		$countryOfOrigin_list->renderRow();

		// Render list options
		$countryOfOrigin_list->renderListOptions();
?>
	<tr<?php echo $countryOfOrigin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$countryOfOrigin_list->ListOptions->render("body", "left", $countryOfOrigin_list->RowCnt);
?>
	<?php if ($countryOfOrigin->cooId->Visible) { // cooId ?>
		<td data-name="cooId"<?php echo $countryOfOrigin->cooId->cellAttributes() ?>>
<span id="el<?php echo $countryOfOrigin_list->RowCnt ?>_countryOfOrigin_cooId" class="countryOfOrigin_cooId">
<span<?php echo $countryOfOrigin->cooId->viewAttributes() ?>>
<?php echo $countryOfOrigin->cooId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($countryOfOrigin->countryName->Visible) { // countryName ?>
		<td data-name="countryName"<?php echo $countryOfOrigin->countryName->cellAttributes() ?>>
<span id="el<?php echo $countryOfOrigin_list->RowCnt ?>_countryOfOrigin_countryName" class="countryOfOrigin_countryName">
<span<?php echo $countryOfOrigin->countryName->viewAttributes() ?>>
<?php echo $countryOfOrigin->countryName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($countryOfOrigin->countryIsoCode->Visible) { // countryIsoCode ?>
		<td data-name="countryIsoCode"<?php echo $countryOfOrigin->countryIsoCode->cellAttributes() ?>>
<span id="el<?php echo $countryOfOrigin_list->RowCnt ?>_countryOfOrigin_countryIsoCode" class="countryOfOrigin_countryIsoCode">
<span<?php echo $countryOfOrigin->countryIsoCode->viewAttributes() ?>>
<?php echo $countryOfOrigin->countryIsoCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($countryOfOrigin->username->Visible) { // username ?>
		<td data-name="username"<?php echo $countryOfOrigin->username->cellAttributes() ?>>
<span id="el<?php echo $countryOfOrigin_list->RowCnt ?>_countryOfOrigin_username" class="countryOfOrigin_username">
<span<?php echo $countryOfOrigin->username->viewAttributes() ?>>
<?php echo $countryOfOrigin->username->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$countryOfOrigin_list->ListOptions->render("body", "right", $countryOfOrigin_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$countryOfOrigin->isGridAdd())
		$countryOfOrigin_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$countryOfOrigin->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($countryOfOrigin_list->Recordset)
	$countryOfOrigin_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($countryOfOrigin_list->TotalRecs == 0 && !$countryOfOrigin->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $countryOfOrigin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$countryOfOrigin_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$countryOfOrigin->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$countryOfOrigin_list->terminate();
?>