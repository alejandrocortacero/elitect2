"use strict";

(function($){
	function sportFieldChanged()
	{
		var s = $('select[name="sport"]');
		var o = $('input[name="other_sport"]');

		if( s.val() == 'other' )
			o.closest('.form-group').show();
		else
			o.closest('.form-group').hide();

	}

	function injuredFieldChanged()
	{
		var s = $('input[name="injured"][value="yes"]');
		var o = $('input[name="injuries"]');

		if( s.is(':checked') )
			o.closest('.form-group').show();
		else
			o.closest('.form-group').hide();

	}

	function illnessFieldChanged()
	{
		var s = $('input[name="illness"][value="yes"]');
		var o = $('input[name="illness_list"]');

		if( s.is(':checked') )
			o.closest('.form-group').show();
		else
			o.closest('.form-group').hide();

	}

	function medicationFieldChanged()
	{
		var s = $('input[name="medication"][value="yes"]');
		var o = $('input[name="medication_list"]');

		if( s.is(':checked') )
			o.closest('.form-group').show();
		else
			o.closest('.form-group').hide();

	}

	function suplementUseFieldChanged()
	{
		var u = $('input[name="suplements_use"]:checked');
		var s = $('select[name="suplements"]');
		var o = $('input[name="other_suplement"]');

		if( s.val() == 'other' )
		{
			o.closest('.form-group').show();
		}
		else
		{
			o.closest('.form-group').hide();
		}

		if( u.val() == 'yes' )
		{
			s.closest('.form-group').show();
			if( s.val() == 'other' )
			{
				o.closest('.form-group').show();
			}
			else
			{
				o.closest('.form-group').hide();
			}
		}
		else
		{
			s.closest('.form-group').hide();
			o.closest('.form-group').hide();
		}
	}

	$(document).ready(function(){
		$('select[name="sport"]').change(sportFieldChanged);

		$('input[name="injured"]').change(injuredFieldChanged);
		$('input[name="illness"]').change(illnessFieldChanged);
		$('input[name="medication"]').change(medicationFieldChanged);

		$('input[name="suplements_use"]').change(suplementUseFieldChanged);
		$('select[name="suplements"]').change(suplementUseFieldChanged);
			
		sportFieldChanged();
		injuredFieldChanged();
		illnessFieldChanged();
		medicationFieldChanged();
		suplementUseFieldChanged();
	});
})(jQuery);
