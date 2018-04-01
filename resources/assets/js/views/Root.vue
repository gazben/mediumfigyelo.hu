<template>
    <div>
        <div class="settings p-1">
            <div class="row" v-if="message">
                <div class="p-3 mb-2 col-12 bg-warning text-dark">
                    {{ message }}
                </div>
            </div>
            <h2>Beállítások</h2>
            <div class="row">
                <div class="col-4">
                    <datepicker language="hu" v-model="dates.beginDate" :disabled="calendarDisabledSettings" maximum-view="day" format="yyyy-MM-dd" input-class="form-control" ></datepicker>
                </div>
                <div class="col-1">
                     <strong>-</strong>
                </div>
                <div class="col-4">
                     <datepicker language="hu" v-model="dates.endDate" :disabled="calendarDisabledSettings" maximum-view="day" format="yyyy-MM-dd" input-class="form-control" ></datepicker>
                </div>
                <div class="col-3">
                    <button class="btn btn-primary" @click="fetchStatistics">Lekérés</button>
                </div>
            </div>
        </div>
        <div class="pages p-1">
            <h2>Oldalak <small>(többet választhatsz)</small></h2>
            <template v-for="site in sites">
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" :value="site.id" v-model="selectedSites"> {{ site.title }}
                    </label>
                </div>
            </template>
        </div>
        <div class="keywords p-1">
            <h2>Kulcsszavak <small>(csak egyet választhatsz)</small></h2>
            <template v-for="keyword in keywords">
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" :value="keyword.id" v-model="selectedKeyword">{{ keyword.keyword }}
                    </label>
                </div>
            </template>
        </div>
        <div class="chart p-1">
            <h2>Diagram</h2>
            <template v-if="stats !== null">
                <chart :chartData="stats" />
            </template>
            <template v-else>
                Válassz ki paramétereket a beállításoknál!
            </template>
        </div>
        <hr>
        <div class="settings p-1">
            <h3>Mire jó az oldal?</h3>
            Megtekinthető, hogy bizonyos oldalak kezdőlapjai egy adott idő során hányszor tartalmaztak egy adott szót.
            A cél az volt, hogy a kampány végén végignézhessem, hogy mik voltak a slágertémák, és egyes oldalak mely témaköröket tekintették fontosnak.
            <h3>Honnan vannak az adatok?</h3>
            A kampány kezdete óta gyűjtöm őket. Minden órában a felsorolt oldalakat lekértem, és elmentettem.
            <h3>Le lehet tölteni az adatokat?</h3>
            Igen: <strong><a href="https://mediumfigyelo.hu/files/backup.sql">Letöltés</a></strong>
            <h3>Hogyan működik ez az egész?</h3>
            Minden órában lekérem az összes felsorolt oldalt. Ezeket az adatokat megadott időközönként kiértékelem (megnézem, hogy a felvett szavak hányszor szerepelnek az oldalon).
            Ezt a kiértékelést lehet itt az oldalon megtekinteni. Emiatt sajnos az már nem lehetséges, hogy új oldalt adjak a listához, hiszen ahhoz vissza kéne mennem az időben.
            <h3>Miért nem kereshetek rá saját kulcsszavakra?</h3>
            Mert nincs annyi számítási kapacitásom, hogy ~1 hónapnyi archivumot pár másodperc alatt végignézzek.
            <h3>Javasolhatok saját kulcsszót?</h3>
            Igen. Írj emailt nekem.
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import Chart from '../components/Chart'

    export default {
        name: 'root',
        components: { Datepicker, Chart },
        mounted() {
            console.log('Szia uram!')
            this.fetchKeywords()
            this.fetchSites()

            if (localStorage.getItem('stats')) this.stats = JSON.parse(localStorage.getItem('stats'));
            if (localStorage.getItem('selectedKeyword')) this.selectedKeyword = JSON.parse(localStorage.getItem('selectedKeyword'));
            if (localStorage.getItem('selectedSites')) this.selectedSites = JSON.parse(localStorage.getItem('selectedSites'));
        },
        data: () => ({
            message: null,
            dates: {},
            keywords: [],
            selectedKeyword: null,
            sites: [],
            selectedSites: [],
            calendarDisabledSettings: {
                to: new Date(2018, 1, 22),
                from: new Date(2018, 3, 10),
            },
            stats: null
        }),
        watch: {
            stats: {
                handler() {
                    localStorage.setItem('stats', JSON.stringify(this.stats));
                },
                deep: true,
            },
            selectedKeyword: {
                handler() {
                    localStorage.setItem('selectedKeyword', JSON.stringify(this.selectedKeyword));
                },
                deep: true,
            },
            selectedSites: {
                handler() {
                    localStorage.setItem('selectedSites', JSON.stringify(this.selectedSites));
                },
                deep: true,
            }
        },
        methods: {
            fetchKeywords() {
                window.axios.get('/api/keywords').then((response) => {
                    this.keywords = response.data.data
                })
                .catch(function (error) {
                    console.log(error)
                })
            },
            fetchSites() {
                window.axios.get('/api/sites').then((response) => {
                    this.sites = response.data.data
                })
                .catch(function (error) {
                    console.log(error)
                })
            },
            fetchStatistics() {
                if(!this.dates.beginDate) {
                    this.message = 'Nem töltötted ki a kezdő időpontot'
                    return
                }

                if(this.selectedKeyword === null) {
                    this.message = 'Válassz kulcsszót'
                    return
                }

                if(this.selectedSites.length === 0) {
                    this.message = 'Válassz oldalakat'
                    return
                }

                if(!this.dates.endDate) {
                    this.message = 'Nem töltötted ki a végidőpontot'
                    return
                }

                if(this.dates.beginDate > this.dates.endDate){
                    this.message = 'A kezdődátum előbb van mint a végdátum'
                    return
                }

                window.axios.post('/api/stats', {
                    'keyword': this.selectedKeyword,
                    'sites': this.selectedSites,
                    'dates': {
                        'beginDate': this.dates.beginDate.toUTCString(),
                        'endDate': this.dates.endDate.toUTCString(),
                    }
                }).then((response) => {
                    this.message = null
                    this.stats = response.data.data
                })
                .catch((error) => {
                    console.log(error)
                    if(error.response && error.response.data) {
                        console.log(error.response.data.message)
                        this.message = error.response.data.message
                    } else {
                        this.message = 'Hiba történt. Frissítsd az oldalt hátha megjavul. Ha nem akkor küldj emailt.'
                    }
                })
            }
        }
    };
</script>

<style>
    a {
        color: #000;
    }
</style>