<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data['title'] = 'Home';
        echo view('templates/header', $data);
        echo view('welcome', $data);
        echo view('templates/footer',$data);
    }

    public function view($page = 'welcome.php')
    {
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        if(session()->get('isLoggedIn') === null) {
            session()->set('isLoggedIn', FALSE);
        }
        echo view('templates/header', $data);
        echo view('pages/' . $page, $data);
        echo view('templates/footer', $data);
    }
}
