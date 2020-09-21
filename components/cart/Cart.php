<?php


namespace Components\Cart;


use App\Models\Pizza;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;

class Cart
{
    protected $session;
    protected $name = 'cart.default';
    protected $model;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function getName()
    {
        return $this->name;
    }

    public function all()
    {
        return $this->getCart();
    }

    public function count($totalItems = true)
    {
        $items = $this->getCart();

        if (!$totalItems) {
            return $items->count();
        }

        $count = 0;

        foreach ($items as $row) {
            $count += $row->qty;
        }

        return $count;
    }

    public function total()
    {
        return $this->totalPrice();
    }

    public function totalPrice()
    {
        $total = 0;

        $cart = $this->getCart();

        if ($cart->isEmpty()) {
            return $total;
        }

        foreach ($cart as $row) {
            $total += $row->qty * $row->price;
        }

        return $total;
    }

    public function add($id, $name, $quantity, $price, $currency)
    {
        $cart = $this->getCart();

        $row = $this->addRow($id, $name, $quantity, $price, $currency);

        return $row;
    }

    public function update($rawId, $qty)
    {
        if (!$row = $this->get($rawId)) {
            throw new \Exception('Item not found.');
        }

        $cart = $this->getCart();

        $raw = $this->updateQty($rawId, $qty);

        return $raw;
    }

    public function remove($rawId)
    {
        if (!$row = $this->get($rawId)) {
            return true;
        }

        $cart = $this->getCart();

        $cart->forget($rawId);

        $this->save($cart);

        return true;
    }

    public function get($rawId)
    {
        $row = $this->getCart()->get($rawId);

        return null === $row ? null : new CartItem($row);
    }

    public function destroy()
    {
        $cart = $this->getCart();

        $this->save(null);

        return true;
    }

    protected function getCart()
    {
        $cart = $this->session->get($this->name);

        if(!($cart instanceof Collection))
            return new Collection();

        return $cart->transform(function($item){
            $item->price = Pizza::findOrFail($item->id)->price;
            $item->total = $item->price * $item->qty;
            $item->currency = session()->get('currency', 'usd');

            return $item;
        });
    }

    protected function addRow($id, $name, $qty, $price, $currency)
    {
        if(!is_numeric($qty) || $qty < 1) {
            throw new \Exception('Invalid quantity.');
        }

        if(!is_numeric($price) || $price < 0) {
            throw new \Exception('Invalid price.');
        }

        $cart = $this->getCart();

        $rawId = $this->generateRawId($id);

        if ($row = $cart->get($rawId)) {
            $row = $this->updateQty($rawId, $row->qty + $qty);
        } else {
            $row = $this->insertRow($rawId, $id, $name, $qty, $price, $currency);
        }

        return $row;
    }

    protected function generateRawId($id)
    {
        return md5($id);
    }

    protected function save($cart)
    {
        $this->session->put($this->name, $cart);

        return $cart;
    }

    protected function insertRow($rawId, $id, $name, $qty, $price, $currency)
    {
        $newRow = $this->makeRow($rawId, $id, $name, $qty, $price, $currency);

        $cart = $this->getCart();

        $cart->put($rawId, $newRow);

        $this->save($cart);

        return $newRow;
    }

    protected function updateRow($rawId, array $attributes)
    {
        $cart = $this->getCart();

        $row = $cart->get($rawId);

        foreach ($attributes as $key => $value) {
            $row->put($key, $value);
        }

        if (count(array_intersect(array_keys($attributes), ['qty', 'price']))) {
            $row->put('total', $row->qty * $row->price);
        }

        $cart->put($rawId, $row);

        return $row;
    }

    protected function updateQty($rawId, $qty)
    {
        if ($qty <= 0) {
            return $this->remove($rawId);
        }

        return $this->updateRow($rawId, ['qty' => $qty]);
    }

    protected function makeRow($rawId, $id, $name, $qty, $price, $currency)
    {
        return new CartItem([
            '__raw_id' => $rawId,
            'id' => $id,
            'name' => $name,
            'qty' => $qty,
            'price' => $price,
            'total' => $qty * $price,
            '__model' => $this->model,
            'currency' => $currency
        ]);
    }

    public function isEmpty()
    {
        return $this->count() <= 0;
    }
}
