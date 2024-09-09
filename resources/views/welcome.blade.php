<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <main class="h-screen w-screen flex justify-center items-center flex-col container mx-auto">
        {{-- Agregar inputs para: hotelid, checkin, checkout, numberOfGuests, NumberOfRooms, currency --}}
        <section>
            <h1 class="text-3xl font-bold mb-5">Search for a hotel</h1>
            <form action="{{ route('search') }}" method="POST" class="flex gap-5">
                @csrf
                <label for="hotelId">
                    Hotel
                    <select name="hotelId" id="hotelId"
                        class="block rounded-md border-0 py-2 px-4 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="1">HotelLegs</option>
                        <option value="2" disabled>TravelDoorX</option>
                    </select>
                </label>
                <label for="checkIn">
                    Check In
                    <input type="date" name="checkIn" id="checkIn" placeholder="Check In"
                        class="block rounded-md border-0 py-1.5 px-4 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </label>
                <label for="checkOut">
                    Check Out
                    <input type="date" id="checkOut" name="checkOut" placeholder="Check Out"
                        class="block rounded-md border-0 py-1.5 px-4 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </label>
                <label for="numberOfGuests">
                    Number of Guest
                    <input type="number" id="numberOfGuests" name="numberOfGuests" placeholder="Number of Guests"
                        class="block rounded-md border-0 py-1.5 px-4 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </label>
                <label for="numberOfRooms">
                    Number of Rooms
                    <input type="number" id="numberOfRooms" name="numberOfRooms" placeholder="Number of Rooms"
                        class="block rounded-md border-0 py-1.5 px-4 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </label>
                {{-- Agregar select para monedas --}}
                <label for="currency">
                    Currency
                    <select name="currency" id="currency"
                        class="block rounded-md border-0 py-2 px-4 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="EUR">EUR</option>
                    </select>
                </label>
                <div class="flex items-center">
                    <button type="submit"
                        class="py-3 px-5 text-white hover:bg-blue-400 bg-blue-600 rounded-md transition-all duration-500 ease-out">Search</button>
                </div>


            </form>

            {{-- Errores --}}
            <div id="errors" class="mt-5 text-red-500">

            </div>
        </section>

        <section id="hotels" class="w-full flex flex-col gap-10 h-[350px] overflow-y-auto"></section>

    </main>

    @vite('resources/js/app.js')
</body>

</html>
