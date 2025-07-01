<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'img' => '614dc6865eb24.jpg',
                'name' => 'Nasi',
                'price' => 20000.00,
                'description' => 'ini nasi Goreng',
                'status' => 'tersedia',
                'category_id' => 1,
                'created_at' => '2024-11-17 13:34:52',
                'updated_at' => '2024-11-17 13:47:37'
            ],
            [
                'img' => '644d417a9c7ce.jpg',
                'name' => 'Ketoprak',
                'price' => 14000.00,
                'description' => 'ini ketoprak',
                'status' => 'tersedia',
                'category_id' => 1,
                'created_at' => '2024-11-17 13:54:45',
                'updated_at' => '2024-11-17 23:56:29'
            ],
            [
                'img' => 'gado-gado-MAHI.jpg', 
                'name' => 'Gado-Gado',
                'price' => 20000.00,
                'description' => 'ini gado gado',
                'status' => 'tersedia',
                'category_id' => 1,
                'created_at' => '2024-11-17 13:55:38',
                'updated_at' => '2024-11-17 13:55:38'
            ],
            [
                'img' => '6b191e82d3fd3c4b84a34a4eb3e5e90d.jpg',
                'name' => 'Bakmi Goreng',
                'price' => 15000.00,
                'description' => 'ini bakmi',
                'status' => 'tersedia', 
                'category_id' => 1,
                'created_at' => '2024-11-17 13:57:52',
                'updated_at' => '2024-11-17 13:57:52'
            ],
            [
                'img' => '61760aa9409df.jpg',
                'name' => 'Fuyunghai',
                'price' => 20000.00,
                'description' => 'ini fuyunghai',
                'status' => 'tersedia',
                'category_id' => 1,
                'created_at' => '2024-11-17 14:02:55',
                'updated_at' => '2024-11-17 14:02:55'
            ],
            [
                'img' => 'images.jpg',
                'name' => 'Koloke',
                'price' => 25000.00,
                'description' => 'ini koloke',
                'status' => 'tersedia',
                'category_id' => 1,
                'created_at' => '2024-11-17 14:08:19',
                'updated_at' => '2024-11-17 14:08:19'
            ],
            [
                'img' => 'Praktis-dan-Enak-Ini-Resep-Kwetiau-Goreng-Telur-yang-Lezat-.jpg',
                'name' => 'Kwuetiaw Goreng',
                'price' => 20000.00,
                'description' => 'ini Kwuetiaw',
                'status' => 'tersedia',
                'category_id' => 1,
                'created_at' => '2024-11-17 14:09:20',
                'updated_at' => '2024-11-17 14:09:20'
            ],
            [
                'img' => 'download.jpg',
                'name' => 'Nasi',
                'price' => 20000.00,
                'description' => 'nasi',
                'status' => 'tersedia',
                'category_id' => 1,
                'created_at' => '2024-11-17 14:09:47',
                'updated_at' => '2024-11-17 14:09:47'
            ],
            [
                'img' => 'images (1).jpg',
                'name' => 'Bihun Goreng',
                'price' => 15000.00,
                'description' => 'ini bihun',
                'status' => 'tersedia',
                'category_id' => 1,
                'created_at' => '2024-11-17 14:15:47',
                'updated_at' => '2024-11-17 14:15:47'
            ],
            [
                'img' => '5-ingredient-turbo-charged-spaghetti-recipe-196959-1.jpg',
                'name' => 'Spaghetti',
                'price' => 30000.00,
                'description' => 'ini spaghetti',
                'status' => 'tersedia',
                'category_id' => 1,
                'created_at' => '2024-11-17 14:16:56',
                'updated_at' => '2024-11-17 14:16:56'
            ],
            [
                'img' => '0af32d8b-36b7-4555-8e79-4fd54c98f795.jpeg',
                'name' => 'Es Teh',
                'price' => 8000.00,
                'description' => 'Minuman dingin yang menyegarkan terbuat dari teh pilihan dengan tambahan gula, cocok untuk teman makan siang',
                'status' => 'tersedia',
                'category_id' => 2,
                'created_at' => '2024-11-17 14:37:54',
                'updated_at' => '2024-11-17 14:37:54'
            ],
            [
                'img' => 'fakta-unik-latte-2.jpeg',
                'name' => 'coffie latte',
                'price' => 25000.00,
                'description' => 'Perpaduan kopi espresso dengan susu segar yang lembut, menghasilkan rasa creamy dan aromatik.',
                'status' => 'tersedia',
                'category_id' => 2,
                'created_at' => '2024-11-17 14:40:51',
                'updated_at' => '2024-11-17 14:40:51'
            ],
            [
                'img' => 'Cara-Mudah-dan-Praktis-Membuat-Jus-Semangka-Segar-Dirumah-1024x683.jpg',
                'name' => 'Jus Semangka',
                'price' => 20000.00,
                'description' => 'Jus buah semangka yang manis, dan disajikan dengan tambahan potongan semangka di atasnya',
                'status' => 'tersedia',
                'category_id' => 2,
                'created_at' => '2024-11-17 14:42:14',
                'updated_at' => '2024-11-17 14:42:14'
            ],
            [
                'img' => '634d11c2c0a21.jpg',
                'name' => 'Milkshake Cokelat',
                'price' => 22000.00,
                'description' => 'Minuman milkshake berbahan dasar es krim cokelat yang lembut, dikocok hingga menghasilkan tekstur creamy.',
                'status' => 'tersedia',
                'category_id' => 2,
                'created_at' => '2024-11-17 15:14:26',
                'updated_at' => '2024-11-17 15:14:26'
            ],
            [
                'img' => 'download (1).jpg',
                'name' => 'Air Mineral',
                'price' => 5000.00,
                'description' => 'Air minum dalam kemasan yang bersih dan segar, cocok untuk menghilangkan dahaga.',
                'status' => 'tersedia',
                'category_id' => 2,
                'created_at' => '2024-11-17 15:55:08',
                'updated_at' => '2024-11-17 15:55:08'
            ],
            [
                'img' => 'Screenshot_2023_0627_224324.png',
                'name' => 'Jus Melon',
                'price' => 20000.00,
                'description' => 'Jus buah melon yang segar dan menyehatkan',
                'status' => 'tersedia',
                'category_id' => 2,
                'created_at' => '2024-11-17 15:57:36',
                'updated_at' => '2024-11-17 15:57:36'
            ],
            [
                'img' => 'images (2).jpg',
                'name' => 'Smoothie Mangga',
                'price' => 20000.00,
                'description' => 'Minuman sehat yang terbuat dari buah mangga segar, di-blend hingga halus dengan tambahan es dan madu.',
                'status' => 'tersedia',
                'category_id' => 2,
                'created_at' => '2024-11-17 15:58:18',
                'updated_at' => '2024-11-17 15:58:18'
            ],
            [
                'img' => 'Capuccino.jpg',
                'name' => 'Cappucino',
                'price' => 27000.00,
                'description' => 'Kopi klasik dengan lapisan busa susu yang tebal, memberikan rasa kopi yang kuat dan creamy.',
                'status' => 'tersedia',
                'category_id' => 2,
                'created_at' => '2024-11-17 16:00:11',
                'updated_at' => '2024-11-17 16:00:11'
            ],
            [
                'img' => 'images (3).jpg',
                'name' => 'Es Jeruk',
                'price' => 10000.00,
                'description' => 'Perasan jeruk segar yang disajikan dengan es batu, memberikan rasa asam manis yang menyegarkan.',
                'status' => 'tersedia',
                'category_id' => 2,
                'created_at' => '2024-11-17 16:00:47',
                'updated_at' => '2024-11-17 16:00:47'
            ],
            [
                'img' => '1.-Resep-Brown-Sugar-Boba.jpg',
                'name' => 'Brown sugar milk',
                'price' => 25000.00,
                'description' => 'Minuman susu segar yang dicampur dengan sirup gula aren (brown sugar) yang karamel, memberikan rasa manis yang khas dan creamy.',
                'status' => 'tersedia',
                'category_id' => 2,
                'created_at' => '2024-11-17 16:02:27',
                'updated_at' => '2024-11-17 16:02:27'
            ],
            [
                'img' => 'Chocolate-Lava-Cake-Recipe.jpg',
                'name' => 'Chocolate Lava Cake',
                'price' => 35000.00,
                'description' => 'Kue cokelat hangat dengan bagian tengah yang meleleh, disajikan dengan es krim vanila di sampingnya.',
                'status' => 'tersedia',
                'category_id' => 3,
                'created_at' => '2024-11-17 16:17:03',
                'updated_at' => '2024-11-17 16:17:03'
            ],
            [
                'img' => '5fb9d3bd08788.jpg',
                'name' => 'Pudding Mangga',
                'price' => 18000.00,
                'description' => 'Puding berbahan dasar mangga segar, dengan tekstur lembut dan manis alami, disajikan dingin.',
                'status' => 'tersedia',
                'category_id' => 3,
                'created_at' => '2024-11-17 16:17:53',
                'updated_at' => '2024-11-17 16:17:53'
            ],
            [
                'img' => 'images (4).jpg',
                'name' => 'Tiramisu Cake',
                'price' => 30000.00,
                'description' => 'Dessert Italia berbahan dasar lapisan sponge cake yang direndam dalam kopi dan krim mascarpone, ditaburi bubuk cokelat.',
                'status' => 'tersedia',
                'category_id' => 3,
                'created_at' => '2024-11-17 16:18:40',
                'updated_at' => '2024-11-17 16:18:40'
            ],
            [
                'img' => '6122f43e6bbca.jpg',
                'name' => 'Cheesecake Stroberi',
                'price' => 40000.00,
                'description' => 'Kue lembut berbahan dasar keju krim, disajikan dengan saus stroberi segar di atasnya',
                'status' => 'tersedia',
                'category_id' => 3,
                'created_at' => '2024-11-17 16:19:43',
                'updated_at' => '2024-11-17 16:19:43'
            ],
            [
                'img' => 'images (5).jpg',
                'name' => 'Creme Brulee',
                'price' => 30000.00,
                'description' => 'Krim manis dengan lapisan karamel renyah di atasnya, dibakar hingga garing untuk memberikan tekstur yang kontras.',
                'status' => 'tersedia',
                'category_id' => 3,
                'created_at' => '2024-11-17 16:20:58',
                'updated_at' => '2024-11-17 16:20:58'
            ],
            [
                'img' => '5fe5b7689507e.jpg',
                'name' => 'Ice Cream Sundae',
                'price' => 22000.00,
                'description' => 'Es krim dengan topping sirup cokelat, kacang, dan buah ceri di atasnya, disajikan dalam gelas tinggi.',
                'status' => 'tersedia',
                'category_id' => 3,
                'created_at' => '2024-11-17 16:21:49',
                'updated_at' => '2024-11-17 16:21:49'
            ],
            [
                'img' => '640px-Banana_split_1.jpg',
                'name' => 'Banana Split',
                'price' => 28000.00,
                'description' => 'Pisang segar yang disajikan dengan tiga varian es krim dan dilengkapi dengan saus cokelat, whipped cream, dan kacang panggang.',
                'status' => 'tersedia',
                'category_id' => 3,
                'created_at' => '2024-11-17 16:27:20',
                'updated_at' => '2024-11-17 16:27:20'
            ],
            [
                'img' => 'images (6).jpg',
                'name' => 'Brownies with Ice Cream',
                'price' => 25000.00,
                'description' => 'Potongan brownies cokelat dengan tekstur fudgy, disajikan dengan es krim vanila.',
                'status' => 'tersedia',
                'category_id' => 3,
                'created_at' => '2024-11-17 16:28:05',
                'updated_at' => '2024-11-17 16:28:05'
            ],
            [
                'img' => 'horizontalparfaityogurt-copy.jpg',
                'name' => 'Fruit Parfait',
                'price' => 20000.00,
                'description' => 'Lapisan yogurt, granola, dan potongan buah segar yang cantik, cocok untuk pencuci mulut sehat.',
                'status' => 'tersedia',
                'category_id' => 3,
                'created_at' => '2024-11-17 16:28:48',
                'updated_at' => '2024-11-17 16:28:48'
            ],
            [
                'img' => 'jadgvsb_6df8606d-c845-4f75-b5e6-8e0323c1fd7c_900x900.jpg',
                'name' => 'Ice Cream Mochi',
                'price' => 15000.00,
                'description' => 'Kue mochi dengan isian es krim yang beragam rasa, memberikan sensasi kenyal dan dingin yang unik.',
                'status' => 'tersedia',
                'category_id' => 3,
                'created_at' => '2024-11-17 16:29:26',
                'updated_at' => '2024-11-17 16:29:26'
            ],
            [
                'img' => 'buah-potong-foto-resep-utama.jpg',
                'name' => 'Fruit Platter',
                'price' => 15000.00,
                'description' => 'Paduan buah segar seperti semangka, melon, nanas, dan pepaya yang dipotong kecil-kecil. Disajikan dingin untuk kesegaran maksimal, cocok sebagai pencuci mulut yang sehat dan ringan.',
                'status' => 'tersedia',
                'category_id' => 3,
                'created_at' => '2024-11-17 16:30:34',
                'updated_at' => '2024-11-17 16:30:34'
            ]
        ]);
    }
}
