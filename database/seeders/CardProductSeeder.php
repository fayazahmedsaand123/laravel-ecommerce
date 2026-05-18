<?php

namespace Database\Seeders;

use App\Models\CardProduct;
use Illuminate\Database\Seeder;

class CardProductSeeder extends Seeder
{
    public function run()
{
    $products = [
        ['user_id'=>6,'name'=>'Asus Vivbook','price'=>200,'image'=>'asus.jpeg','description'=>'ASUS Vivobook ideal for study and daily work.'],
        ['user_id'=>6,'name'=>'Iphone 16','price'=>400,'image'=>'mobile.webp','description'=>'iPhone 16 featuring advanced technology and premium build.'],
        ['user_id'=>6,'name'=>'Hp pavilion','price'=>300,'image'=>'hp.jpg','description'=>'HP Pavilion laptop with smooth performance.'],
        ['user_id'=>6,'name'=>'Acer laptop','price'=>450,'image'=>'acer.jpeg','description'=>'Acer laptop offering smooth performance.'],
        ['user_id'=>6,'name'=>'samsung s24 ultra','price'=>320,'image'=>'samsung.webp','description'=>'Camera: 200MP main sensor.'],
        ['user_id'=>6,'name'=>'Microsoft Laptop','price'=>410,'image'=>'microsoft.avif','description'=>'Microsoft laptop with premium build quality.'],
        ['user_id'=>6,'name'=>'Oppo Mobile','price'=>100,'image'=>'oppo.webp','description'=>'Oppo Mobile with excellent camera.'],
        ['user_id'=>6,'name'=>'infinix hot 50 pro','price'=>120,'image'=>'infinix.jpg','description'=>'6.78-inch 120Hz AMOLED display.'],
        ['user_id'=>6,'name'=>'Desktop Computer','price'=>140,'image'=>'desktop.jpg','description'=>'Programmable electronic device.'],
        ['user_id'=>6,'name'=>'Oppo Reno 10','price'=>200,'image'=>'reno.webp','description'=>'64 MP main camera.'],
        ['user_id'=>6,'name'=>'Mens Digital Watch','price'=>300,'image'=>'watch.jpg','description'=>'Ultra-thin waterproof watch.'],
        ['user_id'=>6,'name'=>'Luxury Watch','price'=>200,'image'=>'luxury.webp','description'=>'High-end handcrafted Swiss-made movement.'],
        ['user_id'=>6,'name'=>'Nike black air max','price'=>100,'image'=>'niks.jpg','description'=>'Nike Air Max shoes line.'],
        ['user_id'=>6,'name'=>'dark navy blue shalwar kameez','price'=>100,'image'=>'shalwar.jpg','description'=>'Versatile traditional wear.'],
        ['user_id'=>6,'name'=>'Slim Laptop Backpack','price'=>110,'image'=>'bag.jpg','description'=>'Lightweight minimalist backpack.'],
        ['user_id'=>6,'name'=>'Hottu Bh03 bluetooth headphone','price'=>104,'image'=>'headphone.webp','description'=>'Wireless Bluetooth headphone.'],
    ];

    foreach ($products as $product) {
        CardProduct::create($product);
    }
}
}