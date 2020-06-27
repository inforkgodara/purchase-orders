<template>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-arrow-left cursor-pointer"
                                onclick="document.getElementById('back').click()">
                                <router-link :to="{ name: 'purchase-orders' }" id="back"></router-link>
                            </i>
                            Add Purchase Order
                        </h3>
                    </div>
                    <form @submit.prevent="store('resource-form')" action="/" method="post"
                        data-vv-scope="resource-form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div
                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.branch') }">
                                        <label>Branch</label>
                                        <select name="branch" class="form-control" v-validate="'required'"
                                            v-model="element.branch_id" ref="branch" @change="selectedBranch($event)">
                                            <option value="">Please select branch</option>
                                            <option v-for="item in dropDownData.branches" :value="item.id"
                                                :key="item.id">
                                                {{ item.branch }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('resource-form.branch') }}</span>
                                    </div>
                                    <div
                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.location') }">
                                        <label>Location</label>
                                        <select name="location" class="form-control" v-validate="'required'"
                                            v-model="element.location_id" ref="location">
                                            <option value="">Please select location</option>
                                            <option v-for="item in locations" :value="item.id" :key="item.id">
                                                {{ item.name }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('resource-form.location') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div
                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.creditor') }">
                                        <label for="name">Creditor </label>
                                        <v-select v-model="selectedCreditor" label="name" :selectOnTab="true"
                                            :filterable="false" :options="creditors" @search="onSearchCreditor"
                                            @input="setSelectedCreditor">
                                            <template slot="no-options">
                                                type to search creditor
                                            </template>
                                            <template #search="{attributes, events}">
                                                <input class="vs__search"
                                                    v-validate="selectedCreditor ? '' : 'required' " v-bind="attributes"
                                                    v-on="events" name="creditor"
                                                    :placeholder="selectedCreditor ? '' : 'Select creditor'" />
                                            </template>
                                        </v-select>
                                        <span class="help-block">{{ errors.first('resource-form.creditor') }}</span>
                                    </div>
                                    <div
                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.debtor') }">
                                        <label for="name">Debtor </label>
                                        <v-select v-model="selectedDebtor" label="name" :selectOnTab="true"
                                            :filterable="false" :options="debtors" @search="onSearchDebtor"
                                            @input="setSelectedDebtor">
                                            <template slot="no-options">
                                                type to search debtor
                                            </template>
                                            <template #search="{attributes, events}">
                                                <input class="vs__search" v-bind="attributes" v-on="events"
                                                    name="debtor"
                                                    :placeholder="selectedDebtor ? '' : 'Select debtor'" />
                                            </template>
                                        </v-select>
                                        <span class="help-block">{{ errors.first('resource-form.debtor') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div :class="{'form-group': true, 'has-error': errors.has('resource-form.date') }">
                                        <label for="date">Date </label>
                                        <input type="date" name="date" v-model="element.date" class="form-control"
                                            v-validate="'required'" id="date" placeholder="Enter date">
                                        <span class="help-block">{{ errors.first('resource-form.date') }}</span>
                                    </div>
                                    <div
                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.reference') }">
                                        <label for="reference">Reference Number </label>
                                        <input type="text" name="reference" v-model="element.reference"
                                            class="form-control" v-validate="'max:20'" id="reference"
                                            placeholder="Enter reference number">
                                        <span class="help-block">{{ errors.first('resource-form.reference') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div
                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.number') }">
                                        <label for="number">Number </label>
                                        <input disabled type="text" name="number" v-model="element.number" class="form-control"
                                            v-validate="'max:255'" id="number">
                                        <span class="help-block">{{ errors.first('resource-form.number') }}</span>
                                    </div>
                                    <div
                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.remarks') }">
                                        <label for="remarks">Remarks </label>
                                        <input type="text" name="remarks" v-model="element.remarks" class="form-control"
                                            v-validate="'max:255'" id="remarks" placeholder="Enter remarks">
                                        <span class="help-block">{{ errors.first('resource-form.remarks') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table">
                                        <thead>
                                            <tr class="dark-tr">
                                                <th width="2%">No</th>
                                                <th width="48%">Item Name</th>
                                                <th width="10%">Unit</th>
                                                <th width="10%">Quantity</th>
                                                <th width="10%">Rate</th>
                                                <th width="10%">Amount</th>
                                                <th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(line, index) in lines" v-bind:key="index"
                                                @click="setIndex(index)">
                                                <td class="c-td"><small
                                                        class="badge badge-primary">{{ index + 1 }}</small></td>
                                                <td class="c-td">
                                                    <div
                                                        :class="{'form-group': true, 'has-error': errors.first('resource-form.item '+[index]) }">
                                                        <v-select v-model="line.item" label="name" :selectOnTab="true"
                                                            :filterable="false" :options="items" @search="onSearchItem"
                                                            @input="setSelectedItem">
                                                            <template slot="no-options">
                                                                type to search item
                                                            </template>
                                                            <template #search="{attributes, events}">
                                                                <input class="vs__search" @keypress="setIndex(index)"
                                                                    v-validate="line.item ? '' : 'required' "
                                                                    v-bind="attributes" v-on="events"
                                                                    :name="'item '+index"
                                                                    :placeholder="line.item ? '' : 'Select item'" />
                                                            </template>
                                                        </v-select>
                                                        <span
                                                            class="help-block">{{ errors.first('resource-form.item '+[index]) }}</span>
                                                    </div>
                                                </td>
                                                <td class="c-td">
                                                    <div
                                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.unit '+[index]) }">
                                                        <select :name="'unit '+index" class="form-control"
                                                            v-validate="'required'" v-model="line.item_unit_id">
                                                            <option v-for="item in line.units" :value="item.id"
                                                                :key="item.id">
                                                                {{ item.unit }}
                                                            </option>
                                                        </select>
                                                        <span
                                                            class="help-block">{{ errors.first('resource-form.unit '+[index]) }}</span>
                                                    </div>
                                                </td>
                                                <td class="c-td">
                                                    <div
                                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.quantity '+[index]) }">
                                                        <input type="text" :name="'quantity '+index"
                                                            v-model="line.quantity" @keyup="updateAmount()"
                                                            class="form-control" v-validate="'required|max:15'"
                                                            id="quantity">
                                                        <span
                                                            class="help-block">{{ errors.first('resource-form.quantity '+[index]) }}</span>
                                                    </div>
                                                </td>
                                                <td class="c-td">
                                                    <div
                                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.rate '+[index]) }">
                                                        <input disabled type="text" :name="'rate '+index"
                                                            v-model="line.rate" class="form-control"
                                                            v-validate="'required|max:15'" id="rate">
                                                        <span
                                                            class="help-block">{{ errors.first('resource-form.rate '+[index]) }}</span>
                                                    </div>
                                                </td>
                                                <td class="c-td">
                                                    <div
                                                        :class="{'form-group': true, 'has-error': errors.has('resource-form.amount '+[index]) }">
                                                        <input disabled type="text" :name="'amount '+index"
                                                            v-model="line.amount" class="form-control"
                                                            v-validate="'required|max:15'" id="amount">
                                                        <span
                                                            class="help-block">{{ errors.first('resource-form.amount '+[index]) }}</span>
                                                    </div>
                                                </td>
                                                <td class="c-td">
                                                    <button type="button" class="btn btn-default btn-circle"
                                                        id="removeResource" @click="removeLine(index)" icon="delete"
                                                        round>
                                                        <li class="fa text-danger fa-trash fa-lg"></li>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-circle"
                                                        id="addResource" v-if="index + 1 === lines.length"
                                                        @click="addLine" icon="playlist-plus" round>
                                                        <li class="fa text-success fa-plus-circle fa-lg"></li>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="dark-tr">
                                                <td>
                                                    {{ lines.length }}
                                                </td>
                                                <td>Total</td>
                                                <td></td>
                                                <td>
                                                    {{ totalQuantity }}
                                                </td>
                                                <td>
                                                    {{ totalRate }}
                                                </td>
                                                <td>
                                                    {{ totalAmount }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-flat" id="save">Submit</button>
                            <button class="btn btn-primary btn-flat"
                                onclick="document.getElementById('cancel').click()">
                                Cancel
                                <router-link :to="{ name: 'purchase-orders' }" id="cancel"></router-link>
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
        name: 'create-purchase-order',
        data: function () {
            return {
                element: {
                    branch_id: '',
                    location_id: '',
                    creditor_id: '',
                    debtor_id: '',
                    details: [],
                    total_quantity: 0,
                    total_amount: 0
                },
                dropDownData: [],
                url: '/admin/purchase-orders',
                dropDownDataUrl: '/admin/resource-purchase-orders',
                process: false,
                locations: [],
                creditors: [],
                items: [],
                units: [],
                debtors: [],
                selectedCreditor: null,
                selectedDebtor: null,
                selectedItem: [],
                lines: [],
                blockRemoval: true,
                index: 0
            }
        },
        mounted() {
            this.$refs.branch.focus();
            this.addLine();
            var app = this;
            document.onkeydown = function (e) {
                if (e.altKey && e.which == 83) {
                    document.getElementById('save').click();
                    return false;
                } else if (e.altKey && e.which == 67) {
                    document.getElementById('cancel').click();
                    return false;
                } else if (e.altKey && e.which == 65) {
                    app.addLine();
                    return false;
                } else if (e.which == 46) {
                    app.removeLine(app.index);
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
        watch: {
            lines() {
                this.blockRemoval = this.lines.length <= 1
            }
        },
        computed: {
            totalQuantity() {
                return this.lines.reduce(function (totalQuantity, line) {
                    return parseInt(totalQuantity) + parseInt(line.quantity)
                }, 0);
            },
            totalRate() {
                return this.lines.reduce(function (totalRate, line) {
                    return totalRate + line.rate
                }, 0);
            },
            totalAmount() {
                return this.lines.reduce(function (totalAmount, line) {
                    return totalAmount + line.amount
                }, 0);
            }
        },
        methods: {
            addLine() {
                let checkEmptyLines = this.lines.filter(line => line.item === null)
                if (false == true) return
                this.lines.push({
                    item: null,
                    item_id: '',
                    item_unit_id: '',
                    unit_id: '',
                    quantity: 0,
                    rate: 0,
                    amount: 0,
                })
            },
            removeLine(lineId) {
                if (!this.blockRemoval) this.lines.splice(lineId, 1)
            },

            onSearchCreditor(search, loading) {
                this.searchCreditor(loading, search, this);
            },
            onSearchItem(search, loading) {
                this.searchItem(loading, search, this);
            },
            onSearchDebtor(search, loading) {
                this.searchDebtor(loading, search, this);
            },
            searchCreditor: _.debounce((loading, search, vm) => {
                if (search) {
                    loading(true);
                    fetch(
                        `/admin/search-creditor?keyword=${escape(search)}`
                    ).then(res => {
                        res.json().then(json => (vm.creditors = json));
                        loading(false);
                    });
                }
            }, 350),
            searchDebtor: _.debounce((loading, search, vm) => {
                if (search) {
                    loading(true);
                    fetch(
                        `/admin/search-debtor?keyword=${escape(search)}`
                    ).then(res => {
                        res.json().then(json => (vm.debtors = json));
                        loading(false);
                    });
                }
            }, 350),
            searchItem: _.debounce((loading, search, vm) => {
                if (search) {
                    loading(true);
                    fetch(
                        `/admin/search-item-po?keyword=${escape(search)}`
                    ).then(res => {
                        res.json().then(json => (vm.items = json));
                        loading(false);
                    });
                }
            }, 350),
            setSelectedCreditor(value) {
                if (value != null) {
                    this.element.creditor_id = value.id;
                }
            },
            setSelectedDebtor(value) {
                if (value != null) {
                    this.element.debtor_id = value.id;
                }
            },
            setSelectedItem(value) {
                if (value != null) {
                    this.lines[this.index]['item_id'] = value.id;
                    this.lines[this.index]['rate'] = value.purchase_price;
                    this.lines[this.index]['item_unit_id'] = value.pack_unit_id;
                    this.updateAmount();
                    if (value.pack_unit_id == value.standard_unit_id) {
                        this.lines[this.index]['units'] = [{
                            id: value.pack_unit_id,
                            unit: value.pack_unit
                        }];
                        return;
                    }
                    this.lines[this.index]['units'] = [{
                            id: value.pack_unit_id,
                            unit: value.pack_unit
                        },
                        {
                            id: value.standard_unit_id,
                            unit: value.standard_unit
                        }
                    ];
                }
            },
            updateAmount() {
                this.lines[this.index]['amount'] = this.lines[this.index]['quantity'] * this.lines[this.index]['rate'];
            },
            selectedBranch(event) {
                var app = this;
                if (event.target.value) {
                    axios.get('/admin/items/' + event.target.value)
                        .then(function (resp) {
                            app.locations = resp.data;
                            if (app.locations.length == 0) {
                                app.element.location_id = '';
                            }
                        })
                        .catch(function (resp) {

                        });
                }
            },
            store(scope) {
                var app = this;
                this.$validator.validateAll(scope).then((result) => {
                    if (result) {
                        this.process = true;
                        this.element.details = this.lines;
                        this.element.total_quantity = this.totalQuantity;
                        this.element.total_amount = this.totalAmount;
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
                                        path: "/purchase-orders"
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
            setIndex(index) {
                this.index = index;
            }
        }
    }

</script>
