<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 07/02/2019
 * Time: 19:03
 */

namespace justjob\model;


class reservationTransport extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'user';
    protected $primaryKey = 'idtransport';
    public $timestamps = false;
}