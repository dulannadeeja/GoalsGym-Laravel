<?php

namespace App\Http\Controllers;

use App\Models\ClassType;
use App\Models\ScheduledClass;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ScheduledClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $allScheduledClassesByInstructor = ScheduledClass::where('started_at', '>', now())
            ->orderBy('started_at', 'asc')
            ->with('classType')
            ->paginate(5);
        return view('instructor.schedule.upcoming', ['scheduledClasses' => $allScheduledClassesByInstructor]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $allClassTypes = ClassType::all();
        $formattedClassTypes = $allClassTypes->mapWithKeys(function ($classType) {
            return [$classType->id => $classType->name];
        });
        return view('instructor.schedule.create', ['types' => $formattedClassTypes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        // combine the start date and time into a single string
        $startDateTime = $request->start_date . ' ' . $request->start_time;

        $request->merge([
            'starting_time' => $startDateTime,
            'instructor_id' => auth()->user()->id,
        ]);

        // validate the request
        $request->validate([
            'class_type' => 'required|exists:class_types,id',
            'starting_time' => 'required|date|after:now|unique:scheduled_classes,started_at',
        ]);


        // create a new scheduled class
        $scheduledClass = ScheduledClass::create([
            'instructor_id' => $request->instructor_id,
            'class_type_id' => $request->class_type,
            'started_at' => $startDateTime
        ]);

        // redirect to the dashboard
        return redirect()->route('schedule.index')->with('success', 'Class scheduled successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $scheduledClassId): RedirectResponse
    {
        // Find the class schedule that you want to delete.
        $scheduledClass = ScheduledClass::class::find($scheduledClassId);

        if ($scheduledClass->instructor->id !== auth()->user()->id) {
            return redirect()->route('schedule.index')->with('error', 'You cannot cancel a class that you are not the instructor of, this class is owned by ' . $scheduledClass->instructor->name.'.');
        }

        if($scheduledClass->started_at < now()) {
            return redirect()->route('schedule.index')->with('error', 'Cannot cancel a class that has already started at ' . $scheduledClass->started_at->format('Y-m-d H:i:s').'now is '.now());
        }elseif ($scheduledClass->started_at < now()->addHours(24)) {
            return redirect()->route('schedule.index')->with('error', 'Cannot cancel a class that is starting in less than 24 hours');
        }
        $scheduledClass->delete();
        return redirect()->route('schedule.index')->with('success', 'Class canceled successfully');
    }
}
