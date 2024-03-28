<script setup>
import MapTapinEditable from "../../Components/Map/MapTapinEditable.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, router, Link } from "@inertiajs/vue3";
import { ref } from "vue";

const geoJSONData = ref([]);

const updateGeoJSONData = (value) => (geoJSONData.value = value);

const saveHandler = () =>
    router.post(
        route("management.comodities.location", props.comodity.id),
        geoJSONData.value
    );

const clearHandler = () => {
    router.post(route("management.comodities.location", props.comodity.id), {
        type: "FeatureCollection",
        features: {},
    });
    router.get(route("management.comodities.location", props.comodity.id));
};

const props = defineProps({
    geojson: String,
    comodity: Object,
});

updateGeoJSONData(JSON.parse(props.geojson));
</script>
<template>
    <Head title="Lokasi Komoditias" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Lokasi Komoditas</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Komoditas</li>
                <li>
                    <Link
                        :href="
                            route('management.comodities.location', comodity.id)
                        "
                        >Lokasi Komoditas</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <section>
                <MapTapinEditable
                    custom-class="h-[800px] "
                    :geojson="geoJSONData"
                    :saveGeoJSON="updateGeoJSONData"
                />
                <div class="space-x-2">
                    <button @click="saveHandler" class="btn btn-primary mt-4">
                        Simpan
                    </button>
                    <button @click="clearHandler" class="btn btn-error mt-4">
                        Reset
                    </button>
                </div>
            </section>
        </div>
    </AdminLayout>
</template>
