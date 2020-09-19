<?php
get_header();
//arşiv event post type için

pageBanner(array(
    'title' => 'Past Events',
    'subtitle' => 'A recap of our past events'
    //'photo' => 'https://blog.prezi.com/wp-content/uploads/2019/03/jason-leung-479251-unsplash.jpg'
    //fonksiyon değişkenlerini array olarak yollurz
));
?>
    <!--<div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php // echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">

            <h1 class="page-banner__title"> Past Events</h1>

        </div>
    </div>-->

    <div class="container container--narrow page-section">
        <?php
        $today = date('Ymd');
        $pastEvents = new WP_Query(array(
            'paged' => get_query_var('paged', 1),
            //paged yaparak paginationın hangi sayfa numarasında olduğunu anlamasını sağlyrz.
            //get_query_var() query url deki değişkenleri alıyrz.
            'posts_per_page' => 2,
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'event_date',
                    //filtreleme neye göre yapılacak onu seçyrz
                    'compare' => '<',
                    //karşılaştırma nasıl yapılacak
                    'value' => $today,
                    //ne ile karşılaştırılacak
                    'numeric' => 'numeric'
                    //karşılaştırılacak değerlerin cinsi
                )
            )
        ));

        while($pastEvents->have_posts()) {
            $pastEvents->the_post();

            get_template_part('template-parts/content-event');

            //alttaki eventları gösterdiğimiz htmli ayrı bir yere aldık ve get_template_part() ile çektik.
            //get_template_part('template-parts/content', get_post_type());ikinci verdiğimiz değerle aslında dosya yolunu dinamik hale gtryrz
            //wordpress otomatik olarak mesala event post type için template-parts içinde content-event file alır.

            ?>

            <!--<div class="event-summary">
                <a class="event-summary__date t-center" href="<?php // the_permalink(); ?>">
                    <span class="event-summary__month"><?php
                        //$eventDate = new DateTime(get_field('event_date'));
                        //echo $eventDate->format('M');

                        ?></span>
                    <span class="event-summary__day"><?php // echo $eventDate->format('d'); ?></span>
                </a>
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="<?php // the_permalink(); ?>"> <?php // the_title(); ?> </a></h5>
                    <p> <?php // echo wp_trim_words(get_the_content(), 18); ?> <a href="<?php // the_permalink(); ?>" class="nu gray">Learn more</a></p>
                </div>
            </div>-->


        <?php }

        //echo paginate_links(); //pagination oluştrr. bu custom query ler için çalışmaz
        echo paginate_links(array(
            'total' => $pastEvents->max_num_pages
        ));
        ?>

    </div>

<?php
get_footer();

?>