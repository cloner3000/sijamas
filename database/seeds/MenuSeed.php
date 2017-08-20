<?php

use Illuminate\Database\Seeder;


class MenuSeed extends Seeder
{
    /* example add menu
        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Management product',
                'controller'    => '#',
                'slug'          => 'product',
                'order'         => 1,
            ],[]);

                \trinata::addMenu([ 
                    'parent_id'     => 'product',
                    'title'         => 'Category',
                    'controller'    => 'CategoryController',
                    'slug'          => 'category',
                    'order'         => '1'
                ],['index','create','update','delete']
            ); 

    */
   

         
    public function run()
    {
        //
        
        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Referensi Kerjasama',
                'controller'    => '#',
                'slug'          => 'ref-kerjasama',
                'order'         => 1,
            ],[]);

            \trinata::addMenu([ 
                'parent_id'     => 'ref-kerjasama',
                'title'         => 'Jenis Kerjasama',
                'controller'    => 'Kerjasama\TypeController',
                'slug'          => 'kerjasama-type',
                'order'         => '1'
                ],['index','create','update','delete']
            ); 

            \trinata::addMenu([
                'parent_id'     => 'ref-kerjasama',
                'title'         => 'Bidang Fokus',
                'controller'    => 'Kerjasama\FocusController',
                'slug'          => 'kerjasama-fokus',
                'order'         => '2'
                ],['index','create','update','delete']
            ); 

        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Page',
                'controller'    => '#',
                'slug'          => 'page',
                'order'         => 1,
            ],[]);
            
            \trinata::addMenu([
                'parent_id'     => 'page',
                'title'         => 'Banner',
                'controller'    => 'PageStatic\BannerController',
                'slug'          => 'static-banner',
                'order'         => '1'
                ],['index','create','update','delete']
            ); 
            \trinata::addMenu([
                'parent_id'     => 'page',
                'title'         => 'Profile',
                'controller'    => 'PageStatic\ProfileController',
                'slug'          => 'static-profile',
                'order'         => '2'
                ],['index','create','update','delete']
            ); 

        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Kerjasama',
                'controller'    => '#',
                'slug'          => 'cooperation',
                'order'         => 1,
            ],[]);
            \trinata::addMenu([
                'parent_id'     => 'cooperation',
                'title'         => 'Ketegori Kerjasama',
                'controller'    => 'Kerjasama\CooperationController',
                'slug'          => 'cooperation-category',
                'order'         => '1'
                ],['index','create','update','delete']
            );
            \trinata::addMenu([
                'parent_id'     => 'cooperation',
                'title'         => 'Tindak Lanjut Dokumen',
                'controller'    => 'Kerjasama\FollowupController',
                'slug'          => 'cooperation-followup',
                'order'         => '2'
                ],['index','create','update','delete']
            );



        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Kategory Kerjasama',
                'controller'    => 'KategoryController',
                'slug'          => 'kategori-kerjasama',
                'order'         => 2,
            ],['index','create','update','delete']);

        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Usulan Kerjasama',
                'controller'    => 'UsulanController',
                'slug'          => 'usulan-kerjasama',
                'order'         => 3,
            ],['index','create','update','delete']);

        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Laporan',
                'controller'    => 'LaporanController',
                'slug'          => 'laporan-kerjasama',
                'order'         => 4,
            ],['index','create','update','delete']);

        \trinata::addMenu([ 
                'parent_id'     => null,
                'title'         => 'Konten Website',
                'controller'    => 'KontenController',
                'slug'          => 'konten',
                'order'         => 5,
            ],['index','create','update','delete']);


        \trinata::addMenu([ 
                'parent_id'     => 'konten',
                'title'         => 'Slideshow',
                'controller'    => 'SlideshowController',
                'slug'          => 'slideshow',
                'order'         => 1,
            ],['index','create','update','delete']);
        \trinata::addMenu([ 
                'parent_id'     => 'konten',
                'title'         => 'Page',
                'controller'    => 'PageController',
                'slug'          => 'page',
                'order'         => 2,
            ],['index','create','update','delete']);
            
        \trinata::addMenu([ 
                'parent_id'     => 'konten',
                'title'         => 'Social Media',
                'controller'    => 'SocialController',
                'slug'          => 'social',
                'order'         => 3,
            ],['index','create','update','delete']);
    }
}
