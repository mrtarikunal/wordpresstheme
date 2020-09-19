<?php

  get_header();

  while(have_posts()) {
    the_post();
      pageBanner();
      //function.php içinde banner için özel fonksiyon oluştrdk ordan çekyrz
    ?>
    
    <!--<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php //echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php //the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>DONT FORGET TO REPLACE ME LATER</p>
      </div>
    </div>  
  </div>-->

  <div class="container container--narrow page-section">

<?php 

$theParent = wp_get_post_parent_id(get_the_ID());
    
    if(wp_get_post_parent_id(get_the_ID())){
    	//wp_get_post_parent_id post veya page in parent id sini getrr.
    	//get_the_ID post veya page in id sini getrr.
    	//eğer child page ise burayı gösteryrz. parent yoksa sonuç 0 dönüyor ve if içine girmiyor
    	?>
    	 <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); //get_permalink verilen id ye ait post veta sayfanın linkini getrr ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); //get_the_title verilen id ye ait post veta sayfanın title getrr ?></a> <span class="metabox__main"><?php the_title(); //the_title mevcut sayfanın title getrr ?></span></p>
    </div>

<?php 
    }
    

 ?>


  <?php 

  $testArray = get_pages(array(
   'child_of' => get_the_ID()
   //get_pages tüm sayfaları getrr ama yazdırmaz hafızada tutar
   //eğer mevcut sayfa child veya parent sayfa değilse 0 dönecek ve testArray 0 değerini alıcak

  ));

  if($theParent or $testArray) { ?>

       <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo  get_permalink($theParent) ?>"><?php echo  get_the_title($theParent) ?></a></h2>
      <ul class="min-list">
        <?php
            
            if($theParent) {
            	$findChildrenOf = $theParent;
            	//eğeer child page is theParent ile parent sayfanın id sini alyrz
            } else {
            	$findChildrenOf = get_the_Id();
            	//eğer parent page ise direk onun id sini alyrz
            }

         wp_list_pages(array(
           'title_li' => NULL,
           'child_of' => $findChildrenOf,
           'sort_column' => 'menu_order'

        )); //wp_list_pages yayında olan tüm sayfaları sıralar, title_li pages diye gelen başlığı kaldryr,  child_of verilen id deki page in child sayfalarını getyr, 'sort_column' da sayfa oluştrrken order da belirledğmz sıraya göre göstermeye yaryr ?>
      </ul>
    </div>

 <?php }

  ?>
    
  
   
   

    <div class="generic-content">
      <?php the_content();

      //for custom query variables
      //function.php içinde tanımladık. url in sonuna ?skyColor=blue yazarsak bu çalşck

      $skyColorValue = sanitize_text_field(get_query_var('skyColor'));
      $grassColorValue = sanitize_text_field(get_query_var('grassColor'));


      if($skyColorValue === 'blue' AND $grassColorValue === 'green') {
          echo '<p>sky is blue and grass is green today</p>';

      }

      ?>

        <!--burda method olarak post seçersek url de parametreler gözükmez submit sonrası
         ama yukardaki işlem çalşr. get methıdunda ise url de parametreler gözükür.
         bunu hassas veriler olmadığı ve mesala olştrdğmz filtreyi başka biri ile paylaşmak istedğmzde kullnblrz-->
        <form method="get">
            <input name="skyColor" placeholder="Sky Color">
            <input name="grassColor" placeholder="Grass Color">
            <button type="submit">Submit</button>

        </form>

    </div>

  </div>
    
  <?php }

  get_footer();

?>