<template>
    <AppHeader />
    <main class="container">
        <div id="alerts"></div>
        <CityForm @load-forecasts="loadForecasts" />
        <p v-if="showMessage">No cities added</p>
        <ForecastLists v-else :forecasts="forecasts" />
    </main>
</template>

<script>
import AppHeader from "./AppHeader.vue";
import CityForm from "./form/CityForm.vue";
import ForecastLists from "./forecast/ForecastList.vue";
import axios from "axios";
export default {
    name: "AppIndex",
    components: { ForecastLists, CityForm, AppHeader },
    data() {
        return {
            forecasts: [],
            showMessage: false,
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
                this.showMessage = false;
            } catch (e) {
                if (e.response.status === 404) {
                    this.showMessage = true;
                } else {
                    alert("Something went wrong, please try again later");
                }
            }
        },
    },
};
</script>
