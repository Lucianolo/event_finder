<?php
    
    namespace App;
    use Illuminate\Database\Eloquent;

    class Subscribers extends Eloquent{
        protected $table = 'users';
        protected $fillable = array('email');
    }
?>