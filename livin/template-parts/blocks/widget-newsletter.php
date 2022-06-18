<div class="widget position-relative subscribe-block form-widget d-flex flex-column">
    <h4><?php the_field( 'title' ); ?></h4>
    <?php if ( get_field( 'enable_embedded_form' ) == 1 ) : ?>
        <div class="klaviyo-sidebar">
		    <?php the_field( 'embedded_form_code' ); ?>
        </div>
	<?php else : ?>
		<?php $form = get_field( 'form' ); ?>
        <?php if ( $form ) : ?>
            <?php $formID = $form['id']; ?>
            <?php echo do_shortcode('[gravityform id="'.$formID.'" title="true" description="true" ajax="true"]'); ?>
        <?php endif; ?>
	<?php endif; ?>
</div>