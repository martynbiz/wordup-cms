<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Model\ContentType;
use App\Model\Folder;

class ContentsController extends BaseController
{
    public function create($request, $response, $args)
    {
        $params = $request->getParams();

        $folder = Folder::findOrFail($args['folder_id']);

        if ($contentTypeId = (int)@$params['content_type_id']) {

            $contentType = ContentType::findOrFail($contentTypeId);

            return $this->render('contents/create', [
                'content_type' => $contentType,
                'folder' => $folder,
                'params' => $params,
            ]);
        } else {

            $contentTypes = ContentType::all();

            return $this->render('contents/create', [
                'content_types' => $contentTypes,
                'folder' => $folder,
                'params' => $params,
            ]);
        }
    }

    public function insert($request, $response, $args)
    {
        $params = $request->getParams();
        $folder = Folder::findOrFail($args['folder_id']);

        // create content type in db
        $content = $folder->contents()->create($params);

        // create elements
        foreach($params['content_values'] as $fieldName => $value) {
            $content->values()->create([
                'field_name' => $fieldName,
                'value' => $value,
            ]);
        }

        $router = $this->getContainer()['router'];
        return $this->redirect($router->pathFor('folders_edit', [
            'id' => $folder->id,
        ]));
    }

    // public function edit($request, $response, $args)
    // {
    //     $contentType = ContentType::findOrFail($args['id']);
    //
    //     // build params for the form fields
    //     $params = $contentType->toArray();
    //     $params['elements'] = $contentType->elements->toArray();
    //
    //     return $this->render('content_types/edit', [
    //         'content_type' => $contentType,
    //         'params' => $params, // required for shared fields partial
    //     ]);
    // }
    //
    // public function update($request, $response, $args)
    // {
    //     $params = $request->getParams();
    //     $contentType = ContentType::findOrFail($args['id']);
    //
    //     // create content type in db
    //     $contentType->update($params);
    //
    //     // loop through elements. lookup by id. if found, update, otherwise create
    //     foreach($params['elements'] as $values) {
    //         $element = $contentType->elements()->find($values['id']);
    //         if ($element) {
    //             $element->update($values);
    //         } else {
    //             $contentType->elements()->create($values);
    //         }
    //     }
    //
    //     $router = $this->getContainer()['router'];
    //     return $this->redirect($router->pathFor('content_types'));
    // }
}
