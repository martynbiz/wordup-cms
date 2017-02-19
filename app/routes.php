<?php
// Routes

$app->get('/', '\App\Controller\HomeController:index')->setName('home');

$app->group('/folders', function() use ($app) {
    $app->get('', '\App\Controller\FoldersController:index')->setName('folders');
    $app->get('/create', '\App\Controller\FoldersController:create')->setName('folders_create');
    $app->post('', '\App\Controller\FoldersController:insert')->setName('folders_post');
    $app->get('/{id}/edit', '\App\Controller\FoldersController:edit')->setName('folders_edit');
    $app->put('/{id}', '\App\Controller\FoldersController:update')->setName('folders_put');
    $app->delete('/{id}', '\App\Controller\FoldersController:delete')->setName('folders_delete');
    $app->post('/{id}/publish', '\App\Controller\FoldersController:publish')->setName('folders_publish');

    $app->group('/{folder_id}/contents', function() use ($app) {
        // $app->get('', '\App\Controller\ContentsController:index')->setName('contents');
        $app->get('/create', '\App\Controller\ContentsController:create')->setName('contents_create');
        $app->post('', '\App\Controller\ContentsController:insert')->setName('contents_post');
        $app->get('/{id}/edit', '\App\Controller\ContentsController:edit')->setName('contents_edit');
        $app->put('/{id}', '\App\Controller\ContentsController:update')->setName('contents_put');
        $app->delete('/{id}', '\App\Controller\ContentsController:delete')->setName('contents_delete');
    });
});

$app->group('/contenttypes', function() use ($app) {
    $app->get('', '\App\Controller\ContentTypesController:index')->setName('content_types');
    $app->get('/create', '\App\Controller\ContentTypesController:create')->setName('content_types_create');
    $app->post('', '\App\Controller\ContentTypesController:insert')->setName('content_types_post');
    $app->get('/{id}/edit', '\App\Controller\ContentTypesController:edit')->setName('content_types_edit');
    $app->put('/{id}', '\App\Controller\ContentTypesController:update')->setName('content_types_put');
    $app->delete('/{id}', '\App\Controller\ContentTypesController:delete')->setName('content_types_delete');
});

$app->group('/layouts', function() use ($app) {
    $app->get('', '\App\Controller\LayoutsController:index')->setName('layouts');
    $app->get('/create', '\App\Controller\LayoutsController:create')->setName('layouts_create');
    $app->post('', '\App\Controller\LayoutsController:insert')->setName('layouts_post');
    $app->get('/{id}/edit', '\App\Controller\LayoutsController:edit')->setName('layouts_edit');
    $app->put('/{id}', '\App\Controller\LayoutsController:update')->setName('layouts_put');
    $app->delete('/{id}', '\App\Controller\LayoutsController:delete')->setName('layouts_delete');
});
