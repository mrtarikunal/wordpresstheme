<div class="post-item">
    <h2 class="headline headline--medium headline--post-title "><a href="<?php the_permalink(); ?>">  <?php the_title(); // postun title ni alır  ?> </a></h2>


    <div class="generic-content">
        <?php the_excerpt(); // postun exerpt ni alır ?>
        <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Contunie Reading</a></p>

    </div>

</div>