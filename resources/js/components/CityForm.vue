<template>
    <div class="mb-5">
        <div class="col-12 col-lg-6 offset-lg-3" v-if="!showCities">
            <div class="input-group mb-3">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Type..."
                    v-model.trim="city"
                    aria-label="Recipient's username"
                    aria-describedby="button-addon2"
                    v-on:keyup.enter="getCities"
                />
                <button
                    type="button"
                    class="btn btn-warning"
                    @click="getCities"
                >
                    Find
                </button>
            </div>
        </div>
        <div class="row" v-else>
            <form @submit.prevent="AddCity" class="col-12 col-lg-6 offset-lg-3">
                <div class="col-12 mb-3">
                    <select
                        class="form-select"
                        aria-label="Select city"
                        v-model="selected"
                    >
                        <option value="default">Select city</option>
                        <option
                            v-for="(city, index) in cities"
                            :key="index"
                            :value="city.name"
                        >
                            {{ city.name }} ( {{ city.country }} )
                        </option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-warning me-1">
                        Add City
                    </button>
                    <button
                        type="submit"
                        class="btn btn-dark"
                        @click="resetForm"
                    >
                        Reset
                    </button>
                </div>
            </form>
        </div>
        <div class="row"></div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "CityForm",
    data() {
        return {
            city: "",
            cities: [],
            showCities: false,
            selected: "default",
        };
    },
    methods: {
        resetForm() {
            this.cities = [];
            this.showCities = false;
            this.selected = "";
            this.city = "";
        },
        async AddCity() {
            try {
                const response = await axios.post("/api/city", {
                    name: this.selected,
                });
                this.cities = [];
                this.showCities = false;
                alert(response.data.message);
                this.$emit("loadForecasts");
            } catch (e) {
                if (e.response) {
                    alert(e.response.data.message);
                } else if (e.request) {
                    alert("Something went wrong, please try again later");
                }
            }
        },
        async getCities() {
            try {
                const response = await axios.get("/api/city/find", {
                    params: {
                        name: this.city,
                    },
                });

                if (response.data.length === 0) {
                    alert("City not found!");
                }

                this.cities = response.data;
                this.showCities = true;
                this.selected = "";
                this.city = "";
            } catch (e) {
                if (e.response) {
                    alert(e.response.data.message);
                } else if (e.request) {
                    alert("Something went wrong, please try again later");
                }
            }
        },
    },
};
</script>
