<?php

//query variable ekleme ( url sonuna custom variable ekleme)
//http://fictional-university.test/?skyColor=
//page.php içine bak
add_filter('query_vars', 'universityQueryVars');

function universityQueryVars($vars) {
    $vars[] = 'skyColor';
    $vars[] = 'grassColor';
    return $vars;
}



require get_theme_file_path('/inc/like-route.php');
//custom wp-json url için olştdğmz php dosyasını include edyrz


require get_theme_file_path('/inc/search-route.php');
//custom wp-json url için olştdğmz php dosyasını include edyrz

function university_custom_rest() {
    register_rest_field('post', 'authorName', array(

            'get_callback' => function () {
                return get_the_author();
            }
    ));
    //ilk parameter neye ekliycez post,page vs., ikincisi ekleyecğmz değişkenn ismi
    //üçüncü değer eklemek istedğmz değer

    register_rest_field('note', 'userNoteCount', array(

        'get_callback' => function () {
            return count_user_posts(get_current_user_id(), 'note');
        }
    ));
    //ilk parameter neye ekliycez note post type na., ikincisi ekleyecğmz değişkenn ismi
    //üçüncü değer eklemek istedğmz değer. burda note post type için current user ın kaç tane postu oldğna rest apiye eklyrz
}
//restapi sonucuna custom field eklyrz
add_action('rest_api_init', 'university_custom_rest');

function pageBanner ($args = NULL) {
    //$args array olarak kullandığımız alanlardan yolluyrz

    if(!$args['title']) {
        // eğer title gönderilmezse fonksiyonun çağrıldığı yerde mevcut dinamik title alıyrz
        $args['title'] = get_the_title();
    }

    if(!$args['subtitle']) {
        // eğer subtitle gönderilmezse fonksiyonun çağrıldığı yerde mevcut dinamik subtitle alıyrz
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if(!$args['photo']) {
        // eğer photo gönderilmezse fonksiyonun çağrıldığı yerde mevcut dinamik background image alıyrz
        if(get_field('page_banner_background_image')) {

            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];

        } else {
            $args['photo'] = 'http://fictional-university.test/wp-content/uploads/2020/08/field-scaled.jpg';
        }
    }

    ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; //$pageBannerImage= get_field('page_banner_background_image'); echo $pageBannerImage['sizes']['pageBanner']
        //acf plugini ile olştrdğmz custom field olan background image çekyrz. array olarak dönyr. ordan function.php içinde oştrdğmz custom image size göre çektk. dönen arrayde neler var görmek için
        //print_r($pageBannerImage) yaparak arrayde gelen field ları göreblrz
        ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"> <?php echo $args['title'] //the_title(); ?> </h1>
            <div class="page-banner__intro">
                <p><?php echo $args['subtitle'] //the_field('page_banner_subtitle');
                    //acf plugini ile olştrdğmz custom subtitle çekyrz
                    ?></p>
            </div>

        </div>
    </div>

<?php
}


/*
function university_files() {
  wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
  //wp_enqueue_script custom js dosyası yüklemek için. ilk argument takma isim, tema dosyası içindeki url oluştyr. NULL herhangi bir dependacy varmı, '1.0' versiyonu belitryr, true bosy tag nin en altında yüklemek için
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  //wp_enqueue_style custom css dosyası yüklemek için. ilk argument takma isim, ikincisi external css dosyasının url alıyor.
  wp_enqueue_style('university_main_styles', get_stylesheet_uri());
  //wp_enqueue_style custom css dosyası yüklemek için. ilk argument takma isim, ikincisi css dosyasının url alıyor.
}
npm öncesi hali
*/
function university_files() {
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    //wp_enqueue_style custom css dosyası yüklemek için. ilk argument takma isim, ikincisi external css dosyasının url alıyor.

    wp_enqueue_script('googleMap', 'https://maps.googleapis.com/maps/api/js?key=ghghghghghghghgh');
//google maps api için gerekli olan js yükledik

    if (strstr($_SERVER['SERVER_NAME'], 'fictional-university.test')) {
        //development ortamında burası çalışıyor
        wp_enqueue_script('main-university-js', 'http://fictional-university.test:3000/bundled.js', NULL, '1.0', true);
//npm kurduk ve npm run devFast yaptık. tüm js ve css ler otomayik url den dahil ettik. yaptığımız değişiklikler otomatik yansyr
//bu development da çalşr.
        //strstr bir string içinde başka bir string olup olmadığını kontrol eder.
    } else {
        //url fictional-university.test bundan farklı oldğnda burası çalışıcak
        //npm run dev yapyrz
        wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.9678b4003190d41dd438.js'), NULL, '1.0', true);
        wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.c0aa3e24a1fd40fd25d0.js'), NULL, '1.0', true);
        wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.c0aa3e24a1fd40fd25d0.css'));

    }

    wp_localize_script('main-university-js', 'universityData', array(
            'root_url' => get_site_url(),
             'nonce' => wp_create_nonce('wp_rest')
    ));
    //burda ilk parametre hangi js file içinde bir değişken olşturacağız. ikincisi değişkenin ismi
    //üçüncüsü de değişkene burda obje olarak oluştryrz atayacağımız değerler.
    //bu sayede main-university-js ismini verdğimz bundled.js içinde tanımladğmz global değişkeni kullanbilecğcz
// wordpress bu değiikeni html template içine yazar
    //'nonce' => wp_create_nonce('wp_rest') burda login user için wp default olştrduğu token nı bir değişkene atadk
    //user login olduğunda bu değişkene universityData.nonce ile ulaşablyrz

}

add_action('wp_enqueue_scripts', 'university_files');
//css ve js dosyalarını yüklemek için kullanıyrz wp_enqueue_scripts, ikinci argument fonksiyon ismi



function university_features() {
    register_nav_menu('headerMenuLocation', 'Header Main');
    //menuyu eklyrz. ilki name ikinsici açıklama

    register_nav_menu('footerLocationOne', 'Footer One');
    //diğer menuyu eklyrz.

    register_nav_menu('footerLocationTwo', 'Footer Two');
    //diğer menuyu eklyrz.

  add_theme_support('title-tag');
  //add_theme_support temaya yeni feauture eklemeye yarar. burda meta title ekledik

    add_theme_support('post-thumbnails');
    //add_theme_support temaya yeni feauture eklemeye yarar. burda feature image ekledik. bunlar deafult post ve page için açılır. custom olanlar için ekstra belirtmemiz gerekr. mu-pluginde yaptık

    //add_image_size('professorLandscape', 400, 260, array('left', 'top'));
    //wordpresse image leri kendi istedğmz boyutlarda kırpmasını söylyrz. ilki nick name, iki ve üç boyut, sonuncu kırpmayı nerden yapacağını belirteblyrz

    add_image_size('professorLandscape', 400, 260, true);


    add_image_size('professorPotrait', 480, 650, true);
    //wordpresse image leri kendi istedğmz boyutlarda kırpmasını söylyrz. ilki nick name, iki ve üç boyut, sonuncu kırpıp kırpmamasını beltryrz

    add_image_size('pageBanner', 1500, 350, true);


}

add_action('after_setup_theme', 'university_features');


/*
 * eğer custum post type burda belirlersek tema değiştiğinde bu post typalara ulaşamayız. bundan dolayı must plugins
 * klasörü içinde bir plugin olştrup oraya taşıdık
function university_post_types () {
    register_post_type('event', array(
        'public' => true,
        //post type tüm kullanıcılara görünür kılar.
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        //oluştrdğmz post type in admin panelde göründüğü bazı labelları kendi istedğimz gibi isimlendiryrz.

        'menu_icon' => 'dashicons-calendar'
        //admin panelde gözüken ikonunu ayarladık
        //dashicons wordpress yazıp aradığımızda iconlara ulşblrz

    ));
    //custom post type tanımlıyrz. ilki post type ismi, ikincisi özellikleri
}

add_action('init', 'university_post_types');
*/

function university_adjust_queries ($query) {
    //$query wordpressin yaptığı default query objesi

    if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {

        $query->set('posts_per_page' , -1);
        $query->set('orderby', 'title');
        //title göre alfabetik sıraladık
        $query->set('order', 'ASC');

    }

    if(!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()) {

        $query->set('posts_per_page' , -1);

    }

    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
        // !is_admin() sadece frontende yansıması için
        //is_post_type_archive('event') sadece event post type yasıması için
        // $query->is_main_query() query nin sadece url base olduğunu kontrol için. custom queryleri etkilememesi için

        $today = date('Ymd');

        $query->set('posts_per_page' , -1);
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
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
        ));
    }

}

add_action('pre_get_posts', 'university_adjust_queries');
//wordpress post query yapmadan önce query custumize yapayrz. 'university_adjust_queries' bizim verdiğimiz isim. herhangi bir isim olablr

function universityMapKey ($api) {
    $api['key'] = 'llkdkeyhbasauehenbebe';
    return $api;
}

add_filter('acf/fields/google_map/api', 'universityMapKey');
//acf de oluşturduğumuz custom fielde ekleme yapyrz. api key ekleyeceğiz.
//ilk kısımda yolunu veryrz. ikincisi de func ismi


//subscriber user ları login olduğnda ana sayfaya yönlendirme
    add_action('admin_init', 'redirectSubsToFrontend');

    function redirectSubsToFrontend() {
        $currentUser = wp_get_current_user();

        if(count($currentUser->roles) ==1 AND $currentUser->roles[0] == 'subscriber') {
            wp_redirect(site_url('/'));
            exit;

        }
    }

// subscriber user ları login olduğnda en üstteki admin dashboard menusünü kaldrma
add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {
    $currentUser = wp_get_current_user();

    if(count($currentUser->roles) ==1 AND $currentUser->roles[0] == 'subscriber') {
        show_admin_bar(false);

    }
}

//custumize login screen

//login sayfasındaki fotodaki linki custumize etme

    add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
    return esc_url(site_url('/'));
}

//login sayfasına custom css mizi yüklettik

add_action('login_enqueue_scripts', 'ourLoginCss');

function ourLoginCss() {

    wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.c0aa3e24a1fd40fd25d0.css'));

}

//login sayfasındaki powered by wordpress baslığını değştrdk

add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle() {
    return get_bloginfo('name');
}

//note post type nı sanitize etme, post limit koyma ve private olmaya zorlama

    add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);
//burda 2 numarası filterın makeNotePrivate fonks na iki parametre aktaracağını belrtr
//burda 10 numarası bu filter a uygulanacak fonk. nun öncelik sırasını ifade eder.
//mesala add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2); ve add_filter('wp_insert_post_data', 'bbbbb', 5, 2); olsun
//aynı filter a uygulanacak iki tane fonk olduğunda hangisinin öncelikle uygulanacağını bu numara belirler. küçük olan ilk uygulanır
//burda filter sayesinde post datası database yazılmadan önce post datasına filtre uyglayablyrz
//burda wp_insert_post_data filterı iki tane datayı fonksiyona iletir. ilki formdan gelen data, diğeride post type ile ilgili bilgiler
function makeNotePrivate($data, $postarr) {

    if($data['post_type'] == 'note') {

        if(count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID']) {

            die("you have reached your note limit");
        }

        $data['post_content'] = sanitize_textarea_field($data['post_content']);
        $data['post_title'] = sanitize_text_field($data['post_title']);

    }

    if($data['post_type'] == 'note' AND $data['post_status'] != 'trash') {
        $data['post_status'] = "private";
    }



    return $data;
}


//all-in-one-wp-imgration pluginin export yaparken istedğmz dosyayı exclude etme
add_filter('ai1wm_exclude_content_from_export', 'ignoreCertainFiles');

function ignoreCertainFiles($exclude_filters) {
    $exclude_filters[] ='themes/fictional-university-theme/node_modules';
    return $exclude_filters;

}

