<template>
    <main id="js-page-content" role="main" class="page-content">
        <div class="subheader">
            <div class="col-6">
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-shipping-fast'></i> D.O Summary
                    </h1>
                </div>
            </div>
            <div class="col-6" style="display: flex; justify-content: flex-end;" >
                <div class="subheader">
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
                            <element-summary-shipment :data="this.Shipment"></element-summary-shipment>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
    export default {
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
            openCreateRecord(){
                $(".create-shipment-modal").modal('show');
            },
            fetchShipment(){
                fetch('/api/v1/Shipment/Lists/all').then(response => response.json())
                    .then(response => {
                        this.Shipment = response.data;
                    })
                    .catch(error => console.log(error))
            },

        }
    }
</script>
