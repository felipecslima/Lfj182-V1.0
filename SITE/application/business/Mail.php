<?php

class Business_Mail extends Zend_Mail {

    function __construct() {
        parent::__construct('UTF-8');
        $this->view = Zend_Registry::get('view');
    }

    protected function getMail() {
        return $this;
    }

    public function sendContato($data) {
      
        $data['MENSAGEM'] = nl2br($data['MENSAGEM']);
        $this->setFrom($data['EMAIL'], $data['NOME']);
        $this->addTo(Zend_Registry::get('oConfiguracao')->EMAIL);
        $this->setSubject(SITE_NAME . ' - Fale Conosco');
        $this->setBodyHtml($this->view->partial('/_includes/mail_faleconosco.phtml', $data));
        return $this->send();
    }

    public function sendSiteError($mensagem) {
        $oMail = new Zend_Mail('UTF-8');
        $oMail->addTo('adonai@libradesign.com.br', 'Adonai');
        $oMail->addTo('felipe@libradesign.com.br', 'Felipe');
        $oMail->setSubject("Erro - {$_SERVER['SERVER_NAME']}");
        $oMail->setBodyHtml($mensagem);
        $oMail->send();
    }

    public function sendSenha($oUsuario) {
        $this->setFrom($oUsuario->LOGIN, Zend_Registry::get('oConfiguracao')->TITULO);
        $this->addTo($oUsuario->EMAIL, $oUsuario->NOME);
        $this->setSubject(Zend_Registry::get('oConfiguracao')->TITULO . ' - Link Para Recuperar a Senha');
        $dbSenha = new Db_AclSenha();
        $dbSenha->inserePass($oUsuario);
        $oSenha = $dbSenha->fetchAll(array(), 'ID DESC')->current();
        $this->setBodyHtml($this->view->partial('/_includes/mail_recupera.phtml', array('oUsuario' => $oUsuario, "oSenha" => $oSenha)));
        return $this->send();
    }

}