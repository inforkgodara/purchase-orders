<template>
    <section class="content">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-arrow-left cursor-pointer"
                                onclick="document.getElementById('back').click()">
                                <router-link :to="{ name: 'locations' }" id="back"></router-link>
                            </i>
                            Add Location
                        </h3>
                    </div>
                    <form @submit.prevent="store('locations-form')" action="/" method="post" data-vv-scope="locations-form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div :class="{'form-group': true, 'has-error': errors.has('locations-form.branch') }">
                                        <label>Branch</label>
                                        <select name="branch" class="form-control" v-validate="'required'"
                                            v-model="element.branch_id" ref="branch">
                                            <option value="">Please select branch</option>
                                            <option v-for="item in dropDownData.branches" :value="item.id" :key="item.id">
                                                {{ item.branch }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('locations-form.branch') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('locations-form.type') }">
                                        <label>Location Type</label>
                                        <select name="type" class="form-control" v-validate="'required'"
                                            v-model="element.location_type_id">
                                            <option value="">Please select location type</option>
                                            <option v-for="item in dropDownData.location_types" :value="item.id" :key="item.id">
                                                {{ item.type }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('locations-form.type') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('locations-form.name') }">
                                        <label for="name">Name </label>
                                        <input type="text" name="name" v-model="element.name"
                                            class="form-control" v-validate="'required|max:100'" id="name"
                                            placeholder="Enter location">
                                        <span class="help-block">{{ errors.first('locations-form.name') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div :class="{'form-group': true, 'has-error': errors.has('locations-form-form.building') }">
                                        <label>Building</label>
                                        <input class="form-control" v-model="element.building" name="building"
                                            v-validate="'max:255'" placeholder="Enter building">
                                        <span class="help-block">{{ errors.first('locations-form-form.building') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('locations-form-form.street') }">
                                        <label>Street</label>
                                        <input class="form-control" v-model="element.street" name="street"
                                            v-validate="'max:255'" placeholder="Enter street">
                                        <span class="help-block">{{ errors.first('locations-form-form.street') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('locations-form.city') }">
                                        <label>City</label>
                                        <select name="city" class="form-control" v-validate="'required'"
                                            v-model="element.city_id">
                                            <option value="">Please select city</option>
                                            <option v-for="item in dropDownData.cities" :value="item.id" :key="item.id">
                                                {{ item.city }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('locations-form.city') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-flat" id="save">Submit</button>
                            <button class="btn btn-primary btn-flat"
                                onclick="document.getElementById('cancel').click()">
                                Cancel
                                <router-link :to="{ name: 'locations' }" id="cancel"></router-link>
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
                    branch_id: '',
                    location_type_id: '',
                    city_id: ''
                },
                dropDownData: [],
                url: '/admin/locations',
                dropDownDataUrl: '/admin/resource-locations',
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
            axios.get(this.dropDownDataUrl)
                .then(function (resp) {
                    app.dropDownData = resp.data;
                })
                .catch(function (resp) {
                    // app.error();
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
                                        path: "/locations"
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
