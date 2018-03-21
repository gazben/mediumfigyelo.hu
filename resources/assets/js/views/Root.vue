<template>
    <div class="content">
        <div class="container">
            <div class="col"></div>
            <div class="col-10">
                Ez itt a root content
            </div>
            <div class="col"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'root',
        mounted() {
            console.log('Root');
        },
    };
</script>

<style>
    html {
        position: relative;
        min-height: 100%;
    }
    body {
        /* Margin bottom by footer height */
        margin-bottom: 60px;
    }
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 60px;
        line-height: 60px; /* Vertically center the text there */
        background-color: #f5f5f5;
    }

    body > .container {
        padding: 60px 15px 0;
    }

    .footer > .container {
        padding-right: 15px;
        padding-left: 15px;
    }
</style>