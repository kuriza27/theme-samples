<?php
$id = 'no-search-found-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>

<main class="no-result-main secondary-bg <?php echo esc_attr( $block['className'] ); ?>" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="no-search-result text-center animate-children">
            <h1 class="title-80"><?php the_field('title');?></h1>
            <p><?php the_field('content_text');?></p>            

            <form action="/"  method="get" class="nsr-form">
                <label class="position-relative w-100">
                    <input class="search-input" type="text" name="s" value="<?php echo (!empty($_GET['search']))?$_GET['search']:""; ?>" placeholder="Search">
                    <button class="search-btn"  type="submit"><span class="icon-search"></span></button>
                </label>
                <?php 
                    $btn = get_field('button');
                ?>
                <a href="<?php echo $btn['url'];?>" class="btn btn-primary"><?php echo $btn['title'];?></a>
            </form>
        </div>
    </div>
</main>