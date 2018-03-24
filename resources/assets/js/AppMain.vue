<template>
    <div id="app">
        <div class="header">
            <div class="mt-3">
                <h1 class="text-center">Médiumfigyelő</h1>
            </div>

            <a target="_blank" href="https://github.com/gazben/mediumfigyelo.hu"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a>
        </div>
        <hr>

        <div class="content">
            <div class="container">
                <div class="col-12">
                    <router-view></router-view>
                </div>
            </div>
        </div>

        <footer class="footer">
            <hr>
            <div class="container container-fluid">
                <div class="row py-4">
                    <div class="col-12">
                        <div class="container container-fluid">
                            <div class="row">
                                <div class="col-5">
                                    <ul style="list-style: none; color: #373737">
                                        <li><a href="#">Impresszum</a></li>
                                        <li><a href="#">GYIK</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    import CookieLaw from 'vue-cookie-law'
    export default {
        name: 'app',
        components: { CookieLaw }
    };
</script>

<style>
    html {
        position: relative;
        min-height: 100%;
    }
    body {
        /* Margin bottom by footer height */
        margin-bottom: 100px;
    }
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 100px;
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