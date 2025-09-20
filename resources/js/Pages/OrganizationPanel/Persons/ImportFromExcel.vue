<template>
    <div class="p-4">
        <div class="flex items-center justify-between pb-4 border-b mb-4 border-gray-200">
            <div class="flex items-center justify-center gap-3">
                <div class="font-bold text-lg">افزودن کارمندان از اکسل</div>
                <a target="_blank" href="/files/example.xlsx" class="rounded py-1 px-2 text-sm bg-themeSecondary text-white">فایل نمونه</a>
            </div>

            <DangerButton @click="backPage">بازگشت</DangerButton>
        </div>
        <form @submit.prevent="submitForm()">
            <div>
                <div
                    v-if="fileName.length === 0"
                    class="flex items-center justify-center w-full"
                >
                    <label
                        for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-indigo-300 border-dashed rounded-lg cursor-pointer bg-indigo-50 hover:bg-indigo-100"
                    >
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg
                                aria-hidden="true"
                                class="w-10 h-10 mb-3 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                ></path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="font-semibold">برای آپلود فایل کلیک کنید</span>
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                فرمت فایل آپلود شده باید XLSX یا XLS باشد
                            </p>
                        </div>
                        <input
                            id="dropzone-file"
                            type="file"
                            class="hidden"
                            placeholder=""
                            @change="addFile($event)"
                        />
                    </label>
                </div>
                <div v-else>
                    <div
                        class="truncate flex-1 text-center text-lg p-2 mb-3 rounded-md bg-gray-200 flex justify-between items-center"
                    >
                        {{ fileName }}
                        <vue-feather
                            class="cursor-pointer bg-red-800 text-white w-8 h-8 rounded"
                            type="x"
                            @click="clear"
                        ></vue-feather>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <ButtonWithLoading
                    v-if="fileName.length > 0"
                    :loading="isSaving"
                    type="submit"
                    class="mr-2">
                    ثبت
                </ButtonWithLoading>
            </div>
        </form>
    </div>
</template>

<script>
import {defineComponent} from "vue";
import DangerButton from "@/Components/DangerButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Toastify from "@/toastify.js";
import auth from "@/auth.js";
import ButtonWithLoading from "@/Components/button-with-loading/Main.vue";

export default defineComponent({
    name: "ImportExcel",
    components: {ButtonWithLoading, PrimaryButton, DangerButton},
    data() {
        return {
            isSaving: false,
            formData: null,
            fileName: "",
        };
    },
    emits: ['backPage' , 'reload'],
    created() {
        this.formData = new FormData();
    },
    methods: {
        backPage() {
            this.$emit('backPage')
        },
        clear() {
            this.formData = new FormData();
            this.fileName = "";
        },
        addFile(e) {
            const reader = new FileReader();
            const file = e.target.files[0];
            this.fileName = file.name;
            reader.readAsDataURL(file);
            reader.onloadend = () => {
                this.formData.append("excel", file);
            };
        },
        submitForm() {
            this.isSaving = true;
            this.axios
                .post(`/import-person/` + auth.methods.getData('login_id'), this.formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(() => {
                    this.$emit("reload");
                    Toastify({text: "افزودن با موفقیت انجام شد"}).showToast();

                })
                .finally(() => {
                    this.isSaving = false;
                });
        },
    },
});
</script>
