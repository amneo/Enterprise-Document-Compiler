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
$userlevelpermissions_list = new userlevelpermissions_list();

// Run the page
$userlevelpermissions_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$userlevelpermissions_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$userlevelpermissions->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fuserlevelpermissionslist = currentForm = new ew.Form("fuserlevelpermissionslist", "list");
fuserlevelpermissionslist.formKeyCountName = '<?php echo $userlevelpermissions_list->FormKeyCountName ?>';

// Form_CustomValidate event
fuserlevelpermissionslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserlevelpermissionslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuserlevelpermissionslist.lists["x__tablename"] = <?php echo $userlevelpermissions_list->_tablename->Lookup->toClientList() ?>;
fuserlevelpermissionslist.lists["x__tablename"].options = <?php echo JsonEncode($userlevelpermissions_list->_tablename->lookupOptions()) ?>;
fuserlevelpermissionslist.autoSuggests["x__tablename"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
var fuserlevelpermissionslistsrch = currentSearchForm = new ew.Form("fuserlevelpermissionslistsrch");

// Filters
fuserlevelpermissionslistsrch.filterList = <?php echo $userlevelpermissions_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$userlevelpermissions->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($userlevelpermissions_list->TotalRecs > 0 && $userlevelpermissions_list->ExportOptions->visible()) { ?>
<?php $userlevelpermissions_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($userlevelpermissions_list->ImportOptions->visible()) { ?>
<?php $userlevelpermissions_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($userlevelpermissions_list->SearchOptions->visible()) { ?>
<?php $userlevelpermissions_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($userlevelpermissions_list->FilterOptions->visible()) { ?>
<?php $userlevelpermissions_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$userlevelpermissions_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$userlevelpermissions->isExport() && !$userlevelpermissions->CurrentAction) { ?>
<form name="fuserlevelpermissionslistsrch" id="fuserlevelpermissionslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($userlevelpermissions_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fuserlevelpermissionslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="userlevelpermissions">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($userlevelpermissions_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($userlevelpermissions_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $userlevelpermissions_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($userlevelpermissions_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($userlevelpermissions_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($userlevelpermissions_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($userlevelpermissions_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $userlevelpermissions_list->showPageHeader(); ?>
<?php
$userlevelpermissions_list->showMessage();
?>
<?php if ($userlevelpermissions_list->TotalRecs > 0 || $userlevelpermissions->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($userlevelpermissions_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> userlevelpermissions">
<?php if (!$userlevelpermissions->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$userlevelpermissions->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($userlevelpermissions_list->Pager)) $userlevelpermissions_list->Pager = new NumericPager($userlevelpermissions_list->StartRec, $userlevelpermissions_list->DisplayRecs, $userlevelpermissions_list->TotalRecs, $userlevelpermissions_list->RecRange, $userlevelpermissions_list->AutoHidePager) ?>
<?php if ($userlevelpermissions_list->Pager->RecordCount > 0 && $userlevelpermissions_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($userlevelpermissions_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevelpermissions_list->pageUrl() ?>start=<?php echo $userlevelpermissions_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($userlevelpermissions_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevelpermissions_list->pageUrl() ?>start=<?php echo $userlevelpermissions_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($userlevelpermissions_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $userlevelpermissions_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($userlevelpermissions_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevelpermissions_list->pageUrl() ?>start=<?php echo $userlevelpermissions_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($userlevelpermissions_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $userlevelpermissions_list->pageUrl() ?>start=<?php echo $userlevelpermissions_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($userlevelpermissions_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $userlevelpermissions_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $userlevelpermissions_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $userlevelpermissions_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $userlevelpermissions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fuserlevelpermissionslist" id="fuserlevelpermissionslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($userlevelpermissions_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $userlevelpermissions_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="userlevelpermissions">
<div id="gmp_userlevelpermissions" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($userlevelpermissions_list->TotalRecs > 0 || $userlevelpermissions->isGridEdit()) { ?>
<table id="tbl_userlevelpermissionslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$userlevelpermissions_list->RowType = ROWTYPE_HEADER;

// Render list options
$userlevelpermissions_list->renderListOptions();

// Render list options (header, left)
$userlevelpermissions_list->ListOptions->render("header", "left");
?>
<?php if ($userlevelpermissions->_tablename->Visible) { // tablename ?>
	<?php if ($userlevelpermissions->sortUrl($userlevelpermissions->_tablename) == "") { ?>
		<th data-name="_tablename" class="<?php echo $userlevelpermissions->_tablename->headerCellClass() ?>"><div id="elh_userlevelpermissions__tablename" class="userlevelpermissions__tablename"><div class="ew-table-header-caption"><?php echo $userlevelpermissions->_tablename->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_tablename" class="<?php echo $userlevelpermissions->_tablename->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $userlevelpermissions->SortUrl($userlevelpermissions->_tablename) ?>',2);"><div id="elh_userlevelpermissions__tablename" class="userlevelpermissions__tablename">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $userlevelpermissions->_tablename->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($userlevelpermissions->_tablename->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($userlevelpermissions->_tablename->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($userlevelpermissions->permission->Visible) { // permission ?>
	<?php if ($userlevelpermissions->sortUrl($userlevelpermissions->permission) == "") { ?>
		<th data-name="permission" class="<?php echo $userlevelpermissions->permission->headerCellClass() ?>"><div id="elh_userlevelpermissions_permission" class="userlevelpermissions_permission"><div class="ew-table-header-caption"><?php echo $userlevelpermissions->permission->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="permission" class="<?php echo $userlevelpermissions->permission->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $userlevelpermissions->SortUrl($userlevelpermissions->permission) ?>',2);"><div id="elh_userlevelpermissions_permission" class="userlevelpermissions_permission">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $userlevelpermissions->permission->caption() ?></span><span class="ew-table-header-sort"><?php if ($userlevelpermissions->permission->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($userlevelpermissions->permission->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$userlevelpermissions_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($userlevelpermissions->ExportAll && $userlevelpermissions->isExport()) {
	$userlevelpermissions_list->StopRec = $userlevelpermissions_list->TotalRecs;
} else {

	// Set the last record to display
	if ($userlevelpermissions_list->TotalRecs > $userlevelpermissions_list->StartRec + $userlevelpermissions_list->DisplayRecs - 1)
		$userlevelpermissions_list->StopRec = $userlevelpermissions_list->StartRec + $userlevelpermissions_list->DisplayRecs - 1;
	else
		$userlevelpermissions_list->StopRec = $userlevelpermissions_list->TotalRecs;
}
$userlevelpermissions_list->RecCnt = $userlevelpermissions_list->StartRec - 1;
if ($userlevelpermissions_list->Recordset && !$userlevelpermissions_list->Recordset->EOF) {
	$userlevelpermissions_list->Recordset->moveFirst();
	$selectLimit = $userlevelpermissions_list->UseSelectLimit;
	if (!$selectLimit && $userlevelpermissions_list->StartRec > 1)
		$userlevelpermissions_list->Recordset->move($userlevelpermissions_list->StartRec - 1);
} elseif (!$userlevelpermissions->AllowAddDeleteRow && $userlevelpermissions_list->StopRec == 0) {
	$userlevelpermissions_list->StopRec = $userlevelpermissions->GridAddRowCount;
}

// Initialize aggregate
$userlevelpermissions->RowType = ROWTYPE_AGGREGATEINIT;
$userlevelpermissions->resetAttributes();
$userlevelpermissions_list->renderRow();
while ($userlevelpermissions_list->RecCnt < $userlevelpermissions_list->StopRec) {
	$userlevelpermissions_list->RecCnt++;
	if ($userlevelpermissions_list->RecCnt >= $userlevelpermissions_list->StartRec) {
		$userlevelpermissions_list->RowCnt++;

		// Set up key count
		$userlevelpermissions_list->KeyCount = $userlevelpermissions_list->RowIndex;

		// Init row class and style
		$userlevelpermissions->resetAttributes();
		$userlevelpermissions->CssClass = "";
		if ($userlevelpermissions->isGridAdd()) {
		} else {
			$userlevelpermissions_list->loadRowValues($userlevelpermissions_list->Recordset); // Load row values
		}
		$userlevelpermissions->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$userlevelpermissions->RowAttrs = array_merge($userlevelpermissions->RowAttrs, array('data-rowindex'=>$userlevelpermissions_list->RowCnt, 'id'=>'r' . $userlevelpermissions_list->RowCnt . '_userlevelpermissions', 'data-rowtype'=>$userlevelpermissions->RowType));

		// Render row
		$userlevelpermissions_list->renderRow();

		// Render list options
		$userlevelpermissions_list->renderListOptions();
?>
	<tr<?php echo $userlevelpermissions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$userlevelpermissions_list->ListOptions->render("body", "left", $userlevelpermissions_list->RowCnt);
?>
	<?php if ($userlevelpermissions->_tablename->Visible) { // tablename ?>
		<td data-name="_tablename"<?php echo $userlevelpermissions->_tablename->cellAttributes() ?>>
<span id="el<?php echo $userlevelpermissions_list->RowCnt ?>_userlevelpermissions__tablename" class="userlevelpermissions__tablename">
<span<?php echo $userlevelpermissions->_tablename->viewAttributes() ?>>
<?php echo $userlevelpermissions->_tablename->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($userlevelpermissions->permission->Visible) { // permission ?>
		<td data-name="permission"<?php echo $userlevelpermissions->permission->cellAttributes() ?>>
<span id="el<?php echo $userlevelpermissions_list->RowCnt ?>_userlevelpermissions_permission" class="userlevelpermissions_permission">
<span<?php echo $userlevelpermissions->permission->viewAttributes() ?>>
<?php echo $userlevelpermissions->permission->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$userlevelpermissions_list->ListOptions->render("body", "right", $userlevelpermissions_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$userlevelpermissions->isGridAdd())
		$userlevelpermissions_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$userlevelpermissions->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($userlevelpermissions_list->Recordset)
	$userlevelpermissions_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($userlevelpermissions_list->TotalRecs == 0 && !$userlevelpermissions->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $userlevelpermissions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$userlevelpermissions_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$userlevelpermissions->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$userlevelpermissions_list->terminate();
?>