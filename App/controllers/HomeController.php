<?php
class HomeController extends BaseController
{

    public function sayHi()
    {


        $this->view(
            'main-layout',
            [
                'page' => 'home/index',
                'pageName' => 'Giới thiệu',

            ]
        );
    }
}
