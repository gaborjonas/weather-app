<template>
    <forecast-nav
        :links="links"
        :activeLink="activeLink"
        @selected-link="setActiveLink"
        v-if="forecasts.length > 0"
    />
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div
            class="col"
            v-for="(forecast, index) in filteredForecasts"
            :key="index"
        >
            <forecast-card :forecast="forecast" />
        </div>
    </div>
</template>

<script>
import ForecastCard from "./ForecastCard.vue";
import ForecastNav from "./ForecastNav.vue";

export default {
    name: "ForecastLists",
    components: { ForecastNav, ForecastCard },
    props: {
        forecasts: {
            type: Array,
        },
    },
    data() {
        return {
            filteredForecasts: [],
            activeLink: "All",
        };
    },
    mounted() {
        this.filteredForecasts = this.forecasts;
    },
    computed: {
        links() {
            return this.forecasts.map((forecast) => forecast.city.name);
        },
    },
    methods: {
        setActiveLink(cityName) {
            this.activeLink = cityName;
            if (cityName === "All") {
                this.filteredForecasts = this.forecasts;
            } else {
                this.filterBy(cityName);
            }
        },
        filterBy(cityName) {
            const cityToShow = this.forecasts.find(
                (forecast) => forecast.city.name === cityName
            );
            this.filteredForecasts = [];
            this.filteredForecasts.push(cityToShow);
        },
    },
};
</script>
