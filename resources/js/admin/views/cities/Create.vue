<template>
    <section class="content">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-arrow-left cursor-pointer"
                                onclick="document.getElementById('back').click()">
                                <router-link :to="{ name: 'cities' }" id="back"></router-link>
                            </i>
                            Add City
                        </h3>
                    </div>
                    <form @submit.prevent="store('city-form')" action="/" method="post"
                        data-vv-scope="city-form">
                        <div class="box-body">
                            <div :class="{'form-group': true, 'has-error': errors.has('city-form.city') }">
                                <label for="city">City</label>
                                <input type="text" name="city" v-model="element.city" class="form-control"
                                    id="city" placeholder="Enter city" autocomplete="off"
                                    v-validate="'required|max:30'" ref="city">
                                <span class="help-block">{{ errors.first('city-form.city') }}</span>
                            </div>
                            <div :class="{'form-group': true, 'has-error': errors.has('city-form.province') }">
                                <label>Province</label>
                                <select name="province" @change="changeProvince($event)" class="form-control" v-validate="'required'"
                                    v-model="element.province_id">
                                    <option value="">Please select province</option>
                                    <option v-for="item in provinces" :value="item.id" :key="item.id">
                                        {{ item.province }}
                                    </option>
                                </select>
                                <span class="help-block">{{ errors.first('city-form.city') }}</span>
                            </div>
                            <div :class="{'form-group': true, 'has-error': errors.has('city-form.country') }">
                                <label>Country</label>
                                <select name="country" disabled class="form-control" v-validate="'required'"
                                    v-model="element.country_id">
                                    <option value="">Please select country</option>
                                    <option v-for="item in countries" :value="item.id" :key="item.id">
                                        {{ item.country }}
                                    </option>
                                </select>
                                <span class="help-block">{{ errors.first('city-form.country') }}</span>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-flat" id="save">Submit</button>
                            <button class="btn btn-primary btn-flat"
                                onclick="document.getElementById('cancel').click()">
                                Cancel
                                <router-link :to="{ name: 'cities' }" id="cancel"></router-link>
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
        name: 'create-city',
        data: function () {
            return {
                element: {
                    province_id: '',
                    country_id: '',
                },
                provinces: [],
                countries: [],
                url: '/admin/cities',
                provinceUrl: '/admin/resource-provinces',
                process: false
            }
        },
        mounted() {
            this.$refs.city.focus();
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
            axios.get(this.provinceUrl)
                .then(function (resp) {
                    app.provinces = resp.data.provinces;
                    app.countries = resp.data.countries;
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
                                            path: "/cities"
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
            changeProvince() {

                let province =  this.provinces.filter(province => {
                    return province.id == event.target.value;
                });
                
                this.element.country_id = province[0].country.id;
            }
        }
    }

</script>
