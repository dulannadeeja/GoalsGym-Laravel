<?php

namespace App\Http\Controllers;

use App\Models\ScheduledClass;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allBookedClasses = auth()->user()->bookings()
            ->upcoming()
            ->with('classType')
            ->orderBy('started_at', 'asc')
            ->paginate(10);

        return view('member.bookings.index', [
            'allBookedClasses' => $allBookedClasses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ->whereDoesntHave('bookedUsers', fn ($query) => $query->where('user_id', auth()->user()->id))
        $allScheduledClasses = ScheduledClass::upcoming()->notBookedByUser(auth()->user())
            ->with('classType', 'instructor')
            ->orderBy('started_at', 'asc')
            ->paginate(10);

        $allBookedClasses = auth()->user()->bookings()->pluck('scheduled_class_id')->toArray();

        return view('member.bookings.upcoming', [
            'allScheduledClasses' => $allScheduledClasses,
            'bookedClasses' => $allBookedClasses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $classId)
    {
        $scheduledClass = ScheduledClass::findOrFail($classId);

        $scheduledClass->bookedUsers()->attach(auth()->user()->id);

        return redirect()->route('member.bookings')->with('success', 'You have successfully booked a class.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $scheduledClass = ScheduledClass::findOrFail($id);

        $scheduledClass->bookedUsers()->detach(auth()->user()->id);

        return redirect()->route('member.bookings')->with('success', 'You have successfully cancelled a class.');
    }
}
