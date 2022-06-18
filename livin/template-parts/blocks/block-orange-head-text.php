<?php
    global $post;

    $id = 'orange_head_text' . $block['id'];
    if ( ! empty($block['anchor'] ) ) {
        $id = $block['anchor'];
    }
    $paddB  = "padding-bottom:".get_field('padding_bottom')."px;";
    $paddT  = "padding-top:".get_field('padding_top')."px;";
?>
<section  id="<?php echo esc_attr( $id ); ?>" style="<?php echo $paddB.' '.$paddT;?>" class="contact-section secondary-bg section-padding text-white <?php echo esc_attr( $block['className'] ); ?>">
    <div class="container">
        <div class="row justify-content-center animate-children">
            <div class="col-lg-10">
                <hgroup class="text-lg-center">
                    <h3 class="h3 mb-5"><span class="title-selected text-uppercase"><?php the_field('top_text');?></span></h3>                   
                    <h1 class="alt mb-3"><?php the_field( 'title' ); ?></h1>
                </hgroup>
                <?php if(!empty(get_field('sub_text'))):?>
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-6">
                            <p><?php the_field('sub_text');?> </p>
                        </div>
                    </div>
                <?php endif;?>                
            </div>
        </div>
    </div>
</section>