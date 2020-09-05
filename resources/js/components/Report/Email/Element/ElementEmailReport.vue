<template>
    <div>
        <div class="row">
            <div class="col-lg-12" style="display: flex; justify-content: flex-end">
                <button type="submit" class="btn btn-primary" @click="exportToPDF()">Download PDF</button>
            </div>
        </div>
        <div class="">
            <div class="row" style="padding: 0px; font-family: 'Times New Roman'">
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">
                            <div class="row">
                                <div class="col-12">
                                    <img src="/img/tecnic2.png" style="height: 80px;width: 80px; margin-top: 15px" class="logo">
                                </div>
                            </div>
                        </div>
                        <div class="col-10" style="margin-left: -25px">
                            <div class="row">
                                <div class="col-12">
                                    <span><span style="font-size: 25px; font-weight: bold">Plastictecnic(M) Sdn Bhd </span> REG: 197601004542 (30481-V)</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-11">
                                    <p>PKT 1, Lot 1, Jalan P/2a, Kawasan Perusahaan Beranang,</p>
                                    <p style="margin-top: -15px">43650 Bandar Baru Bangi, Selangor Darul Ehsan, Malaysia</p>
                                    <p style="margin-top: -15px">Tel: (6) 03-8925 6950(8 lines) Fax: (6) 03-8925 6955</p>
                                    <p style="margin-top: -15px">www.plastictecnic.com</p>
                                </div>
                                <div class="col-1" style="display: flex; justify-content: flex-end; ">
                                    <img src="/img/iso.png" style="height: 60px; width: 90px; margin-top: 10px" class="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border: solid 0.5px black; margin-top: -10px;">
            <div class="row" style="padding: 0px; font-family: 'Times New Roman'">
                <div class="col-12" style="display: flex; justify-content: center;">
                    <div class="row">
                        <span style="font-size: 18px; font-weight: bold; text-decoration: underline">Monthly Report</span>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 30px;padding: 0px; font-family: 'Times New Roman'">
                <div class="col-lg-12">
                    <report-list></report-list>
                </div>
            </div>
            <div class="row" style="padding: 0px; margin-top: 5px; margin-left: 5px; margin-right: 0px">
                <span>This is a computer-generated document. No signature is required.</span>
            </div>
        </div>
    </div>
</template>
<script>
    import html2pdf from 'html2pdf.js'
    export default {
        name :'pdf',
        data(){
            return {
                type_name: '',
                temporary: '',
                isPDF: false,
            }
        },
        mounted() {},
        created() {},
        computed: {},
        methods :{

            exportToPDF () {
                this.isPDF = true;
                var currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'-');
                this.temporary = html2pdf(this.$refs.document, {
                    margin: 0.5,
                    filename: 'Monthly Report.pdf',
                    image: { type: 'jpeg', quality: 1000 },
                    html2canvas: { scale: 4 },
                    jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' },

                })
            },
        }
    }


</script>