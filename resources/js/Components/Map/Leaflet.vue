<script setup>
import { onMounted } from "vue";
import * as L from "leaflet";
import "leaflet/dist/leaflet.css";

const props = defineProps({
    latView: Number,
    lngView: Number,
    zoom: Number,
    height: String,
    customClass: String,
});

const classes = "w-full min-h-[200px] " + props.customClass;

onMounted(() => {
    let map = L.map("leaflet-map").setView(
        [props.latView, props.lngView],
        props.zoom
    );

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 20,
    }).addTo(map);
});
</script>
<template>
    <div :class="classes" id="leaflet-map"></div>
</template>
