$('document').ready(function()
{
	window.zindex_counter = 0;

	$('body').build(function()
	{
		if (!this.length) return;

		this.xtarget({
			auto_empty:      {'#main': '#messages'},
			draggable_blank: '.window>h2',
			history:         { condition: 'h2:first-of-type', title: 'h2:first-of-type' },
			popup_element:   'section',
			success:         function() { $(this).autofocus(); },
			url_append:      'as_widget'
		});

		// messages is draggable and closable
		this.inside('#messages').draggable().click(function(event)
		{
			if ((event.offsetX > (this.clientWidth - 10)) && (event.offsetY < 10)) {
				$(this).empty();
			}
		});

		// tab controls
		this.inside('.tabber').tabber();

		// draggable objects brought to front on mousedown
		this.inside('.ui-draggable').mousedown(function()
		{
			$(this).css('z-index', ++window.zindex_counter);
		});

		// change all titles attributes to tooltips
		this.tooltip();

	}).autofocus();

});
