<template>
    <Head>
        <title>Mata Pelajaran - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3 col-12 mb-2">
                        <!-- <Link
                            href="/admin/lessons/create"
                            class="btn btn-md btn-primary border-0 shadow w-100"
                            type="button"
                            ><i class="fa fa-plus-circle"></i> Tambah</Link
                        > -->
                        <Modal />
                    </div>
                    <div class="col-md-9 col-12 mb-2">
                        <form @submit.prevent="handleSearch">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control border-0 shadow"
                                    v-model="search"
                                    placeholder="masukkan kata kunci dan enter..."
                                />
                                <span class="input-group-text border-0 shadow">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-centered table-nowrap mb-0 rounded"
                            >
                                <thead class="thead-dark">
                                    <tr class="border-0">
                                        <th
                                            class="border-0 rounded-start"
                                            style="width: 5%"
                                        >
                                            No.
                                        </th>
                                        <th class="border-0">Name Lessons</th>
                                        <th
                                            class="border-0 rounded-end"
                                            style="width: 15%"
                                        >
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <div class="mt-2"></div>
                                <tbody>
                                    <tr
                                        v-for="(lesson, index) in lessons.data"
                                        :key="index"
                                    >
                                        <td class="fw-bold text-center">
                                            {{
                                                ++index +
                                                (lessons.current_page - 1) *
                                                    lessons.per_page
                                            }}
                                        </td>
                                        <td>{{ lesson.title }}</td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                                <!-- Show validation error -->
                                <!-- <div
                                    v-if="errors.title"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.title }}
                                </div> -->
                            </table>
                        </div>
                        <Pagination :links="lessons.links" align="end" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import layout
import LayoutAdmin from "../../../Layouts/Admin.vue";

//import component pagination
import Pagination from "../../../Components/Pagination.vue";

//import Heade and Link from Inertia
import { Head, Link } from "@inertiajs/inertia-vue3";

//import ref from vue
import { ref } from "vue";

//import inertia adapter
import { Inertia } from "@inertiajs/inertia";

import Modal from "./Modal.vue";

export default {
    //layout
    layout: LayoutAdmin,

    //register component
    components: {
        Head,
        Link,
        Pagination,
        Modal,
    },

    //props
    props: {
        errors: Object,
        lessons: Object,
    },

    //inisialisasi composition API
    setup() {
        //define state search
        const search = ref(
            "" || new URL(document.location).searchParams.get("q")
        );

        //define method search
        const handleSearch = () => {
            Inertia.get("/admin/lessons", {
                //send params "q" with value from state "search"
                q: search.value,
            });
        };

        //return
        return {
            search,
            handleSearch,
        };
    },
};
</script>

<style></style>
