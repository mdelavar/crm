import {usePage} from "@inertiajs/vue3";

export default {

    methods: {
        hasPermission($key) {
            const page = usePage();
            return (page.props.perms).includes($key);
        }
    }
};

