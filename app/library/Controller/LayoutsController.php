<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Model\Layout;
use App\Model\ContentType;

class LayoutsController extends BaseController
{
    public function index($request, $response, $args)
    {
        $layouts = Layout::all();

        return $this->render('layouts/index', [
            'layouts' => $layouts,
        ]);
    }

    public function create($request, $response, $args)
    {
        return $this->render('layouts/create', [
            'params' => $request->getParams(),
        ]);
    }

    public function insert($request, $response, $args)
    {
        // create content type in db
        $params = $request->getParams();
        $layout = Layout::create($params);

        $router = $this->getContainer()['router'];
        return $this->redirect($router->pathFor('layouts'));
    }

    public function edit($request, $response, $args)
    {
        $layout = Layout::findOrFail($args['id']);

        // build params for the form fields
        $params = $layout->toArray();

        return $this->render('layouts/edit', [
            'layout_' => $layout, // "layout" is reserved in foil 
            'params' => $params, // required for shared fields partial
        ]);
    }

    public function update($request, $response, $args)
    {
        $layout = Layout::findOrFail($args['id']);

        // create content type in db
        $layout->update($request->getParams());

        $router = $this->getContainer()['router'];
        return $this->redirect($router->pathFor('layouts'));
    }
}
