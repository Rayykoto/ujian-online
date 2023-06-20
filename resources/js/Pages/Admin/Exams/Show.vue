<template>
    <Head>
        <title>Detail Ujian - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link
                    href="/admin/exams"
                    class="btn btn-md btn-primary border-0 shadow mb-3"
                    type="button"
                    ><i class="fa fa-long-arrow-alt-left me-2"></i> Back</Link
                >

                <div class="card border-0 shadow mb-4">
                    <div class="card-body">
                        <h5><i class="fa fa-edit"></i> Detail Exam</h5>
                        <hr />
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-centered table-nowrap mb-0 rounded"
                            >
                                <tbody>
                                    <tr>
                                        <td style="width: 30%" class="fw-bold">
                                            Exam Name
                                        </td>
                                        <td>{{ exam.title }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Lesson Name</td>
                                        <td>{{ exam.lesson.title }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Class</td>
                                        <td>{{ exam.classroom.title }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Many Questions</td>
                                        <td>
                                            {{ exam.questions.data.length }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">
                                            Duration (Menit)
                                        </td>
                                        <td>{{ exam.duration }} Minute</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5>
                            <i class="fa fa-question-circle"></i> Question Exam
                        </h5>
                        <hr />

                        <Link
                            :href="`/admin/exams/${exam.id}/questions/create`"
                            class="btn btn-md btn-primary border-0 shadow me-2"
                            type="button"
                            ><i class="fa fa-plus-circle"></i> Add</Link
                        >
                        <!-- <Link
                            :href="`/admin/exams/${exam.id}/questions/import`"
                            class="btn btn-md btn-success border-0 shadow text-white"
                            type="button"
                            ><i class="fa fa-file-excel"></i> Import</Link
                        > -->

                        <div class="table-responsive mt-3">
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
                                        <th class="border-0">Question</th>
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
                                        v-for="(question, index) in exam
                                            .questions.data"
                                        :key="index"
                                    >
                                        <td class="fw-bold text-center">
                                            {{
                                                ++index +
                                                (exam.questions.current_page -
                                                    1) *
                                                    exam.questions.per_page
                                            }}
                                        </td>
                                        <td>
                                            <div
                                                class="fw-bold"
                                                v-html="question.question"
                                            ></div>
                                            <hr />
                                            <ol type="A">
                                                <li
                                                    v-html="question.option_1"
                                                    :class="{
                                                        'text-success fw-bold':
                                                            question.answer ==
                                                            '1',
                                                    }"
                                                ></li>
                                                <li
                                                    v-html="question.option_2"
                                                    :class="{
                                                        'text-success fw-bold':
                                                            question.answer ==
                                                            '2',
                                                    }"
                                                ></li>
                                                <li
                                                    v-html="question.option_3"
                                                    :class="{
                                                        'text-success fw-bold':
                                                            question.answer ==
                                                            '3',
                                                    }"
                                                ></li>
                                                <li
                                                    v-html="question.option_4"
                                                    :class="{
                                                        'text-success fw-bold':
                                                            question.answer ==
                                                            '4',
                                                    }"
                                                ></li>
                                                <li
                                                    v-html="question.option_5"
                                                    :class="{
                                                        'text-success fw-bold':
                                                            question.answer ==
                                                            '5',
                                                    }"
                                                ></li>
                                            </ol>
                                        </td>
                                        <td class="text-center">
                                            <Link
                                                :href="`/admin/exams/${exam.id}/questions/${question.id}/edit`"
                                                class="btn btn-sm btn-info border-0 shadow me-2"
                                                type="button"
                                                ><i class="fa fa-pencil-alt"></i
                                            ></Link>
                                            <button
                                                @click.prevent="
                                                    destroy(
                                                        exam.id,
                                                        question.id
                                                    )
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
                        <Pagination :links="exam.questions.links" align="end" />
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

export default {
    //layout
    layout: LayoutAdmin,

    //register components
    components: {
        Head,
        Link,
        Pagination,
    },

    //props
    props: {
        errors: Object,
        exam: Object,
    },
};
</script>

<style></style>
