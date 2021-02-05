<section class="container px-4">
    <h1 class="font-bold text-2xl">
        Contact Us!
    </h1>
    <form wire:submit.prevent="submit" class="flex flex-col">
        @if(session()->has('success'))
        <section class="border-l-2 border-green-400 bg-green-200 pl-4 py-2 my-2">
            {{session('success')}}
        </section>
        @endif

        <x-input.text name="first_name" model="first_name" required>First Name</x-input.text>
        <x-input.text name="last_name" model="last_name" required>Last Name</x-input.text>
        <x-input.text name="email" model="email" type="email" required>Email</x-input.text>
        <x-input.text-area name="message" model="message" required>Your Message</x-input.text-area>
        <button class="px-4 py-2 bg-blue-600 text-white">Submit</button>
    </form>
</section>
