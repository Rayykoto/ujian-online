<template>
    <Head>
        <title>Modify Student - Application</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link
                    href="/admin/students"
                    class="btn btn-md btn-primary border-0 shadow mb-3"
                    type="button"
                    ><i class="fa fa-long-arrow-alt-left me-2"></i> Back</Link
                >
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-bookmark"></i> Modify Student</h5>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>NISN</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Input your NISN"
                                            v-model="form.nisn"
                                        />
                                        <div
                                            v-if="errors.nisn"
                                            class="alert alert-danger mt-2"
                                        >
                                            {{ errors.nisn }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Full Name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Input your student"
                                            v-model="form.name"
                                        />
                                        <div
                                            v-if="errors.name"
                                            class="alert alert-danger mt-2"
                                        >
                                            {{ errors.name }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Class</label>
                                        <select
                                            class="form-select"
                                            v-model="form.classroom_id"
                                        >
                                            <option disabled value>
                                                Choose One
                                            </option>
                                            <option
                                                v-for="(
                                                    classroom, index
                                                ) in classrooms"
                                                :key="index"
                                                :value="classroom.id"
                                            >
                                                {{ classroom.title }}
                                            </option>
                                        </select>
                                        <div
                                            v-if="errors.classroom_id"
                                            class="alert alert-danger mt-2"
                                        >
                                            {{ errors.classroom_id }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Gender</label>
                                        <select
                                            class="form-select"
                                            v-model="form.gender"
                                        >
                                            <option disabled value>
                                                Choose One
                                            </option>
                                            <option value="L">Male</option>
                                            <option value="P">Female</option>
                                        </select>
                                        <div
                                            v-if="errors.gender"
                                            class="alert alert-danger mt-2"
                                        >
                                            {{ errors.gender }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-md btn-primary border-0 shadow me-2"
                            >
                                Save
                            </button>
                            <button
                                type="reset"
                                class="btn btn-md btn-warning border-0 shadow"
                            >
                                Reset
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import layout
import LayoutAdmin from "../../../Layouts/Admin.vue";

//import Heade and Link from Inertia
import { Head, Link } from "@inertiajs/inertia-vue3";

//import reactive from vue
import { reactive } from "vue";

//import inerita adapter
import { Inertia } from "@inertiajs/inertia";

//import sweet alert2
import Swal from "sweetalert2";

export default {
    //layout
    layout: LayoutAdmin,

    //register components
    components: {
        Head,
        Link,
    },

    //props
    props: {
        errors: Object,
        student: Object,
        classrooms: Array,
    },

    //inisialisasi composition API
    setup(props) {
        //define form with reactive
        const form = reactive({
            nisn: props.student.nisn,
            name: props.student.name,
            classroom_id: props.student.classroom_id,
            gender: props.student.gender,
        });

        //method "submit"
        const submit = () => {
            //send data to server
            Inertia.put(
                `/admin/students/${props.student.id}`,
                {
                    //data
                    nisn: form.nisn,
                    name: form.name,
                    classroom_id: form.classroom_id,
                    gender: form.gender,
                },
                {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: "Success!",
                            text: "Student Success Updated!.",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    },
                }
            );
        };

        //return
        return {
            form,
            submit,
        };
    },
};
</script>

<style></style>
