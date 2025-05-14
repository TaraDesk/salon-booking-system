<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('name', 'asc')->get();

        $popularServiceBasedOnBooking = Booking::where('booking_status', '!=', 'cancelled')->groupBy('service_id')->orderBy('count', 'desc')->first();

        $statistics = [
            'total' => Service::count(),
            'popular' => Booking::count() > 0 && ! $popularServiceBasedOnBooking->service->deleted_at
                ? $popularServiceBasedOnBooking->service->name 
                : Service::latest()->first()->name,
        ];

        return view('admin.services.index', ['services' => $services, 'statistics' => $statistics]);
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => ['required'],
            'description' => ['required', 'min:30'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'time' => ['required', 'integer', 'min:10'],
            'price' => ['required', 'integer', 'min:20000'],
        ]);

        $image_path = $request->file('image')->store('services', 'public');

        Service::create([
            'name' => $validation['name'],
            'description' => $validation['description'],
            'image_url' => $image_path,
            'time' => $validation['time'],
            'price' => $validation['price'],
        ]);

        return redirect('/admin/services')->with('success', 'Service record has been created.');
    }

    public function show(Service $service)
    {
        return view('admin.services.show', ['service' => $service]);
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', ['service' => $service]);
    }

    public function update(Service $service, Request $request)
    {
        $rules = [
            'name' => ['required'],
            'description' => ['required', 'min:30'],
            'time' => ['required', 'integer', 'min:10'],
            'price' => ['required', 'integer', 'min:20000'],
        ];
        
        if ($request->hasFile('image')) {
            $rules['image'] = ['image', 'mimes:jpg,jpeg,png', 'max:2048'];
        }
        
        $validation = $request->validate($rules);
        $image_path = $service->image_url;

        if ($request->hasFile('image')) {
            if ($service->image_url) {
                Storage::disk('public')->delete($service->image_url);
            }

            $image_path = $request->file('image')->store('services', 'public');
        }

        $service->update([
            'name' => $validation['name'],
            'description' => $validation['description'],
            'image_url' => $image_path,
            'time' => $validation['time'],
            'price' => $validation['price'],
        ]);

        return redirect('/admin/services')->with('success', 'Service record has been updated.');
    }

    public function destroy(Service $service)
    {
        if ($service->image_url) {
            Storage::disk('public')->delete($service->image_url);
        }

        $service->delete();
        
        return redirect('/admin/services')->with('success', 'Service record has been deleted.');
    }
}
