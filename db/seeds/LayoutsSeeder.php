<?php

use Phinx\Seed\AbstractSeed;

class LayoutsSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'name' => 'Foundation 6 Basic',
                'description' => '',
                'template' => '<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ meta.page_title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.0/css/foundation.min.css" />
</head>
<body>
    {{{content}}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/what-input/4.0.6/what-input.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.0/css/js/foundation.js"></script>
</body>
</html>',
            ],
        ];

        $folders = $this->table('layouts');
        $folders->insert($data)->save();
    }
}
