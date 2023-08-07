<template>
    <GoogleMap api-key="AIzaSyAXDLy49tnZt_I8Gr7krArvGJ-XsBWB1IQ" style="width: 100%; height: 300px" :center="center" :zoom="15">
        <Marker :options="{ position: center }" />
    </GoogleMap>
</template>

<script>
import { GoogleMap, Marker } from "vue3-google-map";
export default {
    name :"mapa",
    components: { GoogleMap, Marker },
    props : ['latitud' , 'longitud'],
    data(){
        return {
            center: {lat: Number(this.latitud), lng: Number(this.longitud)},
        }
    },
};
</script>
