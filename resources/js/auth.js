import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

export default {
    computed: {
        isLoggedIn() {
            return this.getToken().length > 0;
        },
        isLoggedInOrganization() {
            return this.getToken().length > 0 && this.getData('type') === 'organization';
        },
        isLoggedInCarService() {
            return this.getToken().length > 0 && this.getData('type') === 'car_service';
        },
    },
    methods: {
        getToken() {
            return localStorage.getItem('token') ?? "";
        },
        setToken($token) {
            localStorage.setItem('token', $token)
        },
        setData($data_name, $data) {
            localStorage.setItem($data_name, $data)
        },
        getData($data_name) {
            return localStorage.getItem($data_name)
        },
        logout() {
            localStorage.removeItem("token");
            localStorage.removeItem("name");
            localStorage.removeItem("phone");
            window.location.reload();
        }
    }
};

