<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([
            [
                'product_name' => 'Thức Ăn Hạt Cho Mèo Trưởng Thành Nuôi Trong Nhà Royal Canin Indoor 27',
                'description' => 'Thức ăn cho mèo Royal Canin Indoor sẽ là sự lựa chọn phù hợp với bé cưng của bạn. 
                                Được thiết kế với mức độ calo vừa phải, hạt Royal Canin giúp mèo hạn chế tăng trọng lượng. 
                                Các sợi psyllium và các chất đạm dễ tiêu hóa có trong thức ăn cũng giúp loại bỏ búi lông trong bụng 
                                và giảm thiểu mùi hôi khó chịu trong hộp cát. Thức ăn Royal Canin với dạng hạt khô độc đáo còn giúp mèo 
                                giảm sự tích tụ của cao răng và mảng bám.',
                'price' => 115000,
                'image' => 'smartphone.jpg',
                'category_id' => 2,
                'quantity' => 50,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Hạt Ganador Adult Cho Chó Trưởng Thành Vị Gà Quay',
                'description' => 'Công thức sản phẩm là tâm huyết nghiên cứu của các chuyên gia dinh dưỡng vật nuôi hàng đầu tại Pháp với 
                                mong muốn cung cấp cho chó cưng hàm lượng dinh dưỡng cân bằng và đầy đủ nhất, giúp chúng có một cuộc sống thật khỏe mạnh và năng động.
                                Mỗi sản phẩm của chúng tôi được sản xuất từ những nguyên liệu chất lượng cao như thịt thật và gạo/cơm, tuân thủ nghiêm ngặt hệ thống tiêu
                                chuẩn quốc tế của Ngành sản xuất thức ăn Chăn nuôi Hoa Kỳ (AAFCO).',
                'price' => 18500,
                'image' => 'laptop.jpg',
                'category_id' => 1,
                'quantity' => 30,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Dây Dắt Kèm Vòng Cổ Họa Tiết Cho Chó Mèo',
                'description' => 'Dây Dắt Kèm Vòng Cổ Nhiều Kiểu Cho Chó Mèo <8kg',
                'price' => 60000,
                'image' => 'headphones.jpg',
                'category_id' => 3,
                'quantity' => 100,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
