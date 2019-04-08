<?php
namespace PHPMaker2019\SUBMITTAL;

/**
 * Page class
 */
class datasheets_search extends datasheets
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "vishal-sub";

	// Table name
	public $TableName = 'datasheets';

	// Page object name
	public $PageObjName = "datasheets_search";

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page URL
	private $_pageUrl = "";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		if ($this->_pageUrl == "") {
			$this->_pageUrl = CurrentPageName() . "?";
			if ($this->UseTokenInUrl)
				$this->_pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		}
		return $this->_pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $COMPOSITE_KEY_SEPARATOR;
		global $UserTable, $UserTableConn;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (datasheets)
		if (!isset($GLOBALS["datasheets"]) || get_class($GLOBALS["datasheets"]) == PROJECT_NAMESPACE . "datasheets") {
			$GLOBALS["datasheets"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["datasheets"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'datasheets');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();

		// User table object (users)
		if (!isset($UserTable)) {
			$UserTable = new users();
			$UserTableConn = Conn($UserTable->Dbid);
		}
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $datasheets;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($datasheets);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "datasheetsview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['partid'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->partid->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity) && @$RequestSecurity["username"] <> "") // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
			if (IsPasswordExpired())
				$this->terminate(GetUrl("changepwd.php"));
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canSearch()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("datasheetslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Update last accessed time
		if ($UserProfile->isValidUser(CurrentUserName(), session_id())) {
		} else {
			Write($Language->phrase("UserProfileCorrupted"));
			$this->terminate();
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->partid->Visible = FALSE;
		$this->partno->setVisibility();
		$this->dataSheetFile->Visible = FALSE;
		$this->manufacturer->Visible = FALSE;
		$this->cddFile->setVisibility();
		$this->thirdPartyFile->Visible = FALSE;
		$this->tittle->setVisibility();
		$this->cover->Visible = FALSE;
		$this->cddissue->setVisibility();
		$this->cddno->Visible = FALSE;
		$this->thirdPartyNo->Visible = FALSE;
		$this->duration->Visible = FALSE;
		$this->expirydt->setVisibility();
		$this->highlighted->Visible = FALSE;
		$this->coo->Visible = FALSE;
		$this->hssCode->Visible = FALSE;
		$this->systrade->setVisibility();
		$this->isdatasheet->Visible = FALSE;
		$this->datasheetdate->Visible = FALSE;
		$this->username->Visible = FALSE;
		$this->nativeFiles->Visible = FALSE;
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->manufacturer);
		$this->setupLookupOptions($this->coo);

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-search-form ew-horizontal";
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr <> "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "datasheetslist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->partno); // partno
		$this->buildSearchUrl($srchUrl, $this->cddFile); // cddFile
		$this->buildSearchUrl($srchUrl, $this->tittle); // tittle
		$this->buildSearchUrl($srchUrl, $this->cddissue); // cddissue
		$this->buildSearchUrl($srchUrl, $this->expirydt); // expirydt
		$this->buildSearchUrl($srchUrl, $this->systrade); // systrade
		if ($srchUrl <> "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(",", $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(",", $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal <> "" && $fldVal2 <> "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal <> "" && $isValidValue && IsValidOpr($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr <> "" && $oprOnly && IsValidOpr($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 <> "" && $isValidValue && IsValidOpr($fldOpr2, $fldDataType)) {
				if ($wrk <> "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 <> "" && $oprOnly && IsValidOpr($fldOpr2, $fldDataType))) {
				if ($wrk <> "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk <> "") {
			if ($url <> "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{
		global $CurrentForm;

		// Load search values
		// partno

		if (!$this->isAddOrEdit())
			$this->partno->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_partno"));
		$this->partno->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_partno"));

		// cddFile
		if (!$this->isAddOrEdit())
			$this->cddFile->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_cddFile"));
		$this->cddFile->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_cddFile"));

		// tittle
		if (!$this->isAddOrEdit())
			$this->tittle->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_tittle"));
		$this->tittle->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_tittle"));

		// cddissue
		if (!$this->isAddOrEdit())
			$this->cddissue->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_cddissue"));
		$this->cddissue->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_cddissue"));

		// expirydt
		if (!$this->isAddOrEdit())
			$this->expirydt->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_expirydt"));
		$this->expirydt->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_expirydt"));
		$this->expirydt->AdvancedSearch->setSearchCondition($CurrentForm->getValue("v_expirydt"));
		$this->expirydt->AdvancedSearch->setSearchValue2($CurrentForm->getValue("y_expirydt"));
		$this->expirydt->AdvancedSearch->setSearchOperator2($CurrentForm->getValue("w_expirydt"));

		// systrade
		if (!$this->isAddOrEdit())
			$this->systrade->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_systrade"));
		$this->systrade->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_systrade"));
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// partid
		// partno
		// dataSheetFile
		// manufacturer
		// cddFile
		// thirdPartyFile
		// tittle
		// cover
		// cddissue
		// cddno
		// thirdPartyNo
		// duration
		// expirydt
		// highlighted
		// coo
		// hssCode
		// systrade
		// isdatasheet
		// datasheetdate
		// username
		// nativeFiles

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// partno
			$this->partno->ViewValue = $this->partno->CurrentValue;
			$this->partno->ViewValue = strtoupper($this->partno->ViewValue);
			$this->partno->CssClass = "font-weight-bold";
			$this->partno->ViewCustomAttributes = "";

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

			// tittle
			$this->tittle->ViewValue = $this->tittle->CurrentValue;
			$this->tittle->ViewValue = strtoupper($this->tittle->ViewValue);
			$this->tittle->ViewCustomAttributes = "";

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

			// expirydt
			$this->expirydt->ViewValue = $this->expirydt->CurrentValue;
			$this->expirydt->ViewValue = FormatDateTime($this->expirydt->ViewValue, 5);
			$this->expirydt->ViewCustomAttributes = "";

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

			// nativeFiles
			$this->nativeFiles->ViewValue = $this->nativeFiles->CurrentValue;
			$this->nativeFiles->ViewCustomAttributes = "";

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

			// tittle
			$this->tittle->LinkCustomAttributes = "";
			$this->tittle->HrefValue = "";
			$this->tittle->TooltipValue = "";

			// cddissue
			$this->cddissue->LinkCustomAttributes = "";
			$this->cddissue->HrefValue = "";
			$this->cddissue->TooltipValue = "";

			// expirydt
			$this->expirydt->LinkCustomAttributes = "";
			$this->expirydt->HrefValue = "";
			$this->expirydt->TooltipValue = "";

			// systrade
			$this->systrade->LinkCustomAttributes = "";
			$this->systrade->HrefValue = "";
			$this->systrade->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// partno
			$this->partno->EditAttrs["class"] = "form-control";
			$this->partno->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->partno->AdvancedSearch->SearchValue = HtmlDecode($this->partno->AdvancedSearch->SearchValue);
			$this->partno->EditValue = HtmlEncode($this->partno->AdvancedSearch->SearchValue);
			$this->partno->PlaceHolder = RemoveHtml($this->partno->caption());

			// cddFile
			$this->cddFile->EditAttrs["class"] = "form-control";
			$this->cddFile->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->cddFile->AdvancedSearch->SearchValue = HtmlDecode($this->cddFile->AdvancedSearch->SearchValue);
			$this->cddFile->EditValue = HtmlEncode($this->cddFile->AdvancedSearch->SearchValue);
			$this->cddFile->PlaceHolder = RemoveHtml($this->cddFile->caption());

			// tittle
			$this->tittle->EditAttrs["class"] = "form-control";
			$this->tittle->EditCustomAttributes = "";
			$this->tittle->EditValue = HtmlEncode($this->tittle->AdvancedSearch->SearchValue);
			$this->tittle->PlaceHolder = RemoveHtml($this->tittle->caption());

			// cddissue
			$this->cddissue->EditAttrs["class"] = "form-control";
			$this->cddissue->EditCustomAttributes = "";
			$this->cddissue->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->cddissue->AdvancedSearch->SearchValue, 5), 5));
			$this->cddissue->PlaceHolder = RemoveHtml($this->cddissue->caption());

			// expirydt
			$this->expirydt->EditAttrs["class"] = "form-control";
			$this->expirydt->EditCustomAttributes = "";
			$this->expirydt->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->expirydt->AdvancedSearch->SearchValue, 5), 5));
			$this->expirydt->PlaceHolder = RemoveHtml($this->expirydt->caption());
			$this->expirydt->EditAttrs["class"] = "form-control";
			$this->expirydt->EditCustomAttributes = "";
			$this->expirydt->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->expirydt->AdvancedSearch->SearchValue2, 5), 5));
			$this->expirydt->PlaceHolder = RemoveHtml($this->expirydt->caption());

			// systrade
			$this->systrade->EditCustomAttributes = "";
			$this->systrade->EditValue = $this->systrade->options(TRUE);
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return TRUE;
		if (!CheckStdDate($this->cddissue->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->cddissue->errorMessage());
		}
		if (!CheckStdDate($this->expirydt->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->expirydt->errorMessage());
		}
		if (!CheckStdDate($this->expirydt->AdvancedSearch->SearchValue2)) {
			AddMessage($SearchError, $this->expirydt->errorMessage());
		}

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->partno->AdvancedSearch->load();
		$this->cddFile->AdvancedSearch->load();
		$this->tittle->AdvancedSearch->load();
		$this->cddissue->AdvancedSearch->load();
		$this->expirydt->AdvancedSearch->load();
		$this->systrade->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("datasheetslist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_manufacturer":
							break;
						case "x_coo":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>