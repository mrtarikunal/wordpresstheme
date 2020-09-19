<?php

get_header();
//header alan fonk
pageBanner();
while(have_posts()) {
    the_post(); ?>

   <!-- <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php // echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"> <?php // the_title(); ?> </h1>

        </div>
    </div>-->

    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); //verilen post type ın arşiv sayfasının url gtrr ?>"><i class="fa fa-home" aria-hidden="true"></i> Event Home </a> <span class="metabox__main"><?php the_title(); //the_title mevcut sayfanın title getrr ?></span></p>
        </div>

        <div class="generic-content">
            <?php the_content(); ?>

        </div>
        <?php
        $relatedPrograms = get_field('related_programs');
        //acf plugini ile olştrdğmz field çektik. yani ilişkili olduğu programı


        if($relatedPrograms) {
            echo '<hr class="section-break">';
            echo '<h2 class="headline headline--medium"> Related Programs</h2>';
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