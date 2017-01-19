<?php
/**
 * Created by PhpStorm.
 * User: Jeremie
 * Date: 16/01/2017
 * Time: 17:31
 */

namespace App\Controller\Gestion;
use App\Controller\Controller;

class ArticleController extends Controller {

    /**
     * Verification que tous les appels sont de l'ajax
     * ArticleController constructor.
     */
    function __construct(){
        if($this->isAjax()){
           $this->error(500);
        }
    }


    /**
     * Ajout d'un article
     */
    public function add(){

    }

    /**
     * Mis a jour d'un Article
     * @param $id
     */
    public function update($id){

    }
}