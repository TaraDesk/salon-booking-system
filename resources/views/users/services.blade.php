<x-layout.user>
    <x-slot:title>
        Services at Mirra Salon
    </x-slot:title>

    <x-user.overlay background="images/heroes-background.png" />

    <x-user.navbar />

    {{-- Heroes --}}
    <section class="relative text-gray-600 body-font z-3 my-12" id="heroes">
		<div class="container mx-auto flex px-5 py-26 md:flex-row flex-col justify-center items-center">
			<div class="text-center lg:w-2/3 w-full">
			  <h2 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
			    Our Signature Salon Services
			  </h2>
			  <p class="mb-8 leading-relaxed">
			    Discover our range of premium beauty and self-care treatments designed to help you look and feel your best. Whether it's a quick refresh or a full makeover, we've got you covered.
			  </p>
			</div>
		</div>
	</section>

    {{-- Services --}}
    <section class="text-gray-600 body-font pt-21" id="services">
		<div class="container px-5 py-24 mx-auto">
		  <div class="flex flex-wrap -m-4 items-stretch">
			@foreach ($services as $service)
				<x-service :service="$service" mode="2"/>
			@endforeach
		  </div>
		</div>
	</section>

</x-layout.user>