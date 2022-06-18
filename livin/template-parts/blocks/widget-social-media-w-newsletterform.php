
<?php

global $post;
$id = 'contact_form' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

$groupS = get_field( 'social_media_group' );
$groupN = get_field( 'newsletter_group' );

?>
<section class="position-relative join-now-section bottom-join-now" id="<?php echo esc_attr( $id ); ?>">
    <div class="anchor">
        <a href="#<?php echo esc_attr( $id ); ?>"></a>
    </div>
    <div class="container">
        <div class="row no-gutters animate-children">
            <div class="col-lg-6">
                <div class="bc-socials-form">
                    <h4 class="mb-4 text-center text-sm-left"><?php echo $groupS['title']; ?></h4>
                    
                    <ul class="social social-circle list-unstyled d-flex justify-content-center justify-content-sm-start">
                        <?php if(!empty($groupS['social_media'])):?>
                                <?php foreach($groupS['social_media'] as $rs) : ?>
                                    <li><a href="<?php echo $rs['url']; ?>" target="_blank"><span class="icon-<?php echo $rs['icon']; ?>"></span></a></li>
                                <?php endforeach; ?>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 v-delim-l d-none d-lg-block">
                <div class="bc-socials-form footer-jm">
                    <h4><?php echo $groupN['title_news']; ?></h4>
                    <?php $form = $groupN['form']; ?>
                    <?php if ( $form ) : ?>
                        <?php $formID = $form['id']; ?>
                        <?php echo do_shortcode('[gravityform id="'.$formID.'" title="true" description="true" ajax="true"]'); ?>
                    <?php endif; ?>
                    <p class="d-none d-mobile-block"><?php  the_field( 'newsletter_text', 'option' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="position-relative join-now-section news-d-md" id="<?php echo esc_attr( $id ); ?> d-none d-mobile-block">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-6 v-delim-l">
                <div class="bc-socials-form">
                    <h4><?php echo $groupN['title_news']; ?></h4>
                    <?php $form = $groupN['form']; ?>
                    <?php if ( $form ) : ?>
                        <?php $formID = $form['id']; ?>
                        <?php echo do_shortcode('[gravityform id="'.$formID.'" title="true" description="true" ajax="true"]'); ?>
                    <?php endif; ?>
                    <p class="d-none d-mobile-block"><?php  the_field( 'newsletter_text', 'option' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>