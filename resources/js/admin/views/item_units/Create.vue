<template>
    <section class="content">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-arrow-left cursor-pointer"
                                onclick="document.getElementById('back').click()">
                                <router-link :to="{ name: 'item-units' }" id="back"></router-link>
                            </i>
                            Add Item Unit
                        </h3>
                    </div>
                    <form @submit.prevent="store('item-unit-form')" action="/" method="post" data-vv-scope="item-unit-form">
                        <div class="box-body">
                            <div :class="{'form-group': true, 'has-error': errors.has('item-unit-form.unit') }">
                                <label for="itemUnit">Item Unit</label>
                                <input type="text" name="unit" v-model="element.unit" class="form-control"
                                    id="itemUnit" placeholder="Enter item unit" autocomplete="off"
                                    v-validate="'required|max:50'" ref="itemUnit">
                                <span class="help-block">{{ errors.first('item-unit-form.unit') }}</span>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-flat" id="save">Submit</button>
                            <button class="btn btn-primary btn-flat"
                                onclick="document.getElementById('cancel').click()">
                                Cancel
                                <router-link :to="{ name: 'item-units' }" id="cancel"></router-link>
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
        name: 'create-item-unit',
        data: function () {
            return {
                element: {},
                url: '/admin/item-units',
                process: false
            }
        },
        mounted() {
            this.$refs.itemUnit.focus();
            document.onkeydown = function (e) {
                if (e.altKey && e.which == 83) {
                    document.getElementById('save').click();
                    return false;
                } else if (e.altKey && e.which == 67) {
                    document.getElementById('cancel').click();
                    return false;
                }
            }
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
                                            path: "/item-units"
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
