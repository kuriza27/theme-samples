
<?php
$id = 'home-banner-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="section-block home-section secondary-bg <?php echo esc_attr( $block['className'] ); ?>">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col text-center text-md-left animate-children">
                    <h1><?php the_field( 'heading' ); ?></h1>
                    <h3><?php the_field( 'subtext' ); ?></h3>
                </div>
            </div>
        </div>
    </div><!-- .header-content -->
</section>