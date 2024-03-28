<script setup>
import { onMounted } from "vue";
import * as L from "leaflet";
import "leaflet/dist/leaflet.css";
import "@geoman-io/leaflet-geoman-free";
import "@geoman-io/leaflet-geoman-free/dist/leaflet-geoman.css";

const props = defineProps({
    latView: Number,
    lngView: Number,
    zoom: Number,
    height: String,
    customClass: String,
    saveGeoJSON: Function,
    geojson: Object,
});

const classes = "w-full min-h-[200px] " + props.customClass;

onMounted(() => {
    let map = L.map("leaflet-map").setView(
        [props.latView, props.lngView],
        props.zoom
    );
    map.pm.setGlobalOptions({ pmIgnore: false });
    map.pm.globalEditModeEnabled(true);
    map.pm.enableGlobalEditMode(true);

    props.geojson.features.map((feature) => {
        try {
            if (feature.properties.radius) {
                L.circle(
                    [
                        feature.geometry.coordinates.lat,
                        feature.geometry.coordinates.lng,
                    ],
                    {
                        radius: feature.properties.radius,
                    }
                ).addTo(map);
            }
            L.geoJSON(feature).addTo(map);
        } catch (error) {}
    });

    const getGeoJSON = () => {
        const features = [];
        map.pm.getGeomanLayers().map((layer, index) => {
            if (layer instanceof L.Circle) {
                features.push({
                    type: "Feature",
                    geometry: {
                        type: "Polygon",
                        coordinates: layer.getLatLng(),
                    },
                    properties: {
                        radius: layer.getRadius(),
                    },
                });
                return;
            }
            features.push(layer.toGeoJSON());
        });
        return {
            type: "FeatureCollection",
            features,
        };
    };

    map.pm.addControls({ position: "topleft" });

    map.pm.getGeomanLayers().map((layer, index) => {
        layer.on("pm:edit", () => {
            props.saveGeoJSON(getGeoJSON());
        });

        layer.on("pm:drag", () => {
            props.saveGeoJSON(getGeoJSON());
        });

        layer.on("pm:cut", () => {
            props.saveGeoJSON(getGeoJSON());
        });

        layer.on("pm:remove", () => {
            props.saveGeoJSON(getGeoJSON());
        });
    });

    map.on("pm:create", (event) => {
        if (event.layer && event.layer.pm) {
            const shape = event;

            shape.layer.pm.enable();

            map.pm.getGeomanLayers(true);

            shape.layer.on("pm:edit", () => {
                props.saveGeoJSON(getGeoJSON());
            });

            shape.layer.on("pm:drag", () => {
                props.saveGeoJSON(getGeoJSON());
            });

            shape.layer.on("pm:cut", () => {
                props.saveGeoJSON(getGeoJSON());
            });

            shape.layer.on("pm:remove", () => {
                props.saveGeoJSON(getGeoJSON());
            });
        }

        props.saveGeoJSON(getGeoJSON());
    });

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 20,
    }).addTo(map);
});
</script>
<template>
    <div :class="classes" id="leaflet-map"></div>
</template>
