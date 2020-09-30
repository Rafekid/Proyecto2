<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 8/23/2020
 * Time: 8:36 PM
 */

class CarretillaItem
{
    var $id = "";
    var $producto = null;
    var $cantidad = 0;

    /**
     * CarretillaItem constructor.
     * @param string $id
     * @param null $producto
     * @param int $cantidad
     */
    public function __construct($id, $producto, $cantidad)
    {
        $this->id = $id;
        $this->producto = $producto;
        $this->cantidad = $cantidad;
    }

}