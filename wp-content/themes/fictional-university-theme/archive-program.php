<?php
get_header();
//arşiv event post type için

pageBanner(array(
    'title' => 'All Programs',
    'subtitle' => 'There is something for everyone',
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
        <ul class="link-list min-list">
        <?php
        while(have_posts()) {
            the_post(); ?>

            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>




        <?php }

        echo paginate_links(); //pagination oluştrr

        ?>
        </ul>

    </div>

<?php
get_footer();

?>