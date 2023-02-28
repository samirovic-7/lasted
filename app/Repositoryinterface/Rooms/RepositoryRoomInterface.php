<?php
namespace App\Repositoryinterface\Rooms;

interface RepositoryRoomInterface{
    public function index();
     public function store($request);
     public function show($id);
     public function update($request, $id);
     public function destroy($id);
     public function geSoftDeletedData();
     public function restorDataTrashed($id);
}
