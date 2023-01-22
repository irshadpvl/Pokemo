<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Sprite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PokemonController extends Controller
{
    protected $request;
    protected $log;
    protected $pokemon;
    protected $sprits;

    public function __construct(Request $request, Pokemon $pokemon, Sprite $sprite)
    {
        $this->pokemon = $pokemon;
        $this->sprits = $sprite;
        $this->request = $request;
    }

    public function index()
    {
        // $pokemon = $this->pokemon;
        // $pokemon = $pokemon->with('sprites')->paginate(50);
        // return $pokemon;
        return Pokemon::with('sprites')->get();
    }

    public function delete($id)
    {
        $message = "Deleted";

        $founded = DB::table("Pokemon")->where("id", "=", $id)->first();
        if ($founded == null)
            $message = "Record Not Found";

        DB::table('Pokemon')->where('id', '=', $id)->delete();

        return response()->json(compact("message"));
    }

    public function update(Request $request, $id)
    {

        $pokemon = $this->pokemon($id);

        $inputs = $request->all();
        $pokemon->name = $inputs['newName'];
        $pokemon->save();
        $message = "Updated";
        return response()->json(compact("message"));
    }

    public function pokemon($id)
    {
        $pokemon = $this->pokemon;
        return $pokemon->find($id);
    }
}
