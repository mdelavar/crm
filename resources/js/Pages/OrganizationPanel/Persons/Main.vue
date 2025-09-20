<template>
    <div class="p-6">
        <PersonList v-if="currentPage=== 'list'" @entry-page="clearForm" @edit-item="edit"
                    @excel-page="currentPage = 'excel'" @report-item="reportPage"></PersonList>
        <PersonEntry v-if="currentPage=== 'entry'" @back-page="currentPage = 'list'" :person="edit_item"></PersonEntry>
        <PersonFromExcel v-if="currentPage=== 'excel'" @back-page="currentPage = 'list'"
                         @reload="currentPage = 'list'"></PersonFromExcel>
        <PersonReport v-if="currentPage=== 'report'" @back-page="currentPage = 'list'" :person="edit_item"
                        ></PersonReport>
    </div>
</template>
<script>
import {Head} from "@inertiajs/vue3";
import {defineComponent} from "vue";
import {Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PersonList from "./list.vue";
import PersonEntry from "./entry.vue";
import PersonFromExcel from "./ImportFromExcel.vue";
import PersonReport from "./report.vue";

export default defineComponent({
    components: {PrimaryButton, Head, Link, PersonList, PersonEntry , PersonFromExcel , PersonReport},
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
        reportPage(item) {
            this.edit_item = item;
            this.currentPage = "report";
        },
        clearForm() {
            this.edit_item = null;
            this.currentPage = 'entry';
        },
    }
});
</script>
