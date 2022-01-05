<?php

return [
    'model' => App\Models\WarehouseItem::class,

    // searchable fields, if you dont want search feature, remove it
    'search' => ["name"],

    // Manage actions in crud
    'create' => false,
    'update' => true,
    'delete' => true,

    // If you will set it true it will automatically
    // add `user_id` to create and update action
    'with_auth' => false,

    // Validation in update and create actions
    // It will use Laravel validation system
    'validation' => [
        'name' => 'required',
        'qty' => 'required',
    ],

    // Write every fields in your db which you want to have a input
    // Available types : "ckeditor", "text", "file", "textarea", "password", "number", "email", "select"
    'fields' => [
        'name' => 'text',
        'qty' => 'number',
    ],

   

    // which kind of data should be showed in list page
    'show' => ['name', 'qty'],
];