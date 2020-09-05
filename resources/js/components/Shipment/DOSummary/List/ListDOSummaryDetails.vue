<template>
    <main id="js-page-content" role="main" class="page-content">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-shipping-fast'></i>{{Shipment.company_id.name}} - <span class="text-primary text-bold" style="font-weight: bold"> {{Shipment.delivery_no}}</span>
            </h1>
            <div style="display: flex; justify-content: flex-end;">
                <button class="btn btn-primary" data-toggle="modal" data-target="#note">Pending Return Note</button>
            </div>
        </div>
        <div class="row">
            <customer-view-shipment :data="this.Shipment"></customer-view-shipment>
        </div>
        <list-dosummary-movement></list-dosummary-movement>
        <div class="modal fade" id="note" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{Shipment.company_id.name}} - <span class="text-primary text-bold" style="font-weight: bold"> {{Shipment.delivery_no}}</span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body" style="border: 1px dashed gray;">
                        <div class="" ref="document">
                            <element-invoice-pending-receiving :data="this.ListPackagingReceived"></element-invoice-pending-receiving>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="exportToPDF">Download</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    import html2pdf from 'html2pdf.js'
    export default {
        name :'pdf',
        props:['data'],
        data() {
            return {
                id: null,
                ListPackagingDelivered:[],
                ListPackagingReceived:[],
                Shipment:{
                    id:'',
                    vehicle_no:'',
                    delivery_no:'',
                    created_by:'',
                    verified_by:'',
                    delivery_by:'',
                    received_by:'',
                    remark:'',
                    remark_2:'',
                    status:'',
                    company_id:{
                        id:'',
                        name:'',
                    },
                },
            }
        },
        created(){
            this.fetchShipmentDetails();
            this.fetchPackagingShipmentIN();
            this.fetchPackagingShipmentOUT();
            this.id= this.data;
        },
        mounted() {
            Event.$on('fetchShipmentDetails', () => {
                this.fetchShipmentDetails();
            });
            Event.$on('fetchPackagingShipmentIN', () => {
                this.fetchPackagingShipmentIN();
            });
            Event.$on('fetchPackagingShipmentOUT', () => {
                this.fetchPackagingShipmentOUT();
            });
        },

        methods : {
            exportToPDF () {
                var currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'-');
                html2pdf(this.$refs.document, {
                    margin: 0.5,
                    filename: currentDateWithFormat + ' - ' + this.Shipment.company_id.name+' - Pending Return.pdf',
                    image: { type: 'jpeg', quality: 1000 },
                    html2canvas: { scale: 4 },
//                    html2canvas: { dpi: 800, letterRendering: true },
                    jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
                })
            },
            fetchShipmentDetails(){
                fetch('/api/v1/Shipment/Lists/'+ this.data +'/details').then(response => response.json())
                    .then(response => {
                        this.Shipment = response.data;
                    })
                    .catch(error => console.log(error))
            },
            fetchPackagingShipmentIN(){
                fetch('/api/v1/Movement/Lists/customer/'+ this.data +'/in/movement').then(response => response.json())
                    .then(response => {
                        this.ListPackagingReceived = response.data;
                    })
                    .catch(error => console.log(error))
            },
            fetchPackagingShipmentOUT(){
                fetch('/api/v1/Movement/Lists/customer/'+ this.data +'/out/movement').then(response => response.json())
                    .then(response => {
                        this.ListPackagingDelivered = response.data;
                    })
                    .catch(error => console.log(error))
            },

        }
    }

</script>
