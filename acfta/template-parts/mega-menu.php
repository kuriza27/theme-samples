<div class="row bg-dark text-light " id="acfta-mega-menu-row">
	<div class="col-auto">
		<div class="collapse navbar-collapse" id="acfta-mega-menu">
		<div class="position-relative d-flex align-items-right">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><span class="icon-cancel"></span></span>
                            </button>
        </div>
			<?php if( have_rows("menu_sections", "options") ): ?>
			<div class="row animate-childrenX">
				<?php while( have_rows("menu_sections", "options") ): the_row(); ?>
					<div class="col-lg-3 mb-5">
					<?php $title = get_sub_field( 'title' ); ?>
					<?php if ( $title ) : ?>
						<a href="<?php echo esc_url( $title['url'] ); ?>" target="<?php echo esc_attr( $title['target'] ); ?>">
							<h4 class="text-uppercase"><?php echo esc_html( $title['title'] ); ?></h4>
						</a>
					<?php endif; ?>
						<?php if( have_rows("links") ): ?>
							<ul class="menu animate-children">
								<?php while( have_rows("links") ): the_row(); ?>
									<?php 
										$link = get_sub_field('link');
										$have_sub_cls = have_rows('sub_links') ? 'have-submenu' : '';
									?>
									<li class="menu-item <?php echo $have_sub_cls ?>">			
										<?php if( is_array($link) ): ?>							
										<a class="menu-link" href="<?php echo $link['url'] ?>"><?php echo $link['title'] ?></a>
										<?php endif; ?>
										<?php if( have_rows('sub_links') ): ?>
										<span class="icon-plus-light submenu-icon"></span>
										<ul class="sub-menu hidden">
											<?php while( have_rows("sub_links") ): the_row(); ?>
												<li class="sub-menu-item">
													<?php $sublink = get_sub_field('sub_link'); ?>
													<?php if( is_array($sublink) ): ?>
													<a href="<?php echo $sublink['url'] ?>"><?php echo $sublink['title'] ?></a>
													<?php endif; ?>
												</li>
											<?php endwhile; ?>
										</ul>
										<?php endif; ?>
									</li>
								<?php endwhile; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<style type="text/css">
	#acfta-mega-menu section {
		min-height: 400px;
		padding: 16px;
	}

	#acfta-mega-menu ul {
		list-style: none;
	}
	#acfta-mega-menu ul.menu {
		padding-left: 5px;
	}
	#acfta-mega-menu .menu-item a.menu-link.have-submenu::after{
		content:  " +";
	}
</style>
<script type="text/javascript">
	(function($){
		let mm_wrapper = $("#acfta-mega-menu");

		$(".icon-menu").on("click", function(){
			$( mm_wrapper ).parents('#acfta-mega-menu-row').css('opacity', 0);
			$( mm_wrapper ).toggleClass("show");
			$( mm_wrapper ).find('.complete').removeClass('complete');

			$( mm_wrapper ).parents('#acfta-mega-menu-row').animate({opacity: 1}, 300);

			$(mm_wrapper).find('.animate-childrenX, .animate-children').each(function () {
				$(this).children().each(function (i) {
					$(this).delay(500).addClass("complete");				
				});
			});
		});
	})(jQuery);
</script>