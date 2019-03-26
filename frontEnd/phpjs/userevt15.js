// Field event handlers
(function($) {

	// Table 'datasheets' Field 'cddFile'
	$('[data-table=datasheets][data-field=x_cddFile]').on(
		{ // keys = event types, values = handler functions
			"change": function(e) {

				// Your code
				$(this).fields("cddno").value("");
		}
	);
})(jQuery);
