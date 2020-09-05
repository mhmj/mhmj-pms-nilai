<template>
    <div class="col-8">
        <div class="row">
            <div class="col-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Delivered
                        </h2>
                        <button type="button" class="btn btn-primary" style="margin-right: 20px;"  v-on:click="openCreateRecord()">Add Packaging</button>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <element-movement :data="this.$parent.ListPackaging"></element-movement>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <create-movement></create-movement>
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
            openCreateRecord(){
                $(".create-movement-modal").modal('show');
            },

        }
    }

</script>
