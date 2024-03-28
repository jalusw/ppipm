<script setup>
import Leaflet from "./Leaflet.vue";
const props = defineProps({
    customClass: String,
});
</script>
<template>
    <Leaflet
        :lat-view="-2.9326002532193365"
        :lng-view="115.15124962088767"
        :zoom="13"
        :custom-class="customClass"
    />
</template>
