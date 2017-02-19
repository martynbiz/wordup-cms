<?php

use Phinx\Seed\AbstractSeed;

class ContentTypesSeeder extends AbstractSeed
{
    public function run()
    {
        $ctData = [
            [
                'name' => '1 Column',
                'description' => '',
                'template' => '<div class="row">
    <div class="medium-12">{{{ fields.column_1 }}}</div>
</div>',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => '2 Column (6-6)',
                'description' => '',
                'template' => '<div class="row">
    <div class="medium-6">{{{ fields.column_1 }}}</div>
    <div class="medium-6">{{{ fields.column_2 }}}</div>
</div>',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $ctfData = [
            // 1 column
            [
                [
                    'name' => 'Column 1',
                    'data_type' => 'html',
                    'field_name' => 'column_1',
                    'content_type_id' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                ],
            ],
            // 2 column
            [
                [
                    'name' => 'Column 1',
                    'data_type' => 'html',
                    'field_name' => 'column_1',
                    'content_type_id' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Column 2',
                    'data_type' => 'html',
                    'field_name' => 'column_2',
                    'content_type_id' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                ],
            ],
        ];

        $contentTypes = $this->table('content_types');
        $contentTypeFields = $this->table('content_type_fields');

        foreach ($ctData as $i => $values) {

            $contentTypes->insert($values)->save();

            // insert fields
            $fieldsData = $ctfData[$i];

            foreach($fieldsData as $values) {
                $values['content_type_id'] = $this->getAdapter()->getConnection()->lastInsertId();
                $contentTypeFields->insert($values)->save();
            }
        }
    }
}
