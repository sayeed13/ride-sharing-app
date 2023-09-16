<template>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8 md:mx-auto md:w-full md:max-w-md">
        <h1 class="text-3xl font-semibold mb-4 text-center">Here is your Trip</h1>
        <div class="p-5 bg-white rounded-md shadow-md"> 
            <h2 class="text-xl">Going to <strong>{{ location.destination.name }}</strong></h2>
            <div class="mt-2">
                <GMapMap ref="gMap" v-if="location.destination.name !== ''" :zoom="11" :center="location.destination.geometry" style="width: 100%; height: 250px;"></GMapMap>
            </div>  
            <button @click="confirmtrip" class="mt-4 py-2 px-4 float-right bg-black text-yellow-50 text-sm font-medium rounded-md">Let's go!</button>
        </div>
    </div>

</template>

<script setup>
import {useLocationStore} from '@/stores/location'
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios'

const location = useLocationStore()
const router = useRouter()

const gMap = ref(null)

const confirmtrip = () => {
    axios.post('http://127.0.0.1:8000/api/trip', {
        origin: location.currentLocation.geometry,
        destination: location.destination.geometry,
        destination_name: location.destination.name
    })
    .then((response) => {
        router.push({
            name: 'trip'
        })
    })
    .catch((error) => {
        console.error(error)
    })
}

onMounted(async() => {

    // Does User has a location set?
    if (location.destination.name === '') {
        router.push({
            name: 'location'
        })
    }

    // Get user current location
    await location.updateCurrentLocation()

    // Draw a path on a map
    gMap.value.$mapPromise.then((mapObject) => {
        //User current location point
        let currentPoint = new google.maps.LatLng(location.currentLocation.geometry),
            destinationPoint = new google.maps.LatLng(location.destination.geometry),
            directionsService = new google.maps.DirectionsService,
            directionsDisplay =  new google.maps.DirectionsRenderer({
                map: mapObject
            })
        
        directionsService.route({
            origin: currentPoint,
            destination: destinationPoint,
            avoidTolls: false,
            avoidHighways: false,
            travelMode: google.maps.TravelMode.DRIVING
        }, (res, status) => {
            if (status === google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(res)
            } else {
                console.error(status)
            }
        })
    })


})

</script>