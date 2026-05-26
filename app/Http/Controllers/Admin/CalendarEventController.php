<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCalendarEventRequest;
use App\Http\Requests\UpdateCalendarEventRequest;
use App\Models\CalendarEvent;
use App\Services\AdminActivityLogger;

class CalendarEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = CalendarEvent::query()
            ->latest('start_at')
            ->paginate(20);

        return view('admin.calendar.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.calendar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCalendarEventRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $event = CalendarEvent::create($data);
        AdminActivityLogger::log(
            $request->user(),
            'calendar',
            'create',
            'Created calendar event: '.$event->title,
            CalendarEvent::class,
            $event->id,
            ['start_at' => (string) $event->start_at],
            $request
        );
        return redirect()->route('admin.calendar.index')->with('success', 'Event created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CalendarEvent  $calendarEvent
     * @return \Illuminate\Http\Response
     */
    public function show(CalendarEvent $calendarEvent)
    {
        return view('admin.calendar.show', compact('calendarEvent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CalendarEvent  $calendarEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(CalendarEvent $calendarEvent)
    {
        return view('admin.calendar.edit', compact('calendarEvent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CalendarEvent  $calendarEvent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCalendarEventRequest $request, CalendarEvent $calendarEvent)
    {
        $calendarEvent->update($request->validated());
        AdminActivityLogger::log(
            $request->user(),
            'calendar',
            'update',
            'Updated calendar event: '.$calendarEvent->title,
            CalendarEvent::class,
            $calendarEvent->id,
            ['start_at' => (string) $calendarEvent->start_at],
            $request
        );
        return redirect()->route('admin.calendar.index')->with('success', 'Event updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CalendarEvent  $calendarEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalendarEvent $calendarEvent)
    {
        $title = $calendarEvent->title;
        $id = $calendarEvent->id;
        $calendarEvent->delete();
        AdminActivityLogger::log(
            request()->user(),
            'calendar',
            'delete',
            'Deleted calendar event: '.$title,
            CalendarEvent::class,
            $id,
            null,
            request()
        );
        return redirect()->route('admin.calendar.index')->with('success', 'Event deleted.');
    }
}
