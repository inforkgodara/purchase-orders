<template>
    <section class="content">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-arrow-left cursor-pointer"
                                onclick="document.getElementById('back').click()">
                                <router-link :to="{ name: 'countries' }" id="back"></router-link>
                            </i>
                            Edit Country
                        </h3>
                    </div>
                    <form @submit.prevent="update('country-form')" action="/" method="post"
                        data-vv-scope="country-form">
                        <div class="box-body">
                            <div :class="{'form-group': true, 'has-error': errors.has('country-form.country') }">
                                <label for="country">Country</label>
                                <input type="text" name="country" v-model="element.country" class="form-control"
                                    id="country" placeholder="Enter country" autocomplete="off"
                                    v-validate="'required|max:30'" ref="country">
                                <span class="help-block">{{ errors.first('country-form.country') }}</span>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-flat" id="save">Submit</button>
                            <button class="btn btn-primary btn-flat"
                                onclick="document.getElementById('cancel').click()">
                                Cancel
                                <router-link :to="{ name: 'countries' }" id="cancel"></router-link>
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
        name: 'edit-country',
        data: function () {
            return {
                element: {
                    country: '',
                },
                url: '/admin/countries/',
                process: false
            }
        },
        mounted() {
            this.$refs.country.focus();
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
            this.process = true;
            axios.get(this.url + app.$route.params.id + '/edit')
                .then(function (resp) {
                    app.element = resp.data;
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
                                        path: "/countries"
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
