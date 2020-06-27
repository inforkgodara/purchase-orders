<template>
    <section class="content">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-arrow-left cursor-pointer"
                                onclick="document.getElementById('back').click()">
                                <router-link :to="{ name: 'provinces' }" id="back"></router-link>
                            </i>
                            Edit Province
                        </h3>
                    </div>
                    <form @submit.prevent="update('province-form')" action="/" method="post"
                        data-vv-scope="province-form">
                        <div class="box-body">
                            <div :class="{'form-group': true, 'has-error': errors.has('province-form.province') }">
                                <label for="province">Province</label>
                                <input type="text" name="province" v-model="element.province" class="form-control"
                                    id="province" placeholder="Enter province" autocomplete="off"
                                    v-validate="'required|alpha_spaces|max:30'" ref="province">
                                <span class="help-block">{{ errors.first('province-form.province') }}</span>
                            </div>
                            <div :class="{'form-group': true, 'has-error': errors.has('province-form.country') }">
                                <label>Country</label>
                                <select name="country" class="form-control" v-validate="'required'"
                                    v-model="element.country_id">
                                    <option value="">Please select country</option>
                                    <option v-for="item in countries" :value="item.id" :key="item.id">
                                        {{ item.country }}
                                    </option>
                                </select>
                                <span class="help-block">{{ errors.first('province-form.country') }}</span>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-flat" id="save">Submit</button>
                            <button class="btn btn-primary btn-flat"
                                onclick="document.getElementById('cancel').click()">
                                Cancel
                                <router-link :to="{ name: 'provinces' }" id="cancel"></router-link>
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
        name: 'edit-province',
        data: function () {
            return {
                element: {
                    province: '',
                    country_id: ''
                },
                countries: [],
                url: '/admin/provinces/',
                process: false
            }
        },
        mounted() {
            var app = this;
            this.$refs.province.focus();
            document.onkeydown = function (e) {
                if (e.altKey && e.which == 83) {
                    document.getElementById('save').click();
                    return false;
                } else if (e.altKey && e.which == 67) {
                    document.getElementById('cancel').click();
                    return false;
                }
            }

            this.process = true;
            axios.get(this.url + app.$route.params.id + '/edit')
                .then(function (resp) {
                    app.element = resp.data.element;
                    app.countries = resp.data.countries;
                })
                .catch(function (resp) {
                    app.error();
                })
                .finally(function() {
                    app.process = false;
                })
        },
        methods: {
            update(scope) {
                var app = this;
                this.$validator.validateAll(scope).then((result) => {
                    if (result) {
                        this.process = true;
                        axios.post(this.url + this.element.id, this.element)
                            .then(function (resp) {
                                if (resp.data.status == "fail") {

                                } else if (resp.data.status == "pass") {
                                    app.$toasted.show(
                                        resp.data.message, {
                                            type: 'success',
                                            icon: 'check',
                                        });
                                    app.$router.push({
                                        path: "/provinces"
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
