$('document').ready(function()
{
	window.zindex_counter = 0;

	// The framework module selector updates the current favorite for each opened article.
	$('#favorites > .current').data('setCurrent', function($article) {
		this.find('a').text($article.find('h2').first().text());
	});

	$('body').build('call', 'always', function()
	{
		if (!this.length) return;

		this.xtarget({
			auto_empty:      {'#main': '#messages'},
			draggable_blank: '.window>h2',
			history:         {
				condition: 'h2:first-of-type',
				title: 'h2:first-of-type',
				post: ['/email$'],
				without_get_vars: ['/list\\?', '/output\\?', '\\?save_name=']
			},
			popup_element:   'section',
			success:         function() { $(this).autofocus(); },
			url_append:      'as_widget'
		});

		// messages is draggable and closable
		this.find('#messages').draggable().click(function(event)
		{
			if ((event.offsetX > (this.clientWidth - 10)) && (event.offsetY < 10)) {
				$(this).empty();
			}
		});

		// tab controls
		this.find('.tabber').tabber();

		// draggable objects brought to front on mousedown
		this.find('.ui-draggable').mousedown(function()
		{
			$(this).css('z-index', ++window.zindex_counter);
		});

		// change all titles attributes to tooltips
		this.tooltip();

	}).autofocus();

});
