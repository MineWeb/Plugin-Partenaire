<?php
Router::connect('/partenaire/', array('controller' => 'partenaire', 'action' => 'index', 'plugin' => 'Partenaire'));
Router::connect('/partenaire', array('controller' => 'partenaire', 'action' => 'index', 'plugin' => 'Partenaire'));
Router::connect('/partenaire_conf/', array('controller' => 'partenaire', 'action' => 'add_partenaire', 'plugin' => 'Partenaire'));

Router::connect('/admin/partenaire/partenaire', array('controller' => 'partenaire', 'action' => 'index', 'plugin' => 'Partenaire', 'admin' => true));
Router::connect('/admin/partenaire', array('controller' => 'partenaire', 'action' => 'index', 'plugin' => 'Partenaire', 'admin' => true));

Router::connect('/faq/ajax_get_partenaire/*', array('controller' => 'partenaire', 'action' => 'ajax_get_partenaire', 'plugin' => 'Partenaire'));

Router::connect('/admin/partenaire/ajax_save_partenaire', array('controller' => 'partenaire', 'action' => 'ajax_save_partenaire', 'plugin' => 'Partenaire', 'admin' => true));
Router::connect('/admin/partenaire/ajax_remove_partenaire', array('controller' => 'partenaire', 'action' => 'ajax_remove_partenaire', 'plugin' => 'Partenaire', 'admin' => true));