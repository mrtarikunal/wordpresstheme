<footer class="site-footer">

    <div class="site-footer__inner container container--narrow">

      <div class="group">

        <div class="site-footer__col-one">
          <h1 class="school-logo-text school-logo-text--alt-color"><a href="#"><strong>Fictional</strong> University</a></h1>
          <p><a class="site-footer__link" href="#">555.555.5555</a></p>
        </div>

        <div class="site-footer__col-two-three-group">
          <div class="site-footer__col-two">
            <h3 class="headline headline--small">Explore</h3>
            <nav>
                <ul class="nav-list min-list">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footerLocationOne'
                ));
                //menuyu çağryz. theme_location menunun yerini belrytr. function php içinde
                //belirttğimiz footerLocationOne yazdık

                ?></ul>
                <!-- <ul class="nav-list min-list">
                <li><a href="<?php //echo site_url('/about-us') //site_url site ana url ni getirir ?>">About Us</a></li>
                <li <?php //if(is_page('about-us') or wp_get_post_parent_id(0) == 16) echo 'class="current-menu-item"' ?> ><a href="#">Programs</a></li>
                tıklanan sayfanın rengini değiştmek için yaptk. kendisine veya child page ne tıklandığında
                <li><a href="#">Events</a></li>
                <li><a href="#">Campuses</a></li>
              </ul>-->

                <!--
                    //is_page('about-us') verilen slug göre true veya false döner
                    //wp_get_post_parent_id(0) verilen id deki sayfanın parent id sini döndürür. 0 yazarsak mevcut sayfanın parentını almaya çalşr
                    //get_the_ID() mevcut sayfanın id sini alır
                -->
            </nav>
          </div>

          <div class="site-footer__col-three">
            <h3 class="headline headline--small">Learn</h3>
            <nav>
                <ul class="nav-list min-list">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footerLocationTwo'
                ));
                //menuyu çağryz. theme_location menunun yerini belrytr. function php içinde
                //belirttğimiz footerLocationTwo yazdık

                ?></ul>
                <!--  <ul class="nav-list min-list">
                <li><a href="#">Legal</a></li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Careers</a></li>
              </ul>-->
            </nav>
          </div>
        </div>

        <div class="site-footer__col-four">
          <h3 class="headline headline--small">Connect With Us</h3>
          <nav>
            <ul class="min-list social-icons-list group">
              <li><a href="#" class="social-color-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
              <li><a href="#" class="social-color-instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
          </nav>
        </div>
      </div>

    </div>
  </footer>



<?php wp_footer();
//wordpress js kodlarını yüklüyor bu fonk ile
 ?>
</body>
</html>