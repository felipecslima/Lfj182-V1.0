<?php

class Adm_ConfigController extends ZC_Controller_Action {

    public function init() {
        parent::init();
    }

    public function indexAction() {
        $this->_data['ID'] = 1;
        $this->view->TABELA = 'conf_site';
        $this->inserealterapagina(new Adm_Form_SiteConf(), new Db_Config(), '/adm/config/', true, '', false,false);
    }

}