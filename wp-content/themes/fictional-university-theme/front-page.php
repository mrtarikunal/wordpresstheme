<?php get_header();
//header alıyrz
?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg') ?>);"></div>
        <div class="page-banner__content container t-center c-white">
            <h1 class="headline headline--large">Welcome!</h1>
            <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
            <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
            <a href="<?php echo get_post_type_archive_link('program'); ?>" class="btn btn--large btn--blue">Find Your Major</a>
        </div>
    </div>

    <div class="full-width-split group">
        <div class="full-width-split__one">
            <div class="full-width-split__inner">
                <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>

              <?php
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



                 while($homePageEvents->have_posts()) {
                     $homePageEvents->the_post();

                     get_template_part('template-parts/content', 'event');

                     //alttaki eventları gösterdiğimiz htmli ayrı bir yere aldık ve get_template_part() ile çektik.
                     //burda ilk parametre dosya yolu, wordpress ikinci paremetreyi alıyor ve önüne - koyarak  content-event file nı çekyr
                     //istersek böyle yapmayım direk isimlendirebilrizde get_template_part('template-parts/content-event')
                     //get_template_part('template-parts/content', get_post_type());ikinci verdiğimiz değerle aslında dosya yolunu dinamik hale gtryrz
                     //wordpress otomatik olarak mesala event post type için template-parts içinde content-event file alır.

                     ?>

                    <!-- <div class="event-summary">
                         <a class="event-summary__date t-center" href="<?php // the_permalink(); ?>">
                             <span class="event-summary__month"><?php
                                // $eventDate = new DateTime(get_field('event_date'));
                                //echo $eventDate->format('M');

                                 //acf plugininden gelen custom field alan fonk = get_field() içine olştrdğmz custom field name veryrz ?></span>
                             <span class="event-summary__day"><?php // echo $eventDate->format('d'); ?></span>
                         </a>
                         <div class="event-summary__content">
                             <h5 class="event-summary__title headline headline--tiny"><a href="<?php // the_permalink(); ?>"> <?php // the_title(); ?> </a></h5>
                             <p> <?php // echo wp_trim_words(get_the_content(), 18); ?> <a href="<?php // the_permalink(); ?>" class="nu gray">Learn more</a></p>
                         </div>
                     </div>-->


                <?php }
                  ?>




                <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn--blue">View All Events</a></p>

            </div>
        </div>
        <div class="full-width-split__two">
            <div class="full-width-split__inner">
                <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
                <?php
                $homePagePosts = new WP_Query(array(
                        'posts_per_page' => 2,
                        // 'category_name' => 'sport',
                         'post_type' => 'post'
                )); //custom query object oluşturacağız
                //posts_per_page kaç tane post çekeceğimizi söylyrz
                //category_name sadece verilen kategorilerdeki postları getrr
                //post_type query ne için yapacak post veya page olablr


                while($homePagePosts->have_posts()) {
                    $homePagePosts->the_post();

                    ?>

                    <div class="event-summary">
                        <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
                            <span class="event-summary__month"> <?php the_time('M'); ?> </span>
                            <span class="event-summary__day"> <?php the_time('d'); ?> </span>
                        </a>
                        <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <p><?php
                                if (has_excerpt()) {
                                  echo  get_the_excerpt();
                                  //eğer exerpt varsa alır yoksa aşağıdaki çalşr
                                } else {
                                    echo wp_trim_words(get_the_content(), 10); //ilk değer neyin kısaltılacağı ikinci ne kadar olacağı
                                }
                                 ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
                        </div>
                    </div>

                    <?php

                } wp_reset_postdata(); //oluştrdğmz custom query sonlandryrz

                ?>



                <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
            </div>
        </div>
    </div>

    <div class="hero-slider">
        <div data-glide-el="track" class="glide__track">
            <div class="glide__slides">
                <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bus.jpg'); ?>);">
                    <div class="hero-slider__interior container">
                        <div class="hero-slider__overlay">
                            <h2 class="headline headline--medium t-center">Free Transportation</h2>
                            <p class="t-center">All students have free unlimited bus fare.</p>
                            <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/apples.jpg'); ?>);">
                    <div class="hero-slider__interior container">
                        <div class="hero-slider__overlay">
                            <h2 class="headline headline--medium t-center">An Apple a Day</h2>
                            <p class="t-center">Our dentistry program recommends eating apples.</p>
                            <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bread.jpg'); ?>);">
                    <div class="hero-slider__interior container">
                        <div class="hero-slider__overlay">
                            <h2 class="headline headline--medium t-center">Free Food</h2>
                            <p class="t-center">Fictional University offers lunch plans for those in need.</p>
                            <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]">
            </div>
        </div>
    </div>

<?php get_footer();
//footer alıyrz
?>