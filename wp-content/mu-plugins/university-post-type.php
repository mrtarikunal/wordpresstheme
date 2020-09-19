<?php

//mu-plugins klasörü must use plugins leri ifade eder ve wordpress tarafından otomatik yüklenir
function university_post_types () {

    register_post_type('campus', array(
        'show_in_rest' => true,
        //ilk başta klasik editorde gösterr. bunu eklersek modern editöre geçer.
        //'supports' => array('title', 'editor', 'excerpt', 'custom-fields'), //custom-fields post type key ve value şeklinde custom field ekler
        'supports' => array('title', 'editor', 'excerpt'),
        //custom post type ın hangi özelliklerini açacağımızı kontrol edyrz. mesala exerpt ilk başta yok. burda açablyrz
        'rewrite' => array('slug' => 'campuses'),
        //default slug event. biz onu değiştrdk
        'has_archive' => true,
        'public' => true,
        //post type tüm kullanıcılara görünür kılar.
        'labels' => array(
            'name' => 'Campuses',
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus'
        ),
        //oluştrdğmz post type in admin panelde göründüğü bazı labelları kendi istedğimz gibi isimlendiryrz.

        'menu_icon' => 'dashicons-location-alt'
        //admin panelde gözüken ikonunu ayarladık
        //dashicons wordpress yazıp aradığımızda iconlara ulşblrz

    ));
    //custom post type tanımlıyrz. ilki post type ismi, ikincisi özellikleri


    register_post_type('event', array(
        'capability_type' => 'event',
        //role ve permissionlar için event post type nı default post kategorisinden çıkardık.
        //mesala custom bir role olştryrz ve sadece event post type erişmesini istyrz
        //'capability_type' => 'event' burda ismini event vermek zorunda dğlz istedğmz unique isim vereblrz
        'map_meta_cap' => true,
        //yukardakini required yapyrz. yani herhangi bir user ın bu role almış olmasını zorunlu ttyrz.
        //bunu yaptıktan sonra mesala default admin user na bile gidip event permission atamamız gerkyr
        'show_in_rest' => true,
        //ilk başta klasik editorde gösterr. bunu eklersek modern editöre geçer.
        //'supports' => array('title', 'editor', 'excerpt', 'custom-fields'), //custom-fields post type key ve value şeklinde custom field ekler
        'supports' => array('title', 'editor', 'excerpt'),
        //custom post type ın hangi özelliklerini açacağımızı kontrol edyrz. mesala exerpt ilk başta yok. burda açablyrz
        'rewrite' => array('slug' => 'events'),
        //default slug event. biz onu değiştrdk
        'has_archive' => true,
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


    register_post_type('program', array(
        'show_in_rest' => true,
        //ilk başta klasik editorde gösterr. bunu eklersek modern editöre geçer.
        //'supports' => array('title', 'editor', 'excerpt', 'custom-fields'), //custom-fields post type key ve value şeklinde custom field ekler
        'supports' => array('title'),
        //custom post type ın hangi özelliklerini açacağımızı kontrol edyrz. mesala exerpt ilk başta yok. burda açablyrz
        'rewrite' => array('slug' => 'programs'),
        //default slug event. biz onu değiştrdk
        'has_archive' => true,
        'public' => true,
        //post type tüm kullanıcılara görünür kılar.
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_name' => 'Program'
        ),
        //oluştrdğmz post type in admin panelde göründüğü bazı labelları kendi istedğimz gibi isimlendiryrz.

        'menu_icon' => 'dashicons-awards'
        //admin panelde gözüken ikonunu ayarladık
        //dashicons wordpress yazıp aradığımızda iconlara ulşblrz

    ));
    //custom post type tanımlıyrz. ilki post type ismi, ikincisi özellikleri

    register_post_type('professor', array(
        'show_in_rest' => true,
        //ilk başta klasik editorde gösterr. bunu eklersek modern editöre geçer.
        //'supports' => array('title', 'editor', 'excerpt', 'custom-fields'), //custom-fields post type key ve value şeklinde custom field ekler
        'supports' => array('title', 'editor', 'thumbnail'),
        //custom post type ın hangi özelliklerini açacağımızı kontrol edyrz. mesala exerpt ilk başta yok. burda açablyrz
        'public' => true,
        //post type tüm kullanıcılara görünür kılar.
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors',
            'singular_name' => 'Professor'
        ),
        //oluştrdğmz post type in admin panelde göründüğü bazı labelları kendi istedğimz gibi isimlendiryrz.

        'menu_icon' => 'dashicons-welcome-learn-more'
        //admin panelde gözüken ikonunu ayarladık
        //dashicons wordpress yazıp aradığımızda iconlara ulşblrz

    ));
    //custom post type tanımlıyrz. ilki post type ismi, ikincisi özellikleri

    register_post_type('note', array(
        'capability_type' => 'note',
        //role ve permissionlar için note post type nı default post kategorisinden çıkardık.
        //mesala custom bir role olştryrz ve sadece note post type erişmesini istyrz
        //'capability_type' => 'note' burda ismini event vermek zorunda dğlz istedğmz unique isim vereblrz
        'map_meta_cap' => true,
        //yukardakini required yapyrz. yani herhangi bir user ın bu role almış olmasını zorunlu ttyrz.
        //bunu yaptıktan sonra mesala default admin user na bile gidip event permission atamamız gerkyr

        'show_in_rest' => true,
        //ilk başta klasik editorde gösterr. bunu eklersek modern editöre geçer.
        //'supports' => array('title', 'editor', 'excerpt', 'custom-fields'), //custom-fields post type key ve value şeklinde custom field ekler
        'supports' => array('title', 'editor'),
        //custom post type ın hangi özelliklerini açacağımızı kontrol edyrz. mesala exerpt ilk başta yok. burda açablyrz
        'public' => false,
        //post type herkesten saklar admin dahil
        'show_ui' => true,
        //saklanan post type adminde gösterr
        'labels' => array(
            'name' => 'Notes',
            'add_new_item' => 'Add New Note',
            'edit_item' => 'Edit Note',
            'all_items' => 'All Notes',
            'singular_name' => 'Note'
        ),
        'menu_icon' => 'dashicons-welcome-write-blog'
    ));

    register_post_type('like', array(

        //'supports' => array('title', 'editor', 'excerpt', 'custom-fields'), //custom-fields post type key ve value şeklinde custom field ekler
        'supports' => array('title'),
        //custom post type ın hangi özelliklerini açacağımızı kontrol edyrz. mesala exerpt ilk başta yok. burda açablyrz
        'public' => false,
        //post type herkesten saklar admin dahil
        'show_ui' => true,
        //saklanan post type adminde gösterr
        'labels' => array(
            'name' => 'Likes',
            'add_new_item' => 'Add New Like',
            'edit_item' => 'Edit Like',
            'all_items' => 'All Likes',
            'singular_name' => 'Like'
        ),
        'menu_icon' => 'dashicons-heart'
    ));
}

add_action('init', 'university_post_types');