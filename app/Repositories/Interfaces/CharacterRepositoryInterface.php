<?php


namespace App\Repositories\Interfaces;
use App\Models\Anime;
use App\Models\Character;

interface CharacterRepositoryInterface
{
    public function all();

    public function getByAnime(Anime $anime);

    public function create(Character $character);

    public function getById($id);

    public function update($id, Character $character);

    public function delete($id);
}
