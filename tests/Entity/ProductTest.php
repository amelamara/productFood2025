<?php
namespace App\Tests\Entity;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;
class ProductTest extends TestCase{
	public function testFood(){
        $product = new Product('Pomme', 'food', 1);
        $this->assertSame(0.055, $product->computeTVA());
    }

    public function testNoFood(){
        $product = new Product('Pomme', 'fruit', 1);
        $this->assertSame(0.196, $product->computeTVA());
    }

    public function testExcept(){
        $product = new Product('Pomme', 'food', -1);
        $this->expectException("Exception");
        $product->computeTVA();
    }

    /**
    *@dataProvider pricesForFood
    */
    public function testMultiFood($prix,$tva){
        $product = new Product('Pomme', 'food', $prix);
        $this->assertSame($tva, $product->computeTVA());
    }

    public function pricesForFood(){
        return [[0,0.0],[1,0.055],[10,0.55],[20,1.1]];
    }
}
?>
