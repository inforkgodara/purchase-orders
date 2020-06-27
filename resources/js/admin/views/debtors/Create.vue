<template>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-arrow-left cursor-pointer"
                                onclick="document.getElementById('back').click()">
                                <router-link :to="{ name: 'debtors' }" id="back"></router-link>
                            </i>
                            Add Debtor
                        </h3>
                    </div>
                    <form @submit.prevent="store('debtor-form')" action="/" method="post" data-vv-scope="debtor-form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div :class="{'form-group': true, 'has-error': errors.has('debtor-form.branch') }">
                                        <label>Branch</label>
                                        <select name="branch" class="form-control" v-validate="'required'"
                                            v-model="element.branch_id" ref="branch">
                                            <option value="">Please select branch</option>
                                            <option v-for="item in dropDownData.branches" :value="item.id" :key="item.id">
                                                {{ item.branch }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('debtor-form.branch') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('debtor-form.name') }">
                                        <label for="name">Name </label>
                                        <input type="text" name="name" v-model="element.name"
                                            class="form-control" v-validate="'required|max:100'" id="name"
                                            placeholder="Enter name">
                                        <span class="help-block">{{ errors.first('debtor-form.name') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('debtor-form.days') }">
                                        <label for="credit_days">Credit Days </label>
                                        <input type="text" name="days" v-model="element.credit_days"
                                            class="form-control" v-validate="'numeric|max:4'" id="credit_days"
                                            placeholder="Enter credit days">
                                        <span class="help-block">{{ errors.first('debtor-form.days') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div :class="{'form-group': true, 'has-error': errors.has('debtor-form.limit') }">
                                        <label for="credit_limit">Credit Limit </label>
                                        <input type="text" name="limit" v-model="element.credit_limit"
                                            class="form-control" v-validate="'decimal:2|max:10'" id="credit_limit"
                                            placeholder="Enter credit days">
                                        <span class="help-block">{{ errors.first('debtor-form.limit') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('debtor-form.term') }">
                                        <label>Payment Term</label>
                                        <select name="term" class="form-control" v-validate="'required'"
                                            v-model="element.payment_term_id">
                                            <option value="">Please select payment term</option>
                                            <option v-for="item in dropDownData.payment_terms" :value="item.id" :key="item.id">
                                                {{ item.term }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('debtor-form.term') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('debtor-form.category') }">
                                        <label>Party Category</label>
                                        <select name="category" class="form-control" v-validate="'required'"
                                            v-model="element.party_category_id">
                                            <option value="">Please select party category</option>
                                            <option v-for="item in dropDownData.party_categories" :value="item.id" :key="item.id">
                                                {{ item.category }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('debtor-form.category') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div :class="{'form-group': true, 'has-error': errors.has('debtor-form-form.building') }">
                                        <label>Building</label>
                                        <input class="form-control" v-model="element.building" name="building"
                                            v-validate="'max:255'" placeholder="Enter building">
                                        <span class="help-block">{{ errors.first('debtor-form-form.building') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('debtor-form-form.street') }">
                                        <label>Street</label>
                                        <input class="form-control" v-model="element.street" name="street"
                                            v-validate="'max:255'" placeholder="Enter street">
                                        <span class="help-block">{{ errors.first('debtor-form-form.street') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('debtor-form.city') }">
                                        <label>City</label>
                                        <select name="city" class="form-control" v-validate="'required'"
                                            v-model="element.city_id">
                                            <option value="">Please select city</option>
                                            <option v-for="item in dropDownData.cities" :value="item.id" :key="item.id">
                                                {{ item.city }}
                                            </option>
                                        </select>
                                        <span class="help-block">{{ errors.first('debtor-form.city') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div :class="{'form-group': true, 'has-error': errors.has('debtor-form.contact') }">
                                        <label for="contact">Contact Number</label>
                                        <input type="text" name="contact" v-model="element.contact_number"
                                            class="form-control" v-validate="'numeric|max:15'" id="contact"
                                            placeholder="Enter contact number">
                                        <span class="help-block">{{ errors.first('debtor-form.contact') }}</span>
                                    </div>
                                    <div :class="{'form-group': true, 'has-error': errors.has('debtor-form.email') }">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" v-model="element.email" class="form-control"
                                            id="email" v-validate="'email|max:80'" placeholder="Enter email">
                                        <span class="help-block">{{ errors.first('debtor-form.email') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-flat" id="save">Submit</button>
                            <button class="btn btn-primary btn-flat"
                                onclick="document.getElementById('cancel').click()">
                                Cancel
                                <router-link :to="{ name: 'debtors' }" id="cancel"></router-link>
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
        name: 'create-debtor',
        data: function () {
            return {
                element: {
                    branch_id: '',
                    payment_term_id: '',
                    party_category_id: '',
                    city_id: ''
                },
                dropDownData: [],
                url: '/admin/debtors',
                cityUrl: '/admin/resource-debtors',
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
                    app.dropDownData = resp.data;
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
                                        path: "/debtors"
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
