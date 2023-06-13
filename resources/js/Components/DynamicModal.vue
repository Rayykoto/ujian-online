<template>
    <div>
        <button @click="openModal">Open Modal</button>

        <b-modal v-model="showModal" @hide="closeModal">
            <template #modal-title> Dynamic Form Modal </template>
            <template #default>
                <form>
                    <div v-for="field in formFields" :key="field.id">
                        <label>{{ `Field ${field.id}` }}</label>
                        <input type="text" />
                        <button @click="removeField(field.id)">
                            Remove Field
                        </button>
                    </div>
                </form>
                <button @click="addField">Add Field</button>
            </template>
            <template #modal-footer>
                <button @click="closeModal">Close</button>
                <button @click="closeModal">Save Changes</button>
            </template>
        </b-modal>
    </div>
</template>

<script>
import { ref } from "vue";

export default {
    name: "DynamicFormComponent",
    setup() {
        const showModal = ref(false);
        const formFields = ref([]);

        const openModal = () => {
            showModal.value = true;
        };

        const closeModal = () => {
            showModal.value = false;
        };

        const addField = () => {
            formFields.value.push({ id: formFields.value.length + 1 });
        };

        const removeField = (id) => {
            formFields.value = formFields.value.filter(
                (field) => field.id !== id
            );
        };

        return {
            showModal,
            formFields,
            openModal,
            closeModal,
            addField,
            removeField,
        };
    },
};
</script>
