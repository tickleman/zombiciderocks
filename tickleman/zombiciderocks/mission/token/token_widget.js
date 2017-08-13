$(document).ready(function()
{
	$('.mission.edit.window').build(function ()
	{
		var draggable;
		var right_click;

		//-------------------------------------------------------------------------------------------------------- setValue
		var setValue = function()
		{
			var values = [];
			$('.multiple.tokens .tokens:not(.material) li').each(function() {
				var $li    = $(this);
				var $image = $li.find('img');
				values.push([
					$image.data('code'),
					parseInt($li.css('left')),
					parseInt($li.css('top')),
					$image.data('orientation')
				]);
			});
			$('input[name=tokens]').attr('value', JSON.stringify(values));
		};
		setValue();

		//------------------------------------------------------------------------------------------- map token right click
		/**
		 * Right click on a token of the map executes a anti-clockwise 90° rotation
		 *
		 * @param event
		 */
		this.inside('.multiple.tokens .tokens:not(.material) img').contextmenu(right_click = function(event)
		{
			var $img    = $(this);
			var convert = { 0: 'north', 90: 'west', 180: 'south', 270: 'east' };
			var rotate  = parseInt($img.attr('src').rParse('?rotate='));
			rotate      = ((isNaN(rotate) ? 0 : rotate) + 90) % 360;
			$img.attr('src', $img.attr('src').lParse('?rotate=') + '?rotate=' + rotate);
			$img.attr('data-orientation', convert[rotate]).data('orientation', convert[rotate]);
			setValue();
			event.preventDefault();
		});

		//--------------------------------------------------------------------------------------- draggable material tokens
		/**
		 * Tokens on the map and the material tokens list are draggable : works at an image level
		 */
		this.inside('.multiple.tokens img').draggable(draggable = {
			appendTo: this.inside('.map'),
			classes:  { 'ui-draggable-handle': 'token' },
			grid:     [5, 5],
			helper:   'clone',
			zIndex:   3
		});

		//-------------------------------------------------------------------------------------------- droppable map tokens
		/**
		 * Map tokens are droppable : works at a ul>li level
		 */
		this.inside('.map').droppable({
			accept:    'img.token',
			tolerance: 'fit',

			drop: function(event, ui)
			{
				var $draggable = ui.draggable;
				var $dragged   = ui.helper;
				var $tokens    = $('.multiple.tokens ul.tokens');

				var position = $dragged.position();
				var code     = $draggable.parent().data('code');
				var left     = Math.round(position.left);
				var src      = $dragged.attr('src').lParse('?');
				var top      = Math.round(position.top);

				var $li;
				// new
				if ($draggable.closest('.tokens.material').length) {
					$li = $(
						'<li>'
						+ '<img data-code="' + code + '" src="' + src + '" data-orientation="north">'
						+ '</li>'
					);
					$tokens.append($li);
					$li.find('img').contextmenu(right_click).draggable(draggable);
				}
				// move
				else {
					$li = $draggable.parent();
				}
				$li.css({ left: left + 'px', top: top + 'px' });

				setValue();
			}
		});

	});
});
