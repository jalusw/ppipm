<script setup>
import NavbarAdmin from "../Components/NavbarAdmin.vue";
import SidebarAdmin from "../Components/SidebarAdmin.vue";
import { ref } from "vue";
const hidden = ref(false);

const toggleSidebar = () => {
    hidden.value = !hidden.value;
};
</script>
<template>
    <NavbarAdmin :toggleSidebar="toggleSidebar" />
    <main id="main">
        <div class="flex">
            <div
                :class="`flex-1 max-w-[320px] min-h-[100vh] shadow ${
                    hidden && 'hidden'
                }`"
            >
                <SidebarAdmin />
            </div>
            <div class="flex-1 p-4 w-full overflow-hidden">
                <slot></slot>
            </div>
        </div>
    </main>
</template>
