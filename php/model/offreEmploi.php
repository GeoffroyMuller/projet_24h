<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/02/2019
 * Time: 10:23
 */

namespace justjob\model;


class offreEmploi extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'offreemploi';
    protected $primaryKey = 'id';
    public $timestamps = false;
}