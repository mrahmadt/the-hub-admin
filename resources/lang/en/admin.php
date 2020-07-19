<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],
    'pleasewait' => 'Please wait...',
    'yes'=> 'Yes',
    'no' => 'No',

    'upload' => [
        'name'=>'Name',
        'warning' => 'All files will be accessible over the internet.',
        'title' => 'Media',
        'actions' => [
            'index' => 'Media',
            'create' => 'New Page',
            'edit' => 'Edit :name',
            'createFolder' => 'New folder',
            'uploadFile' => 'Upload file',
        ],
        'columns' => [
            'foldername'=>'Folder name',
            'create' => 'Create',
            'name'=>'Name',
            'file'=>'File',
        ],
        
    ],

    'page' => [
        'title' => 'Pages',
        'actions' => [
            'index' => 'Pages',
            'create' => 'New Page',
            'edit' => 'Edit :name',
        ],
        'columns' => [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Page',
            'url' => 'URL',
            'is_published' => 'Published',
        ],
        
    ],
    'setting' => [
        'title' => 'Settings',
        'Setting'=>'Setting',
        'actions' => [
            'index' => 'Settings',
            'edit' => 'Edit :name',
        ]
    ],

    'category' => [
        'title' => 'Categories',

        'actions' => [
            'index' => 'Categories',
            'create' => 'New Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'itemorder' => 'Itemorder',
            'activated' => 'Activated',
        ],
    ],


    'tab' => [
        'title' => 'Tabs',

        'actions' => [
            'index' => 'Tabs',
            'create' => 'New Tab',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'body' => 'Body',
            'url' => 'Url',
            'category_id' => 'Category',
            'itemorder' => 'Itemorder',
            'activated' => 'Activated',
            
        ],
    ],



    'application' => [
        'title' => 'Applications',

        'actions' => [
            'index' => 'Applications',
            'create' => 'New Application',
            'edit' => 'Edit :name',
        ],
        'autofill' => [
            'data' => 'Autofill Url data'
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'icon' => 'Icon',
            'description' => 'Description',
            'isNewPage' => 'Open in a new page',
            'isNewPageForIframe' => 'Open in a new page if iframe detected',
            'activated' => 'Activated',
            'isFeatured' => 'Featured',
            'category_id' => 'Category',
            
        ],
    ],



    // Do not delete me :) I'm used for auto-generation
];
