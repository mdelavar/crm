<template>
    <div class="text-2xl bg-themeLightPrimary text-white p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="key"/>
        دسترسی های {{ this.form.name }}
    </div>
    <div class="p-8">

        <form>
            <div v-if="isLoading" class="flex justify-center mx-auto p-5">
                <LoadingIcon
                    icon="three-dots"
                    color="#000"
                    class="w-10 h-10 z-10 overlay-loading anim-scale-up"
                />
            </div>
            <div class="grid grid-cols-3 gap-2">
                <div class="col-span-1" v-for="(item , index) in permissions">
                    <label class="inline-flex items-center text-themePrimary cursor-pointer bg-themeOverlyPrimary rounded w-full py-2">
                        <Checkbox v-model="item.checked" :checked="item.checked" class="mx-2"/>
                        {{ item.name }}
                    </label>
                </div>
            </div>
        </form>
        <div class="mt-5">
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center">
                    <ButtonWithLoading :loading="!btn_allow" @click="submit_form(false)">
                        ویرایش
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
import Checkbox from "@/Components/Checkbox.vue";
import DangerButton from "@/Components/DangerButton.vue";
import LoadingIcon from "@/Components/loading-icon/Main.vue";

export default defineComponent({
    components: {LoadingIcon, DangerButton, Checkbox, ButtonWithLoading},
    props: {
        edit_items: {
            type: Object,
            default: null,
        },
    },
    computed: {},
    data() {
        return {
            isLoading: true,
            permissions: [],
            btn_allow: true,
            form: {
                id: null,
                name: null,
                email: null,
                password: null,
                repeatPassword: null,
            }
        };
    },

    watch: {},
    created() {
        if (Object.keys(this.edit_items).length > 0) {
            this.form.id = this.edit_items.id;
            this.form.name = this.edit_items.name;
            this.form.email = this.edit_items.email;
            this.form.password = null;
            this.form.repeatPassword = null;
        }
        this.getPermissions();
    },
    methods: {
        getPermissions() {
            this.isLoading = true;
            this.axios
                .get("/user-permissions/" + this.form.id, {})
                .then(({data}) => {
                    this.permissions = data;
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
        submit_form(submit_new) {
            this.btn_allow = false;
            this.axios
                .post(`/user-permissions/` + this.form.id, {"permissions": this.permissions}, {})
                .then(({data}) => {
                    this.$emit('reload', 1, false);
                })
                .catch(function (error) {
                })
                .finally(() => {
                    this.btn_allow = true;
                });
        }
    },
});
</script>
