<template>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8 md:mx-auto md:w-full md:max-w-md">
        <h1 class="text-3xl font-semibold mb-4 text-center">Here is your Trip</h1>
        <div class="p-5 bg-white rounded-md shadow-md"> 
            <h2 class="text-xl">Going to <strong>{{ location.destination.name }}</strong></h2>
            <div class="mt-2">
                <GMapMap :zoom="11" :center="location.destination.geometry" style="width: 100%; height: 250px;"></GMapMap>
            </div>  
            <button type="submit" class="mt-4 py-2 px-4 float-right bg-black text-yellow-50 text-sm font-medium rounded-md">Let's go!</button>
        </div>
    </div>

</template>

<script setup>
import {useLocationStore} from '@/stores/location'
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';

const location = useLocationStore()
const router = useRouter()

onMounted(async() => {

    // Does User has a location set?
    if (location.destination.name === '') {
        router.push({
            name: 'location'
        })
    }

    // Get user current location
    // navigator.geolocation.getCurrentPosition((success) => {
    //     console.log(success)
    // }, (error) => {
    //     console.log(error)
    // })

    await location.updateCurrentLocation()


})

</script>