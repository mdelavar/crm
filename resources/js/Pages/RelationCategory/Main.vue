<script setup>
import {Head} from '@inertiajs/vue3';
import Modal from "@/Components/Modal.vue";
</script>

<template>
    <Head title="دسته بندی ارتباطات"/>
    <DashboardLayout route-name="relation_category">
        <Card>
            <Table
                class="intro-y inbox box mt-5 p-5"
            />
        </Card>

    </DashboardLayout>
</template>

<script>
import {defineComponent, computed, onMounted, ref, watch} from "vue";

import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Card from "@/Components/Card.vue";
import Table from "./Table.vue";


export default defineComponent({
    components: {
        Table,
        Card,
        DashboardLayout
    },
});
</script>
