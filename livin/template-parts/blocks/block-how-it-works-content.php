
<?php
$id = 'how-it-works-content-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
$id = $block['anchor'];
}
?>
<section class="working-ruls-section position-relative <?php echo esc_attr( $block['className'] ); ?>" id="<?php echo esc_attr( $id ); ?>">
    <div class="anchor">
        <a href="#<?php echo esc_attr( $id ); ?>"></a>
    </div>
    <header>
        <div class="container animate-children">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="text-uppercase"><?php the_field( 'heading' ); ?></h3>
                    <p><?php the_field( 'text' ); ?></p>
                    <div class="d-flex justify-content-center button-group">                        
                        <?php $logo_image = get_field( 'logo_image' ); ?>                        
                        <?php if ( $logo_image ) : ?>
                        <a href="<?php echo get_home_url(); ?>">
                            <img height="60" src="<?php echo esc_url( $logo_image['url'] ); ?>" alt="<?php echo esc_attr( $logo_image['alt'] ); ?>" />                            
                        </a>
                        <?php endif; ?>

                        <?php 
                        $button = array();
                        $button['url'] = get_field( 'button_url' );
                        $button['target'] = '';
                        $button['title'] = get_field( 'button_label' );
                        ?>
                        <?php 
                        if(!$button['url']){
                            echo "<div class='no-link btn btn-secondary psuedo-before unstyled'>".$button['title']."</div>";
                        }else{
                            echo custom_button_styling(get_field( 'button_styling' ), 'btn-'. get_field_object( 'url' )['key'], $button, get_field( 'enable_custom_button_styling' ), 'btn-secondary psuedo-before', esc_attr( $id ), ''); 
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <ul class="list-unstyled ruls-list d-flex flex-wrap flex-lg-nowrap animate-children">
    <?php if ( have_rows( 'how_it_works' ) ) : ?>
        <?php while ( have_rows( 'how_it_works' ) ) : the_row(); ?>
            <?php if ( have_rows( 'content' ) ) : ?>
                <?php while ( have_rows( 'content' ) ) : the_row(); ?>
                    <li class="d-flex">
                        <div>
                            <strong><?php the_sub_field( 'heading_title' ); ?></strong>
                            <?php the_sub_field( 'content' ); ?>
                        </div>
                    </li> 
                <?php endwhile; ?>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
    </ul>
</section>