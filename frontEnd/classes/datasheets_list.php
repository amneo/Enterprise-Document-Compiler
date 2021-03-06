<?php
namespace PHPMaker2019\SUBMITTAL;

/**
 * Page class
 */
class datasheets_list extends datasheets
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{vishal-sub}";

	// Table name
	public $TableName = 'datasheets';

	// Page object name
	public $PageObjName = "datasheets_list";

	// Grid form hidden field names
	public $FormName = "fdatasheetslist";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;
	public $CancelUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = TRUE;
	public $AuditTrailOnViewData = TRUE;
	public $AuditTrailOnSearch = TRUE;

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

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->AddUrl = "datasheetsadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "datasheetsdelete.php";
		$this->MultiUpdateUrl = "datasheetsupdate.php";
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

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

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new ListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions();
		$this->ImportOptions->Tag = "div";
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions();
		$this->OtherOptions["addedit"]->Tag = "div";
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions();
		$this->OtherOptions["detail"]->Tag = "div";
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions();
		$this->OtherOptions["action"]->Tag = "div";
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ew-filter-option fdatasheetslistsrch";

		// List actions
		$this->ListActions = new ListActions();
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
			SaveDebugMessage();
			AddHeader("Location", $url);
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
		if ($this->isAddOrEdit())
			$this->username->Visible = FALSE;
	}

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $DisplayRecs = 20;
	public $StartRec;
	public $StopRec;
	public $TotalRecs = 0;
	public $RecRange = 10;
	public $Pager;
	public $AutoHidePager = AUTO_HIDE_PAGER;
	public $AutoHidePageSizeSelector = AUTO_HIDE_PAGE_SIZE_SELECTOR;
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $RecCnt = 0; // Record count
	public $EditRowCnt;
	public $StartRowCnt = 1;
	public $RowCnt = 0;
	public $Attrs = array(); // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $HashValue; // Hash value
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SearchError, $EXPORT;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

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
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined(PROJECT_NAMESPACE . "USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined(PROJECT_NAMESPACE . "USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(TABLE_GRID_ADD_ROW_COUNT, "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();

		// Setup export options
		$this->setupExportOptions();
		$this->partid->Visible = FALSE;
		$this->partno->setVisibility();
		$this->dataSheetFile->setVisibility();
		$this->manufacturer->setVisibility();
		$this->tittle->setVisibility();
		$this->cddissue->setVisibility();
		$this->cddno->setVisibility();
		$this->cddFile->setVisibility();
		$this->thirdPartyNo->setVisibility();
		$this->thirdPartyFile->setVisibility();
		$this->cover->setVisibility();
		$this->duration->Visible = FALSE;
		$this->expirydt->setVisibility();
		$this->highlighted->Visible = FALSE;
		$this->coo->setVisibility();
		$this->hssCode->setVisibility();
		$this->systrade->setVisibility();
		$this->isdatasheet->setVisibility();
		$this->cddrenewal_required->setVisibility();
		$this->datasheetdate->Visible = FALSE;
		$this->username->Visible = FALSE;
		$this->nativeFiles->setVisibility();
		$this->hideFieldsForAddEdit();

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

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		$this->setupLookupOptions($this->manufacturer);
		$this->setupLookupOptions($this->coo);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Check QueryString parameters
			if (Get("action") !== NULL) {
				$this->CurrentAction = Get("action");

				// Clear inline mode
				if ($this->isCancel())
					$this->clearInlineMode();

				// Switch to grid edit mode
				if ($this->isGridEdit())
					$this->gridEditMode();

				// Switch to inline edit mode
				if ($this->isEdit())
					$this->inlineEditMode();

				// Switch to inline add mode
				if ($this->isAdd() || $this->isCopy())
					$this->inlineAddMode();

				// Switch to grid add mode
				if ($this->isGridAdd())
					$this->gridAddMode();
			} else {
				if (Post("action") !== NULL) {
					$this->CurrentAction = Post("action"); // Get action

					// Grid Update
					if (($this->isGridUpdate() || $this->isGridOverwrite()) && @$_SESSION[SESSION_INLINE_MODE] == "gridedit") {
						if ($this->validateGridForm()) {
							$gridUpdate = $this->gridUpdate();
						} else {
							$gridUpdate = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridUpdate) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridEditMode(); // Stay in Grid edit mode
						}
					}

					// Inline Update
					if (($this->isUpdate() || $this->isOverwrite()) && @$_SESSION[SESSION_INLINE_MODE] == "edit")
						$this->inlineUpdate();

					// Insert Inline
					if ($this->isInsert() && @$_SESSION[SESSION_INLINE_MODE] == "add")
						$this->inlineInsert();

					// Grid Insert
					if ($this->isGridInsert() && @$_SESSION[SESSION_INLINE_MODE] == "gridadd") {
						if ($this->validateGridForm()) {
							$gridInsert = $this->gridInsert();
						} else {
							$gridInsert = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridInsert) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridAddMode(); // Stay in Grid add mode
						}
					}
				} elseif (@$_SESSION[SESSION_INLINE_MODE] == "gridedit") { // Previously in grid edit mode
					if (Get(TABLE_START_REC) !== NULL || Get(TABLE_PAGE_NO) !== NULL) // Stay in grid edit mode if paging
						$this->gridEditMode();
					else // Reset grid edit
						$this->clearInlineMode();
				}
			}

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = &$this->ListOptions->getItem("griddelete");
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->loadSearchValues(); // Get search values

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();
			if (!$this->validateSearch())
				$this->setFailureMessage($SearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();

			// Get search criteria for advanced search
			if ($SearchError == "")
				$srchAdvanced = $this->advancedSearchWhere();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();

			// Load advanced search from default
			if ($this->loadAdvancedSearchDefault()) {
				$srchAdvanced = $this->advancedSearchWhere();
			}
		}

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if (!$this->CustomExport && in_array($this->Export, array_keys($EXPORT))) {
			$this->exportData();
			$this->terminate();
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRec = 1;
			$this->DisplayRecs = $this->GridAddRowCount;
			$this->TotalRecs = $this->DisplayRecs;
			$this->StopRec = $this->DisplayRecs;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecs = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
			$this->StartRec = 1;
			if ($this->DisplayRecs <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecs = $this->TotalRecs;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRec();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRec - 1, $this->DisplayRecs);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecs == 0) {
				if (!$Security->canList())
					$this->setWarningMessage(DeniedMessage());
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}

			// Audit trail on search
			if ($this->AuditTrailOnSearch && $this->Command == "search" && !$this->RestoreSearch) {
				$searchParm = ServerVar("QUERY_STRING");
				$searchSql = $this->getSessionWhere();
				$this->writeAuditTrailOnSearch($searchParm, $searchSql);
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecs]);
			$this->terminate(TRUE);
		}
	}

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->setKey("partid", ""); // Clear inline edit key
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Grid Edit mode
	protected function gridEditMode()
	{
		$this->CurrentAction = "gridedit";
		$_SESSION[SESSION_INLINE_MODE] = "gridedit";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Inline Edit mode
	protected function inlineEditMode()
	{
		global $Security, $Language;
		if (!$Security->canEdit())
			return FALSE; // Edit not allowed
		$inlineEdit = TRUE;
		if (Get("partid") !== NULL) {
			$this->partid->setQueryStringValue(Get("partid"));
		} else {
			$inlineEdit = FALSE;
		}
		if ($inlineEdit) {
			if ($this->loadRow()) {
				$this->setKey("partid", $this->partid->CurrentValue); // Set up inline edit key
				$_SESSION[SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
		return TRUE;
	}

	// Perform update to Inline Edit record
	protected function inlineUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$CurrentForm->Index = 1;
		$this->loadFormValues(); // Get form values

		// Validate form
		$inlineUpdate = TRUE;
		if (!$this->validateForm()) {
			$inlineUpdate = FALSE; // Form error, reset action
			$this->setFailureMessage($FormError);
		} else {

			// Overwrite record, just reload hash value
			if ($this->isOverwrite())
				$this->loadRowHash();
			$inlineUpdate = FALSE;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			if ($this->setupKeyValues($rowkey)) { // Set up key values
				if ($this->checkInlineEditKey()) { // Check key
					$this->SendEmail = TRUE; // Send email on update success
					$inlineUpdate = $this->editRow(); // Update record
				} else {
					$inlineUpdate = FALSE;
				}
			}
		}
		if ($inlineUpdate) { // Update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Set up success message
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
			$this->EventCancelled = TRUE; // Cancel event
			$this->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	public function checkInlineEditKey()
	{
		if (strval($this->getKey("partid")) <> strval($this->partid->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	protected function inlineAddMode()
	{
		global $Security, $Language;
		if (!$Security->canAdd())
			return FALSE; // Add not allowed
		if ($this->isCopy()) {
			if (Get("partid") !== NULL) {
				$this->partid->setQueryStringValue(Get("partid"));
				$this->setKey("partid", $this->partid->CurrentValue); // Set up key
			} else {
				$this->setKey("partid", ""); // Clear key
				$this->CurrentAction = "add";
			}
		}
		$_SESSION[SESSION_INLINE_MODE] = "add"; // Enable inline add
		return TRUE;
	}

	// Perform update to Inline Add/Copy record
	protected function inlineInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$this->loadOldRecord(); // Load old record
		$CurrentForm->Index = 0;
		$this->loadFormValues(); // Get form values

		// Validate form
		if (!$this->validateForm()) {
			$this->setFailureMessage($FormError); // Set validation error message
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$this->SendEmail = TRUE; // Send email on add success
		if ($this->addRow($this->OldRecordset)) { // Add record
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up add success message
			$this->clearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	public function gridUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$gridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->buildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sql)) {
			$rsold = $rs->getRows();
			$rs->close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->beginTrans();
		if ($this->AuditTrailOnEdit)
			$this->writeAuditTrailDummy($Language->phrase("BatchUpdateBegin")); // Batch update begin
		$key = "";

		// Update row index and get row key
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$CurrentForm->Index = $rowindex;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->loadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$gridUpdate = $this->setupKeyValues($rowkey); // Set up key values
				} else {
					$gridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->emptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($gridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->getRecordFilter();
						$gridUpdate = $this->deleteRows(); // Delete this row
					} else if (!$this->validateForm()) {
						$gridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($FormError);
					} else {
						if ($rowaction == "insert") {
							$gridUpdate = $this->addRow(); // Insert this row
						} else {
							if ($rowkey <> "") {

								// Overwrite record, just reload hash value
								if ($this->isGridOverwrite())
									$this->loadRowHash();
								$this->SendEmail = FALSE; // Do not send email on update success
								$gridUpdate = $this->editRow(); // Update this row
							}
						} // End update
					}
				}
				if ($gridUpdate) {
					if ($key <> "")
						$key .= ", ";
					$key .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($gridUpdate) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateSuccess")); // Batch update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Set up update success message
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateRollback")); // Batch update rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
		}
		return $gridUpdate;
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey <> "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter <> "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode($GLOBALS["COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arKeyFlds) >= 1) {
			$this->partid->setFormValue($arKeyFlds[0]);
			if (!is_numeric($this->partid->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = &$this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->beginTrans();

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		if ($this->AuditTrailOnAdd)
			$this->writeAuditTrailDummy($Language->phrase("BatchInsertBegin")); // Batch insert begin
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key <> "")
						$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
					$key .= $this->partid->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter <> "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->setFailureMessage($Language->phrase("NoAddRecord"));
			$gridInsert = FALSE;
		}
		if ($gridInsert) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertSuccess")); // Batch insert success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->phrase("InsertSuccess")); // Set up insert success message
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertRollback")); // Batch insert rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_partno") && $CurrentForm->hasValue("o_partno") && $this->partno->CurrentValue <> $this->partno->OldValue)
			return FALSE;
		if (!EmptyValue($this->dataSheetFile->Upload->Value))
			return FALSE;
		if ($CurrentForm->hasValue("x_manufacturer") && $CurrentForm->hasValue("o_manufacturer") && $this->manufacturer->CurrentValue <> $this->manufacturer->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tittle") && $CurrentForm->hasValue("o_tittle") && $this->tittle->CurrentValue <> $this->tittle->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_cddissue") && $CurrentForm->hasValue("o_cddissue") && $this->cddissue->CurrentValue <> $this->cddissue->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_cddno") && $CurrentForm->hasValue("o_cddno") && $this->cddno->CurrentValue <> $this->cddno->OldValue)
			return FALSE;
		if (!EmptyValue($this->cddFile->Upload->Value))
			return FALSE;
		if ($CurrentForm->hasValue("x_thirdPartyNo") && $CurrentForm->hasValue("o_thirdPartyNo") && $this->thirdPartyNo->CurrentValue <> $this->thirdPartyNo->OldValue)
			return FALSE;
		if (!EmptyValue($this->thirdPartyFile->Upload->Value))
			return FALSE;
		if (!EmptyValue($this->cover->Upload->Value))
			return FALSE;
		if ($CurrentForm->hasValue("x_expirydt") && $CurrentForm->hasValue("o_expirydt") && $this->expirydt->CurrentValue <> $this->expirydt->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_coo") && $CurrentForm->hasValue("o_coo") && $this->coo->CurrentValue <> $this->coo->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_hssCode") && $CurrentForm->hasValue("o_hssCode") && $this->hssCode->CurrentValue <> $this->hssCode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_systrade") && $CurrentForm->hasValue("o_systrade") && $this->systrade->CurrentValue <> $this->systrade->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_isdatasheet") && $CurrentForm->hasValue("o_isdatasheet") && ConvertToBool($this->isdatasheet->CurrentValue) <> ConvertToBool($this->isdatasheet->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_cddrenewal_required") && $CurrentForm->hasValue("o_cddrenewal_required") && ConvertToBool($this->cddrenewal_required->CurrentValue) <> ConvertToBool($this->cddrenewal_required->OldValue))
			return FALSE;
		if ($CurrentForm->hasValue("x_nativeFiles") && $CurrentForm->hasValue("o_nativeFiles") && $this->nativeFiles->CurrentValue <> $this->nativeFiles->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";

		// Load server side filters
		if (SEARCH_FILTER_OPTION == "Server" && isset($UserProfile))
			$savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fdatasheetslistsrch");
		$filterList = Concat($filterList, $this->partno->AdvancedSearch->toJson(), ","); // Field partno
		$filterList = Concat($filterList, $this->tittle->AdvancedSearch->toJson(), ","); // Field tittle
		$filterList = Concat($filterList, $this->cddissue->AdvancedSearch->toJson(), ","); // Field cddissue
		$filterList = Concat($filterList, $this->expirydt->AdvancedSearch->toJson(), ","); // Field expirydt
		$filterList = Concat($filterList, $this->systrade->AdvancedSearch->toJson(), ","); // Field systrade
		if ($this->BasicSearch->Keyword <> "") {
			$wrk = "\"" . TABLE_BASIC_SEARCH . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . TABLE_BASIC_SEARCH_TYPE . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList <> "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList <> "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList <> "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "fdatasheetslistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field partno
		$this->partno->AdvancedSearch->SearchValue = @$filter["x_partno"];
		$this->partno->AdvancedSearch->SearchOperator = @$filter["z_partno"];
		$this->partno->AdvancedSearch->SearchCondition = @$filter["v_partno"];
		$this->partno->AdvancedSearch->SearchValue2 = @$filter["y_partno"];
		$this->partno->AdvancedSearch->SearchOperator2 = @$filter["w_partno"];
		$this->partno->AdvancedSearch->save();

		// Field tittle
		$this->tittle->AdvancedSearch->SearchValue = @$filter["x_tittle"];
		$this->tittle->AdvancedSearch->SearchOperator = @$filter["z_tittle"];
		$this->tittle->AdvancedSearch->SearchCondition = @$filter["v_tittle"];
		$this->tittle->AdvancedSearch->SearchValue2 = @$filter["y_tittle"];
		$this->tittle->AdvancedSearch->SearchOperator2 = @$filter["w_tittle"];
		$this->tittle->AdvancedSearch->save();

		// Field cddissue
		$this->cddissue->AdvancedSearch->SearchValue = @$filter["x_cddissue"];
		$this->cddissue->AdvancedSearch->SearchOperator = @$filter["z_cddissue"];
		$this->cddissue->AdvancedSearch->SearchCondition = @$filter["v_cddissue"];
		$this->cddissue->AdvancedSearch->SearchValue2 = @$filter["y_cddissue"];
		$this->cddissue->AdvancedSearch->SearchOperator2 = @$filter["w_cddissue"];
		$this->cddissue->AdvancedSearch->save();

		// Field expirydt
		$this->expirydt->AdvancedSearch->SearchValue = @$filter["x_expirydt"];
		$this->expirydt->AdvancedSearch->SearchOperator = @$filter["z_expirydt"];
		$this->expirydt->AdvancedSearch->SearchCondition = @$filter["v_expirydt"];
		$this->expirydt->AdvancedSearch->SearchValue2 = @$filter["y_expirydt"];
		$this->expirydt->AdvancedSearch->SearchOperator2 = @$filter["w_expirydt"];
		$this->expirydt->AdvancedSearch->save();

		// Field systrade
		$this->systrade->AdvancedSearch->SearchValue = @$filter["x_systrade"];
		$this->systrade->AdvancedSearch->SearchOperator = @$filter["z_systrade"];
		$this->systrade->AdvancedSearch->SearchCondition = @$filter["v_systrade"];
		$this->systrade->AdvancedSearch->SearchValue2 = @$filter["y_systrade"];
		$this->systrade->AdvancedSearch->SearchOperator2 = @$filter["w_systrade"];
		$this->systrade->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->partno, $default, FALSE); // partno
		$this->buildSearchSql($where, $this->tittle, $default, FALSE); // tittle
		$this->buildSearchSql($where, $this->cddissue, $default, FALSE); // cddissue
		$this->buildSearchSql($where, $this->expirydt, $default, FALSE); // expirydt
		$this->buildSearchSql($where, $this->systrade, $default, FALSE); // systrade

		// Set up search parm
		if (!$default && $where <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->partno->AdvancedSearch->save(); // partno
			$this->tittle->AdvancedSearch->save(); // tittle
			$this->cddissue->AdvancedSearch->save(); // cddissue
			$this->expirydt->AdvancedSearch->save(); // expirydt
			$this->systrade->AdvancedSearch->save(); // systrade
		}
		return $where;
	}

	// Build search SQL
	protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
	{
		$fldParm = $fld->Param;
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
		$fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
		$fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
		$fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
		$wrk = "";
		if (is_array($fldVal))
			$fldVal = implode(",", $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(",", $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		if ($fldOpr == "")
			$fldOpr = "=";
		$fldOpr2 = strtoupper(trim($fldOpr2));
		if ($fldOpr2 == "")
			$fldOpr2 = "=";
		if (SEARCH_MULTI_VALUE_OPTION == 1)
			$multiValue = FALSE;
		if ($multiValue) {
			$wrk1 = ($fldVal <> "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
			$wrk2 = ($fldVal2 <> "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
			$wrk = $wrk1; // Build final SQL
			if ($wrk2 <> "")
				$wrk = ($wrk <> "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
		} else {
			$fldVal = $this->convertSearchValue($fld, $fldVal);
			$fldVal2 = $this->convertSearchValue($fld, $fldVal2);
			$wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
		}
		AddFilter($where, $wrk);
	}

	// Convert search value
	protected function convertSearchValue(&$fld, $fldVal)
	{
		if ($fldVal == NULL_VALUE || $fldVal == NOT_NULL_VALUE)
			return $fldVal;
		$value = $fldVal;
		if ($fld->DataType == DATATYPE_BOOLEAN) {
			if ($fldVal <> "")
				$value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
		} elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
			if ($fldVal <> "")
				$value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
		}
		return $value;
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->partno, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->manufacturer, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->tittle, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->cddno, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->thirdPartyNo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->coo, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->hssCode, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->systrade, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		global $BASIC_SEARCH_IGNORE_PATTERN;
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if ($BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$keyword = preg_replace($BASIC_SEARCH_IGNORE_PATTERN, "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = array($keyword);
			}
			foreach ($ar as $keyword) {
				if ($keyword <> "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == NULL_VALUE) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == NOT_NULL_VALUE) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk <> "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] <> "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql <> "") {
			if ($where <> "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		if (!$Security->canSearch())
			return "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword <> "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword <> "") {
						if ($searchStr <> "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql(array($keyword), $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, array("", "reset", "resetall")))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		if ($this->partno->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->tittle->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->cddissue->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->expirydt->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->systrade->AdvancedSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->partno->AdvancedSearch->unsetSession();
		$this->tittle->AdvancedSearch->unsetSession();
		$this->cddissue->AdvancedSearch->unsetSession();
		$this->expirydt->AdvancedSearch->unsetSession();
		$this->systrade->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->partno->AdvancedSearch->load();
		$this->tittle->AdvancedSearch->load();
		$this->cddissue->AdvancedSearch->load();
		$this->expirydt->AdvancedSearch->load();
		$this->systrade->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for Ctrl pressed
		$ctrl = Get("ctrl") !== NULL;

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->partno, $ctrl); // partno
			$this->updateSort($this->dataSheetFile, $ctrl); // dataSheetFile
			$this->updateSort($this->manufacturer, $ctrl); // manufacturer
			$this->updateSort($this->tittle, $ctrl); // tittle
			$this->updateSort($this->cddissue, $ctrl); // cddissue
			$this->updateSort($this->cddno, $ctrl); // cddno
			$this->updateSort($this->cddFile, $ctrl); // cddFile
			$this->updateSort($this->thirdPartyNo, $ctrl); // thirdPartyNo
			$this->updateSort($this->thirdPartyFile, $ctrl); // thirdPartyFile
			$this->updateSort($this->cover, $ctrl); // cover
			$this->updateSort($this->expirydt, $ctrl); // expirydt
			$this->updateSort($this->coo, $ctrl); // coo
			$this->updateSort($this->hssCode, $ctrl); // hssCode
			$this->updateSort($this->systrade, $ctrl); // systrade
			$this->updateSort($this->isdatasheet, $ctrl); // isdatasheet
			$this->updateSort($this->cddrenewal_required, $ctrl); // cddrenewal_required
			$this->updateSort($this->nativeFiles, $ctrl); // nativeFiles
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
				$this->expirydt->setSort("ASC");
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->setSessionOrderByList($orderBy);
				$this->partno->setSort("");
				$this->dataSheetFile->setSort("");
				$this->manufacturer->setSort("");
				$this->tittle->setSort("");
				$this->cddissue->setSort("");
				$this->cddno->setSort("");
				$this->cddFile->setSort("");
				$this->thirdPartyNo->setSort("");
				$this->thirdPartyFile->setSort("");
				$this->cover->setSort("");
				$this->expirydt->setSort("");
				$this->coo->setSort("");
				$this->hssCode->setSort("");
				$this->systrade->setSort("");
				$this->isdatasheet->setSort("");
				$this->cddrenewal_required->setSort("");
				$this->nativeFiles->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canAdd();
		$item->OnLeft = TRUE;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew.selectAllKey(this);\">";
		$item->moveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = TRUE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
		$item = &$this->ListOptions->getItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->isGridAdd() || $this->isGridEdit()) {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = &$options->Items["griddelete"];
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "copy"
		$opt = &$this->ListOptions->Items["copy"];
		if ($this->isInlineAddRow() || $this->isInlineCopyRow()) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$opt->Body = "<div" . (($opt->OnLeft) ? " class=\"text-right\"" : "") . ">" .
				"<a class=\"ew-grid-link ew-inline-insert\" title=\"" . HtmlTitle($Language->phrase("InsertLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("InsertLink")) . "\" href=\"\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("InsertLink") . "</a>&nbsp;" .
				"<a class=\"ew-grid-link ew-inline-cancel\" title=\"" . HtmlTitle($Language->phrase("CancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("CancelLink")) . "\" href=\"" . $this->CancelUrl . "\">" . $Language->phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"action\" id=\"action\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$opt = &$this->ListOptions->Items["edit"];
		if ($this->isInlineEditRow()) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
			if ($this->UpdateConflict == "U") {
				$opt->Body = "<div" . (($opt->OnLeft) ? " class=\"text-right\"" : "") . ">" .
					"<a class=\"ew-grid-link ew-inline-reload\" title=\"" . HtmlTitle($Language->phrase("ReloadLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ReloadLink")) . "\" href=\"" . HtmlEncode(UrlAddHash($this->InlineEditUrl, "r" . $this->RowCnt . "_" . $this->TableVar)) . "\">" .
					$Language->phrase("ReloadLink") . "</a>&nbsp;" .
					"<a class=\"ew-grid-link ew-inline-overwrite\" title=\"" . HtmlTitle($Language->phrase("OverwriteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("OverwriteLink")) . "\" href=\"\" onclick=\"return ew.forms(this).submit('" . UrlAddHash($this->pageName(), "r" . $this->RowCnt . "_" . $this->TableVar) . "');\">" . $Language->phrase("OverwriteLink") . "</a>&nbsp;" .
					"<a class=\"ew-grid-link ew-inline-cancel\" title=\"" . HtmlTitle($Language->phrase("ConflictCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ConflictCancelLink")) . "\" href=\"" . $this->CancelUrl . "\">" . $Language->phrase("ConflictCancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"action\" id=\"action\" value=\"overwrite\"></div>";
			} else {
				$opt->Body = "<div" . (($opt->OnLeft) ? " class=\"text-right\"" : "") . ">" .
					"<a class=\"ew-grid-link ew-inline-update\" title=\"" . HtmlTitle($Language->phrase("UpdateLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("UpdateLink")) . "\" href=\"\" onclick=\"return ew.forms(this).submit('" . UrlAddHash($this->pageName(), "r" . $this->RowCnt . "_" . $this->TableVar) . "');\">" . $Language->phrase("UpdateLink") . "</a>&nbsp;" .
					"<a class=\"ew-grid-link ew-inline-cancel\" title=\"" . HtmlTitle($Language->phrase("CancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("CancelLink")) . "\" href=\"" . $this->CancelUrl . "\">" . $Language->phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"action\" id=\"action\" value=\"update\"></div>";
			}
			$opt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_hash\" id=\"k" . $this->RowIndex . "_hash\" value=\"" . $this->HashValue . "\">";
			$opt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . HtmlEncode($this->partid->CurrentValue) . "\">";
			return;
		}

		// "edit"
		$opt = &$this->ListOptions->Items["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
			$opt->Body .= "<a class=\"ew-row-link ew-inline-edit\" title=\"" . HtmlTitle($Language->phrase("InlineEditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("InlineEditLink")) . "\" href=\"" . HtmlEncode(UrlAddHash($this->InlineEditUrl, "r" . $this->RowCnt . "_" . $this->TableVar)) . "\">" . $Language->phrase("InlineEditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "copy"
		$opt = &$this->ListOptions->Items["copy"];
		$copycaption = HtmlTitle($Language->phrase("CopyLink"));
		if ($Security->canAdd()) {
			$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
			$opt->Body .= "<a class=\"ew-row-link ew-inline-copy\" title=\"" . HtmlTitle($Language->phrase("InlineCopyLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("InlineCopyLink")) . "\" href=\"" . HtmlEncode($this->InlineCopyUrl) . "\">" . $Language->phrase("InlineCopyLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// Set up list action buttons
		$opt = &$this->ListOptions->getItem("listactions");
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $Language->phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}

		// "checkbox"
		$opt = &$this->ListOptions->Items["checkbox"];
		$opt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ew-multi-select\" value=\"" . HtmlEncode($this->partid->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\">";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->partid->CurrentValue . "\">";
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_hash\" id=\"k" . $this->RowIndex . "_hash\" value=\"" . $this->HashValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->canAdd());

		// Inline Add
		$item = &$option->add("inlineadd");
		$item->Body = "<a class=\"ew-add-edit ew-inline-add\" title=\"" . HtmlTitle($Language->phrase("InlineAddLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("InlineAddLink")) . "\" href=\"" . HtmlEncode($this->InlineAddUrl) . "\">" .$Language->phrase("InlineAddLink") . "</a>";
		$item->Visible = ($this->InlineAddUrl <> "" && $Security->canAdd());
		$item = &$option->add("gridadd");
		$item->Body = "<a class=\"ew-add-edit ew-grid-add\" title=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridAddLink")) . "\" href=\"" . HtmlEncode($this->GridAddUrl) . "\">" . $Language->phrase("GridAddLink") . "</a>";
		$item->Visible = ($this->GridAddUrl <> "" && $Security->canAdd());

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->add("gridedit");
		$item->Body = "<a class=\"ew-add-edit ew-grid-edit\" title=\"" . HtmlTitle($Language->phrase("GridEditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridEditLink")) . "\" href=\"" . HtmlEncode($this->GridEditUrl) . "\">" . $Language->phrase("GridEditLink") . "</a>";
		$item->Visible = ($this->GridEditUrl <> "" && $Security->canEdit());
		$option = $options["action"];

		// Add multi update
		$item = &$option->add("multiupdate");
		$item->Body = "<a class=\"ew-action ew-multi-update\" title=\"" . HtmlTitle($Language->phrase("UpdateSelectedLink")) . "\" data-table=\"datasheets\" data-caption=\"" . HtmlTitle($Language->phrase("UpdateSelectedLink")) . "\" href=\"\" onclick=\"ew.submitAction(event,{f:document.fdatasheetslist,url:'" . $this->MultiUpdateUrl . "'});return false;\">" . $Language->phrase("UpdateSelectedLink") . "</a>";
		$item->Visible = ($Security->canEdit());

		// Set up options default
		foreach ($options as &$option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fdatasheetslistsrch\" href=\"#\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fdatasheetslistsrch\" href=\"#\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (!$this->isGridAdd() && !$this->isGridEdit()) { // Not grid add/edit mode
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({f:document.fdatasheetslist}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->getItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->hideAllOptions();
			}
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as &$option)
				$option->hideAllOptions();
			if ($this->isGridAdd()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->canAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;

				// Add grid insert
				$item = &$option->add("gridinsert");
				$item->Body = "<a class=\"ew-action ew-grid-insert\" title=\"" . HtmlTitle($Language->phrase("GridInsertLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridInsertLink")) . "\" href=\"\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("GridInsertLink") . "</a>";

				// Add grid cancel
				$item = &$option->add("gridcancel");
				$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" href=\"" . $this->CancelUrl . "\">" . $Language->phrase("GridCancelLink") . "</a>";
			}
			if ($this->isGridEdit()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->canAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				if ($this->UpdateConflict == "U") { // Record already updated by other user
					$item = &$option->add("reload");
					$item->Body = "<a class=\"ew-action ew-grid-reload\" title=\"" . HtmlTitle($Language->phrase("ReloadLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ReloadLink")) . "\" href=\"" . HtmlEncode($this->GridEditUrl) . "\">" . $Language->phrase("ReloadLink") . "</a>";
					$item = &$option->add("overwrite");
					$item->Body = "<a class=\"ew-action ew-grid-overwrite\" title=\"" . HtmlTitle($Language->phrase("OverwriteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("OverwriteLink")) . "\" href=\"\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("OverwriteLink") . "</a>";
					$item = &$option->add("cancel");
					$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->phrase("ConflictCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ConflictCancelLink")) . "\" href=\"" . $this->CancelUrl . "\">" . $Language->phrase("ConflictCancelLink") . "</a>";
				} else {
					$item = &$option->add("gridsave");
					$item->Body = "<a class=\"ew-action ew-grid-save\" title=\"" . HtmlTitle($Language->phrase("GridSaveLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridSaveLink")) . "\" href=\"\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->phrase("GridSaveLink") . "</a>";
					$item = &$option->add("gridcancel");
					$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("GridCancelLink")) . "\" href=\"" . $this->CancelUrl . "\">" . $Language->phrase("GridCancelLink") . "</a>";
				}
			}
		}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter <> "" && $userAction <> "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions->Items[$userAction]->Caption;
				if (!$this->ListActions->Items[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fdatasheetslistsrch\">" . $Language->phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Search highlight button
		$item = &$this->SearchOptions->add("searchhighlight");
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-highlight active\" title=\"" . $Language->phrase("Highlight") . "\" data-caption=\"" . $Language->phrase("Highlight") . "\" data-toggle=\"button\" data-form=\"fdatasheetslistsrch\" data-name=\"" . $this->highlightName() . "\">" . $Language->phrase("HighlightBtn") . "</button>";
		$item->Visible = ($this->SearchWhere <> "" && $this->TotalRecs > 0);

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
	}
	protected function setupListOptionsExt()
	{
		global $Security, $Language;
	}
	protected function renderListOptionsExt()
	{
		global $Security, $Language;
	}

	// Set up starting record parameters
	public function setupStartRec()
	{
		if ($this->DisplayRecs == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			if (Get(TABLE_START_REC) !== NULL) { // Check for "start" parameter
				$this->StartRec = Get(TABLE_START_REC);
				$this->setStartRecordNumber($this->StartRec);
			} elseif (Get(TABLE_PAGE_NO) !== NULL) {
				$pageNo = Get(TABLE_PAGE_NO);
				if (is_numeric($pageNo)) {
					$this->StartRec = ($pageNo - 1) * $this->DisplayRecs + 1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1) {
						$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->StartRec > $this->TotalRecs) { // Avoid starting record > total records
			$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
			$this->StartRec = (int)(($this->StartRec - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->dataSheetFile->Upload->Index = $CurrentForm->Index;
		$this->dataSheetFile->Upload->uploadFile();
		$this->dataSheetFile->CurrentValue = $this->dataSheetFile->Upload->FileName;
		$this->cddFile->Upload->Index = $CurrentForm->Index;
		$this->cddFile->Upload->uploadFile();
		$this->cddFile->CurrentValue = $this->cddFile->Upload->FileName;
		$this->thirdPartyFile->Upload->Index = $CurrentForm->Index;
		$this->thirdPartyFile->Upload->uploadFile();
		$this->thirdPartyFile->CurrentValue = $this->thirdPartyFile->Upload->FileName;
		$this->cover->Upload->Index = $CurrentForm->Index;
		$this->cover->Upload->uploadFile();
		$this->cover->CurrentValue = $this->cover->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->partid->CurrentValue = NULL;
		$this->partid->OldValue = $this->partid->CurrentValue;
		$this->partno->CurrentValue = NULL;
		$this->partno->OldValue = $this->partno->CurrentValue;
		$this->dataSheetFile->Upload->DbValue = NULL;
		$this->dataSheetFile->OldValue = $this->dataSheetFile->Upload->DbValue;
		$this->manufacturer->CurrentValue = NULL;
		$this->manufacturer->OldValue = $this->manufacturer->CurrentValue;
		$this->tittle->CurrentValue = NULL;
		$this->tittle->OldValue = $this->tittle->CurrentValue;
		$this->cddissue->CurrentValue = NULL;
		$this->cddissue->OldValue = $this->cddissue->CurrentValue;
		$this->cddno->CurrentValue = NULL;
		$this->cddno->OldValue = $this->cddno->CurrentValue;
		$this->cddFile->Upload->DbValue = NULL;
		$this->cddFile->OldValue = $this->cddFile->Upload->DbValue;
		$this->thirdPartyNo->CurrentValue = NULL;
		$this->thirdPartyNo->OldValue = $this->thirdPartyNo->CurrentValue;
		$this->thirdPartyFile->Upload->DbValue = NULL;
		$this->thirdPartyFile->OldValue = $this->thirdPartyFile->Upload->DbValue;
		$this->cover->Upload->DbValue = NULL;
		$this->cover->OldValue = $this->cover->Upload->DbValue;
		$this->duration->CurrentValue = "2 YEARS";
		$this->duration->OldValue = $this->duration->CurrentValue;
		$this->expirydt->CurrentValue = NULL;
		$this->expirydt->OldValue = $this->expirydt->CurrentValue;
		$this->highlighted->CurrentValue = NULL;
		$this->highlighted->OldValue = $this->highlighted->CurrentValue;
		$this->coo->CurrentValue = NULL;
		$this->coo->OldValue = $this->coo->CurrentValue;
		$this->hssCode->CurrentValue = NULL;
		$this->hssCode->OldValue = $this->hssCode->CurrentValue;
		$this->systrade->CurrentValue = NULL;
		$this->systrade->OldValue = $this->systrade->CurrentValue;
		$this->isdatasheet->CurrentValue = "TRUE";
		$this->isdatasheet->OldValue = $this->isdatasheet->CurrentValue;
		$this->cddrenewal_required->CurrentValue = "TRUE";
		$this->cddrenewal_required->OldValue = $this->cddrenewal_required->CurrentValue;
		$this->datasheetdate->CurrentValue = NULL;
		$this->datasheetdate->OldValue = $this->datasheetdate->CurrentValue;
		$this->username->CurrentValue = NULL;
		$this->username->OldValue = $this->username->CurrentValue;
		$this->nativeFiles->CurrentValue = NULL;
		$this->nativeFiles->OldValue = $this->nativeFiles->CurrentValue;
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(TABLE_BASIC_SEARCH, ""), FALSE);
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(TABLE_BASIC_SEARCH_TYPE, ""), FALSE);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{
		global $CurrentForm;

		// Load search values
		// partno

		if (!$this->isAddOrEdit())
			$this->partno->AdvancedSearch->setSearchValue(Get("x_partno", Get("partno", "")));
		if ($this->partno->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->partno->AdvancedSearch->setSearchOperator(Get("z_partno", ""));

		// tittle
		if (!$this->isAddOrEdit())
			$this->tittle->AdvancedSearch->setSearchValue(Get("x_tittle", Get("tittle", "")));
		if ($this->tittle->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->tittle->AdvancedSearch->setSearchOperator(Get("z_tittle", ""));

		// cddissue
		if (!$this->isAddOrEdit())
			$this->cddissue->AdvancedSearch->setSearchValue(Get("x_cddissue", Get("cddissue", "")));
		if ($this->cddissue->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->cddissue->AdvancedSearch->setSearchOperator(Get("z_cddissue", ""));

		// expirydt
		if (!$this->isAddOrEdit())
			$this->expirydt->AdvancedSearch->setSearchValue(Get("x_expirydt", Get("expirydt", "")));
		if ($this->expirydt->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->expirydt->AdvancedSearch->setSearchOperator(Get("z_expirydt", ""));
		$this->expirydt->AdvancedSearch->setSearchCondition(Get("v_expirydt", ""));
		$this->expirydt->AdvancedSearch->setSearchValue2(Get("y_expirydt", ""));
		if ($this->expirydt->AdvancedSearch->SearchValue2 <> "" && $this->Command == "")
			$this->Command = "search";
		$this->expirydt->AdvancedSearch->setSearchOperator2(Get("w_expirydt", ""));

		// systrade
		if (!$this->isAddOrEdit())
			$this->systrade->AdvancedSearch->setSearchValue(Get("x_systrade", Get("systrade", "")));
		if ($this->systrade->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->systrade->AdvancedSearch->setSearchOperator(Get("z_systrade", ""));
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'partno' first before field var 'x_partno'
		$val = $CurrentForm->hasValue("partno") ? $CurrentForm->getValue("partno") : $CurrentForm->getValue("x_partno");
		if (!$this->partno->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->partno->Visible = FALSE; // Disable update for API request
			else
				$this->partno->setFormValue($val);
		}
		$this->partno->setOldValue($CurrentForm->getValue("o_partno"));

		// Check field name 'manufacturer' first before field var 'x_manufacturer'
		$val = $CurrentForm->hasValue("manufacturer") ? $CurrentForm->getValue("manufacturer") : $CurrentForm->getValue("x_manufacturer");
		if (!$this->manufacturer->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->manufacturer->Visible = FALSE; // Disable update for API request
			else
				$this->manufacturer->setFormValue($val);
		}
		$this->manufacturer->setOldValue($CurrentForm->getValue("o_manufacturer"));

		// Check field name 'tittle' first before field var 'x_tittle'
		$val = $CurrentForm->hasValue("tittle") ? $CurrentForm->getValue("tittle") : $CurrentForm->getValue("x_tittle");
		if (!$this->tittle->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tittle->Visible = FALSE; // Disable update for API request
			else
				$this->tittle->setFormValue($val);
		}
		$this->tittle->setOldValue($CurrentForm->getValue("o_tittle"));

		// Check field name 'cddissue' first before field var 'x_cddissue'
		$val = $CurrentForm->hasValue("cddissue") ? $CurrentForm->getValue("cddissue") : $CurrentForm->getValue("x_cddissue");
		if (!$this->cddissue->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cddissue->Visible = FALSE; // Disable update for API request
			else
				$this->cddissue->setFormValue($val);
			$this->cddissue->CurrentValue = UnFormatDateTime($this->cddissue->CurrentValue, 5);
		}
		$this->cddissue->setOldValue($CurrentForm->getValue("o_cddissue"));

		// Check field name 'cddno' first before field var 'x_cddno'
		$val = $CurrentForm->hasValue("cddno") ? $CurrentForm->getValue("cddno") : $CurrentForm->getValue("x_cddno");
		if (!$this->cddno->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cddno->Visible = FALSE; // Disable update for API request
			else
				$this->cddno->setFormValue($val);
		}
		$this->cddno->setOldValue($CurrentForm->getValue("o_cddno"));

		// Check field name 'thirdPartyNo' first before field var 'x_thirdPartyNo'
		$val = $CurrentForm->hasValue("thirdPartyNo") ? $CurrentForm->getValue("thirdPartyNo") : $CurrentForm->getValue("x_thirdPartyNo");
		if (!$this->thirdPartyNo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->thirdPartyNo->Visible = FALSE; // Disable update for API request
			else
				$this->thirdPartyNo->setFormValue($val);
		}
		$this->thirdPartyNo->setOldValue($CurrentForm->getValue("o_thirdPartyNo"));

		// Check field name 'expirydt' first before field var 'x_expirydt'
		$val = $CurrentForm->hasValue("expirydt") ? $CurrentForm->getValue("expirydt") : $CurrentForm->getValue("x_expirydt");
		if (!$this->expirydt->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->expirydt->Visible = FALSE; // Disable update for API request
			else
				$this->expirydt->setFormValue($val);
			$this->expirydt->CurrentValue = UnFormatDateTime($this->expirydt->CurrentValue, 5);
		}
		$this->expirydt->setOldValue($CurrentForm->getValue("o_expirydt"));

		// Check field name 'coo' first before field var 'x_coo'
		$val = $CurrentForm->hasValue("coo") ? $CurrentForm->getValue("coo") : $CurrentForm->getValue("x_coo");
		if (!$this->coo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->coo->Visible = FALSE; // Disable update for API request
			else
				$this->coo->setFormValue($val);
		}
		$this->coo->setOldValue($CurrentForm->getValue("o_coo"));

		// Check field name 'hssCode' first before field var 'x_hssCode'
		$val = $CurrentForm->hasValue("hssCode") ? $CurrentForm->getValue("hssCode") : $CurrentForm->getValue("x_hssCode");
		if (!$this->hssCode->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->hssCode->Visible = FALSE; // Disable update for API request
			else
				$this->hssCode->setFormValue($val);
		}
		$this->hssCode->setOldValue($CurrentForm->getValue("o_hssCode"));

		// Check field name 'systrade' first before field var 'x_systrade'
		$val = $CurrentForm->hasValue("systrade") ? $CurrentForm->getValue("systrade") : $CurrentForm->getValue("x_systrade");
		if (!$this->systrade->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->systrade->Visible = FALSE; // Disable update for API request
			else
				$this->systrade->setFormValue($val);
		}
		$this->systrade->setOldValue($CurrentForm->getValue("o_systrade"));

		// Check field name 'isdatasheet' first before field var 'x_isdatasheet'
		$val = $CurrentForm->hasValue("isdatasheet") ? $CurrentForm->getValue("isdatasheet") : $CurrentForm->getValue("x_isdatasheet");
		if (!$this->isdatasheet->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->isdatasheet->Visible = FALSE; // Disable update for API request
			else
				$this->isdatasheet->setFormValue($val);
		}
		$this->isdatasheet->setOldValue($CurrentForm->getValue("o_isdatasheet"));

		// Check field name 'cddrenewal_required' first before field var 'x_cddrenewal_required'
		$val = $CurrentForm->hasValue("cddrenewal_required") ? $CurrentForm->getValue("cddrenewal_required") : $CurrentForm->getValue("x_cddrenewal_required");
		if (!$this->cddrenewal_required->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cddrenewal_required->Visible = FALSE; // Disable update for API request
			else
				$this->cddrenewal_required->setFormValue($val);
		}
		$this->cddrenewal_required->setOldValue($CurrentForm->getValue("o_cddrenewal_required"));

		// Check field name 'nativeFiles' first before field var 'x_nativeFiles'
		$val = $CurrentForm->hasValue("nativeFiles") ? $CurrentForm->getValue("nativeFiles") : $CurrentForm->getValue("x_nativeFiles");
		if (!$this->nativeFiles->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nativeFiles->Visible = FALSE; // Disable update for API request
			else
				$this->nativeFiles->setFormValue($val);
		}
		$this->nativeFiles->setOldValue($CurrentForm->getValue("o_nativeFiles"));

		// Check field name 'partid' first before field var 'x_partid'
		$val = $CurrentForm->hasValue("partid") ? $CurrentForm->getValue("partid") : $CurrentForm->getValue("x_partid");
		if (!$this->partid->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->partid->setFormValue($val);
		if (!$this->isOverwrite())
			$this->HashValue = $CurrentForm->getValue("k_hash");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->partid->CurrentValue = $this->partid->FormValue;
		$this->partno->CurrentValue = $this->partno->FormValue;
		$this->manufacturer->CurrentValue = $this->manufacturer->FormValue;
		$this->tittle->CurrentValue = $this->tittle->FormValue;
		$this->cddissue->CurrentValue = $this->cddissue->FormValue;
		$this->cddissue->CurrentValue = UnFormatDateTime($this->cddissue->CurrentValue, 5);
		$this->cddno->CurrentValue = $this->cddno->FormValue;
		$this->thirdPartyNo->CurrentValue = $this->thirdPartyNo->FormValue;
		$this->expirydt->CurrentValue = $this->expirydt->FormValue;
		$this->expirydt->CurrentValue = UnFormatDateTime($this->expirydt->CurrentValue, 5);
		$this->coo->CurrentValue = $this->coo->FormValue;
		$this->hssCode->CurrentValue = $this->hssCode->FormValue;
		$this->systrade->CurrentValue = $this->systrade->FormValue;
		$this->isdatasheet->CurrentValue = $this->isdatasheet->FormValue;
		$this->cddrenewal_required->CurrentValue = $this->cddrenewal_required->FormValue;
		$this->nativeFiles->CurrentValue = $this->nativeFiles->FormValue;
		if (!$this->isOverwrite())
			$this->HashValue = $CurrentForm->getValue("k_hash");
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = &$this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			if (!$this->EventCancelled)
				$this->HashValue = $this->getRowHash($rs); // Get hash value for record
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->partid->setDbValue($row['partid']);
		$this->partno->setDbValue($row['partno']);
		$this->dataSheetFile->Upload->DbValue = $row['dataSheetFile'];
		$this->dataSheetFile->setDbValue($this->dataSheetFile->Upload->DbValue);
		$this->manufacturer->setDbValue($row['manufacturer']);
		if (array_key_exists('EV__manufacturer', $rs->fields)) {
			$this->manufacturer->VirtualValue = $rs->fields('EV__manufacturer'); // Set up virtual field value
		} else {
			$this->manufacturer->VirtualValue = ""; // Clear value
		}
		$this->tittle->setDbValue($row['tittle']);
		$this->cddissue->setDbValue($row['cddissue']);
		$this->cddno->setDbValue($row['cddno']);
		$this->cddFile->Upload->DbValue = $row['cddFile'];
		$this->cddFile->setDbValue($this->cddFile->Upload->DbValue);
		$this->thirdPartyNo->setDbValue($row['thirdPartyNo']);
		$this->thirdPartyFile->Upload->DbValue = $row['thirdPartyFile'];
		$this->thirdPartyFile->setDbValue($this->thirdPartyFile->Upload->DbValue);
		$this->cover->Upload->DbValue = $row['cover'];
		$this->cover->setDbValue($this->cover->Upload->DbValue);
		$this->duration->setDbValue($row['duration']);
		$this->expirydt->setDbValue($row['expirydt']);
		$this->highlighted->setDbValue((ConvertToBool($row['highlighted']) ? "1" : "0"));
		$this->coo->setDbValue($row['coo']);
		if (array_key_exists('EV__coo', $rs->fields)) {
			$this->coo->VirtualValue = $rs->fields('EV__coo'); // Set up virtual field value
		} else {
			$this->coo->VirtualValue = ""; // Clear value
		}
		$this->hssCode->setDbValue($row['hssCode']);
		$this->systrade->setDbValue($row['systrade']);
		$this->isdatasheet->setDbValue((ConvertToBool($row['isdatasheet']) ? "1" : "0"));
		$this->cddrenewal_required->setDbValue((ConvertToBool($row['cddrenewal_required']) ? "1" : "0"));
		$this->datasheetdate->setDbValue($row['datasheetdate']);
		$this->username->setDbValue($row['username']);
		$this->nativeFiles->setDbValue($row['nativeFiles']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['partid'] = $this->partid->CurrentValue;
		$row['partno'] = $this->partno->CurrentValue;
		$row['dataSheetFile'] = $this->dataSheetFile->Upload->DbValue;
		$row['manufacturer'] = $this->manufacturer->CurrentValue;
		$row['tittle'] = $this->tittle->CurrentValue;
		$row['cddissue'] = $this->cddissue->CurrentValue;
		$row['cddno'] = $this->cddno->CurrentValue;
		$row['cddFile'] = $this->cddFile->Upload->DbValue;
		$row['thirdPartyNo'] = $this->thirdPartyNo->CurrentValue;
		$row['thirdPartyFile'] = $this->thirdPartyFile->Upload->DbValue;
		$row['cover'] = $this->cover->Upload->DbValue;
		$row['duration'] = $this->duration->CurrentValue;
		$row['expirydt'] = $this->expirydt->CurrentValue;
		$row['highlighted'] = $this->highlighted->CurrentValue;
		$row['coo'] = $this->coo->CurrentValue;
		$row['hssCode'] = $this->hssCode->CurrentValue;
		$row['systrade'] = $this->systrade->CurrentValue;
		$row['isdatasheet'] = $this->isdatasheet->CurrentValue;
		$row['cddrenewal_required'] = $this->cddrenewal_required->CurrentValue;
		$row['datasheetdate'] = $this->datasheetdate->CurrentValue;
		$row['username'] = $this->username->CurrentValue;
		$row['nativeFiles'] = $this->nativeFiles->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("partid")) <> "")
			$this->partid->CurrentValue = $this->getKey("partid"); // partid
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// partid
		// partno

		$this->partno->CellCssStyle = "width: 10px;";

		// dataSheetFile
		$this->dataSheetFile->CellCssStyle = "width: 1px;";

		// manufacturer
		$this->manufacturer->CellCssStyle = "width: 10px;";

		// tittle
		// cddissue

		$this->cddissue->CellCssStyle = "width: 10px;";

		// cddno
		$this->cddno->CellCssStyle = "width: 10px;";

		// cddFile
		$this->cddFile->CellCssStyle = "width: 1px;";

		// thirdPartyNo
		$this->thirdPartyNo->CellCssStyle = "width: 5px;";

		// thirdPartyFile
		$this->thirdPartyFile->CellCssStyle = "width: 1px;";

		// cover
		$this->cover->CellCssStyle = "width: 1px;";

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

		// cddrenewal_required
		$this->cddrenewal_required->CellCssStyle = "width: 10px;";

		// datasheetdate
		$this->datasheetdate->CellCssStyle = "width: 10px;";

		// username
		$this->username->CellCssStyle = "width: 10px;";

		// nativeFiles
		$this->nativeFiles->CellCssStyle = "width: 1px;";
		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// cddFile
			if (!EmptyValue($this->cddFile->Upload->DbValue)) {
				$this->cddFile->ViewValue = $this->cddFile->Upload->DbValue;
			} else {
				$this->cddFile->ViewValue = "";
			}
			$this->cddFile->ViewCustomAttributes = "";

			// thirdPartyNo
			$this->thirdPartyNo->ViewValue = $this->thirdPartyNo->CurrentValue;
			$this->thirdPartyNo->ViewCustomAttributes = "";

			// thirdPartyFile
			if (!EmptyValue($this->thirdPartyFile->Upload->DbValue)) {
				$this->thirdPartyFile->ViewValue = $this->thirdPartyFile->Upload->DbValue;
			} else {
				$this->thirdPartyFile->ViewValue = "";
			}
			$this->thirdPartyFile->ViewCustomAttributes = "";

			// cover
			if (!EmptyValue($this->cover->Upload->DbValue)) {
				$this->cover->ViewValue = $this->cover->Upload->DbValue;
			} else {
				$this->cover->ViewValue = "";
			}
			$this->cover->ViewCustomAttributes = "";

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

			// cddrenewal_required
			if (ConvertToBool($this->cddrenewal_required->CurrentValue)) {
				$this->cddrenewal_required->ViewValue = $this->cddrenewal_required->tagCaption(1) <> "" ? $this->cddrenewal_required->tagCaption(1) : "Y";
			} else {
				$this->cddrenewal_required->ViewValue = $this->cddrenewal_required->tagCaption(2) <> "" ? $this->cddrenewal_required->tagCaption(2) : "N";
			}
			$this->cddrenewal_required->ViewCustomAttributes = "";

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

			// dataSheetFile
			$this->dataSheetFile->LinkCustomAttributes = "";
			$this->dataSheetFile->HrefValue = "";
			$this->dataSheetFile->ExportHrefValue = $this->dataSheetFile->UploadPath . $this->dataSheetFile->Upload->DbValue;
			$this->dataSheetFile->TooltipValue = "";

			// manufacturer
			$this->manufacturer->LinkCustomAttributes = "";
			$this->manufacturer->HrefValue = "";
			$this->manufacturer->TooltipValue = "";

			// tittle
			$this->tittle->LinkCustomAttributes = "";
			$this->tittle->HrefValue = "";
			$this->tittle->TooltipValue = "";

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

			// cddFile
			$this->cddFile->LinkCustomAttributes = "";
			$this->cddFile->HrefValue = "";
			$this->cddFile->ExportHrefValue = $this->cddFile->UploadPath . $this->cddFile->Upload->DbValue;
			$this->cddFile->TooltipValue = "";

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
			if (!$this->isExport())
				$this->thirdPartyNo->ViewValue = $this->highlightValue($this->thirdPartyNo);

			// thirdPartyFile
			$this->thirdPartyFile->LinkCustomAttributes = "";
			$this->thirdPartyFile->HrefValue = "";
			$this->thirdPartyFile->ExportHrefValue = $this->thirdPartyFile->UploadPath . $this->thirdPartyFile->Upload->DbValue;
			$this->thirdPartyFile->TooltipValue = "";

			// cover
			$this->cover->LinkCustomAttributes = "";
			$this->cover->HrefValue = "";
			$this->cover->ExportHrefValue = $this->cover->UploadPath . $this->cover->Upload->DbValue;
			$this->cover->TooltipValue = "";

			// expirydt
			$this->expirydt->LinkCustomAttributes = "";
			$this->expirydt->HrefValue = "";
			$this->expirydt->TooltipValue = "";

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

			// cddrenewal_required
			$this->cddrenewal_required->LinkCustomAttributes = "";
			$this->cddrenewal_required->HrefValue = "";
			$this->cddrenewal_required->TooltipValue = "";

			// nativeFiles
			$this->nativeFiles->LinkCustomAttributes = "";
			$this->nativeFiles->HrefValue = "";
			$this->nativeFiles->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// partno
			$this->partno->EditAttrs["class"] = "form-control";
			$this->partno->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->partno->CurrentValue = HtmlDecode($this->partno->CurrentValue);
			$this->partno->EditValue = HtmlEncode($this->partno->CurrentValue);
			$this->partno->PlaceHolder = RemoveHtml($this->partno->caption());

			// dataSheetFile
			$this->dataSheetFile->EditAttrs["class"] = "form-control";
			$this->dataSheetFile->EditCustomAttributes = "";
			if (!EmptyValue($this->dataSheetFile->Upload->DbValue)) {
				$this->dataSheetFile->EditValue = $this->dataSheetFile->Upload->DbValue;
			} else {
				$this->dataSheetFile->EditValue = "";
			}
			if (!EmptyValue($this->dataSheetFile->CurrentValue))
					if ($this->RowIndex == '$rowindex$')
						$this->dataSheetFile->Upload->FileName = "";
					else
						$this->dataSheetFile->Upload->FileName = $this->dataSheetFile->CurrentValue;
			if (is_numeric($this->RowIndex) && !$this->EventCancelled)
				RenderUploadField($this->dataSheetFile, $this->RowIndex);

			// manufacturer
			$this->manufacturer->EditAttrs["class"] = "form-control";
			$this->manufacturer->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->manufacturer->CurrentValue = HtmlDecode($this->manufacturer->CurrentValue);
			$this->manufacturer->EditValue = HtmlEncode($this->manufacturer->CurrentValue);
			$curVal = strval($this->manufacturer->CurrentValue);
			if ($curVal <> "") {
				$this->manufacturer->EditValue = $this->manufacturer->lookupCacheOption($curVal);
				if ($this->manufacturer->EditValue === NULL) { // Lookup from database
					$filterWrk = "\"manufacturerName\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->manufacturer->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->manufacturer->EditValue = $this->manufacturer->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->manufacturer->EditValue = HtmlEncode($this->manufacturer->CurrentValue);
					}
				}
			} else {
				$this->manufacturer->EditValue = NULL;
			}
			$this->manufacturer->PlaceHolder = RemoveHtml($this->manufacturer->caption());

			// tittle
			$this->tittle->EditAttrs["class"] = "form-control";
			$this->tittle->EditCustomAttributes = "";
			$this->tittle->EditValue = HtmlEncode($this->tittle->CurrentValue);
			$this->tittle->PlaceHolder = RemoveHtml($this->tittle->caption());

			// cddissue
			$this->cddissue->EditAttrs["class"] = "form-control";
			$this->cddissue->EditCustomAttributes = "";
			$this->cddissue->EditValue = HtmlEncode(FormatDateTime($this->cddissue->CurrentValue, 5));
			$this->cddissue->PlaceHolder = RemoveHtml($this->cddissue->caption());

			// cddno
			$this->cddno->EditAttrs["class"] = "form-control";
			$this->cddno->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->cddno->CurrentValue = HtmlDecode($this->cddno->CurrentValue);
			$this->cddno->EditValue = HtmlEncode($this->cddno->CurrentValue);
			$this->cddno->PlaceHolder = RemoveHtml($this->cddno->caption());

			// cddFile
			$this->cddFile->EditAttrs["class"] = "form-control";
			$this->cddFile->EditCustomAttributes = "";
			if (!EmptyValue($this->cddFile->Upload->DbValue)) {
				$this->cddFile->EditValue = $this->cddFile->Upload->DbValue;
			} else {
				$this->cddFile->EditValue = "";
			}
			if (!EmptyValue($this->cddFile->CurrentValue))
					if ($this->RowIndex == '$rowindex$')
						$this->cddFile->Upload->FileName = "";
					else
						$this->cddFile->Upload->FileName = $this->cddFile->CurrentValue;
			if (is_numeric($this->RowIndex) && !$this->EventCancelled)
				RenderUploadField($this->cddFile, $this->RowIndex);

			// thirdPartyNo
			$this->thirdPartyNo->EditAttrs["class"] = "form-control";
			$this->thirdPartyNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->thirdPartyNo->CurrentValue = HtmlDecode($this->thirdPartyNo->CurrentValue);
			$this->thirdPartyNo->EditValue = HtmlEncode($this->thirdPartyNo->CurrentValue);
			$this->thirdPartyNo->PlaceHolder = RemoveHtml($this->thirdPartyNo->caption());

			// thirdPartyFile
			$this->thirdPartyFile->EditAttrs["class"] = "form-control";
			$this->thirdPartyFile->EditCustomAttributes = "";
			if (!EmptyValue($this->thirdPartyFile->Upload->DbValue)) {
				$this->thirdPartyFile->EditValue = $this->thirdPartyFile->Upload->DbValue;
			} else {
				$this->thirdPartyFile->EditValue = "";
			}
			if (!EmptyValue($this->thirdPartyFile->CurrentValue))
					if ($this->RowIndex == '$rowindex$')
						$this->thirdPartyFile->Upload->FileName = "";
					else
						$this->thirdPartyFile->Upload->FileName = $this->thirdPartyFile->CurrentValue;
			if (is_numeric($this->RowIndex) && !$this->EventCancelled)
				RenderUploadField($this->thirdPartyFile, $this->RowIndex);

			// cover
			$this->cover->EditAttrs["class"] = "form-control";
			$this->cover->EditCustomAttributes = "";
			if (!EmptyValue($this->cover->Upload->DbValue)) {
				$this->cover->EditValue = $this->cover->Upload->DbValue;
			} else {
				$this->cover->EditValue = "";
			}
			if (!EmptyValue($this->cover->CurrentValue))
					if ($this->RowIndex == '$rowindex$')
						$this->cover->Upload->FileName = "";
					else
						$this->cover->Upload->FileName = $this->cover->CurrentValue;
			if (is_numeric($this->RowIndex) && !$this->EventCancelled)
				RenderUploadField($this->cover, $this->RowIndex);

			// expirydt
			$this->expirydt->EditAttrs["class"] = "form-control";
			$this->expirydt->EditCustomAttributes = "";
			$this->expirydt->EditValue = HtmlEncode(FormatDateTime($this->expirydt->CurrentValue, 5));
			$this->expirydt->PlaceHolder = RemoveHtml($this->expirydt->caption());

			// coo
			$this->coo->EditAttrs["class"] = "form-control";
			$this->coo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->coo->CurrentValue = HtmlDecode($this->coo->CurrentValue);
			$this->coo->EditValue = HtmlEncode($this->coo->CurrentValue);
			$this->coo->PlaceHolder = RemoveHtml($this->coo->caption());

			// hssCode
			$this->hssCode->EditAttrs["class"] = "form-control";
			$this->hssCode->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->hssCode->CurrentValue = HtmlDecode($this->hssCode->CurrentValue);
			$this->hssCode->EditValue = HtmlEncode($this->hssCode->CurrentValue);
			$this->hssCode->PlaceHolder = RemoveHtml($this->hssCode->caption());

			// systrade
			$this->systrade->EditAttrs["class"] = "form-control";
			$this->systrade->EditCustomAttributes = "";
			$this->systrade->EditValue = $this->systrade->options(TRUE);

			// isdatasheet
			$this->isdatasheet->EditCustomAttributes = "";
			$this->isdatasheet->EditValue = $this->isdatasheet->options(FALSE);

			// cddrenewal_required
			$this->cddrenewal_required->EditCustomAttributes = "";
			$this->cddrenewal_required->EditValue = $this->cddrenewal_required->options(FALSE);

			// nativeFiles
			$this->nativeFiles->EditAttrs["class"] = "form-control";
			$this->nativeFiles->EditCustomAttributes = "";
			$this->nativeFiles->EditValue = HtmlEncode($this->nativeFiles->CurrentValue);
			$this->nativeFiles->PlaceHolder = RemoveHtml($this->nativeFiles->caption());

			// Add refer script
			// partno

			$this->partno->LinkCustomAttributes = "";
			if (!EmptyValue($this->dataSheetFile->Upload->DbValue)) {
				$this->partno->HrefValue = GetFileUploadUrl($this->dataSheetFile, $this->dataSheetFile->Upload->DbValue); // Add prefix/suffix
				$this->partno->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->partno->HrefValue = FullUrl($this->partno->HrefValue, "href");
			} else {
				$this->partno->HrefValue = "";
			}

			// dataSheetFile
			$this->dataSheetFile->LinkCustomAttributes = "";
			$this->dataSheetFile->HrefValue = "";
			$this->dataSheetFile->ExportHrefValue = $this->dataSheetFile->UploadPath . $this->dataSheetFile->Upload->DbValue;

			// manufacturer
			$this->manufacturer->LinkCustomAttributes = "";
			$this->manufacturer->HrefValue = "";

			// tittle
			$this->tittle->LinkCustomAttributes = "";
			$this->tittle->HrefValue = "";

			// cddissue
			$this->cddissue->LinkCustomAttributes = "";
			$this->cddissue->HrefValue = "";

			// cddno
			$this->cddno->LinkCustomAttributes = "";
			if (!EmptyValue($this->cddFile->Upload->DbValue)) {
				$this->cddno->HrefValue = GetFileUploadUrl($this->cddFile, $this->cddFile->Upload->DbValue); // Add prefix/suffix
				$this->cddno->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->cddno->HrefValue = FullUrl($this->cddno->HrefValue, "href");
			} else {
				$this->cddno->HrefValue = "";
			}

			// cddFile
			$this->cddFile->LinkCustomAttributes = "";
			$this->cddFile->HrefValue = "";
			$this->cddFile->ExportHrefValue = $this->cddFile->UploadPath . $this->cddFile->Upload->DbValue;

			// thirdPartyNo
			$this->thirdPartyNo->LinkCustomAttributes = "";
			if (!EmptyValue($this->thirdPartyFile->Upload->DbValue)) {
				$this->thirdPartyNo->HrefValue = GetFileUploadUrl($this->thirdPartyFile, $this->thirdPartyFile->Upload->DbValue); // Add prefix/suffix
				$this->thirdPartyNo->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->thirdPartyNo->HrefValue = FullUrl($this->thirdPartyNo->HrefValue, "href");
			} else {
				$this->thirdPartyNo->HrefValue = "";
			}

			// thirdPartyFile
			$this->thirdPartyFile->LinkCustomAttributes = "";
			$this->thirdPartyFile->HrefValue = "";
			$this->thirdPartyFile->ExportHrefValue = $this->thirdPartyFile->UploadPath . $this->thirdPartyFile->Upload->DbValue;

			// cover
			$this->cover->LinkCustomAttributes = "";
			$this->cover->HrefValue = "";
			$this->cover->ExportHrefValue = $this->cover->UploadPath . $this->cover->Upload->DbValue;

			// expirydt
			$this->expirydt->LinkCustomAttributes = "";
			$this->expirydt->HrefValue = "";

			// coo
			$this->coo->LinkCustomAttributes = "";
			$this->coo->HrefValue = "";

			// hssCode
			$this->hssCode->LinkCustomAttributes = "";
			$this->hssCode->HrefValue = "";

			// systrade
			$this->systrade->LinkCustomAttributes = "";
			$this->systrade->HrefValue = "";

			// isdatasheet
			$this->isdatasheet->LinkCustomAttributes = "";
			$this->isdatasheet->HrefValue = "";

			// cddrenewal_required
			$this->cddrenewal_required->LinkCustomAttributes = "";
			$this->cddrenewal_required->HrefValue = "";

			// nativeFiles
			$this->nativeFiles->LinkCustomAttributes = "";
			$this->nativeFiles->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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
					if ($this->RowIndex == '$rowindex$')
						$this->dataSheetFile->Upload->FileName = "";
					else
						$this->dataSheetFile->Upload->FileName = $this->dataSheetFile->CurrentValue;
			if (is_numeric($this->RowIndex) && !$this->EventCancelled)
				RenderUploadField($this->dataSheetFile, $this->RowIndex);

			// manufacturer
			$this->manufacturer->EditAttrs["class"] = "form-control";
			$this->manufacturer->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->manufacturer->CurrentValue = HtmlDecode($this->manufacturer->CurrentValue);
			$this->manufacturer->EditValue = HtmlEncode($this->manufacturer->CurrentValue);
			$curVal = strval($this->manufacturer->CurrentValue);
			if ($curVal <> "") {
				$this->manufacturer->EditValue = $this->manufacturer->lookupCacheOption($curVal);
				if ($this->manufacturer->EditValue === NULL) { // Lookup from database
					$filterWrk = "\"manufacturerName\"" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->manufacturer->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->manufacturer->EditValue = $this->manufacturer->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->manufacturer->EditValue = HtmlEncode($this->manufacturer->CurrentValue);
					}
				}
			} else {
				$this->manufacturer->EditValue = NULL;
			}
			$this->manufacturer->PlaceHolder = RemoveHtml($this->manufacturer->caption());

			// tittle
			$this->tittle->EditAttrs["class"] = "form-control";
			$this->tittle->EditCustomAttributes = "";
			$this->tittle->EditValue = HtmlEncode($this->tittle->CurrentValue);
			$this->tittle->PlaceHolder = RemoveHtml($this->tittle->caption());

			// cddissue
			$this->cddissue->EditAttrs["class"] = "form-control";
			$this->cddissue->EditCustomAttributes = "";
			$this->cddissue->EditValue = HtmlEncode(FormatDateTime($this->cddissue->CurrentValue, 5));
			$this->cddissue->PlaceHolder = RemoveHtml($this->cddissue->caption());

			// cddno
			$this->cddno->EditAttrs["class"] = "form-control";
			$this->cddno->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->cddno->CurrentValue = HtmlDecode($this->cddno->CurrentValue);
			$this->cddno->EditValue = HtmlEncode($this->cddno->CurrentValue);
			$this->cddno->PlaceHolder = RemoveHtml($this->cddno->caption());

			// cddFile
			$this->cddFile->EditAttrs["class"] = "form-control";
			$this->cddFile->EditCustomAttributes = "";
			if (!EmptyValue($this->cddFile->Upload->DbValue)) {
				$this->cddFile->EditValue = $this->cddFile->Upload->DbValue;
			} else {
				$this->cddFile->EditValue = "";
			}
			if (!EmptyValue($this->cddFile->CurrentValue))
					if ($this->RowIndex == '$rowindex$')
						$this->cddFile->Upload->FileName = "";
					else
						$this->cddFile->Upload->FileName = $this->cddFile->CurrentValue;
			if (is_numeric($this->RowIndex) && !$this->EventCancelled)
				RenderUploadField($this->cddFile, $this->RowIndex);

			// thirdPartyNo
			$this->thirdPartyNo->EditAttrs["class"] = "form-control";
			$this->thirdPartyNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->thirdPartyNo->CurrentValue = HtmlDecode($this->thirdPartyNo->CurrentValue);
			$this->thirdPartyNo->EditValue = HtmlEncode($this->thirdPartyNo->CurrentValue);
			$this->thirdPartyNo->PlaceHolder = RemoveHtml($this->thirdPartyNo->caption());

			// thirdPartyFile
			$this->thirdPartyFile->EditAttrs["class"] = "form-control";
			$this->thirdPartyFile->EditCustomAttributes = "";
			if (!EmptyValue($this->thirdPartyFile->Upload->DbValue)) {
				$this->thirdPartyFile->EditValue = $this->thirdPartyFile->Upload->DbValue;
			} else {
				$this->thirdPartyFile->EditValue = "";
			}
			if (!EmptyValue($this->thirdPartyFile->CurrentValue))
					if ($this->RowIndex == '$rowindex$')
						$this->thirdPartyFile->Upload->FileName = "";
					else
						$this->thirdPartyFile->Upload->FileName = $this->thirdPartyFile->CurrentValue;
			if (is_numeric($this->RowIndex) && !$this->EventCancelled)
				RenderUploadField($this->thirdPartyFile, $this->RowIndex);

			// cover
			$this->cover->EditAttrs["class"] = "form-control";
			$this->cover->EditCustomAttributes = "";
			if (!EmptyValue($this->cover->Upload->DbValue)) {
				$this->cover->EditValue = $this->cover->Upload->DbValue;
			} else {
				$this->cover->EditValue = "";
			}
			if (!EmptyValue($this->cover->CurrentValue))
					if ($this->RowIndex == '$rowindex$')
						$this->cover->Upload->FileName = "";
					else
						$this->cover->Upload->FileName = $this->cover->CurrentValue;
			if (is_numeric($this->RowIndex) && !$this->EventCancelled)
				RenderUploadField($this->cover, $this->RowIndex);

			// expirydt
			$this->expirydt->EditAttrs["class"] = "form-control";
			$this->expirydt->EditCustomAttributes = "";
			$this->expirydt->EditValue = HtmlEncode(FormatDateTime($this->expirydt->CurrentValue, 5));
			$this->expirydt->PlaceHolder = RemoveHtml($this->expirydt->caption());

			// coo
			$this->coo->EditAttrs["class"] = "form-control";
			$this->coo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->coo->CurrentValue = HtmlDecode($this->coo->CurrentValue);
			$this->coo->EditValue = HtmlEncode($this->coo->CurrentValue);
			$this->coo->PlaceHolder = RemoveHtml($this->coo->caption());

			// hssCode
			$this->hssCode->EditAttrs["class"] = "form-control";
			$this->hssCode->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->hssCode->CurrentValue = HtmlDecode($this->hssCode->CurrentValue);
			$this->hssCode->EditValue = HtmlEncode($this->hssCode->CurrentValue);
			$this->hssCode->PlaceHolder = RemoveHtml($this->hssCode->caption());

			// systrade
			$this->systrade->EditAttrs["class"] = "form-control";
			$this->systrade->EditCustomAttributes = "";
			$this->systrade->EditValue = $this->systrade->options(TRUE);

			// isdatasheet
			$this->isdatasheet->EditCustomAttributes = "";
			$this->isdatasheet->EditValue = $this->isdatasheet->options(FALSE);

			// cddrenewal_required
			$this->cddrenewal_required->EditCustomAttributes = "";
			$this->cddrenewal_required->EditValue = $this->cddrenewal_required->options(FALSE);

			// nativeFiles
			$this->nativeFiles->EditAttrs["class"] = "form-control";
			$this->nativeFiles->EditCustomAttributes = "";
			$this->nativeFiles->EditValue = HtmlEncode($this->nativeFiles->CurrentValue);
			$this->nativeFiles->PlaceHolder = RemoveHtml($this->nativeFiles->caption());

			// Edit refer script
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
			$this->dataSheetFile->HrefValue = "";
			$this->dataSheetFile->ExportHrefValue = $this->dataSheetFile->UploadPath . $this->dataSheetFile->Upload->DbValue;

			// manufacturer
			$this->manufacturer->LinkCustomAttributes = "";
			$this->manufacturer->HrefValue = "";

			// tittle
			$this->tittle->LinkCustomAttributes = "";
			$this->tittle->HrefValue = "";

			// cddissue
			$this->cddissue->LinkCustomAttributes = "";
			$this->cddissue->HrefValue = "";

			// cddno
			$this->cddno->LinkCustomAttributes = "";
			if (!EmptyValue($this->cddFile->Upload->DbValue)) {
				$this->cddno->HrefValue = GetFileUploadUrl($this->cddFile, $this->cddFile->Upload->DbValue); // Add prefix/suffix
				$this->cddno->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->cddno->HrefValue = FullUrl($this->cddno->HrefValue, "href");
			} else {
				$this->cddno->HrefValue = "";
			}

			// cddFile
			$this->cddFile->LinkCustomAttributes = "";
			$this->cddFile->HrefValue = "";
			$this->cddFile->ExportHrefValue = $this->cddFile->UploadPath . $this->cddFile->Upload->DbValue;

			// thirdPartyNo
			$this->thirdPartyNo->LinkCustomAttributes = "";
			if (!EmptyValue($this->thirdPartyFile->Upload->DbValue)) {
				$this->thirdPartyNo->HrefValue = GetFileUploadUrl($this->thirdPartyFile, $this->thirdPartyFile->Upload->DbValue); // Add prefix/suffix
				$this->thirdPartyNo->LinkAttrs["target"] = "_blank"; // Add target
				if ($this->isExport()) $this->thirdPartyNo->HrefValue = FullUrl($this->thirdPartyNo->HrefValue, "href");
			} else {
				$this->thirdPartyNo->HrefValue = "";
			}

			// thirdPartyFile
			$this->thirdPartyFile->LinkCustomAttributes = "";
			$this->thirdPartyFile->HrefValue = "";
			$this->thirdPartyFile->ExportHrefValue = $this->thirdPartyFile->UploadPath . $this->thirdPartyFile->Upload->DbValue;

			// cover
			$this->cover->LinkCustomAttributes = "";
			$this->cover->HrefValue = "";
			$this->cover->ExportHrefValue = $this->cover->UploadPath . $this->cover->Upload->DbValue;

			// expirydt
			$this->expirydt->LinkCustomAttributes = "";
			$this->expirydt->HrefValue = "";

			// coo
			$this->coo->LinkCustomAttributes = "";
			$this->coo->HrefValue = "";

			// hssCode
			$this->hssCode->LinkCustomAttributes = "";
			$this->hssCode->HrefValue = "";

			// systrade
			$this->systrade->LinkCustomAttributes = "";
			$this->systrade->HrefValue = "";

			// isdatasheet
			$this->isdatasheet->LinkCustomAttributes = "";
			$this->isdatasheet->HrefValue = "";

			// cddrenewal_required
			$this->cddrenewal_required->LinkCustomAttributes = "";
			$this->cddrenewal_required->HrefValue = "";

			// nativeFiles
			$this->nativeFiles->LinkCustomAttributes = "";
			$this->nativeFiles->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// partno
			$this->partno->EditAttrs["class"] = "form-control";
			$this->partno->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->partno->AdvancedSearch->SearchValue = HtmlDecode($this->partno->AdvancedSearch->SearchValue);
			$this->partno->EditValue = HtmlEncode($this->partno->AdvancedSearch->SearchValue);
			$this->partno->PlaceHolder = RemoveHtml($this->partno->caption());

			// dataSheetFile
			$this->dataSheetFile->EditAttrs["class"] = "form-control";
			$this->dataSheetFile->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->dataSheetFile->AdvancedSearch->SearchValue = HtmlDecode($this->dataSheetFile->AdvancedSearch->SearchValue);
			$this->dataSheetFile->EditValue = HtmlEncode($this->dataSheetFile->AdvancedSearch->SearchValue);
			$this->dataSheetFile->PlaceHolder = RemoveHtml($this->dataSheetFile->caption());

			// manufacturer
			$this->manufacturer->EditAttrs["class"] = "form-control";
			$this->manufacturer->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->manufacturer->AdvancedSearch->SearchValue = HtmlDecode($this->manufacturer->AdvancedSearch->SearchValue);
			$this->manufacturer->EditValue = HtmlEncode($this->manufacturer->AdvancedSearch->SearchValue);
			$this->manufacturer->PlaceHolder = RemoveHtml($this->manufacturer->caption());

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

			// cddno
			$this->cddno->EditAttrs["class"] = "form-control";
			$this->cddno->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->cddno->AdvancedSearch->SearchValue = HtmlDecode($this->cddno->AdvancedSearch->SearchValue);
			$this->cddno->EditValue = HtmlEncode($this->cddno->AdvancedSearch->SearchValue);
			$this->cddno->PlaceHolder = RemoveHtml($this->cddno->caption());

			// cddFile
			$this->cddFile->EditAttrs["class"] = "form-control";
			$this->cddFile->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->cddFile->AdvancedSearch->SearchValue = HtmlDecode($this->cddFile->AdvancedSearch->SearchValue);
			$this->cddFile->EditValue = HtmlEncode($this->cddFile->AdvancedSearch->SearchValue);
			$this->cddFile->PlaceHolder = RemoveHtml($this->cddFile->caption());

			// thirdPartyNo
			$this->thirdPartyNo->EditAttrs["class"] = "form-control";
			$this->thirdPartyNo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->thirdPartyNo->AdvancedSearch->SearchValue = HtmlDecode($this->thirdPartyNo->AdvancedSearch->SearchValue);
			$this->thirdPartyNo->EditValue = HtmlEncode($this->thirdPartyNo->AdvancedSearch->SearchValue);
			$this->thirdPartyNo->PlaceHolder = RemoveHtml($this->thirdPartyNo->caption());

			// thirdPartyFile
			$this->thirdPartyFile->EditAttrs["class"] = "form-control";
			$this->thirdPartyFile->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->thirdPartyFile->AdvancedSearch->SearchValue = HtmlDecode($this->thirdPartyFile->AdvancedSearch->SearchValue);
			$this->thirdPartyFile->EditValue = HtmlEncode($this->thirdPartyFile->AdvancedSearch->SearchValue);
			$this->thirdPartyFile->PlaceHolder = RemoveHtml($this->thirdPartyFile->caption());

			// cover
			$this->cover->EditAttrs["class"] = "form-control";
			$this->cover->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->cover->AdvancedSearch->SearchValue = HtmlDecode($this->cover->AdvancedSearch->SearchValue);
			$this->cover->EditValue = HtmlEncode($this->cover->AdvancedSearch->SearchValue);
			$this->cover->PlaceHolder = RemoveHtml($this->cover->caption());

			// expirydt
			$this->expirydt->EditAttrs["class"] = "form-control";
			$this->expirydt->EditCustomAttributes = "";
			$this->expirydt->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->expirydt->AdvancedSearch->SearchValue, 5), 5));
			$this->expirydt->PlaceHolder = RemoveHtml($this->expirydt->caption());
			$this->expirydt->EditAttrs["class"] = "form-control";
			$this->expirydt->EditCustomAttributes = "";
			$this->expirydt->EditValue2 = HtmlEncode(FormatDateTime(UnFormatDateTime($this->expirydt->AdvancedSearch->SearchValue2, 5), 5));
			$this->expirydt->PlaceHolder = RemoveHtml($this->expirydt->caption());

			// coo
			$this->coo->EditAttrs["class"] = "form-control";
			$this->coo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->coo->AdvancedSearch->SearchValue = HtmlDecode($this->coo->AdvancedSearch->SearchValue);
			$this->coo->EditValue = HtmlEncode($this->coo->AdvancedSearch->SearchValue);
			$this->coo->PlaceHolder = RemoveHtml($this->coo->caption());

			// hssCode
			$this->hssCode->EditAttrs["class"] = "form-control";
			$this->hssCode->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->hssCode->AdvancedSearch->SearchValue = HtmlDecode($this->hssCode->AdvancedSearch->SearchValue);
			$this->hssCode->EditValue = HtmlEncode($this->hssCode->AdvancedSearch->SearchValue);
			$this->hssCode->PlaceHolder = RemoveHtml($this->hssCode->caption());

			// systrade
			$this->systrade->EditAttrs["class"] = "form-control";
			$this->systrade->EditCustomAttributes = "";
			$this->systrade->EditValue = $this->systrade->options(TRUE);

			// isdatasheet
			$this->isdatasheet->EditCustomAttributes = "";
			$this->isdatasheet->EditValue = $this->isdatasheet->options(FALSE);

			// cddrenewal_required
			$this->cddrenewal_required->EditCustomAttributes = "";
			$this->cddrenewal_required->EditValue = $this->cddrenewal_required->options(FALSE);

			// nativeFiles
			$this->nativeFiles->EditAttrs["class"] = "form-control";
			$this->nativeFiles->EditCustomAttributes = "";
			$this->nativeFiles->EditValue = HtmlEncode($this->nativeFiles->AdvancedSearch->SearchValue);
			$this->nativeFiles->PlaceHolder = RemoveHtml($this->nativeFiles->caption());
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

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->partid->Required) {
			if (!$this->partid->IsDetailKey && $this->partid->FormValue != NULL && $this->partid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->partid->caption(), $this->partid->RequiredErrorMessage));
			}
		}
		if ($this->partno->Required) {
			if (!$this->partno->IsDetailKey && $this->partno->FormValue != NULL && $this->partno->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->partno->caption(), $this->partno->RequiredErrorMessage));
			}
		}
		if ($this->dataSheetFile->Required) {
			if ($this->dataSheetFile->Upload->FileName == "" && !$this->dataSheetFile->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->dataSheetFile->caption(), $this->dataSheetFile->RequiredErrorMessage));
			}
		}
		if ($this->manufacturer->Required) {
			if (!$this->manufacturer->IsDetailKey && $this->manufacturer->FormValue != NULL && $this->manufacturer->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->manufacturer->caption(), $this->manufacturer->RequiredErrorMessage));
			}
		}
		if ($this->tittle->Required) {
			if (!$this->tittle->IsDetailKey && $this->tittle->FormValue != NULL && $this->tittle->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tittle->caption(), $this->tittle->RequiredErrorMessage));
			}
		}
		if ($this->cddissue->Required) {
			if (!$this->cddissue->IsDetailKey && $this->cddissue->FormValue != NULL && $this->cddissue->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cddissue->caption(), $this->cddissue->RequiredErrorMessage));
			}
		}
		if (!CheckStdDate($this->cddissue->FormValue)) {
			AddMessage($FormError, $this->cddissue->errorMessage());
		}
		if ($this->cddno->Required) {
			if (!$this->cddno->IsDetailKey && $this->cddno->FormValue != NULL && $this->cddno->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cddno->caption(), $this->cddno->RequiredErrorMessage));
			}
		}
		if ($this->cddFile->Required) {
			if ($this->cddFile->Upload->FileName == "" && !$this->cddFile->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->cddFile->caption(), $this->cddFile->RequiredErrorMessage));
			}
		}
		if ($this->thirdPartyNo->Required) {
			if (!$this->thirdPartyNo->IsDetailKey && $this->thirdPartyNo->FormValue != NULL && $this->thirdPartyNo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->thirdPartyNo->caption(), $this->thirdPartyNo->RequiredErrorMessage));
			}
		}
		if ($this->thirdPartyFile->Required) {
			if ($this->thirdPartyFile->Upload->FileName == "" && !$this->thirdPartyFile->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->thirdPartyFile->caption(), $this->thirdPartyFile->RequiredErrorMessage));
			}
		}
		if ($this->cover->Required) {
			if ($this->cover->Upload->FileName == "" && !$this->cover->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->cover->caption(), $this->cover->RequiredErrorMessage));
			}
		}
		if ($this->duration->Required) {
			if (!$this->duration->IsDetailKey && $this->duration->FormValue != NULL && $this->duration->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->duration->caption(), $this->duration->RequiredErrorMessage));
			}
		}
		if ($this->expirydt->Required) {
			if (!$this->expirydt->IsDetailKey && $this->expirydt->FormValue != NULL && $this->expirydt->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->expirydt->caption(), $this->expirydt->RequiredErrorMessage));
			}
		}
		if (!CheckStdDate($this->expirydt->FormValue)) {
			AddMessage($FormError, $this->expirydt->errorMessage());
		}
		if ($this->highlighted->Required) {
			if ($this->highlighted->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->highlighted->caption(), $this->highlighted->RequiredErrorMessage));
			}
		}
		if ($this->coo->Required) {
			if (!$this->coo->IsDetailKey && $this->coo->FormValue != NULL && $this->coo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->coo->caption(), $this->coo->RequiredErrorMessage));
			}
		}
		if ($this->hssCode->Required) {
			if (!$this->hssCode->IsDetailKey && $this->hssCode->FormValue != NULL && $this->hssCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hssCode->caption(), $this->hssCode->RequiredErrorMessage));
			}
		}
		if ($this->systrade->Required) {
			if (!$this->systrade->IsDetailKey && $this->systrade->FormValue != NULL && $this->systrade->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->systrade->caption(), $this->systrade->RequiredErrorMessage));
			}
		}
		if ($this->isdatasheet->Required) {
			if ($this->isdatasheet->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->isdatasheet->caption(), $this->isdatasheet->RequiredErrorMessage));
			}
		}
		if ($this->cddrenewal_required->Required) {
			if ($this->cddrenewal_required->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cddrenewal_required->caption(), $this->cddrenewal_required->RequiredErrorMessage));
			}
		}
		if ($this->datasheetdate->Required) {
			if (!$this->datasheetdate->IsDetailKey && $this->datasheetdate->FormValue != NULL && $this->datasheetdate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->datasheetdate->caption(), $this->datasheetdate->RequiredErrorMessage));
			}
		}
		if ($this->username->Required) {
			if (!$this->username->IsDetailKey && $this->username->FormValue != NULL && $this->username->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->username->caption(), $this->username->RequiredErrorMessage));
			}
		}
		if ($this->nativeFiles->Required) {
			if (!$this->nativeFiles->IsDetailKey && $this->nativeFiles->FormValue != NULL && $this->nativeFiles->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nativeFiles->caption(), $this->nativeFiles->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];
		if ($this->AuditTrailOnDelete)
			$this->writeAuditTrailDummy($Language->phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey <> "")
					$thisKey .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
				$thisKey .= $row['partid'];
				if (DELETE_UPLOADED_FILES) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($deleteRows === FALSE)
					break;
				if ($key <> "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($filter);
		$conn = &$this->getConnection();
		if ($this->partno->CurrentValue <> "") { // Check field with unique index
			$filterChk = "(\"partno\" = '" . AdjustSql($this->partno->CurrentValue, $this->Dbid) . "')";
			$filterChk .= " AND NOT (" . $filter . ")";
			$this->CurrentFilter = $filterChk;
			$sqlChk = $this->getCurrentSql();
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$rsChk = $conn->Execute($sqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->partno->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->partno->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
			$rsChk->close();
		}
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// dataSheetFile
			if ($this->dataSheetFile->Visible && !$this->dataSheetFile->ReadOnly && !$this->dataSheetFile->Upload->KeepFile) {
				$this->dataSheetFile->Upload->DbValue = $rsold['dataSheetFile']; // Get original value
				if ($this->dataSheetFile->Upload->FileName == "") {
					$rsnew['dataSheetFile'] = NULL;
				} else {
					$rsnew['dataSheetFile'] = $this->dataSheetFile->Upload->FileName;
				}
			}

			// manufacturer
			$this->manufacturer->setDbValueDef($rsnew, $this->manufacturer->CurrentValue, "", $this->manufacturer->ReadOnly);

			// tittle
			$this->tittle->setDbValueDef($rsnew, $this->tittle->CurrentValue, "", $this->tittle->ReadOnly);

			// cddissue
			$this->cddissue->setDbValueDef($rsnew, UnFormatDateTime($this->cddissue->CurrentValue, 5), CurrentDate(), $this->cddissue->ReadOnly);

			// cddno
			$this->cddno->setDbValueDef($rsnew, $this->cddno->CurrentValue, "", $this->cddno->ReadOnly);

			// cddFile
			if ($this->cddFile->Visible && !$this->cddFile->ReadOnly && !$this->cddFile->Upload->KeepFile) {
				$this->cddFile->Upload->DbValue = $rsold['cddFile']; // Get original value
				if ($this->cddFile->Upload->FileName == "") {
					$rsnew['cddFile'] = NULL;
				} else {
					$rsnew['cddFile'] = $this->cddFile->Upload->FileName;
				}
			}

			// thirdPartyNo
			$this->thirdPartyNo->setDbValueDef($rsnew, $this->thirdPartyNo->CurrentValue, "", $this->thirdPartyNo->ReadOnly);

			// thirdPartyFile
			if ($this->thirdPartyFile->Visible && !$this->thirdPartyFile->ReadOnly && !$this->thirdPartyFile->Upload->KeepFile) {
				$this->thirdPartyFile->Upload->DbValue = $rsold['thirdPartyFile']; // Get original value
				if ($this->thirdPartyFile->Upload->FileName == "") {
					$rsnew['thirdPartyFile'] = NULL;
				} else {
					$rsnew['thirdPartyFile'] = $this->thirdPartyFile->Upload->FileName;
				}
			}

			// cover
			if ($this->cover->Visible && !$this->cover->ReadOnly && !$this->cover->Upload->KeepFile) {
				$this->cover->Upload->DbValue = $rsold['cover']; // Get original value
				if ($this->cover->Upload->FileName == "") {
					$rsnew['cover'] = NULL;
				} else {
					$rsnew['cover'] = $this->cover->Upload->FileName;
				}
			}

			// expirydt
			$this->expirydt->setDbValueDef($rsnew, UnFormatDateTime($this->expirydt->CurrentValue, 5), NULL, $this->expirydt->ReadOnly);

			// coo
			$this->coo->setDbValueDef($rsnew, $this->coo->CurrentValue, NULL, $this->coo->ReadOnly);

			// hssCode
			$this->hssCode->setDbValueDef($rsnew, $this->hssCode->CurrentValue, NULL, $this->hssCode->ReadOnly);

			// systrade
			$this->systrade->setDbValueDef($rsnew, $this->systrade->CurrentValue, "", $this->systrade->ReadOnly);

			// isdatasheet
			$this->isdatasheet->setDbValueDef($rsnew, ((strval($this->isdatasheet->CurrentValue) == "1") ? "1" : "0"), 0, $this->isdatasheet->ReadOnly);

			// cddrenewal_required
			$this->cddrenewal_required->setDbValueDef($rsnew, ((strval($this->cddrenewal_required->CurrentValue) == "1") ? "1" : "0"), NULL, $this->cddrenewal_required->ReadOnly);

			// nativeFiles
			$this->nativeFiles->setDbValueDef($rsnew, $this->nativeFiles->CurrentValue, "", $this->nativeFiles->ReadOnly);

			// Check hash value
			$rowHasConflict = (!IsApi() && $this->getRowHash($rs) <> $this->HashValue);

			// Call Row Update Conflict event
			if ($rowHasConflict)
				$rowHasConflict = $this->Row_UpdateConflict($rsold, $rsnew);
			if ($rowHasConflict) {
				$this->setFailureMessage($Language->phrase("RecordChangedByOtherUser"));
				$this->UpdateConflict = "U";
				$rs->close();
				return FALSE; // Update Failed
			}
			if ($this->dataSheetFile->Visible && !$this->dataSheetFile->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->dataSheetFile->Upload->DbValue) ? array() : array($this->dataSheetFile->Upload->DbValue);
				if (!EmptyValue($this->dataSheetFile->Upload->FileName)) {
					$newFiles = array($this->dataSheetFile->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->dataSheetFile, $this->dataSheetFile->Upload->Index) . $file)) {
								if (DELETE_UPLOADED_FILES) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											unset($oldFiles[$j]);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->dataSheetFile->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->dataSheetFile, $this->dataSheetFile->Upload->Index) . $file1) || file_exists($this->dataSheetFile->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->dataSheetFile->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->dataSheetFile, $this->dataSheetFile->Upload->Index) . $file, UploadTempPath($this->dataSheetFile, $this->dataSheetFile->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->dataSheetFile->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->dataSheetFile->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->dataSheetFile->setDbValueDef($rsnew, $this->dataSheetFile->Upload->FileName, "", $this->dataSheetFile->ReadOnly);
				}
			}
			if ($this->cddFile->Visible && !$this->cddFile->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->cddFile->Upload->DbValue) ? array() : array($this->cddFile->Upload->DbValue);
				if (!EmptyValue($this->cddFile->Upload->FileName)) {
					$newFiles = array($this->cddFile->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->cddFile, $this->cddFile->Upload->Index) . $file)) {
								if (DELETE_UPLOADED_FILES) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											unset($oldFiles[$j]);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->cddFile->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->cddFile, $this->cddFile->Upload->Index) . $file1) || file_exists($this->cddFile->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->cddFile->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->cddFile, $this->cddFile->Upload->Index) . $file, UploadTempPath($this->cddFile, $this->cddFile->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->cddFile->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->cddFile->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->cddFile->setDbValueDef($rsnew, $this->cddFile->Upload->FileName, NULL, $this->cddFile->ReadOnly);
				}
			}
			if ($this->thirdPartyFile->Visible && !$this->thirdPartyFile->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->thirdPartyFile->Upload->DbValue) ? array() : array($this->thirdPartyFile->Upload->DbValue);
				if (!EmptyValue($this->thirdPartyFile->Upload->FileName)) {
					$newFiles = array($this->thirdPartyFile->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->thirdPartyFile, $this->thirdPartyFile->Upload->Index) . $file)) {
								if (DELETE_UPLOADED_FILES) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											unset($oldFiles[$j]);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->thirdPartyFile->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->thirdPartyFile, $this->thirdPartyFile->Upload->Index) . $file1) || file_exists($this->thirdPartyFile->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->thirdPartyFile->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->thirdPartyFile, $this->thirdPartyFile->Upload->Index) . $file, UploadTempPath($this->thirdPartyFile, $this->thirdPartyFile->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->thirdPartyFile->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->thirdPartyFile->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->thirdPartyFile->setDbValueDef($rsnew, $this->thirdPartyFile->Upload->FileName, "", $this->thirdPartyFile->ReadOnly);
				}
			}
			if ($this->cover->Visible && !$this->cover->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->cover->Upload->DbValue) ? array() : array($this->cover->Upload->DbValue);
				if (!EmptyValue($this->cover->Upload->FileName)) {
					$newFiles = array($this->cover->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->cover, $this->cover->Upload->Index) . $file)) {
								if (DELETE_UPLOADED_FILES) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											unset($oldFiles[$j]);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->cover->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->cover, $this->cover->Upload->Index) . $file1) || file_exists($this->cover->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->cover->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->cover, $this->cover->Upload->Index) . $file, UploadTempPath($this->cover, $this->cover->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->cover->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->cover->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->cover->setDbValueDef($rsnew, $this->cover->Upload->FileName, "", $this->cover->ReadOnly);
				}
			}

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);
			if ($updateRow) {
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($editRow) {
					if ($this->dataSheetFile->Visible && !$this->dataSheetFile->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->dataSheetFile->Upload->DbValue) ? array() : array($this->dataSheetFile->Upload->DbValue);
						if (!EmptyValue($this->dataSheetFile->Upload->FileName)) {
							$newFiles = array($this->dataSheetFile->Upload->FileName);
							$newFiles2 = array($rsnew['dataSheetFile']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->dataSheetFile, $this->dataSheetFile->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->dataSheetFile->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = array();
						}
						if (DELETE_UPLOADED_FILES) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile <> "" && !in_array($oldFile, $newFiles))
									@unlink($this->dataSheetFile->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->cddFile->Visible && !$this->cddFile->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->cddFile->Upload->DbValue) ? array() : array($this->cddFile->Upload->DbValue);
						if (!EmptyValue($this->cddFile->Upload->FileName)) {
							$newFiles = array($this->cddFile->Upload->FileName);
							$newFiles2 = array($rsnew['cddFile']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->cddFile, $this->cddFile->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->cddFile->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = array();
						}
						if (DELETE_UPLOADED_FILES) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile <> "" && !in_array($oldFile, $newFiles))
									@unlink($this->cddFile->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->thirdPartyFile->Visible && !$this->thirdPartyFile->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->thirdPartyFile->Upload->DbValue) ? array() : array($this->thirdPartyFile->Upload->DbValue);
						if (!EmptyValue($this->thirdPartyFile->Upload->FileName)) {
							$newFiles = array($this->thirdPartyFile->Upload->FileName);
							$newFiles2 = array($rsnew['thirdPartyFile']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->thirdPartyFile, $this->thirdPartyFile->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->thirdPartyFile->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = array();
						}
						if (DELETE_UPLOADED_FILES) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile <> "" && !in_array($oldFile, $newFiles))
									@unlink($this->thirdPartyFile->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->cover->Visible && !$this->cover->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->cover->Upload->DbValue) ? array() : array($this->cover->Upload->DbValue);
						if (!EmptyValue($this->cover->Upload->FileName)) {
							$newFiles = array($this->cover->Upload->FileName);
							$newFiles2 = array($rsnew['cover']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->cover, $this->cover->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->cover->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = array();
						}
						if (DELETE_UPLOADED_FILES) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile <> "" && !in_array($oldFile, $newFiles))
									@unlink($this->cover->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// dataSheetFile
		if ($this->dataSheetFile->Upload->FileToken <> "")
			CleanUploadTempPath($this->dataSheetFile->Upload->FileToken, $this->dataSheetFile->Upload->Index);
		else
			CleanUploadTempPath($this->dataSheetFile, $this->dataSheetFile->Upload->Index);

		// cddFile
		if ($this->cddFile->Upload->FileToken <> "")
			CleanUploadTempPath($this->cddFile->Upload->FileToken, $this->cddFile->Upload->Index);
		else
			CleanUploadTempPath($this->cddFile, $this->cddFile->Upload->Index);

		// thirdPartyFile
		if ($this->thirdPartyFile->Upload->FileToken <> "")
			CleanUploadTempPath($this->thirdPartyFile->Upload->FileToken, $this->thirdPartyFile->Upload->Index);
		else
			CleanUploadTempPath($this->thirdPartyFile, $this->thirdPartyFile->Upload->Index);

		// cover
		if ($this->cover->Upload->FileToken <> "")
			CleanUploadTempPath($this->cover->Upload->FileToken, $this->cover->Upload->Index);
		else
			CleanUploadTempPath($this->cover, $this->cover->Upload->Index);

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Load row hash
	protected function loadRowHash()
	{
		$filter = $this->getRecordFilter();

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$rsRow = $conn->Execute($sql);
		$this->HashValue = ($rsRow && !$rsRow->EOF) ? $this->getRowHash($rsRow) : ""; // Get hash value for record
		$rsRow->close();
	}

	// Get Row Hash
	public function getRowHash(&$rs)
	{
		if (!$rs)
			return "";
		$hash = "";
		$hash .= GetFieldHash($rs->fields('dataSheetFile')); // dataSheetFile
		$hash .= GetFieldHash($rs->fields('manufacturer')); // manufacturer
		$hash .= GetFieldHash($rs->fields('tittle')); // tittle
		$hash .= GetFieldHash($rs->fields('cddissue')); // cddissue
		$hash .= GetFieldHash($rs->fields('cddno')); // cddno
		$hash .= GetFieldHash($rs->fields('cddFile')); // cddFile
		$hash .= GetFieldHash($rs->fields('thirdPartyNo')); // thirdPartyNo
		$hash .= GetFieldHash($rs->fields('thirdPartyFile')); // thirdPartyFile
		$hash .= GetFieldHash($rs->fields('cover')); // cover
		$hash .= GetFieldHash($rs->fields('expirydt')); // expirydt
		$hash .= GetFieldHash($rs->fields('coo')); // coo
		$hash .= GetFieldHash($rs->fields('hssCode')); // hssCode
		$hash .= GetFieldHash($rs->fields('systrade')); // systrade
		$hash .= GetFieldHash($rs->fields('isdatasheet')); // isdatasheet
		$hash .= GetFieldHash($rs->fields('cddrenewal_required')); // cddrenewal_required
		$hash .= GetFieldHash($rs->fields('nativeFiles')); // nativeFiles
		return md5($hash);
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		if ($this->partno->CurrentValue <> "") { // Check field with unique index
			$filter = "(partno = '" . AdjustSql($this->partno->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->partno->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->partno->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// partno
		$this->partno->setDbValueDef($rsnew, $this->partno->CurrentValue, "", FALSE);

		// dataSheetFile
		if ($this->dataSheetFile->Visible && !$this->dataSheetFile->Upload->KeepFile) {
			$this->dataSheetFile->Upload->DbValue = ""; // No need to delete old file
			if ($this->dataSheetFile->Upload->FileName == "") {
				$rsnew['dataSheetFile'] = NULL;
			} else {
				$rsnew['dataSheetFile'] = $this->dataSheetFile->Upload->FileName;
			}
		}

		// manufacturer
		$this->manufacturer->setDbValueDef($rsnew, $this->manufacturer->CurrentValue, "", FALSE);

		// tittle
		$this->tittle->setDbValueDef($rsnew, $this->tittle->CurrentValue, "", FALSE);

		// cddissue
		$this->cddissue->setDbValueDef($rsnew, UnFormatDateTime($this->cddissue->CurrentValue, 5), CurrentDate(), FALSE);

		// cddno
		$this->cddno->setDbValueDef($rsnew, $this->cddno->CurrentValue, "", FALSE);

		// cddFile
		if ($this->cddFile->Visible && !$this->cddFile->Upload->KeepFile) {
			$this->cddFile->Upload->DbValue = ""; // No need to delete old file
			if ($this->cddFile->Upload->FileName == "") {
				$rsnew['cddFile'] = NULL;
			} else {
				$rsnew['cddFile'] = $this->cddFile->Upload->FileName;
			}
		}

		// thirdPartyNo
		$this->thirdPartyNo->setDbValueDef($rsnew, $this->thirdPartyNo->CurrentValue, "", FALSE);

		// thirdPartyFile
		if ($this->thirdPartyFile->Visible && !$this->thirdPartyFile->Upload->KeepFile) {
			$this->thirdPartyFile->Upload->DbValue = ""; // No need to delete old file
			if ($this->thirdPartyFile->Upload->FileName == "") {
				$rsnew['thirdPartyFile'] = NULL;
			} else {
				$rsnew['thirdPartyFile'] = $this->thirdPartyFile->Upload->FileName;
			}
		}

		// cover
		if ($this->cover->Visible && !$this->cover->Upload->KeepFile) {
			$this->cover->Upload->DbValue = ""; // No need to delete old file
			if ($this->cover->Upload->FileName == "") {
				$rsnew['cover'] = NULL;
			} else {
				$rsnew['cover'] = $this->cover->Upload->FileName;
			}
		}

		// expirydt
		$this->expirydt->setDbValueDef($rsnew, UnFormatDateTime($this->expirydt->CurrentValue, 5), NULL, strval($this->expirydt->CurrentValue) == "");

		// coo
		$this->coo->setDbValueDef($rsnew, $this->coo->CurrentValue, NULL, strval($this->coo->CurrentValue) == "");

		// hssCode
		$this->hssCode->setDbValueDef($rsnew, $this->hssCode->CurrentValue, NULL, FALSE);

		// systrade
		$this->systrade->setDbValueDef($rsnew, $this->systrade->CurrentValue, "", strval($this->systrade->CurrentValue) == "");

		// isdatasheet
		$this->isdatasheet->setDbValueDef($rsnew, ((strval($this->isdatasheet->CurrentValue) == "1") ? "1" : "0"), 0, strval($this->isdatasheet->CurrentValue) == "");

		// cddrenewal_required
		$this->cddrenewal_required->setDbValueDef($rsnew, ((strval($this->cddrenewal_required->CurrentValue) == "1") ? "1" : "0"), NULL, strval($this->cddrenewal_required->CurrentValue) == "");

		// nativeFiles
		$this->nativeFiles->setDbValueDef($rsnew, $this->nativeFiles->CurrentValue, "", FALSE);
		if ($this->dataSheetFile->Visible && !$this->dataSheetFile->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->dataSheetFile->Upload->DbValue) ? array() : array($this->dataSheetFile->Upload->DbValue);
			if (!EmptyValue($this->dataSheetFile->Upload->FileName)) {
				$newFiles = array($this->dataSheetFile->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->dataSheetFile, $this->dataSheetFile->Upload->Index) . $file)) {
							if (DELETE_UPLOADED_FILES) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->dataSheetFile->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->dataSheetFile, $this->dataSheetFile->Upload->Index) . $file1) || file_exists($this->dataSheetFile->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->dataSheetFile->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->dataSheetFile, $this->dataSheetFile->Upload->Index) . $file, UploadTempPath($this->dataSheetFile, $this->dataSheetFile->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->dataSheetFile->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->dataSheetFile->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->dataSheetFile->setDbValueDef($rsnew, $this->dataSheetFile->Upload->FileName, "", FALSE);
			}
		}
		if ($this->cddFile->Visible && !$this->cddFile->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->cddFile->Upload->DbValue) ? array() : array($this->cddFile->Upload->DbValue);
			if (!EmptyValue($this->cddFile->Upload->FileName)) {
				$newFiles = array($this->cddFile->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->cddFile, $this->cddFile->Upload->Index) . $file)) {
							if (DELETE_UPLOADED_FILES) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->cddFile->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->cddFile, $this->cddFile->Upload->Index) . $file1) || file_exists($this->cddFile->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->cddFile->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->cddFile, $this->cddFile->Upload->Index) . $file, UploadTempPath($this->cddFile, $this->cddFile->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->cddFile->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->cddFile->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->cddFile->setDbValueDef($rsnew, $this->cddFile->Upload->FileName, NULL, strval($this->cddFile->CurrentValue) == "");
			}
		}
		if ($this->thirdPartyFile->Visible && !$this->thirdPartyFile->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->thirdPartyFile->Upload->DbValue) ? array() : array($this->thirdPartyFile->Upload->DbValue);
			if (!EmptyValue($this->thirdPartyFile->Upload->FileName)) {
				$newFiles = array($this->thirdPartyFile->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->thirdPartyFile, $this->thirdPartyFile->Upload->Index) . $file)) {
							if (DELETE_UPLOADED_FILES) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->thirdPartyFile->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->thirdPartyFile, $this->thirdPartyFile->Upload->Index) . $file1) || file_exists($this->thirdPartyFile->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->thirdPartyFile->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->thirdPartyFile, $this->thirdPartyFile->Upload->Index) . $file, UploadTempPath($this->thirdPartyFile, $this->thirdPartyFile->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->thirdPartyFile->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->thirdPartyFile->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->thirdPartyFile->setDbValueDef($rsnew, $this->thirdPartyFile->Upload->FileName, "", strval($this->thirdPartyFile->CurrentValue) == "");
			}
		}
		if ($this->cover->Visible && !$this->cover->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->cover->Upload->DbValue) ? array() : array($this->cover->Upload->DbValue);
			if (!EmptyValue($this->cover->Upload->FileName)) {
				$newFiles = array($this->cover->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->cover, $this->cover->Upload->Index) . $file)) {
							if (DELETE_UPLOADED_FILES) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->cover->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->cover, $this->cover->Upload->Index) . $file1) || file_exists($this->cover->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->cover->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->cover, $this->cover->Upload->Index) . $file, UploadTempPath($this->cover, $this->cover->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->cover->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->cover->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->cover->setDbValueDef($rsnew, $this->cover->Upload->FileName, "", strval($this->cover->CurrentValue) == "");
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
				if ($this->dataSheetFile->Visible && !$this->dataSheetFile->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->dataSheetFile->Upload->DbValue) ? array() : array($this->dataSheetFile->Upload->DbValue);
					if (!EmptyValue($this->dataSheetFile->Upload->FileName)) {
						$newFiles = array($this->dataSheetFile->Upload->FileName);
						$newFiles2 = array($rsnew['dataSheetFile']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->dataSheetFile, $this->dataSheetFile->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->dataSheetFile->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = array();
					}
					if (DELETE_UPLOADED_FILES) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile <> "" && !in_array($oldFile, $newFiles))
								@unlink($this->dataSheetFile->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->cddFile->Visible && !$this->cddFile->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->cddFile->Upload->DbValue) ? array() : array($this->cddFile->Upload->DbValue);
					if (!EmptyValue($this->cddFile->Upload->FileName)) {
						$newFiles = array($this->cddFile->Upload->FileName);
						$newFiles2 = array($rsnew['cddFile']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->cddFile, $this->cddFile->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->cddFile->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = array();
					}
					if (DELETE_UPLOADED_FILES) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile <> "" && !in_array($oldFile, $newFiles))
								@unlink($this->cddFile->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->thirdPartyFile->Visible && !$this->thirdPartyFile->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->thirdPartyFile->Upload->DbValue) ? array() : array($this->thirdPartyFile->Upload->DbValue);
					if (!EmptyValue($this->thirdPartyFile->Upload->FileName)) {
						$newFiles = array($this->thirdPartyFile->Upload->FileName);
						$newFiles2 = array($rsnew['thirdPartyFile']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->thirdPartyFile, $this->thirdPartyFile->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->thirdPartyFile->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = array();
					}
					if (DELETE_UPLOADED_FILES) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile <> "" && !in_array($oldFile, $newFiles))
								@unlink($this->thirdPartyFile->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->cover->Visible && !$this->cover->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->cover->Upload->DbValue) ? array() : array($this->cover->Upload->DbValue);
					if (!EmptyValue($this->cover->Upload->FileName)) {
						$newFiles = array($this->cover->Upload->FileName);
						$newFiles2 = array($rsnew['cover']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->cover, $this->cover->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->cover->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = array();
					}
					if (DELETE_UPLOADED_FILES) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile <> "" && !in_array($oldFile, $newFiles))
								@unlink($this->cover->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// dataSheetFile
		if ($this->dataSheetFile->Upload->FileToken <> "")
			CleanUploadTempPath($this->dataSheetFile->Upload->FileToken, $this->dataSheetFile->Upload->Index);
		else
			CleanUploadTempPath($this->dataSheetFile, $this->dataSheetFile->Upload->Index);

		// cddFile
		if ($this->cddFile->Upload->FileToken <> "")
			CleanUploadTempPath($this->cddFile->Upload->FileToken, $this->cddFile->Upload->Index);
		else
			CleanUploadTempPath($this->cddFile, $this->cddFile->Upload->Index);

		// thirdPartyFile
		if ($this->thirdPartyFile->Upload->FileToken <> "")
			CleanUploadTempPath($this->thirdPartyFile->Upload->FileToken, $this->thirdPartyFile->Upload->Index);
		else
			CleanUploadTempPath($this->thirdPartyFile, $this->thirdPartyFile->Upload->Index);

		// cover
		if ($this->cover->Upload->FileToken <> "")
			CleanUploadTempPath($this->cover->Upload->FileToken, $this->cover->Upload->Index);
		else
			CleanUploadTempPath($this->cover, $this->cover->Upload->Index);

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->partno->AdvancedSearch->load();
		$this->tittle->AdvancedSearch->load();
		$this->cddissue->AdvancedSearch->load();
		$this->expirydt->AdvancedSearch->load();
		$this->systrade->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"ew.export(document.fdatasheetslist,'" . $this->ExportExcelUrl . "','excel',true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"ew.export(document.fdatasheetslist,'" . $this->ExportWordUrl . "','word',true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"javascript:void(0);\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"ew.export(document.fdatasheetslist,'" . $this->ExportPdfUrl . "','pdf',true);\">" . $Language->phrase("ExportToPDF") . "</a>";
			else
				return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "html")) {
			return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
		} elseif (SameText($type, "xml")) {
			return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
		} elseif (SameText($type, "csv")) {
			return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = FALSE;

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = $this->getExportTag("html");
		$item->Visible = TRUE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = $this->getExportTag("xml");
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = $this->getExportTag("csv");
		$item->Visible = FALSE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$url = "";
		$item->Body = "<button id=\"emf_datasheets\" class=\"ew-export-link ew-email\" title=\"" . $Language->phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->phrase("ExportToEmailText") . "\" onclick=\"ew.emailDialogShow({lnk:'emf_datasheets',hdr:ew.language.phrase('ExportToEmailText'),f:document.fdatasheetslist,sel:false" . $url . "});\">" . $Language->phrase("ExportToEmail") . "</button>";
		$item->Visible = TRUE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	/**
	 * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	 *
	 * @param boolean $return Return the data rather than output it
	 * @return mixed 
	 */
	public function exportData($return = FALSE)
	{
		global $Language;
		$utf8 = SameText(PROJECT_CHARSET, "utf-8");
		$selectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecs = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->setupStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($selectLimit)
			$rs = $this->loadRecordset($this->StartRec - 1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		$this->ExportDoc = GetExportDocument($this, "h");
		$doc = &$this->ExportDoc;
		if (!$doc)
			$this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
		if (!$rs || !$doc) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		if ($selectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRec, $this->StopRec, "");
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer (without destroying output buffer)
		$buffer = ob_get_contents(); // Save the output buffer
		if (!DEBUG_ENABLED && $buffer)
			ob_clean();

		// Write debug message if enabled
		if (DEBUG_ENABLED && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {
			if ($return)
				return $doc->Text; // Return email content
			else
				echo $this->exportEmail($doc->Text); // Send email
		} else {
			$doc->export();
			if ($return) {
				RemoveHeader("Content-Type"); // Remove header
				RemoveHeader("Content-Disposition");
				$content = ob_get_contents();
				if ($content)
					ob_clean();
				if ($buffer)
					echo $buffer; // Resume the output buffer
				return $content;
			}
		}
	}

	// Export email
	protected function exportEmail($emailContent)
	{
		global $TempImages, $Language;
		$sender = Post("sender", "");
		$recipient = Post("recipient", "");
		$cc = Post("cc", "");
		$bcc = Post("bcc", "");

		// Subject
		$subject = Post("subject", "");
		$emailSubject = $subject;

		// Message
		$content = Post("message", "");
		$emailMessage = $content;

		// Check sender
		if ($sender == "") {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterSenderEmail") . "</p>";
		}
		if (!CheckEmail($sender)) {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterProperSenderEmail") . "</p>";
		}

		// Check recipient
		if (!CheckEmailList($recipient, MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterProperRecipientEmail") . "</p>";
		}

		// Check cc
		if (!CheckEmailList($cc, MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterProperCcEmail") . "</p>";
		}

		// Check bcc
		if (!CheckEmailList($bcc, MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->phrase("EnterProperBccEmail") . "</p>";
		}

		// Check email sent count
		if (!isset($_SESSION[EXPORT_EMAIL_COUNTER]))
			$_SESSION[EXPORT_EMAIL_COUNTER] = 0;
		if ((int)$_SESSION[EXPORT_EMAIL_COUNTER] > MAX_EMAIL_SENT_COUNT) {
			return "<p class=\"text-danger\">" . $Language->phrase("ExceedMaxEmailExport") . "</p>";
		}

		// Send email
		$email = new Email();
		$email->Sender = $sender; // Sender
		$email->Recipient = $recipient; // Recipient
		$email->Cc = $cc; // Cc
		$email->Bcc = $bcc; // Bcc
		$email->Subject = $emailSubject; // Subject
		$email->Format = "html";
		if ($emailMessage <> "")
			$emailMessage = RemoveXss($emailMessage) . "<br><br>";
		foreach ($TempImages as $tmpImage)
			$email->addEmbeddedImage($tmpImage);
		$email->Content = $emailMessage . CleanEmailContent($emailContent); // Content
		$eventArgs = [];
		if ($this->Recordset) {
			$this->RecCnt = $this->StartRec - 1;
			$this->Recordset->moveFirst();
			if ($this->StartRec > 1)
				$this->Recordset->move($this->StartRec - 1);
			$eventArgs["rs"] = &$this->Recordset;
		}
		$emailSent = FALSE;
		if ($this->Email_Sending($email, $eventArgs))
			$emailSent = $email->send();

		// Check email sent status
		if ($emailSent) {

			// Update email sent count
			$_SESSION[EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			return "<p class=\"text-success\">" . $Language->phrase("SendEmailSuccess") . "</p>"; // Set up success message
		} else {

			// Sent email failure
			return "<p class=\"text-danger\">" . $email->SendErrDescription . "</p>";
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->ParentFields) == 0 && count($fld->Lookup->Options) == 0) {
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

	/**if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "add" || $this->CurrentAction == "gridedit" || $this->CurrentAction == "copy" ) {
	$this->cddFile->Visible = TRUE;
	$this->dataSheetFile->Visible = TRUE;
	//$this->thirdPartyFile->Visible = TRUE;
	$this->cover->Visible = TRUE;
	echo("<br> Found Something <br>");
	var_dump($this->dataSheetFile);
	echo("<br> Found Something <br>");
	var_dump($this->cddFile);
	echo("<br> Found Something <br>");
	var_dump($this->thirdPartyFile);
	}
	**/
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
		//$this->cddFile->Visible = FALSE;
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
	// ListOptions Load event
	function ListOptions_Load() {
		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column
		//$this->ListOptions->Items["dataSheetFile"]->Visible = TRUE;
		//$this->ListOptions->Items["thirdPartyFile"]->Visible = FALSE;
		//$this->ListOptions->Items["cover"]->Visible = FALSE;

	/** For Anonymous Users no need to render following field. The below field would only
	be rendered during edit and update from user level of admin or document contoller
	**/
	$CurrentUserRole = $GLOBALS["Security"]->CurrentUserLevelID();
	if ($CurrentUserRole == -2 || $CurrentUserRole == 0 ){ 
	$this->dataSheetFile->Visible = FALSE;
	$this->thirdPartyFile->Visible = FALSE;
	$this->cover->Visible = FALSE;
	$this->cddFile->Visible = FALSE;
	}
	}
	// ListOptions Rendering event
	function ListOptions_Rendering() {
		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally
	}
	// ListOptions Rendered event
	function ListOptions_Rendered() {
		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";
	}
	// Row Custom Action event
	function Row_CustomAction($action, $row) {
		// Return FALSE to abort
		return TRUE;
	}
	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {
		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event
		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}
	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {
		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}
	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {
		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;
	}
	// Page Importing event
	function Page_Importing($reader, &$options) {
		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import
		return TRUE;
	}
	// Row Import event
	function Row_Import(&$row, $cnt) {
		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import
		return TRUE;
	}
	// Page Imported event
	function Page_Imported($reader, $results) {
		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results
	}
}
?>