jQuery(document).ready(function($){
	/*
		Multiselect initialization
	*/
	$('.ca_multi-select').multiselect({
		onChange: function(){
			calculate_total();
		}
	});

	$('#ca_num_of_heads').on('keyup',function(){
		calculate_total();
	});

	function calculate_total(){
		var post_ids = $('.ca_multi-select').val();
		if(null != post_ids){
			var data = {
				'action':'calculate_total',
				'post_ids': $('.ca_multi-select').val()
			};

			$.post(ajaxurl,data,function(response){
				var numHeads = $('#ca_num_of_heads').val();
				if(!isNaN(response) && !isNaN(numHeads)){
					var total = response * numHeads;
					$('#lbl-total').html(' Php '+total);
				}
			});
		}
	}


});