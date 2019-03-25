<?php
// test1
	// function Car ($name){
	//   return function($statu)use($name){
	//     return sprintf("Car %s is %s ", $name, $statu); 
	//   };
	// }
	// // 将车名封装在闭包中
	// $car = Car("bmw");
	// dump($car);
	// // 调用车的动作
	// // 输出--> "bmw is running"
	// echo $car("running");
	// echo $car("swimming");

// test2
class Cart
{
    const PRICE_BUTTER  = 1.00;
    const PRICE_MILK    = 3.00;
    const PRICE_EGGS    = 6.95;

    protected $products = array();
    
    public function add($product, $quantity)
    {
        $this->products[$product] = $quantity;
    }
    
    public function getQuantity($product)
    {
        return isset($this->products[$product]) ? $this->products[$product] :
               FALSE;
    }
    
    public function getTotal($tax)
    {
        $total = 0.00;
        
        $callback =
            function ($quantity, $product) use ($tax, &$total)
            {	
            	dump($quantity);
            	dump($product);
                $pricePerItem = constant(__CLASS__ . "::PRICE_" . strtoupper($product));
            	dump($pricePerItem);
                $total += ($pricePerItem * $quantity) * ($tax + 1.0);
            };
        
        // $callback=function($item,$key)  like foreach(xx $key=>$item)
        array_walk($this->products, $callback);
        return round($total, 2);
    }
}

$my_cart = new Cart;

// Add some items to the cart
$my_cart->add('butter', 1);
$my_cart->add('milk', 3);
$my_cart->add('eggs', 6);

// Print the total with a 5% sales tax.
print $my_cart->getTotal(0.05) . "\n";



	function dump($info){
		echo "<pre>";
		var_dump($info);
		echo "</pre>";
	}
?>