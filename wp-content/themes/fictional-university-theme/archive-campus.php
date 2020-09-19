<?php
get_header();
//arşiv event post type için

pageBanner(array(
    'title' => 'Our Campuses',
    'subtitle' => 'We have seceral campuses',
    //'photo' => 'https://blog.prezi.com/wp-content/uploads/2019/03/jason-leung-479251-unsplash.jpg'
    //fonksiyon değişkenlerini array olarak yollurz
));
?>
    <!-- <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">

            <h1 class="page-banner__title"> All Programs</h1>

        </div>
    </div>-->

    <div class="container container--narrow page-section">
        <div class="acf-map">
            <?php
            while(have_posts()) {
                the_post();
                $mapLocation = get_field('map_location');
                //acf ile olştdğmz custum field çektik
                ?>

               <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng']?>">

                 <h3><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h3>
                   <?php echo $mapLocation['address']; ?>
               </div>




            <?php }?>
        </div>

    </div>

<?php
get_footer();

?>