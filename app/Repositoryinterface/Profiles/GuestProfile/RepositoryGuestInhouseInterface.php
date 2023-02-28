<?php
namespace App\Repositoryinterface\Profiles\GuestProfile;

interface RepositoryGuestInhouseInterface{
    public function index();
     public function store($request);
       public function show($id);
       public function update($request, $id);
    //  public function destroy($id);
    //  public function geSoftDeletedData();
    //  public function restorDataTrashed($id);
}
