<div {{ $attributes->merge(['class' => "container mx-auto mt-30 py-6 flex flex-col gap-4"]) }}>
    {{ $slot }}
</div>

@if (session('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "Action Success",
            text: "{{ session('success') }}"
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: "error",
            title: "{{ $errors->first() }}",
            text: "Something went wrong!"
        });
    </script>
@endif