<template>
    <div class="mb-5">
        <div class="col-12 col-lg-6 offset-lg-3">
            <div class="input-group has-validation mb-3">
                <input
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': errorMessage.length > 0 }"
                    placeholder="Type in a city"
                    v-model.trim="cityInput"
                    aria-label="Type in a city"
                    aria-describedby="At least two characters"
                    v-on:keyup.enter="getCities"
                />
                <button
                    type="button"
                    class="btn btn-warning"
                    @click="getCities"
                    aria-label="Find a city"
                    aria-describedby="Click the button to find a city"
                >
                    Find
                </button>
                <div v-if="errorMessage.length > 0" class="invalid-feedback">
                    {{ errorMessage }}
                </div>
            </div>
        </div>
        <SelectForm
            v-if="showSelectForm"
            :cities="foundCities"
            @load-forecasts="$emit('loadForecasts')"
            @reset-form="resetForm"
        />
    </div>
</template>

<script>
import axios from "axios";
import SelectForm from "./SelectForm.vue";

export default {
    name: "CityForm",
    components: { SelectForm },
    data() {
        return {
            cityInput: "",
            foundCities: [],
            showSelectForm: false,
            errorMessage: "",
        };
    },
    methods: {
        resetForm() {
            this.foundCities = [];
            this.showSelectForm = false;
            this.cityInput = "";
        },

        async getCities() {
            try {
                const response = await axios.get("/api/city/find", {
                    params: {
                        name: this.cityInput,
                    },
                });

                if (response.data.length === 0) {
                    this.errorMessage = response.data.message;
                } else {
                    this.foundCities = response.data;
                    this.showSelectForm = true;
                    this.selected = "";
                    this.errorMessage = "";
                }
            } catch (e) {
                if (e.response) {
                    this.errorMessage = e.response.data.message;
                } else if (e.request) {
                    this.errorMessage = e.response.data.message;
                }
            }
        },
    },
};
</script>
