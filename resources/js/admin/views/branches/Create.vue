<template>
    <section class="content">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-arrow-left cursor-pointer"
                                onclick="document.getElementById('back').click()">
                                <router-link :to="{ name: 'branches' }" id="back"></router-link>
                            </i>
                            Add Branch
                        </h3>
                    </div>
                    <form @submit.prevent="store('branch-form')" action="/" method="post" data-vv-scope="branch-form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div :class="{'form-group': true, 'has-error': errors.has('branch-form.branch') }">
                                        <label for="branch">Branch</label>
                                        <input type="text" name="branch" v-model="element.branch" class="form-control"
                                            id="branch" v-validate="'required|max:80'" ref="branch"
                                            placeholder="Enter branch">
                                        <span class="help-block">{{ errors.first('branch-form.branch') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('branch-form.phone') }">
                                        <label for="phoneNumber">Phone Number</label>
                                        <input type="text" name="phone" v-model="element.phone_number"
                                            class="form-control" v-validate="'max:15'" id="phoneNumber"
                                            placeholder="Enter phone number">
                                        <span class="help-block">{{ errors.first('branch-form.phone') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('branch-form.email') }">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" v-model="element.email" class="form-control"
                                            id="email" v-validate="'email|max:80'" placeholder="Enter email">
                                        <span class="help-block">{{ errors.first('branch-form.email') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('branch-form.city') }">
                                        <label>City</label>
                                        <select name="city" class="form-control" v-validate="'required'"
                                            v-model="element.city_id">
                                            <option value="">Please select city</option>
                                            <option v-for="item in cities" :value="item.id" :key="item.id">
                                                {{ item.city }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('branch-form.city') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div :class="{'form-group': true, 'has-error': errors.has('branch-form.building') }">
                                        <label>Building</label>
                                        <textarea class="form-control" v-model="element.building" name="building"
                                            rows="4" v-validate="'max:255'"
                                            placeholder="Enter building"></textarea>
                                        <span class="help-block">{{ errors.first('branch-form.building') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('branch-form.street') }">
                                        <label>Street</label>
                                        <textarea class="form-control" v-model="element.street" name="street"
                                            rows="4" v-validate="'max:255'" placeholder="Enter street"></textarea>
                                        <span class="help-block">{{ errors.first('branch-form.street') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-flat" id="save">Submit</button>
                            <button class="btn btn-primary btn-flat"
                                onclick="document.getElementById('cancel').click()">
                                Cancel
                                <router-link :to="{ name: 'branches' }" id="cancel"></router-link>
                            </button>
                        </div>
                    </form>
                    <div v-show="process" class="overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    export default {
        name: 'create-branch',
        data: function () {
            return {
                element: {
                    city_id: ''
                },
                url: '/admin/branches',
                cityUrl: '/admin/resource-cities',
                process: false,
                cities: [],
            }
        },
        mounted() {
            this.$refs.branch.focus();
            document.onkeydown = function (e) {
                if (e.altKey && e.which == 83) {
                    document.getElementById('save').click();
                    return false;
                } else if (e.altKey && e.which == 67) {
                    document.getElementById('cancel').click();
                    return false;
                }
            }
            var app = this;
            axios.get(this.cityUrl)
                .then(function (resp) {
                    app.cities = resp.data;
                })
                .catch(function (resp) {
                    app.error();
                });
        },
        methods: {
            store(scope) {
                var app = this;
                this.$validator.validateAll(scope).then((result) => {
                    if (result) {
                        this.process = true;
                        axios.post(this.url, this.element)
                            .then(function (resp) {
                                if (resp.data.status == "fail") {

                                } else if (resp.data.status == "pass") {
                                    app.$toasted.show(
                                        resp.data.message, {
                                            type: 'success',
                                            icon: 'check',
                                        });
                                    app.$router.push({
                                        path: "/branches"
                                    });
                                }
                            })
                            .catch(function (resp) {

                            })
                            .finally(function () {
                                app.process = false;
                            });
                    }
                });
            },
        }
    }

</script>
