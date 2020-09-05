<template>
    <div>
        <div class="row">
            <div class="col-5">
                <div id="panel-1" class="panel">
                    <div class="panel-container show">
                        <div class="panel-content" style="padding: 0; height: 300px;">
                            <a @click="isScanner = true">
                                <div style="background-color: lightgray; display: flex;justify-content: center;align-items: center;height: 300px;"  v-if="this.isScanner == false">
                                    <i class="fal fa-camera" style="font-size: 30px; color: black; border: none; "></i>
                                </div>
                            </a>
                            <div style="display: flex;justify-content: center;align-items: center;height: 100%;" v-if="this.isScanner == true">
                                <qrcode-stream  @decode="onDecode">
                                    <a @click="isScanner = false">
                                        <i class="fal fa-times" style="font-size: 30px; color: black; display: flex; justify-content: flex-end; margin-right: 10px; margin-top: 10px; color: white; "></i>
                                    </a>
                                </qrcode-stream>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="panel-2" class="panel">
                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="form-group">
                                        <h5 class="form-label">Packaging No</h5>
                                        <form method="post" @submit.prevent="checkPackagingNo(false)">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <v-select  style="padding: 0px;" class="dropdown-item" :options="ListType" :reduce="ListType => ListType.id " :label="ListType.label" v-model="options"></v-select>
                                                </div>
                                                <input type="text" style="height: 30px" aria-label="Packaging No" class="form-control" placeholder="123456" id="DamagePackagingNo" v-model="packaging_no">
                                                <div class="input-group-append">
                                                    <button type="submit"  style="height: 30px" class="btn btn-primary shadow-0">
                                                        <p style="margin-top: -3px;">Search</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="panel-3" class="panel">
                            <div class="panel-container show">
                                <div class="panel-content">
                                    <div class="form-group">
                                        <h5 class="form-label">Wired Scanner</h5>
                                        <label class="text-danger">* Please click on the box below to start the scanning process</label>
                                        <form method="post" @submit.prevent="checkPackagingNo">
                                            <div class="input-group">
                                                <input type="text" style="height: 30px"  class="form-control" id="WiredDamagePackagingNo" v-model="packaging_no" v-on:type="onDecode">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <update-movement :data="this.ListPackaging" state="damage"></update-movement>
            </div>
        </div>

        <remove-damage-movement :data="this.Packaging"></remove-damage-movement>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                packaging_no:'',
                condition:true,
                ListPackaging:[],
                Packaging:[],
                dataTable:null,
                options: 'PAL001 - ',
                ListType:[],
                isScanner: false,
                error: '',
                temporaryPackaging:[],
            }
        },
        created(){
            this.TypeList();
        },
        mounted() {
            Event.$on('updateTablePackagingMovement', () => {
                this.updateTable();
            });
        },
        watch: {
//            ListPackaging() {
//                this.updateTable();
//            }
        },

        methods : {
            onDecode (result) {
                this.packaging_no = result;
                this.checkPackagingNo(true);
            },
            async onInit (promise) {
                try {
                    await promise
                } catch (error) {
                    if (error.name === 'NotAllowedError') {
                        this.error = "ERROR: You need to grant camera access permission"
                    } else if (error.name === 'NotFoundError') {
                        this.error = "ERROR: No camera on this device"
                    } else if (error.name === 'NotSupportedError') {
                        this.error = "ERROR: Secure context required (HTTPS, localhost)"
                    } else if (error.name === 'NotReadableError') {
                        this.error = "ERROR: Is the camera already in use?"
                    } else if (error.name === 'OverconstrainedError') {
                        this.error = "ERROR: Installed cameras are not suitable"
                    } else if (error.name === 'StreamApiNotSupportedError') {
                        this.error = "ERROR: Stream API is not supported in this browser"
                    }
                }
                if(this.error)
                {
                    if(confirm(this.error + '\nPlease click OK to refresh the page.')){
                        window.location.reload();
                    }
                }
            },
            async reload () {
                this.isScanner = false;

                await this.$nextTick();

                this.isScanner = true;
            },
            openDeleteRecord(id){
                $("#delete-damage-movement-modal").modal('show');
                this.Packaging = id;
            },
            TypeList(){
                axios.get('/api/v1/Packaging/Lists/all-type')
                    .then(function (response) {
                        this.ListType = $.map(response.data, function (value) {
                            return {'id': value.name + ' - ', 'label': value.name + ' - '};
                        });
                    }.bind(this));
            },
            checkPackagingNo(scanner){
                if(scanner === false)
                {
                    this.packaging_no = this.options + this.packaging_no;

                }
                this.isScanner = false;

                if(this.temporaryPackaging.indexOf(this.packaging_no) !== -1){
                    this.$notify({
                        title: 'Error',
                        message: 'The record already exist in the table',
                        type: 'error'
                    });

                    this.packaging_no = '';
                } else{
                    this.fetchPackaging();
                }
            },
            fetchPackaging(){
                fetch('/api/v1/Movement/Lists/'+ this.packaging_no +'/OUT/search').then(response => response.json())
                    .then(response => {

                        if(!Object.keys(response).length )
                        {
                            this.$notify({
                                title: 'Error',
                                message: 'The package already in the warehouse',
                                type: 'error'
                            });
                        }
                        if(Object.keys(response).length)
                        {
                            this.ListPackaging.push(response);
                            this.temporaryPackaging.push(this.packaging_no);
                            this.$notify({
                                title: 'Success',
                                message: 'The record successfully added',
                                type: 'success'
                            });
                        }
                        this.packaging_no = '';
                    })
                    .catch(error => console.log(error))
            },
        }
    }

</script>

