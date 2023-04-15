<template>
    <div class="alert alert-dismissible fade show" :class="[type]" role="alert">
        {{ message }}
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>
    </div>
</template>

<script>
export default {
    name: "AppAlert",
    props: {
        type: {
            type: String,
            required: true,
        },
        message: {
            type: String,
            require: true,
        },
    },
};
</script>
