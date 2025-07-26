<template>
    <Head title="پروفایل"/>
    <div v-if="getNationalCode().length > 0" class="bg-gray-50 text-black/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-screen-2xl px-6 my-10">
                <div
                    class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300"
                >
                    <div class="grid md:grid-cols-4 grid-cols-1 w-full min-h-[86vh]">

                        <div class="col-span-1 p-6 bg-blue-600 flex flex-col justify-center items-center">
                            <div class="text-xl text-white font-bold">{{ getFullName() }}</div>
                            <div class="text-sm text-indigo-50">{{ getNationalCode() }}</div>
                            <div @click="logout" class="bg-white text-sm text-red-600 px-1 rounded cursor-pointer mt-2">
                                خروج
                            </div>
                            <div class="w-full mx-5 my-4 border-b-2 border-dotted border-white"></div>
                            <div class="flex flex-col w-full">
                                <div @click="changePage('request')"
                                     class="flex text-white cursor-pointer my-2 p-2 rounded"
                                     :class="{'bg-white !text-black' : currentPage === 'request'}">
                                    <vue-feather size="20" type="file-plus" class="ml-2"/>
                                    درخواست اقامت
                                </div>
                                <div @click="changePage('reserves')"
                                     class="flex text-white cursor-pointer my-2 p-2 rounded"
                                     :class="{'bg-white !text-black' : currentPage === 'reserves'}">
                                    <vue-feather size="20" type="list" class="ml-2"/>
                                    فهرست درخواست ها
                                </div>
<!--                                <div @click="changePage('payments')"-->
<!--                                     class="flex text-white cursor-pointer my-2 p-2 rounded"-->
<!--                                     :class="{'bg-white !text-black' : currentPage === 'payments'}">-->
<!--                                    <vue-feather size="20" type="credit-card" class="ml-2"/>-->
<!--                                    پرداخت ها-->
<!--                                </div>-->
                                <div @click="changePage('profile')"
                                     class="flex text-white cursor-pointer my-2 p-2 rounded"
                                     :class="{'bg-white !text-black' : currentPage === 'profile'}">
                                    <vue-feather size="20" type="user" class="ml-2"/>
                                    پروفایل
                                </div>
                            </div>
                        </div>
                        <div class="col-span-3 p-6  min-h-[60vh]">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-else class="bg-gray-50 text-black py-10">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-4xl">
                <div
                    class="p-10 flex flex-col items-center justify-center gap-6 overflow-hidden rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300"
                >
                    <div>برای استفاده از امکانات سایت لطفا اطلاعات خودرا تکمیل نمائید</div>
                    <DetailPage/>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
import {Head} from "@inertiajs/vue3";
import {defineComponent} from "vue";
import {Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import auth from "@/auth.js";

export default defineComponent({
    components: {PrimaryButton, Head, Link},
    data() {
        return {
            form: {
                id: null,
                name: "",
                family: "",
                gender: null,
                father_name: "",
                state: "",
                city: "",
                national_code: null,
                birth_date: null,
            },
            isSubmitProfile: false,
            currentPage: "",
        }
    },
    created() {
        this.checkLogin();
    },
    methods: {
        checkLogin() {
            this.axios
                .post('/auth/check', {}, {})
                .then(({data}) => {
                })
                .catch(function (error) {
                    // auth.methods.logout();
                    // window.location.reload()
                })
                .finally(() => {
                    this.isSubmitProfile = false;
                });
        },
        changePage(page) {
            this.currentPage = page;
        },
        submitProfile() {
            this.isSubmitProfile = true;
            this.form.id = auth.methods.getCustomerId();
            this.axios
                .post('/auth/updateProfile/' + this.form.id, this.form, {})
                .then(({data}) => {
                    this.form.is_send = true;
                    auth.methods.updateProfile(data.data['national_code'], data.data['fullName'], data.data['phone'], data.data['id']);
                    window.location.reload();
                })
                .catch(function (error) {
                })
                .finally(() => {
                    this.isSubmitProfile = false;
                });
        },
    }
});
</script>
