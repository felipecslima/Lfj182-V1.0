<?php

class Adm_PaginaController extends ZC_Controller_Action {

    protected $_data;

    public function init() {
        $this->_dbPagina = new Db_PagPagina();
        parent::init();
        $this->view->data = $this->_data;
    }

    public function indexAction() {
        ZC_Db_Filtro::setParam('TIPO', 'institucional');
        ZC_Db_Filtro::setParam('ID_PAI', '');
        $this->view->vo = $this->_dbPagina->fetchAll()->paginator();
        $this->view->subpagina = true;
        $this->view->title = 'Gerência de Páginas Institucionais';
        $this->render('lista');
    }

    public function inserealteraAction() {
        $bData = new ZC_Date();
        $form = new Adm_Form_PagPagina();
        $this->_data['DATA'] = $bData->toDb($this->_data['DATA']);
        $form->eHidden('ID_PAI', $this->_data['ID_PAI']);
        $this->inserealterapagina($form, $this->_dbPagina, '/adm/pagina/', false, 'institucional');
    }

    public function lockpaginaAction() {
        $this->disableLayout();
        try {
            $o = $this->_dbPagina->disableFiltro()->disablePadrao()->fetchRow(array("ID = ?" => $this->_data["ID"]));
            if ($o->FL_LOCK == 0) {
                $lock = 1;
            } else {
                $lock = 0;
            }
            $where = array(
                'FL_LOCK' => $lock,
            );
            $this->_dbPagina->update($where, array('ID = ?' => $this->_data["ID"]));
            $jData['success'] = true;
        } catch (Exception $exc) {
            $jData['success'] = false;
        }
        if ($this->_data['ajax']) {
            echo json_encode($jData);
        } else {
            $redirect = ($this->_data["redirect"]) ? $this->_data["redirect"] : '/adm/pagina/index';
            $this->_redirect($redirect);
        }
        exit;
    }

    #### VIDEO ###################

    public function videoAction() {
        ZC_Db_Filtro::setParam('TIPO', 'video');
        $this->view->vo = $this->_dbPagina->fetchAll(array(), 'ID DESC')->paginator();
        $this->view->title = 'Gerência de Vídeos';
        $this->render('lista');
    }

    public function inserealteravideoAction() {
        $form = new Adm_Form_PagPagina();
        $form->removeElements(array('RESUMO', 'CHAPEU', 'DATA', 'AUTOR', 'TEXTO'));
        $this->inserealterapagina($form, $this->_dbPagina, '/adm/pagina/video', false, 'video');
    }

    #### NEWSLETTER ###################

    public function newsletterAction() {
        $db = new Db_PagNewsletter;
        $this->view->vo = $db->fetchAll(array(), 'ID DESC')->paginator();
        $this->view->title = 'Gerência de Newsletter';
        $this->render('lista');
    }

    public function inserealteranewsletterAction() {
        $db = new Db_PagNewsletter;
        $form = new Adm_Form_PagNewsletter();
        $this->inserealterapagina($form, $db, '/adm/pagina/newsletter', false, 'newsletter');
    }

    #### BOLAO ###################

    public function jogoAction() {
        ZC_Db_Filtro::setParam('TIPO', 'jogo');
        $this->view->vo = $this->_dbPagina->fetchAll(array(), 'ID DESC')->paginator();
        $this->view->title = 'Gerência de Jogos';
        $this->render('lista');
    }

    public function inserealterajogoAction() {
        $oHeader = new Business_Head();
        $oHeader->jqueryUi();
        $oHeader->jCharCount();
        $oHeader->jTag();
        $this->view->TAGSV = true;
        $dbTag = new Db_TagTag();
        $form = new Adm_Form_PagPaginaNotJogo();
        $form->removeElements(array("ID_CATEGORIA", 'CHAPEU', 'TITULO', "TAG", 'RESUMO', "FONTE_VIDEO", 'YOUTUBE', 'AUTOR', 'TEXTO', 'UPLOAD', 'DATA_CADASTRO', 'DATA_INI', 'DATA_FIM', "HORA", 'LINK'));
        $this->inserealterapagina($form, $this->_dbPagina, '/adm/pagina/jogo', false, 'jogo');
    }

    #### GALERIAS ###################

    public function galeriaAction() {
        ZC_Db_Filtro::setParam('TIPO', 'galeria');
        $this->view->vo = $this->_dbPagina->fetchAll(array(), 'ID DESC')->paginator();
        $this->view->title = 'Gerência de Galeria de Imagens';
        $this->render('lista');
    }

    public function inserealteragaleriaAction() {
        $form = new Adm_Form_PagPagina();
        $form->removeElements(array('RESUMO', 'CHAPEU', 'DATA', 'AUTOR', 'TEXTO', 'YOUTUBE'));
        $this->inserealterapagina($form, $this->_dbPagina, '/adm/pagina/galeria', false, 'galeria');
    }

    #### EVENTO ###################

    public function eventoAction() {
        ZC_Db_Filtro::setParam('TIPO', 'evento');
        $this->view->vo = $this->_dbPagina->fetchAll(array(), 'ID DESC')->paginator();
        $this->view->title = 'Gerência de Eventos';
    }

    public function inserealteraeventoAction() {
        $form = new Adm_Form_PagPagina();
        $form->removeElements(array('CHAPEU', 'AUTOR', 'UPLOAD', 'YOUTUBE'));
        $this->inserealterapagina($form, $this->_dbPagina, '/adm/pagina/evento', true, 'evento');
    }

    #### INFORMATIVOS ###################

    public function informativoAction() {
        $this->view->title = 'Gerência de Informativos';
        ZC_Db_Filtro::setParam('TIPO', 'informativo');
        $this->view->vo = $this->_dbPagina->fetchAll(array(), 'ID DESC')->paginator();
        $this->render('lista');
    }

    public function inserealterainformativoAction() {
        $form = new Adm_Form_PagPagina();
        $form->removeElements(array('RESUMO', 'CHAPEU', 'DATA', 'AUTOR', 'TEXTO', 'YOUTUBE'));
        $this->inserealterapagina($form, $this->_dbPagina, '/adm/pagina/informativo', false, 'informativo');
    }

    #### MENU ###################

    public function menuAction() {
        ZC_Db_Filtro::setParam('TIPO', 'menu');
        $this->view->vo = $this->_dbPagina->fetchAll(array("ID_PAI IS NULL"), 'ID DESC')->paginator();
    }

    public function inserealteramenuAction() {
        if ($this->_data['ID']) {
            ZC_Db_Filtro::setParam('TIPO', 'menu');
            $this->view->o = $this->_dbPagina->fetchRow(array("ID = ?" => $this->_data['ID']));
        }
        $this->inserealterapagina(new Adm_Form_PagPaginaMenu(), $this->_dbPagina, '/adm/pagina/menu', true, 'menu', false, false);
    }

    public function importacaocsvAction() {
        $row = 0;
        $i = 0;
        if (($handle = fopen($_SERVER['DOCUMENT_ROOT'] . '/upload/importacao/arquivo.csv', "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                if ($row > 0) {
                    unset($data2);
                    foreach ($data as $oD) {
                        $data2[$index[$i]] = rtrim(rtrim($oD, '.'), "-");
                        $i++;
                        $i = ($i > 12) ? 0 : $i;
                    }
                    $os[] = $data2;
                } elseif ($row == 0) {
                    foreach ($data as $o) {
                        $nInd[] = rtrim(join("_", explode(".", $o)), "_");
                    }
                    $index = $nInd;
                }
                $row++;
            }
            fclose($handle);
            Business_Util::debug((object) $os);
        }
        die;
    }

    #### GERAL ###################

    public function excluirAction() {
        $redirect = $this->_data['move'] ? '/adm/pagina/' . $this->_data['move'] : null;
        parent::excluir($this->_dbPagina, $redirect);
    }

}
