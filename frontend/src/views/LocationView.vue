<template>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8 md:mx-auto md:w-full md:max-w-md">
        <h1 class="text-3xl font-semibold mb-4 text-center">Where you going?</h1>
        <div class="p-5 bg-white rounded-md shadow-md">
                <form action="">
                    <GMapAutocomplete
                        placeholder="Place a location"
                        @place_changed="setPlace"
                        class="p-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        >
                    </GMapAutocomplete>
                    <button type="submit" class="mt-4 py-2 px-4 float-right bg-black text-yellow-50 text-sm font-medium rounded-md">Find a ride</button>
                </form>
        </div>
    </div>
</template>

<script setup>
import { useLocationStore } from '@/stores/location'

const location = useLocationStore()

const setPlace = (e) => {
    console.log('setPlace', e)
    location.$patch({
        destination: {
            name: e.name,
            address: e.formatted_address,
            geometry: {
                lat: e.geometry.location.lat(),
                lng: e.geometry.location.lng()
            }
        }
    })
}

</script>