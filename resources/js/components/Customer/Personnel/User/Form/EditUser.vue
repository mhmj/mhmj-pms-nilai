<template>
    <main id="js-page-content" role="main" class="page-content">
        <div class="subheader">
            <div class="col-12">
                <div class="subheader">
                    <h1 class="subheader-title">
                        <i class='subheader-icon fal fa-user'></i> {{User.name}}
                    </h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            User Details
                        </h2>

                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <form method="post" @submit.prevent="userChecked">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <div class="row" v-if="('name' in errors)">
                                                <div class="col">
                                                    <label class="text-danger">{{errors['name']}}</label>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" v-model="User.name" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <div class="row" v-if="('email' in errors)">
                                                <div class="col">
                                                    <label class="text-danger">{{errors['email']}}</label>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" v-model="User.email" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-lg-6" style="margin-top: 20px">
                                        <div class="form-group">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" v-model="User.phone_no" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6" style="margin-top: 20px">
                                        <div class="form-group">
                                            <label class="form-label">Remark</label>
                                            <input type="text" class="form-control" v-model="User.remark" >
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
            <div class="col-lg-5">
                <div id="panel-2" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Change Password
                        </h2>

                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <form @submit.prevent="updatePassword">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row" v-if="('success' in errors)">
                                            <div class="col">
                                                <label class="text-success" style="font-size: 15px">{{errors['success']}}</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group form-group-default required">
                                                    <label  class="form-label">Old Password</label>
                                                    <div class="row" v-if="('not_found' in errors)">
                                                        <div class="col">
                                                            <label class="text-danger">{{errors['not_found']}}</label>
                                                        </div>
                                                    </div>

                                                    <div class="row" v-if="('old_not_match' in errors)">
                                                        <div class="col">
                                                            <label class="text-danger">{{errors['old_not_match']}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="('same' in errors)">
                                                        <div class="col">
                                                            <label class="text-success">{{errors['same']}}</label>
                                                        </div>
                                                    </div>
                                                    <input type="password" v-on:submit="checkPassword" v-on:change="checkPassword" class="form-control" v-model="old_password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" style="margin-top: 20px">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group form-group-default required">
                                                    <label  class="form-label">New Password</label>
                                                    <div class="row" v-if="('not_match' in errors)">
                                                        <div class="col">
                                                            <label class="text-danger">{{errors['not_match']}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="row" v-if="('new_empty' in errors)">
                                                        <div class="col">
                                                            <label class="text-danger">{{errors['new_empty']}}</label>
                                                        </div>
                                                    </div>
                                                    <input type="password" class="form-control" v-model="new_password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 20px">
                                            <div class="col-lg-12">
                                                <div class="form-group form-group-default required">
                                                    <label class="form-label">Confirm Password</label>
                                                    <div class="row" v-if="('not_match' in errors)">
                                                        <div class="col">
                                                            <label class="text-danger">{{errors['not_match']}}</label>
                                                        </div>
                                                    </div>
                                                    <input type="password" class="form-control" v-model="confirm_password">
                                                </div>
                                            </div>
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
                User: this.data,
                editing: false,
                old_password:'',
                old_passwordCondition: '',
                new_password:'',
                confirm_password:'',
                status:'',
            }
        },
        created(){
        },
        watch: {
            'data': function() {
                this.User = this.data;
            }
        },
        methods: {
            userChecked()
            {
                this.errors = [];

                if(this.User.name && this.User.email && this.User.role)
                {
                    this.updateUser();
                }

                if(!this.User.name)
                {
                    this.errors['name'] = "Fill the Name"
                }
                if(!this.User.email)
                {
                    this.errors['email'] = "Fill the email"
                }
                if(!this.User.role)
                {
                    this.errors['role'] = "Choose the role"
                }
            },
            updateUser(){
                var url = '/api/v1/Personnel/User/Updates/'+ this.User.id +'/user', method = 'post';
                fetch(url, {
                    method: method,
                    body: JSON.stringify({
                        name: this.User.name,
                        email: this.User.email,
                        phone_no: this.User.phone_no,
                        role: this.User.role,
                        company_id: this.User.company_id,
                        remark: this.User.remark,
                    }),
                    headers: {
                        'content-type': 'application/json'
                    }
                }).then((response) => {
                    this.$notify({
                        title: 'Success',
                        message: 'Successfully Update User',
                        type: 'success'
                    });
                })
            },
            async checkPassword(){
                this.errors = [];

                axios.get('/api/v1/Personnel/User/Updates/check-password/'+ this.User.id + '/'+ this.old_password)
                    .then(function (response) {
                        this.status = response.data;

                        if(this.status === 'not'){
                            this.errors['not_found'] = "The password are not found in our record"
                        }
                        if(this.status === 'same'){
                            this.old_passwordCondition= "true";
                            this.errors['same'] = "The password are match with our record"
                        }

                    }.bind(this));
            },
            updatePassword(){
                this.errors = [];
                if((this.new_password === this.confirm_password) && (this.old_passwordCondition === "true") && this.new_password === this.confirm_password )
                {
                    axios.get('/api/v1/Personnel/User/Updates/'+ this.User.id + '/' + this.new_password +'/change-password')
                        .then(function (response) {

                            this.isLoading=true;
                            this.old_password = '';
                            this.new_password = '';
                            this.confirm_password = '';
                            this.errors['success'] = "The password are successfully changed";
                        }.bind(this));
                }

                if(!this.old_passwordCondition)
                {
                    this.errors['old_not_match'] = "The password are not found in our record"
                }


                if(!this.new_password){
                    this.errors['new_empty'] = "Fill the new password"
                }

                if(this.new_password !== this.confirm_password)
                {
                    this.errors['not_match'] = "The password are not match"
                }
            },
        },



    }

</script>