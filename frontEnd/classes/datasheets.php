<?php
namespace PHPMaker2019\SUBMITTAL;

/**
 * Table class for datasheets
 */
class datasheets extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $partid;
	public $partno;
	public $dataSheetFile;
	public $manufacturer;
	public $cddFile;
	public $thirdPartyFile;
	public $tittle;
	public $cover;
	public $cddissue;
	public $cddno;
	public $thirdPartyNo;
	public $duration;
	public $expirydt;
	public $highlighted;
	public $coo;
	public $hssCode;
	public $systrade;
	public $isdatasheet;
	public $datasheetdate;
	public $username;
	public $nativeFiles;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'datasheets';
		$this->TableName = 'datasheets';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "\"public\".\"datasheets\"";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 20; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "landscape"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 8;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);
		$this->BasicSearch->TypeDefault = "OR";

		// partid
		$this->partid = new DbField('datasheets', 'datasheets', 'x_partid', 'partid', '"partid"', 'CAST("partid" AS varchar(255))', 20, -1, FALSE, '"partid"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->partid->IsAutoIncrement = TRUE; // Autoincrement field
		$this->partid->IsPrimaryKey = TRUE; // Primary key field
		$this->partid->Nullable = FALSE; // NOT NULL field
		$this->partid->Sortable = FALSE; // Allow sort
		$this->partid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['partid'] = &$this->partid;

		// partno
		$this->partno = new DbField('datasheets', 'datasheets', 'x_partno', 'partno', '"partno"', '"partno"', 200, -1, FALSE, '"partno"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->partno->Nullable = FALSE; // NOT NULL field
		$this->partno->Required = TRUE; // Required field
		$this->partno->Sortable = TRUE; // Allow sort
		$this->fields['partno'] = &$this->partno;

		// dataSheetFile
		$this->dataSheetFile = new DbField('datasheets', 'datasheets', 'x_dataSheetFile', 'dataSheetFile', '"dataSheetFile"', '"dataSheetFile"', 200, -1, TRUE, '"dataSheetFile"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->dataSheetFile->Nullable = FALSE; // NOT NULL field
		$this->dataSheetFile->Required = TRUE; // Required field
		$this->dataSheetFile->Sortable = FALSE; // Allow sort
		$this->dataSheetFile->UploadAllowedFileExt = "pdf";
		$this->fields['dataSheetFile'] = &$this->dataSheetFile;

		// manufacturer
		$this->manufacturer = new DbField('datasheets', 'datasheets', 'x_manufacturer', 'manufacturer', '"manufacturer"', '"manufacturer"', 200, -1, FALSE, '"EV__manufacturer"', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->manufacturer->Nullable = FALSE; // NOT NULL field
		$this->manufacturer->Required = TRUE; // Required field
		$this->manufacturer->Sortable = TRUE; // Allow sort
		$this->manufacturer->Lookup = new Lookup('manufacturer', 'manufacturer', FALSE, 'manufacturerName', ["manufacturerName","","",""], [], [], [], [], [], [], '"manufacturerId" DESC', '');
		$this->fields['manufacturer'] = &$this->manufacturer;

		// cddFile
		$this->cddFile = new DbField('datasheets', 'datasheets', 'x_cddFile', 'cddFile', '"cddFile"', '"cddFile"', 200, -1, TRUE, '"cddFile"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->cddFile->Required = TRUE; // Required field
		$this->cddFile->Sortable = FALSE; // Allow sort
		$this->cddFile->UploadAllowedFileExt = "pdf";
		$this->fields['cddFile'] = &$this->cddFile;

		// thirdPartyFile
		$this->thirdPartyFile = new DbField('datasheets', 'datasheets', 'x_thirdPartyFile', 'thirdPartyFile', '"thirdPartyFile"', '"thirdPartyFile"', 200, -1, TRUE, '"thirdPartyFile"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->thirdPartyFile->Nullable = FALSE; // NOT NULL field
		$this->thirdPartyFile->Required = TRUE; // Required field
		$this->thirdPartyFile->Sortable = FALSE; // Allow sort
		$this->thirdPartyFile->UploadAllowedFileExt = "pdf";
		$this->fields['thirdPartyFile'] = &$this->thirdPartyFile;

		// tittle
		$this->tittle = new DbField('datasheets', 'datasheets', 'x_tittle', 'tittle', '"tittle"', '"tittle"', 200, -1, FALSE, '"tittle"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->tittle->Nullable = FALSE; // NOT NULL field
		$this->tittle->Required = TRUE; // Required field
		$this->tittle->Sortable = TRUE; // Allow sort
		$this->fields['tittle'] = &$this->tittle;

		// cover
		$this->cover = new DbField('datasheets', 'datasheets', 'x_cover', 'cover', '"cover"', '"cover"', 200, -1, TRUE, '"cover"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->cover->Nullable = FALSE; // NOT NULL field
		$this->cover->Required = TRUE; // Required field
		$this->cover->Sortable = FALSE; // Allow sort
		$this->cover->UploadAllowedFileExt = "pdf";
		$this->fields['cover'] = &$this->cover;

		// cddissue
		$this->cddissue = new DbField('datasheets', 'datasheets', 'x_cddissue', 'cddissue', '"cddissue"', CastDateFieldForLike('"cddissue"', 5, "DB"), 133, 5, FALSE, '"cddissue"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cddissue->Nullable = FALSE; // NOT NULL field
		$this->cddissue->Required = TRUE; // Required field
		$this->cddissue->Sortable = TRUE; // Allow sort
		$this->cddissue->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['cddissue'] = &$this->cddissue;

		// cddno
		$this->cddno = new DbField('datasheets', 'datasheets', 'x_cddno', 'cddno', '"cddno"', '"cddno"', 200, -1, FALSE, '"cddno"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cddno->Nullable = FALSE; // NOT NULL field
		$this->cddno->Required = TRUE; // Required field
		$this->cddno->Sortable = TRUE; // Allow sort
		$this->fields['cddno'] = &$this->cddno;

		// thirdPartyNo
		$this->thirdPartyNo = new DbField('datasheets', 'datasheets', 'x_thirdPartyNo', 'thirdPartyNo', '"thirdPartyNo"', '"thirdPartyNo"', 200, -1, FALSE, '"thirdPartyNo"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->thirdPartyNo->Nullable = FALSE; // NOT NULL field
		$this->thirdPartyNo->Required = TRUE; // Required field
		$this->thirdPartyNo->Sortable = TRUE; // Allow sort
		$this->fields['thirdPartyNo'] = &$this->thirdPartyNo;

		// duration
		$this->duration = new DbField('datasheets', 'datasheets', 'x_duration', 'duration', '"duration"', '"duration"', 200, -1, FALSE, '"duration"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->duration->Required = TRUE; // Required field
		$this->duration->Sortable = FALSE; // Allow sort
		$this->duration->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->duration->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->duration->Lookup = new Lookup('duration', 'datasheets', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->duration->OptionCount = 3;
		$this->fields['duration'] = &$this->duration;

		// expirydt
		$this->expirydt = new DbField('datasheets', 'datasheets', 'x_expirydt', 'expirydt', '"expirydt"', CastDateFieldForLike('"expirydt"', 5, "DB"), 133, 5, FALSE, '"expirydt"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->expirydt->Sortable = TRUE; // Allow sort
		$this->expirydt->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateYMD"));
		$this->fields['expirydt'] = &$this->expirydt;

		// highlighted
		$this->highlighted = new DbField('datasheets', 'datasheets', 'x_highlighted', 'highlighted', '"highlighted"', 'CAST("highlighted" AS varchar(255))', 11, -1, FALSE, '"highlighted"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->highlighted->Sortable = FALSE; // Allow sort
		$this->highlighted->DataType = DATATYPE_BOOLEAN;
		$this->highlighted->Lookup = new Lookup('highlighted', 'datasheets', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->highlighted->OptionCount = 2;
		$this->fields['highlighted'] = &$this->highlighted;

		// coo
		$this->coo = new DbField('datasheets', 'datasheets', 'x_coo', 'coo', '"coo"', '"coo"', 200, -1, FALSE, '"EV__coo"', TRUE, FALSE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->coo->Required = TRUE; // Required field
		$this->coo->Sortable = TRUE; // Allow sort
		$this->coo->Lookup = new Lookup('coo', 'countryOfOrigin', FALSE, 'countryName', ["countryName","countryIsoCode","",""], [], [], [], [], [], [], '', '');
		$this->fields['coo'] = &$this->coo;

		// hssCode
		$this->hssCode = new DbField('datasheets', 'datasheets', 'x_hssCode', 'hssCode', '"hssCode"', '"hssCode"', 200, -1, FALSE, '"hssCode"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hssCode->Sortable = TRUE; // Allow sort
		$this->fields['hssCode'] = &$this->hssCode;

		// systrade
		$this->systrade = new DbField('datasheets', 'datasheets', 'x_systrade', 'systrade', '"systrade"', '"systrade"', 200, -1, FALSE, '"systrade"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->systrade->Nullable = FALSE; // NOT NULL field
		$this->systrade->Required = TRUE; // Required field
		$this->systrade->Sortable = TRUE; // Allow sort
		$this->systrade->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->systrade->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->systrade->Lookup = new Lookup('systrade', 'datasheets', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->systrade->OptionCount = 2;
		$this->fields['systrade'] = &$this->systrade;

		// isdatasheet
		$this->isdatasheet = new DbField('datasheets', 'datasheets', 'x_isdatasheet', 'isdatasheet', '"isdatasheet"', 'CAST("isdatasheet" AS varchar(255))', 11, -1, FALSE, '"isdatasheet"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->isdatasheet->Nullable = FALSE; // NOT NULL field
		$this->isdatasheet->Required = TRUE; // Required field
		$this->isdatasheet->Sortable = TRUE; // Allow sort
		$this->isdatasheet->DataType = DATATYPE_BOOLEAN;
		$this->isdatasheet->Lookup = new Lookup('isdatasheet', 'datasheets', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->isdatasheet->OptionCount = 2;
		$this->fields['isdatasheet'] = &$this->isdatasheet;

		// datasheetdate
		$this->datasheetdate = new DbField('datasheets', 'datasheets', 'x_datasheetdate', 'datasheetdate', '"datasheetdate"', CastDateFieldForLike('"datasheetdate"', 0, "DB"), 133, 0, FALSE, '"datasheetdate"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->datasheetdate->Sortable = FALSE; // Allow sort
		$this->datasheetdate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['datasheetdate'] = &$this->datasheetdate;

		// username
		$this->username = new DbField('datasheets', 'datasheets', 'x_username', 'username', '"username"', '"username"', 200, -1, FALSE, '"username"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->username->Sortable = FALSE; // Allow sort
		$this->fields['username'] = &$this->username;

		// nativeFiles
		$this->nativeFiles = new DbField('datasheets', 'datasheets', 'x_nativeFiles', 'nativeFiles', '"nativeFiles"', '"nativeFiles"', 200, -1, FALSE, '"nativeFiles"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->nativeFiles->Nullable = FALSE; // NOT NULL field
		$this->nativeFiles->Required = TRUE; // Required field
		$this->nativeFiles->Sortable = TRUE; // Allow sort
		$this->fields['nativeFiles'] = &$this->nativeFiles;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Multiple column sort
	public function updateSort(&$fld, $ctrl)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($ctrl) {
				$orderBy = $this->getSessionOrderBy();
				if (ContainsString($orderBy, $sortField . " " . $lastSort)) {
					$orderBy = str_replace($sortField . " " . $lastSort, $sortField . " " . $thisSort, $orderBy);
				} else {
					if ($orderBy <> "")
						$orderBy .= ", ";
					$orderBy .= $sortField . " " . $thisSort;
				}
				$this->setSessionOrderBy($orderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
			}
			$sortFieldList = ($fld->VirtualExpression <> "") ? $fld->VirtualExpression : $sortField;
			if ($ctrl) {
				$orderByList = $this->getSessionOrderByList();
				if (ContainsString($orderByList, $sortFieldList . " " . $lastSort)) {
					$orderByList = str_replace($sortFieldList . " " . $lastSort, $sortFieldList . " " . $thisSort, $orderByList);
				} else {
					if ($orderByList <> "") $orderByList .= ", ";
					$orderByList .= $sortFieldList . " " . $thisSort;
				}
				$this->setSessionOrderByList($orderByList); // Save to Session
			} else {
				$this->setSessionOrderByList($sortFieldList . " " . $thisSort); // Save to Session
			}
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Session ORDER BY for List page
	public function getSessionOrderByList()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_ORDER_BY_LIST];
	}
	public function setSessionOrderByList($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_ORDER_BY_LIST] = $v;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "\"public\".\"datasheets\"";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlSelectList() // Select for List page
	{
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT \"manufacturerName\" FROM \"public\".\"manufacturer\" \"TMP_LOOKUPTABLE\" WHERE \"TMP_LOOKUPTABLE\".\"manufacturerName\" = \"datasheets\".\"manufacturer\" LIMIT 1) AS \"EV__manufacturer\", (SELECT \"countryName\" || '" . ValueSeparator(1, $this->coo) . "' || \"countryIsoCode\" FROM \"public\".\"countryOfOrigin\" \"TMP_LOOKUPTABLE\" WHERE \"TMP_LOOKUPTABLE\".\"countryName\" = \"datasheets\".\"coo\" LIMIT 1) AS \"EV__coo\" FROM \"public\".\"datasheets\"" .
			") \"TMP_TABLE\"";
		return ($this->SqlSelectList <> "") ? $this->SqlSelectList : $select;
	}
	public function sqlSelectList() // For backward compatibility
	{
		return $this->getSqlSelectList();
	}
	public function setSqlSelectList($v)
	{
		$this->SqlSelectList = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "\"expirydt\" ASC";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		if ($this->useVirtualFields()) {
			$select = $this->getSqlSelectList();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		} else {
			$select = $this->getSqlSelect();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		}
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Check if virtual fields is used in SQL
	protected function useVirtualFields()
	{
		$where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
		$orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		if ($where <> "")
			$where = " " . str_replace(array("(",")"), array("",""), $where) . " ";
		if ($orderBy <> "")
			$orderBy = " " . str_replace(array("(",")"), array("",""), $orderBy) . " ";
		if ($this->BasicSearch->getKeyword() <> "")
			return TRUE;
		if ($this->manufacturer->AdvancedSearch->SearchValue <> "" ||
			$this->manufacturer->AdvancedSearch->SearchValue2 <> "" ||
			ContainsString($where, " " . $this->manufacturer->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->manufacturer->VirtualExpression . " "))
			return TRUE;
		if ($this->coo->AdvancedSearch->SearchValue <> "" ||
			$this->coo->AdvancedSearch->SearchValue2 <> "" ||
			ContainsString($where, " " . $this->coo->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->coo->VirtualExpression . " "))
			return TRUE;
		return FALSE;
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		if ($this->useVirtualFields())
			$sql = BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
			$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->partid->setDbValue($conn->getOne("SELECT currval('datasheets_partid_seq'::regclass)"));
			$rs['partid'] = $this->partid->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'partid';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('partid', $rs))
				AddFilter($where, QuotedName('partid', $this->Dbid) . '=' . QuotedValue($rs['partid'], $this->partid->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->partid->DbValue = $row['partid'];
		$this->partno->DbValue = $row['partno'];
		$this->dataSheetFile->Upload->DbValue = $row['dataSheetFile'];
		$this->manufacturer->DbValue = $row['manufacturer'];
		$this->cddFile->Upload->DbValue = $row['cddFile'];
		$this->thirdPartyFile->Upload->DbValue = $row['thirdPartyFile'];
		$this->tittle->DbValue = $row['tittle'];
		$this->cover->Upload->DbValue = $row['cover'];
		$this->cddissue->DbValue = $row['cddissue'];
		$this->cddno->DbValue = $row['cddno'];
		$this->thirdPartyNo->DbValue = $row['thirdPartyNo'];
		$this->duration->DbValue = $row['duration'];
		$this->expirydt->DbValue = $row['expirydt'];
		$this->highlighted->DbValue = (ConvertToBool($row['highlighted']) ? "1" : "0");
		$this->coo->DbValue = $row['coo'];
		$this->hssCode->DbValue = $row['hssCode'];
		$this->systrade->DbValue = $row['systrade'];
		$this->isdatasheet->DbValue = (ConvertToBool($row['isdatasheet']) ? "1" : "0");
		$this->datasheetdate->DbValue = $row['datasheetdate'];
		$this->username->DbValue = $row['username'];
		$this->nativeFiles->DbValue = $row['nativeFiles'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['dataSheetFile']) ? [] : [$row['dataSheetFile']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->dataSheetFile->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->dataSheetFile->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['cddFile']) ? [] : [$row['cddFile']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->cddFile->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->cddFile->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['thirdPartyFile']) ? [] : [$row['thirdPartyFile']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->thirdPartyFile->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->thirdPartyFile->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['cover']) ? [] : [$row['cover']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->cover->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->cover->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "\"partid\" = @partid@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('partid', $row) ? $row['partid'] : NULL) : $this->partid->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@partid@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "datasheetslist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "datasheetsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "datasheetsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "datasheetsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "datasheetslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("datasheetsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("datasheetsview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "datasheetsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "datasheetsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("datasheetsedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("datasheetsadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("datasheetsdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "partid:" . JsonEncode($this->partid->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->partid->CurrentValue != NULL) {
			$url .= "partid=" . urlencode($this->partid->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("partid") !== NULL)
				$arKeys[] = Param("partid");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->partid->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->partid->setDbValue($rs->fields('partid'));
		$this->partno->setDbValue($rs->fields('partno'));
		$this->dataSheetFile->Upload->DbValue = $rs->fields('dataSheetFile');
		$this->manufacturer->setDbValue($rs->fields('manufacturer'));
		$this->cddFile->Upload->DbValue = $rs->fields('cddFile');
		$this->thirdPartyFile->Upload->DbValue = $rs->fields('thirdPartyFile');
		$this->tittle->setDbValue($rs->fields('tittle'));
		$this->cover->Upload->DbValue = $rs->fields('cover');
		$this->cddissue->setDbValue($rs->fields('cddissue'));
		$this->cddno->setDbValue($rs->fields('cddno'));
		$this->thirdPartyNo->setDbValue($rs->fields('thirdPartyNo'));
		$this->duration->setDbValue($rs->fields('duration'));
		$this->expirydt->setDbValue($rs->fields('expirydt'));
		$this->highlighted->setDbValue(ConvertToBool($rs->fields('highlighted')) ? "1" : "0");
		$this->coo->setDbValue($rs->fields('coo'));
		$this->hssCode->setDbValue($rs->fields('hssCode'));
		$this->systrade->setDbValue($rs->fields('systrade'));
		$this->isdatasheet->setDbValue(ConvertToBool($rs->fields('isdatasheet')) ? "1" : "0");
		$this->datasheetdate->setDbValue($rs->fields('datasheetdate'));
		$this->username->setDbValue($rs->fields('username'));
		$this->nativeFiles->setDbValue($rs->fields('nativeFiles'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// partid
		// partno

		$this->partno->CellCssStyle = "width: 10px;";

		// dataSheetFile
		$this->dataSheetFile->CellCssStyle = "width: 10px;";

		// manufacturer
		$this->manufacturer->CellCssStyle = "width: 10px;";

		// cddFile
		$this->cddFile->CellCssStyle = "width: 10px;";

		// thirdPartyFile
		$this->thirdPartyFile->CellCssStyle = "width: 10px;";

		// tittle
		// cover

		$this->cover->CellCssStyle = "width: 10px;";

		// cddissue
		$this->cddissue->CellCssStyle = "width: 10px;";

		// cddno
		$this->cddno->CellCssStyle = "width: 10px;";

		// thirdPartyNo
		$this->thirdPartyNo->CellCssStyle = "width: 5px;";

		// duration
		$this->duration->CellCssStyle = "width: 10px;";

		// expirydt
		$this->expirydt->CellCssStyle = "width: 10px;";

		// highlighted
		$this->highlighted->CellCssStyle = "width: 10px;";

		// coo
		$this->coo->CellCssStyle = "width: 10px;";

		// hssCode
		$this->hssCode->CellCssStyle = "width: 10px;";

		// systrade
		$this->systrade->CellCssStyle = "width: 10px;";

		// isdatasheet
		$this->isdatasheet->CellCssStyle = "width: 10px;";

		// datasheetdate
		$this->datasheetdate->CellCssStyle = "width: 10px;";

		// username
		$this->username->CellCssStyle = "width: 10px;";

		// nativeFiles
		$this->nativeFiles->CellCssStyle = "width: 10px;";

		// partid
		$this->partid->ViewValue = $this->partid->CurrentValue;
		$this->partid->ViewCustomAttributes = "";

		// partno
		$this->partno->ViewValue = $this->partno->CurrentValue;
		$this->partno->ViewValue = strtoupper($this->partno->ViewValue);
		$this->partno->CssClass = "font-weight-bold";
		$this->partno->ViewCustomAttributes = "";

		// dataSheetFile
		if (!EmptyValue($this->dataSheetFile->Upload->DbValue)) {
			$this->dataSheetFile->ViewValue = $this->dataSheetFile->Upload->DbValue;
		} else {
			$this->dataSheetFile->ViewValue = "";
		}
		$this->dataSheetFile->ViewCustomAttributes = "";

		// manufacturer
		if ($this->manufacturer->VirtualValue <> "") {
			$this->manufacturer->ViewValue = $this->manufacturer->VirtualValue;
		} else {
			$this->manufacturer->ViewValue = $this->manufacturer->CurrentValue;
		$curVal = strval($this->manufacturer->CurrentValue);
		if ($curVal <> "") {
			$this->manufacturer->ViewValue = $this->manufacturer->lookupCacheOption($curVal);
			if ($this->manufacturer->ViewValue === NULL) { // Lookup from database
				$filterWrk = "\"manufacturerName\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->manufacturer->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->manufacturer->ViewValue = $this->manufacturer->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->manufacturer->ViewValue = $this->manufacturer->CurrentValue;
				}
			}
		} else {
			$this->manufacturer->ViewValue = NULL;
		}
		}
		$this->manufacturer->ViewCustomAttributes = "";

		// cddFile
		if (!EmptyValue($this->cddFile->Upload->DbValue)) {
			$this->cddFile->ViewValue = $this->cddFile->Upload->DbValue;
		} else {
			$this->cddFile->ViewValue = "";
		}
		$this->cddFile->ViewCustomAttributes = "";

		// thirdPartyFile
		if (!EmptyValue($this->thirdPartyFile->Upload->DbValue)) {
			$this->thirdPartyFile->ViewValue = $this->thirdPartyFile->Upload->DbValue;
		} else {
			$this->thirdPartyFile->ViewValue = "";
		}
		$this->thirdPartyFile->ViewCustomAttributes = "";

		// tittle
		$this->tittle->ViewValue = $this->tittle->CurrentValue;
		$this->tittle->ViewValue = strtoupper($this->tittle->ViewValue);
		$this->tittle->ViewCustomAttributes = "";

		// cover
		if (!EmptyValue($this->cover->Upload->DbValue)) {
			$this->cover->ViewValue = $this->cover->Upload->DbValue;
		} else {
			$this->cover->ViewValue = "";
		}
		$this->cover->ViewCustomAttributes = "";

		// cddissue
		$this->cddissue->ViewValue = $this->cddissue->CurrentValue;
		$this->cddissue->ViewValue = FormatDateTime($this->cddissue->ViewValue, 5);
		$this->cddissue->ViewCustomAttributes = "";

		// cddno
		$this->cddno->ViewValue = $this->cddno->CurrentValue;
		$this->cddno->ViewValue = strtoupper($this->cddno->ViewValue);
		$this->cddno->ViewCustomAttributes = "";

		// thirdPartyNo
		$this->thirdPartyNo->ViewValue = $this->thirdPartyNo->CurrentValue;
		$this->thirdPartyNo->ViewCustomAttributes = "";

		// duration
		if (strval($this->duration->CurrentValue) <> "") {
			$this->duration->ViewValue = $this->duration->optionCaption($this->duration->CurrentValue);
		} else {
			$this->duration->ViewValue = NULL;
		}
		$this->duration->ViewCustomAttributes = "";

		// expirydt
		$this->expirydt->ViewValue = $this->expirydt->CurrentValue;
		$this->expirydt->ViewValue = FormatDateTime($this->expirydt->ViewValue, 5);
		$this->expirydt->ViewCustomAttributes = "";

		// highlighted
		if (ConvertToBool($this->highlighted->CurrentValue)) {
			$this->highlighted->ViewValue = $this->highlighted->tagCaption(1) <> "" ? $this->highlighted->tagCaption(1) : "Yes";
		} else {
			$this->highlighted->ViewValue = $this->highlighted->tagCaption(2) <> "" ? $this->highlighted->tagCaption(2) : "No";
		}
		$this->highlighted->ViewCustomAttributes = "";

		// coo
		if ($this->coo->VirtualValue <> "") {
			$this->coo->ViewValue = $this->coo->VirtualValue;
		} else {
			$this->coo->ViewValue = $this->coo->CurrentValue;
		$curVal = strval($this->coo->CurrentValue);
		if ($curVal <> "") {
			$this->coo->ViewValue = $this->coo->lookupCacheOption($curVal);
			if ($this->coo->ViewValue === NULL) { // Lookup from database
				$filterWrk = "\"countryName\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->coo->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->coo->ViewValue = $this->coo->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->coo->ViewValue = $this->coo->CurrentValue;
				}
			}
		} else {
			$this->coo->ViewValue = NULL;
		}
		}
		$this->coo->ViewCustomAttributes = "";

		// hssCode
		$this->hssCode->ViewValue = $this->hssCode->CurrentValue;
		$this->hssCode->ViewValue = strtoupper($this->hssCode->ViewValue);
		$this->hssCode->ViewCustomAttributes = "";

		// systrade
		if (strval($this->systrade->CurrentValue) <> "") {
			$this->systrade->ViewValue = $this->systrade->optionCaption($this->systrade->CurrentValue);
		} else {
			$this->systrade->ViewValue = NULL;
		}
		$this->systrade->ViewCustomAttributes = "";

		// isdatasheet
		if (ConvertToBool($this->isdatasheet->CurrentValue)) {
			$this->isdatasheet->ViewValue = $this->isdatasheet->tagCaption(1) <> "" ? $this->isdatasheet->tagCaption(1) : "Yes";
		} else {
			$this->isdatasheet->ViewValue = $this->isdatasheet->tagCaption(2) <> "" ? $this->isdatasheet->tagCaption(2) : "No";
		}
		$this->isdatasheet->ViewCustomAttributes = "";

		// datasheetdate
		$this->datasheetdate->ViewValue = $this->datasheetdate->CurrentValue;
		$this->datasheetdate->ViewValue = FormatDateTime($this->datasheetdate->ViewValue, 0);
		$this->datasheetdate->ViewCustomAttributes = "";

		// username
		$this->username->ViewValue = $this->username->CurrentValue;
		$this->username->ViewCustomAttributes = "";

		// nativeFiles
		$this->nativeFiles->ViewValue = $this->nativeFiles->CurrentValue;
		$this->nativeFiles->ViewCustomAttributes = "";

		// partid
		$this->partid->LinkCustomAttributes = "";
		$this->partid->HrefValue = "";
		$this->partid->TooltipValue = "";

		// partno
		$this->partno->LinkCustomAttributes = "";
		if (!EmptyValue($this->dataSheetFile->Upload->DbValue)) {
			$this->partno->HrefValue = GetFileUploadUrl($this->dataSheetFile, $this->dataSheetFile->Upload->DbValue); // Add prefix/suffix
			$this->partno->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->partno->HrefValue = FullUrl($this->partno->HrefValue, "href");
		} else {
			$this->partno->HrefValue = "";
		}
		$this->partno->TooltipValue = "";

		// dataSheetFile
		$this->dataSheetFile->LinkCustomAttributes = "";
		if (!EmptyValue($this->dataSheetFile->Upload->DbValue)) {
			$this->dataSheetFile->HrefValue = GetFileUploadUrl($this->dataSheetFile, $this->dataSheetFile->Upload->DbValue); // Add prefix/suffix
			$this->dataSheetFile->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->dataSheetFile->HrefValue = FullUrl($this->dataSheetFile->HrefValue, "href");
		} else {
			$this->dataSheetFile->HrefValue = "";
		}
		$this->dataSheetFile->ExportHrefValue = $this->dataSheetFile->UploadPath . $this->dataSheetFile->Upload->DbValue;
		$this->dataSheetFile->TooltipValue = "";

		// manufacturer
		$this->manufacturer->LinkCustomAttributes = "";
		$this->manufacturer->HrefValue = "";
		$this->manufacturer->TooltipValue = "";

		// cddFile
		$this->cddFile->LinkCustomAttributes = "";
		if (!EmptyValue($this->cddFile->Upload->DbValue)) {
			$this->cddFile->HrefValue = GetFileUploadUrl($this->cddFile, $this->cddFile->Upload->DbValue); // Add prefix/suffix
			$this->cddFile->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->cddFile->HrefValue = FullUrl($this->cddFile->HrefValue, "href");
		} else {
			$this->cddFile->HrefValue = "";
		}
		$this->cddFile->ExportHrefValue = $this->cddFile->UploadPath . $this->cddFile->Upload->DbValue;
		$this->cddFile->TooltipValue = "";

		// thirdPartyFile
		$this->thirdPartyFile->LinkCustomAttributes = "";
		if (!EmptyValue($this->thirdPartyFile->Upload->DbValue)) {
			$this->thirdPartyFile->HrefValue = GetFileUploadUrl($this->thirdPartyFile, $this->thirdPartyFile->Upload->DbValue); // Add prefix/suffix
			$this->thirdPartyFile->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->thirdPartyFile->HrefValue = FullUrl($this->thirdPartyFile->HrefValue, "href");
		} else {
			$this->thirdPartyFile->HrefValue = "";
		}
		$this->thirdPartyFile->ExportHrefValue = $this->thirdPartyFile->UploadPath . $this->thirdPartyFile->Upload->DbValue;
		$this->thirdPartyFile->TooltipValue = "";

		// tittle
		$this->tittle->LinkCustomAttributes = "";
		$this->tittle->HrefValue = "";
		$this->tittle->TooltipValue = "";

		// cover
		$this->cover->LinkCustomAttributes = "";
		if (!EmptyValue($this->cover->Upload->DbValue)) {
			$this->cover->HrefValue = GetFileUploadUrl($this->cover, $this->cover->Upload->DbValue); // Add prefix/suffix
			$this->cover->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->cover->HrefValue = FullUrl($this->cover->HrefValue, "href");
		} else {
			$this->cover->HrefValue = "";
		}
		$this->cover->ExportHrefValue = $this->cover->UploadPath . $this->cover->Upload->DbValue;
		$this->cover->TooltipValue = "";

		// cddissue
		$this->cddissue->LinkCustomAttributes = "";
		$this->cddissue->HrefValue = "";
		$this->cddissue->TooltipValue = "";

		// cddno
		$this->cddno->LinkCustomAttributes = "";
		if (!EmptyValue($this->cddFile->Upload->DbValue)) {
			$this->cddno->HrefValue = GetFileUploadUrl($this->cddFile, $this->cddFile->Upload->DbValue); // Add prefix/suffix
			$this->cddno->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->cddno->HrefValue = FullUrl($this->cddno->HrefValue, "href");
		} else {
			$this->cddno->HrefValue = "";
		}
		$this->cddno->TooltipValue = "";

		// thirdPartyNo
		$this->thirdPartyNo->LinkCustomAttributes = "";
		if (!EmptyValue($this->thirdPartyFile->Upload->DbValue)) {
			$this->thirdPartyNo->HrefValue = GetFileUploadUrl($this->thirdPartyFile, $this->thirdPartyFile->Upload->DbValue); // Add prefix/suffix
			$this->thirdPartyNo->LinkAttrs["target"] = "_blank"; // Add target
			if ($this->isExport()) $this->thirdPartyNo->HrefValue = FullUrl($this->thirdPartyNo->HrefValue, "href");
		} else {
			$this->thirdPartyNo->HrefValue = "";
		}
		$this->thirdPartyNo->TooltipValue = "";

		// duration
		$this->duration->LinkCustomAttributes = "";
		$this->duration->HrefValue = "";
		$this->duration->TooltipValue = "";

		// expirydt
		$this->expirydt->LinkCustomAttributes = "";
		$this->expirydt->HrefValue = "";
		$this->expirydt->TooltipValue = "";

		// highlighted
		$this->highlighted->LinkCustomAttributes = "";
		$this->highlighted->HrefValue = "";
		$this->highlighted->TooltipValue = "";

		// coo
		$this->coo->LinkCustomAttributes = "";
		$this->coo->HrefValue = "";
		$this->coo->TooltipValue = "";

		// hssCode
		$this->hssCode->LinkCustomAttributes = "";
		$this->hssCode->HrefValue = "";
		$this->hssCode->TooltipValue = "";

		// systrade
		$this->systrade->LinkCustomAttributes = "";
		$this->systrade->HrefValue = "";
		$this->systrade->TooltipValue = "";

		// isdatasheet
		$this->isdatasheet->LinkCustomAttributes = "";
		$this->isdatasheet->HrefValue = "";
		$this->isdatasheet->TooltipValue = "";

		// datasheetdate
		$this->datasheetdate->LinkCustomAttributes = "";
		$this->datasheetdate->HrefValue = "";
		$this->datasheetdate->TooltipValue = "";

		// username
		$this->username->LinkCustomAttributes = "";
		$this->username->HrefValue = "";
		$this->username->TooltipValue = "";

		// nativeFiles
		$this->nativeFiles->LinkCustomAttributes = "";
		$this->nativeFiles->HrefValue = "";
		$this->nativeFiles->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// partid
		$this->partid->EditAttrs["class"] = "form-control";
		$this->partid->EditCustomAttributes = "";
		$this->partid->EditValue = $this->partid->CurrentValue;
		$this->partid->ViewCustomAttributes = "";

		// partno
		$this->partno->EditAttrs["class"] = "form-control";
		$this->partno->EditCustomAttributes = "";
		$this->partno->EditValue = $this->partno->CurrentValue;
		$this->partno->EditValue = strtoupper($this->partno->EditValue);
		$this->partno->CssClass = "font-weight-bold";
		$this->partno->ViewCustomAttributes = "";

		// dataSheetFile
		$this->dataSheetFile->EditAttrs["class"] = "form-control";
		$this->dataSheetFile->EditCustomAttributes = "";
		if (!EmptyValue($this->dataSheetFile->Upload->DbValue)) {
			$this->dataSheetFile->EditValue = $this->dataSheetFile->Upload->DbValue;
		} else {
			$this->dataSheetFile->EditValue = "";
		}
		if (!EmptyValue($this->dataSheetFile->CurrentValue))
				$this->dataSheetFile->Upload->FileName = $this->dataSheetFile->CurrentValue;

		// manufacturer
		$this->manufacturer->EditAttrs["class"] = "form-control";
		$this->manufacturer->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->manufacturer->CurrentValue = HtmlDecode($this->manufacturer->CurrentValue);
		$this->manufacturer->EditValue = $this->manufacturer->CurrentValue;
		$this->manufacturer->PlaceHolder = RemoveHtml($this->manufacturer->caption());

		// cddFile
		$this->cddFile->EditAttrs["class"] = "form-control";
		$this->cddFile->EditCustomAttributes = "";
		if (!EmptyValue($this->cddFile->Upload->DbValue)) {
			$this->cddFile->EditValue = $this->cddFile->Upload->DbValue;
		} else {
			$this->cddFile->EditValue = "";
		}
		if (!EmptyValue($this->cddFile->CurrentValue))
				$this->cddFile->Upload->FileName = $this->cddFile->CurrentValue;

		// thirdPartyFile
		$this->thirdPartyFile->EditAttrs["class"] = "form-control";
		$this->thirdPartyFile->EditCustomAttributes = "";
		if (!EmptyValue($this->thirdPartyFile->Upload->DbValue)) {
			$this->thirdPartyFile->EditValue = $this->thirdPartyFile->Upload->DbValue;
		} else {
			$this->thirdPartyFile->EditValue = "";
		}
		if (!EmptyValue($this->thirdPartyFile->CurrentValue))
				$this->thirdPartyFile->Upload->FileName = $this->thirdPartyFile->CurrentValue;

		// tittle
		$this->tittle->EditAttrs["class"] = "form-control";
		$this->tittle->EditCustomAttributes = "";
		$this->tittle->EditValue = $this->tittle->CurrentValue;
		$this->tittle->PlaceHolder = RemoveHtml($this->tittle->caption());

		// cover
		$this->cover->EditAttrs["class"] = "form-control";
		$this->cover->EditCustomAttributes = "";
		if (!EmptyValue($this->cover->Upload->DbValue)) {
			$this->cover->EditValue = $this->cover->Upload->DbValue;
		} else {
			$this->cover->EditValue = "";
		}
		if (!EmptyValue($this->cover->CurrentValue))
				$this->cover->Upload->FileName = $this->cover->CurrentValue;

		// cddissue
		$this->cddissue->EditAttrs["class"] = "form-control";
		$this->cddissue->EditCustomAttributes = "";
		$this->cddissue->EditValue = FormatDateTime($this->cddissue->CurrentValue, 5);
		$this->cddissue->PlaceHolder = RemoveHtml($this->cddissue->caption());

		// cddno
		$this->cddno->EditAttrs["class"] = "form-control";
		$this->cddno->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->cddno->CurrentValue = HtmlDecode($this->cddno->CurrentValue);
		$this->cddno->EditValue = $this->cddno->CurrentValue;
		$this->cddno->PlaceHolder = RemoveHtml($this->cddno->caption());

		// thirdPartyNo
		$this->thirdPartyNo->EditAttrs["class"] = "form-control";
		$this->thirdPartyNo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->thirdPartyNo->CurrentValue = HtmlDecode($this->thirdPartyNo->CurrentValue);
		$this->thirdPartyNo->EditValue = $this->thirdPartyNo->CurrentValue;
		$this->thirdPartyNo->PlaceHolder = RemoveHtml($this->thirdPartyNo->caption());

		// duration
		$this->duration->EditAttrs["class"] = "form-control";
		$this->duration->EditCustomAttributes = "";
		$this->duration->EditValue = $this->duration->options(TRUE);

		// expirydt
		$this->expirydt->EditAttrs["class"] = "form-control";
		$this->expirydt->EditCustomAttributes = "";
		$this->expirydt->EditValue = FormatDateTime($this->expirydt->CurrentValue, 5);
		$this->expirydt->PlaceHolder = RemoveHtml($this->expirydt->caption());

		// highlighted
		$this->highlighted->EditCustomAttributes = 30;
		$this->highlighted->EditValue = $this->highlighted->options(FALSE);

		// coo
		$this->coo->EditAttrs["class"] = "form-control";
		$this->coo->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->coo->CurrentValue = HtmlDecode($this->coo->CurrentValue);
		$this->coo->EditValue = $this->coo->CurrentValue;
		$this->coo->PlaceHolder = RemoveHtml($this->coo->caption());

		// hssCode
		$this->hssCode->EditAttrs["class"] = "form-control";
		$this->hssCode->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->hssCode->CurrentValue = HtmlDecode($this->hssCode->CurrentValue);
		$this->hssCode->EditValue = $this->hssCode->CurrentValue;
		$this->hssCode->PlaceHolder = RemoveHtml($this->hssCode->caption());

		// systrade
		$this->systrade->EditCustomAttributes = "";
		$this->systrade->EditValue = $this->systrade->options(TRUE);

		// isdatasheet
		$this->isdatasheet->EditCustomAttributes = "";
		$this->isdatasheet->EditValue = $this->isdatasheet->options(FALSE);

		// datasheetdate
		$this->datasheetdate->EditAttrs["class"] = "form-control";
		$this->datasheetdate->EditCustomAttributes = "";
		$this->datasheetdate->EditValue = FormatDateTime($this->datasheetdate->CurrentValue, 8);
		$this->datasheetdate->PlaceHolder = RemoveHtml($this->datasheetdate->caption());

		// username
		// nativeFiles

		$this->nativeFiles->EditAttrs["class"] = "form-control";
		$this->nativeFiles->EditCustomAttributes = "";
		$this->nativeFiles->EditValue = $this->nativeFiles->CurrentValue;
		$this->nativeFiles->PlaceHolder = RemoveHtml($this->nativeFiles->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->partno);
					$doc->exportCaption($this->manufacturer);
					$doc->exportCaption($this->tittle);
					$doc->exportCaption($this->cddissue);
					$doc->exportCaption($this->cddno);
					$doc->exportCaption($this->duration);
					$doc->exportCaption($this->expirydt);
					$doc->exportCaption($this->coo);
					$doc->exportCaption($this->hssCode);
					$doc->exportCaption($this->systrade);
					$doc->exportCaption($this->isdatasheet);
					$doc->exportCaption($this->nativeFiles);
				} else {
					$doc->exportCaption($this->partno);
					$doc->exportCaption($this->manufacturer);
					$doc->exportCaption($this->tittle);
					$doc->exportCaption($this->cddissue);
					$doc->exportCaption($this->cddno);
					$doc->exportCaption($this->thirdPartyNo);
					$doc->exportCaption($this->expirydt);
					$doc->exportCaption($this->coo);
					$doc->exportCaption($this->hssCode);
					$doc->exportCaption($this->systrade);
					$doc->exportCaption($this->isdatasheet);
					$doc->exportCaption($this->nativeFiles);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->partno);
						$doc->exportField($this->manufacturer);
						$doc->exportField($this->tittle);
						$doc->exportField($this->cddissue);
						$doc->exportField($this->cddno);
						$doc->exportField($this->duration);
						$doc->exportField($this->expirydt);
						$doc->exportField($this->coo);
						$doc->exportField($this->hssCode);
						$doc->exportField($this->systrade);
						$doc->exportField($this->isdatasheet);
						$doc->exportField($this->nativeFiles);
					} else {
						$doc->exportField($this->partno);
						$doc->exportField($this->manufacturer);
						$doc->exportField($this->tittle);
						$doc->exportField($this->cddissue);
						$doc->exportField($this->cddno);
						$doc->exportField($this->thirdPartyNo);
						$doc->exportField($this->expirydt);
						$doc->exportField($this->coo);
						$doc->exportField($this->hssCode);
						$doc->exportField($this->systrade);
						$doc->exportField($this->isdatasheet);
						$doc->exportField($this->nativeFiles);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
					$Security->loadCurrentUserLevel($PROJECT_ID . $this->TableName);
					if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
					$validRequest = $Security->canList(); // List permission
					if ($validRequest) {
						$Security->UserID_Loading();
						$Security->loadUserID();
						$Security->UserID_Loaded();
					}
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(CurrentProjectID() . $this->TableName);
			$Security->TablePermission_Loaded();
			$validRequest = $Security->canList(); // List permission
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{
		global $COMPOSITE_KEY_SEPARATOR;

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'dataSheetFile') {
			$fldName = "dataSheetFile";
			$fileNameFld = "dataSheetFile";
		} elseif ($fldparm == 'cddFile') {
			$fldName = "cddFile";
			$fileNameFld = "cddFile";
		} elseif ($fldparm == 'thirdPartyFile') {
			$fldName = "thirdPartyFile";
			$fileNameFld = "thirdPartyFile";
		} elseif ($fldparm == 'cover') {
			$fldName = "cover";
			$fileNameFld = "cover";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode($COMPOSITE_KEY_SEPARATOR, $key);
		if (count($ar) == 1) {
			$this->partid->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype <> "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld <> "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					if ($fileNameFld <> "" && !EmptyValue($rs->fields($fileNameFld)))
						AddHeader("Content-Disposition", "attachment; filename=\"" . $rs->fields($fileNameFld) . "\"");

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear output buffer
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
	}

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'datasheets';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'datasheets';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['partid'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'datasheets';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['partid'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) <> FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'datasheets';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['partid'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType <> DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE
		//Code to change the file name to our requirement and save the same way at server and database.
		// Code to change the file names to match the command line submital tool generator

		$suffix_file = rand(99999,10000);
		$rsnew["dataSheetFile"] = $rsnew["partno"]."-".$suffix_file.".pdf";
		$rsnew["cddFile"] = $rsnew["cddno"]."-CDD-".$suffix_file.".pdf";
		$rsnew["thirdPartyFile"] = $rsnew["thirdPartyNo"]."-UL-".$suffix_file.".pdf";
		$rsnew["cover"] = $rsnew["partno"]."-COVER-".$suffix_file.".pdf";
		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE
		/// This is temporrary fix this needs to be shifted to the client side to ensure the user does not goes trough the complete form submission and then re do it.

		$suffix_file = rand(99999,10000);
	if(isset($rsnew["dataSheetFile"]) == TRUE )
	 	{

	//	$rsnew["dataSheetFile"] = $rsold["partno"]."-".$suffix_file.".pdf";
		}

		// formating CDD File
	if((isset($rsnew["cddFile"]) == TRUE) && ($rsold["cddno"] !== $rsnew["cddno"]))
	{

	//		$rsnew["cddFile"] = $rsnew["cddno"]."-CDD-".$suffix_file.".pdf";
	 	}elseif((isset($rsnew["cddFile"]) == TRUE) && ($rsold["cddno"] == $rsnew["cddno"]))
			{
			$this->setFailureMessage("Error !! , <b> Keyin Civil Defence File Name</b> to new number and <br> <b> re-upload the File. </b>");
			return FALSE;
		}else
			{
				if($rsold["cddno"] !== $rsnew["cddno"])
					{
						$this->setFailureMessage("Civil Defence File Number Updated but not <b> CDD Approval File </b>");
						return FALSE;
					}
	}

		//formating third party File and field
	if((isset($rsnew["thirdPartyFile"]) == TRUE) && ($rsold["thirdPartyNo"] !== $rsnew["thirdPartyNo"]))
	 	{

	 		//need to check if the third party update happens only after 
	// 			$rsnew["thirdPartyFile"] = $rsnew["thirdPartyNo"]."-UL-".$suffix_file.".pdf";

	}elseif((isset($rsnew["thirdPartyFile"]) == TRUE) && ($rsold["thirdPartyNo"] == $rsnew["thirdPartyNo"]))
		{
			$this->setFailureMessage("Error !! <b>Keyin Third Party certificate No</b> to new number and <br> <b> re-upload the File. </b>");
			return FALSE;
		}else
			{
				if((isset($rsnew["thirdPartyFile"]) == TRUE) && $rsold["thirdPartyNo"] !== $rsnew["thirdPartyNo"])
					{
						$this->setFailureMessage("Third Party certificate No Updated but not <b> Third Party Certificate File </b>");
						return FALSE;
					}
	}

		//formating cover file
		if(isset($rsnew["cover"]))
	 	{

	//		$rsnew["cover"] = $rsold["partno"]."-COVER-".$suffix_file.".pdf";
		}
	return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>