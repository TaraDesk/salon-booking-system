<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function booking (Request $request)
    {
        $validation = $request->validate([
            'name' => ['required', 'exists:users,id'],
            'service' => ['required', 'exists:services,id'],
            'date' => ['required', 'date', 
                function ($attribute, $value, $fail) {
                    $date = Carbon::parse($value);
                    if ($date->isSunday()) {
                        $fail('The Salon not open at Sunday.');
                    }
                },
                Rule::date()->afterOrEqual(today())
            ],
            'time' => ['required', 'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $time = Carbon::createFromFormat('H:i', $value);
                    $start = Carbon::createFromTime(9, 0);   // 09:00
                    $end   = Carbon::createFromTime(17, 59);  // 17:00
        
                    if ($time->lt($start) || $time->gt($end)) {
                        $fail('The :attribute must be between 09:00 and 17:30.');
                    }
                },
            ],
        ]);

        $service = Service::find($validation['service']);

        $start_time = Carbon::createFromFormat('H:i', $validation['time']);
        $end_time = $start_time->copy()->addMinutes($service->time);

        $booking_schedule = Booking::where('booking_date', $validation['date'])->get();
        $overlapping = false;

        foreach ($booking_schedule as $booking) {
            $existing_start = Carbon::createFromFormat('H:i:s', $booking->booking_time_start);
            $existing_end = Carbon::createFromFormat('H:i:s', $booking->booking_time_end);

            if (
                $start_time->lt($existing_end) &&
                $end_time->gt($existing_start)
            ) {
                $overlapping = true;
            }
        }

        if ($overlapping) {
            $availableSchedule = $this->getAvailableTimeSlots($booking_schedule);
            $availableSlotsHtml = '<ul class="grid grid-cols-2">' . $availableSchedule->map(function ($slot) {
                return "<li>{$slot['start']} - {$slot['end']}</li>";
            })->implode('') . '</ul>';
            
            $message = [
                'title' => 'Overlapping appointment',
                'html' => '<strong class="block mb-2">Available Time Slots:</strong>' . $availableSlotsHtml
            ];

            return redirect('/')->with('overlapping', $message);
        }

        $start_time_formatted = $start_time->format('H:i:s');
        $end_time_formatted = $end_time->format('H:i:s');

        $booking = Booking::create([
            'user_id' => $validation['name'],
            'service_id' => $validation['service'],
            'booking_date' => $validation['date'],
            'booking_time_start' => $start_time_formatted,
            'booking_time_end' => $end_time_formatted,
            'booking_status' => 'pending'
        ]);

        return redirect('/')->with('success', 'Booking created successfully.');
    }

    public function index ()
    {
        $bookings = Booking::all()->map(function ($booking) {
            $booking->issue_at = Carbon::parse($booking->created_at)->format('l, F j Y');
            $booking->booking_date = Carbon::parse($booking->booking_date)->format('l, F j Y');
            
            return $booking;
        });

        $statistics = [
            'total' => Booking::count(),
            'pending' => Booking::where('booking_status', 'pending')->count(),
            'paid' => Booking::where('booking_status', 'paid')->count(),
            'cancel' => Booking::where('booking_status', 'cancelled')->count(),
        ];

        return view('admin.bookings.index', ['bookings' => $bookings, 'statistics' => $statistics ]);
    }

    public function create ()
    {
        $services = Service::all();
        $users = User::where('is_admin', '0')->get();

        return view('admin.bookings.create', ['services' => $services, 'users' => $users]);
    }

    public function store (Request $request)
    {
        $validation = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'service_id' => ['required', 'exists:services,id'],
            'booking_date' => ['required', 'date', 
                function ($attribute, $value, $fail) {
                    $date = Carbon::parse($value);
                    if ($date->isSunday()) {
                        $fail('The Salon not open at Sunday.');
                    }
                },
                Rule::date()->afterOrEqual(today())
            ],
            'booking_time' => ['required', 'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $time = Carbon::createFromFormat('H:i', $value);
                    $start = Carbon::createFromTime(9, 0);   // 09:00
                    $end   = Carbon::createFromTime(17, 59);  // 17:00
        
                    if ($time->lt($start) || $time->gt($end)) {
                        $fail('The :attribute must be between 09:00 and 17:30.');
                    }
                },
            ],
            'booking_status' => ['required', Rule::in(['pending', 'paid', 'cancelled'])],
        ]);

        $service = Service::find($validation['service_id']);

        $start_time = Carbon::createFromFormat('H:i', $validation['booking_time']);
        $end_time = $start_time->copy()->addMinutes($service->time);

        $booking_schedule = Booking::where('booking_date', $validation['booking_date'])->get();

        foreach ($booking_schedule as $booking) {
            $existing_start = Carbon::createFromFormat('H:i:s', $booking->booking_time_start);
            $existing_end = Carbon::createFromFormat('H:i:s', $booking->booking_time_end);

            if (
                $start_time->lt($existing_end) &&
                $end_time->gt($existing_start)
            ) {
                return redirect('/admin/bookings/create')->with('overlapping', 'There is already appointment at that time.');
            }
        }

        $start_time_formatted = $start_time->format('H:i:s');
        $end_time_formatted = $end_time->format('H:i:s');

        $booking = Booking::create([
            'user_id' => $validation['user_id'],
            'service_id' => $validation['service_id'],
            'booking_date' => $validation['booking_date'],
            'booking_time_start' => $start_time_formatted,
            'booking_time_end' => $end_time_formatted,
            'booking_status' => $validation['booking_status']
        ]);

        return redirect('/admin/bookings')->with('success', 'Booking created successfully.');
    }

    public function show (Booking $booking)
    {
        return view('admin.bookings.show', ['booking' => $booking]);
    }

    public function edit (Booking $booking)
    {
        $services = Service::all();
        $users = User::where('is_admin', '0')->get();

        return view('admin.bookings.edit', 
            ['booking' => $booking, 'services' => $services, 'users' => $users]
        );
    }

    public function update (Booking $booking, Request $request)
    {
        $validation = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'service_id' => ['required', 'exists:services,id'],
            'booking_date' => ['required', 'date', 
                function ($attribute, $value, $fail) {
                    $date = Carbon::parse($value);
                    if ($date->isSunday()) {
                        $fail('The Salon not open at Sunday.');
                    }
                }
            ],
            'booking_time' => ['required', 'date_format:H:i',
                function ($attribute, $value, $fail) {
                    $time = Carbon::createFromFormat('H:i', $value);
                    $start = Carbon::createFromTime(9, 0);   // 09:00
                    $end   = Carbon::createFromTime(17, 59);  // 17:00
        
                    if ($time->lt($start) || $time->gt($end)) {
                        $fail('The :attribute must be between 09:00 and 17:30.');
                    }
                },
            ],
            'booking_status' => ['required', Rule::in(['pending', 'paid', 'cancelled'])],
        ]);

        $service = Service::find($validation['service_id']);

        $start_time = Carbon::createFromFormat('H:i', $validation['booking_time']);
        $end_time = $start_time->copy()->addMinutes($service->time);

        $start_time_formatted = $start_time->format('H:i:s');
        $end_time_formatted = $end_time->format('H:i:s');

        $booking_schedule = Booking::where('booking_date', $validation['booking_date'])
            ->where('id', '!=', $booking->id)
            ->get();

        foreach ($booking_schedule as $booking_sch) {
            $existing_start = Carbon::createFromFormat('H:i:s', $booking_sch->booking_time_start);
            $existing_end = Carbon::createFromFormat('H:i:s', $booking_sch->booking_time_end);

            if (
                $start_time->lt($existing_end) &&
                $end_time->gt($existing_start)
            ) {
                return redirect('/admin/bookings/' . $booking->id . '/edit')->with('overlapping', 'There is already appointment at that time.');
            }
        }

        $booking->update([
            'user_id' => $validation['user_id'],
            'service_id' => $validation['service_id'],
            'booking_date' => $validation['booking_date'],
            'booking_time_start' => $start_time_formatted,
            'booking_time_end' => $end_time_formatted,
            'booking_status' => $validation['booking_status']
        ]);

        return redirect('/admin/bookings/' . $booking->id)->with('success', 'Booking record has been updated successfully.');
    }

    public function destroy (Booking $booking)  {
        $booking->delete();

        return redirect('/admin/bookings')->with('success', 'Booking record has been deleted.');
    }

    private function getAvailableTimeSlots (Collection $bookingSchedule, int $intervalMinutes = 30)
    {
        $workDayStart = Carbon::parse('today')->setTime(9, 0, 0);
        $workDayEnd = Carbon::parse('today')->setTime(17, 0, 0);

        $allSlots = collect();
        $current = $workDayStart->copy();

        while ($current->lt($workDayEnd)) {
            $slotStart = $current->copy();
            $slotEnd = $current->copy()->addMinutes($intervalMinutes);

            if ($slotEnd->lte($workDayEnd)) {
                $allSlots->push([
                    'start' => $slotStart->format('H:i'),
                    'end' => $slotEnd->format('H:i'),
                ]);
            }

            $current->addMinutes($intervalMinutes);
        }

        foreach ($bookingSchedule as $booking) {
            $existingStart = Carbon::createFromFormat('H:i:s', $booking->booking_time_start);
            $existingEnd = Carbon::createFromFormat('H:i:s', $booking->booking_time_end);

            $allSlots = $allSlots->reject(function ($slot) use ($existingStart, $existingEnd) {
                $slotStart = Carbon::createFromFormat('H:i', $slot['start']);
                $slotEnd = Carbon::createFromFormat('H:i', $slot['end']);

                return $slotStart->lt($existingEnd) && $slotEnd->gt($existingStart);
            });
        }

        return $allSlots->values(); // Reindex
    }
}
