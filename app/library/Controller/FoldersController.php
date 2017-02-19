<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Model\Folder;
use App\Model\ContentType;

class FoldersController extends BaseController
{
    public function index($request, $response, $args)
    {
        $folders = Folder::where('parent_id', 0)->get();

        return $this->render('folders/index', [
            'folders' => $folders,
        ]);
    }

    public function publish($request, $response, $args)
    {
        $dir = '/var/www/wordup-live';
        $container = $this->getContainer();
        $container['filesystem']->emptyDir($dir);

        $folder = Folder::find((int)$args['id']);
        $folder->publish($dir);

        return $this->render('folders/publish', [
            'result' => $result,
        ]);
    }

    public function create($request, $response, $args)
    {
        return $this->render('folders/create', [
            'params' => $request->getParams(),
        ]);
    }

    public function insert($request, $response, $args)
    {
        // create content type in db
        $params = $request->getParams();
        $folder = Folder::create($params);

        $router = $this->getContainer()['router'];
        if ((int)$params['parent_id'] > 0) {
            return $this->redirect($router->pathFor('folders_edit', ['id' => $params['parent_id']]));
        } else {
            return $this->redirect($router->pathFor('folders'));
        }
    }

    public function edit($request, $response, $args)
    {
        $folder = Folder::findOrFail($args['id']);

        // build params for the form fields
        $params = $folder->toArray();
        // $params['content'] = $folder->content->toArray();

        return $this->render('folders/edit', [
            'folder' => $folder,
            'params' => $params, // required for shared fields partial
        ]);
    }

    public function update($request, $response, $args)
    {
        $folder = Folder::findOrFail($args['id']);

        // create content type in db
        $folder->update($request->getParams());

        $router = $this->getContainer()['router'];
        return $this->redirect($router->pathFor('folders'));
    }
}
