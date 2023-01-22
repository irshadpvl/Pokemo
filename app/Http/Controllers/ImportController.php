<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\Pokemon;
use App\Models\Sprite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Psy\Readline\Hoa\Console;

class ImportController extends Controller
{
    protected $data;
    protected $baseUrl = "https://pokeapi.co/api/v2/pokemon";
    public function __construct()
    {
    }

    public function index()
    {
        $pokomen = $this->fetchData("https://pokeapi.co/api/v2/pokemon?limit=151");
        $this->storePokemen($pokomen->results);
        $message = false;
        return response()->json(compact("message"));
    }

    public function storePokemen($pokomen)
    {
        $pokomenId = 1;

        foreach ($pokomen as $poko) {

            $tablePokemen = new Pokemon();
            $tablePokemen->name = $poko->name;
            $tablePokemen->url = $poko->url;
            $tablePokemen->save();

            $sprites = $this->fetchData("https://pokeapi.co/api/v2/pokemon/" . $pokomenId . "");

            $this->storeSprites($sprites->sprites, $pokomenId);
            $pokomenId++;
        }
    }


    public function storeSprites($sprits, $pokemonId)
    {
        $message = true;
        $tableSprit = new Sprite();
        $tableSprit->pokemon_id = $pokemonId;
        $tableSprit->back_default = (string)$sprits->back_default;
        $tableSprit->back_female = (string)$sprits->back_female;
        $tableSprit->back_shiny = (string)$sprits->back_shiny;
        $tableSprit->back_shiny_female = (string)$sprits->back_shiny_female;
        $tableSprit->front_default = (string)$sprits->front_default;
        $tableSprit->front_female = (string)$sprits->front_female;
        $tableSprit->front_shiny = (string)$sprits->front_shiny;
        $tableSprit->front_shiny_female = (string)$sprits->front_shiny_female;

        $tableSprit->save();
    }

    public function fetchData($url)
    {

        $response = Http::get($url);

        $data = json_decode($response->body());

        return $data;
    }
}
