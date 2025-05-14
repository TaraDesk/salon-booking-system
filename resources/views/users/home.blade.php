<x-layout.user>
    <x-slot:title>
        Mirra Salon
    </x-slot:title>

    <x-user.overlay background="images/heroes-background.png" />

    <x-user.navbar />

    {{-- Heroes --}}
    <section class="relative text-gray-600 body-font z-3 my-12" id="heroes">
		<div class="container mx-auto flex px-5 py-26 md:flex-row flex-col justify-center items-center">
			<div class="text-center lg:w-2/3 w-full">
			  <h2 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
			    Elevate Your Beauty at Luxe Salon
			  </h2>
			  <p class="mb-8 leading-relaxed">
			    Experience personalized hair and beauty treatments in a relaxing, modern space. From expert cuts and color to spa-quality care—your transformation starts here.
			  </p>
			  <div class="flex justify-center">
				@auth
					<button class="inline-flex items-center cursor-pointer text-white bg-rose-500 border-0 py-2 px-6 focus:outline-none hover:bg-rose-600 rounded text-lg" onclick="toggleModal()">
						<i data-lucide="book" class="mr-2 w-5 h-5"></i> Book Appointment
				  	</button>
				@endauth
				@guest
					<a href="/login" class="inline-flex items-center cursor-pointer text-white bg-rose-500 border-0 py-2 px-6 focus:outline-none hover:bg-rose-600 rounded text-lg">
						<i data-lucide="book" class="mr-2 w-5 h-5"></i> Book Appointment
				  	</a>
				@endguest
			    
			  </div>
			</div>
		</div>
	</section>

    {{-- Services --}}
    <section class="text-gray-600 body-font pt-12" id="services">
		<div class="container px-5 py-24 mx-auto">
		  <div class="flex flex-col text-center w-full mb-20">
		    <h2 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Our Signature Salon Services</h2>
		    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Discover our range of premium beauty and self-care treatments designed to help you look and feel your best. Whether it's a quick refresh or a full makeover, we've got you covered.</p>
		  </div>
		  <div class="flex flex-wrap -m-4 items-stretch">
			@foreach ($services as $service)
				<x-service :service="$service"/>
			@endforeach
		  </div>
		</div>
	</section>
	
	<x-user.features />

	<x-user.testimonials />

	<x-user.teams />

	<x-user.contact />

	@auth
		<x-user.booking :service_list="$service_list"/>
	@endauth
</x-layout.user>