<?php

namespace Database\Seeders;

use App\Models\CardProduct;
use Illuminate\Database\Seeder;

class CardProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name'=>'Asus Vivbook','price'=>200,'image'=>'asus.jpeg','description'=>'ASUS Vivobook ideal for study and daily work.'],
            ['name'=>'Iphone 16','price'=>400,'image'=>'mobile.webp','description'=>'iPhone 16 featuring advanced technology and premium build.'],
            ['name'=>'Hp pavilion','price'=>300,'image'=>'hp.jpg','description'=>'HP Pavilion laptop with smooth performance.'],
            ['name'=>'Acer laptop','price'=>450,'image'=>'acer.jpeg','description'=>'Acer laptop offering smooth performance.'],
            ['name'=>'samsung s24 ultra','price'=>320,'image'=>'samsung.webp','description'=>'Camera: 200MP main sensor.'],
            ['name'=>'Microsoft Laptop','price'=>410,'image'=>'microsoft.avif','description'=>'Microsoft laptop with premium build quality.'],
            ['name'=>'Oppo Mobile','price'=>100,'image'=>'oppo.webp','description'=>'Oppo Mobile with excellent camera.'],
            ['name'=>'infinix hot 50 pro','price'=>120,'image'=>'infinix.jpg','description'=>'6.78-inch 120Hz AMOLED display.'],
            ['name'=>'Desktop Computer','price'=>140,'image'=>'desktop.jpg','description'=>'Programmable electronic device.'],
            ['name'=>'Oppo Reno 10','price'=>200,'image'=>'reno.webp','description'=>'64 MP main camera.'],
            ['name'=>'Mens Digital Watch','price'=>300,'image'=>'watch.jpg','description'=>'Ultra-thin waterproof watch.'],
            ['name'=>'Luxury Watch','price'=>200,'image'=>'luxury.webp','description'=>'High-end handcrafted Swiss-made movement.'],
            ['name'=>'Nike black air max','price'=>100,'image'=>'niks.jpg','description'=>'Nike Air Max shoes line.'],
            ['name'=>'dark navy blue shalwar kameez','price'=>100,'image'=>'shalwar.jpg','description'=>'Versatile traditional wear.'],
            ['name'=>'Slim Laptop Backpack','price'=>110,'image'=>'bag.jpg','description'=>'Lightweight minimalist backpack.'],
            ['name'=>'Hottu Bh03 bluetooth headphone','price'=>104,'image'=>'headphone.webp','description'=>'Wireless Bluetooth headphone.'],
        ];

        foreach ($products as $product) {
            CardProduct::create($product);
        }
    }
}