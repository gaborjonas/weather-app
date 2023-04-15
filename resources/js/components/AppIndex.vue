<template>
    <AppHeader />
    <main class="container">
        <CityForm @load-forecasts="loadForecasts" />
        <p v-if="forecasts.length === 0">No cities added</p>

        <ForecastLists v-else :forecasts="forecasts" />
    </main>
</template>

<script>
import AppHeader from "./AppHeader.vue";
import CityForm from "./CityForm.vue";
import ForecastLists from "./ForecastList.vue";
import axios from "axios";
export default {
    name: "AppIndex",
    components: { ForecastLists, CityForm, AppHeader },
    data() {
        return {
            forecasts: [],
        };
    },
    mounted() {
        this.loadForecasts();
    },
    methods: {
        async loadForecasts() {
            try {
                const response = await axios.get("/api/forecast");
                this.forecasts = response.data;
            } catch (e) {
                alert("Something went wrong, please try again later");
            }
        },
    },
};
</script>
