<?php

get_header();
//header alan fonk

pageBanner();
while(have_posts()) {
    the_post(); ?>

    <!--<div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php // echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"> <?php // the_title(); ?> </h1>

        </div>
    </div>-->

    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); //verilen post type ın arşiv sayfasının url gtrr ?>"><i class="fa fa-home" aria-hidden="true"></i> All Campuses </a> <span class="metabox__main"><?php the_title(); //the_title mevcut sayfanın title getrr ?></span></p>
        </div>

        <div class="generic-content">
            <?php the_content(); ?>

        </div>

        <div class="acf-map">

            <?php
            $mapLocation = get_field('map_location');
            //acf ile olştdğmz custum field çektik
            ?>
                <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng']?>">

                    <h3> <?php the_title(); ?> </h3>
                    <?php echo $mapLocation['address']; ?>
                </div>





        </div>

        <?php

        $relatedPrograms= new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'program',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'related_campus',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"'
                )
            )
        )); //custom query object oluşturacağız
        //posts_per_page kaç tane post çekeceğimizi söylyrz. -1 tüm postları çeker 'posts_per_page' => -1,
        //post_type query ne için yapacak post veya page olablr
        //'orderby' => 'post_date' default gelir ve post publish date dir. 'orderby' => 'rand' random seçer
        //'order' => 'DESC' default gelir.
        //'meta_key' => 'event_date', event postları event date göre sıralamak için neye göre sıralacağımız öncesi meta key tanımladık
        //'orderby' => 'meta_value', for words and letters
        //'meta_query' olştrdğmz custom field larla ilgili filtreleme yapmak için klnyrz. array içinde birden fazla array kullnlbr


        if($relatedPrograms->have_posts()) {

            echo '<hr class="section-break">';
            echo '<h2>Programs Available At This Campus</h2>';

            echo '<ul class="min-list link-list">';

            while($relatedPrograms->have_posts()) {
                $relatedPrograms->the_post();
                ?>

                <li>
                    <a href="<?php the_permalink(); ?>">

                            <?php the_title(); ?>

                    </a>

                </li>


            <?php }
            echo '</ul>';
        }

        wp_reset_postdata();
        //custom query resetler. bir sayfada birden fazla custom query kullanyrsak her quey bitiminde bunu yapmalyz




        ?>

    </div>

<?php }

get_footer();
//footer alan fonk

?>