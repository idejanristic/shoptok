import { ref, watch } from "vue";

export function useStorage(key, val = "") {
    let storedVal = read();

    if (storedVal) {
        val = ref(storedVal);
    } else {
        val = ref(val);

        write();
    }

    watch(val, write, { deep: true });

    function read() {
        return JSON.parse(localStorage.getItem(key));
    }

    function write() {
        if (val.value) {
            localStorage.setItem(key, JSON.stringify(val.value));
        } else {
            localStorage.removeItem(key);
        }
    }

    return val;
}
