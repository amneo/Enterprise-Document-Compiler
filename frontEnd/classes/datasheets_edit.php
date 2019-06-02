<?php
namespace PHPMaker2019\SUBMITTAL;

/**
 * Page class
 */
class datasheets_edit extends datasheets
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{vishal-sub}";

	// Table name
	public $TableName = 'datasheets';

	// Page object name
	public $PageObjName = "datasheets_edit";

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
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $HashValue; // Hash Value
	public $DisplayRecs = 1;
	public $StartRec;
	public $StopRec;
	public $TotalRecs = 0;
	public $RecRange = 10;
	public $Pager;
	public $AutoHidePager = AUTO_HIDE_PAGER;
	public $RecCnt;
	public $MultiPages; // Multi pages object

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

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
			if (!$Security->canEdit()) {
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
		$this->dataSheetFile->setVisibility();
		$this->manufacturer->setVisibility();
		$this->tittle->setVisibility();
		$this->cddissue->setVisibility();
		$this->cddno->setVisibility();
		$this->cddFile->setVisibility();
		$this->thirdPartyNo->setVisibility();
		$this->thirdPartyFile->setVisibility();
		$this->cover->setVisibility();
		$this->duration->setVisibility();
		$this->expirydt->setVisibility();
		$this->highlighted->setVisibility();
		$this->coo->setVisibility();
		$this->hssCode->setVisibility();
		$this->systrade->setVisibility();
		$this->isdatasheet->setVisibility();
		$this->cddrenewal_required->setVisibility();
		$this->datasheetdate->Visible = FALSE;
		$this->username->Visible = FALSE;
		$this->nativeFiles->setVisibility();
		$this->hideFieldsForAddEdit();
		$this->partno->Required = FALSE;

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up multi page object
		$this->setupMultiPages();

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

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";

		// Load record by position
		$loadByPosition = FALSE;
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_partid")) {
				$this->partid->setFormValue($CurrentForm->getValue("x_partid"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("partid") !== NULL) {
				$this->partid->setQueryStringValue(Get("partid"));
				$loadByQuery = TRUE;
			} else {
				$this->partid->CurrentValue = NULL;
			}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
		}

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($rs = $this->loadRecordset()) // Load records
			$this->TotalRecs = $rs->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$this->terminate("datasheetslist.php"); // Return to list page
		} elseif ($loadByPosition) { // Load record by position
			$this->setupStartRec(); // Set up start record position

			// Point to current record
			if ($this->StartRec <= $this->TotalRecs) {
				$rs->move($this->StartRec - 1);
				$loaded = TRUE;
			}
		} else { // Match key values
			if ($this->partid->CurrentValue != NULL) {
				while (!$rs->EOF) {
					if (SameString($this->partid->CurrentValue, $rs->fields('partid'))) {
						$this->setStartRecordNumber($this->StartRec); // Save record position
						$loaded = TRUE;
						break;
					} else {
						$this->StartRec++;
						$rs->moveNext();
					}
				}
			}
		}

		// Load current row values
		if ($loaded)
			$this->loadRowValues($rs);

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Overwrite record, reload hash value
			if ($this->isOverwrite()) {
				$this->loadRowHash();
				$this->CurrentAction = "confirm";
			}
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
					$this->terminate("datasheetslist.php"); // Return to list page
				} else {
					$this->HashValue = $this->getRowHash($rs); // Get hash value for record
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "datasheetslist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		if ($this->isConfirm()) { // Confirm page
			$this->RowType = ROWTYPE_VIEW; // Render as View
		} else {
			$this->RowType = ROWTYPE_EDIT; // Render as Edit
		}
		$this->resetAttributes();
		$this->renderRow();
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

		// Check field name 'manufacturer' first before field var 'x_manufacturer'
		$val = $CurrentForm->hasValue("manufacturer") ? $CurrentForm->getValue("manufacturer") : $CurrentForm->getValue("x_manufacturer");
		if (!$this->manufacturer->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->manufacturer->Visible = FALSE; // Disable update for API request
			else
				$this->manufacturer->setFormValue($val);
		}

		// Check field name 'tittle' first before field var 'x_tittle'
		$val = $CurrentForm->hasValue("tittle") ? $CurrentForm->getValue("tittle") : $CurrentForm->getValue("x_tittle");
		if (!$this->tittle->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tittle->Visible = FALSE; // Disable update for API request
			else
				$this->tittle->setFormValue($val);
		}

		// Check field name 'cddissue' first before field var 'x_cddissue'
		$val = $CurrentForm->hasValue("cddissue") ? $CurrentForm->getValue("cddissue") : $CurrentForm->getValue("x_cddissue");
		if (!$this->cddissue->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cddissue->Visible = FALSE; // Disable update for API request
			else
				$this->cddissue->setFormValue($val);
			$this->cddissue->CurrentValue = UnFormatDateTime($this->cddissue->CurrentValue, 5);
		}

		// Check field name 'cddno' first before field var 'x_cddno'
		$val = $CurrentForm->hasValue("cddno") ? $CurrentForm->getValue("cddno") : $CurrentForm->getValue("x_cddno");
		if (!$this->cddno->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cddno->Visible = FALSE; // Disable update for API request
			else
				$this->cddno->setFormValue($val);
		}

		// Check field name 'thirdPartyNo' first before field var 'x_thirdPartyNo'
		$val = $CurrentForm->hasValue("thirdPartyNo") ? $CurrentForm->getValue("thirdPartyNo") : $CurrentForm->getValue("x_thirdPartyNo");
		if (!$this->thirdPartyNo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->thirdPartyNo->Visible = FALSE; // Disable update for API request
			else
				$this->thirdPartyNo->setFormValue($val);
		}

		// Check field name 'duration' first before field var 'x_duration'
		$val = $CurrentForm->hasValue("duration") ? $CurrentForm->getValue("duration") : $CurrentForm->getValue("x_duration");
		if (!$this->duration->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->duration->Visible = FALSE; // Disable update for API request
			else
				$this->duration->setFormValue($val);
		}

		// Check field name 'expirydt' first before field var 'x_expirydt'
		$val = $CurrentForm->hasValue("expirydt") ? $CurrentForm->getValue("expirydt") : $CurrentForm->getValue("x_expirydt");
		if (!$this->expirydt->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->expirydt->Visible = FALSE; // Disable update for API request
			else
				$this->expirydt->setFormValue($val);
			$this->expirydt->CurrentValue = UnFormatDateTime($this->expirydt->CurrentValue, 5);
		}

		// Check field name 'highlighted' first before field var 'x_highlighted'
		$val = $CurrentForm->hasValue("highlighted") ? $CurrentForm->getValue("highlighted") : $CurrentForm->getValue("x_highlighted");
		if (!$this->highlighted->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->highlighted->Visible = FALSE; // Disable update for API request
			else
				$this->highlighted->setFormValue($val);
		}

		// Check field name 'coo' first before field var 'x_coo'
		$val = $CurrentForm->hasValue("coo") ? $CurrentForm->getValue("coo") : $CurrentForm->getValue("x_coo");
		if (!$this->coo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->coo->Visible = FALSE; // Disable update for API request
			else
				$this->coo->setFormValue($val);
		}

		// Check field name 'hssCode' first before field var 'x_hssCode'
		$val = $CurrentForm->hasValue("hssCode") ? $CurrentForm->getValue("hssCode") : $CurrentForm->getValue("x_hssCode");
		if (!$this->hssCode->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->hssCode->Visible = FALSE; // Disable update for API request
			else
				$this->hssCode->setFormValue($val);
		}

		// Check field name 'systrade' first before field var 'x_systrade'
		$val = $CurrentForm->hasValue("systrade") ? $CurrentForm->getValue("systrade") : $CurrentForm->getValue("x_systrade");
		if (!$this->systrade->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->systrade->Visible = FALSE; // Disable update for API request
			else
				$this->systrade->setFormValue($val);
		}

		// Check field name 'isdatasheet' first before field var 'x_isdatasheet'
		$val = $CurrentForm->hasValue("isdatasheet") ? $CurrentForm->getValue("isdatasheet") : $CurrentForm->getValue("x_isdatasheet");
		if (!$this->isdatasheet->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->isdatasheet->Visible = FALSE; // Disable update for API request
			else
				$this->isdatasheet->setFormValue($val);
		}

		// Check field name 'cddrenewal_required' first before field var 'x_cddrenewal_required'
		$val = $CurrentForm->hasValue("cddrenewal_required") ? $CurrentForm->getValue("cddrenewal_required") : $CurrentForm->getValue("x_cddrenewal_required");
		if (!$this->cddrenewal_required->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cddrenewal_required->Visible = FALSE; // Disable update for API request
			else
				$this->cddrenewal_required->setFormValue($val);
		}

		// Check field name 'nativeFiles' first before field var 'x_nativeFiles'
		$val = $CurrentForm->hasValue("nativeFiles") ? $CurrentForm->getValue("nativeFiles") : $CurrentForm->getValue("x_nativeFiles");
		if (!$this->nativeFiles->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nativeFiles->Visible = FALSE; // Disable update for API request
			else
				$this->nativeFiles->setFormValue($val);
		}

		// Check field name 'partid' first before field var 'x_partid'
		$val = $CurrentForm->hasValue("partid") ? $CurrentForm->getValue("partid") : $CurrentForm->getValue("x_partid");
		if (!$this->partid->IsDetailKey)
			$this->partid->setFormValue($val);
		if (!$this->isOverwrite())
			$this->HashValue = $CurrentForm->getValue("k_hash");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->partid->CurrentValue = $this->partid->FormValue;
		$this->partno->CurrentValue = $this->partno->FormValue;
		$this->manufacturer->CurrentValue = $this->manufacturer->FormValue;
		$this->tittle->CurrentValue = $this->tittle->FormValue;
		$this->cddissue->CurrentValue = $this->cddissue->FormValue;
		$this->cddissue->CurrentValue = UnFormatDateTime($this->cddissue->CurrentValue, 5);
		$this->cddno->CurrentValue = $this->cddno->FormValue;
		$this->thirdPartyNo->CurrentValue = $this->thirdPartyNo->FormValue;
		$this->duration->CurrentValue = $this->duration->FormValue;
		$this->expirydt->CurrentValue = $this->expirydt->FormValue;
		$this->expirydt->CurrentValue = UnFormatDateTime($this->expirydt->CurrentValue, 5);
		$this->highlighted->CurrentValue = $this->highlighted->FormValue;
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
		$row = [];
		$row['partid'] = NULL;
		$row['partno'] = NULL;
		$row['dataSheetFile'] = NULL;
		$row['manufacturer'] = NULL;
		$row['tittle'] = NULL;
		$row['cddissue'] = NULL;
		$row['cddno'] = NULL;
		$row['cddFile'] = NULL;
		$row['thirdPartyNo'] = NULL;
		$row['thirdPartyFile'] = NULL;
		$row['cover'] = NULL;
		$row['duration'] = NULL;
		$row['expirydt'] = NULL;
		$row['highlighted'] = NULL;
		$row['coo'] = NULL;
		$row['hssCode'] = NULL;
		$row['systrade'] = NULL;
		$row['isdatasheet'] = NULL;
		$row['cddrenewal_required'] = NULL;
		$row['datasheetdate'] = NULL;
		$row['username'] = NULL;
		$row['nativeFiles'] = NULL;
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// partid
		// partno
		// dataSheetFile
		// manufacturer
		// tittle
		// cddissue
		// cddno
		// cddFile
		// thirdPartyNo
		// thirdPartyFile
		// cover
		// duration
		// expirydt
		// highlighted
		// coo
		// hssCode
		// systrade
		// isdatasheet
		// cddrenewal_required
		// datasheetdate
		// username
		// nativeFiles

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

			// cddrenewal_required
			$this->cddrenewal_required->LinkCustomAttributes = "";
			$this->cddrenewal_required->HrefValue = "";
			$this->cddrenewal_required->TooltipValue = "";

			// nativeFiles
			$this->nativeFiles->LinkCustomAttributes = "";
			$this->nativeFiles->HrefValue = "";
			$this->nativeFiles->TooltipValue = "";
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
					$this->dataSheetFile->Upload->FileName = $this->dataSheetFile->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->dataSheetFile);

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
					$this->cddFile->Upload->FileName = $this->cddFile->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->cddFile);

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
					$this->thirdPartyFile->Upload->FileName = $this->thirdPartyFile->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->thirdPartyFile);

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
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->cover);

			// duration
			$this->duration->EditAttrs["class"] = "form-control";
			$this->duration->EditCustomAttributes = "";
			$this->duration->EditValue = $this->duration->options(TRUE);

			// expirydt
			$this->expirydt->EditAttrs["class"] = "form-control";
			$this->expirydt->EditCustomAttributes = "";
			$this->expirydt->EditValue = HtmlEncode(FormatDateTime($this->expirydt->CurrentValue, 5));
			$this->expirydt->PlaceHolder = RemoveHtml($this->expirydt->caption());

			// highlighted
			$this->highlighted->EditCustomAttributes = 30;
			$this->highlighted->EditValue = $this->highlighted->options(FALSE);

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

			// duration
			$this->duration->LinkCustomAttributes = "";
			$this->duration->HrefValue = "";

			// expirydt
			$this->expirydt->LinkCustomAttributes = "";
			$this->expirydt->HrefValue = "";

			// highlighted
			$this->highlighted->LinkCustomAttributes = "";
			$this->highlighted->HrefValue = "";

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
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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

			// duration
			$this->duration->setDbValueDef($rsnew, $this->duration->CurrentValue, NULL, $this->duration->ReadOnly);

			// expirydt
			$this->expirydt->setDbValueDef($rsnew, UnFormatDateTime($this->expirydt->CurrentValue, 5), NULL, $this->expirydt->ReadOnly);

			// highlighted
			$this->highlighted->setDbValueDef($rsnew, ((strval($this->highlighted->CurrentValue) == "1") ? "1" : "0"), NULL, $this->highlighted->ReadOnly);

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
		$hash .= GetFieldHash($rs->fields('duration')); // duration
		$hash .= GetFieldHash($rs->fields('expirydt')); // expirydt
		$hash .= GetFieldHash($rs->fields('highlighted')); // highlighted
		$hash .= GetFieldHash($rs->fields('coo')); // coo
		$hash .= GetFieldHash($rs->fields('hssCode')); // hssCode
		$hash .= GetFieldHash($rs->fields('systrade')); // systrade
		$hash .= GetFieldHash($rs->fields('isdatasheet')); // isdatasheet
		$hash .= GetFieldHash($rs->fields('cddrenewal_required')); // cddrenewal_required
		$hash .= GetFieldHash($rs->fields('nativeFiles')); // nativeFiles
		return md5($hash);
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("datasheetslist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Set up multi pages
	protected function setupMultiPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add(0);
		$pages->add(1);
		$pages->add(2);
		$this->MultiPages = $pages;
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