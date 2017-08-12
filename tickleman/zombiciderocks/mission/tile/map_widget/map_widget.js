$(document).ready(function()
{
	$('.mission.edit.window').build(function()
	{
		var draggable;
		var droppable;
		var right_click;

		//------------------------------------------------------------------------------------------------------ map growth
		/**
		 * Called to automatically grow the map table : adds columns and lines if a tile was dropped into .more cells
		 * Called before the image is added into $tile
		 *
		 * @param $tile jquery A jquery object matching a <td> element representing a tile into the map
		 */
		var grow = function($tile)
		{
			if ($tile.is('.more')) {
				growBottom($tile);
				growLeft  ($tile);
				growRight ($tile);
				growTop   ($tile);
			}
		};

		//------------------------------------------------------------------------------------------------------ growBottom
		/**
		 * @param $tile jquery A jquery object matching a <td> element representing a tile into the map
		 * @see grow
		 */
		var growBottom = function($tile)
		{
			if ($tile.is('.bottom')) {
				var $bottom     = $tile.closest('table').find('tr.more.bottom');
				var $new_bottom = $bottom.clone();
				$bottom.removeClass('more bottom').find('td').html('&nbsp;').removeClass('bottom').each(function() {
					var $bottom = $(this);
					if (!$bottom.is('.left') && !$bottom.is('.right')) {
						$bottom.removeClass('more');
					}
				});
				$bottom.after($new_bottom);
				$new_bottom.find('td').droppable(droppable)
			}
		};

		//-------------------------------------------------------------------------------------------------------- growLeft
		/**
		 * @param $tile jquery A jquery object matching a <td> element representing a tile into the map
		 * @see grow
		 */
		var growLeft = function($tile)
		{
			if ($tile.is('.left')) {
				var $left = $tile.closest('table').find('td.more.left');
				$left.each(function() {
					var $left     = $(this);
					var $new_left = $left.clone();
					$left.removeClass('left');
					if (!$left.is('.bottom') && !$left.is('.top')) {
						$left.removeClass('more');
					}
					$left.before($new_left);
					$new_left.droppable(droppable);
				}).html('&nbsp;')
			}
		};

		//------------------------------------------------------------------------------------------------------- growRight
		/**
		 * @param $tile jquery A jquery object matching a <td> element representing a tile into the map
		 * @see grow
		 */
		var growRight = function($tile)
		{
			if ($tile.is('.right')) {
				var $right = $tile.closest('table').find('td.more.right');
				$right.each(function() {
					var $right     = $(this);
					var $new_right = $right.clone();
					$right.removeClass('right');
					if (!$right.is('.bottom') && !$right.is('.top')) {
						$right.removeClass('more');
					}
					$right.after($new_right);
					$new_right.droppable(droppable);
				}).html('&nbsp;');
			}
		};

		//--------------------------------------------------------------------------------------------------------- growTop
		/**
		 * @param $tile jquery A jquery object matching a <td> element representing a tile into the map
		 * @see grow
		 */
		var growTop = function($tile)
		{
			if ($tile.is('.top')) {
				var $top     = $tile.closest('table').find('tr.more.top');
				var $new_top = $top.clone();
				$top.removeClass('more top').find('td').html('&nbsp;').removeClass('top').each(function() {
					var $top = $(this);
					if (!$top.is('.left') && !$top.is('.right')) {
						$top.removeClass('more');
					}
				});
				$top.before($new_top);
				$new_top.find('td').droppable(droppable);
			}
		};

		//-------------------------------------------------------------------------------------------- map tile right click
		/**
		 * Right click on a tile of the map executes a anti-clockwise 90° rotation
		 *
		 * @param event
		 */
		$('.multiple.tiles .map img').contextmenu(right_click = function(event)
		{
			var $img    = $(this);
			var convert = { 0: 'north', 90: 'west', 180: 'south', 270: 'east' };
			var rotate  = parseInt($img.attr('src').rParse('?rotate='));
			rotate      = ((isNaN(rotate) ? 0 : rotate) + 90) % 360;
			$img.attr('src', $img.attr('src').lParse('?rotate=') + '?rotate=' + rotate);
			$img.attr('data-rotate', convert[rotate]).data('rotate', convert[rotate]);
			event.preventDefault();
		});

		//---------------------------------------------------------------------------------------- draggable material tiles
		/**
		 * Tiles on the map and the material tiles list are draggable : works at an image level
		 */
		$('.material img, .multiple.tiles .map img').draggable(draggable = {
			revert: true,
			revertDuration: 0,
			zIndex: 1,

			start: function()
			{
				$(this).prop('id', 'mission-dragged-tile');
				$('.material').css('overflow', 'inherit');
			},

			stop: function()
			{
				$(this).prop('id', '');
				$('.material').css('overflow', 'scroll');
			}
		});

		//--------------------------------------------------------------------------------------------- droppable map tiles
		/**
		 * Map tiles are droppable : works at a table-cell level : for already-tiled cells, and ready-for-new-tile cells
		 */
		$('.multiple.tiles .map td').droppable(droppable = {
			accept: '#mission-dragged-tile',

			drop: function(event, ui)
			{
				var $dragged = ui.draggable;
				var $tile    = $(this);
				var code     = $dragged.attr('src').lParse(DOT).rLastParse(SL).toLowerCase();
				var src      = $dragged.attr('src').lParse('?');
				grow($tile);
				$tile
					.html('<img data-code="' + code + '" src="' + src + '">')
					.find('img').contextmenu(right_click).draggable(draggable);
			}
		});

	});
});
