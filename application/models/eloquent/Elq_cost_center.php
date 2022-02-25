<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Elq_cost_center extends Eloquent
{
    protected $table = 'abase_04_cost_center';
    public $timestamps = false;
}