<div id="search-wrapper" class="modal search-wrapper" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="d-flex w-100 align-items-center justify-content-between">
                    <div class="col-8 col-md-5">
                        <a class="logo w-100 d-lg-none" href="<?php echo site_url(); ?>">
                            <?php $logo = get_field( 'logo_white', 'option' ); ?>
                            <?php $logo_size = 'full'; ?>
                            <?php echo wp_get_attachment_image( $logo, $logo_size ); ?>
                        </a>
                    </div>
                    <div class="col-4 d-flex px-2 align-items-center justify-content-end">
                        <button type="button" aria-label="Close" data-dismiss="modal" class="btn-reset close m-0 color-white"><span class="icon-cancel"></span></button>
                    </div>
                </div>
			</div>
			<div class="modal-body">
				<form action="<?php echo site_url(); ?>" class="form-alt search-form">
					<div class="form-group pr-3">
						<div class="search-popup-wrap align-items-center d-flex">
							<input type="search" class="s" name="s" placeholder="Search" value="" aria-label="Search Field">
							<input type="submit" value="" aria-label="Search Button">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	(function($){
		$('.header-search .icon-search').on("click", function(){
			$('#search-wrapper').show();
			$(document.body).trigger("_acfta_modal_backdrop", ['show']);
			$('.search-popup-wrap').find('.s').focus();
		});

		$("#search-wrapper button.close").on("click", function(){
			$("#search-wrapper").hide();
			$(document.body).trigger("_acfta_modal_backdrop", ['hide']);
		});
	})(jQuery);
</script>

