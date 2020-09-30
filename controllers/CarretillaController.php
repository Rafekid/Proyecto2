<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 8/23/2020
 * Time: 8:39 PM
 */

class CarretillaController
{

    private $COOKIE_CART = "COOKIE_CART";
    public static $instance;

    public static function instance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function agregarCarretilla($productoId, $cantidad){
        $is_already = false;
        $carretilla = $this->getCarretilla();
        foreach ($carretilla as &$item){
            if($item->producto->IdProducto == $productoId){
                $item->cantidad += $cantidad;
                $is_already = true;
                break;
            }
        }

        if (!$is_already) {
            $producto =  ProductoController::instance()->getProduct($productoId);
            $carretilla[] = new CarretillaItem(uniqid(), $producto, $cantidad);
        }

        setcookie($this->COOKIE_CART, serialize($carretilla), time() + (86400 * 30), "/");
    }

    public function vaciarCarretilla(){
        setcookie($this->COOKIE_CART, serialize([]), time() + (86400 * 30), "/");
    }


    public function eliminarCarretilla($item_id){
        $carretilla = $this->getCarretilla();

        foreach ($carretilla as $key => $item){
            if($item->id == $item_id){
                unset($carretilla[$key]);
            }
        }

        setcookie($this->COOKIE_CART, serialize($carretilla), time() + (86400 * 30), "/");
    }

    public function actualizarCarretilla($item_id, $cantidad){
        $carretilla = $this->getCarretilla();

        foreach ($carretilla as $key => &$item){
            if($item->id == $item_id){
                $item->cantidad = $cantidad;
            }
        }
        
        setcookie($this->COOKIE_CART, serialize($carretilla), time() + (86400 * 30), "/");
    }

    public function getCarretilla(){

        if(!isset($_COOKIE[$this->COOKIE_CART])) {
            return [];
        } else {
            return unserialize($_COOKIE[$this->COOKIE_CART]);

        }
    }

    public function getTotales(){
        $carretilla = $this->getCarretilla();
        $total = 0;
        $articulos = 0;

        foreach ($carretilla as $item){
            $total += $item->cantidad * $item->producto->Precio;
            $articulos += $item->cantidad;
        }

        return [
            "total" => $total,
            "articulos" => $articulos,
        ];
    }
}