<?php


class AlbumView {
    public function showAlbum($Albumes,$artistas) {
        $count = count($Albumes);

        // mostrar el template
        require 'templates/albumes.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
    public function showPantallaEditora($albumes){
        
        require 'templates/editar_albumes.phtml';
    }
}