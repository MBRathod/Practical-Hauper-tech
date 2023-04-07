<?php

namespace App\Repositories;

use App\Interfaces\RemindersRepositoryInterface;
use App\Models\Reminders;
use Illuminate\Http\Request;

class RemindersRepository implements RemindersRepositoryInterface
{
    public function getSingleReminders($id)
    {
        return Reminders::findorfail($id);
    }

    public function storeReminders(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;
        return Reminders::create($data);
    }

    public function updateReminders(Request $request, $id)
    {
        $data = $request->all();
        $reminders = $this->getSingleReminders($id);
        $data['created_by'] = auth()->user()->id;
        $reminders->update($data);
        return $reminders;
    }

    public function getAjaxRemindersData(Request $request)
    {
        $draw = $request->query('draw', 0);
        $start = $request->query('start', 0);
        $length = $request->query('length', 100);
        $order = $request->query('order', array(1, 'asc'));

        $sortColumns = array(
            0 => 'reminders.title',
            1 => 'reminders.description',
            2 => 'reminders.schedule_date_time',
            3 => 'reminders.created_at',
        );

        $query = Reminders::select('*')->where('created_by',auth()->user()->id);


        $recordsTotal = $query->count();
        $sortColumnName = $sortColumns[$order[0]['column']];

        $query->orderBy($sortColumnName, $order[0]['dir'])
            ->take($length)
            ->skip($start);

        $json = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => [],
        );

        $reminders = $query->get();
        foreach ($reminders as $reminder) {
            $edit=route('reminder.edit',$reminder->id);
            $actions = "<a href='".$edit."' class='btn btn-sm btn-success'>Edit</a>&nbsp;&nbsp;<a href='javascript:void(0)' data-did='".$reminder->id."' class='btn btn-danger btn-sm deleteForm'>Delete</a>";
            
            $json['data'][] = [
                $reminder->title,
                $reminder->description,
                $reminder->schedule_date_time,
                $actions
            ];
        }

        return $json;
    }

    public function deleteReminders($id)
    {
        $reminder = $this->getSingleReminders($id);
        $reminder->delete();
        return $reminder;
    }

    public function getAllReminders(){
        return Reminders::orderBy('created_at','desc')->get();
    }

}
