<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Model\ContentType;

class ContentTypesController extends BaseController
{
    public function index($request, $response, $args)
    {
        $contentTypes = ContentType::all();

        return $this->render('content_types/index', [
            'content_types' => $contentTypes,
        ]);
    }

    public function create($request, $response, $args)
    {
        return $this->render('content_types/create', [
            'params' => $request->getParams(),
        ]);
    }

    public function insert($request, $response, $args)
    {
        // create content type in db
        $contentType = ContentType::create($request->getParams());

        // create fields
        $fields = [];
        foreach($params['fields'] as $key => $values) {
            foreach($values as $i => $value) {
                $fields[$i][$key] = $value;
            }
        }
        foreach($fields as $values) {
            $contentType->fields()->create($values);
        }

        $router = $this->getContainer()['router'];
        return $this->redirect($router->pathFor('content_types'));
    }

    public function edit($request, $response, $args)
    {
        $contentType = ContentType::findOrFail($args['id']);

        // build params for the form fields
        $params = $contentType->toArray();
        $params['fields'] = $contentType->fields->toArray();

        return $this->render('content_types/edit', [
            'content_type' => $contentType,
            'params' => $params, // required for shared fields partial
        ]);
    }

    public function update($request, $response, $args)
    {
        $params = $request->getParams();
        $contentType = ContentType::findOrFail($args['id']);

        // create content type in db
        $contentType->update($params);

        // loop through fields. lookup by id. if found, update, otherwise create
        foreach($params['fields'] as $values) {
            $field = $contentType->fields()->find($values['id']);
            if ($field) {
                $field->update($values);
            } else {
                $contentType->fields()->create($values);
            }
        }

        $router = $this->getContainer()['router'];
        return $this->redirect($router->pathFor('content_types'));
    }
}
