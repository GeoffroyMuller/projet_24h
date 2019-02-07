<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/02/2019
 * Time: 09:54
 */


namespace justjob\model;

class Utilisateur extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;


}