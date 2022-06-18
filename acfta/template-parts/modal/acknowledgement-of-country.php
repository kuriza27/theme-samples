<div id="acknowlegement-of-country-wrapper" class="modal" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close ackn-close-btn" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><span class="icon-cancel"></span></span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo get_field( 'acknowledgement', 'options' ); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	(function($){
		
		var acknowledgement_cookie = getCookie("acknowledgement_of_country");

		if( "" == acknowledgement_cookie ){
			$("#acknowlegement-of-country-wrapper").show();
			$(document.body).trigger("_acfta_modal_backdrop", ['show']);
		} else {
			$('.acknowledgement--backdrop').fadeOut(500);
            $('.acknowledgement--backdrop').remove();
            $('body').removeClass('acknowledgement--loading');
		}

		$("#acknowlegement-of-country-wrapper button.close").on("click", function(){
			setCookie("acknowledgement_of_country", 1, 60);
			$("#acknowlegement-of-country-wrapper").hide(1, function(){
				$('.acknowledgement--backdrop').fadeOut(500, function(){
					$(this).remove();
					$('body').removeClass('acknowledgement--loading');
				});
			});	

			$(document.body).trigger("_acfta_modal_backdrop", ['hide']);
		});
	})(jQuery);
</script>