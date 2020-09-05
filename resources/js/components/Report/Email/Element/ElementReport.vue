<template>
    <div>
        <table id="" class=" table table-sm table-bordered table-hover table-striped w-100">
            <thead class="bg-primary-600">
            <tr>
                <th></th>
                <th>Type</th>
                <th>Description</th>
                <th>Customer</th>
                <th>Warehouse</th>
                <th>Damage</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="SummaryAllPackagings in data">
                <td style="font-weight: bold">{{SummaryAllPackagings.name}}</td>
                <td style="font-weight: bold">{{SummaryAllPackagings.type_name}}</td>
                <td>{{SummaryAllPackagings.description}}</td>
                <td style="color:red">{{SummaryAllPackagings.customer}}</td>
                <td  style="color:green">{{SummaryAllPackagings.warehouse}}</td>
                <td>{{SummaryAllPackagings.damage}}</td>
                <td  style="color:blue">{{parseInt(SummaryAllPackagings.warehouse)+ parseInt(SummaryAllPackagings.customer)}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        props:['data'],
        methods: {}

    }

</script>