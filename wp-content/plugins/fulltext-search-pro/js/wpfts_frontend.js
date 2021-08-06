;
jQuery(document).ready(function()
{
	// Add autocompleting to WPFTS Custom Search widgets
	jQuery('.search-form.wpfts_autocomplete').each(function(v)
	{
		var inp = jQuery('input[name="s"]', v);
		var widget_code = jQuery('input[name="wpfts_wdgt"]', v).val();

		jQuery(inp).autocomplete({
			source: function(request, response)
			{
				jQuery.ajax({
					method: 'post',
					url: document.wpfts_ajaxurl,
					dataType: "json",
					data: {
						action: 'wpfts_autocomplete',
						wpfts_wdgt: widget_code,
						sq: request.term
					},
					success: function(data) {
						response(data);
					}
				});
			},
			minLength: 1,
			delay: 300,
			select: function( event, ui ) {
				if ('link' in ui.item) {
					document.location.href = ui.item.link;
				}
			}
		}).autocomplete( "instance" )._renderItem = function(ul, item)
		{
			var str = '<li><a>' + item.label + '</a></li>';
			return jQuery(str).appendTo(ul);
		};

		/*
		jQuery(inp).on('keydown', function(e)
		{
			if (e.keyCode === 13) {
				e.preventDefault();
				document.location.href = '/advanced-search?sq=' + encodeURIComponent(jQuery('#quick_search_query').val());
			}
		});
		
		jQuery('#submit_search_button').on('click', function(){
			document.location.href = '/advanced-search?sq=' + encodeURIComponent(jQuery('#quick_search_query').val());
		});
		*/

	
	});

});