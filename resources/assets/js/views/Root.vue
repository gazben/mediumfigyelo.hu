<template>
    <div>
        <div>

        </div>
        <div>
            <h2>Oldalak</h2>

        </div>
    </div>
</template>

<script>
    export default {
        name: 'root',
        mounted() {
            this.fetchKeywords()
            this.fetchSites()
        },
        data: () => ({
            keywords: [],
            selectedKeywords: [],
            sites: [],
            selectedSites: [],
        }),
        methods: {
            fetchKeywords() {
                window.axios.get('/api/keywords').then((response) => {
                    console.log(response)
                    this.keywords = response.data.data
                })
                .catch(function (error) {
                    console.log(error)
                })
            },
            fetchSites() {
                window.axios.get('/api/sites').then((response) => {
                    console.log(response);
                    this.sites = response.data.data
                })
                .catch(function (error) {
                    console.log(error)
                })
            }
        }
    };
</script>