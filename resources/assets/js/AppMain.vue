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
            <cookie-law theme="base" buttonText="Értem">
                <div slot="message">
                    Az oldalon <a href="https://hu.wikipedia.org/wiki/HTTP-s%C3%BCti">sütiket</a> használok a jobb működés érdekében.
                </div>
            </cookie-law>
            <div class="container container-fluid">
                <div class="row py-4">
                    <div class="col-12">
                        <div class="container container-fluid">
                            <div class="row">
                                <div class="col-5">
                                    <ul style="list-style: none; color: #373737">
                                        <li><strong>Elérhetőség:</strong><a href="mailto:hello@mediumfigyelo.hu"> hello@mediumfigyelo.hu</a></li>
                                        <li><strong>Inspiráció:</strong><a target="_blank" href="https://media.ccc.de/v/34c3-9106-pointing_fingers_at_the_media">Pointing Fingers at 'The Media'</a></li>
                                        <li><strong>Támogass (ETH):</strong> 0x33546c203afdec344ec035a9dfd97741efba5f68</li>
                                        <li><strong>Kód:</strong> <a target="_blank" href="https://github.com/gazben/mediumfigyelo.hu">https://github.com/gazben/mediumfigyelo.hu</a></li>
                                    </ul>
                                </div>
                                <div class="col-2"></div>
                                <div class="col-5">
                                    <strong>Vigyázz, oldal által kimutatt adatok tartalmazhatnak hibákat!</strong>
                                    <br><br>
                                    A programot szabadidőmben készítettem el
                                    <a href="https://www.reddit.com/r/hungary/comments/7zan9b/k%C3%B3dol%C3%A1sadatelemz%C3%A9s_seg%C3%ADts%C3%A9gk%C3%A9r%C3%A9s/">(eredeti kezdeményezés)</a>,
                                    semmilyen pártfinanszírozás, külföldi tőke, idegen ügynök nem vett részt benne.
                                    <br><br>
                                    Ha szeretnél résztvenni a fejlesztésben akkor a github link-en megteheted, ha kérdésed van írj nyugodtan!
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