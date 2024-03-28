<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";

const props = defineProps({
    permissions: Object,
    user: Object,
    user_permissions: Object,
});

let permissionList = ref({});

const permissionCheckboxHandler = (value, id) => {
    permissionList.value[id].selected = value === "on";
};

onMounted(() => {
    const { user_permissions, permissions } = props;
    permissions.forEach((permission) => {
        permissionList.value[permission.id] = {
            ...permission,
            selected: false,
        };
    });
    user_permissions.forEach((permission) => {
        permissionList.value[permission.id].selected = true;
    });
});

const authorizeFormSubmitHandler = () =>
    router.post(route("authorize", props.user.id), permissionList.value);
</script>
<template>
    <Head title="Hak Akses Pengguna" />
    <AdminLayout>
        <h1 class="font-bold text-xl text-primary">Hak Akses Pengguna</h1>
        <div class="text-sm breadcrumbs">
            <ul>
                <li>Manajemen Pengguna</li>
                <li>
                    <Link :href="route('authorize', user.id)"
                        >Hak Akses Pengguna</Link
                    >
                </li>
            </ul>
        </div>
        <div class="mt-8">
            <form @submit.prevent="authorizeFormSubmitHandler">
                <section>
                    <label for="input-nama-pengguna">Nama Pengguna</label>
                    <input
                        class="input input-bordered w-full"
                        id="input-nama-pengguna"
                        type="text"
                        :value="user.name"
                        disabled
                    />
                </section>
                <section class="mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="w-[5%]">#</th>
                                <th class="w-[30%]">Nama Hak Akses</th>
                                <th class="w-[70%]">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="hover"
                                v-for="permission in permissionList"
                                :key="permission.id"
                            >
                                <td>
                                    <input
                                        class="checkbox"
                                        type="checkbox"
                                        :id="
                                            'checkbox-permission-' +
                                            permission.id
                                        "
                                        :checked="permission.selected"
                                        @change="
                                            (event) =>
                                                permissionCheckboxHandler(
                                                    event.target.value,
                                                    permission.id
                                                )
                                        "
                                    />
                                </td>
                                <td>
                                    <label
                                        :for="
                                            'checkbox-permission-' +
                                            permission.id
                                        "
                                    >
                                        {{ permission.name }}
                                    </label>
                                </td>
                                <td>
                                    {{ permission.description }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <button class="btn btn-primary mt-4">Simpan</button>
            </form>
        </div>
    </AdminLayout>
</template>
