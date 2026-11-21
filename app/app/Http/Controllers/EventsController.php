<?php

namespace App\Http\Controllers;

class EventsController extends Controller
{
    public function index()
    {
        $events = [
            [
                'title' => 'Night Raid Sprint',
                'date' => 'Today · 20:30',
                'type' => 'Tournament',
                'description' => 'Join the fastest squad race of the week and climb the rankings.',
            ],
            [
                'title' => 'Pixel Drop Meetup',
                'date' => 'Tomorrow · 18:00',
                'type' => 'Community',
                'description' => 'A cozy meetup for creators, streamers, and indie devs.',
            ],
            [
                'title' => 'New Season Launch',
                'date' => 'Fri · 22:00',
                'type' => 'Launch',
                'description' => 'Watch the new season kickoff and unlock exclusive drops.',
            ],
        ];

        return view('events', compact('events'));
    }
}
