<?php
namespace App\Repositories;

use Cart;
use App\Models\Order;
use App\Contracts\OrderContract;
use App\Models\OrderItem;

class OrderRepository extends BaseRepository implements OrderContract
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function storeOrderDetails($params)
    {
        $order = Order::create([
            'order_number'      => 'ORD-'.strtoupper(uniqid()),
            'user_id'           => auth()->user()->id,
            'status'            => 'pending',
            'grand_total'       => Cart::getSubTotal(),
            'item_count'        => Cart::getTotalQuantity(),
            'payment_status'    => 0,
            'paymenr_method'    => null,
            'first_name'        => $params['first_name'],
            'last_name'         => $params['last_name'],
            'address'           => $params['address'],
            'city'              => $params['city'],
            'country'           => $params['country'],
            'post_code'         => $params['post_code'],
            'phone_number'      => $params['phone_number'],
            'notes'             => $params['notes'],

        ]);

        if ($order) {

            $items = Cart::getContent();

            foreach ($items as $item) {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                //$product = Product::where('name', $item->name)->first();

                $orderItem = new OrderItem([
                    'product_id'    => $item->associatedModel->id,
                    'quantity'      => $item->quantity,
                    'price'         => $item->price,
                ]);

                $order->items()->save($orderItem);
            }
        }

        return $order;

    }

    public function listOrders(String $order= 'id', string $sort ='desc', array $column=['*'])
    {
        return $this->all($column, $order, $sort);
    }

    public function findOrderByNumber($orderNumber)
    {
        return Order::where('order_number', $orderNumber)->first();
    }
}
?>
