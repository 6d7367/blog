<?php

class Controller_Blog extends Controller
{
    public function __construct($params = NULL, $map = NULL)
    {
        parent::__construct($params, $map);

        $this->view->assign('sidebar', $this->_getSidebarContent());
    }
    public function action_index()
    {
        // передаю тип содержимого
        $this->view->assign('type', 'list'); // тип страницы

        // получаю список последних записей
        $this->view->assign('list', $this->_getLastContent());
        $this->view->draw('index');
    }

    public function action_view()
    {
        // если параметр entry_id не задан - проецирую карту на параметры
        if (! $this->getParam('entry_id'))
        {
            $map = array('entry_id' => 0);
            $this->_mapParams($this->params, $map);
        }

        $entry = Model::factory('Blog')->find_one((int)$this->getParam('entry_id'));
        $comments = $entry->comments()->find_many();

        $this->view->assign('type', 'view');
        $this->view->assign('content', $entry->as_array());
        $this->view->assign('comments', $comments);

        $this->view->draw('index');
    }

    public function action_comment()
    {
        $entry_id = (int)$this->getPost('entry_id');
        $author = $this->getPost('author');
        $title = $this->getPost('title');
        $content = $this->getPost('content');

        echo '1';

        if ((! empty($entry_id)) && (! empty($author)) && (! empty($content)) && (! empty($title)))
        {
            $c = Model::factory('Comment')->create();

            $c->entry_id = htmlentities($entry_id);
            $c->author = htmlentities($author);
            $c->title = htmlentities($title);
            $c->content = htmlentities($content);
            $c->created_at = date("Y-m-d H:i:s");

            try
            {
                $c->save();
            }
            catch(Exception $e)
            {
                echo '<pre>';
                echo $e;
                echo '</pre>';
                die;

            }
            $this->redirectTo('/blog/view/' . $entry_id);
        }
        else
        {
            $this->redirectTo('/');
        }

        echo '2';
    }

    protected function _getLastContent($offset = 0, $count = 10)
    {
        $prepared = array();

        $lastEntries = Model::factory('Blog')->order_by_desc('id')->offset($offset)->limit($count)->find_many();
        foreach($lastEntries as $k => $v)
        {
            $prepared[] = $v->as_array();
        }

        return $prepared;
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

    protected function _getComments($entry_id)
    {
        $prepared = array();
        $list = Model::factory('Comment')->where_equal('entry_id', $entry_id)->find_many();

        foreach($list as $k => $v)
        {
            $prepared[] = $v->as_array();
        }

        return $prepared;
    }

}