<template>
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
                                <p>Lot 1804 Jalan Lengkok Emas, Kawasan Perindustrian Nilai</p>
                                <p style="margin-top: -15px">71800 Nilai, Negeri Sembilan, Malaysia</p>
                                <p style="margin-top: -15px">Tel: (6) 06-799 0010 Fax: (6) 06-799 0016</p>
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
                    <span style="font-size: 18px; font-weight: bold; text-decoration: underline">PACKAGING VERIFICATION</span>
                </div>
            </div>
        </div>
        <div class="row" style="padding: 0px;font-size: 14px; margin-left: 0px; margin-top: 15px">
            <div class="col-7" style="display: flex; justify-content: flex-start;">
                <div class="row">
                    <table style="font-size: 13px">
                        <tr>
                            <td>Customer</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><span style=" margin-left: 10px">{{$parent.Shipment.company_id.name}}</span></td>
                        </tr>
                        <tr style="margin-top: 15px">
                            <td>Vehicle No</td>
                            <td>:</td>
                            <td style="font-weight: bold"><span style=" margin-left: 10px">{{$parent.Shipment.vehicle_no}}</span></td>
                        </tr>
                        <tr style="margin-top: 15px">
                            <td>Created By</td>
                            <td>:</td>
                            <td style="font-weight: bold"><span style=" margin-left: 10px">{{$parent.Shipment.created_by}}</span></td>
                        </tr>
                        <tr style="margin-top: 15px">
                            <td>Received By</td>
                            <td>:</td>
                            <td style="font-weight: bold"><span style=" margin-left: 10px">{{$parent.Shipment.received_by}}</span></td>
                        </tr>
                        <tr style="margin-top: 15px">
                            <td>Delivered By</td>
                            <td>:</td>
                            <td style="font-weight: bold"><span style=" margin-left: 10px">{{$parent.Shipment.delivery_by}}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-5" style="display: flex; justify-content: flex-end; margin-left: -15px">
                <div class="row">
                    <table style="border: 1px solid black; padding: 50px; width: 200px; height: 80px;">
                        <tr  style="border-bottom: 1px solid black;">
                            <td class="text-dark" style="border-right: 1px solid black; margin-left: 10px"><span style=" margin-left: 10px">Delivery No</span></td>
                            <td  style="font-weight: bold"><span style=" margin-left: 10px">{{$parent.Shipment.delivery_no}}</span></td>
                        </tr>
                        <tr>
                            <td  style="border-right: 1px solid black;"><span style=" margin-left: 10px">Date</span></td>
                            <td style="font-weight: bold"><span style=" margin-left: 10px">{{$parent.Shipment.created_at}}</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row" style="padding: 0px; margin-top: 15px; margin-left: 5px; margin-right: 0px">
            <table id="dt-shipment-packaging" style="height: 350px; border: 1px solid black;" class="dt-shipping table">
                <thead class="bg-default">
                <tr style="border-bottom: 1px solid black;">
                    <th>Type</th>
                    <th  style="border-left: 1px solid black;">No</th>
                </tr>
                </thead>
                <tbody>

                <tr style="height: auto; border-left: 1px solid black; max-lines: inherit" v-for=" type_name in uniqueNames" v-if="type_name" >
                    <td>{{type_name}}</td>
                    <!--<td>{{ListPackaging.type_name}}</td>-->
                    <td style="border-left: 1px solid black;">
                        <span style="" v-for="ListPackaging in $parent.ListPackaging" v-if="ListPackaging.type_name == type_name"> &nbsp;{{ListPackaging.packaging_no}} &nbsp;| </span>
                        <!--{{ListPackaging.packaging_no.slice(8, 16)}} | {{ListPackaging.packaging_no.slice(8, 16)}}-->
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row" style="margin-top: 10px; margin-left: 5px; margin-right: 0px">
            <div class="col-2">
                <div class="row">
                    <div class="col-lg-12">
                        <span>Remark :</span>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <div class="row">
                    <div class="col-lg-12">
                        <hr style="border: solid 0.5px black;">
                        <hr style=" margin-top:25px; border: solid 0.5px black;">
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 10px; margin-left: 5px; margin-right: 0px">
            <div class="col-4">
                <div class="row">
                    <div class="col-lg-12">
                        <span>Delivered By :</span>
                    </div>
                </div>
                <div class="row" style="margin-top: 60px;">
                    <div class="col-lg-11">
                        <hr style="border: dashed 0.5px black;">
                    </div>
                </div>
                <div class="row" style="margin-top: 0px;">
                    <div class="col-lg-12">
                        <p>{{$parent.Shipment.delivery_by}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-lg-12">
                        <p>Verified By :</p>
                    </div>
                </div>
                <div class="row" style="margin-top: 45px;">
                    <div class="col-lg-11">
                        <hr style="border: dashed 0.5px black;">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-lg-12">
                        <span>Customer Acknowledgement :</span>
                    </div>
                </div>
                <div class="row" style="margin-top: 60px;">
                    <div class="col-lg-11">
                        <hr style="border: dashed 0.5px black;">
                    </div>
                </div>
                <div class="row" style="margin-top: 0px;">
                    <div class="col-lg-12">
                        <p>Cop & Name:</p>
                    </div>
                </div>
                <div class="row" style="margin-top: 5px;">
                    <div class="col-lg-12">
                        <p>Date & Time:</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                type_name: '',
            }
        },
        computed: {
            uniqueNames: function() {
                var filtered_array = [];
                for(var i =0; i < this.$parent.ListPackaging.length; i++) {
                    if(filtered_array.indexOf(this.$parent.ListPackaging[i].type_name) === -1) {
                        filtered_array.push(this.$parent.ListPackaging[i].type_name)
                    }
                }
                return filtered_array;
            }
        }
    }


</script>