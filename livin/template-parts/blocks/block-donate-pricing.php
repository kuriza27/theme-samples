<?php
$id = 'target_donate-pricing-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$classes = 'donate-section-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
?>
<?php 
$styles = get_field( 'once_off_button_styling' );
$btn_color = ( $styles['text_color'] != '' ) ? 'color: '. $styles['text_color'] .' !important;' : '';
$btn_bg_color = ( $styles['background_color'] != '' ) ? 'background-color: '. $styles['background_color'] .' !important;' : '';
$btn_border_color = ( $styles['border_color'] != '' ) ? 'border-color: '. $styles['border_color'] .' !important;' : '';
$btn_hover_color = ( $styles['hover_text_color'] != '' ) ? 'color: '. $styles['hover_text_color'] .' !important;' : '';
$btn_hover_bg_color = ( $styles['hover_background_color'] != '' ) ? 'background-color: '. $styles['hover_background_color'] .' !important;' : '';
$btn_hover_border_color = ( $styles['hover_border_color'] != '' ) ? 'border-color: '. $styles['hover_border_color'] .' !important;' : '';
$btn_style = $btn_color . $btn_bg_color . $btn_border_color;
$btn_hover_style = $btn_hover_color . $btn_hover_bg_color . $btn_hover_border_color;
?>
<style type="text/css">#<?php echo esc_attr( $id ); ?> a[data-donate="once-off"]{<?php echo $btn_style; ?>}#<?php echo esc_attr( $id ); ?> a[data-donate="once-off"]:hover,#<?php echo esc_attr( $id ); ?> a[data-donate="once-off"].active{<?php echo $btn_hover_style; ?>}</style>

<?php 
$styles = get_field( 'repeat_button_styling' );
$btn_color = ( $styles['text_color'] != '' ) ? 'color: '. $styles['text_color'] .' !important;' : '';
$btn_bg_color = ( $styles['background_color'] != '' ) ? 'background-color: '. $styles['background_color'] .' !important;' : '';
$btn_border_color = ( $styles['border_color'] != '' ) ? 'border-color: '. $styles['border_color'] .' !important;' : '';
$btn_hover_color = ( $styles['hover_text_color'] != '' ) ? 'color: '. $styles['hover_text_color'] .' !important;' : '';
$btn_hover_bg_color = ( $styles['hover_background_color'] != '' ) ? 'background-color: '. $styles['hover_background_color'] .' !important;' : '';
$btn_hover_border_color = ( $styles['hover_border_color'] != '' ) ? 'border-color: '. $styles['hover_border_color'] .' !important;' : '';
$btn_style = $btn_color . $btn_bg_color . $btn_border_color;
$btn_hover_style = $btn_hover_color . $btn_hover_bg_color . $btn_hover_border_color;
?>
<style type="text/css">#<?php echo esc_attr( $id ); ?> a[data-donate="repeat"]{<?php echo $btn_style; ?>}#<?php echo esc_attr( $id ); ?> a[data-donate="repeat"]:hover,#<?php echo esc_attr( $id ); ?> a[data-donate="repeat"].active{<?php echo $btn_hover_style; ?>}</style>

<?php 
$styles = get_field( 'donate_button_styling' );
$btn_color = ( $styles['text_color'] != '' ) ? 'color: '. $styles['text_color'] .' !important;' : '';
$btn_bg_color = ( $styles['background_color'] != '' ) ? 'background-color: '. $styles['background_color'] .' !important;' : '';
$btn_border_color = ( $styles['border_color'] != '' ) ? 'border-color: '. $styles['border_color'] .' !important;' : '';
$btn_hover_color = ( $styles['hover_text_color'] != '' ) ? 'color: '. $styles['hover_text_color'] .' !important;' : '';
$btn_hover_bg_color = ( $styles['hover_background_color'] != '' ) ? 'background-color: '. $styles['hover_background_color'] .' !important;' : '';
$btn_hover_border_color = ( $styles['hover_border_color'] != '' ) ? 'border-color: '. $styles['hover_border_color'] .' !important;' : '';
$btn_style = $btn_color . $btn_bg_color . $btn_border_color;
$btn_hover_style = $btn_hover_color . $btn_hover_bg_color . $btn_hover_border_color;
?>
<style type="text/css">#<?php echo esc_attr( $id ); ?> a.pricing--donate-now-btn{<?php echo $btn_style; ?>}#<?php echo esc_attr( $id ); ?> a.pricing--donate-now-btn:hover,#<?php echo esc_attr( $id ); ?> a.pricing--donate-now-btn.active{<?php echo $btn_hover_style; ?>}</style>

<?php 
$styles = get_field( 'donate_amount_link_styling' );
$btn_color = ( $styles['text_color'] != '' ) ? 'color: '. $styles['text_color'] .' !important;' : '';
$btn_bg_color = ( $styles['background_color'] != '' ) ? 'background-color: '. $styles['background_color'] .' !important;' : '';
$btn_border_color = ( $styles['border_color'] != '' ) ? 'border-color: '. $styles['border_color'] .' !important;' : '';
$btn_hover_color = ( $styles['hover_text_color'] != '' ) ? 'color: '. $styles['hover_text_color'] .' !important;' : '';
$btn_hover_bg_color = ( $styles['hover_background_color'] != '' ) ? 'background-color: '. $styles['hover_background_color'] .' !important;' : '';
$btn_hover_border_color = ( $styles['hover_border_color'] != '' ) ? 'border-color: '. $styles['hover_border_color'] .' !important;' : '';
$btn_style = $btn_color . $btn_bg_color . $btn_border_color;
$btn_hover_style = $btn_hover_color . $btn_hover_bg_color . $btn_hover_border_color;
?>
<style type="text/css">#<?php echo esc_attr( $id ); ?> a.btn--donate-amount-link{<?php echo $btn_style; ?>}#<?php echo esc_attr( $id ); ?> a.btn--donate-amount-link:hover,#<?php echo esc_attr( $id ); ?> a.btn--donate-amount-link.active{<?php echo $btn_hover_style; ?>}</style>

<section id="<?php echo esc_attr( $id ); ?>" class="donate-section secondary-bg position-relative <?php echo esc_attr( $classes );?>">
    <div class="section-overlay-animation">
        <div class="text-row d-flex"><span><?php the_field( 'animated_text' ); ?></span><span><?php the_field( 'animated_text' ); ?></span><span><?php the_field( 'animated_text' ); ?></span><span><?php the_field( 'animated_text' ); ?></span>
        </div>
    </div>
    <div class="anchor">
        <a href="#target7"></a>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 animate-children">
                <header class="text-center text-white">
                    <h3 class="h3 mb-4"><span class="title-selected text-uppercase"><?php the_field( 'title' ); ?></span></h3>
                    <h2 class="mb-5"><?php the_field( 'heading' ); ?></h2>
                    <div class="row gutters-16 justify-content-center">
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <a href="#onceoff" class="btn btn-primary btn-block active" data-donate="once-off">Once off</a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <a href="#repeat" class="btn btn-primary btn-block" data-donate="repeat">Repeat</a>
                        </div>
                    </div>
                </header>
                <?php if ( have_rows( 'pricing' ) ) : ?>
                <div class="row no-gutters donate-boxes js-donate-boxes">
                    <?php $c=0; while ( have_rows( 'pricing' ) ) : the_row(); ?>
                    <div class="sl">
                        <div class="donate-box <?php if($c == 1): ?>active<?php endif; ?>">
                            <div class="once-off-content" data-opt="once-off">
                                <header>
                                    <h5 class=""><?php the_sub_field( 'plan_1' ); ?></h5>
                                    <h2 class="text-80"><?php the_sub_field( 'price_1' ); ?></h2>
                                    <h5 class="text-right">once off</h5>
                                </header>
                                <div class="donate-box-body">
                                    <?php the_sub_field( 'content_1' ); ?>
                                    <a class="btn btn-primary btn-block pricing--donate-now-btn" href="<?php the_sub_field( 'link_1' ); ?>">Donate now</a>
                                </div>
                            </div>
                            <div class="repeat-content d-none" data-opt="repeat">
                                <header>
                                    <h5 class=""><?php the_sub_field( 'plan_2' ); ?></h5>
                                    <h2 class="text-80"><?php the_sub_field( 'price_2' ); ?></h2>
                                    <h5 class="text-right">repeat</h5>
                                    <?php 
                                        $defaultLink = '';
                                        if ( have_rows( 'frequency' ) ) : ?>
                                        <select class="mt-2" name="frequency" data-frequency="select<?php echo $c; ?>">
                                        <?php $i=0; while ( have_rows( 'frequency' ) ) : the_row(); ?>
                                            <?php if($i==0){ $defaultLink = get_sub_field( 'link' ); } ?>
                                            <option value="<?php the_sub_field( 'link' ); ?>"><?php the_sub_field( 'title' ); ?></option>
                                        <?php $i++; endwhile; ?>
                                        </select>
                                    <?php endif; ?>
                                </header>
                                <div class="donate-box-body">
                                    <?php the_sub_field( 'content_2' ); ?>
                                    <a class="btn btn-primary btn-block pricing--donate-now-btn" href="<?php echo $defaultLink; ?>" data-donatebtn="select<?php echo $c; ?>">Donate now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $c++; endwhile; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php $amount_link = get_field( 'donate_amount_link' ); ?>
        <?php if( $amount_link ): ?>
        <div class="row justify-content-center pt-4 mt-5">
            <a href="<?php echo $amount_link['url']; ?>" target="<?php echo $amount_link['target']; ?>" class="btn btn-inline-block btn-primary btn--donate-amount-link"><?php echo $amount_link['title']; ?></a>
        </div>
        <?php endif; ?>
    </div>
</section>