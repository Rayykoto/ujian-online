<template>
    <Head>
        <title>Classrooms - Aplication</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3 col-12 mb-2">
                        <ClassroomModal />
                    </div>
                    <div class="col-md-9 col-12 mb-2">
                        <form @submit.prevent="handleSearch">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control border-0 shadow"
                                    v-model="search"
                                    placeholder="Search title lesson and enter.."
                                />
                                <button
                                    class="input-group-text border-0 shadow"
                                >
                                    <i class="fa fa-search"></i>
                                </button>
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
                                        v-for="(
                                            classroom, index
                                        ) in classrooms.data"
                                        :key="index"
                                    >
                                        <td class="fw-bold text-center">
                                            {{
                                                ++index +
                                                (classrooms.current_page - 1) *
                                                    classrooms.per_page
                                            }}
                                        </td>
                                        <td>{{ classroom.title }}</td>
                                        <td class="text-center">
                                            <Link
                                                :href="`/admin/lessons/${classroom.id}/edit`"
                                                class="btn btn-sm btn-info border-0 shadow me-2"
                                                type="button"
                                                ><i class="fa fa-pencil-alt"></i
                                            ></Link>
                                            <button
                                                @click.prevent="
                                                    destroy(classroom.id)
                                                "
                                                class="btn btn-sm btn-danger border-0"
                                            >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :links="classrooms.links" align="end" />
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

//import sweet alert2
import Swal from "sweetalert2";

//import classrooms
import ClassroomModal from "../../../Components/ClassroomModal.vue";

export default {
    //layout
    layout: LayoutAdmin,

    //register component
    components: {
        Head,
        Link,
        Pagination,
        ClassroomModal,
    },

    //props
    props: {
        errors: Object,
        classrooms: Object,
    },

    //inisialisasi composition API
    setup() {
        const search = ref(
            "" || new URL(document.location).searchParams.get("q")
        );

        //define method search
        const handleSearch = () => {
            Inertia.get("/admin/classrooms", {
                //send params "q" with value from state "search"
                q: search.value,
            });
        };

        //destroy
        const destroy = (id) => {
            Swal.fire({
                title: "Are you sure?",
                text: "You can't restore this data!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Inertia.delete(`/admin/classrooms/${id}`);

                    Swal.fire({
                        title: "Deleted!",
                        text: "Pelajaran Berhasil Dihapus!.",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            });
        };

        //return
        return {
            search,
            handleSearch,
            destroy,
        };
    },
};
</script>

<style></style>
