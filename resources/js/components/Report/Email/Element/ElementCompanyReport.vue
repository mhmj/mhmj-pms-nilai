<template>
    <div>
        <table class="table table-sm table-bordered table-hover table-striped w-100">
            <thead class="bg-primary-600">
            <tr>
                <th></th>
                <th>Type</th>
                <th>Customer</th>
                <th>Damage</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="SummaryCompanyPackaging in SummaryCompanyPackagings">
                <td style="font-weight: bold">{{SummaryCompanyPackaging.Category}}</td>
                <td style="font-weight: bold">{{SummaryCompanyPackaging.type_name}}</td>
                <td style="color:red">{{SummaryCompanyPackaging.customer}}</td>
                <td>{{SummaryCompanyPackaging.Damage}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        props:['companyId'],
        data() {
            return {
                SummaryCompanyPackagings:[],
            }
        },
        created() {
            this.SearchCompanyReport();
        },
        mounted() {},
        methods: {
            SearchCompanyReport(){
                this.isSearching = true;
                fetch('/api/v1/Report/Lists/'+ this.companyId +'/company-packaging').then(response => response.json())
                    .then(response => {
                        this.SummaryCompanyPackagings = response;
                    })
                    .catch(error => console.log(error))
            },
        }
    }

</script>