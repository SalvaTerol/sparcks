<?php

namespace App\Livewire;

use App\Models\Restaurant;
use App\Models\Restaurante;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Booking extends Component
{
    public $restaurantList = [
        /*[
            'name' => 'Todos los restaurantes',
            'id' => '0',
        ],*/
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
    public $turnList =[
        ['id' => 1, 'name' => 'Comida'],
        ['id' => 2, 'name' => 'Cena'],
    ];
    public $maxPersons = 10;
    public $response = null;
    public $days = null;
    public $showHours = false;
    public $rand;
    public $hours;
    #[Validate]
    public $status = [
        'restaurant' => null,
        'date' => null,
        'turn' => null,
        'persons' => null,
    ];


    public function rules()
    {
        return [
            'status.restaurant' => 'required',
            'status.turn' => 'required',
            'status.persons' => 'required|numeric|min:1|max:'.$this->maxPersons,
        ];
    }
    public function quedan21DiasEnElMes()
    {
        $hoy = Carbon::now();
        $finDeMes = Carbon::now()->endOfMonth();
        $diferencia = $hoy->diffInDays($finDeMes, false);

        return $diferencia === 21;
    }
    public function checkDays()
    {
        $this->validate();
        if(!$this->quedan21DiasEnElMes()){
            $response = $this->getDays();
            $days = $response['days'];
            $respondeNextMonth = $this->getDays(Carbon::now()->addMonth()->startOfMonth()->format('Y-m-d'));
            $days = $days + $respondeNextMonth['days'];
        }else{
            $response = $this->getDays();
            $days = $response['days'];
        }
        $this->days = collect($days)->take(21);
        $this->rand = rand(1,999);
    }
    public function getDays($currentDate = null)
    {
        $url = 'https://www.covermanager.com/Reserve/getAvailabilityDaysByGroup/188/spanish';
        $data = [
            'currentDate' => $currentDate ?? Carbon::now()->format('Y-m-d'),
            'restaurant' => $this->status['restaurant'],
            'turn' => $this->status['turn'],
            'peoples' => $this->status['persons'],
        ];

        $respuesta = Http::post($url, $data);

        if ($respuesta->successful()) {
            return $respuesta->json();
        } else {
            //Pendiente de revisar
            return response()->json(['error' => 'Hubo un problema con la petición'], 500);
        }
    }

    public function checkHours($day)
    {
        $this->status['date'] = $day;
        $response = $this->getHours();
        $this->response = $response['info'][0];
        $this->hours = $this->response['hoursAvailable'];
        $this->showHours = true;
    }

    public function getHours()
    {
        $url = 'https://www.covermanager.com/Reserve/getAvailabilityHours/188/spanish';
        $data = [
            'date' => $this->status['date'],
            'restaurant' => $this->status['restaurant'],
            'turn' => $this->status['turn'],
            'peoples' => $this->status['persons'],
        ];

        $respuesta = Http::post($url, $data);

        if ($respuesta->successful()) {
            return $respuesta->json();
        } else {
            //Pendiente de revisar
            return response()->json(['error' => 'Hubo un problema con la petición'], 500);
        }
    }

    public function render()
    {
        return view('livewire.booking');
    }
}
