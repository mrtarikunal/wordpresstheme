<?php
get_header();

pageBanner(array(
    'title' => get_the_archive_title(),
    'subtitle' => get_the_archive_description(),
    //'photo' => 'https://blog.prezi.com/wp-content/uploads/2019/03/jason-leung-479251-unsplash.jpg'
    //fonksiyon değişkenlerini array olarak yollurz
));
?>
   <!-- <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php // echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"> <?php /* if(is_category()) {
                single_cat_title();
                }
                //is_category() eğer herhangi bir kategori arşiv sayfasındaysa true döner değilse false
                //single_cat_title() kategori title ekrana basar



                if(is_author()) {
                   echo 'Posts by '; the_author();
                }
                //is_author() eğer herhangi bir yazar arşiv sayfasındaysa true döner değilse false
//the_author() yazarın adını ekrana basar
               */ ?> </h1> -->

            <!--<h1 class="page-banner__title"> <?php // the_archive_title(); ?></h1>
            <div class="page-banner__intro">
                <p><?php // the_archive_description(); ?></p>
            </div>
        </div>
    </div>-->

    <div class="container container--narrow page-section">
        <?php
        while(have_posts()) {
            the_post(); ?>

            <div class="post-item">
                <h2 class="headline headline--medium headline--post-title "><a href="<?php the_permalink(); ?>">  <?php the_title(); // postun title ni alır  ?> </a></h2>
                <div class="metabox">
                    <p>Posted by <?php the_author_posts_link(); // postun yazarının adını link ile beraber alır ?> on <?php the_time('n.j.y'); // postun yayınlandığı tarihi alır ?> in <?php echo get_the_category_list(', '); // postun kategorilerini alır, "," ve boşluk ile ayrr ?> </p>

                </div>

                <div class="generic-content">
                    <?php the_excerpt(); // postun exerpt ni alır ?>
                    <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Read More</a></p>

                </div>

            </div>


        <?php }

        echo paginate_links(); //pagination oluştrr

        ?>

    </div>

<?php
get_footer();

?>