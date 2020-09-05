<template>
    <main id="js-page-content" role="main" class="page-content">
        <div class="subheader" >
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-shipping-fast'></i> {{Shipment.company_id.name}} - <span class="text-primary text-bold" style="font-weight: bold"> {{Shipment.delivery_no}}</span>
            </h1>
            <div style="display: flex; justify-content: flex-end;">
                <button class="btn btn-primary" data-toggle="modal" data-target="#default-example-modal-lg">Consignment Note</button>
            </div>
        </div>
        <div class="row">

        </div>
        <div class="row">
            <edit-shipment-out :data="this.Shipment"></edit-shipment-out>
        </div>
        <div class="row">
            <!--<element-scanner-out></element-scanner-out>-->
            <div class="col-4">
                <div class="row">
                    <div class="col-12">
                        <div id="panel-2" class="panel">
                            <div class="panel-hdr">
                                <h2 >
                                    Wired Scanner
                                </h2>

                            </div>
                            <div class="panel-container show">
                                <div class="panel-content" style="">
                                    <div class="form-group">
                                        <label class="text-danger">* Please click on the box below to start the scanning process</label>
                                        <form method="post" @submit.prevent="checkPackagingNo">
                                            <div class="input-group">
                                                <input type="text" style="height: 30px"  class="form-control" id="WiredCleanPackagingNo" v-model="packaging_no" v-on:type="onDecode">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="panel-1" class="panel">
                            <div class="panel-hdr">
                                <h2>
                                    Scanner
                                </h2>

                            </div>
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
                </div>
            </div>
            <list-movement></list-movement>
            <div class="modal fade" id="default-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{Shipment.company_id.name}} - <span class="text-primary text-bold" style="font-weight: bold"> {{Shipment.delivery_no}}</span></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                            </button>
                        </div>
                        <div class="modal-body"   style="border: 1px dashed gray;">
                            <div class="" id="document" ref="document">
                                <element-invoice-out></element-invoice-out>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" @click="exportToPDF">Download</button>
                        </div>
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
                ListPackaging:[],
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
                TemporaryPackaging:[],
                isScanner: false,
                ListtemporaryPackaging:[],
                packaging_no:'',
                status:'',
            }
        },
        created(){
            this.fetchShipmentDetails();
            this.fetchPackagingShipment();
            this.id= this.data;
        },
        mounted() {
            Event.$on('fetchShipmentDetails', () => {
                this.fetchShipmentDetails();
            });
            Event.$on('fetchPackagingShipment', () => {
                this.fetchPackagingShipment();
            });
        },

        methods : {
            exportToPDF () {
                var currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'-');
                var element = document.getElementById('document');
                // Generate the PDF.
                html2pdf().from(element).set({
                    margin: 0.5,
                    filename: currentDateWithFormat + ' - ' + this.Shipment.company_id.name+' - Packaging Verification.pdf',
                    image: { type: 'jpeg', quality: 1000 },
                    html2canvas: { scale: 4 },
                    pageBreak: {
                        mode:   ['avoid-all', 'css'],
                        after: '#firstPage',
                        before: '#nextPage'
                    },
                    jsPDF: {orientation: 'portrait', unit: 'in', format: 'letter', compressPDF: true}
                }).save();
//                html2pdf(this.$refs.document, {
//                    margin: 0.5,
//                    filename: currentDateWithFormat + ' - ' + this.Shipment.company_id.name+' - Packaging Verification.pdf',
//                    image: { type: 'jpeg', quality: 1000 },
//                    html2canvas: { scale: 4 },
//                    pageBreak: {
//                        mode:   ['avoid-all', 'css'],
//                        after: '#firstPage',
//                        before: '#nextPage'
//                    },
////                    html2canvas: { dpi: 800, letterRendering: true },
//                    jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' },
//                });
//                html2pdf().set({
//                    pagebreak: { before: '.beforeClass', after: ['#after1', '#after2'], avoid: 'img' }
//                });
            },
            generateReport () {
                this.$refs.html2Pdf.generatePdf()
            },

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
            checkPackagingNo(scanner){
                if(scanner === false)
                {
                    this.packaging_no = this.options + this.packaging_no;

                }
                this.isScanner = false;

                if(this.ListtemporaryPackaging.indexOf(this.packaging_no) !== -1){
                    this.$notify({
                        title: 'Error',
                        message: 'The record already exist in the table',
                        type: 'error'
                    });

                    this.packaging_no = '';
                } else{
//                    this.fetchPackaging();
                    this.checkStatusPackaging();

                }
            },
            fetchPackaging(){
                fetch('/api/v1/Packaging/Lists/'+ this.packaging_no +'/list-packaging-details').then(response => response.json())
                    .then(response => {
                        this.TemporaryPackaging = response.data[0];
                        this.createMovement();
                        this.packaging_no = '';
                    })
                    .catch(error => console.log(error))
            },
            async checkStatusPackaging(){

                axios.get('/api/v1/Packaging/Lists/'+ this.packaging_no +'/status')
                    .then(function (response) {
                        this.status = response.data;
                        if(this.status === 'no'){
                            this.$notify({
                                title: 'Error',
                                message: 'The package not in the warehouse',
                                type: 'error'
                            });
                        }
                        if(this.status === 'yes'){
                            this.fetchPackaging();
                        }
                        this.packaging_no = '';
                    }.bind(this));
            },
//            checkStatusPackaging(){
//                fetch('/api/v1/Packaging/Lists/'+ this.packaging_no +'/status').then(response => response.json())
//                    .then(response => {
//                        this.status = response.data;
//                        console.log(this.status);
//                        if(this.status === 'no'){
//                            this.$notify({
//                                title: 'Error',
//                                message: 'The package not in the warehouse',
//                                type: 'error'
//                            });
//                        }
//                        if(this.status === 'yes'){
//                            this.$notify({
//                                title: 'Success',
//                                message: 'The package in the warehouse',
//                                type: 'success'
//                            });
////                            this.fetchPackaging();
//                        }
//                        this.packaging_no = '';
//                    })
//                    .catch(error => console.log(error))
//            },
            fetchShipmentDetails(){
                fetch('/api/v1/Shipment/Lists/'+ this.data +'/details').then(response => response.json())
                    .then(response => {
                        this.Shipment = response.data;
                    })
                    .catch(error => console.log(error))
            },
            fetchPackagingShipment(){
                this.ListtemporaryPackaging = [];
                fetch('/api/v1/Movement/Lists/'+ this.data +'/movement').then(response => response.json())
                    .then(response => {
                        this.ListPackaging = response.data;

                        for(var i=0; i<this.ListPackaging.length; i++)
                        {
                            this.ListtemporaryPackaging.push(response.data[i].packaging_no);
                        }
                    })
                    .catch(error => console.log(error))
            },
            createMovement(){
                var url = '/api/v1/Movement/Creates/movement', method = 'post';
                fetch(url, {
                    method: method,
                    body: JSON.stringify({
                        type_name: this.TemporaryPackaging.type_name,
                        packaging_no: this.TemporaryPackaging.packaging_no,
                        delivery_no: this.Shipment.delivery_no,
                        shipment_id: this.Shipment.id,
                        remark: this.TemporaryPackaging.remark,
                        status: 'OUT',
                        status_received: 'OUT',
                    }),
                    headers: {
                        'content-type': 'application/json'
                    }
                }).then((response) => {
                    this.TemporaryPackaging =[];
                    this.fetchPackagingShipment();
                    //Event.$emit('fetchPackagingShipment');
                    //Event.$emit('updateTablePackagingMovement');
                    this.$notify({
                        title: 'Success',
                        message: 'Successfully Add Packaging To Shipment',
                        type: 'success'
                    });
                })
            },

        }
    }

</script>
