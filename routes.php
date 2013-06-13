<?php

return array(
    '!^\/([\w]+)$!' => array('controller' => 'Hello', // имя контроллера (из ROOT_DIR/controllers)
                        'action' => 'index',        // имя экшена в контроллере
                        'params' => array(1, 1)),     // проецирование групп паттерна на параметры (в данном случае будет 2 параметра - 1 => ([\w]+), 2 => ([\w]+). Т.е. парамертр №1 ссылается на первое совпадение паттерна, и №2 тоже ссылается на первое совпадение паттеран
    '!^\/$!' => array('controller' => 'Blog',
                        'action' => 'index',
                        'params' => array()),
    '!^\/blog\/([\d]+)$!' => array('controller' => 'Blog',
        'action' => 'view',
        'params' => array(1)),
    '!^\/login$!' => array('controller' => 'Admin',
        'action' => 'login',
        'params' => array(1)),
);