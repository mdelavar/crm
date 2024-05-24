<template>
    <div v-if="is_edit" class="text-2xl bg-themeLightPrimary p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="edit"/>
        ویرایش {{ this.form.name }}
    </div>
    <div v-else class="text-2xl bg-themeLightPrimary text-white p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="plus"/>
        افزودن محصول جدید
    </div>
    <div class="p-8">

        <form>
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-4 text-center mb-6">
                    <div
                        class="w-32 mx-auto h-44 flex-none image-fit relative overlay-loading-wrapper"
                    >
                        <img
                            class="rounded-md border-themeLightPrimary w-full h-full border-2 object-cover"
                            :src="getImage"
                        />
                        <div
                            class="upload-avatar-button absolute flex items-center justify-center cursor-pointer z-10 -left-1 -bottom-1 w-8 h-8 bg-themeDarkPrimary  rounded-full"
                        >
                            <Tippy class="flex" content="سایز مطلوب 300 در 400 پیکسل">
                                <vue-feather size="20" type="camera" class="text-white"/>
                                <input
                                    id="select-file"
                                    autofocus
                                    autocomplete="off"
                                    type="file"
                                    accept="image/png, image/jpeg"
                                    class="w-full h-full top-0 left-0 absolute opacity-0 cursor-pointer"
                                    placeholder=""
                                    @change="updateImage($event)"
                                />
                            </Tippy>
                        </div>
                    </div>
                </div>
                <div class="col-span-2">
                    <label class="required block text-gray-700 text-sm  mb-2" for="username">
                       نام
                    </label>
                    <input v-model="form.name"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>

                <div class="col-span-2">
                    <label class=" block text-gray-700 text-sm  mb-2" for="username">
                        نام انگلیسی
                    </label>
                    <input v-model="form.en_name"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>
                <div class="col-span-4 text-center">
                    <label class="required block text-gray-700 text-sm mb-2  text-right">
                        دسته بندی محصول
                    </label>
                    <TailSelect
                        v-model="form.product_category_id"
                        :options="{
                            search: true,
                            searchFocus: true,
                            sourceBind: true,
                          }"

                    >
                        <option>-</option>
                        <option
                            v-for="(item , index) in categories"
                            :key="index"
                            :value="item.id"
                            class="text-center"
                            :selected="form.product_category_id === item.id"
                        >
                            {{ item.title }}
                        </option>
                    </TailSelect>
                </div>
                <div class="col-span-4">
                     <textarea
                         v-model="form.description"
                         class="resize-none w-full rounded-md"
                         rows="3"
                         placeholder="توضیحات"></textarea>
                </div>
            </div>
        </form>
        <div class="mt-5">
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center">
                    <ButtonWithLoading :loading="!btn_allow" @click="submit_form(false)">
                        {{ is_edit ? 'ویرایش' : 'ثبت' }}
                    </ButtonWithLoading>
                    <ButtonWithLoading v-if="!is_edit" class="mx-3" @click="submit_form(true)" :loading="!btn_allow"
                                       type="submit">
                        ثبت و ادامه
                    </ButtonWithLoading>
                </div>
                <DangerButton @click="$emit('close')">انصراف</DangerButton>
            </div>
        </div>
    </div>
</template>

<script>
import {defineComponent} from "vue";
import ButtonWithLoading from "@/Components/button-with-loading/Main.vue";
import DangerButton from "@/Components/DangerButton.vue";
import DefLogo from "@/Images/avatar.jpg";

export default defineComponent({
    components: {DangerButton, ButtonWithLoading},
    props: {
        edit_items: {
            type: Object,
            default: null,
        },
        categories: {
            type: Array,
            default: []
        },
    },
    computed: {
        getImage() {
            return this.form.pic ?? DefLogo;
        },
    },
    data() {
        return {
            formData: null,
            is_edit: false,
            btn_allow: true,
            form: {
                id: null,
                name: null,
                en_name: null,
                product_category_id: null,
                description: null,
                pic: null,
            }
        };
    },

    watch: {},
    created() {
        this.formData = new FormData();
        if (Object.keys(this.edit_items).length > 0) {
            this.is_edit = true;
            this.form.id = this.edit_items.id;
            this.form.name = this.edit_items.name;
            this.form.en_name = this.edit_items.en_name;
            this.form.product_category_id = this.edit_items.product_category_id;
            this.form.description = this.edit_items.description;
            this.form.pic = this.edit_items.pic;
        } else {
            this.is_edit = false;
            this.form.id = null;
            this.form.name = null;
            this.form.en_name = null;
            this.form.product_category_id = null;
            this.form.description = null;
            this.form.pic = null;
        }
    },
    methods: {
        updateImage(e) {
            const reader = new FileReader();
            const file = e.target.files[0];
            reader.readAsDataURL(file);
            reader.onloadend = () => {
                this.formData.append("pic", file);
                this.form.pic = URL.createObjectURL(file);
            };
        },
        submit_form(submit_new) {
            this.btn_allow = false;
            this.formData.append("id", this.form.id);
            this.formData.append("name", this.form.name);
            this.formData.append("en_name", this.form.en_name ?? '');
            this.formData.append("product_category_id", this.form.product_category_id);
            this.formData.append("description", this.form.description ?? '');
            if (this.is_edit) {
                this.formData.append("_method", "put");
                this.axios
                    .post(`/products/` + this.form.id, this.formData, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    })
                    .then(({data}) => {
                        this.$emit('reload', 1, false);
                    })
                    .catch(function (error) {
                    })
                    .finally(() => {
                        this.btn_allow = true;
                    });

            } else {
                this.axios
                    .post(`/products`, this.formData, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    })
                    .then(({data}) => {
                        this.btn_allow = true;
                        this.$emit('reload', 1, submit_new);
                        if (submit_new) {
                            this.form.id = null;
                            this.form.name = '';
                            this.form.en_name = null;
                            this.form.product_category_id = null;
                            this.form.description = null;
                            this.form.pic = null;
                        }
                    })
                    .catch(function (error) {
                    })
                    .finally(() => {
                        this.btn_allow = true;
                    });
            }
        }
    },
});
</script>
