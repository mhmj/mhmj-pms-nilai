<template>
    <div class="row">
        <div class="col-6">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Customer
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <customer-element-movement-in :data="this.$parent.ListPackagingReceived"></customer-element-movement-in>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div id="panel-2" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Warehouse
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <customer-element-movement-out :data="this.$parent.ListPackagingDelivered"></customer-element-movement-out>
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

            }
        },


        created(){

        },
        mounted() {

        },

        methods : {


        }
    }

</script>
