<?php

class Adm_Form_PagPagina extends ZC_Form {

    public function populate(array $values) {
        if ($this->getElement('UPLOAD')) {
            $this->getElement('UPLOAD')->setParam('ID', $values['ID']);
        }
        return parent::populate($values);
    }

    public function init() {
        $this->addAttribs(array('id' => 'formPagPagina'));
        $this->eHidden('ID');
        $this->eText('TITULO', 'Título:', true, 100, 80);
        $this->eText('RESUMO', 'Resumo:', false, 300, 80);
        $this->eText('YOUTUBE', 'Vídeo:', false, 100, 80)->setDescription('ex.: www.youtube.com/watch?v=dx0yreHVju4');
        $this->eTextarea('TEXTO', 'Texto:', true);
        $this->eData('DATA_INI', 'Data:', false);
        $this->addElement('Upload', 'UPLOAD')
                ->setPasta('/upload/arq_arquivo/')
                ->setAction('/adm/auxiliar/jupload/')
                ->setParam('TABELA', 'pag_pagina')
                ->setCallback('loadImagem();')
                ->setMulti(true)
                ->debug(true)
                ->setLabel('Imagem:');

        $this->eSubmit('ENVIAR', 'Enviar')->setAttrib('class', 'submit');
        $this->addDisplayGroup(array('ID', 'TITULO', 'CHAPEU', "RESUMO", "YOUTUBE", 'DATA_INI', "AUTOR", 'TEXTO', 'UPLOAD', 'ENVIAR'), 'groupDados', array('legend' => 'Dados'));
        $this->cSetDecoratorTable();
    }

}
