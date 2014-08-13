<?php

class PaginaController extends ZC_Controller_Action {

    public $_data;
   
    #### BUSCA ######################################

    function buscaAction() {
        $dbPagina = new Db_PagPagina();
        ZC_Db_Filtro::setParam('BUSCA', $this->_data['BUSCA']);
        $this->view->vo = $dbPagina->fetchAll(array('pag_pagina.TIPO = ?' => 'noticia'))->paginator();
    }

    #### INSTITUCIONAL######################################

    function institucionalAction() {
        $dbPagina = new Db_PagPagina();
        try {
            if ($this->_data['permalink']) {
                $this->view->oPagina = $dbPagina->fetchRow(array('PERMALINK = ?' => $this->_data['permalink']));
            } else {
                $this->view->oPagina = $dbPagina->fetchRow(array('pag_pagina.ID = ?' => $this->_data['ID']));
            }
            if (!$this->view->oPagina) {
                throw new Exception;
            }
        } catch (Exception $exc) {
            throw new Zend_Controller_Action_Exception('A página que você deseja acessar não existe.', 404);
        }
        $this->_head->setTitle($this->view->oPagina->TITULO);
    }

    #### CONTATO ######################################

    function contatoAction() {
        $this->_head->setTitle("Contato");
        $dbPagina = new Db_PagPagina();
        $this->view->oPagina = $dbPagina->fetchRow(array('pag_pagina.ID = ?' => 2));
        if ($this->_request->isPost()) {
            $bMail = new Business_Mail();
            $bMail->sendContato($this->_data);
            ZC_Alerta::add('sucesso', 'Mensagem Enviada com sucesso!');
        }
    }

    #### NOTICIA ######################################

    function noticiaAction() {
        $dbPagina = new Db_PagPagina();
        $this->view->vo = $dbPagina->fetchAll(array('pag_pagina.TIPO = ?' => 'noticia'))->paginator();
        $this->_head->setTitle('Notícias');
    }

    function noticiadetalheAction() {
        $dbPagina = new Db_PagPagina();
        try {
            if ($this->_data['permalink']) {
                $this->view->oPagina = $dbPagina->fetchRow(array('PERMALINK = ?' => $this->_data['permalink']));
            } else {
                $this->view->oPagina = $dbPagina->fetchRow(array('pag_pagina.ID = ?' => $this->_data['ID']));
            }
            if (!$this->view->oPagina) {
                throw new Exception;
            }
        } catch (Exception $exc) {
            throw new Zend_Controller_Action_Exception('A página que você deseja acessar não existe.', 404);
        }
        $this->_head->setTitle($this->view->oPagina->TITULO);

    }

    function savecomentarioAction() {
        $db = new Db_PagComentario();
        $db->save($this->_data);
        $this->_redirect($this->_data['REDIRECT']);
    }

}
