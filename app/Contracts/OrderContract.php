<?php
namespace App\Contracts;

interface OrderContract
{
    public function storeOrderDetails($params);

    public function listOrders(String $order= 'id', string $sort ='desc', array $column=['*']);

    public function findOrderByNumber($orderNumber);
}

?>
