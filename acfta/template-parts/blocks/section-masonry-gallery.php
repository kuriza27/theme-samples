<?php
/**
 * Block template file: C:\wamp64\www\NODA\acftawp/wp-content/themes/acfta/template-parts/blocks/section-masonry-gallery.php
 *
 * Masonry Gallery Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'masonry-gallery-section-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-masonry-gallery-section';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="gallery-section <?php echo esc_attr( $classes ); ?>">
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h2><?php the_field( 'heading' ); ?></h2>
            </div>
        </div>
    </div>
    <div class="grid">
        <?php $images_ids = array_slice( get_field( 'images' ), 0, 12 ); ?>
        <?php $size = '452X458'; $i = 1;?>
        <?php if ( $images_ids ) :  ?>
            <?php foreach ( $images_ids as $images_id ): ?>
                <?php if ( get_field( 'enable_5_columns' ) == 1 ) : ?>
                    <a class="facilitator-box" onclick="openModal();currentSlide(<?php echo $i; ?>)" class="hover-shadow">
                        <div class="grid-item grid-col-5 masonry-img-gallery">
                            <?php echo wp_get_attachment_image( $images_id, $size ); ?>
                        </div>
                    </a>
                <?php else : ?>
                    <a class="facilitator-box" onclick="openModal();currentSlide(<?php echo $i; ?>)" class="hover-shadow">
                        <div class="grid-item masonry-img-gallery">
                            <?php echo wp_get_attachment_image( $images_id, $size ); ?>
                        </div>
                    </a>
                <?php endif; ?>
            <?php $i++; endforeach; ?>
        <?php endif; ?>
        <!-- The Modal/Lightbox -->
        <div id="masonryModal" class="modal2">
            <span class="close cursor" onclick="closeModal()">&times;</span>
            <div class="modal-content2">
            <?php $images_ids_slides = get_field( 'images' ); ?>
            <?php if ( $images_ids_slides ) :  ?>
            <?php foreach ( $images_ids_slides as $images_id ): ?>
                <div class="masonrySlides">
                    <?php echo wp_get_attachment_image( $images_id, $size ); ?>
                </div>
            <?php $i++; endforeach; ?>
            <?php endif; ?>

                <!-- Next/previous controls -->
                <a class="prevGal" onclick="plusSlides(-1)">&#10094;</a>
                <a class="nextGal" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>
    </div>
    <?php if( count( get_field( 'images' ) ) > 12 ): ?>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <button class="btn btn-black gallery-loadmore-btn" data-gallery="loadGallery" data-offset="12" data-ids="<?php echo implode(',', get_field( 'images' )); ?>" data-elem="<?php echo esc_attr( $id ); ?>" data-ajax="<?php echo admin_url( 'admin-ajax.php' ); ?>">Load more &nbsp;<span class="icon-plus-light"></span></button>
            </div>
        </div>
    </div>
    <?php endif; ?>
 </section>
 <style>

 </style>
 <script>
// Open the Modal
function openModal() {
  document.getElementById("masonryModal").style.display = "block";
}

// Close the Modal
function closeModal() {
  document.getElementById("masonryModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("masonrySlides");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
}
</script>