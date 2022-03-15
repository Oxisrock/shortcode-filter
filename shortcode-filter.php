<?php

/**
 * Plugin Name: Filter ajax product 
 * Plugin URI:
 * Description: Display filter in shortcode
 * Version: 0.1
 * Author: Francisco Aular
 * Author URI: https://github.com/Oxisrock
 */
function tbare_wordpress_plugin_demo($atts)
{
?>
  <style>
    .select2-container--default .select2-results__option[aria-disabled=true] {
      display: none;
    }

    span.select2-selection.select2-selection--single {
      font-size: 15px;
      font-weight: 600;
      border-left: 6px solid #ffba00;
    }
  </style>
  <?php $terms = get_terms('marca', array('hide_empty' => 0, 'parent' => 0)); ?>

  <!-- Slider main container -->
  <div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      <div class="swiper-slide">
        <div class="main-swiper_img">
          <?php
          $count_args = array(
            'post_type'             => 'slider',
            'post_status'           => 'publish',
            'numberposts' => 1,
          );
          $slider = get_posts($count_args);
          ?>
          <img id="myImage" src="<?= get_the_post_thumbnail_url($slider[0], 'full') ?>" class="img-fluid" alt="">

        </div>
        <div class="main-swiper__info">
          <div class="main-swiper__text">
            <!-- <h1>Encuentra las mejores partes 
            para tu vehículo </h1>
          <p>Tenemos marcas y referencias a medida, encuentra aquí las partes que estas buscando.
          </p>-->
            <a href="https://autoxpert.co/tienda" class="main-swiper__btnp">
              Visitar tienda
              <img src="https://autoxpert.co/wp-content/uploads/2021/09/arrow-right.png" alt="">
            </a>
          </div>
          <div class="main-swiper__form">


            <div class="hero-area-v2">
              <div class="single-hero">
                <div class="hero-filter">

                  <div class="main-banner__tabs">
                    <ul>
                      <li id="tab1" class="active">
                        <a class="main-swiper__permalink tab" data-toggle-target=".tab-content-1" href="#">
                          Buscar partes para mi auto
                          <img src="https://autoxpert.co/wp-content/uploads/2021/09/Vector-1.png" alt="">


                        </a>
                      </li>
                      <li id="tab2">
                        <a class="main-swiper__permalink tab" href="#" data-toggle-target=".tab-content-2">
                          Buscar llantas por medida
                          <img src="https://autoxpert.co/wp-content/uploads/2021/09/Vector-1.png" alt="">

                        </a>

                      </li>
                    </ul>
                  </div>
                  <div class=" tab-content tab-content-1 active">
                    <form id="form_auto_principal" action="https://autoxpert.co/" method="get">
                      <div class="row justify-content-between align-items-center">
                        <div class="col-lg-2 col-md-3">
                          <select id="js-marca" name="marca" class="form-select" aria-label="Default select example">
                            <option value="">Marca</option>
                            <?php foreach ($terms as $term) : ?>
                              <?php if ($term->count > 0) : ?>
                                <option data-id="<?= $term->term_id ?>" data-marca="<?= $term->term_id ?>" value="<?= $term->slug ?>"><?= $term->name ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-lg-2 col-md-3">
                          <?php $termchildren = get_terms('pa_modelo', array('hide_empty' => 0)); ?>
                          <select id="js-model" name="filter_modelo" class="form-select js-model" aria-label="Default select example" disabled>
                            <option value="">Modelo</option>
                          </select>
                        </div>
                        <div class="col-lg-2 col-md-3">
                          <select id="js-anno" name="klb_year" class="form-select" aria-label="Default select example" disabled>
                            <option value="">Línea</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2018">2020</option>
                          </select>
                        </div>
                        <div class="col-lg-2 col-md-3">
                          <select id="js-category" name="filter_cat" class="form-select" aria-label="Default select example">
                            <option value="">Categoría</option>
                            <?php $categories = get_terms('product_cat', array('hide_empty' => 0, 'parent' => 0));  ?>
                            <?php foreach ($categories as $items) : ?>
                              <?php if ($items->term_id != 15) : ?>
                                <option data-id="<?= $items->term_id ?>" value="<?= $items->term_id ?>"><?= $items->name ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-lg-3">
                          <button class="main-swiper__btn">
                            Buscar partes
                            <img src="https://autoxpert.co/wp-content/uploads/2021/09/arrow-right.png" alt="">
                          </button>
                          <input type="hidden" name="s" id="klb-search-query" value="" tabindex="0">
                          <input type="hidden" name="id_user" id="id_user" value="<?= get_current_user_id() ?>">
                          <input type="hidden" name="post_type" value="product" tabindex="0">
                        </div>
                      </div>
                    </form>

                  </div>



                  <div class="tab-content tab-content-2">
                    <?php $terms_atributes = get_terms('pa_ancho', array('hide_empty' => 0));  ?>
                    <form action="https://autoxpert.co/" method="get">
                      <div class="row justify-content-between align-items-center">
                        <div class="col-lg-3 col-md-4">
                          <select id="js-ancho" name="filter_ancho" class="form-select" aria-label="Default select example">
                            <option value="">Ancho</option>
                            <?php foreach ($terms_atributes as $term) : ?>
                              <?php if ($term->count > 0) : ?>
                                <option value="<?= $term->name ?>"><?= $term->name ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-lg-3 col-md-4">
                          <?php $terms_atributes = get_terms('pa_perfil', array('hide_empty' => 0));  ?>
                          <select id="js-perfil" name="filter_perfil" class="form-select" aria-label="Default select example">
                            <option value="">Perfil</option>
                            <?php foreach ($terms_atributes as $term) : ?>
                              <?php if ($term->count > 0) : ?>
                                <option value="<?= $term->name ?>"><?= $term->name ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-lg-3 col-md-4">
                          <select id="js-rin" name="filter_rin" class="form-select" aria-label="Default select example">
                            <option value="">Rin</option>
                            <?php $categories = get_terms('pa_rin', array('hide_empty' => 0));  ?>
                            <?php foreach ($categories as $items) : ?>
                              <?php if ($items->count > 0) : ?>
                                <option value="<?= $items->name ?>"><?= $items->name ?></option>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-lg-3">
                          <button class="main-swiper__btn">
                            Buscar llantas
                            <img src="https://autoxpert.co/wp-content/uploads/2021/09/arrow-right.png" alt="">
                          </button>
                          <input type="hidden" name="s" id="klb-search-query" value="" tabindex="0">
                          <input type="hidden" name="post_type" value="product" tabindex="0">
                        </div>
                      </div>
                    </form>

                  </div>


                </div>

              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>
  </div>






  <style>
    .tab-content {
      display: none;
    }

    .yith_magnifier_zoom_magnifier {
      z-index: 9000;
    }

    span.select2.select2-container {
      margin-bottom: 1rem;
    }

    .tab-content.active {
      display: block;
    }

    .nice-select {
      display: none !important;
    }

    .select2.select2-container {
      width: 100% !important;
    }

    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400&display=swap');

    body {
      margin: 0;
    }

    .swiper {
      width: 100%;
      height: 650px;

    }

    .main-swiper_img {
      position: relative;
      height: 520px;
    }


    .main-swiper_img img {
      height: 100%;
      width: 100%;
      object-fit: contain;
    }

    .wpfFilterTaxNameWrapper {
      text-transform: uppercase;
    }

    .main-swiper_img:before {
      position: absolute;
      content: '';

      inset: 0;
      z-index: 999;
    }

    .main-swiper__info {
      position: absolute;
      top: calc(62% - 25px);
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      z-index: 999;
    }

    .main-swiper__text {
      text-align: center;
      width: 38%;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .main-swiper__text h1 {
      font-family: 'Bebas Neue', cursive;
      font-style: normal;
      font-weight: normal;
      font-size: 65px;
      color: #fff;
      line-height: 69px;
      margin: 0;
    }

    .main-swiper__text p {
      font-family: 'Montserrat';
      font-style: normal;
      font-weight: 500;
      font-size: 18px;
      line-height: 21px;
      color: #fff;
    }


    .main-swiper__btn {
      width: 100%;
      text-align: center;
      border-radius: 15px;
      padding: 18px 30px;
      line-height: 29px;
      background: #FFBA00;
      box-shadow: 4px 3px 10px rgb(255 186 0 / 90%);
      border-radius: 8px;
    }

    .main-swiper__btn img {
      margin-left: 5px;
    }

    .main-swiper__btnp {
      background: #003d91;
      font-weight: 500;
      font-size: 15px;
      line-height: 20px;
      text-transform: capitalize;
      font-family: 'Montserrat';
      padding: 10px;
      border-radius: 20px;
      color: #fff;
    }


    .main-swiper__btnp img {
      margin-left: 5px;
    }

    .magnify {
      border-radius: 50%;
      border: 2px solid black;
      position: absolute;
      z-index: 20;
      background-repeat: no-repeat;
      background-color: white;
      box-shadow: inset 0 0 20px rgba(0, 0, 0, .5);
      display: none;
      cursor: none;
    }

    .main-swiper__form {
      background-color: transparent;
      margin-top: 40px;
      width: 70%;
      border-radius: 20px;
    }

    .main-swiper__form .main-swiper__permalink {
      font-family: 'Montserrat';
      font-style: normal;
      font-weight: 500;
      font-size: 14px;
      line-height: 17px;
      color: #fff;
      text-decoration: none;
      margin-top: 10px;
      background: #091C36;
      opacity: 1;
      border-radius: 0px 10px 0px 0px;
      padding: 10px 25px;
    }

    .main-swiper__form li.active .main-swiper__permalink {
      background: linear-gradient(83.52deg, #002B68 -48.38%, #003D91 182.4%);
      opacity: 1;
      border-radius: 10px 10px 0px 0px;
    }

    .swiper-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet,
    .swiper-pagination-horizontal.swiper-pagination-bullets .swiper-pagination-bullet {
      margin: 0 4px;
      background: #003d91;
      border-radius: 0;
    }

    .swiper-pagination-bullet {
      width: 15px;
      height: 15px;
    }

    .swiper-horizontal>.swiper-pagination-bullets,
    .swiper-pagination-bullets.swiper-pagination-horizontal,
    .swiper-pagination-custom,
    .swiper-pagination-fraction {
      bottom: 10px;
      left: 9%;
      width: unset;
    }

    .hero-area-v2 .single-hero,
    .hero-area-v2 .single-hero:after {
      padding: 0 !important;
      background-color: transparent !important;
    }

    span.select2-selection.select2-selection--single {
      background: #F7F7F7;
      height: 70px;
      border-radius: 8px;
      width: 100%;
    }

    .select2-container--default .select2-selection--single {
      border: 1px solid #F7F7F7;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 65px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 66px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {

      padding: 0 11px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
      right: 20px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
      display: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
      right: 20px;
      content: '';
      position: absolute;
      width: 10px;
      height: 10px;
      top: 45%;
      background-image: url(https://autoxpert.co/wp-content/uploads/2021/09/Vector.png);
      background-repeat: no-repeat;
    }

    .main-banner__tabs ul {
      display: flex;
    }

    .main-banner__tabs ul li:nth-child(2) {
      margin-left: -5px;
    }

    .main-banner__tabs ul li:nth-child(1) a {
      border-radius: 10px 10px 0px 0px;
    }


    .tab-content-1 .row div {
      padding: 5px !important;
    }

    .tab-content-2 .row div {
      padding: 5px 15px !important;
    }

    @media (min-width:0px) and (max-width:575px) {
      .main-swiper_img img {
        height: 200px;
        width: 100%;
        object-fit: fill;
        /* object-fit: cover; */
        object-position: center center;

      }

      .main-swiper_img {
        position: relative;
        height: 750px;
      }

      .swiper {

        height: 850px;
      }

      .main-swiper__form form select {
        margin-left: 20px !important;
        width: 44%;
        margin-bottom: 20px;
        margin-right: 0 !important;
        font-size: 14px;
      }

      .main-swiper__form form {
        margin-bottom: 25px;
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;

      }

      .main-swiper__text h1 {
        font-size: 30px;
        line-height: 32px;
      }

      .main-swiper__text {
        width: 90%;
      }

      .swiper-horizontal>.swiper-pagination-bullets,
      .swiper-pagination-bullets.swiper-pagination-horizontal,
      .swiper-pagination-custom,
      .swiper-pagination-fraction {
        bottom: -5px;
        left: 10%;
        width: unset;
      }

      .main-swiper__btnp {
        font-size: 12px;
      }

      .main-swiper__form .main-swiper__permalink {
        margin-left: 0px !important;
        font-size: 10px;
        padding: 10px 10px;
      }

      .main-swiper__form form button {
        padding: 10px 20px;
        font-size: 12px;
      }

      .main-swiper__info {
        top: calc(20% - 25px);
      }

      .main-swiper__form {
        width: 95% !important;
        margin-top: 20px;
      }

      span.select2-selection.select2-selection--single {
        height: 50px;
        margin-bottom: 10px;
      }

      .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 50px;
      }


      .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 50px;
      }

      .main-swiper__text p {
        margin-bottom: 1rem;
        margin-top: 1rem;
        font-size: 14px;
      }
    }

    @media (min-width:576px) and (max-width:767px) {
      .main-swiper_img img {
        height: 100%;
        width: 100%;
        object-fit: inherit;
      }

      .main-swiper_img {
        position: relative;
        height: 750px;
      }

      .swiper {
        width: 100%;
        height: 800px;
      }

      .main-swiper__form {
        width: 75%;
      }

      .main-swiper__form form select {
        width: 44%;
        margin-bottom: 20px;
        font-size: 14px;
        margin-right: 35px !important;
      }

      .main-swiper__form form select:nth-child(2),
      .main-swiper__form form select:nth-child(4) {
        margin-right: 0 !important;
      }

      .main-swiper__form form {
        margin-bottom: 25px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;

      }

      .main-swiper__text h1 {
        font-size: 40px;
        line-height: 32px;
      }

      .main-swiper__text {
        width: 90%;
      }

      .swiper-horizontal>.swiper-pagination-bullets,
      .swiper-pagination-bullets.swiper-pagination-horizontal,
      .swiper-pagination-custom,
      .swiper-pagination-fraction {
        bottom: -5px;
        left: 10%;
        width: unset;
      }

      .main-swiper__form .main-swiper__permalink {
        margin-left: 20px;
      }

      .main-swiper__form form button {
        padding: 10px 20px;
        font-size: 15px;
      }

      .main-swiper__info {
        top: calc(10% - 25px);
      }

      .main-swiper__form {
        width: 85%;
      }

      span.select2-selection.select2-selection--single {
        height: 60px;
        margin-bottom: 10px;
      }

      .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 65px;
      }

      .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 60px;
      }

      .main-swiper__text p {
        margin-bottom: 0rem;
        margin-top: 0rem;
      }

    }

    @media (min-width:768px) and (max-width:991px) {
      .main-swiper_img {
        position: relative;
        height: 550px;
      }

      .main-swiper_img img {
        height: 100%;
        width: 100%;
        object-fit: inherit;
      }

      .swiper {
        width: 100%;
        height: 600px;
      }

      .main-swiper__form form select {
        width: 110px;
      }

      .main-swiper__text {
        width: 90%;
      }

      .main-swiper__text p {
        margin-bottom: 0rem;
        margin-top: 0rem;
      }

      .main-swiper__text h1 {
        font-size: 50px;
        line-height: 50px;
      }

      .main-swiper__form {
        margin-top: 30px;
        width: 90%;
      }

      .main-swiper__form form select {
        font-size: 14px;
      }

      .main-swiper__form form button {
        font-size: 15px;
        padding: 15px 20px;
        margin-top: 10px;
      }

      .main-swiper__info {
        position: absolute;
        top: calc(50% - 25px);
      }
    }

    @media (min-width:992px) and (max-width:1199px) {
      .swiper {
        height: 600px;
      }

      .main-swiper_img {
        position: relative;
        height: 480px;
      }

      .main-swiper_img img {
        height: 100%;
        width: 100%;
        object-fit: inherit;
      }

      .main-swiper__form form select {
        width: 150px;
      }

      .main-swiper__text,
      .main-swiper__form {
        width: 95% !important;
      }

      .main-swiper__text h1 {
        font-size: 60px;
      }

      .main-swiper__form {
        margin-top: 30px;
      }
    }

    .hero-filter.tab-content form {
      margin-bottom: 18px;
    }



    .hero-area-v2 .single-hero .hero-filter {
      margin-bottom: 0px !important;
      padding: unset !important;
      margin-bottom: 40px !important;
      background: transparent !important;
      border-radius: unset !important;
    }

    .tab-content {
      padding: 25px;
      background: linear-gradient(259.67deg, #002C68 16.3%, #003D91 34.05%, #003D91 63.21%, #003D91 82.94%, #002C68 92.67%);
      border-radius: 0px 10px 10px 10px;
      margin-top: 3px;
    }
  </style>

  <script>
    const newSpan = document.createElement("span");
    newSpan.id = "tooltip"
    newSpan.textContent = "NEW";
    const list = document.querySelector(".menu-item-store");
    list.appendChild(newSpan);
    jQuery('#tab1').click(function() {
      jQuery('#tab2').removeClass('active');
      jQuery('#tab1').addClass('active');
    });
    jQuery('#tab2').click(function() {
      jQuery('#tab1').removeClass('active');
      jQuery('#tab2').addClass('active');
    });
  </script>

<?php

}

add_action('wp_footer', 'my_scripts_gf');
function my_scripts_gf()
{
?>

  <script>
    jQuery('.drop-menulink-toggle').click(function() {
      jQuery('.drop-submenu').toggleClass('active-menu')
    })
  </script>


<?php
}
add_shortcode('tbare-plugin-demo', 'tbare_wordpress_plugin_demo');


function buscador_en_select()
{
  wp_enqueue_style('estilos-select', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', array(), '1.0');
  wp_enqueue_script('jquery');
  wp_enqueue_script('script-select', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', array('jquery'), '1.0');
  wp_enqueue_script('mi-script', get_stylesheet_directory_uri() . '/assets/js/mi-script.js', array('script-select'), '1.0');
}
add_action('wp_enqueue_scripts', 'buscador_en_select');


function wl_post($slug)
{
  $childs = get_terms('marca', array('hide_empty' => false, 'parent' => $slug['slug']));
  $model = [];
  $model[] = ['id' => '', 'text' => 'Modelo'];
  foreach ($childs as $child_term) {
    // display name of all childs of the parent term
    $image = get_field('image_car', $child_term);
    $desde = get_field('desde', $child_term);
    $hasta = get_field('hasta', $child_term);
    if (!in_array(['id' => $child_term->name, 'text' => $child_term->name, 'image' => $image, 'slug' => $child_term->slug], $model)) {
      $model[] = ['id' => $child_term->name, 'text' => $child_term->name, 'image' => $image, 'desde' => $desde, 'hasta' => $hasta, 'slug' => $child_term->slug];
    }
  }

  return ['to' => $model, 'slug' => $slug['slug']];
}

function wl_categories($model)
{

  $products = new WP_Query(array(
    'post_type'      => array('product'),
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_query'     => array(),
    'tax_query'      => array(array(
      'taxonomy'        => 'marca',
      'field'           => 'slug',
      'terms'           =>  array($model['marca']),
      'operator'        => 'IN',
    ))
  ));
  $product_ids = [];
  // The Loop
  $product_ids[] = ['id' => '', 'text' => 'Categoria'];
  if ($products->have_posts()) : while ($products->have_posts()) :
      $products->the_post();
      $product = wc_get_product($products->post->ID);
      $terms = get_the_terms($products->post->ID, 'product_cat', array('parent' => 0, 'orderby' => 'slug', 'hide_empty' => false));
      /*if(!in_array([ 'id' => $product->get_attribute( 'pa_perfil' ), 'text' => $product->get_attribute( 'pa_perfil' )],$product_ids)) {
               $product_ids[] = [ 'id' => $product->get_attribute( 'pa_perfil' ), 'text' => $product->get_attribute( 'pa_perfil' )];
           }
           */
      foreach ($terms as $term) {
        if ($term->parent == 0 && !in_array(['id' => $term->term_id, 'text' => $term->name], $product_ids)) {
          $product_ids[] = ['id' => $term->term_id, 'text' => $term->name];
        }
      }
    endwhile;
    wp_reset_postdata();
  endif;

  return ['to' => $product_ids, 'slug' => $model['marca']];
}

function wl_post_marks($slug)
{
  $childs = get_terms('product_cat', array('hide_empty' => false, 'parent' => $slug['slug']));
  $model = [];

  $args = array(
    'taxonomy' => 'marca',
    'orderby' => 'count',
    'order' => 'DESC',
    'hide_empty' => false,
    'parent' => 0
  );
  $brands = get_terms($args);
  $model[] = ['id' => '', 'text' => 'Marca'];
  foreach ($brands as $brand) {
    $count_args = array(
      'post_type'             => 'product',
      'post_status'           => 'publish',
      'posts_per_page' => -1,
      'tax_query'             => array(
        array(
          'taxonomy'      => 'product_cat',
          'field'         => 'term_id',
          'terms'         => $slug['slug'],
          'operator'      => 'IN'
        ),
        array(
          'taxonomy'      => 'marca',
          'field'         => 'slug',
          'terms'         => $brand->slug,
          'operator'      => 'IN'
        )
      )
    );
    $count_products = new WP_Query($count_args);
    $model[] = ['id' => $brand->name, 'text' => $brand->name, 'attr1' => $brand->term_id];
  }

  return ['to' => $model, 'slug' => $slug['slug']];
}
/*
function wl_ancho( $slug ) {
 $ancho = get_terms('pa_ancho', array( 'hide_empty' => 0));
 $childs = get_terms( 'products-category', array( 'hide_empty' => false, 'parent' => 	 $slug['slug'] ) );
 foreach( $childs as $child_term ) {
    // display name of all childs of the parent term
    echo $child_term->name . '<br>';
    var_dump($child_term->name);
  }
 
}
*/
function wl_auto($ciudad)
{
  // If it's not a logged-in user viewing this, never mind
  $term = get_term_by('slug', $ciudad['slug'], 'ciudad_serviteca');

  $count_args = array(
    'post_type'             => 'serviteca',
    'post_status'           => 'publish',
    'posts_per_page' => -1,
    'tax_query'             => array(
      array(
        'taxonomy'      => 'ciudad_serviteca',
        'field'         => 'slug',
        'terms'         => $ciudad['slug'],
        'operator'      => 'IN'
      )
    )
  );
  $products = new WP_Query($count_args);

  $product_ids = [];
  $product_ids[] = ['id' => '', 'text' => 'Servitecas'];
  // The Loop
  if ($products->have_posts()) : while ($products->have_posts()) :
      $products->the_post();
      if (!in_array(['id' => $products->post->ID, 'text' => $products->post->post_title], $product_ids)) {
        $product_ids[] = ['id' => $products->post->ID, 'text' => $products->post->post_title];
      }
    endwhile;
    wp_reset_postdata();
  endif;


  /*
	$price_balanceo = get_field('balanceo', $term);
	
	$price_alineacion = get_field('alineacion', $term);
	
	$price_rotacion = get_field('rotacion', $term);
	
	return ['alineacion' => $price_alineacion, 'balanceo' => $price_balanceo,'rotacion' => $price_rotacion  ,'slug' => $ciudad['slug']];
	*/
  return $product_ids;
}

function wl_sliders()
{
  $count_args = array(
    'post_type'             => 'slider',
    'post_status'           => 'publish',
    'posts_per_page' => 5,
  );
  $sliders = new WP_Query($count_args);
  $carousel = [];
  // The Loop
  if ($sliders->have_posts()) : while ($sliders->have_posts()) :
      $sliders->the_post();
      $carousel[] = ['id' => $sliders->post->ID, 'text' => $sliders->post->post_title, 'image' => get_the_post_thumbnail_url($sliders->post->ID, 'full'), 'url_button' => get_field('url_boton', $sliders->post->ID), 'text_button' => get_field('titulo_boton', $sliders->post->ID)];
    endwhile;
    wp_reset_postdata();
  endif;

  return $carousel;
}


function wl_serviteca($serviteca)
{
  // If it's not a logged-in user viewing this, never mind
  $post = get_post($serviteca['id']);

  $type = $serviteca->get_param('type');

  $price_balanceo = ($type == 'Automovil') ? get_field('balanceo', $post) : get_field('balanceo_copiar', $post);

  $price_alineacion = get_field('alineacion', $post);

  $price_alineacion_senc = get_field('alineacion_sencilla', $post);

  $price_alineacion_dobl = get_field('alineacion_doble', $post);

  $price_rotacion = ($type == 'Automovil') ? get_field('rotacion', $post) : get_field('rotacion_copiar', $post);

  $montaje = ($type == 'Automovil') ? get_field('montaje', $post) : get_field('montaje_copiar', $post);

  return ['type' => $type, 'alineacion' => $price_alineacion, 'balanceo' => $price_balanceo, 'rotacion' => $price_rotacion, 'montaje' => $montaje, 'alineacion_sencilla' => $price_alineacion_senc, 'alineacion_doble' => $price_alineacion_dobl];
}

function wl_ancho($slug)
{
  // If it's not a logged-in user viewing this, never mind
  $term = get_term_by('slug', $slug['slug'], 'pa_ancho');
  $products = new WP_Query(array(
    'post_type'      => array('product'),
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_query'     => array(),
    'tax_query'      => array(array(
      'taxonomy'        => 'pa_ancho',
      'field'           => 'slug',
      'terms'           =>  array($slug['slug']),
      'operator'        => 'IN',
    ))
  ));
  $product_ids = [];
  // The Loop
  if ($products->have_posts()) : while ($products->have_posts()) :
      $products->the_post();
      $product = wc_get_product($products->post->ID);
      if (!in_array(['id' => $product->get_attribute('pa_perfil'), 'text' => $product->get_attribute('pa_perfil')], $product_ids)) {
        $product_ids[] = ['id' => $product->get_attribute('pa_perfil'), 'text' => $product->get_attribute('pa_perfil')];
      }
    endwhile;
    wp_reset_postdata();
  endif;

  return $product_ids;
}
function wl_rin($slug)
{
  // If it's not a logged-in user viewing this, never mind
  $term = get_term_by('slug', $slug['slug'], 'pa_perfil');
  $perfil = $slug->get_param('perfil');

  $products = new WP_Query(array(
    'post_type'      => array('product'),
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_query'     => array(),
    'tax_query'      => array(array(
      'taxonomy'        => 'pa_perfil',
      'field'           => 'slug',
      'terms'           =>  array($slug['slug']),
      'operator'        => 'IN',
    ), array(
      'taxonomy'        => 'pa_ancho',
      'field'           => 'slug',
      'terms'           =>  array($slug->get_param('ancho')),
      'operator'        => 'IN',
    ))
  ));
  $product_ids = [];
  // The Loop
  if ($products->have_posts()) : while ($products->have_posts()) :
      $products->the_post();
      $product = wc_get_product($products->post->ID);
      if (!in_array(['id' => $product->get_attribute('pa_rin'), 'text' => $product->get_attribute('pa_rin')], $product_ids)) {
        $product_ids[] = ['id' => $product->get_attribute('pa_rin'), 'text' => $product->get_attribute('pa_rin')];
      }
    endwhile;
    wp_reset_postdata();
  endif;

  return $product_ids;
}



add_action('rest_api_init', function () {

  register_rest_route('wl/v1', 'posts/(?P<slug>[a-zA-Z0-9-]+)', array(
    'methods' => 'GET',
    'callback' => 'wl_post',
  ));

  register_rest_route('wl/v1', 'posts-marks/(?P<slug>[a-zA-Z0-9-]+)', array(
    'methods' => 'GET',
    'callback' => 'wl_post_marks',
  ));

  register_rest_route('wl/v1', 'posts/(?P<ancho>[a-zA-Z0-9-]+)', array(
    'methods' => 'GET',
    'callback' => 'wl_post_marks',
  ));

  register_rest_route('wl/v1', 'categories/(?P<marca>[a-zA-Z0-9-]+)', array(
    'methods' => 'GET',
    'callback' => 'wl_categories',
  ));

  register_rest_route('wl/v1', 'ciudad/(?P<slug>[a-zA-Z0-9-]+)', array(
    'methods' => 'GET',
    'callback' => 'wl_auto',
  ));

  register_rest_route('wl/v1', 'ancho/(?P<slug>[a-zA-Z0-9-]+)', array(
    'methods' => 'GET',
    'callback' => 'wl_ancho',
  ));

  register_rest_route('wl/v1', 'rin/(?P<slug>[a-zA-Z0-9-]+)', array(
    'methods' => 'GET',
    'callback' => 'wl_rin',
  ));

  register_rest_route('wl/v1', 'serviteca/(?P<id>[a-zA-Z0-9-]+)', array(
    'methods' => 'GET',
    'callback' => 'wl_serviteca',
  ));

  register_rest_route('wl/v1', 'sliders', array(
    'methods' => 'GET',
    'callback' => 'wl_sliders',
  ));
});



// function that runs when shortcode is called
function yq_filter_product_shortcode()
{
?>


  <nav>
    <ul class="drop-menu">
      <li class="drop-menu-li">
        <div class="drop-menulink">

          <div style="display: flex; align-items: center;">
            <div style=" text-align: right; padding-right: 20px;padding-bottom: 1rem;">
              <p style="text-transform: uppercase; font-weight: 600; color: #000;  font-family: Montserrat; font-style: normal;">Mi auto</p>
              <p id="load_vehicle" style="color: #000; font-family: Montserrat; font-style: normal; font-weight: normal; line-height: 1; display:none;"> <span id="marca_auto">Alfa</span> <span id="modelo_auto">Romeo Giulia</span> <span id="anno_auto"> </span></p>
              <a id="change_vehicle" href="<?= (is_front_page()) ? 'javascript:void(0)' : '/'  ?>" style="color: #FFBA00; font-family: Montserrat; font-style: normal; font-weight: 600; display:none;">Cambiar autos</a>
              <a id="add_car" href="<?= (is_front_page()) ? 'javascript:void(0)' : '/'  ?>" style="color: #fff; font-family: Montserrat; font-style: normal; font-weight: 600;     background: #ffba00; padding: 5px 10px; border-radius: 22px;">Agregar</a>
            </div>
            <div style="width:85px;height:85px;">
              <a id="link_principal_auto" href="<?= (is_front_page()) ? 'javascript:void(0)' : '/'  ?>"><img id="image_auto" class="image_auto" style="width: 100%; height:100%; object-fit: contain; " src="/wp-content/uploads/2021/11/auto-miniatura-1-1.png" alt=""></a>
            </div>

          </div>
          <img class="drop-menulink-toggle" style="width:22px;    margin-left: 20px;" src="/wp-content/uploads/2021/12/Vector-8.png">
        </div>
        <div class="drop-submenu">
          <ul id="list">

          </ul>
          <div style="background: #EEEEEE;padding: 10px;display: flex;justify-content: center;">
            <a id="add_car" href="<?= (is_front_page()) ? 'javascript:void(0)' : '/'  ?>" style="color: #fff; font-family: Montserrat; font-style: normal; font-weight: 600;background: #ffba00; padding: 5px 10px; border-radius: 22px;">Añadir auto</a>
          </div>

        </div>
      </li>
    </ul>
  </nav>

<?php


}
// register shortcode
add_shortcode('product_filter_ajax_cache', 'yq_filter_product_shortcode');

/**
 * Rename WooCommerce MyAccount menu items
 */
add_filter( 'woocommerce_account_menu_items', 'rename_menu_items' );
function rename_menu_items( $items ) {
    $items['dashboard'] = 'Escritorio';
    $items['orders']       = 'Mis pedidos';
    $items['edit-account'] = 'Editar cuenta';

    return $items;
}

add_filter ( 'woocommerce_account_menu_items', 'misha_remove_my_account_links' );
function misha_remove_my_account_links( $menu_links ){
	
	//unset( $menu_links['edit-address'] ); // Addresses
	
	
	//unset( $menu_links['dashboard'] ); // Remove Dashboard
	//unset( $menu_links['payment-methods'] ); // Remove Payment Methods
	//unset( $menu_links['orders'] ); // Remove Orders
	unset( $menu_links['downloads'] ); // Disable Downloads
	//unset( $menu_links['edit-account'] ); // Remove Account details tab
	//unset( $menu_links['customer-logout'] ); // Remove Logout link
	
	return $menu_links;
	
}