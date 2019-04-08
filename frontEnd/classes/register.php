<?php
namespace PHPMaker2019\SUBMITTAL;

/**
 * Page class
 */
class register extends users
{

	// Page ID
	public $PageID = "register";

	// Project ID
	public $ProjectID = "vishal-sub";

	// Page object name
	public $PageObjName = "register";

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
		if (!isset($GLOBALS["users"]))
			$GLOBALS["users"] = new users();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'register');

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
	public $FormClassName = "ew-horizontal ew-form ew-register-form";

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$UserTableConn, $CurrentLanguage, $FormError, $Breadcrumb;

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
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action

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
		$this->FormClassName = "ew-form ew-register-form ew-horizontal";

		// Set up Breadcrumb
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb = new Breadcrumb();
		$Breadcrumb->add("register", "RegisterPage", $url, "", "", TRUE);
		$this->Heading = $Language->phrase("RegisterPage");
		$userExists = FALSE;
		$this->loadRowValues(); // Load default values
		if (Post("action") <> "") {

			// Get action
			$this->CurrentAction = Post("action");
			$this->loadFormValues(); // Get form values

			// Validate form
			if (!$this->validateForm()) {
				$this->CurrentAction = "show"; // Form error, reset action
				$this->setFailureMessage($FormError);
			}
		} else {
			$this->CurrentAction = "show"; // Display blank record
		}

		// Handle email activation
		if (Get("action") <> "") {
			$action = Get("action");
			$emailAddress = Get("email");
			$code = Get("token");
			@list($approvalCode, $usr, $pwd) = explode(",", $code, 3);
			$approvalCode = Decrypt($approvalCode);
			$usr = Decrypt($usr);
			$pwd = Decrypt($pwd);
			if ($emailAddress == $approvalCode) {
				if (SameText($action, "confirm")) { // Email activation
					if ($this->activateEmail($emailAddress)) { // Activate this email
						if ($this->getSuccessMessage() == "")
							$this->setSuccessMessage($Language->phrase("ActivateAccount")); // Set up message acount activated
						$this->terminate("login.php"); // Go to login page
					}
				}
			}
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("ActivateFailed")); // Set activate failed message
			$this->terminate("login.php"); // Go to login page
		}

		// Insert record
		if ($this->isInsert()) {

			// Check for duplicate User ID
			$filter = str_replace("%u", AdjustSql($this->userLoginId->CurrentValue, USER_TABLE_DBID), USER_NAME_FILTER);

			// Set up filter (WHERE Clause)
			$this->CurrentFilter = $filter;
			$userSql = $this->getCurrentSql();
			if ($rs = $UserTableConn->execute($userSql)) {
				if (!$rs->EOF) {
					$userExists = TRUE;
					$this->restoreFormValues(); // Restore form values
					$this->setFailureMessage($Language->phrase("UserExists")); // Set user exist message
				}
				$rs->Close();
			}
			if (!$userExists) {
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow()) { // Add record
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("RegisterSuccessActivate")); // Activate success
					$this->terminate("login.php"); // Return
				} else {
					$this->restoreFormValues(); // Restore form values
				}
			}
		}

		// Render row
		if ($this->isConfirm()) { // Confirm page
			$this->RowType = ROWTYPE_VIEW; // Render view
		} else {
			$this->RowType = ROWTYPE_ADD; // Render add
		}
		$this->resetAttributes();
		$this->renderRow();
	}

	// Activate account based on email
	protected function activateEmail($email)
	{
		global $UserTableConn, $Language;
		$filter = str_replace("%e", AdjustSql($email, USER_TABLE_DBID), USER_EMAIL_FILTER);
		$sql = $this->getSql($filter);
		$UserTableConn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $UserTableConn->execute($sql);
		$UserTableConn->raiseErrorFn = '';
		if (!$rs)
			return FALSE;
		if (!$rs->EOF) {
			$rsnew = $rs->fields;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
			$rsact = array('uActivated' => true); // Auto register
			$this->CurrentFilter = $filter;
			$res = $this->update($rsact);
			if ($res) { // Call User Activated event
				$rsnew['uActivated'] = true;
				$this->User_Activated($rsnew);
			}
			return $res;
		} else {
			$this->setFailureMessage($Language->phrase("NoRecord"));
			$rs->close();
			return FALSE;
		}
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

		// Check field name 'uPassword' first before field var 'x_uPassword'
		$val = $CurrentForm->hasValue("uPassword") ? $CurrentForm->getValue("uPassword") : $CurrentForm->getValue("x_uPassword");
		if (!$this->uPassword->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->uPassword->Visible = FALSE; // Disable update for API request
			else
				$this->uPassword->setFormValue($val);
		}
		$this->uPassword->ConfirmValue = $CurrentForm->getValue("c_uPassword");

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
		$this->uPassword->CurrentValue = $this->uPassword->FormValue;
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

			// uPassword
			$this->uPassword->LinkCustomAttributes = "";
			$this->uPassword->HrefValue = "";
			$this->uPassword->TooltipValue = "";
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
			if (REMOVE_XSS)
				$this->userLoginId->CurrentValue = HtmlDecode($this->userLoginId->CurrentValue);
			$this->userLoginId->EditValue = HtmlEncode($this->userLoginId->CurrentValue);
			$this->userLoginId->PlaceHolder = RemoveHtml($this->userLoginId->caption());

			// uEmail
			$this->uEmail->EditAttrs["class"] = "form-control";
			$this->uEmail->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->uEmail->CurrentValue = HtmlDecode($this->uEmail->CurrentValue);
			$this->uEmail->EditValue = HtmlEncode($this->uEmail->CurrentValue);
			$this->uEmail->PlaceHolder = RemoveHtml($this->uEmail->caption());

			// uPassword
			$this->uPassword->EditAttrs["class"] = "form-control";
			$this->uPassword->EditCustomAttributes = "";
			$this->uPassword->EditValue = HtmlEncode($this->uPassword->CurrentValue);
			$this->uPassword->PlaceHolder = RemoveHtml($this->uPassword->caption());

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

			// uPassword
			$this->uPassword->LinkCustomAttributes = "";
			$this->uPassword->HrefValue = "";
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
				AddMessage($FormError, $Language->phrase("EnterUserName"));
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
				AddMessage($FormError, $Language->phrase("EnterPassword"));
			}
		}
		if ($this->uPassword->ConfirmValue <> $this->uPassword->FormValue) {
			AddMessage($FormError, $Language->phrase("MismatchPassword"));
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

		// uPassword
		$this->uPassword->setDbValueDef($rsnew, $this->uPassword->CurrentValue, "", FALSE);

		// uReportsTo
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

			// Call User Registered event
			$this->User_Registered($rsnew);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
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
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

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

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// User Registered event
	function User_Registered(&$rs) {

		//echo "User_Registered";
	}

	// User Activated event
	function User_Activated(&$rs) {

		//echo "User_Activated";
	}
}
?>