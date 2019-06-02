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
$users_list = new users_list();

// Run the page
$users_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$users->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fuserslist = currentForm = new ew.Form("fuserslist", "list");
fuserslist.formKeyCountName = '<?php echo $users_list->FormKeyCountName ?>';

// Form_CustomValidate event
fuserslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuserslist.lists["x_uLevel"] = <?php echo $users_list->uLevel->Lookup->toClientList() ?>;
fuserslist.lists["x_uLevel"].options = <?php echo JsonEncode($users_list->uLevel->lookupOptions()) ?>;
fuserslist.lists["x_uActivated[]"] = <?php echo $users_list->uActivated->Lookup->toClientList() ?>;
fuserslist.lists["x_uActivated[]"].options = <?php echo JsonEncode($users_list->uActivated->options(FALSE, TRUE)) ?>;

// Form object for search
var fuserslistsrch = currentSearchForm = new ew.Form("fuserslistsrch");

// Filters
fuserslistsrch.filterList = <?php echo $users_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$users->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($users_list->TotalRecs > 0 && $users_list->ExportOptions->visible()) { ?>
<?php $users_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($users_list->ImportOptions->visible()) { ?>
<?php $users_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($users_list->SearchOptions->visible()) { ?>
<?php $users_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($users_list->FilterOptions->visible()) { ?>
<?php $users_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$users_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$users->isExport() && !$users->CurrentAction) { ?>
<form name="fuserslistsrch" id="fuserslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($users_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fuserslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="users">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($users_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($users_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $users_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $users_list->showPageHeader(); ?>
<?php
$users_list->showMessage();
?>
<?php if ($users_list->TotalRecs > 0 || $users->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($users_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> users">
<?php if (!$users->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$users->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($users_list->Pager)) $users_list->Pager = new NumericPager($users_list->StartRec, $users_list->DisplayRecs, $users_list->TotalRecs, $users_list->RecRange, $users_list->AutoHidePager) ?>
<?php if ($users_list->Pager->RecordCount > 0 && $users_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($users_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($users_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($users_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $users_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($users_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($users_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($users_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $users_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $users_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $users_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $users_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fuserslist" id="fuserslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($users_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $users_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<div id="gmp_users" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($users_list->TotalRecs > 0 || $users->isGridEdit()) { ?>
<table id="tbl_userslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$users_list->RowType = ROWTYPE_HEADER;

// Render list options
$users_list->renderListOptions();

// Render list options (header, left)
$users_list->ListOptions->render("header", "left");
?>
<?php if ($users->seqid->Visible) { // seqid ?>
	<?php if ($users->sortUrl($users->seqid) == "") { ?>
		<th data-name="seqid" class="<?php echo $users->seqid->headerCellClass() ?>"><div id="elh_users_seqid" class="users_seqid"><div class="ew-table-header-caption"><?php echo $users->seqid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="seqid" class="<?php echo $users->seqid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->seqid) ?>',2);"><div id="elh_users_seqid" class="users_seqid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->seqid->caption() ?></span><span class="ew-table-header-sort"><?php if ($users->seqid->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->seqid->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->userName->Visible) { // userName ?>
	<?php if ($users->sortUrl($users->userName) == "") { ?>
		<th data-name="userName" class="<?php echo $users->userName->headerCellClass() ?>"><div id="elh_users_userName" class="users_userName"><div class="ew-table-header-caption"><?php echo $users->userName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="userName" class="<?php echo $users->userName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->userName) ?>',2);"><div id="elh_users_userName" class="users_userName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->userName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($users->userName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->userName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->userLoginId->Visible) { // userLoginId ?>
	<?php if ($users->sortUrl($users->userLoginId) == "") { ?>
		<th data-name="userLoginId" class="<?php echo $users->userLoginId->headerCellClass() ?>"><div id="elh_users_userLoginId" class="users_userLoginId"><div class="ew-table-header-caption"><?php echo $users->userLoginId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="userLoginId" class="<?php echo $users->userLoginId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->userLoginId) ?>',2);"><div id="elh_users_userLoginId" class="users_userLoginId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->userLoginId->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($users->userLoginId->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->userLoginId->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->uEmail->Visible) { // uEmail ?>
	<?php if ($users->sortUrl($users->uEmail) == "") { ?>
		<th data-name="uEmail" class="<?php echo $users->uEmail->headerCellClass() ?>"><div id="elh_users_uEmail" class="users_uEmail"><div class="ew-table-header-caption"><?php echo $users->uEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="uEmail" class="<?php echo $users->uEmail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->uEmail) ?>',2);"><div id="elh_users_uEmail" class="users_uEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->uEmail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($users->uEmail->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->uEmail->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->uLevel->Visible) { // uLevel ?>
	<?php if ($users->sortUrl($users->uLevel) == "") { ?>
		<th data-name="uLevel" class="<?php echo $users->uLevel->headerCellClass() ?>"><div id="elh_users_uLevel" class="users_uLevel"><div class="ew-table-header-caption"><?php echo $users->uLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="uLevel" class="<?php echo $users->uLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->uLevel) ?>',2);"><div id="elh_users_uLevel" class="users_uLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->uLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($users->uLevel->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->uLevel->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->uPassword->Visible) { // uPassword ?>
	<?php if ($users->sortUrl($users->uPassword) == "") { ?>
		<th data-name="uPassword" class="<?php echo $users->uPassword->headerCellClass() ?>"><div id="elh_users_uPassword" class="users_uPassword"><div class="ew-table-header-caption"><?php echo $users->uPassword->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="uPassword" class="<?php echo $users->uPassword->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->uPassword) ?>',2);"><div id="elh_users_uPassword" class="users_uPassword">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->uPassword->caption() ?></span><span class="ew-table-header-sort"><?php if ($users->uPassword->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->uPassword->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->uProfile->Visible) { // uProfile ?>
	<?php if ($users->sortUrl($users->uProfile) == "") { ?>
		<th data-name="uProfile" class="<?php echo $users->uProfile->headerCellClass() ?>"><div id="elh_users_uProfile" class="users_uProfile"><div class="ew-table-header-caption"><?php echo $users->uProfile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="uProfile" class="<?php echo $users->uProfile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->uProfile) ?>',2);"><div id="elh_users_uProfile" class="users_uProfile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->uProfile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($users->uProfile->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->uProfile->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->uReportsTo->Visible) { // uReportsTo ?>
	<?php if ($users->sortUrl($users->uReportsTo) == "") { ?>
		<th data-name="uReportsTo" class="<?php echo $users->uReportsTo->headerCellClass() ?>"><div id="elh_users_uReportsTo" class="users_uReportsTo"><div class="ew-table-header-caption"><?php echo $users->uReportsTo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="uReportsTo" class="<?php echo $users->uReportsTo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->uReportsTo) ?>',2);"><div id="elh_users_uReportsTo" class="users_uReportsTo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->uReportsTo->caption() ?></span><span class="ew-table-header-sort"><?php if ($users->uReportsTo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->uReportsTo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users->uActivated->Visible) { // uActivated ?>
	<?php if ($users->sortUrl($users->uActivated) == "") { ?>
		<th data-name="uActivated" class="<?php echo $users->uActivated->headerCellClass() ?>"><div id="elh_users_uActivated" class="users_uActivated"><div class="ew-table-header-caption"><?php echo $users->uActivated->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="uActivated" class="<?php echo $users->uActivated->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $users->SortUrl($users->uActivated) ?>',2);"><div id="elh_users_uActivated" class="users_uActivated">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users->uActivated->caption() ?></span><span class="ew-table-header-sort"><?php if ($users->uActivated->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($users->uActivated->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$users_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($users->ExportAll && $users->isExport()) {
	$users_list->StopRec = $users_list->TotalRecs;
} else {

	// Set the last record to display
	if ($users_list->TotalRecs > $users_list->StartRec + $users_list->DisplayRecs - 1)
		$users_list->StopRec = $users_list->StartRec + $users_list->DisplayRecs - 1;
	else
		$users_list->StopRec = $users_list->TotalRecs;
}
$users_list->RecCnt = $users_list->StartRec - 1;
if ($users_list->Recordset && !$users_list->Recordset->EOF) {
	$users_list->Recordset->moveFirst();
	$selectLimit = $users_list->UseSelectLimit;
	if (!$selectLimit && $users_list->StartRec > 1)
		$users_list->Recordset->move($users_list->StartRec - 1);
} elseif (!$users->AllowAddDeleteRow && $users_list->StopRec == 0) {
	$users_list->StopRec = $users->GridAddRowCount;
}

// Initialize aggregate
$users->RowType = ROWTYPE_AGGREGATEINIT;
$users->resetAttributes();
$users_list->renderRow();
while ($users_list->RecCnt < $users_list->StopRec) {
	$users_list->RecCnt++;
	if ($users_list->RecCnt >= $users_list->StartRec) {
		$users_list->RowCnt++;

		// Set up key count
		$users_list->KeyCount = $users_list->RowIndex;

		// Init row class and style
		$users->resetAttributes();
		$users->CssClass = "";
		if ($users->isGridAdd()) {
		} else {
			$users_list->loadRowValues($users_list->Recordset); // Load row values
		}
		$users->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$users->RowAttrs = array_merge($users->RowAttrs, array('data-rowindex'=>$users_list->RowCnt, 'id'=>'r' . $users_list->RowCnt . '_users', 'data-rowtype'=>$users->RowType));

		// Render row
		$users_list->renderRow();

		// Render list options
		$users_list->renderListOptions();
?>
	<tr<?php echo $users->rowAttributes() ?>>
<?php

// Render list options (body, left)
$users_list->ListOptions->render("body", "left", $users_list->RowCnt);
?>
	<?php if ($users->seqid->Visible) { // seqid ?>
		<td data-name="seqid"<?php echo $users->seqid->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_seqid" class="users_seqid">
<span<?php echo $users->seqid->viewAttributes() ?>>
<?php echo $users->seqid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->userName->Visible) { // userName ?>
		<td data-name="userName"<?php echo $users->userName->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_userName" class="users_userName">
<span<?php echo $users->userName->viewAttributes() ?>>
<?php echo $users->userName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->userLoginId->Visible) { // userLoginId ?>
		<td data-name="userLoginId"<?php echo $users->userLoginId->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_userLoginId" class="users_userLoginId">
<span<?php echo $users->userLoginId->viewAttributes() ?>>
<?php echo $users->userLoginId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->uEmail->Visible) { // uEmail ?>
		<td data-name="uEmail"<?php echo $users->uEmail->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_uEmail" class="users_uEmail">
<span<?php echo $users->uEmail->viewAttributes() ?>>
<?php echo $users->uEmail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->uLevel->Visible) { // uLevel ?>
		<td data-name="uLevel"<?php echo $users->uLevel->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_uLevel" class="users_uLevel">
<span<?php echo $users->uLevel->viewAttributes() ?>>
<?php echo $users->uLevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->uPassword->Visible) { // uPassword ?>
		<td data-name="uPassword"<?php echo $users->uPassword->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_uPassword" class="users_uPassword">
<span<?php echo $users->uPassword->viewAttributes() ?>>
<?php echo $users->uPassword->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->uProfile->Visible) { // uProfile ?>
		<td data-name="uProfile"<?php echo $users->uProfile->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_uProfile" class="users_uProfile">
<span<?php echo $users->uProfile->viewAttributes() ?>>
<?php echo $users->uProfile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->uReportsTo->Visible) { // uReportsTo ?>
		<td data-name="uReportsTo"<?php echo $users->uReportsTo->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_uReportsTo" class="users_uReportsTo">
<span<?php echo $users->uReportsTo->viewAttributes() ?>>
<?php echo $users->uReportsTo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users->uActivated->Visible) { // uActivated ?>
		<td data-name="uActivated"<?php echo $users->uActivated->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCnt ?>_users_uActivated" class="users_uActivated">
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
<?php

// Render list options (body, right)
$users_list->ListOptions->render("body", "right", $users_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$users->isGridAdd())
		$users_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$users->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($users_list->Recordset)
	$users_list->Recordset->Close();
?>
<?php if (!$users->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$users->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($users_list->Pager)) $users_list->Pager = new NumericPager($users_list->StartRec, $users_list->DisplayRecs, $users_list->TotalRecs, $users_list->RecRange, $users_list->AutoHidePager) ?>
<?php if ($users_list->Pager->RecordCount > 0 && $users_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($users_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($users_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($users_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $users_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($users_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($users_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $users_list->pageUrl() ?>start=<?php echo $users_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($users_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $users_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $users_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $users_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $users_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($users_list->TotalRecs == 0 && !$users->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $users_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$users_list->showPageFooter();
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
$users_list->terminate();
?>