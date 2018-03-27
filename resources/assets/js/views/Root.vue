<template>
    <div>
        <div class="settings p-1">
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
                        <input class="form-check-input" type="checkbox" :value="site.id" v-model="selectedSites"> <a
                            :href="site.url" target="_blank">{{ site.title }}</a>
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
                <h4>Válassz ki paramétereket a beállításoknál!</h4>
            </template>
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
                window.axios.post('/api/stats', {
                    'keyword': this.selectedKeyword,
                    'sites': this.selectedSites,
                    'dates': {
                        'beginDate': this.dates.beginDate.toUTCString(),
                        'endDate': this.dates.endDate.toUTCString(),
                    }
                }).then((response) => {
                    this.stats = response.data.data
                    this.renderChart(stats)
                })
                .catch(function (error) {
                    console.log(error)
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