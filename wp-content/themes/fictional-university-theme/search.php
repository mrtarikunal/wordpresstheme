<?php
get_header();

//default search result sayfası template yi

pageBanner(array(
    'title' => 'Search Results',
    'subtitle' => 'You searched for &ldquo;'. esc_html(get_search_query(false))  .'&rdquo;'
    //'photo' => 'https://blog.prezi.com/wp-content/uploads/2019/03/jason-leung-479251-unsplash.jpg'
    //fonksiyon değişkenlerini array olarak yollurz
));
?>
    <!--<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php // echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
          <h1 class="page-banner__title">Blog</h1>
          <div class="page-banner__intro">
             <p>Welcome to our Blog</p>
          </div>
     </div>
</div>-->

    <div class="container container--narrow page-section">
        <?php

        if(have_posts()) {

            while(have_posts()) {
                the_post();
                // the_post(); count++ gibi düsünülebilir

                get_template_part('template-parts/content', get_post_type());
                //template-parts dosyası içinde content- diğer taraf dinamil olucak post type göre o file getrcek

                }

            echo paginate_links(); //pagination oluştrr

        } else {

            echo '<h2 class="headline headline--small-plus">No results match</h2>';
        }



        ?>

        <form class="search-form" method="get" action="<?php echo esc_url(site_url('/'));  ?>">
            <label class="headline headline--medium" for="s">Perform a new search:</label>
            <div class="search-form-row">
                <input placeholder="what are you looking for?" class="s" id="s" type="search" name="s">
                <input class="search-submit" type="submit" value="Search">
            </div>
        </form>

    </div>

<?php
get_footer();

?>