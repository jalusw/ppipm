<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    comodity: Object,
});
</script>
<template>
    <Head title="Artikel Komoditias" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Artikel Komoditas</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Komoditas</li>
                <li>
                    <Link
                        :href="
                            route('management.comodities.article', comodity.id)
                        "
                        >Artikel Komoditas</Link
                    >
                </li>
                <li>
                    <Link
                        :href="
                            route(
                                'management.comodities.article-preview',
                                comodity.id
                            )
                        "
                        >Preview</Link
                    >
                </li>
            </ul>
        </div>
        <hr />
        <div class="mt-8">
            <div
                class="prose max-w-full"
                v-html="comodity.article_content.body"
            ></div>
        </div>
    </AdminLayout>
</template>
