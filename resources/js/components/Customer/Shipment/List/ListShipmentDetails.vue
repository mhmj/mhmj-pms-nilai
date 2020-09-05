<template>
    <main id="js-page-content" role="main" class="page-content">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-shipping-fast'></i>{{Shipment.company_id.name}} - <span class="text-primary text-bold" style="font-weight: bold"> {{Shipment.delivery_no}}</span>
            </h1>
        </div>
        <div class="row">
            <customer-view-shipment :data="this.Shipment"></customer-view-shipment>
        </div>
            <list-dosummary-movement></list-dosummary-movement>
    </main>
</template>

<script>
    export default {
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
