<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Model\Formatter;

class FormattersController extends BaseController
{
    public function index($request, $response, $args)
    {
        $formatters = Formatter::all();

        return $this->render('formatters/index', [
            'formatters' => $formatters,
        ]);
    }

    public function create($request, $response, $args)
    {
        $params = $request->getParams();

        if ($formatterTypeId = @$params['formatter_type_id']) {

            $formatterTypeClassName = $this->getClassNameByType($formatterTypeId);
            $formatterFields = $formatterTypeClassName::getFields();

            return $this->render('formatters/create', [
                'formatter_fields' => $formatterFields,
                'params' => $params,
            ]);
        } else {

            $formatterTypes = $this->getFormatterTypes();

            return $this->render('formatters/create', [
                'formatter_types' => $formatterTypes,
                'params' => $params,
            ]);
        }

        return $this->render('formatters/create', [
            'params' => $request->getParams(),
        ]);
    }

    public function insert($request, $response, $args)
    {
        // create content type in db
        $params = $request->getParams();

        $formatter = Formatter::create(array_merge($params, [
            'options' => json_encode($params['options'])
        ]));

        $router = $this->getContainer()['router'];
        return $this->redirect($router->pathFor('formatters'));
    }

    public function edit($request, $response, $args)
    {
        $formatter = Formatter::findOrFail($args['id']);

        // build params for the form fields
        $params = $formatter->toArray();
        $params['options'] = json_decode($formatter->options, true);

        $formatterTypeClassName = $this->getClassNameByType($formatter->formatter_type_id);
        $formatterFields = $formatterTypeClassName::getFields();

        return $this->render('formatters/edit', [
            'formatter' => $formatter, // "formatter" is reserved in foil
            'formatter_fields' => $formatterFields,
            'params' => $params, // required for shared fields partial
        ]);
    }

    public function update($request, $response, $args)
    {
        $formatter = Formatter::findOrFail($args['id']);
        $params = $request->getParams();

        // create content type in db
        $formatter->update(array_merge($params, [
            'options' => json_encode($params['options'])
        ]));

        $router = $this->getContainer()['router'];
        return $this->redirect($router->pathFor('formatters'));
    }

    /**
     * Return an instance with the initializer data provided
     * @param array $options
     * @param array $state
     * @return mixed
     */
    protected function getInstance($data)
    {
        $className = $this->getClassNameByType($data->formatter_type_id);
        return new $className(json_decode($data->options));
    }

    /**
     * Get formatter by type
     */
     protected function getClassNameByType($formatterTypeId)
     {
         $formatterTypes = $this->getFormatterTypes();

         return $formatterTypes[$formatterTypeId];
     }

     /**
      * Get formatter by type
      */
      protected function getFormatterTypes()
      {
          $container = $this->getContainer();
          return $container->get('settings')['formatters'];
      }
}
