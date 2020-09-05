<template>
    <main id="js-page-content" role="main" class="page-content">
        <div class="subheader">
            <div class="col-12">
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-building'></i> {{Company.name}}
                    </h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Company Details
                        </h2>

                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <form method="post" @submit.prevent="companyChecked">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <div class="row" v-if="('name' in errors)">
                                                <div class="col">
                                                    <label class="text-danger">{{errors['name']}}</label>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" v-model="Company.name" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-lg-6" style="margin-top: 20px">
                                        <div class="form-group">
                                            <label class="form-label">Registration</label>
                                            <input type="text" class="form-control" v-model="Company.registration_no" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6" style="margin-top: 20px">
                                        <div class="form-group">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" v-model="Company.phone_no" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-lg-6" style="margin-top: 20px">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" v-model="Company.email" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6" style="margin-top: 20px">
                                        <div class="form-group">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" v-model="Company.state" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-lg-6" style="margin-top: 20px">
                                        <div class="form-group">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" v-model="Company.location" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6" style="margin-top: 20px">
                                        <div class="form-group">
                                            <label class="form-label">Post Code</label>
                                            <input type="text" class="form-control" v-model="Company.post_code" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Address</label>
                                            <textarea class="form-control" rows="5" v-model="Company.address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px">
                                    <div class="col-lg-12" style="display: flex; justify-content: flex-end">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
    export default {
        props: ['data'],
        data() {
            return {
                errors: [],
                Company: [],
            }
        },
        created(){
            this.fetchCompany();
        },
        methods: {
            fetchCompany(){
                fetch('/api/v1/Personnel/Company/Lists/customer/'+ this.data +'/company-details').then(response => response.json())
                    .then(response => {
                        this.Company = response.data;
                    })
                    .catch(error => console.log(error))
            },
            companyChecked()
            {
                this.errors = [];

                if(this.Company.name)
                {
                    this.updateCompany();
                }

                if(!this.Company.name)
                {
                    this.errors['name'] = "Fill the Company Name"
                }
            },
            updateCompany(){
                var url = '/api/v1/Personnel/Company/Updates/' + this.Company.id +'/company', method = 'post';
                fetch(url, {
                    method: method,
                    body: JSON.stringify({
                        name: this.Company.name,
                        registration_no: this.Company.registration_no,
                        address: this.Company.address,
                        post_code: this.Company.post_code,
                        state: this.Company.state,
                        phone_no: this.Company.phone_no,
                        location: this.Company.location,
                        email: this.Company.email,
                    }),
                    headers: {
                        'content-type': 'application/json'
                    }
                }).then((response) => {
                    this.$notify({
                        title: 'Success',
                        message: 'Successfully Update Company',
                        type: 'success'
                    });
                })
            },
        },



    }

</script>