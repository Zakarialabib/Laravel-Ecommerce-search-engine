<?php

return [
    'alert' => [
        'position' => 'top-end',
        'timer' => 3000,
        'toast' => true,
        'text' => null,
        'showCancelButton' => false,
        'showConfirmButton' => false,
    ],
    'confirm' => [
        'icon' => 'warning',
        'position' => 'center',
        'toast' => false,
        'timer' => null,
        'showConfirmButton' => true,
        'showCancelButton' => true,
        'cancelButtonText' => 'No',
        'confirmButtonColor' => '#3085d6',
        'cancelButtonColor' => '#d33',
    ],
    // customize alert style by passing your custom classes, works perfectly with [TailwindCSS]
    'customClass' => [
        'container' => '',
        'popup' => '',
        'header' => '',
        'title' => '',
        'closeButton' => '',
        'icon' => '',
        'image' => '',
        'content' => '',
        'htmlContainer' => '',
        'input' => '',
        'inputLabel' => '',
        'validationMessage' => '',
        'actions' => '',
        'confirmButton' => '',
        'denyButton' => '',
        'cancelButton' => '',
        'loader' => '',
        'footer' => ''
       ]
    
];
