<template>
    <section class="content">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-arrow-left cursor-pointer"
                                onclick="document.getElementById('back').click()">
                                <router-link :to="{ name: 'item-prices' }" id="back"></router-link>
                            </i>
                            Add Item
                        </h3>
                    </div>
                    <form @submit.prevent="store('resource-form')" action="/" method="post"
                        data-vv-scope="resource-form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div
                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.branch') }">
                                        <label>Branch</label>
                                        <select name="branch" class="form-control" v-validate="'required'"
                                            v-model="element.branch_id" ref="branch">
                                            <option value="">Please select branch</option>
                                            <option v-for="item in dropDownData.branches" :value="item.id"
                                                :key="item.id">
                                                {{ item.branch }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('resource-form.branch') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('resource-form.item') }">
                                        <label for="name">Item Name </label>
                                        <v-select v-model="searchSelectData" label="name" :selectOnTab="true"
                                            :filterable="false" :options="options" @search="onSearch"
                                            @input="setSelected">
                                            <template slot="no-options">
                                                type to search item
                                            </template>
                                            <!-- <template slot="option" slot-scope="option">
                                                <div class="d-center">
                                                    {{ option.name }}
                                                </div>
                                            </template> -->
                                            <template #search="{attributes, events}">
                                                <input class="vs__search" v-validate="searchSelectData ? '' : 'required' " v-bind="attributes"
                                                    v-on="events" name="item" :placeholder="searchSelectData ? '' : 'Select item'"/>
                                            </template>
                                        </v-select>
                                        <span class="help-block">{{ errors.first('resource-form.item') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('resource-form.group') }">
                                        <label>Group</label>
                                        <input type="text" name="group" v-model="toShowData.group" class="form-control"
                                            v-validate="'required'" id="group" placeholder="First select item name"
                                            readonly>
                                        <span class="help-block">{{ errors.first('resource-form.group') }}</span>
                                    </div>
                                    <div
                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.category') }">
                                        <label for="category">Category </label>
                                        <input type="text" name="category" v-model="toShowData.category" class="form-control"
                                            v-validate="'required'" id="category" placeholder="First select item name"
                                            readonly>
                                        <span class="help-block">{{ errors.first('resource-form.category') }}</span>
                                    </div>
                                    <!-- <div :class="{'form-group': true, 'has-error': errors.has('resource-form.name') }">
                                        <label for="name">Item Name </label>
                                        <input type="text" name="name" v-model="element.name"
                                            class="form-control" v-validate="'required|max:120'" id="name"
                                            placeholder="Enter item name">
                                        <span class="help-block">{{ errors.first('resource-form.name') }}</span>
                                    </div> -->
                                </div>
                                <div class="col-md-6">
                                    <div :class="{'form-group': true, 'has-error': errors.has('resource-form.date') }">
                                        <label for="date">Effective From </label>
                                        <input type="date" name="date" v-model="element.effective_from"
                                            class="form-control" v-validate="'required'" id="date"
                                            placeholder="Enter date of effective from">
                                        <span class="help-block">{{ errors.first('resource-form.date') }}</span>
                                    </div>
                                    <div
                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.purchase') }">
                                        <label for="purchase">Purchase Price </label>
                                        <input type="text" name="purchase" v-model="element.purchase_price"
                                            class="form-control" v-validate="'decimal:2|max:10'"
                                            id="purchase" placeholder="Enter purchase price">
                                        <span class="help-block">{{ errors.first('resource-form.purchase') }}</span>
                                    </div>
                                    <!-- <div
                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.landed') }">
                                        <label for="landed">Landed Price </label>
                                        <input type="text" name="landed" v-model="element.landed_price"
                                            class="form-control" v-validate="'decimal:2|max:10'"
                                            id="landed" placeholder="Enter landed price">
                                        <span class="help-block">{{ errors.first('resource-form.landed') }}</span>
                                    </div> -->
                                    <div
                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.selling') }">
                                        <label for="selling">Selling Price </label>
                                        <input type="text" name="selling" v-model="element.selling_price"
                                            class="form-control" v-validate="'decimal:2|max:10'"
                                            id="selling" placeholder="Enter selling price">
                                        <span class="help-block">{{ errors.first('resource-form.selling') }}</span>
                                    </div>
                                    <div
                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.remarks') }">
                                        <label for="remarks">Remarks </label>
                                        <input type="text" name="remarks" v-model="element.remarks" class="form-control"
                                            v-validate="'max:255'" id="remarks" placeholder="Enter item remarks">
                                        <span class="help-block">{{ errors.first('resource-form.remarks') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-flat" id="save">Submit</button>
                            <button class="btn btn-primary btn-flat"
                                onclick="document.getElementById('cancel').click()">
                                Cancel
                                <router-link :to="{ name: 'item-prices' }" id="cancel"></router-link>
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
        name: 'create-item',
        data: function () {
            return {
                element: {
                    branch_id: '',
                    item_group_id: '',
                    item_category_id: '',
                    item_id: ''
                },
                dropDownData: [],
                url: '/admin/item-prices',
                dropDownDataUrl: '/admin/resource-locations',
                process: false,
                options: [],
                item: {
                    category: '',
                    group: '',
                    item_category_id: '',
                    item_group_id: '',
                    id: ''
                },
                searchSelectData: null,
                toShowData: {
                    group: '',
                    category: ''
                }
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
            onSearch(search, loading) {
                this.search(loading, search, this);
            },
            search: _.debounce((loading, search, vm) => {
                if (search) {
                    loading(true);
                    fetch(
                    `/admin/search-item?keyword=${escape(search)}`
                ).then(res => {
                    res.json().then(json => (vm.options = json));
                    loading(false);
                });
                }
            }, 350),
            setSelected(value) {
                if (value != null) {
                    this.element.item_id = value.id;
                    this.element.item_category_id = value.item_category_id;
                    this.element.item_group_id = value.item_group_id;
                    this.toShowData.group = value.group;
                    this.toShowData.category = value.category;
                }
            },
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
                                        path: "/item-prices"
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
