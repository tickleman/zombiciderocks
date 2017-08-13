$(document).ready(function()
{
	$('.mission.edit.window').build(function ()
	{

		//-------------------------------------------------------------------------------------------------------- setValue
		var setValue = function()
		{
			var values = [];
			// todo get values
			$('input[name=tokens]').attr('value', JSON.stringify(values));
		};
		setValue();

	});
});
