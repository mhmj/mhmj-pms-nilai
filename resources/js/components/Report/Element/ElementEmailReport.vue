<template>
    <div style="padding: 5px;">
        <div class="row">
            <div class="col-lg-12" style="display: flex; justify-content: flex-end">
                <button type="submit" class="btn btn-primary" @click="exportToPDF()">Download PDF</button>
            </div>
        </div>
        <div class="" ref="document">
            <div class="row" style="padding: 0px; font-family: 'Times New Roman'">
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                            <div class="row">
                                <div class="col-12">
                                    <img src="/img/tecnic2.png" style="height: 80px;width: 80px; margin-top: 15px" class="logo">
                                </div>
                            </div>
                        </div>
                        <div class="col-10" style="margin-left: -25px">
                            <div class="row">
                                <div class="col-12">
                                    <span><span style="font-size: 25px; font-weight: bold">Plastictecnic(M) Sdn Bhd </span> REG: 197601004542 (30481-V)</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-11">
                                    <p>PKT 1, Lot 1, Jalan P/2a, Kawasan Perusahaan Beranang,</p>
                                    <p style="margin-top: -15px">43650 Bandar Baru Bangi, Selangor Darul Ehsan, Malaysia</p>
                                    <p style="margin-top: -15px">Tel: (6) 03-8925 6950(8 lines) Fax: (6) 03-8925 6955</p>
                                    <p style="margin-top: -15px">www.plastictecnic.com</p>
                                </div>
                                <div class="col-1" style="display: flex; justify-content: flex-end; ">
                                    <img src="/img/iso.png" style="height: 60px; width: 90px; margin-top: 10px" class="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border: solid 0.5px black; margin-top: -10px;">
            <div class="row" style="padding: 0px; font-family: 'Times New Roman'">
                <div class="col-12" style="display: flex; justify-content: center;">
                    <div class="row">
                        <span style="font-size: 18px; font-weight: bold; text-decoration: underline">Packaging Report - {{this.currentDateWithFormat}} </span>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 30px;padding: 0px; font-family: 'Times New Roman'">
                <div class="col-lg-12">
                        <div style="padding: 20px;; border: none" >
                            <div class="row"  style="margin-top: -20px" v-if="this.isPDF == true">
                                <div class="col-lg-12">
                                    <h3>Packaging Summary</h3>
                                    <email-report-element :data="this.SummaryAllPackagings"></email-report-element>
                                </div>
                            </div>
                            <div class="row"  style="margin-top: -20px" v-if="this.isPDF == false">
                                <div class="col-lg-12">
                                    <div id="panel-3" class="panel" data-panel-close="false" data-panel-fullscreen="false" data-panel-collapsed="false" data-panel-color="false" data-panel-locked="false" data-panel-refresh="false" data-panel-reset="false">
                                        <div class="panel-hdr">
                                            <h2>Summary</h2>
                                        </div>
                                        <div class="panel-container show">
                                            <div class="panel-content">
                                                <report-element :data="this.SummaryAllPackagings"></report-element>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px">
                                <div class="col-lg-12">
                                    <h3>Company Summary</h3>
                                    <div v-for=" companyName in ListCompanies" style="margin-top: 25px">
                                        <h5   style="font-weight: bold">{{companyName.label}}</h5>
                                        <email-company-report-element :companyId="companyName.id"></email-company-report-element>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--<div  v-if="this.isPDF == false">-->
                        <!--<div class="row"  style="margin-top: -20px">-->
                            <!--<div class="col-lg-12">-->
                                <!--<div id="panel-1" class="panel" data-panel-close="false" data-panel-fullscreen="false" data-panel-collapsed="false" data-panel-color="false" data-panel-locked="false" data-panel-refresh="false" data-panel-reset="false">-->
                                    <!--<div class="panel-hdr">-->
                                        <!--<h2>Summary</h2>-->
                                    <!--</div>-->
                                    <!--<div class="panel-container show">-->
                                        <!--<div class="panel-content">-->
                                            <!--<report-element :data="this.SummaryAllPackagings"></report-element>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</div>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="row">-->
                            <!--<div class="col-lg-12">-->
                                <!--<div v-for=" companyName in ListCompanies" class="panel" data-panel-close="false" data-panel-fullscreen="false" data-panel-collapsed="false" data-panel-color="false" data-panel-locked="false" data-panel-refresh="false" data-panel-reset="false">-->
                                    <!--<div class="panel-hdr">-->
                                        <!--<h2 style="font-weight: bold">{{companyName.label}}</h2>-->
                                    <!--</div>-->
                                    <!--<div class="panel-container show">-->
                                        <!--<div class="panel-content">-->
                                            <!--<email-company-report-element :companyId="companyName.id"></email-company-report-element>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</div>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import html2pdf from 'html2pdf.js'
    export default {
        name :'pdf',
        data(){
            return {
                type_name: '',
                temporary: '',
                isPDF: false,
                currentDateWithFormat: '',

                SummaryAllPackagings:[],
//                SummaryCompanyPackagings:[],
                ListCompanies:[],
                company_id: '',
                isSearching: false,
                dataTable:null,
            }
        },
        created(){
            this.fetchSummaryAllPackagings();
            this.fetchCompany();

            var month = new Array();
            month[0] = "January";
            month[1] = "February";
            month[2] = "March";
            month[3] = "April";
            month[4] = "May";
            month[5] = "June";
            month[6] = "July";
            month[7] = "August";
            month[8] = "September";
            month[9] = "October";
            month[10] = "November";
            month[11] = "December";

            var d = new Date();
            var m = month[d.getMonth()];

            var d = new Date();
            var y = d.getFullYear();

            this.currentDateWithFormat = m + ' ' + y;
//            this.currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'-');
        },
        mounted() {
            Event.$on('fetchSummaryAllPackagings', () => {
                this.fetchSummaryAllPackagings();
            });
        },
        methods :{
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
                fetch('/api/v1/Report/Lists/all-company-packaging').then(response => response.json())
                    .then(response => {
                        this.SummaryCompanyPackagings = response;
                        console.log(this.SummaryCompanyPackagings)
                    })
                    .catch(error => console.log(error))
            },
            exportToPDF () {
                this.isPDF = true;
                html2pdf(this.$refs.document, {
                    margin: 0.5,
                    filename: 'Monthly Report.pdf',
                    image: { type: 'jpeg', quality: 1000 },
                    html2canvas: { scale: 4 },
                    jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' },

                })
            },
        }
    }


</script>