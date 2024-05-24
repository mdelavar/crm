import TailSelect from "tail.select";
import _ from "lodash";

const setValue = (el, props) => {
    if (props.modelValue?.length) {
        cash(el).val(props.modelValue);
    }
};

const init = (el, props, emit) => {
    TailSelect.strings.register("en", {
        all: "همه",
        none: "هیچ‌کدام",
        empty: "موردی وجود ندارد",
        emptySearch: "موردی یافت نشد",
        limit: "مواردی بیشتری را نمی‌توانید انتخاب کنید",
        placeholder: "یک مورد را انتخاب کنید...",
        placeholderMulti: "تا :limit مورد انتخاب کنید...",
        search: "برای جستجو بنویسید...",
        disabled: "این بخش غیرفعال است",
    });

    TailSelect(el, props.options).on("change", function (item) {
        if (cash(el).attr("multiple") !== undefined) {
            const values = !props.modelValue?.includes(item.key)
                ? [...props.modelValue, item.key]
                : _.filter(props.modelValue, (key) => key !== item.key);
            emit("update:modelValue", values);
        } else {
            emit("update:modelValue", item.key);
        }
    });
};

const reInit = (el, props) => {
    TailSelect(el, props.options).reload();
};
export {setValue, init, reInit};
