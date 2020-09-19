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