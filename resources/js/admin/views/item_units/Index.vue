<template>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div clss="col-sm-6" style="margin-bottom:2%">
                            <h3 class="box-title">
                                <span v-if="elements.total == 0 || elements.total ==1">Item Unit</span>
                                <span v-else>Item Units</span>
                                <small class="badge badge-primary">{{ elements.total }}</small></h3>
                            <form @submit.prevent="search" method="POST" class="form-inline float-right search-form">
                                <span class="dataTables_length" id="example1_length"><label>Show <select name="limit"
                                            v-model="limit" @change="fetchData()" aria-controls="example1"
                                            class="form-control input-sm">
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="250">250</option>
                                            <option value="500">500</option>
                                            <option :value="elements.total">All</option>
                                        </select>
                                        entries</label> </span>
                                <div class="input-group">
                                    <input name="keyword" type="text" v-model="keyword" class="form-control"
                                        id="search" placeholder="Search result here...">
                                    <span class="input-group-btn">
                                        <button type="submit" v-on:click="search" class="btn btn-primary btn-flat">
                                            <i class="fa fa-search cursor-pointer" title="Search"></i>
                                        </button>
                                    </span>
                                </div>
                                <button type="submit" class="btn btn-success btn-flat"
                                    onclick="document.getElementById('add').click()">
                                    <i class="fa fa-plus-circle cursor-pointer" title="Add">
                                    </i>
                                    <router-link :to="{ name: 'create-item-unit' }" id="add"></router-link>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th v-for="column in columns" @click="sortByColumn(column.real_text)"
                                        class="cursor-pointer" :key="column.text">
                                        {{ column.text }}
                                        <span v-if="column.real_text === sortedColumn">
                                            <i v-if="order === 'asc'" class="fa fa-arrow-up"></i>
                                            <i v-else class="fa fa-arrow-down"></i>
                                        </span>
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(element) in elements.data" :key="element.id">
                                    <td>{{ element.unit }}</td>
                                    <td>{{ element.updated_at }}</td>
                                    <td>{{ element.created_at }}</td>
                                    <td>
                                        <router-link :to="{ name: 'edit-item-unit', params: {id: element.id }}">
                                            <i class="fa fa-edit text-success"></i>
                                        </router-link>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <pagination :data="elements" @pagination-change-page="getResults" :limit="3">
                        </pagination>
                    </div>
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
        name: 'item-units',
        data: function () {
            return {
                elements: {},
                columns: [{
                        'text': 'Item Unit',
                        'real_text': 'unit'
                    },
                    {
                        'text': 'Updated At',
                        'real_text': 'updated_at'
                    },
                    {
                        'text': 'Created At',
                        'real_text': 'created_at'
                    }
                ],
                keyword: '',
                isSearchRequest: false,
                sortedColumn: '',
                order: 'asc',
                limit: 25,
                pageUrl: 'admin/item-units',
                searchUrl: 'admin/search-item-units',
                process: false
            }
        },
        mounted() {
            this.fetchData();
            document.onkeydown = function (e) {

                if (e.altKey && e.which == 78) {
                    document.getElementById('add').click();
                    return false;
                } else if (e.altKey && e.which == 83) {
                    document.getElementById('search').focus();
                    return false;
                }
            }
        },
        methods: {
            search() {
                event.preventDefault();
                this.fetchData();
            },
            getResults(page = 1) {
                var app = this;
                this.process = true;
                axios.get(this.searchUrl + '?keyword=' + this.keyword + '&column=' + this.sortedColumn + '&order=' +
                        this.order + '&limit=' + this.limit + '&page=' + page)
                    .then(response => {
                        this.elements = response.data;
                    })
                    .catch(function (resp) {
                        app.error();
                    })
                    .finally(function () {
                        app.process = false;
                    });
            },
            sortByColumn(column) {
                if (column === this.sortedColumn) {
                    this.order = (this.order === 'asc') ? 'desc' : 'asc'
                } else {
                    this.sortedColumn = column
                    this.order = 'asc'
                }
                this.fetchData()
            },
            fetchData() {
                var app = this;
                this.process = true;
                let url = this.pageUrl + '?column=' + this.sortedColumn + '&order=' + this.order + '&limit=' + this
                    .limit;
                if (this.keyword) {
                    url = this.searchUrl + '?keyword=' + this.keyword + '&column=' + this.sortedColumn +
                        '&order=' + this.order + '&limit=' + this.limit;
                }
                axios.get(url)
                    .then(response => {
                        this.elements = response.data;
                    })
                    .catch(function (resp) {
                        app.error();
                    })
                    .finally(function () {
                        app.process = false;
                    });
            },
        }
    }

</script>
