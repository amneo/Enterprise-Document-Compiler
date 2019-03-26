<?php
namespace PHPMaker2019\SUBMITTAL;

/**
 * Table class for users
 */
class users extends DbTable
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

	// Export
	public $ExportDoc;

	// Fields
	public $seqid;
	public $userName;
	public $userLoginId;
	public $uEmail;
	public $uLevel;
	public $uPassword;
	public $uProfile;
	public $uReportsTo;
	public $uActivated;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'users';
		$this->TableName = 'users';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "\"public\".\"users\"";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// seqid
		$this->seqid = new DbField('users', 'users', 'x_seqid', 'seqid', '"seqid"', 'CAST("seqid" AS varchar(255))', 3, -1, FALSE, '"seqid"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->seqid->IsAutoIncrement = TRUE; // Autoincrement field
		$this->seqid->IsPrimaryKey = TRUE; // Primary key field
		$this->seqid->Nullable = FALSE; // NOT NULL field
		$this->seqid->Sortable = TRUE; // Allow sort
		$this->seqid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['seqid'] = &$this->seqid;

		// userName
		$this->userName = new DbField('users', 'users', 'x_userName', 'userName', '"userName"', '"userName"', 200, -1, FALSE, '"userName"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->userName->Nullable = FALSE; // NOT NULL field
		$this->userName->Required = TRUE; // Required field
		$this->userName->Sortable = TRUE; // Allow sort
		$this->fields['userName'] = &$this->userName;

		// userLoginId
		$this->userLoginId = new DbField('users', 'users', 'x_userLoginId', 'userLoginId', '"userLoginId"', '"userLoginId"', 200, -1, FALSE, '"userLoginId"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->userLoginId->Nullable = FALSE; // NOT NULL field
		$this->userLoginId->Required = TRUE; // Required field
		$this->userLoginId->Sortable = TRUE; // Allow sort
		$this->fields['userLoginId'] = &$this->userLoginId;

		// uEmail
		$this->uEmail = new DbField('users', 'users', 'x_uEmail', 'uEmail', '"uEmail"', '"uEmail"', 200, -1, FALSE, '"uEmail"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->uEmail->Nullable = FALSE; // NOT NULL field
		$this->uEmail->Required = TRUE; // Required field
		$this->uEmail->Sortable = TRUE; // Allow sort
		$this->fields['uEmail'] = &$this->uEmail;

		// uLevel
		$this->uLevel = new DbField('users', 'users', 'x_uLevel', 'uLevel', '"uLevel"', 'CAST("uLevel" AS varchar(255))', 3, -1, FALSE, '"uLevel"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->uLevel->Sortable = TRUE; // Allow sort
		$this->uLevel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->uLevel->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->uLevel->Lookup = new Lookup('uLevel', 'userlevels', FALSE, 'userlevelid', ["userlevelname","","",""], [], [], [], [], [], [], '', '');
		$this->uLevel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['uLevel'] = &$this->uLevel;

		// uPassword
		$this->uPassword = new DbField('users', 'users', 'x_uPassword', 'uPassword', '"uPassword"', '"uPassword"', 200, -1, FALSE, '"uPassword"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->uPassword->Nullable = FALSE; // NOT NULL field
		$this->uPassword->Required = TRUE; // Required field
		$this->uPassword->Sortable = TRUE; // Allow sort
		$this->fields['uPassword'] = &$this->uPassword;

		// uProfile
		$this->uProfile = new DbField('users', 'users', 'x_uProfile', 'uProfile', '"uProfile"', '"uProfile"', 200, -1, FALSE, '"uProfile"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->uProfile->Sortable = TRUE; // Allow sort
		$this->fields['uProfile'] = &$this->uProfile;

		// uReportsTo
		$this->uReportsTo = new DbField('users', 'users', 'x_uReportsTo', 'uReportsTo', '"uReportsTo"', '"uReportsTo"', 200, -1, FALSE, '"uReportsTo"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->uReportsTo->Sortable = TRUE; // Allow sort
		$this->uReportsTo->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['uReportsTo'] = &$this->uReportsTo;

		// uActivated
		$this->uActivated = new DbField('users', 'users', 'x_uActivated', 'uActivated', '"uActivated"', 'CAST("uActivated" AS varchar(255))', 11, -1, FALSE, '"uActivated"', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->uActivated->Sortable = TRUE; // Allow sort
		$this->uActivated->DataType = DATATYPE_BOOLEAN;
		$this->uActivated->Lookup = new Lookup('uActivated', 'users', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->uActivated->OptionCount = 2;
		$this->fields['uActivated'] = &$this->uActivated;
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
		} else {
			if (!$ctrl)
				$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "\"public\".\"users\"";
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
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "\"seqid\" DESC";
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
		global $Security;

		// Add User ID filter
		if ($Security->currentUserID() <> "" && !$Security->isAdmin()) { // Non system admin
			$filter = $this->addUserIDFilter($filter);
		}
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
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
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
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
			if (ENCRYPTED_PASSWORD && $name == 'uPassword')
				$value = (CASE_SENSITIVE_PASSWORD) ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
			$this->seqid->setDbValue($conn->getOne("SELECT currval('users_seqid_seq'::regclass)"));
			$rs['seqid'] = $this->seqid->DbValue;
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
			if (ENCRYPTED_PASSWORD && $name == 'uPassword') {
				if ($value == $this->fields[$name]->OldValue) // No need to update hashed password if not changed
					continue;
				$value = (CASE_SENSITIVE_PASSWORD) ? EncryptPassword($value) : EncryptPassword(strtolower($value));
			}
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
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('seqid', $rs))
				AddFilter($where, QuotedName('seqid', $this->Dbid) . '=' . QuotedValue($rs['seqid'], $this->seqid->DataType, $this->Dbid));
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
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->seqid->DbValue = $row['seqid'];
		$this->userName->DbValue = $row['userName'];
		$this->userLoginId->DbValue = $row['userLoginId'];
		$this->uEmail->DbValue = $row['uEmail'];
		$this->uLevel->DbValue = $row['uLevel'];
		$this->uPassword->DbValue = $row['uPassword'];
		$this->uProfile->DbValue = $row['uProfile'];
		$this->uReportsTo->DbValue = $row['uReportsTo'];
		$this->uActivated->DbValue = (ConvertToBool($row['uActivated']) ? "1" : "0");
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "\"seqid\" = @seqid@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('seqid', $row) ? $row['seqid'] : NULL) : $this->seqid->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@seqid@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "userslist.php";
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
		if ($pageName == "usersview.php")
			return $Language->phrase("View");
		elseif ($pageName == "usersedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "usersadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "userslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("usersview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("usersview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "usersadd.php?" . $this->getUrlParm($parm);
		else
			$url = "usersadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("usersedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("usersadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("usersdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "seqid:" . JsonEncode($this->seqid->CurrentValue, "number");
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
		if ($this->seqid->CurrentValue != NULL) {
			$url .= "seqid=" . urlencode($this->seqid->CurrentValue);
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
			if (Param("seqid") !== NULL)
				$arKeys[] = Param("seqid");
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
			$this->seqid->CurrentValue = $key;
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
		$this->seqid->setDbValue($rs->fields('seqid'));
		$this->userName->setDbValue($rs->fields('userName'));
		$this->userLoginId->setDbValue($rs->fields('userLoginId'));
		$this->uEmail->setDbValue($rs->fields('uEmail'));
		$this->uLevel->setDbValue($rs->fields('uLevel'));
		$this->uPassword->setDbValue($rs->fields('uPassword'));
		$this->uProfile->setDbValue($rs->fields('uProfile'));
		$this->uReportsTo->setDbValue($rs->fields('uReportsTo'));
		$this->uActivated->setDbValue(ConvertToBool($rs->fields('uActivated')) ? "1" : "0");
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// seqid
		// userName
		// userLoginId
		// uEmail
		// uLevel
		// uPassword
		// uProfile
		// uReportsTo
		// uActivated
		// seqid

		$this->seqid->ViewValue = $this->seqid->CurrentValue;
		$this->seqid->ViewCustomAttributes = "";

		// userName
		$this->userName->ViewValue = $this->userName->CurrentValue;
		$this->userName->ViewCustomAttributes = "";

		// userLoginId
		$this->userLoginId->ViewValue = $this->userLoginId->CurrentValue;
		$this->userLoginId->ViewCustomAttributes = "";

		// uEmail
		$this->uEmail->ViewValue = $this->uEmail->CurrentValue;
		$this->uEmail->ViewCustomAttributes = "";

		// uLevel
		if ($Security->canAdmin()) { // System admin
		$curVal = strval($this->uLevel->CurrentValue);
		if ($curVal <> "") {
			$this->uLevel->ViewValue = $this->uLevel->lookupCacheOption($curVal);
			if ($this->uLevel->ViewValue === NULL) { // Lookup from database
				$filterWrk = "\"userlevelid\"" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->uLevel->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('df');
					$this->uLevel->ViewValue = $this->uLevel->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->uLevel->ViewValue = $this->uLevel->CurrentValue;
				}
			}
		} else {
			$this->uLevel->ViewValue = NULL;
		}
		} else {
			$this->uLevel->ViewValue = $Language->phrase("PasswordMask");
		}
		$this->uLevel->ViewCustomAttributes = "";

		// uPassword
		$this->uPassword->ViewValue = $this->uPassword->CurrentValue;
		$this->uPassword->ViewCustomAttributes = "";

		// uProfile
		$this->uProfile->ViewValue = $this->uProfile->CurrentValue;
		$this->uProfile->ViewCustomAttributes = "";

		// uReportsTo
		$this->uReportsTo->ViewValue = $this->uReportsTo->CurrentValue;
		$this->uReportsTo->ViewCustomAttributes = "";

		// uActivated
		if (ConvertToBool($this->uActivated->CurrentValue)) {
			$this->uActivated->ViewValue = $this->uActivated->tagCaption(1) <> "" ? $this->uActivated->tagCaption(1) : "Yes";
		} else {
			$this->uActivated->ViewValue = $this->uActivated->tagCaption(2) <> "" ? $this->uActivated->tagCaption(2) : "No";
		}
		$this->uActivated->ViewCustomAttributes = "";

		// seqid
		$this->seqid->LinkCustomAttributes = "";
		$this->seqid->HrefValue = "";
		$this->seqid->TooltipValue = "";

		// userName
		$this->userName->LinkCustomAttributes = "";
		$this->userName->HrefValue = "";
		$this->userName->TooltipValue = "";

		// userLoginId
		$this->userLoginId->LinkCustomAttributes = "";
		$this->userLoginId->HrefValue = "";
		$this->userLoginId->TooltipValue = "";

		// uEmail
		$this->uEmail->LinkCustomAttributes = "";
		$this->uEmail->HrefValue = "";
		$this->uEmail->TooltipValue = "";

		// uLevel
		$this->uLevel->LinkCustomAttributes = "";
		$this->uLevel->HrefValue = "";
		$this->uLevel->TooltipValue = "";

		// uPassword
		$this->uPassword->LinkCustomAttributes = "";
		$this->uPassword->HrefValue = "";
		$this->uPassword->TooltipValue = "";

		// uProfile
		$this->uProfile->LinkCustomAttributes = "";
		$this->uProfile->HrefValue = "";
		$this->uProfile->TooltipValue = "";

		// uReportsTo
		$this->uReportsTo->LinkCustomAttributes = "";
		$this->uReportsTo->HrefValue = "";
		$this->uReportsTo->TooltipValue = "";

		// uActivated
		$this->uActivated->LinkCustomAttributes = "";
		$this->uActivated->HrefValue = "";
		$this->uActivated->TooltipValue = "";

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

		// seqid
		$this->seqid->EditAttrs["class"] = "form-control";
		$this->seqid->EditCustomAttributes = "";
		$this->seqid->EditValue = $this->seqid->CurrentValue;
		$this->seqid->ViewCustomAttributes = "";

		// userName
		$this->userName->EditAttrs["class"] = "form-control";
		$this->userName->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->userName->CurrentValue = HtmlDecode($this->userName->CurrentValue);
		$this->userName->EditValue = $this->userName->CurrentValue;
		$this->userName->PlaceHolder = RemoveHtml($this->userName->caption());

		// userLoginId
		$this->userLoginId->EditAttrs["class"] = "form-control";
		$this->userLoginId->EditCustomAttributes = "";
		if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("info")) { // Non system admin
		} else {
		if (REMOVE_XSS)
			$this->userLoginId->CurrentValue = HtmlDecode($this->userLoginId->CurrentValue);
		$this->userLoginId->EditValue = $this->userLoginId->CurrentValue;
		$this->userLoginId->PlaceHolder = RemoveHtml($this->userLoginId->caption());
		}

		// uEmail
		$this->uEmail->EditAttrs["class"] = "form-control";
		$this->uEmail->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->uEmail->CurrentValue = HtmlDecode($this->uEmail->CurrentValue);
		$this->uEmail->EditValue = $this->uEmail->CurrentValue;
		$this->uEmail->PlaceHolder = RemoveHtml($this->uEmail->caption());

		// uLevel
		$this->uLevel->EditAttrs["class"] = "form-control";
		$this->uLevel->EditCustomAttributes = "";
		if (!$Security->canAdmin()) { // System admin
			$this->uLevel->EditValue = $Language->phrase("PasswordMask");
		} else {
		}

		// uPassword
		$this->uPassword->EditAttrs["class"] = "form-control";
		$this->uPassword->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->uPassword->CurrentValue = HtmlDecode($this->uPassword->CurrentValue);
		$this->uPassword->EditValue = $this->uPassword->CurrentValue;
		$this->uPassword->PlaceHolder = RemoveHtml($this->uPassword->caption());

		// uProfile
		$this->uProfile->EditAttrs["class"] = "form-control";
		$this->uProfile->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->uProfile->CurrentValue = HtmlDecode($this->uProfile->CurrentValue);
		$this->uProfile->EditValue = $this->uProfile->CurrentValue;
		$this->uProfile->PlaceHolder = RemoveHtml($this->uProfile->caption());

		// uReportsTo
		$this->uReportsTo->EditAttrs["class"] = "form-control";
		$this->uReportsTo->EditCustomAttributes = "";
		if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin
			if (SameString($this->userLoginId->CurrentValue, CurrentUserID())) {
		$this->uReportsTo->EditValue = $this->uReportsTo->CurrentValue;
		$this->uReportsTo->ViewCustomAttributes = "";
			} else {
			}
		} else {
		if (REMOVE_XSS)
			$this->uReportsTo->CurrentValue = HtmlDecode($this->uReportsTo->CurrentValue);
		$this->uReportsTo->EditValue = $this->uReportsTo->CurrentValue;
		$this->uReportsTo->PlaceHolder = RemoveHtml($this->uReportsTo->caption());
		}

		// uActivated
		$this->uActivated->EditCustomAttributes = "";
		$this->uActivated->EditValue = $this->uActivated->options(FALSE);

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
					$doc->exportCaption($this->seqid);
					$doc->exportCaption($this->userName);
					$doc->exportCaption($this->userLoginId);
					$doc->exportCaption($this->uEmail);
					$doc->exportCaption($this->uLevel);
					$doc->exportCaption($this->uPassword);
					$doc->exportCaption($this->uProfile);
					$doc->exportCaption($this->uReportsTo);
					$doc->exportCaption($this->uActivated);
				} else {
					$doc->exportCaption($this->seqid);
					$doc->exportCaption($this->userName);
					$doc->exportCaption($this->userLoginId);
					$doc->exportCaption($this->uEmail);
					$doc->exportCaption($this->uLevel);
					$doc->exportCaption($this->uPassword);
					$doc->exportCaption($this->uProfile);
					$doc->exportCaption($this->uReportsTo);
					$doc->exportCaption($this->uActivated);
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
						$doc->exportField($this->seqid);
						$doc->exportField($this->userName);
						$doc->exportField($this->userLoginId);
						$doc->exportField($this->uEmail);
						$doc->exportField($this->uLevel);
						$doc->exportField($this->uPassword);
						$doc->exportField($this->uProfile);
						$doc->exportField($this->uReportsTo);
						$doc->exportField($this->uActivated);
					} else {
						$doc->exportField($this->seqid);
						$doc->exportField($this->userName);
						$doc->exportField($this->userLoginId);
						$doc->exportField($this->uEmail);
						$doc->exportField($this->uLevel);
						$doc->exportField($this->uPassword);
						$doc->exportField($this->uProfile);
						$doc->exportField($this->uReportsTo);
						$doc->exportField($this->uActivated);
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

	// User ID filter
	public function getUserIDFilter($userId)
	{
		$userIdFilter = '"userLoginId" = ' . QuotedValue($userId, DATATYPE_STRING, USER_TABLE_DBID);
		$parentUserIdFilter = '"userLoginId" IN (SELECT "userLoginId" FROM ' . "\"public\".\"users\"" . ' WHERE "uReportsTo" = ' . QuotedValue($userId, DATATYPE_STRING, USER_TABLE_DBID) . ')';
		$userIdFilter = "($userIdFilter) OR ($parentUserIdFilter)";
		return $userIdFilter;
	}

	// Add User ID filter
	public function addUserIDFilter($filter = "")
	{
		global $Security;
		$filterWrk = "";
		$id = (CurrentPageID() == "list") ? $this->CurrentAction : CurrentPageID();
		if (!$this->userIdAllow($id) && !$Security->isAdmin()) {
			$filterWrk = $Security->userIdList();
			if ($filterWrk <> "")
				$filterWrk = '"userLoginId" IN (' . $filterWrk . ')';
		}

		// Call User ID Filtering event
		$this->UserID_Filtering($filterWrk);
		AddFilter($filter, $filterWrk);
		return $filter;
	}

	// Add Parent User ID filter
	public function addParentUserIDFilter($userId)
	{
		global $Security;
		if (!$Security->isAdmin()) {
			$result = $Security->parentUserIDList($userId);
			if ($result <> "")
				$result = '"userLoginId" IN (' . $result . ')';
			return $result;
		}
		return "";
	}

	// User ID subquery
	public function getUserIDSubquery(&$fld, &$masterfld)
	{
		global $UserTableConn;
		$wrk = "";
		$sql = "SELECT " . $masterfld->Expression . " FROM \"public\".\"users\"";
		$filter = $this->addUserIDFilter("");
		if ($filter <> "")
			$sql .= " WHERE " . $filter;

		// Use subquery
		if (USE_SUBQUERY_FOR_MASTER_USER_ID) {
			$wrk = $sql;
		} else {

			// List all values
			if ($rs = $UserTableConn->execute($sql)) {
				while (!$rs->EOF) {
					if ($wrk <> "")
						$wrk .= ",";
					$wrk .= QuotedValue($rs->fields[0], $masterfld->DataType, USER_TABLE_DBID);
					$rs->moveNext();
				}
				$rs->close();
			}
		}
		if ($wrk <> "")
			$wrk = $fld->Expression . " IN (" . $wrk . ")";
		return $wrk;
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

		// No binary fields
		return FALSE;
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