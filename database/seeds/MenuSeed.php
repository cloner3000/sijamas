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
                'controller'    => 'Static\BannerController',
                'slug'          => 'static-banner',
                'order'         => '1'
                ],['index','create','update','delete']
            ); 
            \trinata::addMenu([
                'parent_id'     => 'page',
                'title'         => 'Profile',
                'controller'    => 'Static\ProfileController',
                'slug'          => 'static-profile',
                'order'         => '2'
                ],['index','create','update','delete']
            ); 
    }
}
