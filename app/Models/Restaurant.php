<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Restaurant extends Model
{
    use Sushi;

    protected $rows = [
        [
            'name' => 'Todos los restaurantes',
            'id' => '0',
        ],
        [
            'name' => 'Voltereta, Bienvenido a Casa (Cortes Valencianas)',
            'id' => '1727',
        ],
        [
            'name' => 'Voltereta,  Bienvenido a Bali (Gran Via del Marqués del Túria)',
            'id' => '1728',
        ],
        [
            'name' => 'Voltereta Bienvenido a Manhattan  (Isabel la católica, 11)',
            'id' => '3758',
        ],
        [
            'name' => 'Voltereta Bienvenido a Kioto (Alameda 51)',
            'id' => '6254',
        ],
    ];


}
