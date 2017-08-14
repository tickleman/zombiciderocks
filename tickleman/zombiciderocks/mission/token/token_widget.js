$(document).ready(function()
{
	$('.mission.edit.window').build(function ()
	{
		var directional_keys;
		var disable_anchor;
		var draggable;
		var right_click;
		var shift_click;

		//-------------------------------------------------------------------------------------------------------- setValue
		var setValue = function()
		{
			var values = [];
			$('.mission.tokens li').each(function() {
				var $li    = $(this);
				var $image = $li.find('img');
				values.push([
					$image.data('code'),
					parseInt($li.css('left')) - 50,
					parseInt($li.css('top'))  - 50,
					$image.data('orientation')
				]);
			});
			$('input[name=tokens]').attr('value', JSON.stringify(values));
		};
		setValue();

		//------------------------------------------------------------------------------------------- map token shift click
		/**
		 * Shift-click a token to remove it from the map
		 */
		this.inside('.mission.tokens img').click(shift_click = function(event)
		{
			if (event.shiftKey) {
				$(this).closest('li').remove();
				setValue();
			}
		});

		//------------------------------------------------------------------------------------------- map token right click
		/**
		 * Right click on a token of the map executes a anti-clockwise 90° rotation
		 *
		 * @param event
		 */
		this.inside('.mission.tokens img').contextmenu(right_click = function(event)
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
		this.inside('.mission.tokens img, .tokens.material img').draggable(draggable = {
			appendTo: this.inside('.mission.tiles'),
			classes:  { 'ui-draggable-handle': 'token' },
			grid:     [5, 5],
			helper:   'clone',
			zIndex:   3
		});

		//--------------------------------------------------------------------------------------- map token disable anchors
		this.inside('.mission.tokens a').click(disable_anchor = function(event)
		{
			$(this).focus();
			event.preventDefault();
		});

		//-------------------------------------------------------------------------------------- map token directional keys
		this.inside('.mission.tokens a').keydown(directional_keys = function(event)
		{
			var $tile = $(this).closest('li');
			switch (event.keyCode) {
				case 37: $tile.css('left', (parseInt($tile.css('left')) - 1) + 'px'); break; // left
				case 38: $tile.css('top',  (parseInt($tile.css('top' )) - 1) + 'px'); break; // up
				case 39: $tile.css('left', (parseInt($tile.css('left')) + 1) + 'px'); break; // right
				case 40: $tile.css('top',  (parseInt($tile.css('top' )) + 1) + 'px'); break; // down
			}
			setValue();
			event.preventDefault();
		});

		//-------------------------------------------------------------------------------------------- droppable map tokens
		/**
		 * Map tokens are droppable : works at a ul>li level
		 */
		this.inside('.mission.tiles').droppable({
			accept:    'img.token',
			tolerance: 'fit',

			drop: function(event, ui)
			{
				var $draggable = ui.draggable;
				var $dragged   = ui.helper;
				var $tokens    = $('.mission.tokens');

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
						+ '<a><img data-code="' + code + '" src="' + src + '" data-orientation="north"></a>'
						+ '</li>'
					);
					$tokens.append($li);
					$li.find('img').click(shift_click).contextmenu(right_click).draggable(draggable);
					$li.find('a').click(disable_anchor).keydown(directional_keys);
				}
				// move
				else {
					$li = $draggable.closest('li');
				}
				$li.css({ left: left + 'px', top: top + 'px' });

				setValue();
			}
		});

	});
});
