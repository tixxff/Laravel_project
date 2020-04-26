<?php
namespace App;

class Cart{
    //attribute
    public $items; //Array
    public $totalQuantity; //จำนวนสินค้า
    public $totalPrice; //จำนวนรารวม
    //ราคาสินค้า = ราคาสินค้า * จำนวน
    //ex รองเท้า 2*1500 = 3000
    //เสื้อ 1*1200 = 1200

    //จำนวนรารวม = ราคารวมสินค้า + จำนวนสินค้าที่เราซื้อ

    public function __construct($prevCart){
        //old cart มีสินค้าอยู่แล้วลูกค้ามาซื้อซ้ำ
        if($prevCart != null){
            $this->items=$prevCart->items; //attribute don't put $
            $this->totalQuantity=$prevCart->totalQuantity;
            $this->totalPrice=$prevCart->totalPrice;
        }else{
            //new cart ไม่มีสินค้า
            $this->items=[];
            $this->totalQuantity=0;
            $this->totalPrice=0;
        }
        
    }

    public function addItem($id, $product){
        $price=(int)($product->price);
        if(array_key_exists($id, $this->items)){

            $productToAdd=$this->items[$id]; //check ว่า id ตรงกันกับสินค้าในตะกร้าไหม
            $productToAdd['quantity']++; //เพิ่มจำนวนรายการในสินค้านั้นๆ
            $productToAdd['totalSinglePrice']=$productToAdd['quantity']*$price;
        }else{
            $productToAdd = ['quantity'=>1, 'totalSinglePrice'=>$price, 'data'=>$product]; //totalSingle=ราคาสินค้านั้นๆ 
        }

        //assign ค่า
        $this->items[$id]=$productToAdd;
        $this->totalQuantity++;
        $this->totalPrice=$this->totalPrice+$price; //0 + 1500;
    }
}

?>