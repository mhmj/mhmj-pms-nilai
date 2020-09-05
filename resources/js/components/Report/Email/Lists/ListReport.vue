<template>
    <div ref="document">
        <div class="row"  style="margin-top: -20px">
            <div class="col-lg-12">
                <div id="panel-1" class="panel" data-panel-close="false" data-panel-fullscreen="false" data-panel-collapsed="false" data-panel-color="false" data-panel-locked="false" data-panel-refresh="false" data-panel-reset="false">
                    <div class="panel-hdr">
                        <h2>
                            Summary
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <form method="post" @submit.prevent="SearchCompanyReport">
                                <div class="row" style="margin-bottom: 10px">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-10" style="">
                                                <v-select :options="ListCompanies" :reduce="ListCompanies => ListCompanies.id " :label="ListCompanies.label" @input="SearchCompanyReport" v-model="company_id"></v-select>
                                            </div>
                                            <div class="col-2" style="display: flex; justify-content: flex-end; margin-left: -5px; padding: 0px">
                                                <button type="submit"  style="height: 30px" class="btn btn-primary shadow-0">
                                                    <p style="margin-top: -3px;">Search</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <email-report-element :data="this.SummaryAllPackagings"></email-report-element>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="isSearching">
            <div class="col-lg-12">
                <div id="panel-2" class="panel" data-panel-close="false" data-panel-fullscreen="false" data-panel-collapsed="false" data-panel-color="false" data-panel-locked="false" data-panel-refresh="false" data-panel-reset="false">
                    <div class="panel-hdr">
                        <h2 v-for=" companyName in ListCompanies" v-if="company_id == companyName.id">
                            {{companyName.label}}
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <email-company-report-element :data="this.SummaryCompanyPackagings"></email-company-report-element>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                SummaryAllPackagings:[],
                SummaryCompanyPackagings:[],
                ListCompanies:[],
                company_id: '',
                isSearching: false,
                dataTable:null,
            }
        },
        created(){
            this.fetchSummaryAllPackagings();
            this.fetchCompany();
        },
        mounted() {
            Event.$on('fetchSummaryAllPackagings', () => {
                this.fetchSummaryAllPackagings();
            });
        },

        methods : {
            fetchSummaryAllPackagings(){
                fetch('/api/v1/Report/Lists/all-packaging').then(response => response.json())
                    .then(response => {
                        this.SummaryAllPackagings = response;
                    })
                    .catch(error => console.log(error))
            },
            fetchCompany(){
                axios.get('/api/v1/Personnel/Company/Lists/dropdown-list-company')
                    .then(function (response) {
                        this.ListCompanies = $.map(response.data, function(value){
                            return {'id': value.id, 'label': value.name};
                        });
                    }.bind(this));
            },
            SearchCompanyReport(){
                this.isSearching = true;
                fetch('/api/v1/Report/Lists/'+ this.company_id+'/company-packaging').then(response => response.json())
                    .then(response => {
                        this.SummaryCompanyPackagings = response;
                    })
                    .catch(error => console.log(error))
            },
        }
    }

</script>
