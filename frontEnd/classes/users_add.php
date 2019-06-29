<?php
namespace PHPMaker2019\SUBMITTAL;

/**
 * Page class
 */
class users_add extends users
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{vishal-sub}";

	// Table name
	public $TableName = 'users';

	// Page object name
	public $PageObjName = "users_add";

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

		// Table object (users)
		if (!isset($GLOBALS["users"]) || get_class($GLOBALS["users"]) == PROJECT_NAMESPACE . "users") {
			$GLOBALS["users"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["users"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'users');

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
		global $EXPORT, $users;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($users);
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
					if ($pageName == "usersview.php")
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
			$key .= @$ar['seqid'];
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
			$this->seqid->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("userslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
				if (strval($Security->currentUserID()) == "") {
					$this->setFailureMessage(DeniedMessage()); // Set no permission
					$this->terminate(GetUrl("userslist.php"));
					return;
				}
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->seqid->Visible = FALSE;
		$this->userName->setVisibility();
		$this->userLoginId->setVisibility();
		$this->uEmail->setVisibility();
		$this->uLevel->setVisibility();
		$this->uPassword->setVisibility();
		$this->uProfile->setVisibility();
		$this->uReportsTo->setVisibility();
		$this->uActivated->setVisibility();
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
		$this->setupLookupOptions($this->uLevel);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("seqid") !== NULL) {
				$this->seqid->setQueryStringValue(Get("seqid"));
				$this->setKey("seqid", $this->seqid->CurrentValue); // Set up key
			} else {
				$this->setKey("seqid", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("userslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "userslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "usersview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->seqid->CurrentValue = NULL;
		$this->seqid->OldValue = $this->seqid->CurrentValue;
		$this->userName->CurrentValue = NULL;
		$this->userName->OldValue = $this->userName->CurrentValue;
		$this->userLoginId->CurrentValue = NULL;
		$this->userLoginId->OldValue = $this->userLoginId->CurrentValue;
		$this->uEmail->CurrentValue = NULL;
		$this->uEmail->OldValue = $this->uEmail->CurrentValue;
		$this->uLevel->CurrentValue = -2;
		$this->uPassword->CurrentValue = NULL;
		$this->uPassword->OldValue = $this->uPassword->CurrentValue;
		$this->uProfile->CurrentValue = NULL;
		$this->uProfile->OldValue = $this->uProfile->CurrentValue;
		$this->uReportsTo->CurrentValue = 1;
		$this->uActivated->CurrentValue = false;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'userName' first before field var 'x_userName'
		$val = $CurrentForm->hasValue("userName") ? $CurrentForm->getValue("userName") : $CurrentForm->getValue("x_userName");
		if (!$this->userName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->userName->Visible = FALSE; // Disable update for API request
			else
				$this->userName->setFormValue($val);
		}

		// Check field name 'userLoginId' first before field var 'x_userLoginId'
		$val = $CurrentForm->hasValue("userLoginId") ? $CurrentForm->getValue("userLoginId") : $CurrentForm->getValue("x_userLoginId");
		if (!$this->userLoginId->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->userLoginId->Visible = FALSE; // Disable update for API request
			else
				$this->userLoginId->setFormValue($val);
		}

		// Check field name 'uEmail' first before field var 'x_uEmail'
		$val = $CurrentForm->hasValue("uEmail") ? $CurrentForm->getValue("uEmail") : $CurrentForm->getValue("x_uEmail");
		if (!$this->uEmail->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->uEmail->Visible = FALSE; // Disable update for API request
			else
				$this->uEmail->setFormValue($val);
		}

		// Check field name 'uLevel' first before field var 'x_uLevel'
		$val = $CurrentForm->hasValue("uLevel") ? $CurrentForm->getValue("uLevel") : $CurrentForm->getValue("x_uLevel");
		if (!$this->uLevel->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->uLevel->Visible = FALSE; // Disable update for API request
			else
				$this->uLevel->setFormValue($val);
		}

		// Check field name 'uPassword' first before field var 'x_uPassword'
		$val = $CurrentForm->hasValue("uPassword") ? $CurrentForm->getValue("uPassword") : $CurrentForm->getValue("x_uPassword");
		if (!$this->uPassword->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->uPassword->Visible = FALSE; // Disable update for API request
			else
				$this->uPassword->setFormValue($val);
		}

		// Check field name 'uProfile' first before field var 'x_uProfile'
		$val = $CurrentForm->hasValue("uProfile") ? $CurrentForm->getValue("uProfile") : $CurrentForm->getValue("x_uProfile");
		if (!$this->uProfile->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->uProfile->Visible = FALSE; // Disable update for API request
			else
				$this->uProfile->setFormValue($val);
		}

		// Check field name 'uReportsTo' first before field var 'x_uReportsTo'
		$val = $CurrentForm->hasValue("uReportsTo") ? $CurrentForm->getValue("uReportsTo") : $CurrentForm->getValue("x_uReportsTo");
		if (!$this->uReportsTo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->uReportsTo->Visible = FALSE; // Disable update for API request
			else
				$this->uReportsTo->setFormValue($val);
		}

		// Check field name 'uActivated' first before field var 'x_uActivated'
		$val = $CurrentForm->hasValue("uActivated") ? $CurrentForm->getValue("uActivated") : $CurrentForm->getValue("x_uActivated");
		if (!$this->uActivated->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->uActivated->Visible = FALSE; // Disable update for API request
			else
				$this->uActivated->setFormValue($val);
		}

		// Check field name 'seqid' first before field var 'x_seqid'
		$val = $CurrentForm->hasValue("seqid") ? $CurrentForm->getValue("seqid") : $CurrentForm->getValue("x_seqid");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->userName->CurrentValue = $this->userName->FormValue;
		$this->userLoginId->CurrentValue = $this->userLoginId->FormValue;
		$this->uEmail->CurrentValue = $this->uEmail->FormValue;
		$this->uLevel->CurrentValue = $this->uLevel->FormValue;
		$this->uPassword->CurrentValue = $this->uPassword->FormValue;
		$this->uProfile->CurrentValue = $this->uProfile->FormValue;
		$this->uReportsTo->CurrentValue = $this->uReportsTo->FormValue;
		$this->uActivated->CurrentValue = $this->uActivated->FormValue;
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
			$rs->close();
		}

		// Check if valid User ID
		if ($res) {
			$res = $this->showOptionLink('add');
			if (!$res) {
				$userIdMsg = DeniedMessage();
				$this->setFailureMessage($userIdMsg);
			}
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
		$this->seqid->setDbValue($row['seqid']);
		$this->userName->setDbValue($row['userName']);
		$this->userLoginId->setDbValue($row['userLoginId']);
		$this->uEmail->setDbValue($row['uEmail']);
		$this->uLevel->setDbValue($row['uLevel']);
		$this->uPassword->setDbValue($row['uPassword']);
		$this->uProfile->setDbValue($row['uProfile']);
		$this->uReportsTo->setDbValue($row['uReportsTo']);
		$this->uActivated->setDbValue((ConvertToBool($row['uActivated']) ? "1" : "0"));
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['seqid'] = $this->seqid->CurrentValue;
		$row['userName'] = $this->userName->CurrentValue;
		$row['userLoginId'] = $this->userLoginId->CurrentValue;
		$row['uEmail'] = $this->uEmail->CurrentValue;
		$row['uLevel'] = $this->uLevel->CurrentValue;
		$row['uPassword'] = $this->uPassword->CurrentValue;
		$row['uProfile'] = $this->uProfile->CurrentValue;
		$row['uReportsTo'] = $this->uReportsTo->CurrentValue;
		$row['uActivated'] = $this->uActivated->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("seqid")) <> "")
			$this->seqid->CurrentValue = $this->getKey("seqid"); // seqid
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
		// seqid
		// userName
		// userLoginId
		// uEmail
		// uLevel
		// uPassword
		// uProfile
		// uReportsTo
		// uActivated

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
			$this->uPassword->ViewValue = $Language->phrase("PasswordMask");
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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// userName
			$this->userName->EditAttrs["class"] = "form-control";
			$this->userName->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->userName->CurrentValue = HtmlDecode($this->userName->CurrentValue);
			$this->userName->EditValue = HtmlEncode($this->userName->CurrentValue);
			$this->userName->PlaceHolder = RemoveHtml($this->userName->caption());

			// userLoginId
			$this->userLoginId->EditAttrs["class"] = "form-control";
			$this->userLoginId->EditCustomAttributes = "";
			if (!$Security->isAdmin() && $Security->isLoggedIn() && !$this->userIDAllow("add")) { // Non system admin
			} else {
			if (REMOVE_XSS)
				$this->userLoginId->CurrentValue = HtmlDecode($this->userLoginId->CurrentValue);
			$this->userLoginId->EditValue = HtmlEncode($this->userLoginId->CurrentValue);
			$this->userLoginId->PlaceHolder = RemoveHtml($this->userLoginId->caption());
			}

			// uEmail
			$this->uEmail->EditAttrs["class"] = "form-control";
			$this->uEmail->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->uEmail->CurrentValue = HtmlDecode($this->uEmail->CurrentValue);
			$this->uEmail->EditValue = HtmlEncode($this->uEmail->CurrentValue);
			$this->uEmail->PlaceHolder = RemoveHtml($this->uEmail->caption());

			// uLevel
			$this->uLevel->EditAttrs["class"] = "form-control";
			$this->uLevel->EditCustomAttributes = "";
			if (!$Security->canAdmin()) { // System admin
				$this->uLevel->EditValue = $Language->phrase("PasswordMask");
			} else {
			$curVal = trim(strval($this->uLevel->CurrentValue));
			if ($curVal <> "")
				$this->uLevel->ViewValue = $this->uLevel->lookupCacheOption($curVal);
			else
				$this->uLevel->ViewValue = $this->uLevel->Lookup !== NULL && is_array($this->uLevel->Lookup->Options) ? $curVal : NULL;
			if ($this->uLevel->ViewValue !== NULL) { // Load from cache
				$this->uLevel->EditValue = array_values($this->uLevel->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "\"userlevelid\"" . SearchString("=", $this->uLevel->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->uLevel->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->uLevel->EditValue = $arwrk;
			}
			}

			// uPassword
			$this->uPassword->EditAttrs["class"] = "form-control";
			$this->uPassword->EditCustomAttributes = "";
			$this->uPassword->EditValue = HtmlEncode($this->uPassword->CurrentValue);
			$this->uPassword->PlaceHolder = RemoveHtml($this->uPassword->caption());

			// uProfile
			$this->uProfile->EditAttrs["class"] = "form-control";
			$this->uProfile->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->uProfile->CurrentValue = HtmlDecode($this->uProfile->CurrentValue);
			$this->uProfile->EditValue = HtmlEncode($this->uProfile->CurrentValue);
			$this->uProfile->PlaceHolder = RemoveHtml($this->uProfile->caption());

			// uReportsTo
			$this->uReportsTo->EditAttrs["class"] = "form-control";
			$this->uReportsTo->EditCustomAttributes = "";
			if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin
			} else {
			if (REMOVE_XSS)
				$this->uReportsTo->CurrentValue = HtmlDecode($this->uReportsTo->CurrentValue);
			$this->uReportsTo->EditValue = HtmlEncode($this->uReportsTo->CurrentValue);
			$this->uReportsTo->PlaceHolder = RemoveHtml($this->uReportsTo->caption());
			}

			// uActivated
			$this->uActivated->EditCustomAttributes = "";
			$this->uActivated->EditValue = $this->uActivated->options(FALSE);

			// Add refer script
			// userName

			$this->userName->LinkCustomAttributes = "";
			$this->userName->HrefValue = "";

			// userLoginId
			$this->userLoginId->LinkCustomAttributes = "";
			$this->userLoginId->HrefValue = "";

			// uEmail
			$this->uEmail->LinkCustomAttributes = "";
			$this->uEmail->HrefValue = "";

			// uLevel
			$this->uLevel->LinkCustomAttributes = "";
			$this->uLevel->HrefValue = "";

			// uPassword
			$this->uPassword->LinkCustomAttributes = "";
			$this->uPassword->HrefValue = "";

			// uProfile
			$this->uProfile->LinkCustomAttributes = "";
			$this->uProfile->HrefValue = "";

			// uReportsTo
			$this->uReportsTo->LinkCustomAttributes = "";
			$this->uReportsTo->HrefValue = "";

			// uActivated
			$this->uActivated->LinkCustomAttributes = "";
			$this->uActivated->HrefValue = "";
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
		if ($this->seqid->Required) {
			if (!$this->seqid->IsDetailKey && $this->seqid->FormValue != NULL && $this->seqid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->seqid->caption(), $this->seqid->RequiredErrorMessage));
			}
		}
		if ($this->userName->Required) {
			if (!$this->userName->IsDetailKey && $this->userName->FormValue != NULL && $this->userName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->userName->caption(), $this->userName->RequiredErrorMessage));
			}
		}
		if ($this->userLoginId->Required) {
			if (!$this->userLoginId->IsDetailKey && $this->userLoginId->FormValue != NULL && $this->userLoginId->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->userLoginId->caption(), $this->userLoginId->RequiredErrorMessage));
			}
		}
		if ($this->uEmail->Required) {
			if (!$this->uEmail->IsDetailKey && $this->uEmail->FormValue != NULL && $this->uEmail->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->uEmail->caption(), $this->uEmail->RequiredErrorMessage));
			}
		}
		if ($this->uLevel->Required) {
			if (!$this->uLevel->IsDetailKey && $this->uLevel->FormValue != NULL && $this->uLevel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->uLevel->caption(), $this->uLevel->RequiredErrorMessage));
			}
		}
		if ($this->uPassword->Required) {
			if (!$this->uPassword->IsDetailKey && $this->uPassword->FormValue != NULL && $this->uPassword->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->uPassword->caption(), $this->uPassword->RequiredErrorMessage));
			}
		}
		if ($this->uProfile->Required) {
			if (!$this->uProfile->IsDetailKey && $this->uProfile->FormValue != NULL && $this->uProfile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->uProfile->caption(), $this->uProfile->RequiredErrorMessage));
			}
		}
		if ($this->uReportsTo->Required) {
			if (!$this->uReportsTo->IsDetailKey && $this->uReportsTo->FormValue != NULL && $this->uReportsTo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->uReportsTo->caption(), $this->uReportsTo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->uReportsTo->FormValue)) {
			AddMessage($FormError, $this->uReportsTo->errorMessage());
		}
		if ($this->uActivated->Required) {
			if ($this->uActivated->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->uActivated->caption(), $this->uActivated->RequiredErrorMessage));
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Check if valid User ID
		$validUser = FALSE;
		if ($Security->currentUserID() <> "" && !EmptyValue($this->userLoginId->CurrentValue) && !$Security->isAdmin()) { // Non system admin
			$validUser = $Security->isValidUserID($this->userLoginId->CurrentValue);
			if (!$validUser) {
				$userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
				$userIdMsg = str_replace("%u", $this->userLoginId->CurrentValue, $userIdMsg);
				$this->setFailureMessage($userIdMsg);
				return FALSE;
			}
		}

		// Check if valid Parent User ID
		$validParentUser = FALSE;
		if ($Security->currentUserID() <> "" && !EmptyValue($this->uReportsTo->CurrentValue) && !$Security->isAdmin()) { // Non system admin
			$validParentUser = $Security->isValidUserID($this->uReportsTo->CurrentValue);
			if (!$validParentUser) {
				$parentUserIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedParentUserID"));
				$parentUserIdMsg = str_replace("%p", $this->uReportsTo->CurrentValue, $parentUserIdMsg);
				$this->setFailureMessage($parentUserIdMsg);
				return FALSE;
			}
		}
		if ($this->userLoginId->CurrentValue <> "") { // Check field with unique index
			$filter = "(userLoginId = '" . AdjustSql($this->userLoginId->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->userLoginId->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->userLoginId->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		if ($this->uEmail->CurrentValue <> "") { // Check field with unique index
			$filter = "(uEmail = '" . AdjustSql($this->uEmail->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->uEmail->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->uEmail->CurrentValue, $idxErrMsg);
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

		// userName
		$this->userName->setDbValueDef($rsnew, $this->userName->CurrentValue, "", FALSE);

		// userLoginId
		$this->userLoginId->setDbValueDef($rsnew, $this->userLoginId->CurrentValue, "", FALSE);

		// uEmail
		$this->uEmail->setDbValueDef($rsnew, $this->uEmail->CurrentValue, "", FALSE);

		// uLevel
		if ($Security->canAdmin()) { // System admin
			$this->uLevel->setDbValueDef($rsnew, $this->uLevel->CurrentValue, NULL, strval($this->uLevel->CurrentValue) == "");
		}

		// uPassword
		$this->uPassword->setDbValueDef($rsnew, $this->uPassword->CurrentValue, "", FALSE);

		// uProfile
		$this->uProfile->setDbValueDef($rsnew, $this->uProfile->CurrentValue, NULL, FALSE);

		// uReportsTo
		$this->uReportsTo->setDbValueDef($rsnew, $this->uReportsTo->CurrentValue, NULL, strval($this->uReportsTo->CurrentValue) == "");

		// uActivated
		$tmpBool = $this->uActivated->CurrentValue;
		if ($tmpBool <> "1" && $tmpBool <> "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->uActivated->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->uActivated->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
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

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Show link optionally based on User ID
	protected function showOptionLink($id = "")
	{
		global $Security;
		if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id))
			return $Security->isValidUserID($this->userLoginId->CurrentValue);
		return TRUE;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("userslist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
						case "x_uLevel":
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