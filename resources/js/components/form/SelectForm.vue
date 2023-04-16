<template>
    <teleport to="#alerts">
        <app-alert
            :type="alert.type"
            :message="alert.message"
            v-if="showAlert"
        />
    </teleport>
    <div class="col-12 col-lg-6 offset-lg-3">
        <form @submit.prevent="addCity">
            <div class="col-12 mb-3">
                <select
                    class="form-select"
                    aria-label="Select city"
                    aria-describedby="Select a city from the list"
                    v-model="selected"
                >
                    <option value="placeholder" selected>Select city...</option>
                    <option
                        v-for="(city, index) in cities"
                        :key="index"
                        :value="city.name"
                    >
                        {{ city.name }} ( {{ city.country }} )
                    </option>
                </select>
            </div>
            <div class="d-flex justify-content-end">
                <button
                    type="submit"
                    class="btn btn-warning me-1"
                    aria-label="Add city"
                    aria-describedby="Click the button to add a city"
                >
                    Add City
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import AppAlert from "../AppAlert.vue";

export default {
    name: "SelectForm",
    components: { AppAlert },
    props: {
        cities: {
            type: Array,
        },
    },
    data() {
        return {
            selected: "placeholder",
            alert: {
                type: "",
                message: "",
            },
            showAlert: false,
        };
    },
    methods: {
        async addCity() {
            if (this.selected === "placeholder") {
                alert("Please select a city");
            } else {
                try {
                    const response = await axios.post("/api/city", {
                        name: this.selected,
                    });
                    this.showSelectForm = false;
                    this.alert.message = response.data.message;
                    this.alert.type = "alert-success";
                    this.showAlert = true;
                    this.$emit("loadForecasts");
                    this.$emit("toggleSelectForm");
                } catch (e) {
                    if (e.response) {
                        this.alert.message = e.response.data.message;
                        this.alert.type = "alert-danger";

                        this.showAlert = true;
                    } else if (e.request) {
                        alert("Something went wrong, please try again later");
                    }
                }
            }
        },
        resetForm() {},
    },
};
</script>
