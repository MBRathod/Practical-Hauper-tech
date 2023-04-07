<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

interface RemindersRepositoryInterface {

    public function getSingleReminders($id);

    public function storeReminders(Request $request);

    public function updateReminders(Request $request,$id);

    public function getAjaxRemindersData(Request $request);

    public function deleteReminders($id);

    public function getAllReminders();


}