<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\RemindersRequest;
use App\Interfaces\RemindersRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReminderController extends Controller
{
    protected $reminderRepository = "";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(RemindersRepositoryInterface $reminderRepository)
    {
        $this->reminderRepository = $reminderRepository;
    }

    public function getRemindersData(Request $request)
    {
        return $this->reminderRepository->getAjaxRemindersData($request);
    }
    public function index()
    {
        return view('admin.reminder.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reminder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RemindersRequest $request)
    {
        $reminderData = $this->reminderRepository->storeReminders($request);
        if ($reminderData) {
            Session::flash('success',  'Successfully Inserted');
            return redirect()->route('reminder.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['reminder'] = $this->reminderRepository->getSingleReminders($id);
        return view('admin.reminder.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RemindersRequest $request, $id)
    {
        $reminderData = $this->reminderRepository->updateReminders($request, $id);
        if ($reminderData) {
            Session::flash('success',  'Successfully Updated');
            return redirect()->route('reminder.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $walletDelete = $this->reminderRepository->deleteReminders($id);
        if ($walletDelete) {
            return response()->json(['status'=>true,'message' => 'Deleted Successfully.']);
        }
    }

}
