
<?php
$id = 'sidebar-form-internal' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>

                <div class="widget top-space">
                    <div class="sidebar-form-internal animate-children">
                        <h4> <?php the_field( 'sidebar_form_heading' ); ?></h4>
                            <p><?php the_field( 'sidebar_form_text' ); ?></p>
                        <div>
                            <?php the_field( 'sidebar_form_area' ); ?>
                        </div>
                   </div>
                </div>
                    