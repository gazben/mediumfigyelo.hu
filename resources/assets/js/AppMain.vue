<template>
    <div id="app">
        <div class="header">
            <div class="mt-3">
                <h1 class="text-center">Médiafigyelő</h1>
            </div>

            <a target="_blank" href="https://github.com/gazben/mediumfigyelo.hu"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a>
        </div>
        <hr>

        <router-view></router-view>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col"></div>
                    <div class="col-10">
                        <small>
                            <strong>Írj nekem (lehet szépet és rosszat is): </strong><a href="mailto:hello@mediumfigyelo.hu">hello@mediumfigyelo.hu</a> | Gazder Bence 2018
                        </small>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    export default {
        name: 'app',
    };
</script>