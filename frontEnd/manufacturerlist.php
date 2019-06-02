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
$manufacturer_list = new manufacturer_list();

// Run the page
$manufacturer_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$manufacturer_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$manufacturer->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fmanufacturerlist = currentForm = new ew.Form("fmanufacturerlist", "list");
fmanufacturerlist.formKeyCountName = '<?php echo $manufacturer_list->FormKeyCountName ?>';

// Form_CustomValidate event
fmanufacturerlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmanufacturerlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fmanufacturerlistsrch = currentSearchForm = new ew.Form("fmanufacturerlistsrch");

// Filters
fmanufacturerlistsrch.filterList = <?php echo $manufacturer_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$manufacturer->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($manufacturer_list->TotalRecs > 0 && $manufacturer_list->ExportOptions->visible()) { ?>
<?php $manufacturer_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($manufacturer_list->ImportOptions->visible()) { ?>
<?php $manufacturer_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($manufacturer_list->SearchOptions->visible()) { ?>
<?php $manufacturer_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($manufacturer_list->FilterOptions->visible()) { ?>
<?php $manufacturer_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$manufacturer_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$manufacturer->isExport() && !$manufacturer->CurrentAction) { ?>
<form name="fmanufacturerlistsrch" id="fmanufacturerlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($manufacturer_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fmanufacturerlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="manufacturer">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($manufacturer_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($manufacturer_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $manufacturer_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($manufacturer_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($manufacturer_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($manufacturer_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($manufacturer_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $manufacturer_list->showPageHeader(); ?>
<?php
$manufacturer_list->showMessage();
?>
<?php if ($manufacturer_list->TotalRecs > 0 || $manufacturer->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($manufacturer_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> manufacturer">
<?php if (!$manufacturer->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$manufacturer->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($manufacturer_list->Pager)) $manufacturer_list->Pager = new NumericPager($manufacturer_list->StartRec, $manufacturer_list->DisplayRecs, $manufacturer_list->TotalRecs, $manufacturer_list->RecRange, $manufacturer_list->AutoHidePager) ?>
<?php if ($manufacturer_list->Pager->RecordCount > 0 && $manufacturer_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($manufacturer_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $manufacturer_list->pageUrl() ?>start=<?php echo $manufacturer_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($manufacturer_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $manufacturer_list->pageUrl() ?>start=<?php echo $manufacturer_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($manufacturer_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $manufacturer_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($manufacturer_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $manufacturer_list->pageUrl() ?>start=<?php echo $manufacturer_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($manufacturer_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $manufacturer_list->pageUrl() ?>start=<?php echo $manufacturer_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($manufacturer_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $manufacturer_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $manufacturer_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $manufacturer_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $manufacturer_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmanufacturerlist" id="fmanufacturerlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($manufacturer_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $manufacturer_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="manufacturer">
<div id="gmp_manufacturer" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($manufacturer_list->TotalRecs > 0 || $manufacturer->isGridEdit()) { ?>
<table id="tbl_manufacturerlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$manufacturer_list->RowType = ROWTYPE_HEADER;

// Render list options
$manufacturer_list->renderListOptions();

// Render list options (header, left)
$manufacturer_list->ListOptions->render("header", "left");
?>
<?php if ($manufacturer->manufacturerName->Visible) { // manufacturerName ?>
	<?php if ($manufacturer->sortUrl($manufacturer->manufacturerName) == "") { ?>
		<th data-name="manufacturerName" class="<?php echo $manufacturer->manufacturerName->headerCellClass() ?>"><div id="elh_manufacturer_manufacturerName" class="manufacturer_manufacturerName"><div class="ew-table-header-caption"><?php echo $manufacturer->manufacturerName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="manufacturerName" class="<?php echo $manufacturer->manufacturerName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $manufacturer->SortUrl($manufacturer->manufacturerName) ?>',2);"><div id="elh_manufacturer_manufacturerName" class="manufacturer_manufacturerName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $manufacturer->manufacturerName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($manufacturer->manufacturerName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($manufacturer->manufacturerName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($manufacturer->manufacturerAddress->Visible) { // manufacturerAddress ?>
	<?php if ($manufacturer->sortUrl($manufacturer->manufacturerAddress) == "") { ?>
		<th data-name="manufacturerAddress" class="<?php echo $manufacturer->manufacturerAddress->headerCellClass() ?>"><div id="elh_manufacturer_manufacturerAddress" class="manufacturer_manufacturerAddress"><div class="ew-table-header-caption"><?php echo $manufacturer->manufacturerAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="manufacturerAddress" class="<?php echo $manufacturer->manufacturerAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $manufacturer->SortUrl($manufacturer->manufacturerAddress) ?>',2);"><div id="elh_manufacturer_manufacturerAddress" class="manufacturer_manufacturerAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $manufacturer->manufacturerAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($manufacturer->manufacturerAddress->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($manufacturer->manufacturerAddress->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($manufacturer->manufacturerFactory->Visible) { // manufacturerFactory ?>
	<?php if ($manufacturer->sortUrl($manufacturer->manufacturerFactory) == "") { ?>
		<th data-name="manufacturerFactory" class="<?php echo $manufacturer->manufacturerFactory->headerCellClass() ?>"><div id="elh_manufacturer_manufacturerFactory" class="manufacturer_manufacturerFactory"><div class="ew-table-header-caption"><?php echo $manufacturer->manufacturerFactory->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="manufacturerFactory" class="<?php echo $manufacturer->manufacturerFactory->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $manufacturer->SortUrl($manufacturer->manufacturerFactory) ?>',2);"><div id="elh_manufacturer_manufacturerFactory" class="manufacturer_manufacturerFactory">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $manufacturer->manufacturerFactory->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($manufacturer->manufacturerFactory->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($manufacturer->manufacturerFactory->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$manufacturer_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($manufacturer->ExportAll && $manufacturer->isExport()) {
	$manufacturer_list->StopRec = $manufacturer_list->TotalRecs;
} else {

	// Set the last record to display
	if ($manufacturer_list->TotalRecs > $manufacturer_list->StartRec + $manufacturer_list->DisplayRecs - 1)
		$manufacturer_list->StopRec = $manufacturer_list->StartRec + $manufacturer_list->DisplayRecs - 1;
	else
		$manufacturer_list->StopRec = $manufacturer_list->TotalRecs;
}
$manufacturer_list->RecCnt = $manufacturer_list->StartRec - 1;
if ($manufacturer_list->Recordset && !$manufacturer_list->Recordset->EOF) {
	$manufacturer_list->Recordset->moveFirst();
	$selectLimit = $manufacturer_list->UseSelectLimit;
	if (!$selectLimit && $manufacturer_list->StartRec > 1)
		$manufacturer_list->Recordset->move($manufacturer_list->StartRec - 1);
} elseif (!$manufacturer->AllowAddDeleteRow && $manufacturer_list->StopRec == 0) {
	$manufacturer_list->StopRec = $manufacturer->GridAddRowCount;
}

// Initialize aggregate
$manufacturer->RowType = ROWTYPE_AGGREGATEINIT;
$manufacturer->resetAttributes();
$manufacturer_list->renderRow();
while ($manufacturer_list->RecCnt < $manufacturer_list->StopRec) {
	$manufacturer_list->RecCnt++;
	if ($manufacturer_list->RecCnt >= $manufacturer_list->StartRec) {
		$manufacturer_list->RowCnt++;

		// Set up key count
		$manufacturer_list->KeyCount = $manufacturer_list->RowIndex;

		// Init row class and style
		$manufacturer->resetAttributes();
		$manufacturer->CssClass = "";
		if ($manufacturer->isGridAdd()) {
		} else {
			$manufacturer_list->loadRowValues($manufacturer_list->Recordset); // Load row values
		}
		$manufacturer->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$manufacturer->RowAttrs = array_merge($manufacturer->RowAttrs, array('data-rowindex'=>$manufacturer_list->RowCnt, 'id'=>'r' . $manufacturer_list->RowCnt . '_manufacturer', 'data-rowtype'=>$manufacturer->RowType));

		// Render row
		$manufacturer_list->renderRow();

		// Render list options
		$manufacturer_list->renderListOptions();
?>
	<tr<?php echo $manufacturer->rowAttributes() ?>>
<?php

// Render list options (body, left)
$manufacturer_list->ListOptions->render("body", "left", $manufacturer_list->RowCnt);
?>
	<?php if ($manufacturer->manufacturerName->Visible) { // manufacturerName ?>
		<td data-name="manufacturerName"<?php echo $manufacturer->manufacturerName->cellAttributes() ?>>
<span id="el<?php echo $manufacturer_list->RowCnt ?>_manufacturer_manufacturerName" class="manufacturer_manufacturerName">
<span<?php echo $manufacturer->manufacturerName->viewAttributes() ?>>
<?php echo $manufacturer->manufacturerName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($manufacturer->manufacturerAddress->Visible) { // manufacturerAddress ?>
		<td data-name="manufacturerAddress"<?php echo $manufacturer->manufacturerAddress->cellAttributes() ?>>
<span id="el<?php echo $manufacturer_list->RowCnt ?>_manufacturer_manufacturerAddress" class="manufacturer_manufacturerAddress">
<span<?php echo $manufacturer->manufacturerAddress->viewAttributes() ?>>
<?php echo $manufacturer->manufacturerAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($manufacturer->manufacturerFactory->Visible) { // manufacturerFactory ?>
		<td data-name="manufacturerFactory"<?php echo $manufacturer->manufacturerFactory->cellAttributes() ?>>
<span id="el<?php echo $manufacturer_list->RowCnt ?>_manufacturer_manufacturerFactory" class="manufacturer_manufacturerFactory">
<span<?php echo $manufacturer->manufacturerFactory->viewAttributes() ?>>
<?php echo $manufacturer->manufacturerFactory->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$manufacturer_list->ListOptions->render("body", "right", $manufacturer_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$manufacturer->isGridAdd())
		$manufacturer_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$manufacturer->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($manufacturer_list->Recordset)
	$manufacturer_list->Recordset->Close();
?>
<?php if (!$manufacturer->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$manufacturer->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($manufacturer_list->Pager)) $manufacturer_list->Pager = new NumericPager($manufacturer_list->StartRec, $manufacturer_list->DisplayRecs, $manufacturer_list->TotalRecs, $manufacturer_list->RecRange, $manufacturer_list->AutoHidePager) ?>
<?php if ($manufacturer_list->Pager->RecordCount > 0 && $manufacturer_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($manufacturer_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $manufacturer_list->pageUrl() ?>start=<?php echo $manufacturer_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($manufacturer_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $manufacturer_list->pageUrl() ?>start=<?php echo $manufacturer_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($manufacturer_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $manufacturer_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($manufacturer_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $manufacturer_list->pageUrl() ?>start=<?php echo $manufacturer_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($manufacturer_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $manufacturer_list->pageUrl() ?>start=<?php echo $manufacturer_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($manufacturer_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $manufacturer_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $manufacturer_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $manufacturer_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $manufacturer_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($manufacturer_list->TotalRecs == 0 && !$manufacturer->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $manufacturer_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$manufacturer_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$manufacturer->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$manufacturer_list->terminate();
?>