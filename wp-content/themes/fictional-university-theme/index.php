<?php
get_header();

pageBanner(array(
    'title' => 'Blog',
    'subtitle' => 'Welcome to our Blog'
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
           while(have_posts()) {
               the_post();
               // the_post(); count++ gibi düsünülebilir
               ?>

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