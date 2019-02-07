<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/02/2019
 * Time: 11:15
 */

namespace justjob\model;


class Candidature extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'candidature';
    protected $primaryKey = 'id';
    public $timestamps = false;
}