<template>
    <section class="content">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-arrow-left cursor-pointer"
                                onclick="document.getElementById('back').click()">
                                <router-link :to="{ name: 'items' }" id="back"></router-link>
                            </i>
                            Edit Item
                        </h3>
                    </div>
                    <form @submit.prevent="update('resource-form')" action="/" method="post"
                        data-vv-scope="resource-form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div :class="{'form-group': true, 'has-error': errors.has('resource-form.group') }">
                                        <label>Group</label>
                                        <select name="group" class="form-control" v-validate="'required'"
                                            v-model="element.item_group_id" ref="group">
                                            <option value="">Please select group</option>
                                            <option v-for="item in dropDownData.item_groups" :value="item.id" :key="item.id">
                                                {{ item.group }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('resource-form.group') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('resource-form.category') }">
                                        <label for="category">Category </label>
                                        <select name="category" class="form-control" v-validate="'required'"
                                            v-model="element.item_category_id">
                                            <option value="">Please select category</option>
                                            <option v-for="item in dropDownData.item_categories" :value="item.id" :key="item.id">
                                                {{ item.category }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('resource-form.category') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('resource-form.name') }">
                                        <label for="name">Item Name </label>
                                        <input type="text" name="name" v-model="element.name"
                                            class="form-control" v-validate="'required|max:120'" id="name"
                                            placeholder="Enter item name">
                                        <span class="help-block">{{ errors.first('resource-form.name') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('resource-form.code') }">
                                        <label for="code">Bar Code </label>
                                        <input type="text" name="code" v-model="element.bar_code"
                                            class="form-control" v-validate="'max:30'" id="code"
                                            placeholder="Enter bar code">
                                        <span class="help-block">{{ errors.first('resource-form.code') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div :class="{'form-group': true, 'has-error': errors.has('resource-form.pack') }">
                                        <label>Pack Unit</label>
                                        <select name="pack" class="form-control" v-validate="'required'"
                                            v-model="element.pack_unit_id" ref="pack">
                                            <option value="">Please select pack unit</option>
                                            <option v-for="item in dropDownData.units" :value="item.id" :key="item.id">
                                                {{ item.unit }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('resource-form.pack') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('resource-form.standard') }">
                                        <label>Standard Unit</label>
                                        <select name="standard" class="form-control" v-validate="'required'"
                                            v-model="element.standard_unit_id">
                                            <option value="">Please select standard unit</option>
                                            <option v-for="item in dropDownData.units" :value="item.id" :key="item.id">
                                                {{ item.unit }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('resource-form.standard') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('resource-form.size') }">
                                        <label for="size">Pack Size </label>
                                        <input type="text" name="size" v-model="element.pack_size"
                                            class="form-control" v-validate="'required|min_value:1|numeric|max:10'" id="size"
                                            placeholder="Enter pack size">
                                        <span class="help-block">{{ errors.first('resource-form.size') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('resource-form.specification') }">
                                        <label for="specification">Specification </label>
                                        <input type="text" name="specification" v-model="element.specification"
                                            class="form-control" v-validate="'max:255'" id="specification"
                                            placeholder="Enter item specification">
                                        <span class="help-block">{{ errors.first('resource-form.specification') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-flat" id="save">Submit</button>
                            <button class="btn btn-primary btn-flat"
                                onclick="document.getElementById('cancel').click()">
                                Cancel
                                <router-link :to="{ name: 'items' }" id="cancel"></router-link>
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
        name: 'edit-item',
        data: function () {
            return {
                element: {
                    item_group_id: '',
                    item_category_id: '',
                    name: '',
                    bar_code: '',
                    pack_unit_id: '',
                    standard_unit_id: '',
                    pack_size: 1,
                    specification: ''
                },
                url: '/admin/items/',
                process: false,
                dropDownData: []
            }
        },
        mounted() {
            this.$refs.group.focus();
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
                    app.element = resp.data.element;
                    app.dropDownData = resp.data.dropdownData;
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
                                        path: "/items"
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
