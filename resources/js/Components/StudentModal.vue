<template>
    <!-- Button trigger modal -->
    <button
        type="button"
        class="btn btn-md btn-primary border-0 shadow w-100"
        data-bs-toggle="modal"
        data-bs-target="#studentModal"
    >
        {{ namebutton }}
    </button>

    <!-- Modal -->
    <div
        class="modal fade"
        id="studentModal"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ title }}
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit">
                        <label for="clasroomTitle">Classroom</label>
                        <select class="form-select" v-model="form.classroom_id">
                            <option
                                v-for="(classroom, index) in classrooms"
                                :key="index"
                                :value="classroom.id"
                            >
                                {{ classroom.title }}
                            </option>
                        </select>
                        <label for="studentNisn">NISN</label>
                        <input
                            id="studentNisn"
                            type="text"
                            class="form-control mb-2"
                            placeholder="Insert your NISN"
                            v-model="form.nisn"
                        />
                        <label for="studentName">Name</label>
                        <input
                            id="studentName"
                            type="text"
                            class="form-control mb-2"
                            placeholder="Insert your name"
                            v-model="form.name"
                        />
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                v-model="form.gender"
                                value="L"
                                id="maleStudent"
                            />
                            <label class="form-check-label" for="maleStudent">
                                Male
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                v-model="form.gender"
                                value="P"
                                id="femaleStudent"
                                checked
                            />
                            <label class="form-check-label" for="femaleStudent">
                                Female
                            </label>
                        </div>

                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";

export default {
    props: {
        errors: Object,
        classrooms: Object,
        title: String,
        namebutton: String,
    },

    setup() {
        const form = reactive({
            classroom_id: "",
            nisn: "",
            name: "",
            gender: "",
        });

        const submit = () => {
            Inertia.post(
                "/admin/students",
                {
                    classroom_id: form.classroom_id,
                    nisn: form.nisn,
                    name: form.name,
                    gender: form.gender,
                },
                {
                    onSuccess: () => {
                        Swal.fire({
                            title: "Success!",
                            text: "Student Saved!",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000,
                        });

                        resetForm();
                    },
                    onError: () => {
                        Swal.fire({
                            title: "Error!",
                            text: "Data Not Uniqe & Check Data Correctly!",
                            icon: "error",
                            showConfirmButton: true,
                        });
                    },
                }
            );
        };

        const resetForm = () => {
            form.title = "";
        };

        return {
            form,
            submit,
        };
    },
};
</script>
