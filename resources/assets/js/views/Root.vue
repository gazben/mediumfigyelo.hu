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
            <h2>Oldalak</h2>
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
            <h2>Kulcsszavak</h2>
            <template v-for="keyword in keywords">
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" :value="keyword.id" v-model="selectedKeywords">{{ keyword.keyword }}
                    </label>
                </div>
            </template>
        </div>

    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import VueCharts from 'vue-chartjs'

    export default {
        name: 'root',
        components: { Datepicker, VueCharts },
        mounted() {
            console.log('Szia uram!')
            this.fetchKeywords()
            this.fetchSites()
        },
        data: () => ({
            dates: {},
            keywords: [],
            selectedKeywords: [],
            sites: [],
            selectedSites: [],
            calendarDisabledSettings: {
                to: new Date(2018, 1, 22),
                from: new Date(2018, 3, 10),
            }
        }),
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
                console.log("TODO")
            }
        }
    };
</script>

<style>
    a {
        color: #000;
    }
</style>