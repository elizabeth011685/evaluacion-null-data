<template>
    <GoogleMap :api-key="apiKey" style="width: 100%; height: 300px" :center="center" :zoom="15">
        <Marker :options="{ position: center }" />
    </GoogleMap>
</template>

<script>
import { GoogleMap, Marker } from "vue3-google-map";
export default {
    name :"mapa",
    components: { GoogleMap, Marker },
    props : {
        latitud : Number ,
        longitud : Number,
        apiKey : String,
    },
    data(){
        return {
            center: {lat: Number(this.latitud), lng: Number(this.longitud)},
        }
    },
};
</script>
