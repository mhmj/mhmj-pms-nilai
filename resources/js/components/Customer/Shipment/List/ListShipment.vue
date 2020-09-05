<template>
    <main id="js-page-content" role="main" class="page-content">
        <div class="subheader">
            <div class="col-12">
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-home'></i> Home
                    </h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            List Shipment
                        </h2>

                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <customer-element-shipment :data="this.Shipment"></customer-element-shipment>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        props: {
            'company_id': {
                type: String,
                required: true
            },
        },
        data() {
            return {
                Shipment:[],
            }
        },
        created(){
            this.fetchShipment();
        },
        mounted() {
            Event.$on('fetchShipment', () => {
                this.fetchShipment();
            });
        },

        methods : {

            fetchShipment(){
                fetch('/api/v1/Shipment/Lists/customer/'+ this.company_id +'/all').then(response => response.json())
                    .then(response => {
                        this.Shipment = response.data;
                    })
                    .catch(error => console.log(error))
            },

        }
    }

</script>
