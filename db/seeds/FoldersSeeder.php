<?php

use Phinx\Seed\AbstractSeed;

class FoldersSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'name' => 'Martyn\'s site',
                'description' => '',
                'dir_name' => '',
                'menu_link' => 1,
                'active' => 1,
                'parent_id' => 0,
                'layout_id' => 1,
            ],
        ];

        $folders = $this->table('folders');
        $folders->insert($data)->save();
    }
}
