<template>
    <div>
        <table id="dt-report-packaging" class="dt-report-packaging table table-sm table-bordered table-hover table-striped w-100">
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
        data() {
            return {
                dataTable:null,

            }
        },
        mounted() {

        },
        watch: {
            data() {
                this.updateTable();
            }
        },
        methods: {
            updateTable(){
                if (this.dataTable) {
                    $('#dt-report-packaging').DataTable().destroy();
                }
                this.$nextTick(() =>
                {
                    this.dataTable = $('#dt-report-packaging').DataTable(
                        {
                            responsive: true,
                            stateSave: true, //remembers your table settings (filter, scroll point, sort, etc)
                            processing: true,
                            pageLength: false,
                            deferRender: true,
                            scrollY: 300,
                            scrollCollapse: true,
                            scroller: true,
                            lengthChange: false,

                            dom:
                            "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>> ",
                            buttons: [
                                {
                                    extend: 'excelHtml5',
                                    text: 'Excel',
                                    titleAttr: 'Generate Excel',
                                    className: 'btn-outline-success btn-sm mr-1'
                                },
                                {
                                    extend: 'csvHtml5',
                                    text: 'CSV',
                                    titleAttr: 'Generate CSV',
                                    className: 'btn-outline-primary btn-sm mr-1'
                                },
                                {
                                    extend: 'copyHtml5',
                                    text: 'Copy',
                                    titleAttr: 'Copy to clipboard',
                                    className: 'btn-outline-primary btn-sm mr-1'
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    titleAttr: 'Print Table',
                                    className: 'btn-outline-primary btn-sm',

                                }
                            ]
                        });
                });
            },
        }

    }

</script>