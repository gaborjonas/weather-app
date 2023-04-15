<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ forecast.city.name }}</h5>
            <div class="list-group list-group-flush">
                <div
                    class="list-group-item d-flex justify-content-between"
                    v-for="(list, index) in forecast.list"
                    :key="index"
                >
                    <span>{{ list.dt_txt }}</span>
                    <span>°C {{ list.main.temp }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        forecast: Object,
    },
    name: "ForecastCard",
};
</script>
