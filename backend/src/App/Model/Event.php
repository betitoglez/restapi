<?php
/**
 * Created by PhpStorm.
 * User: alberto
 * Date: 23/11/2016
 * Time: 21:24
 */

namespace App\Model;


class Event
{
    public $id;
    public $date;
    public $type;
    public $name;


    public function save()
    {
        if (!isset($this->id)){
            $this->id = $this->_getNewId();
        }
        $_SESSION['data'][$this->id] = $this->toArray();
    }

    public function remove()
    {
        unset($_SESSION['data'][$this->id]);
    }

    public static function find ($id)
    {
        isset($_SESSION['data'][$id])?$_SESSION['data'][$id]:false;
    }

    public static function all ()
    {
        return $_SESSION['data'];
    }

    private function _getNewId()
    {
        $aData = $_SESSION['data'];
        if (empty($aData))
            return 1;
        return max(array_keys($aData)) + 1;
    }

    public function toArray(){
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date' => $this->date,
            'type' => $this->type
        ];
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }
}