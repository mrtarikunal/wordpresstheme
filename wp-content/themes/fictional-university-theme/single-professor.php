<?php

get_header();
//header alan fonk

while(have_posts()) {
    the_post();
    pageBanner(array(
        //'title' => 'Hello Title',
        //'subtitle' => 'Subtitle',
        //'photo' => 'https://blog.prezi.com/wp-content/uploads/2019/03/jason-leung-479251-unsplash.jpg'
        //fonksiyon değişkenlerini array olarak yollurz
    ));
    //bannerı function.php içine aldık ve burda çağrdk
    ?>

    <!--<div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php //$pageBannerImage= get_field('page_banner_background_image'); echo $pageBannerImage['sizes']['pageBanner']
        //acf plugini ile olştrdğmz custom field olan background image çekyrz. array olarak dönyr. ordan function.php içinde oştrdğmz custom image size göre çektk. dönen arrayde neler var görmek için
        //print_r($pageBannerImage) yaparak arrayde gelen field ları göreblrz
        ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"> <?php //the_title(); ?> </h1>
            <div class="page-banner__intro">
            <p><?php //the_field('page_banner_subtitle');
            //acf plugini ile olştrdğmz custom subtitle çekyrz
            ?></p>
            </div>

        </div>
    </div>-->

    <div class="container container--narrow page-section">


        <div class="generic-content">
           <div class="row group">
               <div class="one-third">
                   <?php
                   the_post_thumbnail('professorPotrait');
                   //funcstions.php içinde olştrdğmz custom image size ın nick name verdik
                   ?>
               </div>
               <div class="two-thirds">
                   <?php
                     $likeCount = new WP_Query(array(
                         'post_type' => 'like',
                         'meta_query' => array(
                                 array(
                                     'key' => 'liked_proffessor_id',
                                     'compare' => '=',
                                     'value' => get_the_ID()
                                 )
                         )
                     ));

                     $existStatus = 'no';

                     if(is_user_logged_in()) {

                         $existQuery = new WP_Query(array(
                             'author' => get_current_user_id(),
                             'post_type' => 'like',
                             'meta_query' => array(
                                 array(
                                     'key' => 'liked_proffessor_id',
                                     'compare' => '=',
                                     'value' => get_the_ID()
                                 )
                             )
                         ));

                         if($existQuery->found_posts) {
                             //$existQuery->found_posts burda found_posts querydeki dönen post sayısını verr
                             $existStatus = 'yes';

                         }

                     }


                   ?>
                   <span class="like-box" data-like="<?php echo $existQuery->posts[0]->ID; ?>" data-proffessor="<?php the_ID(); ?>" data-exists="<?php echo $existStatus ?>">
                       <i class="fa fa-heart-o" aria-hidden="true"></i>
                       <i class="fa fa-heart" aria-hidden="true"></i>
                       <span class="like-count">
                           <?php echo $likeCount->found_posts; ?>
                       </span>

                   </span>
                   <?php
                   the_content(); ?>

               </div>
           </div>

        </div>
        <?php
        $relatedPrograms = get_field('related_programs');
        //acf plugini ile olştrdğmz field çektik. yani ilişkili olduğu programı


        if($relatedPrograms) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium"> Subject Taught</h2>';
            echo '<ul class="link-list min-list">';
            foreach ($relatedPrograms as $program) {?>
                <li><a href=" <?php echo  get_the_permalink($program); ?>"> <?php echo  get_the_title($program); ?></a></li>


            <?php }
        }
        echo '<ul>';

        ?>

    </div>

<?php }

get_footer();
//footer alan fonk

?>