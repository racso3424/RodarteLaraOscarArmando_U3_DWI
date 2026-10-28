<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Database\Seeder;

class EcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Categorías
        $catAudio = Category::updateOrCreate(['slug' => 'audio'], [
            'name' => 'Audio & Auriculares',
            'icon' => '🎧',
        ]);

        $catWearables = Category::updateOrCreate(['slug' => 'wearables'], [
            'name' => 'Smartwatches & Wearables',
            'icon' => '⌚',
        ]);

        $catGaming = Category::updateOrCreate(['slug' => 'gaming'], [
            'name' => 'Gaming & Periféricos',
            'icon' => '🎮',
        ]);

        $catAccessories = Category::updateOrCreate(['slug' => 'accessories'], [
            'name' => 'Accesorios & Carga',
            'icon' => '⚡',
        ]);

        // 2. Productos
        $products = [
            [
                'category_id' => $catAudio->id,
                'title' => 'Aura Pro Wireless Headphones',
                'slug' => 'aura-pro-wireless-headphones',
                'short_desc' => 'Cancelación Activa de Ruido (ANC), Audio Espacial 360° y hasta 50h de autonomía.',
                'price' => 189.99,
                'old_price' => 239.99,
                'rating' => 4.90,
                'reviews_count' => 142,
                'badge' => 'sale',
                'badge_text' => '-20% OFF',
                'emoji' => '🎧',
                'stock' => 45,
                'is_featured' => true,
                'specs' => [
                    'Bluetooth 5.3 + Códec LDAC',
                    'Cancelación híbrida -42dB',
                    'Carga rápida USB-C',
                    'Almohadillas viscoelásticas transpirables',
                ],
            ],
            [
                'category_id' => $catWearables->id,
                'title' => 'Elite Watch Ultra 2',
                'slug' => 'elite-watch-ultra-2',
                'short_desc' => 'Caja de titanio aeroespacial, pantalla AMOLED Retina y sensores médicos de ECG y SpO2.',
                'price' => 249.99,
                'old_price' => 299.99,
                'rating' => 4.80,
                'reviews_count' => 98,
                'badge' => 'hot',
                'badge_text' => 'TOP VENTAS',
                'emoji' => '⌚',
                'stock' => 30,
                'is_featured' => true,
                'specs' => [
                    'Pantalla AMOLED 1.96" Always-On',
                    'Resistencia al agua 50m (5ATM)',
                    'GPS de doble frecuencia L1+L5',
                    'Batería con autonomía de hasta 7 días',
                ],
            ],
            [
                'category_id' => $catGaming->id,
                'title' => 'CyberDeck RGB Mechanical Keyboard',
                'slug' => 'cyberdeck-rgb-mechanical-keyboard',
                'short_desc' => 'Switches mecánicos lubricados de fábrica, chasis de aluminio CNC e iluminación RGB por tecla.',
                'price' => 129.99,
                'old_price' => null,
                'badge' => 'new',
                'badge_text' => 'NUEVO',
                'emoji' => '⌨️',
                'stock' => 50,
                'is_featured' => true,
                'specs' => [
                    'Conexión triple (2.4GHz / BT 5.2 / Cable tipo C)',
                    'Keycaps PBT Double-Shot perfil Cherry',
                    'Hot-swappable de 5 pines universal',
                    'Batería interna de litio de 4000mAh',
                ],
            ],
            [
                'category_id' => $catGaming->id,
                'title' => 'Vortex Pro Wireless Gaming Mouse',
                'slug' => 'vortex-pro-wireless-gaming-mouse',
                'short_desc' => 'Sensor óptico de 26,000 DPI, ultraligero de 58g y polling rate competitivo de 4000Hz.',
                'price' => 79.99,
                'old_price' => 99.99,
                'rating' => 4.70,
                'reviews_count' => 87,
                'badge' => 'sale',
                'badge_text' => '-20%',
                'emoji' => '🖱️',
                'stock' => 60,
                'is_featured' => false,
                'specs' => [
                    'Switches ópticos Gen 3 resistentes a 90M clics',
                    'Sensor PixArt PAW3395 flagship',
                    'Pies de teflón virgen 100% PTFE',
                    '80 horas de duración continua de juego',
                ],
            ],
            [
                'category_id' => $catAudio->id,
                'title' => 'PulseSound 360 Smart Speaker',
                'slug' => 'pulsesound-360-smart-speaker',
                'short_desc' => 'Altavoz inteligente con graves profundos en 360 grados, Wi-Fi, Bluetooth y asistente de voz.',
                'price' => 89.99,
                'old_price' => 119.99,
                'rating' => 4.60,
                'reviews_count' => 53,
                'badge' => 'sale',
                'badge_text' => 'OFERTA',
                'emoji' => '🔊',
                'stock' => 25,
                'is_featured' => false,
                'specs' => [
                    'Sonido omnidireccional acústico 40W',
                    'Certificación IPX7 resistente a inmersión',
                    'Emparejamiento estéreo True Wireless (TWS)',
                    'Halo de luz ambiental RGB reactivo al compás',
                ],
            ],
            [
                'category_id' => $catAccessories->id,
                'title' => 'TitanCharge MagSafe Powerbank 10K',
                'slug' => 'titancharge-magsafe-powerbank-10k',
                'short_desc' => 'Batería magnética inalámbrica con soporte plegable de aluminio y puerto USB-C PD 30W.',
                'price' => 49.99,
                'old_price' => null,
                'badge' => null,
                'badge_text' => '',
                'rating' => 4.90,
                'reviews_count' => 112,
                'emoji' => '🔋',
                'stock' => 75,
                'is_featured' => false,
                'specs' => [
                    'Capacidad real de 10,000 mAh',
                    'Carga inalámbrica Qi rápida 15W',
                    'Pantalla digital LED con porcentaje exacto',
                    'Carcasa de aluminio disipadora de calor',
                ],
            ],
            [
                'category_id' => $catAccessories->id,
                'title' => 'VisionStream 4K Pro Webcam',
                'slug' => 'visionstream-4k-pro-webcam',
                'short_desc' => 'Sensor Sony STARVIS 4K a 60fps con enfoque por IA y micrófonos duales con cancelación de ruido.',
                'price' => 119.99,
                'old_price' => 149.99,
                'rating' => 4.80,
                'reviews_count' => 41,
                'badge' => 'new',
                'badge_text' => 'NUEVO',
                'emoji' => '📷',
                'stock' => 35,
                'is_featured' => false,
                'specs' => [
                    'Resolución nativa 4K Ultra HD a 60 FPS',
                    'HDR dinámico adaptativo para baja luz',
                    'Tapa física mecánica de privacidad',
                    'Conexión USB 3.0 Plug & Play sin drivers',
                ],
            ],
            [
                'category_id' => $catAccessories->id,
                'title' => 'NeoPad RGB Charging Deskmat',
                'slug' => 'neopad-rgb-charging-deskmat',
                'short_desc' => 'Alfombrilla gamer XXL con superficie de microfibra de baja fricción y módulo de carga inalámbrica.',
                'price' => 39.99,
                'old_price' => null,
                'badge' => null,
                'badge_text' => '',
                'rating' => 4.70,
                'reviews_count' => 76,
                'emoji' => '⚡',
                'stock' => 90,
                'is_featured' => false,
                'specs' => [
                    'Dimensiones extra amplias 900 x 400 x 4 mm',
                    'Módulo Qi inalámbrico de 15W integrado',
                    '14 modos de iluminación RGB Chroma seleccionables',
                    'Base de caucho natural antideslizante',
                ],
            ],
        ];

        foreach ($products as $prodData) {
            Product::updateOrCreate(['slug' => $prodData['slug']], $prodData);
        }

        // 3. Cupones
        Coupon::updateOrCreate(['code' => 'DWIU3'], [
            'discount_percent' => 15,
            'min_spend' => 0,
            'is_active' => true,
        ]);

        Coupon::updateOrCreate(['code' => 'TECH10'], [
            'discount_percent' => 10,
            'min_spend' => 0,
            'is_active' => true,
        ]);

        Coupon::updateOrCreate(['code' => 'PROMO50'], [
            'discount_percent' => 50,
            'min_spend' => 200,
            'is_active' => true,
        ]);
    }
}
