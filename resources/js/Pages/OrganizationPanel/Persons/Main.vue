<template>
    <div class="p-6">
        <PersonList v-if="currentPage=== 'list'" @entry-page="clearForm" @edit-item="edit"></PersonList>
        <PersonEntry v-if="currentPage=== 'entry'" @back-page="currentPage = 'list'" :person="edit_item"></PersonEntry>
    </div>
</template>
<script>
import {Head} from "@inertiajs/vue3";
import {defineComponent} from "vue";
import {Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PersonList from "./list.vue";
import PersonEntry from "./entry.vue";

export default defineComponent({
    components: {PrimaryButton, Head, Link, PersonList, PersonEntry},
    data() {
        return {
            currentPage: "list",
            edit_item: null,
        }
    },
    created() {
    },
    methods: {
        edit(item) {
            this.edit_item = item;
            this.currentPage = "entry";
        },
        clearForm() {
            this.edit_item = null;
            this.currentPage = 'entry';
        },
    }
});
</script>
