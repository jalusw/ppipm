<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

import DashboardIcon from "./Icons/DashboardIcon.vue";
import DiamondIcon from "./Icons/DiamondIcon.vue";
import CategoryIcon from "./Icons/CategoryIcon.vue";
import UsersIcon from "./Icons/UsersIcon.vue";
import UserPlusIcon from "./Icons/UserPlusIcon.vue";
import KeyIcon from "./Icons/KeyIcon.vue";
import ExtensionIcon from "./Icons/ExtensionIcon.vue";
import StoreIcon from "./Icons/StoreIcon.vue";
import HandshakeIcon from "./Icons/HandshakeIcon.vue";
import ApartmentIcon from "./Icons/ApartementIcon.vue";
import MapIcon from "./Icons/MapIcon.vue";

const page = usePage();
const user = computed(() => page.props.auth.user);
const hasPermission = (permissionLookup) =>
    user.value.permissions.find((permission) => permissionLookup);
</script>

<template>
    <section>
        <nav>
            <ul class="menu space-y-2">
                <li>
                    <Link :href="route('dashboard')">
                        <DashboardIcon />
                        <span> Dashboard </span>
                    </Link>
                </li>
            </ul>
            <ul class="menu space-y-2">
                <span class="menu-title">Kemitraan</span>
                <li>
                    <Link
                        v-if="hasPermission('management.kemitraans')"
                        :href="route('management.kemitraans')"
                    >
                        <HandshakeIcon />
                        Daftar Kemitraan</Link
                    >
                </li>
                <li>
                    <Link
                        v-if="hasPermission('management.kemitraans')"
                        :href="route('management.kemitraans.create')"
                    >
                        <HandshakeIcon />
                        Buat Kemitraan</Link
                    >
                </li>
                <ul v-if="hasPermission('management.umkms')" class="menu">
                    <span class="menu-title">UMKM</span>
                    <li>
                        <Link :href="route('management.umkms')">
                            <StoreIcon />
                            <span> Data UMKM </span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('management.umkms.create')">
                            <StoreIcon />
                            Entry Data UMKM</Link
                        >
                    </li>
                </ul>
                <ul v-if="hasPermission('management.perusahaans')" class="menu">
                    <span class="menu-title">Perusahaan</span>
                    <li>
                        <Link :href="route('management.perusahaans')">
                            <ApartmentIcon />
                            Data Perusahaan</Link
                        >
                    </li>
                    <li>
                        <Link :href="route('management.perusahaans.create')">
                            <ApartmentIcon />
                            Entry Data Perusahaan</Link
                        >
                    </li>
                </ul>
            </ul>
            <ul
                v-if="hasPermission('management.comodities')"
                class="menu space-y-2"
            >
                <span class="menu-title">Manajemen Komoditas</span>
                <li>
                    <Link :href="route('management.comodities')">
                        <DiamondIcon />
                        <span> Daftar Komoditas </span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('management.comodities.archived')">
                        <DiamondIcon />
                        <span> Arsip Komoditas </span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('management.comodities.create')">
                        <DiamondIcon />
                        <span> Buat Komoditas</span>
                    </Link>
                </li>
            </ul>
            <ul class="menu space-y-2">
                <span class="menu-title">Manajemen Klasifikasi</span>
                <li>
                    <ul v-if="hasPermission('management.sectors')" class="menu">
                        <span class="menu-title">Master Sektor</span>
                        <li>
                            <Link :href="route('management.sectors')">
                                <CategoryIcon />
                                <span> Daftar Sektor </span>
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('management.sectors.create')">
                                <CategoryIcon />
                                <span> Buat Sektor </span>
                            </Link>
                        </li>
                    </ul>
                </li>
                <li>
                    <ul
                        v-if="hasPermission('management.sub-sectors')"
                        class="menu"
                    >
                        <span class="menu-title">Master Sub Sektor</span>
                        <li>
                            <Link :href="route('management.sub-sectors')">
                                <CategoryIcon />
                                <span> Daftar Sub Sektor </span>
                            </Link>
                        </li>
                        <li>
                            <Link
                                :href="route('management.sub-sectors.create')"
                            >
                                <CategoryIcon />
                                <span> Buat Sub Sektor </span>
                            </Link>
                        </li>
                    </ul>
                </li>
                <li>
                    <ul
                        v-if="hasPermission('management.master-categories')"
                        class="menu"
                    >
                        <span class="menu-title">Master Kategori</span>
                        <li>
                            <Link :href="route('management.master-categories')">
                                <CategoryIcon />
                                <span> Daftar Kategori </span>
                            </Link>
                            <Link
                                :href="
                                    route('management.master-categories.create')
                                "
                            >
                                <CategoryIcon />
                                <span> Buat Kategori </span>
                            </Link>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="menu space-y-2">
                <span class="menu-title">Master Data</span>
                <ul
                    v-if="hasPermission('management.jenis-perusahaans')"
                    class="menu"
                >
                    <span class="menu-title">Manajemen Jenis Perusahaan</span>
                    <li>
                        <Link :href="route('management.jenis-perusahaans')">
                            <span>Jenis Perusahaan</span>
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="route('management.jenis-perusahaans.create')"
                        >
                            <span>Buat Jenis Perusahaan</span>
                        </Link>
                    </li>
                </ul>
                <ul
                    v-if="hasPermission('management.status-penanaman-modals')"
                    class="menu"
                >
                    <span class="menu-title"
                        >Manajemen Status Penanaman Modal</span
                    >
                    <li>
                        <Link
                            :href="route('management.status-penanaman-modals')"
                        >
                            <span>Status Penanaman Modal</span>
                        </Link>
                    </li>
                    <li>
                        <Link
                            :href="
                                route(
                                    'management.status-penanaman-modals.create'
                                )
                            "
                        >
                            <span>Buat Status Penanaman Modal</span>
                        </Link>
                    </li>
                </ul>
                <ul v-if="hasPermission('management.kecamatans')" class="menu">
                    <span class="menu-title">Manajemen Kecamatan</span>
                    <li>
                        <Link :href="route('management.kecamatans')">
                            <MapIcon />
                            <span>Daftar Kecamatan</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('management.kecamatans.create')">
                            <MapIcon />
                            <span>Buat Kecamatan</span>
                        </Link>
                    </li>
                </ul>
                <ul v-if="hasPermission('management.kelurahans')" class="menu">
                    <span class="menu-title">Manajemen Kelurahan</span>
                    <li>
                        <Link :href="route('management.kelurahans')">
                            <MapIcon />
                            <span>Daftar Kelurahan</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('management.kelurahans.create')">
                            <MapIcon />
                            <span>Buat Kelurahan</span>
                        </Link>
                    </li>
                </ul>
                <ul v-if="hasPermission('management.file-types')" class="menu">
                    <span class="menu-title">Manajemen Tipe File</span>
                    <li>
                        <Link :href="route('management.file-types')">
                            <ExtensionIcon />
                            <span>Daftar Tipe File</span>
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('management.file-types.create')">
                            <ExtensionIcon />
                            <span>Buat Tipe File</span>
                        </Link>
                    </li>
                </ul>
            </ul>

            <ul v-if="hasPermission('management.users')" class="menu space-y-2">
                <span class="menu-title">Manajemen Pengguna</span>
                <li>
                    <Link :href="route('management.users')">
                        <UsersIcon />
                        <span>Daftar Pengguna</span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('management.users.create')">
                        <UserPlusIcon />
                        <span>Buat Pengguna</span>
                    </Link>
                </li>
            </ul>
            <ul
                v-if="hasPermission('management.permissions')"
                class="menu space-y-2"
            >
                <span class="menu-title">Manajemen Hak Akses</span>
                <li>
                    <Link :href="route('management.permissions')">
                        <KeyIcon />
                        <span> Daftar Hak Akses </span>
                    </Link>
                </li>
                <li>
                    <Link :href="route('management.permissions.create')">
                        <KeyIcon />
                        <span> Buat Hak Akses </span>
                    </Link>
                </li>
            </ul>
        </nav>
    </section>
</template>
