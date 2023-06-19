<template>
    <!-- Button trigger modal -->
    <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#classroomModal"
    >
        Create
    </button>

    <!-- Modal -->
    <div
        class="modal fade"
        id="classroomModal"
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
                        <label for="classroomTitle">Name Classroom</label>
                        <input
                            id="classroomTitle"
                            type="text"
                            class="form-control"
                            placeholder="Insert your classroom"
                            v-model="form.title"
                        />
                        <!-- Show validation error -->
                        <div
                            v-if="errors && errors.title"
                            class="alert alert-danger mt-2"
                        >
                            {{ errors.title }}
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
        title: String,
    },

    setup() {
        const form = reactive({
            title: "",
        });

        const submit = () => {
            Inertia.post(
                "/admin/classrooms",
                {
                    title: form.title,
                },
                {
                    onSuccess: () => {
                        Swal.fire({
                            title: "Success!",
                            text: "Classroom Saved!",
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
