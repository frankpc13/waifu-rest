<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Repositories\Interfaces\CharacterRepositoryInterface;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    //
    private $characterRepository;

    public function __construct(CharacterRepositoryInterface $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    public function index() {
        $characters = $this->characterRepository->all();
        return response()->json(
            [
                'message'=>"success",
                "httpStatus" => 200,
                "data" => $characters
            ],
            200);
    }

    public function create(Request $request) {
        if ($request->has(['name','image','birthdate','isActive'])){
            $data = $request->json()->all();
            //dd($data);
            $chara = new Character();
            $chara->name = $data['name'];
            $chara->image = $data['image'];
            $chara->birthdate = $data['birthdate'];
            $chara->isActive = $data['isActive'];
            $data = $this->characterRepository->create($chara);
            return response()->json([
                'httpStatus'=>201,
                'data'=>$data,
                'message'=>"success"
            ],201);
        } else {
            dd("Pendejo no hay esos cmapos");
        }
    }

    public function update(Request $request, $id) {
        $data = $request->json()->all();
        dd($data);
        //$this->characterRepository->update($id,$data);
    }

    public function delete(Request $request, $id) {
        $data = $this->characterRepository->delete($id);
        if ($data) {
            return response()->json([
                "message" => "delete success with id $id",
                "httpStatus" => 201,
                "data" => $data
            ]);
        } else {
            return response()->json([
                "message"=>"can't delete",
                "httpStatus"=>"400",
                "error"=>"cant find ID or bad input"
            ], 400);
        }
    }
}
