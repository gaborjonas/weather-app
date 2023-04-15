<template>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col" v-for="forecast in forecasts" :key="forecast.city.id">
            <forecast-card :forecast="forecast" />
        </div>
    </div>
</template>

<script>
import ForecastCard from "./ForecastCard.vue";

export default {
    name: "ForecastLists",
    components: { ForecastCard },
    props: {
        forecasts: {
            type: Object,
        },
    },
};
</script>
