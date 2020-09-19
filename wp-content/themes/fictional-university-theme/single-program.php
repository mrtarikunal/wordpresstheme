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
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); //verilen post type ın arşiv sayfasının url gtrr ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs </a> <span class="metabox__main"><?php the_title(); //the_title mevcut sayfanın title getrr ?></span></p>
        </div>

        <div class="generic-content">
            <?php the_field('main_body_content'); ?>

        </div>



        <?php

        $relatedProffesors= new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'professor',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'related_programs',
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


        if($relatedProffesors->have_posts()) {

            echo '<hr class="section-break">';
            echo '<h2>'. get_the_title() .' Professors</h2>';

            echo '<ul class="professor-cards">';

            while($relatedProffesors->have_posts()) {
                $relatedProffesors->the_post();
                ?>

                <li class="professor-card__list-item">
                    <a class="professor-card" href="<?php the_permalink(); ?>">
                        <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); //function.php içinde olştrdğmz custom image size nick name verdk?>">
                        <span class="professor-card__name">
                            <?php the_title(); ?>
                        </span>
                    </a>

                </li>


            <?php }
            echo '</ul>';
        }

        wp_reset_postdata();
        //custom query resetler. bir sayfada birden fazla custom query kullanyrsak her quey bitiminde bunu yapmalyz

        $today = date('Ymd');
        $homePageEvents = new WP_Query(array(
            'posts_per_page' => 2,
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'event_date',
                    //filtreleme neye göre yapılacak onu seçyrz
                    'compare' => '>=',
                    //karşılaştırma nasıl yapılacak
                    'value' => $today,
                    //ne ile karşılaştırılacak
                    'numeric' => 'numeric'
                    //karşılaştırılacak değerlerin cinsi
                ),
                array(
                     'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"'
                    //burda eğer mevcut programa ait bir event varsa onu seçmesini sağlyrz
                    //get_the_ID() yi "" arasına aldık. çünkü birden fazla related program olduğunda hata almamak için
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


        if($homePageEvents->have_posts()) {

            echo '<hr class="section-break">';
            echo '<h2>Upcoming '. get_the_title() .' Events</h2>';

            while($homePageEvents->have_posts()) {
                $homePageEvents->the_post();

                get_template_part('template-parts/content-event');

                //alttaki eventları gösterdiğimiz htmli ayrı bir yere aldık ve get_template_part() ile çektik.
                //get_template_part('template-parts/content', get_post_type());ikinci verdiğimiz değerle aslında dosya yolunu dinamik hale gtryrz
                //wordpress otomatik olarak mesala event post type için template-parts içinde content-event file alır.

                ?>

               <!-- <div class="event-summary">
                    <a class="event-summary__date t-center" href="<?php // the_permalink(); ?>">
                             <span class="event-summary__month"><?php
                                // $eventDate = new DateTime(get_field('event_date'));
                              //   echo $eventDate->format('M');

                                 //acf plugininden gelen custom field alan fonk = get_field() içine olştrdğmz custom field name veryrz ?></span>
                        <span class="event-summary__day"><?php // echo $eventDate->format('d'); ?></span>
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a href="<?php // the_permalink(); ?>"> <?php // the_title(); ?> </a></h5>
                        <p> <?php // echo wp_trim_words(get_the_content(), 18); ?> <a href="<?php // the_permalink(); ?>" class="nu gray">Learn more</a></p>
                    </div>
                </div>-->


            <?php }
        }



        wp_reset_postdata();
        $relatedCampuses = get_field('related_campus');

        if($relatedCampuses) {
            echo '<hr class="section-break">';
            echo '<h2>'. get_the_title() .' is available at these campuses:</h2>';

            echo '<ul class="min-list link-list">';
            foreach ($relatedCampuses as $campus) {
                ?>
                <li>
                    <a href="<?php echo get_the_permalink($campus); ?>">
                        <?php echo get_the_title($campus); ?>
                    </a>
                </li>
                <?php
            }

            echo '</ul>';
        }

        ?>

    </div>

<?php }

get_footer();
//footer alan fonk

?>