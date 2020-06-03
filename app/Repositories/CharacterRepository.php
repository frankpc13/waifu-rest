<?php


namespace App\Repositories;


use App\Models\Anime;
use App\Models\Character;
use App\Repositories\Interfaces\CharacterRepositoryInterface;

class CharacterRepository implements CharacterRepositoryInterface
{

    public function all()
    {
        return Character::all();
    }

    public function getByAnime(Anime $anime)
    {
        return Character::where('anime.id'.$anime.id)->get();
    }

    public function create(Character $character)
    {
        $character->save();
        return $character;
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function update($id, Character $character)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        return Character::destroy($id) ? true : false;
    }
}
