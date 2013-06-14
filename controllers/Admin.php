<?php

class Controller_Admin extends Controller
{
    public function __construct($params = NULL, $map = NULL)
    {
        parent::__construct($params, $map);

        $this->view->assign('sidebar', $this->_getSidebarContent());

    }

    public function action_login()
    {
        $login_btn = $this->getPost('login_btn');
        if (isset($login_btn))
        {
            $login = $this->getPost('login');
            $password = $this->getPost('password');

            if ($login == 'admin' && $password == 'admin')
            {
                $this->setCookie('login', TRUE);
            }

            $this->redirectTo('/admin/index');
        }
        $this->view->assign('type', 'login');
        $this->view->draw('index');
    }

    public function action_logout()
    {
        $this->deleteCookie('login');

        $this->redirectTo('/admin/login');
    }

    public function action_index()
    {
        $this->_isLogin('/admin/login');

        $this->redirectTo('/admin/list');
    }

    public function action_list()
    {
        $this->_isLogin('/admin/login');

        $prepared = array();
        $blogList = Model::factory('Blog')->order_by_desc('id')->find_many();

        foreach($blogList as $k => $v)
        {
            $prepared[$k] = $v->as_array();
            $prepared[$k]['comments'] = $v->comments()->find_many();
        }

        $this->view->assign('list', $prepared);
        $this->view->draw('index');
    }

    public function action_add()
    {
        $e = Model::factory('Blog')->create();

        $e->title = $this->getPost('title');
        $e->content = $this->getPost('content');

        $e->created_at = date("Y-m-d H:i:s");

        $e->save();
    }

    public function action_update()
    {
        $this->_isLogin('/admin/login');

        $entry = Model::factory('Blog')->find_one($this->getPost('entry_id'));

        $entry->content = $this->getPost('content');

        $entry->save();
    }

    public function action_remove_entry()
    {
        $this->_isLogin('/admin/login');

        Model::factory('Blog')->find_one($this->getPost('entry_id'))->delete();
    }

    public function action_remove_comment()
    {
        $this->_isLogin('/admin/login');

        Model::factory('Comment')->find_one($this->getPost('comment_id'))->delete();
    }

    protected function _getSidebarContent()
    {
        $prepared = array();

        $lastEntries = Model::factory('Blog')->limit(3)->find_many();
        foreach($lastEntries as $k => $v)
        {
            $prepared[] = $v->as_array();
        }

        return $prepared;
    }

    protected function _isLogin($location)
    {
        $login = $this->getCookie('login');

        if (! isset($login))
        {
            $this->redirectTo($location);
        }
    }

}