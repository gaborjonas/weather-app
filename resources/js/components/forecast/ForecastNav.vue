<template>
    <div class="mb-4">
        <ul class="nav nav-pills justify-content-center">
            <li class="nav-item">
                <a
                    @click="$emit('selectedLink', 'All')"
                    class="nav-link"
                    :class="{ active: activeLink === `All` }"
                    href="#"
                    >All</a
                >
            </li>
            <li
                class="nav-item"
                href="#"
                v-for="(name, index) in links"
                :key="index"
            >
                <a
                    href="#"
                    @click="$emit('selectedLink', name)"
                    class="nav-link"
                    :class="{ active: activeLink === name }"
                    >{{ name }}</a
                >
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "ForecastNav",
    props: {
        links: {
            type: Array,
        },
        activeLink: {
            type: String,
            default: "All",
        },
    },
    mounted() {
        this.$emit("selectedLink", "All");
    },
};
</script>
