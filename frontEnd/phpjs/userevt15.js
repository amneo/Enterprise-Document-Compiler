// Field event handlers
(function($) {

	// Table 'datasheets' Field 'cddFile'
	$('[data-table=datasheets][data-field=x_cddFile]').on(
		{ // keys = event types, values = handler functions
			"change": function(e) {

				// Your code
				var noval = "";
				var $row = $(this).fields();
				$row("cddno").value(noval);
		}
	);
})(jQuery);
