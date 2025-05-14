@props(['service_list'])

<!-- Booking Modal -->
<div class="fixed inset-0 z-20 hidden bg-gray-100/50 overflow-y-auto p-4 sm:p-0" id="booking">
    <div class="min-h-full flex items-center justify-center">
        <div class='w-full max-w-4xl px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
            <div class="flex flex-col md:flex-row gap-8">

                <!-- Left Section: Salon Hours -->
                <div class="flex-1 flex flex-col md:px-6 py-4">
                    <!-- Logo/Header -->
                    <div class="flex items-center mb-6">
                        <div class="rounded bg-rose-600 text-white font-bold w-10 h-10 flex justify-center items-center">
                            <i data-lucide="scissors" class="text-2xl"></i>
                        </div>
                        <h1 class="text-gray-800 font-bold ml-2 tracking-[.3em] hover:text-rose-600">MIRRA</h1>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-600 mb-6">Schedule your appointment quickly using the form.</p>

                    <!-- Salon Hours Title -->
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Salon Hours</h2>

                    <!-- Salon Hours Information -->
                    <p class="text-gray-600 mb-4">We are open during the following times:</p>

                    <div class="space-y-3">
                        <p class="text-gray-800 font-medium">Monday - Saturday: 9:00 AM - 5:00 PM</p>
                        <p class="text-gray-800 font-medium">Sunday: Closed</p>
                    </div>
                </div>


                <!-- Right Section: Booking Form -->
                <div class="flex-1">
                    <div class="max-w-md mx-auto flex flex-col gap-6">
                        <!-- Form -->
                        <form action="/booking" method="POST" class="space-y-4">
                            @csrf

                            <!-- Name -->
                            <div class="space-y-4">
                                <label for="name" class="block text-gray-700">Name</label>
                                <input type="text" class="hidden" name="name" value="{{ Auth::user()->id }}">
                                <input type="text" id="name" name="name_text" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" value="{{ Auth::user()->name }}" disabled>
                            </div>

                            <!-- Service -->
                            <div class="space-y-4">
                                <label for="service" class="block text-gray-700">Service</label>
                                <select id="service" name="service" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500">
                                    @foreach ($service_list as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date and Time Side by Side -->
                            <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                                <!-- Date -->
                                <div class="flex-1 space-y-4">
                                    <label for="date" class="block text-gray-700">Date</label>
                                    <input type="date" id="date" name="date" min="{{ \Carbon\Carbon::today()->toDateString() }}" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                                </div>

                                <!-- Time -->
                                <div class="flex-1 space-y-4">
                                    <label for="time" class="block text-gray-700">Time</label>
                                    <select id="time" name="time" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" required>
                                        @for ($hour = 9; $hour <= 17; $hour++)
                                            <option value="{{ sprintf('%02d:00', $hour) }}">{{ sprintf('%02d:00', $hour) }}</option>
                                            <option value="{{ sprintf('%02d:30', $hour) }}">{{ sprintf('%02d:30', $hour) }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class='cursor-pointer w-full mt-6 px-4 py-2 font-medium text-white bg-teal-500 rounded-md hover:bg-teal-600 transition'>
                                Book Appointment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <script>
        Swal.fire({
            icon: "error",
            title: "{{ $errors->first() }}",
            text: "Something went wrong!"
        });
    </script>
@endif

@if (session('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "Action Success",
            text: "{{ session('success') }}"
        });
    </script>
@endif

@if (session('overlapping'))
    <script>
        Swal.fire({
            icon: "info",
            title: @json(session('overlapping.title')),
            html: @json(session('overlapping.html'))
        });
    </script>
@endif

<script>
    const bookingModel = document.querySelector('#booking');
    
    bookingModel.addEventListener('click', function (e) {
        if (e.target === this) {
            toggleModal();
        }
    });
    
    function toggleModal() {
        if (bookingModel.classList.contains('hidden')) {
            bookingModel.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        } else {
            bookingModel.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }
</script>