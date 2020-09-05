<template>
    <div class="col-xl-12">
        <form method="post" @submit.prevent="">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Shipment Details
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <h6>
                                                <label class="form-label">Delivery No</label>
                                            </h6>
                                            <div class="row" v-if="('delivery_no' in errors)">
                                                <div class="col">
                                                    <label class="text-danger">{{errors['delivery_no']}}</label>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" disabled v-model="Shipment.delivery_no" >
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <h6>
                                                <label class="form-label">Vehicle No</label>
                                            </h6>
                                            <div class="row" v-if="('vehicle_no' in errors)">
                                                <div class="col">
                                                    <label class="text-danger">{{errors['vehicle_no']}}</label>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" disabled v-model="Shipment.vehicle_no" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 15px">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h6>
                                                        <label class="form-label">Remark</label>
                                                    </h6>
                                                    <input type="text" class="form-control" disabled v-model="Shipment.remark" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row"  style="margin-top: 10px">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h6>
                                                        <label class="form-label">Status</label>
                                                    </h6>
                                                    <input type="text" class="form-control" disabled v-model="Shipment.status" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row" >
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h6>
                                                        <label class="form-label">Created By</label>
                                                    </h6>
                                                    <input type="text" class="form-control" disabled v-model="Shipment.created_by" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 15px">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h6>
                                                        <label class="form-label">Delivered By</label>
                                                    </h6>
                                                    <input type="text" class="form-control" disabled v-model="Shipment.delivery_by" >
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h6>
                                                        <label class="form-label">Received By</label>
                                                    </h6>
                                                    <input type="text" class="form-control" disabled v-model="Shipment.received_by" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        props:['data'],
        data() {
            return {
                id: null,
                errors: [],
                Shipment:this.data,
            }
        },
        created(){
        },
        watch: {
            'data': function() {
                this.Shipment = this.data;
            }
        },

    }

</script>